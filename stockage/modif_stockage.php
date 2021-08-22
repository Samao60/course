<?php include "../header.php";
include '../connexion.php'; ?>
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="card shadow mb-4">


        <?php
        $id = $_GET['id'];
        $id_user = $_SESSION['id'];

        $reponse = $pdo->query('SELECT * FROM `stockage` WHERE `id` = ' . $id . ' AND `id_user` = ' . $id_user . '');
        while ($donnees = $reponse->fetch()) { ?>

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Modifier le stockage "<?= $donnees['nom_stockage'] ?>"</h6>
            </div>
            <div class="card-body">
                <form id="modifstockage" action="" method="post">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Nom du stockage</label>
                            <input type="text" class="form-control" name="stock_name" value="<?= $donnees['nom_stockage'] ?>" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Description du stockage</label>
                            <textarea type="text" class="form-control" name="stock_description" id=""><?= $donnees['description'] ?></textarea>
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
    $type_name = $_POST['stock_name'];
    $type_description = $_POST['stock_description'];
    //Requête
    $sql = 'UPDATE `course`.`stockage` SET `nom_stockage` = "' . $type_name . '", `description` = "' . $type_description . '"   WHERE `id` = "'. $id .'"';
    $res = $pdo->prepare($sql);
    $exec = $res->execute(array(':nom' => $type_name, ':description' => $type_description, ':id_user' => $_SESSION['id']));

    if ($exec) {
        echo '<div class="card mb-4 py-3 border-left-success"><div class="card-body">Le stockage a bien été modifé ! <br><br> <a href="gestion-des-stockages"><- Revenir à la gestion du stockage</a> </div></div>';
        echo '<meta http-equiv="refresh" content="0; URL=gestion-des-stockages.php" />'

?>

<?php
    } else {
        echo 'Erreur';
    }
}
?>
