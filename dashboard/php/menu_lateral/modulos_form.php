<?php
include("../../../assets/php/config.php");

if(!empty($_POST['consulta'])){
$sql='SELECT * FROM `generales_form`';
$resultado=$cnt->prepare($sql);
$resultado->execute();
$fila=$resultado->fetch(PDO::FETCH_ASSOC);
echo json_encode($fila);
}else{
if($_POST['factura'] == "on"):$fact=1;else:$fact=0;endif;
if($_POST['acompa'] == "on"):$acompa=1;else:$acompa=0;endif;
if($_POST['alojamiento'] == "on"):$aloja=1;else:$aloja=0;endif;
if($_POST['ser'] == "on"):$ser=1;else:$ser=0;endif;
if($_POST['profesional'] == "on"):$prof=1;else:$prof=0;endif;


$sql='UPDATE `generales_form` SET `ESTADO_FACTURA`=:fact,`ESTADO_ACOMPA`=:acompa,`ESTADO_ALOJAMIENTO`=:aloja,`ESTADO_EXTRAS`=:ser,`ESTADO_PROF`=:prof WHERE ID=4';
$resultado=$cnt->prepare($sql);
$resultado->execute(array(":fact"=>$fact,":acompa"=>$acompa,":aloja"=>$aloja,":ser"=>$ser,":prof"=>$prof));
echo "ok";	
}

?>
