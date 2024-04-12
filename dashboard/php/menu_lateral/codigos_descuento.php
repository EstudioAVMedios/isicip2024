<?php
include("../../../assets/php/config.php");
if($_POST['create']){
    $codigo=$_POST['codigo'];
    $cupos=$_POST['cupos'];
    
    $sql="INSERT INTO `codes`( `CODE`, `CUPOS`) VALUES (:code,:cupos)";
    $respuesta=$cnt->prepare($sql);
    $respuesta->execute(array(":code"=>$codigo,":cupos"=>$cupos));

    $sql="INSERT INTO `CATEGORIAS`(`NAME`, `CUOTA_ASOCIADA`) VALUES (:name,:cuota)";
    $respuesta=$cnt->prepare($sql);
    $respuesta->execute(array(":name"=>$codigo,":cuota"=>"Sin coste"));
    
    echo "ok";
}
if($_POST['delete']){
    $id=$_POST['id'];
    $sql="SELECT * FROM `codes` WHERE ID=:id";
    $respuesta=$cnt->prepare($sql);
    $respuesta->execute(array(":id"=>$id));
    $fila=$respuesta->fetch(PDO::FETCH_ASSOC);

    $sql="DELETE FROM `codes` WHERE ID=:id";
    $respuesta=$cnt->prepare($sql);
    $respuesta->execute(array(":id"=>$id));

    $sql="DELETE FROM `CATEGORIAS` WHERE NAME=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":id"=>$fila['CODE']));

    echo "ok";
}

if($_POST['edit']){
    $id=$_POST['id'];
    $codigo=$_POST['codigo'];
    $cupos=$_POST['cupos'];
    
 $sql="UPDATE `codes` SET `CODE`=:code,`CUPOS`=:cupos WHERE ID=:id";
 $respuesta=$cnt->prepare($sql);
 $respuesta->execute(array(":code"=>$codigo,":cupos"=>$cupos,":id"=>$id));
 echo "ok";
}



?>