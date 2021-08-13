<?php 
$id = $_GET['id'];
$host = 'localhost';
$dbname = 'course';
$username = 'root';
$password = '';
  $dsn = "mysql:host=$host;dbname=$dbname";
  $pdo = new PDO($dsn, $username, $password);

  $sql = 'DELETE FROM `course`.`categorie` WHERE  `id`= '. $id .' ';
                        $res = $pdo->prepare($sql);
                        $exec = $res->execute();
                        
                        if($exec){
                            header('Location: categorie');
                        }
                        else {
                            echo 'Erreur';
                        }

?>