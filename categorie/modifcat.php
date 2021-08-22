<?php include "../header.php";
include '../connexion.php'; ?>
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="card shadow mb-4">


        <?php
        $id = $_GET['id'];
        $id_user = $_SESSION['id'];

        $reponse = $pdo->query('SELECT * FROM `categorie` WHERE `id` = ' . $id . ' AND `id_user` = ' . $id_user . '');
        while ($donnees = $reponse->fetch()) { ?>

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Modifier la catégorie "<?= $donnees['nom'] ?>"</h6>
            </div>
            <div class="card-body">
                <form id="modifstockage" action="" method="post">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Nom de la categorie</label>
                            <input type="text" class="form-control" name="cat_name" value="<?= $donnees['nom'] ?>" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Description de la categorie</label>
                            <textarea type="text" class="form-control" name="cat_description" id=""><?= $donnees['description'] ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <button type="submit" class="btn btn-success" id="envoi" name='envoi'>Valider</button>
                        </div>
                </form>
            </div>
        <?php }
        $reponse->closeCursor();

        ?>
    </div>
</div>

<!-- Envoi en BDD -->
<?php if (isset($_POST['envoi'])) {
    //connexion à la bdd

    //recupération des valeurs
    $type_name = $_POST['cat_name'];
    $type_description = $_POST['cat_description'];
    //Requête
    $sql = 'UPDATE `categorie` SET `nom` = "' . $type_name . '", `description` = "' . $type_description . '" WHERE `id` = "'. $id .'"';
    $res = $pdo->prepare($sql);
    $exec = $res->execute(array(':nom' => $type_name, ':description' => $type_description, ':id_user' => $_SESSION['id']));

    if ($exec) {
        echo '<div class="card mb-4 py-3 border-left-success"><div class="card-body">Le stockage a bien été modifé ! <br><br> <a href="gestion-des-stockages"><- Revenir à la gestion du stockage</a> </div></div>';
        echo '<meta http-equiv="refresh" content="0; URL=categorie.php" />'

?>

<?php
    } else {
        echo 'Erreur';
    }
}
?>
