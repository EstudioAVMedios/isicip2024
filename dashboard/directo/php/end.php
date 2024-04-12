<?php

session_start();

include("../../../assets/php/config.php");

$email=$_SESSION['logged_in_user_id'];

$id=$_SESSION['id_num'];

date_default_timezone_set("Europe/Madrid");



$sql2="UPDATE Login_directo SET LOGOUT_DATE=:logout WHERE EMAIL=:email AND LOGOUT_DATE=''" ;

$resultado2=$cnt->prepare($sql2);

$resultado2->execute(array(":logout"=>date("F j, Y, g:i a"),":email"=>$email));





$_SESSION['logged_in_user_name']="";



$_SESSION['logged_in_user_id']="";



session_destroy();



header("location:../../");







?>