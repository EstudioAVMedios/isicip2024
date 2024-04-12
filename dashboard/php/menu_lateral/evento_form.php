<?php

include( "../../../assets/php/config.php" );



$name=$_POST['evento_name'];
$finicio=$_POST['evento_finicio'];
$fcierre=$_POST['evento_fcierre'];
$email=$_POST['evento_email'];
$tel=$_POST['evento_tel'];
$empresa=$_POST['evento_empresa'];
$color=$_POST['evento_color'];

$sql="UPDATE `evento` SET 
`NAME`=:name,
`FECHA_INICIO`=:finicio,
`FECHA_CIERRE`=:fcierre,
`EMAIL_SECRETARIA`=:email,
`TEL_SECRETARIA`=:tel,
`EMPRESA_SECRETARIA`=:empresa,
`COLOR`=:color
WHERE 1=1";
$resultado=$cnt->prepare($sql);
$resultado->execute(array(":name"=>$name,":finicio"=>$finicio,":fcierre"=>$fcierre,":email"=>$email,":tel"=>$tel,":empresa"=>$empresa,":color"=>$color));
echo "ok";
?>