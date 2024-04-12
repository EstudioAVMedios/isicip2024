<?php

include( "../../assets/php/config.php" );
if ( $_POST ) {
    $id = $_POST[ 'id' ];
    $habitaciones = [];

    $sql2 = 'SELECT * FROM reservas_hotel WHERE USER_ID=:id';
    $resultado2 = $cnt->prepare( $sql2 );
    $resultado2->execute( array( ":id" => $id ) );
    while ( $fila = $resultado2->fetch( PDO::FETCH_ASSOC ) ) {
        $datos[] = $fila;
    }


    //**************************FORMULARIO HOTELES************************//	
    foreach ( $datos as $elemento ) {
        $fechas = [];
   
            $sql4 = "SELECT * FROM hoteles";
        $respuesta4 = $cnt->prepare( $sql4 );
        $respuesta4->execute();

        while ( $dato_hab = $respuesta4->fetch( PDO::FETCH_ASSOC ) ) {
            $habitaciones[] = $dato_hab;
        }

        for ( $i = 0; $i <= ( $elemento[ 'NOCHES' ] - 1 ); $i++ ) {
            $aumento = 0;
            $aumento = substr( $elemento[ 'F_ENTRADA' ], -2, 2 ) + $i;
            $final = sprintf( '%02d', $aumento );
            $fechas[] = substr( $habitaciones[ 0 ][ 'FECHA' ], 0, -2 ) . $final;

        }
        foreach ( $fechas as $fecha ) {

            foreach ( $habitaciones as $elemento2 ) {

                if ( $elemento2[ 'FECHA' ] == $fecha ) {
                    $sql5 = "UPDATE `hoteles` SET `RESERVADAS`=:reservadas,`DISPONIBLES`=:dispo WHERE FECHA=:fecha";
                    $respuesta5 = $cnt->prepare( $sql5 );
                    $respuesta5->execute( array( ":reservadas" => $elemento2[ 'RESERVADAS' ] - 1, ":dispo" => $elemento2[ 'DISPONIBLES' ] + 1, ":fecha" => $fecha ) );
                }
            }
        }

    }


    $sql2 = 'DELETE FROM form WHERE ID=:id';
    $resultado2 = $cnt->prepare( $sql2 );
    $resultado2->execute( array( ":id" => $id ) );

    $sql2 = 'DELETE FROM facturacion WHERE USER_ID=:id';
    $resultado2 = $cnt->prepare( $sql2 );
    $resultado2->execute( array( ":id" => $id ) );

    $sql2 = 'DELETE FROM acompa WHERE USER_ID=:id';
    $resultado2 = $cnt->prepare( $sql2 );
    $resultado2->execute( array( ":id" => $id ) );
    $sql2 = 'DELETE FROM pendiete WHERE USER_ID=:id';
    $resultado2 = $cnt->prepare( $sql2 );
    $resultado2->execute( array( ":id" => $id ) );
    $sql2 = 'DELETE FROM profesionales WHERE USER_ID=:id';
    $resultado2 = $cnt->prepare( $sql2 );
    $resultado2->execute( array( ":id" => $id ) );
    $sql2 = 'DELETE FROM reservas_hotel WHERE USER_ID=:id';
    $resultado2 = $cnt->prepare( $sql2 );
    $resultado2->execute( array( ":id" => $id ) );

    echo "success";
} else {
    echo "Intenta entrar de una forma no permitida";
}


?>