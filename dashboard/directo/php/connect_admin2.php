<?php

include("../../../assets/php/config.php");

$preguntas=[];





$sql2="SELECT * FROM chatselect";



$resultado2=$cnt->prepare($sql2);



$resultado2->execute();



while($fila=$resultado2->fetch(PDO::FETCH_ASSOC)){



	$preguntas[]=$fila;



}



if($preguntas!=null){



$chat=json_encode($preguntas,JSON_FORCE_OBJECT);



echo $chat;	



}else{



	echo "empty";



}











?>