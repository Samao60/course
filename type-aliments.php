<?php include "header.php";
include 'connexion.php'; ?>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Add categorie Modal-->
    <div class="modal fade" id="addtypemodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vous voulez ajouter un type d'aliment ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="envoitype" action="" method="post">
                        <div class="form-groug" style="margin-bottom: 1rem;">
                            <input type="text" class="form-control" id="type_name" name="type_name" placeholder="Nom du type d'aliment">
                        </div>
                        <div class="form-groug" style="margin-bottom: 1rem;">
                            <textarea name="type_description" id="type_descrpition" placeholder="Description du type d'aliment" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success" id="envoi" name='envoi'>Valider</button>
                    </form>
                    <!-- Envoi en BDD -->
                    <?php if (isset($_POST['envoi'])) {
                        //connexion à la bdd

                        //recupération des valeurs
                        $type_name = $_POST['type_name'];
                        $type_description = $_POST['type_description'];
                        //Requête
                        $sql = 'INSERT INTO `course`.`type` (`nom`, `description`) VALUES (:nom,:description)';
                        $res = $pdo->prepare($sql);
                        $exec = $res->execute(array(':nom' => $type_name, ':description' => $type_description));

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
    <h1 class="h3 mb-4 text-gray-800">Les types d'aliments</h1>
    <p class="mb-4"> <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#addtypemodal">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Ajouter un type d'aliment</span>
        </a></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Les types d'aliments</h6>
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
                        $categorie = $pdo->query('SELECT * FROM type');
                        $categorie->execute();
                        while ($donnees = $categorie->fetch()) {
                        ?>
                            <tr>
                                <td><?php echo $donnees['nom']; ?></td>
                                <td><?php echo $donnees['description']; ?></td>
                                <td><a href="#" data-toggle="modal" data-target="#modifcatmodal" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-cogs"></i>
                                    </a></td>
                                <td><a href="suppr_type?id=<?php echo $donnees['id']; ?>" class="btn btn-danger btn-circle btn-sm">
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
    $("#envoi").submit().location.reload;
</script>
<?php include "footer.php"; ?>