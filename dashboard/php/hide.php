<?php
include( "../../assets/php/config.php" );
date_default_timezone_set( "Europe/Madrid" );

$id=$_POST['id'];
if($_POST['hide']=="True"){
	
$sql="UPDATE `form` SET `VISIBILIDAD`=:visi WHERE ID=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":visi"=>1,":id"=>$id));	
	
}else{
	
$sql="UPDATE `form` SET `VISIBILIDAD`=:visi WHERE ID=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":visi"=>0,":id"=>$id));	
	
}

echo"ok";

?>