<?php
include( "../../assets/php/config.php" );


date_default_timezone_set( "Europe/Madrid" );
$id = $_POST[ 'id' ];
if ( $id != "" ) {
    if ( $_POST[ 'acompanante' ] ) {
        //***************ACOMPÑANTE*************//
        $aname = $_POST[ 'aname' ];
        $asurname = $_POST[ 'asurname' ];
        $adni = $_POST[ 'adni' ];
        $atel = $_POST[ 'atel' ];
        $aemail = $_POST[ 'aemail' ];

        $cuota = $_POST[ 'CUOTA' ];
        $m_pago = $_POST[ 'PAGO' ];
        $estado_pago = $_POST[ 'ESTADO' ];
        $apoyo = $_POST[ 'CUOTA_APOYO' ];

        if ( $_POST[ 'aname' ] != ""
            or $_POST[ 'asurname' ] != ""
            or $_POST[ 'aemail' ] != ""
            or $_POST[ 'adni' ] != ""
            or $_POST[ 'atel' ] != "" ) {

            //**************************FOMULARIO ACOMPANANTE************************//
            $sql2 = "UPDATE `acompa` SET `NAME`=:name,`SURNAME`=:surname,`DNI`=:dni,`TELEFONO`=:tel,`EMAIL`=:email WHERE USER_ID=:id";
            $respuesta2 = $cnt->prepare( $sql2 );
            $respuesta2->execute( array( ":name" => $aname, ":surname" => $asurname, ":dni" => $adni, ":tel" => $atel, ":email" => $aemail, ":id" => $id ) );


            //**************************FOMULARIO ASISTENTES************************//
            $sql = "UPDATE `form` SET `ACOMPA`=:acompa WHERE ID=:id";
            $respuesta = $cnt->prepare( $sql );
            $respuesta->execute( array( ":acompa" => "Si", ":id" => $id ) );

            //****************GESTION DE PAGO******************//	

            $sql1 = "UPDATE `pendiete` SET `ACOMPA_CUOTA`=:cuota,`ACOMPA_PAGO`=:cuota_pago,`ACOMPA_ESTADO`=:cuota_estado,`ACOMPA_APOYO`=:cuota_apoyo WHERE USER_ID=:id";
            $respuesta1 = $cnt->prepare( $sql1 );
            $respuesta1->execute( array( ":cuota" => $cuota, ":cuota_pago" => $m_pago, ":cuota_estado" => $estado_pago, ":cuota_apoyo" => $apoyo, ":id" => $id ) );


            echo "ok";

        }

    } else if ( $_POST[ 'fentrada' ] ) {

        //***************HOTEL*************//
        $fentrada = $_POST[ 'fentrada' ];
        $fsalida = $_POST[ 'fsalida' ];
        $noches = $_POST[ 'noches' ];
        $habitacion = $_POST[ 'habitacion' ];
        $id_reserva = $_POST[ 'id_reserva' ];
        $cuota = $_POST[ 'hotel_cuota' ];
        $m_pago = $_POST[ 'm-pago' ];
        $estado_pago = $_POST[ 'estado-pago' ];
        $apoyo = $_POST[ 'hotel_apoyo' ];
        $habitaciones = [];
        $fechas = [];
		$observaciones=$_POST['observaciones'];
        //***************GESTION*************//
        $date = date( "F j, Y, g:i a" );

        $sql = "SELECT * FROM reservas_hotel WHERE ID=:id";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( array( ":id" => $id_reserva ) );
        $datos = $respuesta->fetch( PDO::FETCH_ASSOC );


        //**************************FORMULARIO HOTELES************************//
        $fechas = [];
        $fechas2 = [];
        if ( $id_reserva != 0 ):
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
            $fechas[] = substr( $habitaciones[ 0 ][ 'FECHA' ], 0, -2 ) . $final;

        }
        foreach ( $fechas as $fecha ) {

            foreach ( $habitaciones as $elemento ) {

                if ( $elemento[ 'FECHA' ] == $fecha ) {
                    $sql5 = "UPDATE `hoteles` SET `RESERVADAS`=:reservadas,`DISPONIBLES`=:dispo WHERE FECHA=:fecha";
                    $respuesta5 = $cnt->prepare( $sql5 );
                    $respuesta5->execute( array( ":reservadas" => $elemento[ 'RESERVADAS' ] - 1, ":dispo" => $elemento[ 'DISPONIBLES' ] + 1, ":fecha" => $fecha ) );
                }
            }
        }


        endif;
        //**************************FORMULARIO HOTELES************************//
        $sql4 = "SELECT * FROM hoteles";
        $respuesta4 = $cnt->prepare( $sql4 );
        $respuesta4->execute();
        while ( $dato_hab = $respuesta4->fetch( PDO::FETCH_ASSOC ) ) {
            $habitaciones[] = $dato_hab;
        }

        for ( $i = 0; $i <= ( $noches - 1 ); $i++ ) {
            $aumento = 0;
            $aumento = substr( $fentrada, -2, 2 ) + $i;
            $final = sprintf( '%02d', $aumento );
            $fechas2[] = substr( $habitaciones[ 0 ][ 'FECHA' ], 0, -2 ) . $final;

        }

        foreach ( $fechas2 as $fecha ) {
            foreach ( $habitaciones as $elemento ) {
                if ( $elemento[ 'FECHA' ] == $fecha ) {
                    $sql5 = "UPDATE `hoteles` SET `RESERVADAS`=:reservadas,`DISPONIBLES`=:dispo WHERE FECHA=:fecha";
                    $respuesta5 = $cnt->prepare( $sql5 );
                    $respuesta5->execute( array( ":reservadas" => $elemento[ 'RESERVADAS' ] + 1, ":dispo" => $elemento[ 'DISPONIBLES' ] - 1, ":fecha" => $fecha ) );
                }
            }
        }
        if ( $id_reserva != 0 ):
            $sql = "UPDATE `reservas_hotel` SET `F_ENTRADA`=:fentrada, `F_SALIDA`=:fsalida, `HABITACION`=:hab, `NOCHES`=:noches, `OBSERVACIONES`=:ob WHERE ID=:id";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( array( ":fentrada" => $fentrada, ":fsalida" => $fsalida, ":hab" => $habitacion, ":noches" => $noches, ":id" => $id_reserva, ":ob"=>$observaciones ) );


        //****************GESTION DE PAGO******************//
        if ( $m_pago == "FREE"  and $cuota == 0.00 ) {
      
            $sql1 = "UPDATE `reservas_hotel` SET `HOTEL_CUOTA`=:cuota,`HOTEL_PAGO`=:hotel_pago,`HOTEL_ESTADO`=:hotel_estado,`HOTEL_APOYO`=:hotel_apoyo, `OBSERVACIONES`=:ob WHERE USER_ID=:id AND ID=:id_reserva";
            $respuesta1 = $cnt->prepare( $sql1 );
            $respuesta1->execute( array( ":cuota" => 0, ":hotel_pago" => $m_pago, ":hotel_estado" => $estado_pago, ":hotel_apoyo" => 0, ":id" => $id, ":id_reserva" => $id_reserva, ":ob"=>$observaciones ) );
        } else if ( $m_pago != "FREE"  and $cuota != 0 and $apoyo == $cuota and $estado_pago == 'PENDIENTE' ) {

            $sql1 = "UPDATE `reservas_hotel` SET `HOTEL_CUOTA`=:cuota,`HOTEL_PAGO`=:hotel_pago,`HOTEL_ESTADO`=:hotel_estado,`HOTEL_APOYO`=:hotel_apoyo, `OBSERVACIONES`=:ob WHERE USER_ID=:id AND ID=:id_reserva";
            $respuesta1 = $cnt->prepare( $sql1 );
            $respuesta1->execute( array( ":cuota" => 0, ":hotel_pago" => $m_pago, ":hotel_estado" => $estado_pago, ":hotel_apoyo" => $cuota, ":id" => $id, ":id_reserva" => $id_reserva, ":ob"=>$observaciones ) );
        } else if ( $m_pago == "FREE"  and $cuota != 0 ) {

            $sql1 = "UPDATE `reservas_hotel` SET `HOTEL_CUOTA`=:cuota,`HOTEL_PAGO`=:hotel_pago,`HOTEL_ESTADO`=:hotel_estado,`HOTEL_APOYO`=:hotel_apoyo, `OBSERVACIONES`=:ob WHERE USER_ID=:id AND ID=:id_reserva";
            $respuesta1 = $cnt->prepare( $sql1 );
            $respuesta1->execute( array( ":cuota" => 0, ":hotel_pago" => $m_pago, ":hotel_estado" => $estado_pago, ":hotel_apoyo" => $apoyo, ":id" => $id, ":id_reserva" => $id_reserva, ":ob"=>$observaciones ) );
			
        } else if ( $m_pago != "FREE"
            and $cuota != 0 and $estado_pago != "PAGADO" ) {

            $sql1 = "UPDATE `reservas_hotel` SET `HOTEL_CUOTA`=:cuota,`HOTEL_PAGO`=:hotel_pago,`HOTEL_ESTADO`=:hotel_estado,`HOTEL_APOYO`=:hotel_apoyo, `OBSERVACIONES`=:ob WHERE USER_ID=:id AND ID=:id_reserva";
            $respuesta1 = $cnt->prepare( $sql1 );
            $respuesta1->execute( array( ":cuota" => $cuota, ":hotel_pago" => $m_pago, ":hotel_estado" => $estado_pago, ":hotel_apoyo" => $apoyo, ":id" => $id, ":id_reserva" => $id_reserva, ":ob"=>$observaciones ) );
        } else if ( $m_pago != "FREE"  and $cuota != 0 and $estado_pago == "PAGADO" ) {

            $sql1 = "UPDATE `reservas_hotel` SET `HOTEL_CUOTA`=:cuota,`HOTEL_PAGO`=:hotel_pago,`HOTEL_ESTADO`=:hotel_estado,`HOTEL_APOYO`=:hotel_apoyo, `OBSERVACIONES`=:ob WHERE USER_ID=:id AND ID=:id_reserva";
            $respuesta1 = $cnt->prepare( $sql1 );
            $respuesta1->execute( array( ":cuota" => $cuota, ":hotel_pago" => $m_pago, ":hotel_estado" => $estado_pago, ":hotel_apoyo" => 0, ":id" => $id, ":id_reserva" => $id_reserva, ":ob"=>$observaciones ) );
        } else if ( $m_pago != "FREE"
            and $cuota == 0 and $estado_pago == "PENDIENTE" ) {

            $sql1 = "UPDATE `reservas_hotel` SET `HOTEL_CUOTA`=:cuota,`HOTEL_PAGO`=:hotel_pago,`HOTEL_ESTADO`=:hotel_estado,`HOTEL_APOYO`=:hotel_apoyo, `OBSERVACIONES`=:ob WHERE USER_ID=:id AND ID=:id_reserva";
            $respuesta1 = $cnt->prepare( $sql1 );
            $respuesta1->execute( array( ":cuota" => $cuota, ":hotel_pago" => $m_pago, ":hotel_estado" => $estado_pago, ":hotel_apoyo" => $apoyo, ":id" => $id, ":id_reserva" => $id_reserva, ":ob"=>$observaciones ) );
        } else {

            $sql1 = "DELETE FROM `reservas_hotel` WHERE ID=:id";
            $respuesta1 = $cnt->prepare( $sql1 );
            $respuesta1->execute( array( ":id" => $id_reserva ) );
        } else :

            $sql = "INSERT INTO `reservas_hotel`(
		`USER_ID`,		
		`HABITACION`,
		`NOCHES`,
		`F_ENTRADA`,
		`F_SALIDA`,
		`HOTEL_CUOTA`,
		`HOTEL_PAGO`,
		`HOTEL_ESTADO`,
		`HOTEL_APOYO`,
		`DATE`,
		`OBSERVACIONES`) VALUES (
			:USER_ID,		
		:HABITACION,
		:NOCHES,
		:F_ENTRADA,
		:F_SALIDA,
		:HOTEL_CUOTA,
		:HOTEL_PAGO,
		:HOTEL_ESTADO,
		:HOTEL_APOYO,
		:DATE,
		:OBSERVACIONES
		)";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( array(
            ":USER_ID" => $id,
            ":HABITACION" => $habitacion,
            ":NOCHES" => $noches,
            ":F_ENTRADA" => $fentrada,
            ":F_SALIDA" => $fsalida,
            ":HOTEL_CUOTA" => $cuota,
            ":HOTEL_PAGO" => $m_pago,
            ":HOTEL_ESTADO" => $estado_pago,
            ":HOTEL_APOYO" => $apoyo,
            ":DATE" => $date,
			":OBSERVACIONES"=>$observaciones
        ) );
        endif;

        echo "ok";
    }

    $sql = "SELECT * FROM pendiete WHERE USER_ID=:id";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute( array( ":id" => $id ) );
    $fila = $respuesta->fetch( PDO::FETCH_ASSOC );

    if ( $fila[ 'CUOTA_ESTADO' ] == "PAGADO"
        and $fila[ 'ACOMPA_ESTADO' ] == "PAGADO" ) {
        $estado_cuotas = 1;
    } else if ( $fila[ 'CUOTA_ESTADO' ] == "PAGADO"
        and $fila[ 'ACOMPA_ESTADO' ] == "" ) {
        $estado_cuotas = 1;
    } else {
        $estado_cuotas = 0;
    }
    $count = 0;
    $sql = "SELECT * FROM reservas_hotel WHERE USER_ID=:id";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute( array( ":id" => $id ) );
    while ( $fila = $respuesta->fetch( PDO::FETCH_ASSOC ) ) {
        if ( $fila[ 'HOTEL_ESTADO' ] == "PENDIENTE" ) {
            $estado_reserva = 0;
            $count++;
        } else if ( $fila[ 'HOTEL_ESTADO' ] == "DEVOLUCION" ) {
            $estado_reserva = 0;
            $count++;
        } else if ( $fila[ 'HOTEL_ESTADO' ] == "PAGADO" ) {
            $estado_reserva = 1;
        }
    }

    if ( $estado_cuotas == 1 and $count == 0 ) {
        $estado = 1;
    } else {
        $estado = 0;
    }
    /********************FOMULARIO ASISTENTES************************/
 
    $sql = "UPDATE `form` SET `ESTADO`=:estado   WHERE ID=:id";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute( array( ":estado" => $estado, ":id" => $id ) );
} else {
    echo "no";
}
?>