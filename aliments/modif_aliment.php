<?php
include "../header.php";
include '../connexion.php'; 

$id = $_GET['id']; 
$reponse = $pdo->query('SELECT * FROM `course`.`aliments_frigo` WHERE `id` = "'. $id .'" AND `id_user` = '.$_SESSION['id'].' ');
while ($donnees = $reponse->fetch()) { ?>

<!-- Begin Page Content -->
<div class="container-fluid">
<h1 class="h3 mb-4 text-gray-800">Modification d'un aliment</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Modification un aliment</h6>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="row mb-2">
                    <div class="col">
                        <label for="nom">Nom de l'aliment</label>
                        <input type="text" class="form-control" value="<?= $donnees['nom'] ?>" name="nom" id="">
                    </div>
                    <div class="col">
                    <label for="nom">Déscription de l'aliment</label>
                        <input type="text" class="form-control" value="<?= $donnees['description'] ?>" name="description" id="">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="dlc">Date limit de consommation</label>
                        <input type="date" class="form-control" value="<?= $donnees['dlc'] ?>" name="dlc" id="">
                    </div>
                    <div class="col">
                    <label for="categorie">Dans quel catégorie est votre aliment ?</label>
                    <select name="categorie" class="form-control" id="">
                            <?php 
                        $id_user = $_SESSION['id'];
                        $categorie = $pdo->query('SELECT `nom` FROM categorie WHERE `id_user` = "1"');
                        $categorie->execute();
                        while ($donnees = $categorie->fetch()) {
                            echo '<option value="'.$donnees['nom'].'">'.$donnees['nom'].'</option>';
                        }
                        ?>
                                                    <?php 
                        $id_user = $_SESSION['id'];
                        $categorie = $pdo->query('SELECT `nom` FROM categorie WHERE `id_user` = "'.$id_user.'"');
                        $categorie->execute();
                        while ($donnees = $categorie->fetch()) {
                            echo '<option value="'.$donnees['nom'].'">'.$donnees['nom'].'</option>';
                        }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="stockage">Dans quel stockage est votre aliment ?</label>
                        <select name="stockage" class="form-control" id="">
                            <?php 
                        $id_user = $_SESSION['id'];
                        $categorie = $pdo->query('SELECT `nom_stockage` FROM stockage WHERE `id_user` = "'.$id_user.'"');
                        $categorie->execute();
                        while ($donnees = $categorie->fetch()) {
                            echo '<option value="'.$donnees['nom_stockage'].'">'.$donnees['nom_stockage'].'</option>';
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <button type="submit" name="envoi" class="btn btn-success">Ajouter l'aliment</button>
                    </div>
                </div>
            </form>
            <?php } ?>
            <?php 
              if (isset($_POST['envoi'])) {
                    $nom = $_POST['nom'];
                    $description = $_POST['description'];
                    $categorie = $_POST['categorie'];
                    $dlc = $_POST['dlc'];
                    $stockage = $_POST['stockage'];

                    //Requête
                    $sql = 'INSERT INTO `course`.`aliments_frigo` (`nom`, `description`, `categorie`, `dlc`, `stockage`, `id_user`) VALUES (:nom,:description,:categorie,:dlc,:stockage,:id_user)';
                    $res = $pdo->prepare($sql);
                    $exec = $res->execute(array(':nom' => $nom, ':description' => $description, ':categorie' => $categorie, ':dlc' => $dlc, ':stockage' => $stockage, ':id_user' => $_SESSION['id']));
                
                    if ($exec) {
                        echo '<div class="card mb-4 py-3 border-left-success"><div class="card-body">L\'aliment a bien été ajouté au stockage <br></div></div>';
                        echo '<meta http-equiv="refresh" content="0; URL=contenu-du-stockage.php" />';
                
                    } else {
                        echo 'Erreur';
                    }
                }
                ?>
        </div>
    </div>
</div>

        <?php include "../footer.php"; ?>