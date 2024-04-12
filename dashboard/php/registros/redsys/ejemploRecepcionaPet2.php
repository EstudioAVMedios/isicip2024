<?php

session_start();
include 'apiRedsys.php';
include( "../../../../assets/php/config.php" );
$sql = "SELECT * FROM pagos";
$resultado = $cnt->prepare( $sql );
$resultado->execute();
$pagos = $resultado->fetch( PDO::FETCH_ASSOC );

// Se crea Objeto
$miObj = new RedsysAPI;


if ( !empty( $_POST ) ) { //URL DE RESP. ONLINE

    $version = $_POST[ "Ds_SignatureVersion" ];
    $datos = $_POST[ "Ds_MerchantParameters" ];
    $signatureRecibida = $_POST[ "Ds_Signature" ];


    $decodec = $miObj->decodeMerchantParameters( $datos );
    $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//$pagos[ 'KEY' ]; //Clave recuperada de CANALES
    $firma = $miObj->createMerchantSignatureNotif( $kc, $datos );

    echo PHP_VERSION . "<br/>";
    echo $firma . "<br/>";
    echo $signatureRecibida . "<br/>";
    if ( $firma === $signatureRecibida ) {

  

        $datos = $_SESSION[ 'user_evento_id' ];
        $sql = "UPDATE `form` SET `ESTADO`=:estado WHERE EMAIL=:email";
        $respuesta = $cnt->prepare( $sql );
        $respuesta->execute( array( ":estado" => 1, ":email" => $datos[ 'email' ] ) );
		
		
		


    } else {


        echo "FIRMA KO";
    }
} else {
    if ( !empty( $_GET ) ) { //URL DE RESP. ONLINE

        $version = $_GET[ "Ds_SignatureVersion" ];
        $datos = $_GET[ "Ds_MerchantParameters" ];
        $signatureRecibida = $_GET[ "Ds_Signature" ];


        $decodec = $miObj->decodeMerchantParameters( $datos );
        $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//$pagos[ 'KEY' ]; //Clave recuperada de CANALES
        $firma = $miObj->createMerchantSignatureNotif( $kc, $datos );

        if ( $firma === $signatureRecibida ) {
			
          
         

            $datos = $_SESSION[ 'user_evento_id' ];
            $sql = "UPDATE `form` SET `ESTADO`=:estado WHERE EMAIL=:email";
            $respuesta = $cnt->prepare( $sql );
            $respuesta->execute( array( ":estado" => 2, ":email" => $datos[ 'email' ] ) );
			
		
        ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$.ajax({
    url: "../../sender.php",
    type: "POST",
    data: "ID=<?php echo $datos[ 'ID' ] ?>&single=true&error=error&code=TPV",
    success: function(res) {
        console.log(res)
        window.location.href =
            "https://<?php echo $_SERVER[ 'HTTP_HOST' ]?>/personal/index.php?payment=false";
    }
})
</script>
<?php
			
        } else {
       
            $datos = $_SESSION[ 'user_evento_id' ];
            $sql = "UPDATE `form` SET `ESTADO`=:estado WHERE EMAIL=:email";
            $respuesta = $cnt->prepare( $sql );
            $respuesta->execute( array( ":estado" => 2, ":email" => $datos[ 'email' ] ) );
            ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$.ajax({
    url: "../../sender.php",
    type: "POST",
    data: "ID=<?php echo $datos[ 'ID' ] ?>&single=true&error=error&code=TPV",
    success: function(res) {
        console.log(res)
        window.location.href =
            "https://<?php echo $_SERVER[ 'HTTP_HOST' ]?>/personal/index.php?payment=false";
    }
})
</script>
<?php
        }
	?>

<?php	
	
    } else {

		header("location:https://".$_SERVER['SERVER_NAME'] ."/personal/index.php?payment=empty");
    }
}

?>