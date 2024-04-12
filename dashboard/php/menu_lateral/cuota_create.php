<?php

include( "../../../assets/php/config.php" );

$sql = "SELECT * FROM evento";
$respuesta = $cnt->prepare( $sql );
$respuesta->execute();
$fila = $respuesta->fetch( PDO::FETCH_ASSOC );
if ( substr( $fila[ 'FECHA_CIERRE' ], -5, 2 ) == "01" ) {
    $mes = "ENE";
} elseif ( substr( $fila[ 'FECHA_CIERRE' ], -5, 2 ) == "02" ) {
    $mes = "FEB";
} elseif ( substr( $fila[ 'FECHA_CIERRE' ], -5, 2 ) == "03" ) {
    $mes = "MAR";
} elseif ( substr( $fila[ 'FECHA_CIERRE' ], -5, 2 ) == "04" ) {
    $mes = "ABR";
} elseif ( substr( $fila[ 'FECHA_CIERRE' ], -5, 2 ) == "05" ) {
    $mes = "MAY";
} elseif ( substr( $fila[ 'FECHA_CIERRE' ], -5, 2 ) == "06" ) {
    $mes = "JUN";
} elseif ( substr( $fila[ 'FECHA_CIERRE' ], -5, 2 ) == "07" ) {
    $mes = "JUL";
} elseif ( substr( $fila[ 'FECHA_CIERRE' ], -5, 2 ) == "08" ) {
    $mes = "AGO";
} elseif ( substr( $fila[ 'FECHA_CIERRE' ], -5, 2 ) == "09" ) {
    $mes = "SEPT";
} elseif ( substr( $fila[ 'FECHA_CIERRE' ], -5, 2 ) == "10" ) {
    $mes = "OCT";
} elseif ( substr( $fila[ 'FECHA_CIERRE' ], -5, 2 ) == "11" ) {
    $mes = "NOV";
} elseif ( substr( $fila[ 'FECHA_CIERRE' ], -5, 2 ) == "12" ) {
    $mes = "DIC";
}
$evento = strtoupper( $fila[ 'NAME' ] );
$fecha_evento = substr( $fila[ 'FECHA_INICIO' ], -2, 2 ) . "-" . substr( $fila[ 'FECHA_CIERRE' ], -2, 2 ) . " " . $mes . ", " . substr( $fila[ 'FECHA_CIERRE' ], 0, 4 );
$name = $_POST[ 'cuota_name' ];
$tipo = $_POST[ 'cuota_tipo' ];
$precio = $_POST[ 'cuota_precio' ];
if($_POST['visibilidad_cuota']=="on"){
	$visibilidad=1;
}else{
	$visibilidad=0;
};

if ( $_POST[ 'create' ] ) {

    $sql = "INSERT INTO `cuotas`(
`NAME`,
`FECHA_EVENTO`,
`NOMBRE_EVENTO`,
`PRECIO`,
`TIPO`,
`VISIBILIDAD`) VALUES (
:NAME,
:FECHA_EVENTO,
:NOMBRE_EVENTO,
:PRECIO,
:TIPO,
:VISIBILIDAD
)";
    $resultado = $cnt->prepare( $sql );
    $resultado->execute( array(
        ":NAME" => $name,
        ":FECHA_EVENTO" => $fecha_evento,
        ":NOMBRE_EVENTO" => $evento,
        ":PRECIO" => $precio,
        ":TIPO" => $tipo,
		":VISIBILIDAD"=>$visibilidad
    ) );
    echo "ok";

} else if ( $_POST[ 'delete' ] ) {
   $sql = "DELETE FROM `cuotas`
	WHERE ID=$_POST[id]";
    $resultado = $cnt->prepare( $sql );
    $resultado->execute();
    echo "ok";
 
} elseif ( $_POST[ 'edit' ] ) {

   $sql = "UPDATE `cuotas` SET 
	`NAME`=:name,	
	`PRECIO`=:precio,
	`TIPO`=:tipo,
	`VISIBILIDAD`=:VISIBILIDAD
	WHERE ID=:id";
    $resultado = $cnt->prepare( $sql );
    $resultado->execute(array(
	":name"=>$name,	
	":precio"=>$precio,
	":tipo"=>$tipo,
	":id"=>$_POST['id'],
	":VISIBILIDAD"=>$visibilidad
	));
    echo "ok";

    } elseif ( $_POST[ 'call' ] ) {

   $sql = "SELECT * FROM cuotas
	WHERE ID=$_POST[id]";
    $resultado = $cnt->prepare( $sql );
    $resultado->execute();
	while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
		$cuotas[]=$fila;
	}
    echo json_encode($cuotas);

    } 

    ?>