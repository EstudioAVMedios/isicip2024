<?php
include( "../../../../assets/php/config.php" );
date_default_timezone_set( "Europe/Madrid" );
if ( $_POST[ 'id' ] ) {
    $id = $_POST[ 'id' ];

    $sql = "SELECT * FROM form WHERE ID=:id";
    $resultado = $cnt->prepare( $sql );
    $resultado->execute( array( ":id" => $id ) );
    $fila = $resultado->rowCount();
    $datos = $resultado->fetch( PDO::FETCH_ASSOC );


    if ( $fila != 0 ) {


        if ( $datos[ 'ESTADOQR' ] == 1 ) {
            $estado = 0;
        } else {
            $estado = 1;
        };


        $sql1 = "UPDATE `form` SET`ESTADOQR`=:estado WHERE ID=:id";
        $resultado1 = $cnt->prepare( $sql1 );
        $resultado1->execute( array( ":estado" => $estado, ":id" => $id ) );
        $datos = $resultado->fetch( PDO::FETCH_ASSOC );

        $resultado->execute( array( ":id" => $id ) );
        $datos = $resultado->fetch( PDO::FETCH_ASSOC );

        $sql3 = "SELECT * FROM listado WHERE ID=:id AND DATE_OUT=:out";
        $resultado3 = $cnt->prepare( $sql3 );
        $resultado3->execute( array( ":id" => $id, ":out" => 0 ) );
        $fila2 = $resultado3->rowCount();

        if ( $fila2 == 0 ) {
            $sql2 = "INSERT INTO `listado`(`ID`, `NAME`, `SURNAME`, `EMAIL`, `DATE_IN`, `DATE_OUT`) VALUES (:id,:name,:lastname,:email,:in,:out)";
            $resultado2 = $cnt->prepare( $sql2 );
            $resultado2->execute( array( ":id" => $id, ":name" => $datos[ 'NAME' ], ":lastname" => $datos[ 'SURNAME' ], ":email" =>  $datos[ 'EMAIL' ], ":in" => date( "F j, Y, g:i a" ), ":out" => 0 ) );
        } else {
            $sql2 = "UPDATE `listado` SET `DATE_OUT`=:out WHERE ID=:id";
            $resultado2 = $cnt->prepare( $sql2 );
            $resultado2->execute( array( ":out" => date( "F j, Y, g:i a" ), ":id" => $id ) );
        }


        echo json_encode( $datos );
    } else {
        echo "nodata";
    }
} else {
    echo "no";
}


?>