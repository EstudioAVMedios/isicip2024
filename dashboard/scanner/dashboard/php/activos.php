<?php
include("../../../../assets/php/config.php");


$sql="SELECT * FROM form WHERE VISIBILIDAD=:visi";
$resultado=$cnt->prepare($sql);
$resultado->execute(array(":visi"=>0));
$usuarios=[];
while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
	$usuarios[]=$fila;
}
$respuesta=json_encode($usuarios);
echo $respuesta;





?>