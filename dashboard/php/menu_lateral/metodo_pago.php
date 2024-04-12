<?php
include( "../../../assets/php/config.php" );

if ( $_POST[ 'call' ] ) {
    $sql = "SELECT * FROM pagos";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute();
    $fila = $respuesta->fetch( PDO::FETCH_ASSOC );
    echo json_encode( $fila );
} else if ( $_POST[ 'edit' ] ) {

    $titular_cuenta = $_POST[ 'titular_cuenta' ] ?? "";
    $entidad = $_POST[ 'entidad_bancaria' ] ?? "";
    $ibam = $_POST[ 'ibam_cuenta' ] ?? "";
    $swift = $_POST[ 'swift_cuenta' ] ?? "";

    $clave = $_POST[ 'clave_comercio' ] ?? "";
    $key = $_POST[ 'key' ] ?? "";

    $transferencia = $_POST[ 'transferencia' ] ?? 0;
    $tarjetaveci = $_POST[ 'tarjeta_veci' ] ?? 0;
    $tarjeta = $_POST[ 'tarjeta' ] ?? 0;

    function cambio( $valor ) {
        if ( $valor === "on" ) {
            return ( 1 );
        } else {
            return ( $valor );
        }
    }

    $sql = "UPDATE `pagos` SET 
	`TRANSFERENCIA`=:transferencia,
	`TARJETA_VECI`=:tarjetaveci,
	`TARJETA`=:tarjeta,
	`TITULAR_CUENTA`=:titular,
	`ENTIDAD`=:entidad,
	`IBAM`=:ibam,
	`SWIFT_CODE`=:swift,
	`CLAVE_COMERCIO`=:clave,
	`KEY`=:key WHERE 1=1";

    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute( array(
        ":transferencia" => cambio( $transferencia ),
        ":tarjetaveci" => cambio( $tarjetaveci ),
        ":tarjeta" => cambio( $tarjeta ),
        ":titular" => $titular_cuenta,
        ":entidad" => $entidad,
        ":ibam" => $ibam,
        ":swift" => $swift,
        ":clave" => $clave,
        ":key" => $key
    ) );
    $fila = $respuesta->fetch( PDO::FETCH_ASSOC );


    echo "ok";
}

?>