<?php include 'header.php';
include 'connexion.php'; ?>
<title>Mon profil | Gestion des courses</title>
<?php $id = $_SESSION['id']; 
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Gestion du profil</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ma photo de profil</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input class="form-control file" type="file" name="file" id="file" accept="image/png, image/jpeg">
                        </div>
                        <div class="col"><input type="submit" name="envoiphoto" class="btn btn-success" value="Mettre à jour ma photo de profil"></div>

                    </form>
                    <?php 
                        // Déclaration de la fonction
    function IsDir_or_CreateIt($path) {
        if(is_dir($path)) {
          return true;
        } else {
          if(mkdir($path)) {
            return true;
          } else {
            return false;
          }
        }
      }
 if(isset($_POST['envoiphoto'])) {
     $tmpName = $_FILES['file']['tmp_name'];
     $name = $_FILES['file']['name'];
     $size = $_FILES['file']['size'];
     $error = $_FILES['file']['error'];
     $dossier = 'upload/profil/'.$id.'';
     $sql = "UPDATE `user` SET `profil_img`=:name WHERE `id` = :id ";
     $res = $pdo->prepare($sql);
     $exec = $res->execute(array(":name"=>$name, ":id" => $id));
     if($exec) {
         echo 'YES';
         move_uploaded_file($tmpName, 'upload/profil/'.$nom.'.'.$prenom.'/profil.jpg');
     }
     else {
         echo 'error';
     }
 }
?>
                </div>
            </div>

        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Modifification des informations</h6>
        </div>
        <div class="card-body">
            <?php
            $reponse = $pdo->query('SELECT * FROM `user` WHERE `id` = ' . $id . ' ');
            while ($donnees = $reponse->fetch()) {
            ?>
                <form action="" method="post">
                    <div class="row mb-3">
                        <div class="col"><input class="form-control" name="mail" type="mail" placeholder="Adresse mail" value="<?php echo $donnees['email'] ?>"></div>


                    </div>
                    <div class="row mb-3">
                        <div class="col"><input class="form-control" name="nom" type="text" placeholder="Nom" value="<?php echo $donnees['nom'] ?>"></div>
                        <div class="col"><input class="form-control" name="prenom" type="text" placeholder="Prénom" value="<?php echo $donnees['prenom'] ?>"></div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="submit" name="modif_profil_info" class="btn btn-success" value="Modifier">
                        </div>
                    </div>
                </form>
            <?php }
            $reponse->closeCursor();

            if (isset($_POST['modif_profil_info'])) {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $mail = $_POST['mail'];

                $req = $pdo->prepare('UPDATE `user` SET `nom` = :nom, `prenom` = :prenom, `email` = :mail WHERE id = :id ');
                $req->bindValue(':nom', $nom, PDO::PARAM_STR);
                $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
                $req->bindValue(':mail', $mail, PDO::PARAM_STR);
                $req->bindValue(':id', $id, PDO::PARAM_INT);
                $exec = $req->execute();
                if ($exec) {
                    echo '<div class="card mb-4 py-3 border-left-success mt-3"><div class="card-body">Profil modifié avec succès !</div></div>';
                    echo "<meta http-equiv='refresh' content='4'>";
                } else {
                    echo '<div class="card mb-4 py-3 border-left-danger"><div class="card-body">Oups ! Quelque chose c\'est mal passé !</div></div>';
                    echo "<meta http-equiv='refresh' content='4'>";
                }
            }

            ?>

        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Modification du mot de passe</h6>
        </div>
        <div class="card-body">
            <form method="post" action="">
                <div class="row mb-3">
                    <div class="col"><input class="form-control" name="pass" type="password" placeholder="Mot de passe"></div>
                    <div class="col"><input class="form-control" name="confirm-pass" type="password" placeholder="Confirmer le mot de passe"></div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" name="modif_mdp" value="Modifier le mot de passe" class="btn btn-success">
                    </div>
                </div>
            </form>
            <?php if (isset($_POST['modif_mdp'])) {
                if ($_POST['pass'] === $_POST['confirm-pass']) {
                    $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                    $req = $pdo->prepare('UPDATE `user` SET `mdp` = :pass WHERE id = :id ');
                    $req->bindValue(':pass', $pass_hache, PDO::PARAM_STR);
                    $req->bindValue(':id', $id, PDO::PARAM_INT);
                    $exec = $req->execute();
                    if ($exec) {
                        echo '<div class="card mb-4 py-3 border-left-success mt-3"><div class="card-body">Mot de passe modifié avec succès</div></div>';
                        echo "<meta http-equiv='refresh' content='4'>";
                    } else {
                        echo '<div class="card mb-4 py-3 border-left-danger"><div class="card-body">Oups ! Quelque chose c\'est mal passé !</div></div>';
                        echo "<meta http-equiv='refresh' content='4'>";
                    }
                } else {
                    echo '<div class="card mb-4 py-3 border-left-danger"><div class="card-body">Attention ! le mot de passe ne correspond pas !</div></div>';
                    echo "<meta http-equiv='refresh' content='4'>";
                }
            }

            ?>
        </div>
    </div>
</div>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php include 'footer.php' ?>