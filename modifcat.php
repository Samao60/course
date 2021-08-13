  <!-- Envoi en BDD -->
                                    

  <?php 
$host = 'localhost';
$dbname = 'course';
$username = 'root';
$password = '';
  $dsn = "mysql:host=$host;dbname=$dbname";
  $pdo = new PDO($dsn, $username, $password);
                                            if(isset($_POST['envoimodif'])) {
                        //recupération des valeurs
                        $cat_modif_name = $_POST['cat_modif_name'];
                        $cat_modif_description = $_POST['cat_modif_descrpition'];
                        $id = $_POST['catid'];
                        //Requête
                        $res = $pdo->prepare('UPDATE `course`.`categorie` SET `nom` = :nom, `description` = :description  WHERE id = '.$id.'');
                        $exec = $res->execute(array(':nom'=>$cat_modif_name, ':description'=>$cat_modif_description));
                        
                        if($exec){
                            header('Location: categorie');
                        }
                        else {
                            echo 'Erreur';
                        }
                    }
                    ?>