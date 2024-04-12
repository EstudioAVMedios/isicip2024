<?php

if ( $_POST[ 'ID' ] ) {

    include( "../../assets/php/config.php" );
  
    date_default_timezone_set( "Europe/Madrid" );

    $sql = 'SELECT * FROM contactos WHERE ID=:id';
    $resultado = $cnt->prepare( $sql );
    $resultado->execute( array( ":id" => $_POST[ 'ID' ] ) );
    $fila = $resultado->fetch( PDO::FETCH_ASSOC );

	  $sql1 = 'UPDATE `contactos` SET `LEIDO`=1 WHERE ID=:id';
    $resultado1 = $cnt->prepare( $sql1 );
    $resultado1->execute( array( ":id" => $_POST[ 'ID' ] ) );
  


  echo json_encode($fila);
}


?>