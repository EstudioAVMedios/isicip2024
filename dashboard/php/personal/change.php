<?php
include("../../../assets/php/config.php");

$pass=password_hash( $_POST['pass1'], PASSWORD_DEFAULT );
$email=$_POST['email'];

$sql="SELECT * FROM form WHERE EMAIL='$email'";
$respuesta=$cnt->prepare($sql);
$respuesta->execute();
$count=$respuesta->rowCount();
if($count==0){
echo "email";
}else{
$sql="UPDATE `form` SET `PASS`='$pass' WHERE EMAIL='$email'";
$respuesta=$cnt->prepare($sql);
$respuesta->execute();
    echo "ok";
}



?>