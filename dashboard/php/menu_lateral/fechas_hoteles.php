<?php

include( "../../../assets/php/config.php" );

$fentrada = $_POST[ 'fecha_inicial_reservas' ];
$fsalida = $_POST[ 'fecha_final_reservas' ];
echo $referencia[ 'F_SALIDA' ];
$sql = "SELECT * FROM hoteles";
$respuesta = $cnt->prepare( $sql );
$respuesta->execute();
while ( $fila = $respuesta->fetch( PDO::FETCH_ASSOC ) ) {
    $datos[] = $fila;
}

$sql = "SELECT * FROM generales_form";
$resultado = $cnt->prepare( $sql );
$resultado->execute();
$referencia = $resultado->fetch( PDO::FETCH_ASSOC );

$fechas = [];

function proceso( $noches, $valor, $cnt, $selector ) {

    for ( $i = 0; $i < $noches; $i++ ) {
        $aumento = 0;

        if ( $selector==1 ) {			
            $aumento = substr( $valor, -2, 2 ) - ( $i + 1 );
        } else if ( $selector==2) {	
            $aumento = substr( $valor, -2, 2 ) + ( $i + 1 );
        }

        $final = sprintf( '%02d', $aumento );
        $fechas[ $i ] = substr( $valor, 0, -2 ) . $final;

        $sql = "INSERT INTO `hoteles`(
`FECHA`,
`TOTAL`,
`RESERVADAS`,
`DISPONIBLES`,
`PRE_BLOQUEO`) VALUES (
:FECHA,
:TOTAL,
:RESERVADAS,
:DISPONIBLES,
:PRE_BLOQUEO)";
        $resultado = $cnt->prepare( $sql );
        $resultado->execute( array(
            ":FECHA" => $fechas[ $i ],
            ":TOTAL" => 0,
            ":RESERVADAS" => 0,
            ":DISPONIBLES" => 0,
            ":PRE_BLOQUEO" => 0
        ) );
    }
    echo "ok";
}

if ( $referencia[ 'F_ENTRADA' ] > $fentrada ) {
    $noches = substr( $referencia[ 'F_ENTRADA' ], -2, 2 ) - substr( $fentrada, -2, 2 );
	
    proceso( $noches, $referencia[ 'F_ENTRADA' ], $cnt,1 );

} else if ( $datos[ 0 ][ 'FECHA' ] < $fentrada ) {
    echo "No";
}

if ( $referencia[ 'F_SALIDA' ] > $fsalida ) {
    echo "No";
} else if ( $referencia[ 'F_SALIDA' ] < $fsalida ) {
    $noches = substr( $fsalida, -2, 2 ) - substr( $referencia[ 'F_SALIDA' ], -2, 2 );

    proceso( $noches, $referencia[ 'F_SALIDA' ], $cnt,2 );

}

$sql = "UPDATE `generales_form` SET `F_ENTRADA`=:fentrada,`F_SALIDA`=:fsalida WHERE 1=1";
$resultado = $cnt->prepare( $sql );
$resultado->execute( array(
    ":fentrada" => $fentrada,
    ":fsalida" => $fsalida ) );

?>