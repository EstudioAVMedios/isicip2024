<?php
include( "../../assets/php/config.php" );
date_default_timezone_set( "Europe/Madrid" );
$id = $_POST[ 'id' ];
if($_POST["hotel"]=="no"):

$sql="SELECT * FROM pendiete WHERE USER_ID=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":id"=>$id));
$fila=$respuesta->fetch(PDO::FETCH_ASSOC);

echo json_encode($fila);

elseif($_POST["hotel"]=="si"):

$sql="SELECT * FROM reservas_hotel WHERE USER_ID=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":id"=>$id));

while($fila=$respuesta->fetch(PDO::FETCH_ASSOC)){
	$reservas[]=$fila;
}
echo json_encode($reservas);
endif;
?>