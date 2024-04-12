<?php
session_start();
include( '../config.php' );
include 'apiRedsys.php';

// Se crea Objeto
$miObj = new RedsysAPI;
$sql = "SELECT * FROM redsys";
$resultado = $cnt->prepare( $sql );
$resultado->execute();
$fila = $resultado->fetch( PDO::FETCH_ASSOC );

$sql = "SELECT * FROM evento";
$resultado = $cnt->prepare( $sql );
$resultado->execute();
$evento = $resultado->fetch( PDO::FETCH_ASSOC );


$sql = "SELECT * FROM generales_form";
$respuesta = $cnt->prepare( $sql );
$respuesta->execute();
$sesiones = $respuesta->fetch( PDO::FETCH_ASSOC );

$sql = "SELECT * FROM all_campos WHERE ESTADO=1";
$respuesta = $cnt->prepare( $sql );
$respuesta->execute();
while ( $fila4 = $respuesta->fetch( PDO::FETCH_ASSOC ) ) {
    $campos_all[] = $fila4;
}
if ( !empty( $_POST ) ) { //URL DE RESP. ONLINE

    $version = $_POST[ "Ds_SignatureVersion" ];
    $datos = $_POST[ "Ds_MerchantParameters" ];
    $signatureRecibida = $_POST[ "Ds_Signature" ];


    $decodec = $miObj->decodeMerchantParameters( $datos );
    $kc = $fila[ 'KEY' ]; //Clave recuperada de CANALES
    //$kc='sq7HjrUOBfKmC576ILgskD5srU870gJ7';
    $firma = $miObj->createMerchantSignatureNotif( $kc, $datos );

    echo PHP_VERSION . "<br/>";
    echo $firma . "<br/>";
    echo $signatureRecibida . "<br/>";

    if ( $firma === $signatureRecibida ) {

        include( "../config.php" );
        require( "../SMTP/class.phpmailer.php" );
        require( "../SMTP/class.smtp.php" );
        session_start();

        $datos = $_SESSION[ 'user_evento_id' ];
        $sql = "UPDATE `form` SET `ESTADO`=:estado WHERE EMAIL=:email";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( array( ":estado" => 1, ":email" => $datos[ 'EMAIL' ] ) );

        //****************GESTION DE PAGO******************//
        $sql1 = "UPDATE `pendiete` SET `CUOTA_ESTADO`=:cuota_estado, `ACOMPA_ESTADO`=:acompa_estado,  WHERE USER_ID=:id";
        $respuesta1 = $cnt->prepare( $sql1 );
        $respuesta1->execute( array( ":cuota_estado" => "PAGADO", ":acompa_estado" => "PAGADO", ":id" => $datos[ 'ID' ] ) );


        $texto = "Le confirmamos su pago e inscripción al evento <strong>" . $evento[ 'NAME' ] . "</strong>.<br><br>
					
Acceso a la plataforma<br><br>
		<strong>WEB: </strong> <a href='https://" . $_SERVER[ 'HTTP_HOST' ] . "/log.php'>Ir a mi área personal</a><br>
<strong>Usuario: </strong>" . $datos[ 'EMAIL' ] . "<br>
<strong>Contraseña: </strong> Cumpliendo con el Reglamento UE 679/2016, de 27 de abril, General de Protección de Datos,
y con la Ley Orgánica 3/2018, de Protección de Datos Personales y Garantía de los Derechos Digitales, no
tenemos acceso a su contraseña. Si no la recuerda puede recuperarla pulsando en <span style='color:" . $evento[ 'COLOR' ] . "'>¿Ha olvidado su
contraseña?</span>, en la caja de inicio de sesión.<br><br>
";


        header( "location:https://" . $_SERVER[ 'HTTP_HOST' ] . "/inscripciones.php?payment=true" );


    } else {

        include( '../config.php' );
        session_start();

        $datos = $_SESSION[ 'user_registradores_id' ];
        $sql = "UPDATE `form` SET `ESTADO`=:estado WHERE EMAIL=:email";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( array( ":estado" => 2, ":email" => $datos[ 'EMAIL' ] ) );
        header( "location:https://" . $_SERVER[ 'HTTP_HOST' ] . "/inscripciones.php?payment=false" );
    }
} else {
    if ( !empty( $_GET ) ) { //URL DE RESP. ONLINE

        $version = $_GET[ "Ds_SignatureVersion" ];
        $datos = $_GET[ "Ds_MerchantParameters" ];
        $signatureRecibida = $_GET[ "Ds_Signature" ];


        $decodec = $miObj->decodeMerchantParameters( $datos );
        $kc = $fila[ 'KEY' ]; //Clave recuperada de CANALES
        //$kc='sq7HjrUOBfKmC576ILgskD5srU870gJ7';
        $firma = $miObj->createMerchantSignatureNotif( $kc, $datos );


        if ( $firma === $signatureRecibida ) {


            require( "../SMTP/class.phpmailer.php" );
            require( "../SMTP/class.smtp.php" );


            $datos = $_SESSION[ 'user_evento_id' ];
            $sql = "UPDATE `form` SET `ESTADO`=:estado WHERE EMAIL=:email";
            $respuesta = $cnt->prepare( $sql );
            $respuesta->execute( array( ":estado" => 1, ":email" => $datos[ 'EMAIL' ] ) );

            //****************GESTION DE PAGO******************//
            $sql1 = "UPDATE `pendiete` SET `CUOTA_ESTADO`=:cuota_estado, `ACOMPA_ESTADO`=:acompa_estado  WHERE USER_ID=:id";
            $respuesta1 = $cnt->prepare( $sql1 );
            $respuesta1->execute( array( ":cuota_estado" => "PAGADO", ":acompa_estado" => "PAGADO", ":id" => $datos[ 'ID' ] ) );

            //****************GESTION DE PAGO HOTEL******************//

            $sql1 = "UPDATE `reservas_hotel` SET 
	`HOTEL_CUOTA`=:cuota_hotel,
	`HOTEL_PAGO`=:pago_hotel,
	`HOTEL_ESTADO`=:esto_hotel,
	`HOTEL_APOYO`=:apoyo_hotel WHERE USER_ID=:id";
            $respuesta1 = $cnt->prepare( $sql1 );
            $respuesta1->execute( array(
                ":cuota_hotel" => $datos[ 'TOTAL_CUOTA_HOTEL' ],
                ":pago_hotel" => "TPV",
                ":esto_hotel" => "PAGADO",
                ":apoyo_hotel" => 0.00,
                ":id" => $datos[ 'ID' ] ) );
            //****************GESTION DE PAGO HOTEL******************//

            $sql1 = "UPDATE `pedidos` SET `ESTADO`=:estado WHERE  USER_ID=:id AND PEDIDO=:pedido";
            $respuesta1 = $cnt->prepare( $sql1 );
            $respuesta1->execute( array(
                ":estado" => 1,
                ":id" => $datos[ 'ID' ],
                ":pedido" => $datos[ 'pedido' ] ) );


            $texto = "Le confirmamos su pago e inscripción al evento <strong>" . $evento[ 'NAME' ] . "</strong>.<br><br>
					
Acceso a la plataforma<br><br>
		<strong>WEB: </strong> <a href='https://" . $_SERVER[ 'HTTP_HOST' ] . "/log.php'>Ir a mi área personal</a><br>
<strong>Usuario: </strong>" . $datos[ 'EMAIL' ] . "<br>
<strong>Contraseña: </strong> Cumpliendo con el Reglamento UE 679/2016, de 27 de abril, General de Protección de Datos,
y con la Ley Orgánica 3/2018, de Protección de Datos Personales y Garantía de los Derechos Digitales, no
tenemos acceso a su contraseña. Si no la recuerda puede recuperarla pulsando en <span style='color:" . $evento[ 'COLOR' ] . "'>¿Ha olvidado su
contraseña?</span>, en la caja de inicio de sesión.<br><br>
";
			$envio=true;
            $cuota_m_pago = "";
            $acompa_m_pago = "";
            $hotel_m_pago = "";
            $email = $_SESSION[ 'user_evento_id' ][ 'EMAIL' ];
            $cuota = $datos[ 'CUOTA' ];
            $acuota_hab = $datos[ 'TOTAL_CUOTA_HOTEL' ];
            $pago = "TPV";
            $acompa = $_SESSION[ 'user_evento_id' ][ 'ACOMPA' ];
          if($_SESSION[ 'user_evento_id' ][ 'LAN' ]=='ES'){
            include( '../mail.php' );
          }else{
            include( '../mail-en.php' );

          }
           
         header( "location:https://" . $_SERVER[ 'HTTP_HOST' ] . "/inscripciones.php?inscrito=true" );


        } else {

            include( '../config.php' );
            session_start();

            $datos = $_SESSION[ 'user_registradores_id' ];
            $sql = "UPDATE `form` SET `ESTADO`=:estado WHERE EMAIL=:email";
            $respuesta = $cnt->prepare( $sql );
            $respuesta->execute( array( ":estado" => 2, ":email" => $datos[ 'EMAIL' ] ) );
            header( "location:https://" . $_SERVER[ 'HTTP_HOST' ] . "/inscripciones.php?inscrito=false" );
        }


    } else {

        header( "location:https://" . $_SERVER[ 'HTTP_HOST' ] . "/inscripciones.php?inscrito=false" );
    }
}

?>