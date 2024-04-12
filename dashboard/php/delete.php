<?php 



include("../../connect/config.php");



$programa=[];

if($_POST['titulo_p']!=""){

	

$titulo=$_POST['titulo_p'];	

$date=$_POST['date'];



$sql="DELETE FROM programa WHERE TITULO = :titulo AND DATE=:date ";

$resultado=$cnt->prepare($sql);

$resultado->execute(array(":titulo"=>$titulo,":date"=>$date));

	

	echo "success";

}



$sql2="SELECT * FROM programa ORDER BY ID";

$resultado2=$cnt->prepare($sql2);

$resultado2->execute();

while($fila=$resultado2->fetch(PDO::FETCH_ASSOC)){

	$programa[]=$fila;

}



$file='../../info/programa.json';

file_put_contents($file,json_encode($programa));

header('location:../index.php')

?>