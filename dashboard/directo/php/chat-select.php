<?php



include("../../../assets/php/config.php");


date_default_timezone_set("Europe/Madrid");



$name=$_POST['name'];
$question=$_POST['chat'];


$preguntas=[];

$sql3= "UPDATE chat SET STATE=:estado WHERE QUESTION=:chat";
$resultado3=$cnt->prepare($sql3);
$resultado3->execute(array(":estado"=>1,":chat"=>$question));
$fila=$resultado3->rowCount();

$sql2= "SELECT * FROM chatselect WHERE CHAT=:chat";
$resultado2=$cnt->prepare($sql2);
$resultado2->execute(array(":chat"=>$question));
$fila=$resultado2->rowCount();
if($fila!=0){
	
}else{


$sql= "INSERT INTO chatselect (NAME, CHAT, DATE) VALUE (:user, :question, :date)";



$resultado=$cnt->prepare($sql);



$resultado->execute(array(":user"=>$name,":question"=>$question, ":date"=>date("F j, Y, g:i a")));	
}





echo "success";

?>