<?php include "../header.php";
include '../connexion.php'; ?>
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Gestion du contenu des stockage</h1>
    <p class="mb-4"> <a href="ajouter-un-aliment" class="btn btn-success btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Ajouter un aliment</span>
        </a></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Contenu des stockages</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Catégorie</th>
                            <th>DLC</th>
                            <th>Stockage</th>
                            <th>Consommer</th>
                            <th>Modifier</th>
                            <th>Jeter</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Catégorie</th>
                            <th>DLC</th>
                            <th>Stockage</th>
                            <th>Consommer</th>
                            <th>Modifier</th>
                            <th>Jeter</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $id_user = $_SESSION['id'];
                        $categorie = $pdo->query('SELECT * FROM aliments_frigo WHERE `id_user` = "' . $id_user . '" AND `consomer` = 1 ');
                        $categorie->execute();
                        while ($donnees = $categorie->fetch()) {
                            $date_dlc_base = $donnees['dlc'];
                            $date_day = date('Y-m-d');
                            $date_day_5 = date('Y-m-d', strtotime($date_day. ' + 5 days'));
                            $date_day_10 = date('Y-m-d', strtotime($date_day. ' + 10 days'));
                        ?>
                            <tr>
                                <td><?php echo $donnees['nom']; ?></td>
                                <td><?php echo $donnees['description']; ?></td>
                                <td><?php echo $donnees['categorie']; ?></td>
                                <td id="dlc" class="<?php if($date_day_5 >= $date_dlc_base) {echo 'danger';}elseif ($date_day_10 >= $date_dlc_base){echo 'warning';}
                                        elseif ($date_day_10 <= $date_dlc_base) {echo '';}
                                    ?>"><?php $date_dlc = new DateTime('' . $donnees['dlc'] . '');
                                    echo $date_dlc->format('d-m-Y'); ?></td>
                                <td><?php echo $donnees['stockage']; ?></td>

                                <td><a href="aliment_consommer?id=<?php echo $donnees['id']; ?>" class="btn btn-success btn-circle">
                                        <i class="fas fa-check"></i>
                                    </a></td>
                                <td><a href="modif_aliment?id=<?php echo $donnees['id']; ?>" class="btn btn-warning btn-circle">
                                        <i class="fas fa-cogs"></i>
                                    </a></td>
                                <td><a href="suppr_aliment?id=<?php echo $donnees['id']; ?>" class="btn btn-danger btn-circle">
                                        <i class="fas fa-recycle"></i>
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

<?php include "../footer.php"; ?>