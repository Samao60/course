<?php 
$id = $_GET['id'];
$host = 'localhost';
$dbname = 'course';
$username = 'root';
$password = '';
  $dsn = "mysql:host=$host;dbname=$dbname";
  $pdo = new PDO($dsn, $username, $password);

  $sql = 'DELETE FROM `course`.`type` WHERE  `id`= '. $id .' ';
                        $res = $pdo->prepare($sql);
                        $exec = $res->execute();
                        
                        if($exec){
                            header('Location: type-aliments');
                        }
                        else {
                            echo 'Erreur';
                        }
