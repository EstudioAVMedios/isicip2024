<?php

include( "../../assets/php/config.php" );

date_default_timezone_set( "Europe/Madrid" );
$id = $_POST[ 'id' ];

$sql="SELECT * FROM pendiete WHERE USER_ID=:id";
$resultado=$cnt->prepare($sql);
$resultado->execute(array(":id"=>$id));
$fila=$resultado->fetch(PDO::FETCH_ASSOC);

$sql="SELECT * FROM form WHERE ID=:id";
$resultado=$cnt->prepare($sql);
$resultado->execute(array(":id"=>$id));
$fila2=$resultado->fetch(PDO::FETCH_ASSOC);

$sql="SELECT * FROM reservas_hotel WHERE USER_ID=:id";
$resultado=$cnt->prepare($sql);
$resultado->execute(array(":id"=>$id));

while($fila3=$resultado->fetch(PDO::FETCH_ASSOC)){
	$reservas[]=$fila3;
}
/***************************** PROCESANDO RESERVAS DE HOTEL *************************************/
if(!empty($reservas)){
foreach($reservas as $elemento){

if($elemento['HOTEL_PAGO']=="" and $elemento['HOTEL_ESTADO']=="" ){	
																   
	$cuota_hotel=0.00;
	$hotel_pago="";
	$hotel_estado="";
	$hotel_apoyo=0.00;
}else if($elemento['HOTEL_PAGO']==null and $elemento['HOTEL_ESTADO']==null ){

	$cuota_hotel=0.00;
	$hotel_pago="";
	$hotel_estado="";
	$hotel_apoyo=0.00;
}else if($elemento['HOTEL_PAGO']!="FREE" and $elemento['HOTEL_ESTADO']=="PENDIENTE" and $elemento['HOTEL_CUOTA']==0){
	
	$cuota_hotel=$elemento['HOTEL_APOYO'];
	$hotel_pago=$elemento['HOTEL_PAGO'];
	$hotel_estado="PAGADO";
	$hotel_apoyo=0.00;
}else if($elemento['HOTEL_PAGO']!="FREE" and $elemento['HOTEL_ESTADO']=="PENDIENTE" and $elemento['HOTEL_CUOTA']!=0){

	$cuota_hotel=$elemento['HOTEL_CUOTA'];
	$hotel_pago=$elemento['HOTEL_PAGO'];
	$hotel_estado="PAGADO";
	$hotel_apoyo=0.00;
}else if($elemento['HOTEL_PAGO']!="FREE" and $elemento['HOTEL_ESTADO']=="DEVOLUCION" and $elemento['HOTEL_CUOTA']==0){
		
	$sql1 = "DELETE FROM `reservas_hotel` WHERE ID=:id_reserva";
$respuesta1 = $cnt->prepare( $sql1 );
$respuesta1->execute( array(  ":id_reserva" => $elemento['ID'] ) );
	
}else if($elemento['HOTEL_PAGO']!="FREE" and $elemento['HOTEL_ESTADO']=="DEVOLUCION" and $elemento['HOTEL_CUOTA']!=0){

	$cuota_hotel=$elemento['HOTEL_CUOTA'];
	$hotel_pago=$elemento['HOTEL_PAGO'];
	$hotel_estado="PAGADO";
	$hotel_apoyo=0;
}else if($elemento['HOTEL_PAGO']=="FREE" and $elemento['HOTEL_ESTADO']=="DEVOLUCION" and $elemento['HOTEL_CUOTA']==0){
	
	$cuota_hotel=0;
	$hotel_pago="FREE";
	$hotel_estado="PAGADO";
	$hotel_apoyo=0;
}else if($elemento['HOTEL_PAGO']!="FREE" and $elemento['HOTEL_ESTADO']=="PAGADO" and $elemento['HOTEL_CUOTA']!=0){

	$cuota_hotel=$elemento['HOTEL_CUOTA'];
	$hotel_pago=$elemento['HOTEL_PAGO'];
	$hotel_estado="PAGADO";
	$hotel_apoyo=0.00;
}else if($elemento['HOTEL_PAGO']=="FREE"){

	$cuota_hotel=0.00;
	$hotel_pago="FREE";
	$hotel_estado="PAGADO";
	$hotel_apoyo=0.00;
}
/*****************************  IMPRIMIENDO BASE DE DATOS RESERVAS_HOTEL *************************************/
$sql1 = "UPDATE `reservas_hotel` SET `HOTEL_CUOTA`=:cuota,`HOTEL_PAGO`=:hotel_pago,`HOTEL_ESTADO`=:hotel_estado,`HOTEL_APOYO`=:hotel_apoyo WHERE USER_ID=:id AND ID=:id_reserva";
$respuesta1 = $cnt->prepare( $sql1 );
$respuesta1->execute( array( ":cuota" => $cuota_hotel, ":hotel_pago" => $hotel_pago, ":hotel_estado" => $hotel_estado, ":hotel_apoyo" => $hotel_apoyo, ":id" => $id, ":id_reserva" => $elemento['ID'] ) );

	

}	
}

/***************************** PROCESANDO ACOMPA *************************************/


if($fila['ACOMPA_ESTADO']=="PENDIENTE"){
	$acompa_estado="PAGADO";
	$acompa_pago=$fila['ACOMPA_PAGO'];	
	$acompa_cuota=$fila['ACOMPA_APOYO'];
}elseif( $fila['ACOMPA_CUOTA']!=0 and $fila['ACOMPA_ESTADO']=="DEVOLUCION"){
	$acompa_estado="PAGADO";
	$acompa_pago=$fila['ACOMPA_PAGO'];
	$acompa_cuota=$fila['ACOMPA_CUOTA'];
}elseif( $fila['ACOMPA_CUOTA']==0 and $fila['ACOMPA_ESTADO']=="DEVOLUCION" and $fila['ACOMPA_PAGO']=="FREE"){
	$acompa_estado="PAGADO";
	$acompa_pago=$fila['ACOMPA_PAGO'];
	
	$acompa_cuota=$fila['ACOMPA_CUOTA'];
}elseif( $fila['ACOMPA_CUOTA']==0 and $fila['ACOMPA_ESTADO']=="DEVOLUCION" and $fila['ACOMPA_PAGO']!="FREE" and $fila2['ACOMPA']=="Si"){
	$acompa_estado="PAGADO";
	$acompa_pago="FREE";	
	$acompa_cuota=$fila['ACOMPA_CUOTA'];
}elseif( $fila['ACOMPA_CUOTA']==0 and $fila['ACOMPA_ESTADO']=="DEVOLUCION" and $fila['ACOMPA_PAGO']!="FREE" and $fila2['ACOMPA']=="No"){
	$acompa_estado="";
	$acompa_pago="";	
	$acompa_cuota=$fila['ACOMPA_CUOTA'];
}else{
	$acompa_cuota=$fila['ACOMPA_CUOTA'];
	$acompa_estado="PAGADO";
	$acompa_pago=$fila['ACOMPA_PAGO'];
	$acompa_cuota=$fila['ACOMPA_CUOTA'];
}
/***************************** PROCESANDO CUOTA ASITENTE *************************************/
if($fila['CUOTA']==0 and $fila['CUOTA_ESTADO']=="PENDIENTE"){
	$cuota_estado="PAGADO";
	$cuota_pago=$fila['CUOTA_PAGO'];
	$cuota=$fila['CUOTA_APOYO'];
}elseif($fila['CUOTA']!=0 and $fila['CUOTA_ESTADO']=="PENDIENTE"){
	$cuota_estado="PAGADO";
	$cuota_pago=$fila['CUOTA_PAGO'];
	$cuota=$fila['CUOTA'];		
}elseif( $fila['CUOTA']!=0 and $fila['CUOTA_ESTADO']=="DEVOLUCION"){
	$cuota_estado="PAGADO";
	$cuota_pago=$fila['CUOTA_PAGO'];
	$cuota=$fila['CUOTA'];			
}elseif( $fila['CUOTA']==0 and $fila['CUOTA_ESTADO']=="DEVOLUCION"){
	$cuota_estado="PAGADO";
	$cuota_pago="FREE";		
	$cuota=$fila['CUOTA'];	
}else{
	$cuota=$fila['CUOTA'];
	$cuota_estado="PAGADO";
	$cuota_pago=$fila['CUOTA_PAGO'];		
}
/*****************************  IMPRIMIENDO BASE DE DATOS CUOTA Y AOMPA TABLA PENDIETE *************************************/
 $sql1 = "UPDATE `pendiete` SET `CUOTA`=:cuota, `CUOTA_ESTADO`=:cuota_estado, `CUOTA_PAGO`=:cuota_pago,`CUOTA_APOYO`=:cuota_apoyo,`ACOMPA_CUOTA`=:acompa_cuota,`ACOMPA_ESTADO`=:acompa_estado,`ACOMPA_PAGO`=:acompa_pago,`ACOMPA_APOYO`=:acompa_apoyo WHERE USER_ID=:id";
$respuesta1 = $cnt->prepare( $sql1 );
$respuesta1->execute( array( ":cuota"=>$cuota,":cuota_estado"=>$cuota_estado,":cuota_pago"=>$cuota_pago,":cuota_apoyo"=>0,":acompa_cuota"=>$acompa_cuota, ":acompa_estado"=>$acompa_estado, ":acompa_pago"=>$acompa_pago,":acompa_apoyo"=>0,":id" => $id ) );

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

echo "ok";
?>