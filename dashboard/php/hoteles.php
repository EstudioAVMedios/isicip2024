<?php
include("../../assets/php/config.php");

$fecha=$_POST['fecha'];
$todas=$_POST['todas'];
$prebloqueo=$_POST['prebloqueo'];
$reservadas=$_POST['reservadas'];

$sql="UPDATE `hoteles` SET `TOTAL`=:total,`DISPONIBLES`=:dispo,`PRE_BLOQUEO`=:preblo WHERE FECHA=:fecha";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":total"=>$todas, ":dispo"=>$todas-$prebloqueo-$reservadas, ":preblo"=>$prebloqueo, ":fecha"=>$fecha));
echo "ok";

?>