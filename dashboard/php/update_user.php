<?php
include( "../../assets/php/config.php" );
date_default_timezone_set( "Europe/Madrid" );
$id = $_POST[ 'id' ];

$sql="SELECT * FROM pendiete WHERE USER_ID=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":id"=>$id));
$fila=$respuesta->fetch(PDO::FETCH_ASSOC);

$sql="SELECT * FROM pendiete WHERE ID=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(":id"=>$id));
$fila2=$respuesta->fetch(PDO::FETCH_ASSOC);
/****************************** DATOS PERSONALES ************************************************/
$titulo = $_POST[ 'TITULO' ] ?? "";
$name = $_POST[ 'NAME' ] ?? "";
$surname = $_POST[ 'SURNAME' ] ?? "";
$email = $_POST[ 'EMAIL' ] ?? "";
$dni = $_POST[ 'DNI' ] ?? "";
$cargo = $_POST[ 'CARGO' ] ?? "";
$tel = $_POST[ 'TELEFONO' ] ?? "";
$registro = $_POST[ 'No_REGISTRO' ] ?? "";
$direccion = $_POST[ 'DIRECCION' ] ?? "";
$categoria = $_POST[ 'CATEGORIA' ] ?? "";
$name = $_POST[ 'NAME' ] ?? "";
$nota = $_POST[ 'NOTA_ABONO' ] ?? "";
$talon = $_POST[ 'TALON_VENTA' ] ?? "";
$pais = $_POST[ 'PAIS' ] ?? "";
$ciudad = $_POST[ 'CIUDAD' ] ?? "";
$cp = $_POST[ 'CODIGO_POSTAL' ] ?? "";
$pass = $_POST[ 'PASS' ] ?? "";
$patrocinador=$_POST['PATROCINADOR'];
$email_patrocinador=$_POST['EMAIL_PATROCINADOR'];
/***************************** DATOS PROFESIONALES **************************************/
$pespecialidad = $_POST[ 'PESPECIALIDAD' ] ?? "";
$phospital = $_POST[ 'PHOSPITAL' ] ?? "";
$ppais = $_POST[ 'PPAIS' ] ?? "";
$pciudad = $_POST[ 'PCIUDAD' ] ?? "";
$pcp = $_POST[ 'PCODIGO_POSTAL' ] ?? "";
$ptipo_centro = $_POST[ 'PTIPO_CENTRO' ] ?? "";
$pdireccion = $_POST[ 'PDIRECCION' ] ?? "";

/***************************** DATOS FACTURACION **************************************/
$fname = $_POST[ 'FNAME' ] ?? "";
$fnif = $_POST[ 'FNIF' ] ?? "";
$ftel = $_POST[ 'FTELEFONO' ] ?? "";
$femail = $_POST[ 'FEMAIL' ] ?? "";
$fpais = $_POST[ 'FPAIS' ] ?? "";
$fciudad = $_POST[ 'FCIUDAD' ] ?? "";
$fcp = $_POST[ 'FCODIGO_POSTAL' ] ?? "";
$fdireccion = $_POST[ 'FDIRECCION' ] ?? "";

/***************************** DATOS SERVICIOS Y EXTRAS **************************************/
$gestion = $_POST[ 'EGESTION' ] ?? "";
$intolerancia = $_POST[ 'EINTOLERANCIA' ] ?? "";

/***************************** DATOS PAGOS Y CUOTAS **************************************/
$cuota=$_POST['CUOTA'];
$pago=$_POST['PAGO'];
$estado=$_POST['ESTADO'];
$apoyo=$_POST['CUOTA_APOYO'];

if($estado=="PAGADO"){
    $cuota=	$apoyo;
$apoyo=0.00;

}

/***************************** ACTUALIZANDO DATOS PERSONALES FORM **************************************/
if($pass==""){
$sql = "UPDATE `form` SET 
`TITULO`=:TITULO,
`NAME`=:NAME,
`SURNAME`=:SURNAME,
`EMAIL`=:EMAIL,
`DNI`=:DNI,
`CARGO`=:CARGO,
`PAIS`=:PAIS,
`DIRECCION`=:DIRECCION,
`CIUDAD`=:CIUDAD,
`CODIGO_POSTAL`=:CP,
`TELEFONO`=:TELEFONO,
`No_REGISTRO`=:REGISTRO,
`GESTION`=:GESTION,
`INTOLERANCIA`=:INTOLERANCIA,
`CATEGORIA`=:CATEGORIA,
`NOTA_ABONO`=:NOTA,
`TALON_VENTA`=:TALON,
`PATROCINADOR`=:PATROCINADOR,
`EMAIL_PATROCINADOR`=:EMAIL_PATROCINADOR
WHERE ID=:id";
$respuesta = $cnt->prepare( $sql );
$respuesta->execute( array(
    ":TITULO" => $titulo,
    ":NAME" => $name,
    ":SURNAME" => $surname,
    ":EMAIL" => $email,
    ":DNI" => $dni,
    ":CARGO" => $cargo,
    ":PAIS" => $pais,
    ":DIRECCION" => $direccion,
    ":CIUDAD" => $ciudad,
    ":CP" => $cp,
    ":TELEFONO" => $tel,
    ":REGISTRO" => $registro,
    ":GESTION" => $gestion,
    ":INTOLERANCIA" => $intolerancia,
    ":CATEGORIA" => $categoria,
    ":NOTA" => $nota,
    ":TALON" => $talon,
	 ":PATROCINADOR" => $patrocinador,
    ":EMAIL_PATROCINADOR" => $email_patrocinador,
	":id"=>$id
) );	
}else{
$sql = "UPDATE `form` SET 
`TITULO`=:TITULO,
`NAME`=:NAME,
`SURNAME`=:SURNAME,
`EMAIL`=:EMAIL,
`DNI`=:DNI,
`CARGO`=:CARGO,
`PAIS`=:PAIS,
`DIRECCION`=:DIRECCION,
`CIUDAD`=:CIUDAD,
`CODIGO_POSTAL`=:CP,
`TELEFONO`=:TELEFONO,
`No_REGISTRO`=:REGISTRO,
`PASS`=:PASS,
`GESTION`=:GESTION,
`INTOLERANCIA`=:INTOLERANCIA,
`CATEGORIA`=:CATEGORIA,
`NOTA_ABONO`=:NOTA,
`TALON_VENTA`=:TALON,
`PATROCINADOR`=:PATROCINADOR,
`EMAIL_PATROCINADOR`=:EMAIL_PATROCINADOR
WHERE ID=:id";
$respuesta = $cnt->prepare( $sql );
$respuesta->execute( array(
    ":TITULO" => $titulo,
    ":NAME" => $name,
    ":SURNAME" => $surname,
    ":EMAIL" => $email,
    ":DNI" => $dni,
    ":CARGO" => $cargo,
    ":PAIS" => $pais,
    ":DIRECCION" => $direccion,
    ":CIUDAD" => $ciudad,
    ":CP" => $cp,
    ":TELEFONO" => $tel,
    ":REGISTRO" => $registro,
	":PASS" => password_hash( $pass, PASSWORD_DEFAULT ),
    ":GESTION" => $gestion,
    ":INTOLERANCIA" => $intolerancia,
    ":CATEGORIA" => $categoria,
    ":NOTA" => $nota,
    ":TALON" => $talon,
	 ":PATROCINADOR" => $patrocinador,
    ":EMAIL_PATROCINADOR" => $email_patrocinador,
	":id"=>$id
) );	
}


/***************************** ACTUALIZANDO DATOS PROFESIONALES profesionales **************************************/
$sql="UPDATE `profesionales` SET 
`ESPECIALIDAD`=:ESPECIALIDAD,
`HOSPITAL`=:HOSPITAL,
`PAIS`=:PAIS,
`CIUDAD`=:CIUDAD,
`CODIGO_POSTAL`=:CP,
`TIPO_CENTRO`=:TIPO,
`DIRECCION`=:DIRECCION WHERE USER_ID=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(
":ESPECIALIDAD"=>$pespecialidad,
":HOSPITAL"=>$phospital,
":PAIS"=>$ppais,
":CIUDAD"=>$pciudad,
":CP"=>$pcp,
":TIPO"=>$ptipo_centro,
":DIRECCION"=>$pdireccion,
":id"=>$id
));
/***************************** ACTUALIZANDO DATOS FACTURACION facturacion **************************************/
$sql="UPDATE `facturacion` SET
`F_NAME`=:NAME,
`F_NIF`=:NIF,
`F_CIUDAD`=:CIUDAD,
`F_TELEFONO`=:TELEFONO,
`F_DIRECCION`=:DIRECCION,
`F_CODIGO_POSTAL`=:CP,
`F_EMAIL`=:EMAIL,
`F_PAIS`=:PAIS WHERE USER_ID=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(
":NAME"=>$fname,
":NIF"=>$fnif,
":CIUDAD"=>$fciudad,
":TELEFONO"=>$ftel,
":DIRECCION"=>$fdireccion,
":CP"=>$fcp,
":EMAIL"=>$femail,
":PAIS"=>$fpais,
":id"=>$id
));
/***************************** ACTUALIZANDO DATOS PAGOS pendiete **************************************/
$sql="UPDATE `pendiete` SET 
`CUOTA`=:CUOTA,
`CUOTA_PAGO`=:PAGO,
`CUOTA_ESTADO`=:ESTADO,
`CUOTA_APOYO`=:APOYO
 WHERE USER_ID=:id";
$respuesta=$cnt->prepare($sql);
$respuesta->execute(array(
":CUOTA"=>$cuota,
":PAGO"=>$pago,
":ESTADO"=>$estado,
":APOYO"=>$apoyo,
":id"=>$id
));

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