<?php

include( "../../assets/php/config.php" );

$categoria=$_POST['categoria'];
$id=$_POST['id'];
$asociada=$_POST['categoria_asociada'] ?? "";
if($_POST['create']){
$sql="INSERT INTO `CATEGORIAS`(`NAME`,CUOTA_ASOCIADA) VALUES ('$categoria','$asociada')";
$respuesta=$cnt->prepare($sql);
$respuesta->execute();	
response("");
}
if($_POST['getData']){
    $categoria=$_POST['categoria'];
    $sql="SELECT * FROM `CATEGORIAS` WHERE NAME=:categoria";
    $respuesta=$cnt->prepare($sql);
    $respuesta->execute(array(":categoria"=>$categoria));
    $fila=$respuesta->fetch(PDO::FETCH_ASSOC);
response($fila['CUOTA_ASOCIADA']);
}
if($_POST['edit']){
$sql="UPDATE `CATEGORIAS` SET `NAME`=:name,`CUOTA_ASOCIADA`=:cuota WHERE ID=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":name"=>$categoria, ":cuota"=>$asociada,":id"=>$id));	
response("");
}

if($_POST['delete']){
$sql="DELETE FROM `CATEGORIAS` WHERE ID=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":id"=>$id));		
response("");
}
function response($value){
if($value){
echo $value;
}else{
echo "ok";
}
}

?>