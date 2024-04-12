<?php

include("../../../assets/php/config.php");
session_start();

date_default_timezone_set("Europe/Madrid");

$user=$_SESSION['user_evento_id_directo']['name']." ".$_SESSION['user_evento_id_directo']['surname'];
$email=$_SESSION['user_evento_id_directo']['email'];
$preguntas=[];

if($_POST['question']!=""){
$question=$_POST['question'];
$sql= "INSERT INTO chat (NAME, EMAIL, QUESTION, DATE) VALUE (:user, :email, :question, :date)";
$resultado=$cnt->prepare($sql);
$resultado->execute(array(":user"=>$user, ":email"=>$email, ":question"=>$question, ":date"=>date("F j, Y, g:i a")));
}

$sql2="SELECT * FROM chat WHERE EMAIL= :email";
$resultado2=$cnt->prepare($sql2);
$resultado2->execute(array(":email"=>$email));
while($fila=$resultado2->fetch(PDO::FETCH_ASSOC)){
	$preguntas[]= array("NAME"=>$fila["NAME"],"QUESTION"=>$fila['QUESTION'],"DATE"=>$fila['DATE']);
}
if($preguntas!=null){
$chat=json_encode($preguntas,JSON_FORCE_OBJECT);
echo $chat;	
}else{
	echo "empty";
}











?>