<?php
include( "../../assets/php/config.php" );
$id = $_POST[ 'id' ];
if($_POST['get']=="no"):

$sql = 'SELECT * FROM reservas_hotel WHERE USER_ID=:id';
$resultado = $cnt->prepare( $sql );
$resultado->execute( array( ":id" => $id ) );
while($fila1 = $resultado->fetch( PDO::FETCH_ASSOC )){
	$reservas[]=$fila1;
}

$datos=json_encode($reservas);
echo $datos;

else:
$sql = 'SELECT * FROM reservas_hotel WHERE ID=:id';
$resultado = $cnt->prepare( $sql );
$resultado->execute( array( ":id" => $id ) );
while($fila1 = $resultado->fetch( PDO::FETCH_ASSOC )){
	$reservas[]=$fila1;
}
$datos=json_encode($reservas);
echo $datos;
endif;
?>