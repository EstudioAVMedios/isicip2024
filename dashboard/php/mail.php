<?php
include("../../assets/php/config.php");
require( "../../assets/php/SMTP/class.phpmailer.php" );
require( "../../assets/php/SMTP/class.smtp.php" );

if(isset($_POST['destinatario']) and isset($_POST['asunto']) and isset($_POST['mensaje'])){
/*******************************************MAIL******************************************************/
$sql="SELECT * FROM form WHERE EMAIL=:email";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":email"=>$_POST[ 'destinatario' ]));
$fila=$respuesta->fetch(PDO::FETCH_ASSOC);

$sql="SELECT * FROM evento";
$respuesta=$cnt->prepare($sql);
$respuesta->execute();
$evento=$respuesta->fetch(PDO::FETCH_ASSOC);

		$name=$fila['NAME'];
		$surname=$fila['SURNAME'];
		$texto= $_POST['mensaje'];
        $para = $_POST[ 'destinatario' ];
        $titulo = $_POST['asunto'];
        $mensaje = "<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>CONTACTO</title>
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
	<img src='https://".$_SERVER['HTTP_HOST']."/dashboard/Imagenes/mail/header-mail.png' style='width: 650px' height='211px' alt=".$evento['NAME'].">
				</td></tr>
			<tr style='height: 30px;'><td></td><td></td><td></td></tr>
			<tr><td style='width: 100px;'></td>
				<td>
				<h3 style='color:".$evento['COLOR']."; text-align: left!important; padding: 20px 0px'>Estimado/a,  " . $name . " " . $surname . "</h3>
					<p style='text-align: left!important; color: #000;font-size:18px;'>" . $texto . "
<br><br>Un cordial saludo,<br>
	<br><br></p><p style='text-align: left!important; color: #848484'>
					</td><td></td></tr>
		<tr><tr><td style='width: 100px;'></td>		
	
			<h4>".$evento['NAME']."</h4>
			<hr>
		<p style='width:100%'>".$evento['EMPRESA_SECRETARIA']."<br>
Tel. ".$evento['TEL_SECRETARIA']."<br>
Email. ".$evento['EMAIL_SECRETARIA']."</p>
	
<hr>
		<h4>Política de Privacidad y Avisos Legales</h4>
		<hr>
		<p style='width:100%;text-align:center'><a href='".$evento['PP']."'> Política de Privacidad y Avisos legales</a></p>
		<td></td><tr><td style='width: 100px;'></td></tr>
		<tr><td colspan='3'><img src='https://".$_SERVER['HTTP_HOST']."/dashboard/Imagenes/mail/footer-mail.png' width='650px' height='79px' alt=".$evento['NAME']."></td></tr>
		</tbody>
	</table>
</div>
</body>
</html>";
        
        $email_user = "noreply@avstreaming.es";
        $email_password = "NoPlyStreaming20";
        $the_subject = $titulo;
        $address_to = $para;
        $from_name = $evento['NAME'];
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

        echo "ok";
	
}

?>