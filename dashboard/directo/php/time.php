<?php

include("../../../assets/php/config.php");
session_start();
$name = $_SESSION['user_evento_id_directo']['name'] . " " . $_SESSION['user_evento_id_directo']['surname'];
$email = $_SESSION['user_evento_id_directo']['email'];
$time = $_POST['time'];

$sql = "SELECT * FROM TIME WHERE EMAIL= :email";
$resultado = $cnt->prepare($sql);
$resultado->execute(array(":email" => $email));
$fila = $resultado->rowCount();
$fila2 = $resultado->fetch(PDO::FETCH_ASSOC);

if ($fila != 0) {
    $time = intval($time) + intval($fila2['TIME']);
    $sql2 = "UPDATE TIME SET TIME = :time WHERE EMAIL= :email";
    $resultado2 = $cnt->prepare($sql2);
    $resultado2->execute(array(":time" => $time, ":email" => $email));
    echo "actualizado";
} else {

    $sql2 = "INSERT INTO TIME (NAME, EMAIL, TIME) VALUES (:name, :email, :time)";
    $resultado2 = $cnt->prepare($sql2);
    $resultado2->execute(array(":name" => $name, ":email" => $email, ":time" => $time));
    echo "Inscrito";
}
