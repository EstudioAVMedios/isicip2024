<?php

include( "../../../assets/php/config.php" );
$id=$_POST['id'];

if($_POST['delete']=="no" and $_POST['update']=="no"){	
$name=$_POST['evento_name'];
$finicio=$_POST['evento_finicio'];
$fcierre=$_POST['evento_fcierre'];
$email=$_POST['evento_email'];
$tel=$_POST['evento_tel'];

$sql="SELECT * FROM habitaciones WHERE ID=:id";
$resultado=$cnt->prepare($sql);
$resultado->execute(array(":id"=>$id));
$fila=$resultado->fetch(PDO::FETCH_ASSOC);
echo json_encode($fila);
	
}else if($_POST['delete']=="no" and $_POST['update']=="si"){
$habitacion=$_POST['hab_name'];
$precio=$_POST['hab_precio'];
$hotel=$_POST['hab_hotel'];
$tipo=$_POST['hab_tipo'];
if($id!=0){	
$sql="UPDATE `habitaciones` SET 
`HABITACION`=:HABITACION,
`PRECIO`=:PRECIO,
`HOTEL`=:HOTEL,
`TIPO`=:TIPO WHERE ID=:id";	
$resultado=$cnt->prepare($sql);
$resultado->execute(array(
":HABITACION"=>$habitacion,
":PRECIO"=>$precio,
":HOTEL"=>$hotel,
":TIPO"=>$tipo,
":id"=>$id));	
echo $tipo;	
}else{
	
$sql="INSERT INTO `habitaciones`(
`HABITACION`,
`PRECIO`,
`HOTEL`,
`TIPO`) VALUES (
:HABITACION,
:PRECIO,
:HOTEL,
:TIPO
)";	
$resultado=$cnt->prepare($sql);
$resultado->execute(array(
":HABITACION"=>$habitacion,
":PRECIO"=>$precio,
":HOTEL"=>$hotel,
":TIPO"=>$tipo
));	
echo $tipo;
}

}else{
	
$sql="DELETE FROM `habitaciones` WHERE ID=$id";
$resultado=$cnt->prepare($sql);
$resultado->execute();	
echo "ok";	
}

?>