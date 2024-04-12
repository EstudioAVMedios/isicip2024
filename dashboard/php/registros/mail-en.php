<?php

//**************************SELECCIÓN DE TEXTO DE EMAIL SEGÚN TIPO DE PAGO************************//
if ( $pago == "TRANSFERENCIA" ) {
    $texto = "You have been pre-registered for the <strong>" . $evento[ 'NAME' ] . 
    "</strong><br><br> As soon as we receive the bank confirmation of your payment, you will receive 
    a notification with the validation of your user to access the private area of the meeting platform: <a href='https://fcsepsismeetings.com/'>https://fcsepsismeetings.com/</a>.<br><br> 
        Your login details are as follows:<br><br>Username:".$_SESSION[ 'user_evento_id' ][ "EMAIL" ]."
        <br>Password:".$_SESSION[ 'user_evento_id' ][ "PASS" ]."<br><br>";					
// (Una vez comprobemos el ingreso en nuestro extracto bancario, se notificará la confirmación de la inscripción por e-mail).<br><br>";
// if($pagos['TITULAR_CUENTA']!=""){
//     $texto .="<strong>Account holder: </strong> $pagos[TITULAR_CUENTA]<br>";
// }
// if($pagos['ENTIDAD']!=""){
//     $texto .="<strong>Bank: </strong> $pagos[ENTIDAD]<br>";
// }
// if($pagos['IBAM']!=""){
//     $texto .="<strong>IBAN: </strong> $pagos[IBAM]<br>";
// }
// if($pagos['SWIFT_CODE']!=""){
//     $texto .="<strong> SWIFT CODE:  </strong> $pagos[SWIFT_CODE]<br><br>";
// }
// if($pagos['CONCEPTO']!=""){
//     $texto .="<strong>Email Subject: </strong> $pagos[CONCEPTO]<br>";
// }


} else if ( $pago == "FREE" ) {
    $texto = "We inform that you have been successfully registered for the  <strong>" . $evento[ 'NAME' ] . "</strong>.
     <br><br>  Your access data to the personal area of the meeting platform <a href='https://fcsepsismeetings.com/'>(https://fcsepsismeetings.com/) </a> are the following:<br>
         <br>Username:".$_SESSION[ 'user_evento_id' ][ "EMAIL" ]."
         <br>Password:".$_SESSION[ 'user_evento_id' ][ "PASS" ]."<br><br> ";

}

if ( $envio ) {
    $texto.="<em>
    You can change your password at any time by clicking on I forgot my password.</em> <br><br>This email does not receive return communications. If you have any questions to our organizing team or wish to contact us, please write to eventos03@cerotreseventos.es.";
    /*******************************************MAIL******************************************************/
    $total = $cuota + $acompa_cuota + $acuota_hab;
    $bloque_cuota = "<h5 style='background:" . $evento[ 'COLOR' ] . ";color:white; width:100%;font-size:18px;padding-top:10px;padding-bottom:10px;padding-left:10px'>Summary amount to pay</h5><br><p style='padding-left:10px;padding-right:10px'>";
    if ( $cuota_m_pago == "" ) {
        $bloque_cuota .= "<strong>Método de pago: </strong>" . $code. "<br>";
    }
    $bloque_cuota .= "<strong>Cuota ". $_SESSION[ 'user_evento_id' ][ 'CATEGORIA' ].": </strong> " . number_format( $cuota, 2, ',', '.' ) . "€ " . $cuota_m_pago . "<br>";
    if ( $sesiones[ 'ESTADO_ACOMPA' ] == 1 ):
        $bloque_cuota .= "<strong>Cuota Asistente: </strong> " . number_format( $acompa_cuota, 2, ',', '.' ) . " € " . $acompa_m_pago . "<br>";
    endif;
    if ( $sesiones[ 'ESTADO_ALOJAMIENTO' ] == 1 and $_SESSION[ 'user_evento_id' ][ 'HABITACION' ] != "" ):
        if ( $sender ) {
            $bloque_cuota .= $bloque_alojamiento_sender;
        } else {
            $bloque_cuota .= "<strong> Alojamiento: </strong>" . number_format( $acuota_hab, 2, ',', '.' ) . "€ " . $hotel_m_pago . "<br>";
        }

    endif;
    $bloque_cuota .= "<strong>TOTAL:  </strong> " . number_format( $total, 2, ',', '.' ) . "€<br><br></p>";

    $bloque_personales = "<br><h5 style='background:" . $evento[ 'COLOR' ] . ";color:white; width:100%;font-size:18px;padding-top:10px;padding-bottom:10px;padding-left:10px'>Personal Information</h5><br><p style='padding-left:10px;padding-right:10px'>";

    foreach ( $campos_all as $elemento ) {
        if ( $elemento[ 'TIPO' ] == "USUARIO" ):
            if ( $elemento[ 'CAMPO' ] != "PASS"
                and $elemento[ 'CAMPO' ] != "PATROCINADOR"
                and $elemento[ 'CAMPO' ] != "EMAIL_PATROCINADOR" ):
                if($elemento[ 'CAMPO' ] == "PAIS"):
                $bloque_personales .= "<strong>Location: </strong>" . $_SESSION[ 'user_evento_id' ][ $elemento[ 'CAMPO' ] ] . "<br>";
                else:
                $bloque_personales .= "<strong>$elemento[PLACEHOLDER]: </strong>" . $_SESSION[ 'user_evento_id' ][ $elemento[ 'CAMPO' ] ] . "<br>";
        endif;
    endif;
        endif;
    }

    if ( $sesiones[ 'ESTADO_ACOMPA' ] == 1 ):
        $bloque_acompa = "</p><br><h5 style='background:" . $evento[ 'COLOR' ] . ";color:white; width:100%;font-size:18px;padding-top:10px;padding-bottom:10px;padding-left:10px'>Acompanian Information</h5><br><p style='padding-left:10px;padding-right:10px'>";

    foreach ( $campos_all as $elemento ) {
        if ( $elemento[ 'TIPO' ] == "ACOMPA" ):
            $bloque_acompa .= "<strong>$elemento[PLACEHOLDER]: </strong>" . $_SESSION[ 'user_evento_id' ][ "A$elemento[CAMPO]" ] . "<br>";
        endif;
    }
    endif;

    if ( $sesiones[ 'ESTADO_FACTURA' ] == 1 ):
        $bloque_facturacion = "</p><br><h5 style='background:" . $evento[ 'COLOR' ] . ";color:white; width:100%;font-size:18px;padding-top:10px;padding-bottom:10px;padding-left:10px'>Invoice Information</h5><br><p style='padding-left:10px;padding-right:10px'>";
    foreach ( $campos_all as $elemento ) {
        if ( $elemento[ 'TIPO' ] == "FACT" ):
            $bloque_facturacion .= "<strong>$elemento[PLACEHOLDER]: </strong>" . $_SESSION[ 'user_evento_id' ][ "F$elemento[CAMPO]" ] . "<br>";
        endif;
    }
    endif;
    if ( $sesiones[ 'ESTADO_ALOJAMIENTO' ] == 1 and $_SESSION[ 'user_evento_id' ][ 'HABITACION' ] != "" ):
        if ( empty( $reserva ) ) {

            $bloque_alojamiento = "</p><br><h5 style='background:" . $evento[ 'COLOR' ] . ";color:white; width:100%;font-size:18px;padding-top:10px;padding-bottom:10px;padding-left:10px'>Hotel</h5><br>
		<p style='padding-left:10px;padding-right:10px''>
		<strong>Hotel:</strong> " . $_SESSION[ 'user_evento_id' ][ 'HOTEL' ] . "<br>
		<strong>Habitación:</strong> " . $_SESSION[ 'user_evento_id' ][ 'HABITACION' ] . "<br>
		<strong>Noches:</strong> " . $_SESSION[ 'user_evento_id' ][ 'NOCHES' ] . "<br>
		<strong>Fecha de Entrada:</strong> " . $_SESSION[ 'user_evento_id' ][ 'F_ENTRADA' ] . "<br>
		<strong>Fecha de Salida:</strong> " . $_SESSION[ 'user_evento_id' ][ 'F_SALIDA' ] . "<br>	
		</p>";

        } else {
            foreach ( $reserva as $elemento ):
                if ( $elemento[ "HABITACION" ] != 0.00 ) {
                    $_SESSION[ 'user_evento_id' ][ 'HOTEL' ] = $habitaciones[ 0 ][ 'HOTEL' ];
                } else {
                    $_SESSION[ 'user_evento_id' ][ 'HOTEL' ] = "";
                }
            foreach ( $habitaciones as $elemento2 ) {

                if ( $elemento[ "HABITACION" ] == $elemento2[ 'PRECIO' ] ) {
                    $_SESSION[ 'user_evento_id' ][ 'HABITACION' ] = $elemento2[ 'HABITACION' ];
                }
            }

            $bloque_alojamiento .= "<br><h5 style='background:" . $evento[ 'COLOR' ] . ";color:white; width:100%;padding-top:10px;padding-bottom:10px;padding-left:10px'Booking | " . $elemento[ 'ID' ] . "</h5><br>
		<br><p style='padding-left:10px;padding-right:10px''>	
		<strong>Hotel:</strong> " . $_SESSION[ 'user_evento_id' ][ 'HOTEL' ] . "<br>
		<strong>Habitación:</strong> " . $_SESSION[ 'user_evento_id' ][ 'HABITACION' ] . "<br>
		<strong>Noches:</strong> " . $elemento[ 'NOCHES' ] . "<br>
		<strong>Fecha de Entrada:</strong> " . $elemento[ 'F_ENTRADA' ] . "<br>
		<strong>Fecha de Salida:</strong> " . $elemento[ 'F_SALIDA' ] . "<br>	
		</p><br>";
            endforeach;
        }
    endif;
    if ( $sesiones[ 'ESTADO_EXTRAS' ] == 1 ):
        $bloque_extras = "<br><h5 style='background:" . $evento[ 'COLOR' ] . ";color:white; width:100%;font-size:18px;padding-top:10px;padding-bottom:10px;padding-left:10px'>Others Services</h5><br><p style='padding-left:10px;padding-right:10px'> ";
    foreach ( $campos_all as $elemento ) {
        if ( $elemento[ 'TIPO' ] == "EXTRA"
            or $elemento[ 'TIPO' ] == "EXTRA_SER" ):
            $bloque_extras .= "<strong>$elemento[PLACEHOLDER]: </strong>" . $_SESSION[ 'user_evento_id' ][ "E$elemento[CAMPO]" ] . "<br>";
        endif;
    }
    endif;
    if ( $sesiones[ 'ESTADO_PROF' ] == 1 ):
        $bloque_profesionales = "</p><br><h5 style='background:" . $evento[ 'COLOR' ] . ";color:white; width:100%;font-size:18px;padding-top:10px;padding-bottom:10px;padding-left:10px'>Professional Information</h5><br><p style='padding-left:10px;padding-right:10px'>";
    foreach ( $campos_all as $elemento ) {
        if ( $elemento[ 'TIPO' ] == "PROF" ):
            $bloque_profesionales .= "<strong>$elemento[PLACEHOLDER]: </strong>" . $_SESSION[ 'user_evento_id' ][ "P$elemento[CAMPO]" ] . "<br>";
        endif;
    }
    endif;


    $para = $_SESSION[ 'user_evento_id' ][ "EMAIL" ];
    $titulo = "CONFIRMACIÓN DE REGISTRO";
    $mensaje = "<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>CONFIRMACIÓN DE CONTACTO</title>
	<style>
		*{
			margin: auto;
			text-align: left;
		}
	</style>
</head>
<body>
<div style='width: 100%; height: 100%; background: #E9E9E9;margin:auto;text-align:center'>
	<table style='background: white; width: 650px;margin: auto; font-family: Arial, sans-serif;font-size: 14px;' cellpadding='0' cellspacing='0'>
		<tbody style='text-align:left!important'>
<tr><td colspan='3'><img alt='".$evento[ 'NAME']."' src='https://" . $_SERVER[ 'HTTP_HOST' ] . "/dashboard/Imagenes/mail/header-mail.png' style='width: 650px' height='211px'></td></tr>
<tr style='height: 30px;'><td></td><td></td><td></td></tr>
<tr>
<td style='width: 50px;'></td>
<td style='width: 550px;'>
<h3 style='color:" . $evento[ 'COLOR' ] . "; text-align: left!important; padding: 20px 0px'>Welcome Mr/Mrs/Ms , " . $_SESSION[ 'user_evento_id' ][ 'SURNAME' ] . "</h3>
<p style='text-align: left!important; color: #000;font-size:18px;width:100%'>" . $texto . "
<br><br>Best regards,<br>
<strong>" . $evento[ 'NAME' ] . ".</strong>
<br><br></p><p style='text-align: left!important; color: #848484'>
</td>
<td style='width: 50px;'></td>
</tr>
		
<tr>
<td style='width: 50px;'></td>
<td>
        $bloque_cuota	
		$bloque_personales
		$bloque_profesionales
		$bloque_facturacion
		$bloque_acompa
		$bloque_alojamiento
		$bloque_extras	
			<br><br><h5>Secretaría Técnica " . $evento[ 'NAME' ] . ".</h5>
			<hr>
		<br><p style='width:100%'>" . $evento[ 'EMPRESA_SECRETARIA' ] . "<br>
Tel. " . $evento[ 'TEL_SECRETARIA' ] . "<br>
Correo Electrónico. " . $evento[ 'EMAIL_SECRETARIA' ] . "</p><br>
	
<hr><br><br>
		<h5 style='width:100%;text-align:center'>Política de Privacidad y Avisos Legales</h5>
		<hr>
		<p style='width:100%;text-align:center'><a href='".$evento[ 'PP' ]."'> Política de Privacidad y Avisos legales</a></p><br><br>
	</td>
		<td style='width: 50px;'></td>
			
			</tr>
						
		<tr><td colspan='3'><img src='https://" . $_SERVER[ 'HTTP_HOST' ] . "/dashboard/Imagenes/mail/footer-mail.png' width='650px' height='79px'></td></tr>				
		
			
		</tbody>
	</table>
</div>
</body>
</html>";
    $email_user = "noreply@avstreaming.es";
    $email_password = "NoPlyStreaming20";
    $the_subject = $titulo;
    $address_to = $para;
    $from_name = $evento[ 'NAME' ];
    $phpmailer = new PHPMailer();

    // ———- datos de la cuenta de Gmail ——————————-
    $phpmailer->Username = $email_user;
    $phpmailer->Password = $email_password;
    //———————————————————————–
    // $phpmailer->SMTPDebug = 1;
    $phpmailer->SMTPSecure = 'ssl';
    $phpmailer->Host = "mail.avstreaming.es"; // GMail
    $phpmailer->Port = 465;

    $phpmailer->IsSMTP(); // use SMTP
    $phpmailer->SMTPAuth = true;

    $phpmailer->setFrom( $phpmailer->Username, $from_name );
    $phpmailer->AddAddress( $address_to ); // recipients email
    if($copia_agencia!=""):
        $phpmailer->AddCC($copia_agencia);
    endif;
    $phpmailer->CharSet = "UTF-8";
    $phpmailer->Subject = $the_subject;
    $phpmailer->Body .= $mensaje;
    $phpmailer->IsHTML( true );

    $phpmailer->Send();
}

if ( $send_copia ):
    $mensaje2 = "<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>CONFIRMACIÓN DE CONTACTO</title>
	<style>
		*{
			margin: auto;
			text-align: Left;
		}
	</style>
</head>
<body>
<div style='width: 100%; height: 100%; background: #E9E9E9;margin:auto;text-align:left'>
	<table style='background: white; width: 650px;margin: auto; font-family: Arial, sans-serif;font-size: 14px;' cellpadding='0' cellspacing='0'>
		<tbody style='text-align:left!important'>
			<tr><td colspan='3'>
            <img src='https://" . $_SERVER[ 'HTTP_HOST' ] . "/dashboard/Imagenes/mail/header-mail.png' style='width: 650px' height='211px'>
				</td></tr>
			<tr style='height: 30px;'><td></td><td></td><td></td></tr>
			<tr><td style='width: 50px;'></td>
				<td>
				<h3 style='color:" . $evento[ 'COLOR' ] . "; text-align: left!important; padding: 20px 0px'>Hola Cero3</h3>";
                if($error):
$mensaje2.="<h3 style='color:red'>Error en pago de TPV</h3>";
                endif;
                $mensaje2.="<p style='text-align: left!important; color: #000;font-size:18px;'>Ha recibido un nuevo registro para " . $evento[ 'NAME' ] . ".<br><br>
					<ul>
					<li><strong>ID: </strong>" . $_SESSION[ 'user_evento_id' ][ 'ID' ] . "</li>
					<li><strong>Nombre: </strong>" . $_SESSION[ 'user_evento_id' ][ 'NAME' ] . "</li>
					<li><strong>Apellidos: </strong>" . $_SESSION[ 'user_evento_id' ][ 'SURNAME' ] . "</li>
                    <li><strong>Email: </strong>" . $_SESSION[ 'user_evento_id' ][ 'EMAIL' ] . "</li>
                    <li><strong>Código: </strong>" . $_SESSION[ 'user_evento_id' ][ "CODE" ] . "</li>
                    <li><strong>Categoria: </strong>" . $_SESSION[ 'user_evento_id' ][ "CATEGORIA" ] . "</li>
                    <li><strong>Método de pago: </strong>" . $pago . "</li>";
                    
if ( $sesiones[ 'ESTADO_ACOMPA' ] == 1 ):
    $mensaje2 .= "<li><strong>Acompañante: </strong>" . $acompa . "</li>";
endif;
if ( $sesiones[ 'ESTADO_ALOJAMIENTO' ] == 1 ):
    $mensaje2 .= "<li><strong>Reserva de Hotel: </strong>" . $_SESSION[ 'user_evento_id' ][ 'HABITACION' ] . "</li>";
endif;
$mensaje2 .= "<h5>Secretaría Técnica " . $evento[ 'NAME' ] . ".</h5>
			<hr>
		<p style='width:100%'>" . $evento[ 'EMPRESA_SECRETARIA' ] . "<br>
Tel. " . $evento[ 'TEL_SECRETARIA' ] . "<br>
Correo Electrónico. " . $evento[ 'EMAIL_SECRETARIA' ] . "</p>
	
<hr><br><br>
		<h5 style='width:100%;text-align:center'>Política de Privacidad y Avisos Legales</h5>
		<hr>
		<p style='width:100%;text-align:center'><a href=".$evento[ 'PP' ]."> Política de Privacidad y Avisos legales</a></p><br><br>
		<td></td><tr><td style='width: 50px;'></td></tr>			
		<tr><td colspan='3'><img src='https://" . $_SERVER[ 'HTTP_HOST' ] . "/dashboard/Imagenes/mail/footer-mail.png' width='650px' height='79px'></td></tr>
		</tbody>
	</table>
</div>
</body>
</html>";


$email_user = "noreply@avstreaming.es";
$email_password = "NoPlyStreaming20";
$from_name = $evento[ 'NAME' ];

$phpmailer2 = new PHPMailer();
// ———- datos de la cuenta de Gmail ——————————-
$phpmailer2->Username = $email_user;
$phpmailer2->Password = $email_password;
//———————————————————————–
// $phpmailer->SMTPDebug = 1;
$phpmailer2->SMTPSecure = 'ssl';
$phpmailer2->Host = "mail.avstreaming.es"; // GMail
$phpmailer2->Port = 465;
$phpmailer2->IsSMTP(); // use SMTP
$phpmailer2->SMTPAuth = true;

$phpmailer2->setFrom( $phpmailer2->Username, $from_name );
$phpmailer2->AddAddress($evento[ 'EMAIL_SECRETARIA']); // recipients email $evento[ 'EMAIL_SECRETARIA']
$phpmailer2->CharSet = "UTF-8";
$phpmailer2->Subject = 'NUEVA INSCRIPCION';
$phpmailer2->Body .= $mensaje2;
$phpmailer2->IsHTML( true );

$phpmailer2->Send();
endif;
?>