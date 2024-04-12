<?php


if ( $_POST ) {


    include( "../../assets/php/config.php" );
    require( "../../assets/php/SMTP/class.phpmailer.php" );
    require( "../../assets/php/SMTP/class.smtp.php" );

    $email = $_POST[ 'id' ];


    $sql2 = "UPDATE form SET ESTADO=:status WHERE EMAIL= :email";

    $resultado2 = $cnt->prepare( $sql2 );

    $resultado2->execute( array( ":status" => 1, ":email" => $email ) );

    $sql3 = 'SELECT *FROM form WHERE EMAIL=:email';
    $resultado3 = $cnt->prepare( $sql3 );
    $resultado3->execute( array( ":email" => $email ) );
    $fila3 = $resultado3->fetch( PDO::FETCH_ASSOC );


    //*********************************************************Mail***************************************************************************//



    $para = $email;
    $titulo = "CONFIRMACION DE INSCRIPCION";
    $mensaje = "<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>CONFIRMACIÓN DE INSCRIPCION</title>
	<style>
		*{
			margin: auto;
			text-align: center;
		}
	</style>
</head>
<body>
<div style='width: 100%; height: 100%; background: #E9E9E9;margin:auto;text-align:center'>
	<table style='background: white; width: 650px;margin: auto; font-family: Arial, sans-serif;font-size: 14px;' cellpadding='0' cellspacing='0'>
		<tbody style='text-align:left!important'>
			<tr><td colspan='3'>
	<img src='https://registradores2023.es/assets/image/MAIL/header-mail.png' style='width: 650px' height='211px'>
				</td></tr>
			<tr style='height: 30px;'><td></td><td></td><td></td></tr>
			<tr><td style='width: 100px;'></td>
				<td>
				<h3 style='color:#00b7d7; text-align: left!important; padding: 20px 0px'>Estimado/a, " . $fila3['NAME'] . " ".$fila3['SURNAME']."</h3>
					<p style='text-align: left!important; color: #000;font-size:18px;'>Le confirmamos que su inscripción al <strong>VII Congreso de Registradores de la propiedad</strong> que se celebrará los días 04, 05 y 06 de octubre de 2023 ha quedado validada.<br><br>Acceso a la plataforma<br><br>
		<strong>WEB: </strong> <a href='https://registradores2023.es/acceso.php'>Ir a mi área personal</a><br>
<strong>Usuario: </strong>". $email."<br>
<strong>Contraseña: </strong> Cumpliendo con el Reglamento UE 679/2016, de 27 de abril, General de Protección de Datos,
y con la Ley Orgánica 3/2018, de Protección de Datos Personales y Garantía de los Derechos Digitales, no
tenemos acceso a su contraseña. Si no la recuerda puede recuperarla pulsando en <span style='color:#00b7d7'>¿Ha olvidado su
contraseña?</span>, en la caja de inicio de sesión.<br><br>

Un cordial saludo,<br>
<strong>Secretaría Técnica VII Congreso de Registradores de la propiedad.</strong>

	<br><br></p><br><p style='text-align: left!important; color: #848484'>
					
					</td><td></td></tr>
					
						
		<tr><td colspan='3'><img src='https://registradores2023.es/assets/image/MAIL/footer-mail.png' width='650px' height='79px'></td></tr>				
		
			
		</tbody>
	</table>
</div>
</body>
</html>";

    $email_user = "noreply@avstreaming.es";
            $email_password = "NoPlyStreaming20";
            $the_subject = $titulo;
            $address_to = $para;
            $from_name = "VII Congreso de Registradores";
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
            $phpmailer->CharSet = "UTF-8";
            $phpmailer->Subject = $the_subject;
            $phpmailer->Body .= $mensaje;
            $phpmailer->IsHTML( true );

            $phpmailer->Send();

    echo "success";


}


?>