<?php
include("../../../assets/php/config.php");

$email = $_POST['email'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM form WHERE EMAIL=:email AND VISIBILIDAD=:visi";
$resuelto = $cnt->prepare($sql);
$resuelto->execute(array(":email" => $email, ":visi" => 0));
$fila = $resuelto->rowCount();

if ($fila == 1) {
	$fila2 = $resuelto->fetch(PDO::FETCH_ASSOC);
	if (password_verify($pass, $fila2['PASS'])) {
		session_start();
		$_SESSION['user_evento_id']['ID'] = $fila2['ID'];
		$_SESSION['user_evento_id_directo']['name'] = $fila2['NAME'];
		$_SESSION['user_evento_id_directo']['surname'] = $fila2['SURNAME'];
		$_SESSION['user_evento_id_directo']['email'] = $fila2['EMAIL'];
		echo "ok";
	} else {
		echo "pass";
	}
} else {
	echo "email";
}