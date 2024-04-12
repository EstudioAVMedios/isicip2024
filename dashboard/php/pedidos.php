<?php 

    include( "../../assets/php/config.php" );
$id=$_POST['id'];
    $sql2 = "SELECT * FROM pedidos WHERE USER_ID=:id";
    $resultado2 = $cnt->prepare( $sql2 );
    $resultado2->execute( array( ":id" => $id ) );
$fila=$resultado2->rowCount();


if($fila ==0){
	echo $id;
}else{
	$pedidos=[];
	while($fila2=$resultado2->fetch(PDO::FETCH_ASSOC)){
		$pedidos[]=$fila2;
	}
	echo json_encode($pedidos);
}
	
?>