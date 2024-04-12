<?php
include( "../../assets/php/config.php" );

if($_POST['filtro']){
	
		$sql1="UPDATE columns SET ESTADO=:estado WHERE '1'='1'";
		$resultado1=$cnt->prepare($sql1);
		$resultado1->execute(array(":estado"=>0));	
	
	foreach($_POST['filtro'] as $elemento){
		
		$sql="UPDATE columns SET ESTADO=:estado WHERE COLUMNS=:columns";
		$resultado=$cnt->prepare($sql);
		$resultado->execute(array(":estado"=>1, ":columns"=>$elemento));		

	}
echo "ok";
}else{
echo "no llega";
}

?>