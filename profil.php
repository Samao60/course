<?php include 'header.php'; 
include 'connexion.php'; ?>

<?php $id = $_SESSION['id']; ?>

 <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Gestion du profil</h1>

<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Modifification des informations</h6>
                        </div>
                        <div class="card-body">
                        <?php 
    $reponse = $pdo->query('SELECT * FROM `user` WHERE `id` = '. $id .' ');
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
                                      
                                      if(isset($_POST['modif_profil_info'])) {
                                        $nom = $_POST['nom'];
                                        $prenom = $_POST['prenom'];
                                        $mail = $_POST['mail'];

                                        $req = $pdo->prepare('UPDATE `user` SET `nom` = :nom, `prenom` = :prenom, `email` = :mail WHERE id = :id ');
                                        $req->bindValue(':nom', $nom, PDO::PARAM_STR);
                                        $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
                                        $req->bindValue(':mail', $mail, PDO::PARAM_STR);
                                        $req->bindValue(':id', $id, PDO::PARAM_INT);
                                        $exec = $req->execute(); 
                                        if($exec){
                                            echo '<div class="card mb-4 py-3 border-left-success mt-3"><div class="card-body">Profil modifié avec succès !</div></div>'; 
                                            echo "<meta http-equiv='refresh' content='4'>";
                                        }
                                        else {
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
                            <?php if(isset($_POST['modif_mdp'])) {
                                if($_POST['pass'] === $_POST['confirm-pass']){
                                    $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                                    $req = $pdo->prepare('UPDATE `user` SET `mdp` = :pass WHERE id = :id ');
                                    $req->bindValue(':pass', $pass_hache, PDO::PARAM_STR);
                                    $req->bindValue(':id', $id, PDO::PARAM_INT);
                                    $exec = $req->execute(); 
                                    if($exec){
                                        echo '<div class="card mb-4 py-3 border-left-success mt-3"><div class="card-body">Mot de passe modifié avec succès</div></div>';
                                        echo "<meta http-equiv='refresh' content='4'>";
                                    }
                                    else{
                                        echo '<div class="card mb-4 py-3 border-left-danger"><div class="card-body">Oups ! Quelque chose c\'est mal passé !</div></div>';
                                        echo "<meta http-equiv='refresh' content='4'>";
                                    }
                                }
                                else {
                                    echo '<div class="card mb-4 py-3 border-left-danger"><div class="card-body">Attention ! le mot de passe ne correspond pas !</div></div>';
                                    echo "<meta http-equiv='refresh' content='4'>";
                                }
                            } 

                            ?>
                        </div>
</div>
  </div>
  <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php include 'footer.php' ?>