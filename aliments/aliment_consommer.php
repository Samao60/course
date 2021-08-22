<?php
include '../connexion.php'; 

$id = $_GET['id'];

$sql = 'UPDATE `course`.`aliments_frigo` SET `consomer` = 2 WHERE `id` = "'. $id .'"';
$exec = $pdo->exec($sql);

if($exec) {
    echo 'test';
    header('Location: contenu-du-stockage');
}
else {
    echo 'error';
}
