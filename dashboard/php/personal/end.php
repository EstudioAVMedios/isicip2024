<?php
include("../../../assets/php/config.php");
session_start();
$_SESSION[ 'user_evento_id' ]="";
session_destroy();
header("location:../../../");

?>