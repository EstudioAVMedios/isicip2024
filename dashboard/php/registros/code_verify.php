<?php
include("../../../assets/php/config.php");
$code=$_POST['code'];

if(empty($_POST['action'])){

$sql="SELECT * FROM codes WHERE CODE=:code";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":code"=>$code));
$count=$respuesta->rowCount();
if($count!=0){
$fila=$respuesta->fetch(PDO::FETCH_ASSOC);  

$sql="SELECT * FROM form WHERE CODE=:code";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":code"=>$code));
$cantidad=$respuesta->rowCount();

if($fila['CUPOS']>$cantidad){
echo $fila["ID"];
}else{
    echo "no";
}
}else{
    echo "no";
}

}else if($_POST['action']=="verify_descount"){

$sql="SELECT * FROM codes WHERE CODE=:code";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":code"=>$code));
$count=$respuesta->rowCount();
if($count!=0){
    $sql="SELECT * FROM cuotas WHERE PRECIO=:code";
    $respuesta=$cnt->prepare($sql);
    $respuesta->execute(array(":code"=>0));
    $fila=$respuesta->fetch(PDO::FETCH_ASSOC);
    echo base64_encode($fila['ID']. " " .$code);
}else{
    echo "nocode";
}

}else if($_POST['action']=="verify_meeting"){

    $sql="SELECT * FROM cuotas WHERE NAME=:code";
    $respuesta=$cnt->prepare($sql);
    $respuesta->execute(array(":code"=>$code));
    $count=$respuesta->fetch(PDO::FETCH_ASSOC);
    echo json_encode($count); 
    
    }
?>