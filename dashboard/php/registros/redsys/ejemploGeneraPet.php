<?php
// Se incluye la librería
include( '../config.php' );
require( "../SMTP/class.phpmailer.php" );
require( "../SMTP/class.smtp.php" );
include 'apiRedsys.php';

session_start(); // Se crea Objeto
$datos =  $_SESSION[ 'user_evento_id' ];
$miObj = new RedsysAPI;

$sql="SELECT * FROM pagos";
$resultado=$cnt->prepare($sql);
$resultado->execute();
$fila=$resultado->fetch(PDO::FETCH_ASSOC);

$sql="SELECT * FROM evento";
$resultado=$cnt->prepare($sql);
$resultado->execute();
$fila2=$resultado->fetch(PDO::FETCH_ASSOC);

$sql="SELECT * FROM generales_form";
$resultado=$cnt->prepare($sql);
$resultado->execute();
$generales_form=$resultado->fetch(PDO::FETCH_ASSOC);

$sql="SELECT * FROM cuotas";
$resultado=$cnt->prepare($sql);
$resultado->execute();
while($fila3=$resultado->fetch(PDO::FETCH_ASSOC)){
	$cuotas[]=$fila3;
};
// Valores de entrada que no hemos cmbiado para ningun ejemplo

$fuc = $fila['CLAVE_COMERCIO'];

$terminal = "001";
$moneda = "978";
$trans = "0";
$url = "https://".$_SERVER[ 'HTTP_HOST' ]."/assets/php/redsys/ejemploRecepcionaPet.php";
$urlOK = "https://".$_SERVER[ 'HTTP_HOST' ]."/assets/php/redsys/ejemploRecepcionaPet.php";
$urlKO = "https://".$_SERVER[ 'HTTP_HOST' ]."/assets/php/redsys/ejemploRecepcionaPet2.php";
$id = time();

$total=$_SESSION[ 'user_evento_id' ][ 'CUOTA' ]+ $_SESSION[ 'user_evento_id' ][ 'CUOTA_ACOMPA' ]+$_SESSION[ 'user_evento_id' ][ 'TOTAL_CUOTA_HOTEL' ] ;


$amount = $total * 100;


// Se Rellenan los campos

$miObj->setParameter( "DS_MERCHANT_AMOUNT", $amount );

$miObj->setParameter( "DS_MERCHANT_ORDER", $id );

$miObj->setParameter( "DS_MERCHANT_MERCHANTCODE", $fuc );

$miObj->setParameter( "DS_MERCHANT_CURRENCY", $moneda );

$miObj->setParameter( "DS_MERCHANT_TRANSACTIONTYPE", $trans );

$miObj->setParameter( "DS_MERCHANT_TERMINAL", $terminal );

$miObj->setParameter( "DS_MERCHANT_MERCHANTURL", $url );

$miObj->setParameter( "DS_MERCHANT_URLOK", $urlOK );

$miObj->setParameter( "DS_MERCHANT_URLKO", $urlKO );


//Datos de configuración

$version = "HMAC_SHA256_V1";

//$kc = $fila['KEY']; //Clave recuperada de CANALES//;
$kc='sq7HjrUOBfKmC576ILgskD5srU870gJ7';
// Se generan los parámetros de la petición

$request = "";

$params = $miObj->createMerchantParameters();

$signature = $miObj->createMerchantSignature( $kc );

$datos[ "pedido" ] = $id;

 $_SESSION[ 'user_evento_id' ] = $datos;

$sql1 = "INSERT INTO `pedidos`(`USER_ID`, `PEDIDO`, `DATE`, `ESTADO`) VALUES (:id,:pedido,:date,:estado)";
$respuesta1 = $cnt->prepare( $sql1 );
$respuesta1->execute( array( ":id" => $datos[ 'ID' ], ":pedido" => $datos[ 'pedido' ], ":date" => date( "F j, Y, g:i a" ), ":estado" => 0 ) );

 $texto = "Le confirmamos que sus datos han sido registrados para <strong>". $fila2['NAME'] ."</strong> que se celebrará del día ". date( 'd', strtotime( $fila2['FECHA_INICIO'] ) ) ." al día ". date( 'd', strtotime( $fila2['FECHA_CIERRE'] ) ) ." de septiembre de " . date( 'Y', strtotime( $fila2['FECHA_CIERRE'] ) ) . ".<br><br>
 Si desea completar su pedido puede acceder a su área personal de la web y desde ahí completar el pago desde nuestra pasarela de pago seguro. Si ya ha realizado el pago omita este comunicado.
 <br><br>Acceso a la plataforma<br><br>
		<strong>WEB: </strong> <a href='https://" . $_SERVER[ 'HTTP_HOST' ] . "/log.php'>Ir a mi área personal</a><br>
<strong>Usuario: </strong>" . $datos[ 'EMAIL' ] . "<br>
<strong>Contraseña: </strong> Cumpliendo con el Reglamento UE 679/2016, de 27 de abril, General de Protección de Datos,
y con la Ley Orgánica 3/2018, de Protección de Datos Personales y Garantía de los Derechos Digitales, no
tenemos acceso a su contraseña. Si no la recuerda puede recuperarla pulsando en <span style='color:". $fila2['COLOR'] ."'>¿Ha olvidado su
contraseña?</span>, en la caja de inicio de sesión.<br><br>
		";
/*******************************************MAIL******************************************************/

        $para = $datos[ 'EMAIL' ];
        $titulo = "CONFIRMACIÓN DE REGISTRO";
        $mensaje = "<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>CONFIRMACIÓN DE CONTACTO</title>
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
	<img src='https://" . $_SERVER[ 'HTTP_HOST' ] . "/assets/mail/header-mail.png' style='width: 650px' height='211px'>
				</td></tr>
			<tr style='height: 30px;'><td></td><td></td><td></td></tr>
			<tr><td style='width: 100px;'></td>
				<td>
				<h3 style='color:". $fila2['COLOR'] ."; text-align: left!important; padding: 20px 0px'>Estimado/a, " . $datos[ 'TITULO' ] . " " . $datos[ 'NAME' ] . " " . $datos[ 'SURNAME' ] . "</h3>
					<p style='text-align: left!important; color: #000;font-size:18px;'>" . $texto . "
Un cordial saludo,<br>
<strong>Secretaría Técnica ". $fila2['NAME'] .".</strong>

	<br><br></p><p style='text-align: left!important; color: #848484'>
					
					</td><td></td></tr>
						
		<tr><td colspan='3'><img src='https://" . $_SERVER[ 'HTTP_HOST' ] . "/assets/mail/footer-mail.png' width='650px' height='79px'></td></tr>				
		
			
		</tbody>
	</table>
</div>
</body>
</html>";


        
        $email_user = "noreply@avstreaming.es";
        $email_password = "NoPlyStreaming20";
        $the_subject = $titulo;
        $address_to = $para;
        $from_name = "CARDIOMIR 2023";
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
?>


<?php include('../../../assets/php/layouts/nav.php')?>

<section class="banner-main-con mt-5 mb-5">
    <div class="container mb-5">

        <!--banner-start-->
        <div class="row">
            <div class="banner-con text-center col-lg-9 col-md-9 col-12 m-auto mb-5">

                <h1><span class="far fa-lock-alt"></span> PAGO SEGURO</h1>
                <h4 style="line-height: normal" class="text-danger">Sus datos han quedado registrados. Continúe el pago
                    para activar su registro o puede completar su pago desde su Área Personal más adelante.</h4>
                <p class="col-lg-7 col-md-8 p-0 ml-auto mr-auto">A continuación dejamos el resumen de pedido <br>No
                    <?php echo $_SESSION[ 'user_evento_id' ]['pedido']?>.</p>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex">
                        <p class="w-100 text-left mb-0">
                            <?php foreach($cuotas as $elemento): if($elemento['PRECIO']==$_SESSION[ 'user_evento_id' ]['CUOTA']):echo $elemento['NAME']; endif;endforeach; ?>
                        </p>
                        <p class="text-right mb-0">
                            <?php echo  number_format( $_SESSION[ 'user_evento_id' ]['CUOTA'], 2, ',', '.' )  ?>€</p>
                    </li>
                    <?php if($generales_form['ESTADO_ACOMPA']==1 and $datos['ACOMPA']=="Si"):?>
                    <li class="list-group-item d-flex">
                        <p class="w-100 text-left mb-0">
                            <?php foreach($cuotas as $elemento): if($elemento['PRECIO']==$_SESSION[ 'user_evento_id' ][ 'CUOTA_ACOMPA' ]):echo $elemento['NAME']; endif;endforeach; ?>
                        </p>
                        <p class="text-right mb-0">
                            <?php echo number_format(  $_SESSION[ 'user_evento_id' ][ 'CUOTA_ACOMPA' ], 2, ',', '.' ) ?>
                        </p>
                    </li>

                    <?php endif; ?>
                    <?php if($generales_form['ESTADO_ALOJAMIENTO']==1 and $datos['HABITACION']!=""):?>
                    <li class="list-group-item d-flex">
                        <p class="w-100 text-left mb-0">Noches x <?php echo $datos['NOCHES'] ?></p>
                        <p class="text-right mb-0">
                            <?php echo number_format( $_SESSION[ 'user_evento_id' ][ 'TOTAL_CUOTA_HOTEL' ], 2, ',', '.' )  ?>€
                        </p>
                    </li>
                    <?php endif; ?>
                    <li class="list-group-item d-flex">
                        <p class="w-100 text-left mb-0"><strong>Total a pagar</strong></p>
                        <p class="text-right mb-0">
                            <strong><?php echo number_format($total, 2, ',', '.' )."€" ?></strong>
                        </p>
                    </li>
                </ul>
                <form name="frm" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" target="_blank">
                    <!--https://sis.redsys.es/sis/realizarPago---- //---https://sis-t.redsys.es:25443/sis/realizarPago-->
                    <div style="display: none"> Ds_Merchant_SignatureVersion
                        <input type="text" name="Ds_SignatureVersion" value="<?php echo $version; ?>" />
                        </br>
                        Ds_Merchant_MerchantParameters
                        <input type="text" name="Ds_MerchantParameters" value="<?php echo $params; ?>" />
                        </br>
                        Ds_Merchant_Signature
                        <input type="text" name="Ds_Signature" value="<?php echo $signature; ?>" />
                        </br>
                    </div>
                    <button class="btn w-100 text-white rounded-pill mt-3"
                        style="background: <?php echo $fila2['COLOR']?>" type="submit"><span
                            class="far fa-lock-alt"></span>Ir a pagar</button>
                </form>
            </div>
        </div>
        <!--banner-end-->

</section>
</div>
</div>
<?php include("../layouts/footer.php");?>

</body>

</html>