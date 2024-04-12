<?php

include( '../../../assets/php/config.php' );
session_start();
require( "SMTP/class.phpmailer.php" );
require( "SMTP/class.smtp.php" );
date_default_timezone_set( "Europe/Madrid" );

if ( $_POST ) {
    $sql = "SELECT * FROM generales_form";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute();
    $campos = $respuesta->fetch( PDO::FETCH_ASSOC );
	
	$sql = "SELECT * FROM pagos";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute();
    $pagos = $respuesta->fetch( PDO::FETCH_ASSOC );

    $sql = "SELECT * FROM habitaciones";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute();
    while ( $fila = $respuesta->fetch( PDO::FETCH_ASSOC ) ) {
        $hotel[] = $fila;
    }   

    $sql = "SELECT * FROM evento";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute();
    $evento = $respuesta->fetch( PDO::FETCH_ASSOC );
    if($_POST['LAN']=="ES"){
        $sql = "SELECT * FROM all_campos WHERE ESTADO=1";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute();
    while ( $fila4 = $respuesta->fetch( PDO::FETCH_ASSOC ) ) {
        $campos_all[] = $fila4;
    }
    }elseif($_POST['LAN']=="EN"){
        $sql = "SELECT * FROM all_campos2 WHERE ESTADO=1";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute();
    while ( $fila4 = $respuesta->fetch( PDO::FETCH_ASSOC ) ) {
        $campos_all[] = $fila4;
    }
    }
    
    
    $sql = "SELECT * FROM CATEGORIAS";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute();
    while ( $fila4 = $respuesta->fetch( PDO::FETCH_ASSOC ) ) {
        $categorias[] = $fila4;
    }


    $sql = "SELECT * FROM generales_form";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute();
    $sesiones = $respuesta->fetch( PDO::FETCH_ASSOC );

    $sql = "SELECT * FROM form WHERE EMAIL=:email";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute( array( ":email" => $_POST[ 'EMAIL' ] ) );
    $fila = $respuesta->rowCount();

    if ( $fila == 0 ) {

        function genero($valor1){
        if ( $valor1 == "Dr."
            or $valor1 == "Sr."
            or $valor1 == "Prof." ) {
            $genero = "Masculino";
        }else {
            $genero = "Femenino";}
            return $genero;
        }
        //VAriasbles PERSONALES
        $agenero=genero($_POST['ATITULO']) ?? "";
        $genero=genero($_POST['TITULO']) ?? "";
        $acompa = $_POST[ 'ACOMPA' ] ?? 'No'; 
        $date = date( "F j, Y, g:i a" );    
        $code=$_POST['CODE'];           
        
        
        //VARIABLES DE PAGO
        if(empty($_POST['STRIPE'])){
            $pago_pasarela="redsys";
        }else{
            $pago_pasarela="stripe";
        }
        
        $acompa_cuota=$_POST[ 'ACOMPA_CUOTA' ] ?? "";
        $pago = $_POST[ 'PAGO' ] ?? "";
        $cuota = $_POST[ 'CUOTA' ]; 
        if($cuota==0){
            $pago_usuario="FREE";
            $estado_usuario="PAGADO";
            $cuota_apoyo=0;
        }else{
            $pago_usuario=$pago;
            $estado_usuario="PENDIENTE";
            $cuota_apoyo=$cuota;
        }

        if($acompa_cuota==0){
            $pago_acompa="FREE";
            $estado_acompa="PAGADO";
            $acompa_apoyo=0;
        }else{
            $pago_acompa=$pago;
            $estado_acompa="PENDIENTE";
            $acompa_apoyo=$acompa_cuota;
            $acompa_cuota=0;
        }

        if($pago=="FREE"){
            $estado=1;
        }else{
            $estado=0;
        }  
        $categoria=$_POST['CATEGORIA'];
        
        if($pago=="FREE"){
            $estado_pago="PAGADO";
        }else{
            $estado_pago="PENDIENTE";
        }
        /****************************** DATOS PERSONALES ************************************************/
        $query_personales="(";
        $query_personales_marcadores="VALUES (";
        $query_personales_data=[];
        /****************************** DATOS PROFESIONALES ************************************************/
         $query_profesionales="(USER_ID, ";
         $query_profesionales_marcadores="VALUES (:USER_ID, ";
         $query_profesionales_data=[];
        /****************************** DATOS FACTURACION ************************************************/
         $query_facturacion="(USER_ID, ";
         $query_facturacion_marcadores="VALUES (:USER_ID, ";
         $query_facturacion_data=[];
         /****************************** DATOS ACOMPANANTE ************************************************/
         $query_acompa="(USER_ID, ";
         $query_acompa_marcadores="VALUES (:USER_ID, ";
         $query_acompa_data=[];
         /*** VARIABLE SESION ***/
         $_SESSION[ 'user_evento_id' ] = [];

        foreach ( $campos_all as $elemento ) {
            if ( $elemento[ 'TIPO' ] == "ACOMPA" ):
            $query_acompa.=$elemento['CAMPO'].",";
            $query_acompa_marcadores.=":".$elemento['CAMPO'].",";
            $query_acompa_data[":".$elemento['CAMPO']]=$_POST["A$elemento[CAMPO]"]; 
            $_SESSION[ 'user_evento_id' ][ "A$elemento[CAMPO]" ] = $_POST[ "A$elemento[CAMPO]" ];
            elseif ( $elemento[ 'TIPO' ] == "FACT" ):
            $query_facturacion.="F_".$elemento['CAMPO'].",";
            $query_facturacion_marcadores.=":".$elemento['CAMPO'].",";
            $query_facturacion_data[":".$elemento['CAMPO']]=$_POST["F$elemento[CAMPO]"]; 
            $_SESSION[ 'user_evento_id' ][ "F$elemento[CAMPO]" ] = $_POST[ "F$elemento[CAMPO]" ];  
            elseif ( $elemento[ 'TIPO' ] == "PROF" ):
            $query_profesionales.=$elemento['CAMPO'].",";
            $query_profesionales_marcadores.=":".$elemento['CAMPO'].",";
            $query_profesionales_data[":".$elemento['CAMPO']]=$_POST["P$elemento[CAMPO]"];
            $_SESSION[ 'user_evento_id' ][ "P$elemento[CAMPO]" ] = $_POST[ "P$elemento[CAMPO]" ];             
            else :  
            if($_POST[$elemento['CAMPO']]){
            $query_personales.=$elemento['CAMPO'].",";
            $query_personales_marcadores.=":".$elemento['CAMPO'].",";
            if($elemento['CAMPO']=="PASS"){
                $query_personales_data[":".$elemento['CAMPO']]=password_hash($_POST[$elemento['CAMPO']],PASSWORD_DEFAULT);
            }else{
                $query_personales_data[":".$elemento['CAMPO']]=$_POST[$elemento['CAMPO']];
            }
            $_SESSION[ 'user_evento_id' ][ "$elemento[CAMPO]" ] = $_POST[ "$elemento[CAMPO]" ];
            }           
            endif;
        }
        
        $query_personales.="DATE, GENERO, ACOMPA,CATEGORIA,ESTADO,LAN,CODE,";
        $query_personales_marcadores.=":DATE,:GENERO,:ACOMPA,:CATEGORIA,:ESTADO,:LAN,:CODE,";
        $query_personales_data[":DATE"]=$date;
        $query_personales_data[":GENERO"]=$genero;
        $query_personales_data[":ACOMPA"]=$acompa;
        $query_personales_data[":CATEGORIA"]=$categoria;
        $query_personales_data[":ESTADO"]=$estado;
        $query_personales_data[":LAN"]=$_POST['LAN'];
        $query_personales_data[":CODE"]=$code;
        $query_personales= substr($query_personales,0,-1). ") ". substr($query_personales_marcadores, 0,-1).")";

        $query_profesionales= substr($query_profesionales,0,-1). ") ". substr($query_profesionales_marcadores, 0,-1).")";
        $query_facturacion= substr($query_facturacion,0,-1). ") ". substr($query_facturacion_marcadores, 0,-1).")";

        $query_acompa.="DATE, GENERO,";
        $query_acompa_marcadores.=":DATE,:GENERO,";
        $query_acompa_data[":DATE"]=$date;
        $query_acompa_data[":GENERO"]=$agenero;
        $query_acompa= substr($query_acompa,0,-1). ") ". substr($query_acompa_marcadores, 0,-1).")";
        
        $sql = "INSERT INTO `form` $query_personales";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( $query_personales_data);
        /*USER ID */
        $id = $cnt->lastInsertId();
        /*QUERIES DE INSERCION*/
        if($campos['ESTADO_PROF']==1){
        $query_profesionales_data[":USER_ID"]=$id;
        $sql = "INSERT INTO `profesionales` $query_profesionales";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( $query_profesionales_data);
        }
        if($campos['ESTADO_FACTURA']==1){
        $query_facturacion_data[":USER_ID"]=$id;
        $sql = "INSERT INTO `facturacion` $query_facturacion";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( $query_facturacion_data);
        }
        $query_acompa_data[":USER_ID"]=$id;
        $sql = "INSERT INTO `acompa` $query_acompa";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( $query_acompa_data);
        
        if ( $campos[ 'ESTADO_ACOMPA' ] == 0 ) {
            $pago_acompa = "";
            $estado_acompa = "";
        } else {
            $pago_acompa = $pago;
            $estado_acompa = "PENDIENTE";
        }


        /***************************** DATOS HOTEL **************************************/
        $ahabitacion = $_POST[ 'AHABITACION' ] ?? "";
        $anoches = $_POST[ 'ANOCHES' ] ?? "";
        $afentrada = $_POST[ 'AF_ENTRADA' ] ?? "";
        $afsalida = $_POST[ 'AF_SALIDA' ] ?? "";
        $acuota_hab = $_POST[ 'ATOTAL_HAB' ] ?? "";
        if ( $acuota_hab == 0 ) {
            $pago_hotel = "";
            $estado_hotel = "";
        } else {
            $pago_hotel = $pago;
            $estado_hotel = "PENDIENTE";
        }     

        /******************************************** RESERVA DE HOTEL *********************************/

         foreach ( $hotel as $elemento ) {
            if ( $elemento[ 'HABITACION' ] == $ahabitacion ) {
                $precio_hab = $elemento[ 'PRECIO' ];
            }
        }
    if ( $ahabitacion != "" ):
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
		`DATE`) VALUES (
			:USER_ID,		
		:HABITACION,
		:NOCHES,
		:F_ENTRADA,
		:F_SALIDA,
		:HOTEL_CUOTA,
		:HOTEL_PAGO,
		:HOTEL_ESTADO,
		:HOTEL_APOYO,
		:DATE
		)";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( array(
            ":USER_ID" => $id,
            ":HABITACION" => $precio_hab,
            ":NOCHES" => $anoches,
            ":F_ENTRADA" => $afentrada,
            ":F_SALIDA" => $afsalida,
            ":HOTEL_CUOTA" => 0,
            ":HOTEL_PAGO" => $pago_hotel,
            ":HOTEL_ESTADO" => $estado_hotel,
            ":HOTEL_APOYO" => $acuota_hab,
            ":DATE" => $date
        ) );
        endif;

 //**************************FORMULARIO HOTELES************************//
 if($campos['ESTADO_ALOJAMIENTO']==1){
        $fechas = [];
        $sql4 = "SELECT * FROM hoteles";
        $respuesta4 = $cnt->prepare( $sql4 );
        $respuesta4->execute();

        while ( $dato_hab = $respuesta4->fetch( PDO::FETCH_ASSOC ) ) {
            $habitaciones[] = $dato_hab;
        }

        for ( $i = 0; $i <= ( $anoches - 1 ); $i++ ) {
            $aumento = 0;
            $aumento = substr( $afentrada, -2, 2 ) + $i;
            $final = sprintf( '%02d', $aumento );
            $fechas[] = substr( $habitaciones[ 0 ][ 'FECHA' ], 0, -2 ) . $final;

        }
        foreach ( $fechas as $fecha ) {

            foreach ( $habitaciones as $elemento ) {
                if ( $elemento[ 'FECHA' ] == $fecha ) {
                    $sql5 = "UPDATE `hoteles` SET `RESERVADAS`=:reservadas,`DISPONIBLES`=:dispo WHERE FECHA=:fecha";
                    $respuesta5 = $cnt->prepare( $sql5 );
                    $respuesta5->execute( array( ":reservadas" => $elemento[ 'RESERVADAS' ] + 1, ":dispo" => $elemento[ 'DISPONIBLES' ] - 1, ":fecha" => $fecha ) );
                }
            }
        }
    }
/************************** SISTEMA DE PAGO *****************************/
        $sql = "INSERT INTO `pendiete`(
		`USER_ID`,
		`CUOTA`,
		`CUOTA_PAGO`,
		`CUOTA_ESTADO`,
        `CUOTA_APOYO`,
		`ACOMPA_CUOTA`,
		`ACOMPA_PAGO`,
		`ACOMPA_ESTADO`,
        `ACOMPA_APOYO`,
		`DATE`) VALUES (
		:USER_ID,
		:CUOTA,
		:CUOTA_PAGO,
		:CUOTA_ESTADO,
        :CUOTA_APOYO,
		:ACOMPA_CUOTA,
		:ACOMPA_PAGO,
		:ACOMPA_ESTADO,
        :ACOMPA_APOYO,	
		:DATE		
		)";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( array(
            ":USER_ID" => $id,
            ":CUOTA" => 0,
            ":CUOTA_PAGO" => $pago_usuario,
            ":CUOTA_ESTADO" => $estado_usuario,
            ":CUOTA_APOYO" => $cuota_apoyo,
            ":ACOMPA_CUOTA" => $acompa_cuota,
            ":ACOMPA_PAGO" => $pago_acompa,
            ":ACOMPA_ESTADO" => $estado_acompa,
            ":ACOMPA_APOYO" => $acompa_apoyo,
            ":DATE" => $date
        ) );       
     

    /***************************** DATOS SERVICIOS Y EXTRAS **************************************/
    $gestion = $_POST[ 'EGESTION' ] ?? "";
    $intolerancia = $_POST[ 'EINTOLERANCIA' ] ?? "";   
        
		$_SESSION[ 'user_evento_id' ][ 'ACOMPA' ]=$acompa;
		$_SESSION[ 'user_evento_id' ][ 'ID' ]= $id;
		$_SESSION[ 'user_evento_id' ][ 'CUOTA' ] = $cuota;
        $_SESSION[ 'user_evento_id' ][ 'CUOTA_ACOMPA' ] = $acompa_cuota;
		$_SESSION[ 'user_evento_id' ][ 'TOTAL_CUOTA_HOTEL' ] = $acuota_hab;
        $_SESSION[ 'user_evento_id' ][ 'NOCHES' ] = $anoches;
        $_SESSION[ 'user_evento_id' ][ 'F_ENTRADA' ] = $afentrada;
        $_SESSION[ 'user_evento_id' ][ 'F_SALIDA' ] = $afsalida;
        $_SESSION[ 'user_evento_id' ][ 'HABITACION' ] = $ahabitacion;
        $_SESSION[ 'user_evento_id' ][ 'LAN' ] = $_POST['LAN'];

        if ( $ahabitacion != "" ) {
            $_SESSION[ 'user_evento_id' ][ 'HOTEL' ] = $hotel[ 0 ][ 'HOTEL' ];
        } else {
            $_SESSION[ 'user_evento_id' ][ 'HOTEL' ] = "";
        }
      
        if($code==''){
            $cuota_m_pago = "(" . $pago_usuario . ")(PENDIENTE DE PAGO ".$cuota_apoyo."€)";
        }else{
            $cuota_m_pago = "(" . $pago_usuario . ")(PAGADO)";
        }
        
        $acompa_m_pago = "";
        $hotel_m_pago = "";
		$envio = true;
        
		$_SESSION[ 'user_evento_id' ][ "PASS" ]=$_POST['PASS'];        
		$_SESSION[ 'user_evento_id' ][ "CATEGORIA" ]=$categoria;
        $_SESSION[ 'user_evento_id' ][ "CODE" ]=$code;
        $_SESSION[ 'user_evento_id' ][ "PASARELA" ]= $pago_pasarela;
        $copia_agencia=$_POST['AGENCIA_EMAIL'];
        $send_copia = true;  
if ( $pago == "TPV" ) {
    $envio = false;
}
if($_POST['LAN']=="ES"){
    include( "mail.php" );
}elseif($_POST['LAN']=="EN"){
    include( "mail-en.php" );
}
      
		if($pago!="TPV"){
			   echo "ok";
		}else{        
           
                echo "tpv";      
			
		}
 
    } else {
        echo "exist";
    }
} else {
    echo "No";
}
?>