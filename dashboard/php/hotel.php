<?php
include( "../../assets/php/config.php" );
$id = $_POST[ 'id' ];
$id_reserva = $_POST[ 'id_reserva' ];


$sql = "SELECT * FROM reservas_hotel WHERE ID=:id";
$respuesta = $cnt->prepare( $sql );
$respuesta->execute( array( ":id" => $id_reserva ) );
$datos=$respuesta->fetch(PDO::FETCH_ASSOC);


//**************************FORMULARIO HOTELES************************//
$sql4 = "SELECT * FROM hoteles";
$respuesta4 = $cnt->prepare( $sql4 );
$respuesta4->execute();
while ( $dato_hab = $respuesta4->fetch( PDO::FETCH_ASSOC ) ) {
    $habitaciones[] = $dato_hab;
}

for ( $i = 0; $i <= ( $datos[ 'NOCHES' ] - 1 ); $i++ ) {
    $aumento = 0;
    $aumento = substr( $datos[ 'F_ENTRADA' ], -2, 2 ) + $i;
    $final = sprintf( '%02d', $aumento );
    $fechas2[] = substr( $habitaciones[ 0 ][ 'FECHA' ], 0, -2 ) . $final;

}

foreach ( $fechas2 as $fecha ) {
    foreach ( $habitaciones as $elemento ) {
        if ( $elemento[ 'FECHA' ] == $fecha ) {
            $sql5 = "UPDATE `hoteles` SET `RESERVADAS`=:reservadas,`DISPONIBLES`=:dispo WHERE FECHA=:fecha";
            $respuesta5 = $cnt->prepare( $sql5 );
            $respuesta5->execute( array( ":reservadas" => $elemento[ 'RESERVADAS' ] - 1, ":dispo" => $elemento[ 'DISPONIBLES' ] + 1, ":fecha" => $fecha ) );
        }
    }
}

$sql = "UPDATE `reservas_hotel` SET `F_ENTRADA`=:fentrada, `F_SALIDA`=:fsalida, `HABITACION`=:hab, `NOCHES`=:noches WHERE ID=:id";
$respuesta = $cnt->prepare( $sql );
$respuesta->execute( array( ":fentrada" => "", ":fsalida" => "", ":hab" => "", ":noches" => 0, ":id" => $id_reserva ) );


$sql4 = "SELECT * FROM reservas_hotel WHERE USER_ID=:id AND ID=:id_reserva";
$respuesta4 = $cnt->prepare( $sql4 );
$respuesta4->execute( array( ":id" => $_POST[ 'id' ], ":id_reserva" => $id_reserva ) );
$dato_hotel = $respuesta4->fetch( PDO::FETCH_ASSOC );


if ( $dato_hotel[ 'HOTEL_ESTADO' ] == "PENDIENTE"  and $dato_hotel[ 'HOTEL_CUOTA' ] != 0 ) {

    $cuota = 0;
    $estado_pago = "DEVOLUCION";
    $apoyo = $dato_hotel[ 'HOTEL_CUOTA' ] - $dato_hotel[ 'HOTEL_APOYO' ];
    $m_pago = $dato_hotel[ 'HOTEL_PAGO' ];
    $sql1 = "UPDATE `reservas_hotel` SET `HOTEL_CUOTA`=:cuota,`HOTEL_PAGO`=:hotel_pago,`HOTEL_ESTADO`=:hotel_estado,`HOTEL_APOYO`=:hotel_apoyo WHERE USER_ID=:id AND ID=:id_reserva";
    $respuesta1 = $cnt->prepare( $sql1 );
    $respuesta1->execute( array( ":cuota" => $cuota, ":hotel_pago" => $m_pago, ":hotel_estado" => $estado_pago, ":hotel_apoyo" => $apoyo, ":id" => $_POST[ 'id' ], ":id_reserva" => $id_reserva ) );
} else if ( $dato_hotel[ 'HOTEL_ESTADO' ] == "PENDIENTE" and $dato_hotel[ 'HOTEL_CUOTA' ] == 0 ) {

    $sql1 = "DELETE FROM `reservas_hotel` WHERE ID=:id";
    $respuesta1 = $cnt->prepare( $sql1 );
    $respuesta1->execute( array( ":id" => $id_reserva ) );

} else if ( $dato_hotel[ 'HOTEL_ESTADO' ] == "DEVOLUCION"  and $dato_hotel[ 'HOTEL_CUOTA' ] != 0 ) {

    $cuota = 0;
    $estado_pago = $dato_hotel[ 'HOTEL_ESTADO' ];
    $apoyo = $dato_hotel[ 'HOTEL_CUOTA' ] + $dato_hotel[ 'HOTEL_APOYO' ];
    $m_pago = $dato_hotel[ 'HOTEL_PAGO' ];
    $sql1 = "UPDATE `reservas_hotel` SET `HOTEL_CUOTA`=:cuota,`HOTEL_PAGO`=:hotel_pago,`HOTEL_ESTADO`=:hotel_estado,`HOTEL_APOYO`=:hotel_apoyo WHERE USER_ID=:id AND ID=:id_reserva";
    $respuesta1 = $cnt->prepare( $sql1 );
    $respuesta1->execute( array( ":cuota" => $cuota, ":hotel_pago" => $m_pago, ":hotel_estado" => $estado_pago, ":hotel_apoyo" => $apoyo, ":id" => $_POST[ 'id' ], ":id_reserva" => $id_reserva ) );
} else if ( $dato_hotel[ 'HOTEL_ESTADO' ] == "PAGADO" and $dato_hotel[ 'HOTEL_CUOTA' ] != 0 ) {

    $cuota = 0;
    $estado_pago = "DEVOLUCION";
    $apoyo = $dato_hotel[ 'HOTEL_CUOTA' ];
    $m_pago = $dato_hotel[ 'HOTEL_PAGO' ];
    $sql1 = "UPDATE `reservas_hotel` SET `HOTEL_CUOTA`=:cuota,`HOTEL_PAGO`=:hotel_pago,`HOTEL_ESTADO`=:hotel_estado,`HOTEL_APOYO`=:hotel_apoyo WHERE USER_ID=:id AND ID=:id_reserva";
    $respuesta1 = $cnt->prepare( $sql1 );
    $respuesta1->execute( array( ":cuota" => $cuota, ":hotel_pago" => $m_pago, ":hotel_estado" => $estado_pago, ":hotel_apoyo" => $apoyo, ":id" => $_POST[ 'id' ], ":id_reserva" => $id_reserva ) );
}else if ( $dato_hotel[ 'HOTEL_ESTADO' ] == "PAGADO"   and $dato_hotel[ 'HOTEL_CUOTA' ] == 0 and $dato_hotel[ 'HOTEL_PAGO' ] == "FREE") { 

     $sql1 = "DELETE FROM `reservas_hotel` WHERE ID=:id";
    $respuesta1 = $cnt->prepare( $sql1 );
    $respuesta1->execute( array( ":id" => $id_reserva ) );
}




   $sql = "SELECT * FROM pendiete WHERE USER_ID=:id";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute( array( ":id" => $id ) );
    $fila = $respuesta->fetch( PDO::FETCH_ASSOC );

    if ( $fila[ 'CUOTA_ESTADO' ] == "PAGADO"  and $fila[ 'ACOMPA_ESTADO' ] == "PAGADO"  ) {
        $estado_cuotas = 1;
    } else if ( $fila[ 'CUOTA_ESTADO' ] == "PAGADO" and $fila[ 'ACOMPA_ESTADO' ] == "" ) {
        $estado_cuotas = 1;
    } else {
        $estado_cuotas = 0;
    }
	$count=0;
	$sql = "SELECT * FROM reservas_hotel WHERE USER_ID=:id";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute( array( ":id" => $id ) );
	while($fila = $respuesta->fetch( PDO::FETCH_ASSOC )){
		if($fila['HOTEL_ESTADO']=="PENDIENTE"){
			$estado_reserva=0;
			$count++;
		}else if($fila['HOTEL_ESTADO']=="DEVOLUCION"){
			$estado_reserva=0;
			$count++;
		}else if($fila['HOTEL_ESTADO']=="PAGADO"){
			$estado_reserva=1;
		}
	}
    
	if($estado_cuotas==1 and $count==0){
		$estado=1;
	}else{
		$estado=0;
	}

    //**************************FOMULARIO ASISTENTES************************//
    $sql = "UPDATE `form` SET `ESTADO`=:estado   WHERE ID=:id";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute( array( ":estado" => $estado, ":id" => $id ) );

echo "ok";
?>