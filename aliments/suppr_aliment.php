<?php
include '../connexion.php'; 

$id = $_GET['id'];

$sql = 'UPDATE `course`.`aliments_frigo` SET `consomer` = 3 WHERE `id` = "'. $id .'"';
$exec = $pdo->exec($sql);

if($exec) {
    header('Location: contenu-du-stockage');
}

