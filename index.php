<?php include "header.php"; 
include 'connexion.php'; 
?>

<!-- Begin Page Content -->
<div class="container-fluid">
<div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Nombre d'aliments dans les stockages</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php $nRows = $pdo->query('SELECT count(*) from `aliments_frigo` where `id_user` = "'.$_SESSION['id'].'" and `consomer` = 1 ')->fetchColumn(); 
                                            echo $nRows;?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Aliments consommer avant la DLC</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php $nRows = $pdo->query('SELECT count(*) from `aliments_frigo` where `id_user` = "'.$_SESSION['id'].'" and `consomer` = 2 ')->fetchColumn(); 
                                            echo $nRows;?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Aliments consommer avant la DLC</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php $nRows = $pdo->query('SELECT count(*) from `aliments_frigo` where `id_user` = "'.$_SESSION['id'].'" and `consomer` = 3 ')->fetchColumn(); 
                                            echo $nRows;?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                      
<!-- /.container-fluid -->

<!-- End of Main Content -->
</div>
<div class="row">
    <div class="col">
        <h3>Les 5 aliments les plus proche de la DLC</h3>
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Contenu des stockages</h6>
        </div>
        <div class="card-body">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">DLC</th>
    </tr>
  </thead>
  <tbody> <?php
  $id_user = $_SESSION['id'];
                        $categorie = $pdo->query('SELECT * FROM aliments_frigo WHERE `id_user` = "' . $id_user . '" AND `consomer` = 1 ORDER BY `dlc` ASC LIMIT 5');
                        $categorie->execute();
                        while ($donnees = $categorie->fetch()) { ?>
                        <?php $date_dlc = $donnees['dlc']; ?>
    <tr>
      <td><?= $donnees['nom']?></td>
      <td><?php $date_dlc = new DateTime('' . $donnees['dlc'] . '');echo $date_dlc->format('d-m-Y'); ?></td>
    </tr>
    <?php



}
$categorie->closeCursor(); ?>
  </tbody>
</table>
        </div>
    </div>
    </div>
    <div class="col"></div>
</div>
</div>
<!-- Footer -->

<?php include "footer.php"; ?>