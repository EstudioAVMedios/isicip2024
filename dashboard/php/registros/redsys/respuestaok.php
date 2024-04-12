<?php

include 'apiRedsys.php';
include("../../../../assets/php/config.php");
$sql = "SELECT * FROM pagos";
$resultado = $cnt->prepare($sql);
$resultado->execute();
$pagos = $resultado->fetch(PDO::FETCH_ASSOC);

// Se crea Objeto
$miObj = new RedsysAPI;
date_default_timezone_set("Europe/Madrid");

if (!empty($_POST)) { //URL DE RESP. ONLINE
    ejecutarpedido($miObj, $pagos, $cnt);
} else {
    if (!empty($_GET)) { //URL DE RESP. ONLINE
        ejecutarpedido($miObj, $pagos, $cnt);
    } else {

        header("location:https://" . $_SERVER['SERVER_NAME'] . "/personal/index.php?payment=empty");
    }
}
function ejecutarpedido($miObj, $pago, $cnt)
{

    $version = $_GET["Ds_SignatureVersion"];
    $datos = $_GET["Ds_MerchantParameters"];
    $signatureRecibida = $_GET["Ds_Signature"];


    $decodec = $miObj->decodeMerchantParameters($datos);
    if ($pago['PRODUCTION'] == 'true') {
        $kc = $pago['KEY']; //Clave recuperada de CANALES
    } else {
        $kc = $pago['KEY_TEST']; //Clave recuperada de CANALES
    }
    $firma = $miObj->createMerchantSignatureNotif($kc, $datos);

    if ($firma === $signatureRecibida) {


        require("../SMTP/class.phpmailer.php");
        require("../SMTP/class.smtp.php");
        session_start();

        $datos = $_SESSION['user_evento_id'];
        $sql = "UPDATE `form` SET `ESTADO`=:estado WHERE ID=:id";
        $respuesta = $cnt->prepare($sql);
        $respuesta->execute(array(":estado" => 1, ":id" => $datos['ID']));

        $sql = "SELECT * FROM `pendiete` WHERE USER_ID=:id";
        $respuesta = $cnt->prepare($sql);
        $respuesta->execute(array(":id" => $datos['ID']));
        $pendiete = $respuesta->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM reservas_hotel WHERE USER_ID=:id";
        $respuesta = $cnt->prepare($sql);
        $respuesta->execute(array(":id" => $datos['ID']));
        while ($fila = $respuesta->fetch(PDO::FETCH_ASSOC)) {
            $reservas[] = $fila;
        }
        $sql1 = "UPDATE `pendiete` SET `CUOTA`=:cuota, `CUOTA_ESTADO`=:cuota_estado, `CUOTA_APOYO`=:cuota_apoyo  WHERE USER_ID=:id";
        $respuesta1 = $cnt->prepare($sql1);
        $respuesta1->execute(array(":cuota" => $pendiete['CUOTA_APOYO'], ":cuota_estado" => "PAGADO", ":cuota_apoyo" => 0, ":id" => $datos['ID']));

        $sql1 = "UPDATE `pedidos` SET `ESTADO`=:estado  WHERE PEDIDO=:pedido";
        $respuesta1 = $cnt->prepare($sql1);
        $respuesta1->execute(array(":estado" => 1, ":pedido" => $datos["pedido"]));

        //****************GESTION DE PAGO******************//
        if ($datos['ACOMPA'] == "No") {
            $sql1 = "UPDATE `pendiete` SET `CUOTA_ESTADO`=:cuota_estado, `CUOTA_APOYO`=:cuota_apoyo  WHERE USER_ID=:id";
            $respuesta1 = $cnt->prepare($sql1);
            $respuesta1->execute(array(":cuota_estado" => "PAGADO", ":cuota_apoyo" => 0, ":id" => $datos['ID']));
        } else {
            $sql1 = "UPDATE `pendiete` SET `CUOTA_ESTADO`=:cuota_estado,`CUOTA_APOYO`=:cuota_apoyo, `ACOMPA_ESTADO`=:acompa_estado, `ACOMPA_APOYO`=:acompa_apoyo  WHERE USER_ID=:id";
            $respuesta1 = $cnt->prepare($sql1);
            $respuesta1->execute(array(":cuota_estado" => "PAGADO", ":cuota_apoyo" => 0, ":acompa_estado" => "PAGADO", ":acompa_apoyo" => 0, ":id" => $datos['ID']));
        }

        foreach ($reservas as $elemento) {
            $sql1 = "UPDATE `reservas_hotel` SET 
	`HOTEL_CUOTA`=:cuota_hotel,
	`HOTEL_PAGO`=:pago_hotel,
	`HOTEL_ESTADO`=:esto_hotel,
	`HOTEL_APOYO`=:apoyo_hotel WHERE ID=:id";
            $respuesta1 = $cnt->prepare($sql1);
            $respuesta1->execute(array(
                ":cuota_hotel" => $elemento['HOTEL_APOYO'],
                ":pago_hotel" => "TPV",
                ":esto_hotel" => "PAGADO",
                ":apoyo_hotel" => 0.00,
                ":id" => $elemento['ID']
            ));
        }

?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $.ajax({
                url: "../../sender.php",
                type: "POST",
                data: "ID=<?php echo $datos['ID'] ?>&single=true",
                success: function(res) {
                    console.log(res)
                    window.location.href =
                        "https://<?php echo $_SERVER['HTTP_HOST'] ?>/personal/index.php?payment=true";
                }
            })
        </script>
<?php
    } else {
        include('../config.php');
        session_start();

        $datos = $_SESSION['user_registradores_id'];
        $sql = "UPDATE `form` SET `ESTADO`=:estado WHERE EMAIL=:email";
        $respuesta = $cnt->prepare($sql);
        $respuesta->execute(array(":estado" => 2, ":email" => $datos['email']));
        header("location:https://" . $_SERVER['SERVER_NAME'] . "/personal/index.php?payment=false");
    }
}
?>