<?php
include( "../../assets/php/config.php" );


date_default_timezone_set( "Europe/Madrid" );
$id = $_POST[ 'id' ];

$sql3 = "SELECT * FROM pendiete WHERE USER_ID=:id";
$resultado4 = $cnt->prepare( $sql3 );
$resultado4->execute( array( ":id" => $id ) );
$fila = $resultado4->fetch( PDO::FETCH_ASSOC );

//**************************FOMULARIO ACOMPA************************//
$sql2 = "UPDATE `acompa` SET `NAME`=:name,`SURNAME`=:surname,`DNI`=:dni,`TELEFONO`=:tel,`EMAIL`=:email WHERE USER_ID=:id";
$respuesta2 = $cnt->prepare( $sql2 );
$respuesta2->execute( array( ":name" => "", ":surname" => "", ":dni" => "", ":tel" => "", ":email" => "", ":id" => $id ) );

//**************************FOMULARIO ASISTENTES************************//
$sql = "UPDATE `form` SET  `ACOMPA`=:acompa  WHERE ID=:id";
$respuesta = $cnt->prepare( $sql );
$respuesta->execute( array( ":acompa" => "No", ":id" => $id ) );

//**************************GESTION DE PAGO************************//
if ( $fila[ 'ACOMPA_ESTADO' ] == "PENDIENTE" ) {
    $sql1 = "UPDATE `pendiete` SET `ACOMPA_CUOTA`=:cuota,`ACOMPA_PAGO`=:cuota_pago,`ACOMPA_ESTADO`=:cuota_estado WHERE USER_ID=:id";
    $respuesta1 = $cnt->prepare( $sql1 );
    $respuesta1->execute( array( ":cuota" => 0.00, ":cuota_pago" => "", ":cuota_estado" => "", ":id" => $id ) );
} else if ( $fila[ 'ACOMPA_ESTADO' ] == "DEVOLUCION" ) {
    $sql1 = "UPDATE `pendiete` SET `ACOMPA_CUOTA`=:cuota,`ACOMPA_PAGO`=:cuota_pago,`ACOMPA_ESTADO`=:cuota_estado,`ACOMPA_APOYO`=:cuota_apoyo WHERE USER_ID=:id";
    $respuesta1 = $cnt->prepare( $sql1 );
    $respuesta1->execute( array( ":cuota" => 0.00, ":cuota_pago" => $fila[ 'ACOMPA_PAGO' ], ":cuota_estado" => "DEVOLUCION", ":cuota_apoyo" => $fila[ 'ACOMPA_APOYO' ] + $fila[ 'ACOMPA_CUOTA' ], ":id" => $id ) );
}else if ( $fila[ 'ACOMPA_ESTADO' ] == "PAGADO" and $fila[ 'ACOMPA_PAGO' ] != "FREE") {
    $sql1 = "UPDATE `pendiete` SET `ACOMPA_CUOTA`=:cuota,`ACOMPA_PAGO`=:cuota_pago,`ACOMPA_ESTADO`=:cuota_estado,`ACOMPA_APOYO`=:cuota_apoyo WHERE USER_ID=:id";
    $respuesta1 = $cnt->prepare( $sql1 );
    $respuesta1->execute( array( ":cuota" => 0.00, ":cuota_pago" => $fila[ 'ACOMPA_PAGO' ], ":cuota_estado" => "DEVOLUCION", ":cuota_apoyo" => $fila[ 'ACOMPA_CUOTA' ], ":id" => $id ) );
} else if ( $fila[ 'ACOMPA_ESTADO' ] == "PAGADO" and $fila[ 'ACOMPA_PAGO' ] == "FREE") {
    $sql1 = "UPDATE `pendiete` SET `ACOMPA_CUOTA`=:cuota,`ACOMPA_PAGO`=:cuota_pago,`ACOMPA_ESTADO`=:cuota_estado,`ACOMPA_APOYO`=:cuota_apoyo WHERE USER_ID=:id";
    $respuesta1 = $cnt->prepare( $sql1 );
    $respuesta1->execute( array( ":cuota" => 0.00, ":cuota_pago" => "", ":cuota_estado" => "", ":cuota_apoyo" =>0.00, ":id" => $id ) );
}

$sql = "SELECT * FROM pendiete WHERE USER_ID=:id";
$respuesta = $cnt->prepare( $sql );
$respuesta->execute( array( ":id" => $id ) );
$fila = $respuesta->fetch( PDO::FETCH_ASSOC );

if ( $fila[ 'CUOTA_ESTADO' ] == "PAGADO"
    and $fila[ 'ACOMPA_ESTADO' ] == "PAGADO"
    and $fila[ 'HOTEL_ESTADO' ] == "PAGADO" ) {
    $estado = 1;
} else if ( $fila[ 'CUOTA_ESTADO' ] == "PAGADO"
    and $fila[ 'ACOMPA_ESTADO' ] == "PAGADO"
    and $fila[ 'HOTEL_ESTADO' ] == "" ) {
    $estado = 1;
} else if ( $fila[ 'CUOTA_ESTADO' ] == "PAGADO"
    and $fila[ 'ACOMPA_ESTADO' ] == ""
    and $fila[ 'HOTEL_ESTADO' ] == "" ) {
    $estado = 1;
} else if ( $fila[ 'CUOTA_ESTADO' ] == "PAGADO"
    and $fila[ 'ACOMPA_ESTADO' ] == ""
    and $fila[ 'HOTEL_ESTADO' ] == "PAGADO" ) {
    $estado = 1;
} else {
    $estado = 0;
}
//**************************FOMULARIO ASISTENTES************************//
$sql = "UPDATE `form` SET `ESTADO`=:estado   WHERE ID=:id";
$respuesta = $cnt->prepare( $sql );
$respuesta->execute( array( ":estado" => $estado, ":id" => $id ) );
echo "ok";

?>