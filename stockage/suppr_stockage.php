<?php
include '../connexion.php';
include '../verif_session.php';
$id = $_GET['id'];
$id_user = $_SESSION['id'];

$sql = 'DELETE FROM `course`.`stockage` WHERE  `id`= ' . $id . ' AND `id_user` = "'. $id_user .'" ';
$res = $pdo->prepare($sql);
$exec = $res->execute();

if ($exec) {
    header('Location: gestion-des-stockages');
} else {
    echo 'Erreur';
}
