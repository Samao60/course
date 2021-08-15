<?php 
 if(isset($_POST['envoiphoto'])) {
     $tmpName = $_FILES['photoprofil']['tmp_name'];
     $nameimg = $_FILES['photoprofil']['name'];
     $size = $_FILES['photoprofil']['size'];
     $error = $_FILES['photoprofil']['error'];

     $sql = 'UPDATE `user` (`profil_img`) VALUES (:name) WHERE `id` = '. $id .' ';
     $res = $pdo->prepare($sql);
     $exec = $res->execute(array(":name"=>$nameimg));
     if($exec) {
         echo 'YES';
         move_uploaded_file($tmpName, '/upload/profil/'.$nameimg);
     }
     else {
         echo 'error';
     }
 }
 echo 'salut';
?>