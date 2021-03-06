<title>Gestion des catégories</title>
<?php include "../header.php";
include '../connexion.php'; ?>
<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Add categorie Modal-->
    <div class="modal fade" id="addcatmodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vous voulez ajouter une catégorie ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="envoicat" action="" method="post">
                        <div class="form-groug" style="margin-bottom: 1rem;">
                            <input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="Nom de la catégorie">
                        </div>
                        <div class="form-groug" style="margin-bottom: 1rem;">
                            <textarea name="cat_description" id="cat_descrpition" placeholder="Description de la catégorie" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success" id="envoi" name='envoi'>Valider</button>
                    </form>
                    <!-- Envoi en BDD -->
                    <?php if (isset($_POST['envoi'])) {
                        //connexion à la bdd

                        //recupération des valeurs
                        $cat_name = $_POST['cat_name'];
                        $cat_description = $_POST['cat_description'];
                        $id_user = $_SESSION['id'];
                        //Requête
                        $sql = 'INSERT INTO `course`.`categorie` (`nom`, `description`, `id_user`) VALUES (:nom,:description,:id_user)';
                        $res = $pdo->prepare($sql);
                        $exec = $res->execute(array(':nom' => $cat_name, ':description' => $cat_description, ':id_user' => $id_user));

                        if ($exec) {
                            echo 'Données insérées';
                        } else {
                            echo 'Erreur';
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Les catégories</h1>
    <p class="mb-4"> <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#addcatmodal">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Ajouter une catégorie</span>
        </a></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Les catégories existante</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $categorie = $pdo->query('SELECT * FROM categorie WHERE `id_user` = "1"');
                        $categorie->execute();
                        while ($donnees = $categorie->fetch()) {
                        ?>
                            <tr>
                                <td><?php echo $donnees['nom']; ?></td>
                                <td><?php echo $donnees['description']; ?></td>
                                <td>Catégories par default</td>
                                <td>Catégories par default</td>
                            </tr>

                          
                        <?php



                        }
                        $categorie->closeCursor(); ?>
                        <?php
                        $categorie = $pdo->query('SELECT * FROM categorie WHERE `id_user` = "'.$_SESSION['id'].'"');
                        $categorie->execute();
                        while ($donnees = $categorie->fetch()) {
                        ?>
                            <tr>
                                <td><?php echo $donnees['nom']; ?></td>
                                <td><?php echo $donnees['description']; ?></td>
                                <td><a href="modifcat?id=<?php echo $donnees['id']; ?>" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-cogs"></i>
                                    </a></td>
                                <td><a href="suppr_cat?id=<?php echo $donnees['id']; ?>" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a></td>
                            </tr>

                          
                        <?php



                        }
                        $categorie->closeCursor(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <!-- /.container-fluid -->

</div>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<?php include "../footer.php"; ?>