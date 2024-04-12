<?php

session_start();
if (!empty($_SESSION['user_evento_id'])) {
    include("../assets/php/config.php");
    include '../dashboard/stripe/dbConnect.php';
    date_default_timezone_set("Europe/Madrid");

    $id = $_SESSION['user_evento_id']['ID'];


    $sql3 = "SELECT * FROM profesionales WHERE USER_ID=:id";
    $resultado3 = $cnt->prepare($sql3);
    $resultado3->execute(array(":id" => $id));
    while ($fila6 = $resultado3->fetch(PDO::FETCH_ASSOC)) {
        $profesionales[] = $fila6;
    }
    $sql = "SELECT * FROM facturacion WHERE USER_ID=:id";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute(array(":id" => $id));
    $fila7 = $respuesta->fetch(PDO::FETCH_ASSOC);


    $sql = "SELECT * FROM generales_form";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute();
    $fila5 = $respuesta->fetch(PDO::FETCH_ASSOC);


    $sql = "SELECT * FROM pagos";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute();
    $pago = $respuesta->fetch(PDO::FETCH_ASSOC);



    $sql2 = "SELECT * FROM form WHERE ID=:id AND VISIBILIDAD=:visi";
    $resultado2 = $cnt->prepare($sql2);
    $resultado2->execute(array(":id" => $id, ":visi" => 0));
    $usuario = $resultado2->fetch(PDO::FETCH_ASSOC);
    foreach ($profesionales as $elemento) {
        if ($usuario['ID'] == $elemento['USER_ID']) {
            $usuario['PESPECIALIDAD'] = $elemento['ESPECIALIDAD'];
            $usuario['PTIPO_CENTRO'] = $elemento['TIPO_CENTRO'];
            $usuario['PPAIS'] = $elemento['PAIS'];
            $usuario['PCIUDAD'] = $elemento['CIUDAD'];
            $usuario['PDIRECCION'] = $elemento['ESPECIALIDAD'];
            $usuario['PCODIGO_POSTAL'] = $elemento['CODIGO_POSTAL'];
            $usuario['PHOSPITAL'] = $elemento['HOSPITAL'];
            $usuario['PCARGO'] = $elemento['CARGO'];
        }
    }
    if ($usuario['LAN'] == "ES") {
        $tableName = "all_campos";
    } else {
        $tableName = "all_campos2";
    }
    $sql = "SELECT * FROM $tableName";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute();
    while ($fila3 = $respuesta->fetch(PDO::FETCH_ASSOC)) {
        if ($fila3['ESTADO'] != 0) {
            $campos[] = $fila3;
        }
    }
    $usuario['FNAME'] = $fila7['F_NAME'];
    $usuario['FNIF'] = $fila7['F_NIF'];
    $usuario['FTELEFONO'] = $fila7['F_TELEFONO'];
    $usuario['FPAIS'] = $fila7['PAIS'];
    $usuario['FDIRECCION'] = $fila7['F_DIRECCION'];
    $usuario['FCIUDAD'] = $fila7['F_CIUDAD'];
    $usuario['FCODIGO_POSTAL'] = $fila7['F_CODIGO_POSTAL'];
    $usuario['FEMAIL'] = $fila7['F_EMAIL'];
    $usuario['FPAIS'] = $fila7['F_PAIS'];

    $sql = "SELECT * FROM reservas_hotel WHERE USER_ID=:id";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute(array(":id" => $id));
    while ($fila6 = $respuesta->fetch(PDO::FETCH_ASSOC)) {
        $reservas[] = $fila6;
    }

    $sql = "SELECT * FROM acompa WHERE USER_ID=:id";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute(array(":id" => $id));
    $acompa = $respuesta->fetch(PDO::FETCH_ASSOC);

    $usuario['ATITULO'] = $acompa['TITULO'];
    $usuario['ANAME'] = $acompa['NAME'];
    $usuario['ASURNAME'] = $acompa['SURNAME'];
    $usuario['ADNI'] = $acompa['DNI'];
    $usuario['ATELEFONO'] = $acompa['TELEFONO'];
    $usuario['APAIS'] = $acompa['PAIS'];
    $usuario['ACIUDAD'] = $acompa['CIUDAD'];
    $usuario['ACODIGO_POSTAL'] = $acompa['CP'];
    $usuario['AEMAIL'] = $acompa['EMAIL'];
    $usuario['ADIRECCION'] = $acompa['DIRECCION'];


    $sql = "SELECT * FROM pagos";
    $resultado = $cnt->prepare($sql);
    $resultado->execute();
    $pagos = $resultado->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM evento";
    $resultado = $cnt->prepare($sql);
    $resultado->execute();
    $evento = $resultado->fetch(PDO::FETCH_ASSOC);


    $sql = "SELECT * FROM cuotas";
    $resultado = $cnt->prepare($sql);
    $resultado->execute();
    while ($fila3 = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $cuotas[] = $fila3;
    };

    $sql = "SELECT * FROM habitaciones";
    $resultado = $cnt->prepare($sql);
    $resultado->execute();
    while ($fila3 = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $habitaciones[] = $fila3;
    };

    $sql = "SELECT * FROM pendiete WHERE USER_ID=:id";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute(array(":id" => $id));
    $servicios = $respuesta->fetch(PDO::FETCH_ASSOC);

    if (
        $servicios['CUOTA_ESTADO'] == "PENDIENTE"
        and $servicios['CUOTA_APOYO'] != 0 and $servicios['CUOTA'] == 0
    ) {
        $cuota = $servicios['CUOTA_APOYO'];
        $cuota_a_pagar = $servicios['CUOTA_APOYO'];
    } elseif ($servicios['CUOTA_ESTADO'] == "PENDIENTE") {
        $cuota = $servicios['CUOTA'];
        $cuota_a_pagar = $servicios['CUOTA_APOYO'];
    }

    foreach ($cuotas as $elemento) {
        if ($elemento['PRECIO'] == $cuota) {
            $nombre_cuota = $elemento['NAME'];
            $row['name'] = $elemento['NAME'];
            $row['id'] = $elemento['ID'];
            $row['price'] = $elemento['PRECIO'];
            $row['currency'] = "eur";
        }
    }




    if ($servicios['CUOTA_ESTADO'] == "DEVOLUCION") {
        $cuota_devolver = $servicios['CUOTA_APOYO'];
    } else {
        $cuota_devolver = 0;
    }


    if (
        $servicios['ACOMPA_ESTADO'] == "PENDIENTE"
        and $servicios['ACOMPA_APOYO'] == 0
    ) {
        $cuota_acompa = $servicios['ACOMPA_CUOTA'];
    } elseif (
        $servicios['ACOMPA_ESTADO'] == "PENDIENTE"
        and $servicios['ACOMPA_APOYO'] != 0
    ) {
        $cuota_acompa = $servicios['ACOMPA_APOYO'];
    } else {
        $cuota_acompa = 0;
    }

    if ($servicios['ACOMPA_ESTADO'] == "DEVOLUCION") {
        $cuota_acompa_devolver = $servicios['ACOMPA_APOYO'];
    } else {
        $cuota_acompa_devolver = 0;
    }

    $total_hab = 0;
    $total_hab_devolver = 0;
    foreach ($reservas as $elemento) {
        if ($elemento['HOTEL_ESTADO'] == "PENDIENTE") {
            $total_hab = $total_hab + $elemento['HOTEL_APOYO'];
        } else if ($elemento['HOTEL_ESTADO'] == "DEVOLUCION") {
            $total_hab_devolver = $total_hab_devolver + $total_hab + $elemento['HOTEL_APOYO'];
        }
    }
    $total_devolver = $cuota_devolver + $cuota_acompa_devolver + $total_hab_devolver;
    $total = $cuota + $cuota_acompa + $total_hab - $total_devolver;
    $id2 = time();
    closedir($handle);
    if ($pagos['TARJETA'] == 1) {
        include '../dashboard/php/registros/redsys/apiRedsys.php';
        $miObj = new RedsysAPI;
        // Valores de entrada que no hemos cmbiado para ningun ejemplo
        $fuc = "14411219";

        $terminal = "001";
        $moneda = "978";
        $trans = "0";
        $url = "https://" . $_SERVER['SERVER_NAME'] . "/dashboard/php/registros/redsys/ejemploRecepcionaPet.php";
        $urlOK = "https://" . $_SERVER['SERVER_NAME'] . "/dashboard/php/registros/redsys/respuestaok.php";
        $urlKO = "https://" . $_SERVER['SERVER_NAME'] . "/dashboard/php/registros/redsys/ejemploRecepcionaPet2.php";

        $amount = $total * 100;
        // Se Rellenan los campos
        $miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
        $miObj->setParameter("DS_MERCHANT_ORDER", $id2);
        $miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $fuc);
        $miObj->setParameter("DS_MERCHANT_CURRENCY", $moneda);
        $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $trans);
        $miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
        $miObj->setParameter("DS_MERCHANT_MERCHANTURL", $url);
        $miObj->setParameter("DS_MERCHANT_URLOK", $urlOK);
        $miObj->setParameter("DS_MERCHANT_URLKO", $urlKO);
        //Datos de configuración


        $version = "HMAC_SHA256_V1";
        if ($pagos['PRODUCTION'] == 'true') {
            $kc = $pagos['KEY']; //Clave recuperada de CANALES
            $enlace = 'https://sis.redsys.es/sis/realizarPago';
        } else {
            $kc = $pagos['KEY_TEST']; //Clave recuperada de CANALES
            $enlace = 'https://sis-t.redsys.es:25443/sis/realizarPago';
        }
        // Se generan los parámetros de la petición
        $request = "";
        $params = $miObj->createMerchantParameters();
        $signature = $miObj->createMerchantSignature($kc);
    }

    // Se crea Objeto

    $_SESSION['user_evento_id'] = array(

        "ID" => $_SESSION['user_evento_id']['ID'],

        "name" => $personales['NAME'],

        "surname" => $personales['SURNAME'],

        "dni" => $personales['DNI'],

        "email" => $personales['EMAIL'],

        "tel" => $personales['TELEFONO'],

        "registro" => $personales['No_REGISTRO'],

        "acompa" => $personales['ACOMPA'],

        "pago" => "TPV",

        "gestion" => $personales['GESTION'],

        "intolerancia" => $personales['INTOLERANCIA'],

        "pago_cuota" => $pago_cuota,

        "pago_acompa" => $pago_acompa,

        "pago_hotel" => $pago_hotel,


        "aname" => $acompa['NAME'],

        "asurname" => $acompa['SURNAME'],

        "adni" => $acompa['DNI'],

        "atel" => $acompa['TELEFONO'],

        "aemail" => $acompa['EMAIL'],


        "fname" => $fact['F_NAME'],

        "fdni" => $fact['F_NIF'],

        "fprovincia" => $fact['F_PROVINCIA'],

        "faddress" => $fact['F_DIRECCION'],

        "fcp" => $fact['F_CP'],

        "femail" => $fact['F_EMAIL'],

        "ftel" => $fact['F_TELEFONO'],


        "fentrada" => $personales['F_ENTRADA'],

        "fsalida" => $personales['F_SALIDA'],

        "noches" => $personales['NOCHES'],

        "habitacion" => $personales['HABITACION'],

        "lan" => $personales['LAN'],
        "total" => $total,

        "total_hab" => $reserva,

        "pedido" => $id2


    );

    if ($total != 0) {

        $sql1 = "INSERT INTO `pedidos`(`USER_ID`, `PEDIDO`, `DATE`, `ESTADO`) VALUES (:id,:pedido,:date,:estado)";

        $respuesta1 = $cnt->prepare($sql1);

        $respuesta1->execute(array(":id" => $id, ":pedido" => $id2, ":date" => date("F j, Y, g:i a"), ":estado" => 0));
    }
} else {

    header("location:../login/");
}


?>

<!DOCTYPE html>

<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/x-icon" href="../assets/image/favicon.png">
    <link rel="stylesheet" href="../dashboard/css/registros/animate.css">
    <link rel="stylesheet" href="../dashboard/css/registros/bootstrap.min.css">
    <link rel="stylesheet" href="../dashboard/css/registros/style.css">
    <link rel="stylesheet" href="../dashboard/css/icon/iconfonts.css">
    <title><?php echo $evento['NAME'] ?></title>
    <style>
        * {
            font-family: "Poppins", sans-serif;
        }

        .stripe-button-el {
            width: 100%;
            background: <?php echo $evento['COLOR'] . "!important" ?>;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: var(--bs-nav-pills-link-active-color);
            background-color: <?php echo $evento['COLOR'] ?>;
        }

        .article-event {
            top: 95px;

        }

        h3 {
            font-weight: 600;
            font-size: 18px;
            letter-spacing: -0.01em;
            line-height: 1.2;
            color: <?php echo $evento['COLOR'] ?>;
        }

        body {
            background: #fff
        }

        .card {

            border: 1px dashed;
            border-image-source: linear-gradient(to bottom, #ef8eff, #51cff9) !important;
            border-image-slice: 1;
        }

        .card-link {
            color: <?php echo $evento['COLOR'] ?>;
            font-weight: 300;
            background: white;
        }

        .card-link:hover {
            color: white;
            font-weight: 300;
            background: <?php echo $evento['COLOR'] ?>;
        }

        .active {
            color: white !important;
        }

        .card-title {
            color: <?php echo $evento['COLOR'] ?> !important;
            font-weight: 600 !important;
        }

        .card-subtitle {
            font-weight: 400;
            font-size: 15px;
            line-height: 24px;
            margin-bottom: 0;
            color: #62637d;

        }

        .nav-link {
            display: block;
            padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
            font-size: var(--bs-nav-link-font-size);
            font-weight: var(--bs-nav-link-font-weight);
            color: <?php echo $evento['COLOR'] ?>;
            text-decoration: none;
            background: 0 0;
            border: 0;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
        }

        .stripe-button-el span {
            width: 100%;
            background: rgba(0, 0, 0, 0) !important;
            text-shadow: none !important;
        }

        .checkoutView {
            position: absolute;
            left: 18%;
            top: 50%;
            margin: -240px 0 0 -151px;
            padding-bottom: 45px;
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
            -ms-border-radius: 6px;
            -o-border-radius: 6px;
            border-radius: 6px;
            width: 80% !important;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -ms-box-sizing: border-box;
            -o-box-sizing: border-box;
            box-sizing: border-box;
            z-index: 10;
        }

        .footer--overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #4b99a18c;
            top: 0px;
            mix-blend-mode: multiply;
        }

        .title-card {
            margin-top: -47px;
            border: 1px dashed !important;
            border-image-source: linear-gradient(to bottom, #ef8eff, #51cff9) !important;
            border-image-slice: 1 !important;
        }

        .streaming-button {
            opacity: 1;
            animation: mymove 1s;
            animation-iteration-count: infinite;
            background: <?php echo $evento['COLOR'] ?>;
            color: white !important;
        }

        @keyframes mymove {
            from {
                opacity: 1;
            }

            to {
                opacity: 0.4;
            }



        }

        @media (max-width:600px) {
            h1 {
                font-size: 1.5rem;
            }

            .banner-con {
                margin-top: 55px;
            }

            .navbar-brand img {
                height: 62px !important;
            }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

    <!---header-and-banner-section-->
    <?php echo $id2 ?>
    <section>
        <div class="header-and-banner-con w-100 generic-banner-con" style="position: relative">
            <div class="header-and-banner-inner-con">
                <!--style="background-image:url(../dashboard/Imagenes/fondo.png)"-->
                <header class="header-main-con">


                    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="./index.php"><img src="../dashboard/Imagenes/logo-dark.png" alt="logo-img" class="img-fluid" style="height:70px;"></a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse ms-auto navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                                    <a class="nav-link" style="color:<?php echo $evento['COLOR'] ?>;font-weight:600" href="#">Personal Area<span class="sr-only">(current)</span></a>
                                    <?php if ($total == 0) : ?>
                                        <li class="nav-item mx-3">
                                            <a class="nav-link" style="color:<?php echo $evento['COLOR'] ?>;font-weight:300" href="video.php"> Previous sessions</a>
                                        </li>
                                        <li class="nav-item mx-3">
                                            <!-- <a class="nav-link streaming-button" style="font-weight:300"
                                            href="../dashboard/directo/"><i class="icon-video"></i> Streaming</a> -->
                                            <!--../dashboard/directo/-->
                                        </li>
                                    <?php endif; ?>
                                    <li class="nav-item mx-3">
                                        <a class="nav-link" style="color:<?php echo $evento['COLOR'] ?>;font-weight:300" href="../dashboard/php/personal/end.php">Logout</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </nav>

                </header>
                <section class="banner-main-con " style="height:460px">

                    <div class="container" style="padding-top:200px;">

                        <div class="banner-con text-center position-relative " style="z-index:3">
                            <h1 class="text-white">Personal Area <span style="color:white"><?php echo $evento['NAME'] ?></span></h1>
                            <p class="col-lg-7 col-md-8 p-0 ml-auto mr-auto text-white">"In this section you will be
                                able to find all the data related to your registration."</p>
                        </div>

                        <!--banner-end-->

                    </div>
                    <div class="footer--overlay" style="background-image:url(../dashboard/Imagenes/fondo.png)"></div>
                </section>
            </div>
        </div>
    </section>
    <?php if ($_GET['payment'] == 'false') : ?>
        <div class="bg-danger text-white w-100 p-3 m-0 text-center">
            There has been an error in the payment, please try again or contact the technical secretary.
        </div>
    <?php elseif ($_GET['payment'] == 'true') : ?>
        <div class="bg-success text-white w-100 p-3 m-0 text-center">
            Your payment has been successfully processed.
        </div>
    <?php endif; ?>
    <!---header-and-banner-section-->
    <?php if ($pagos['STRIPE'] == 1) : ?>
        <!-- blog section -->
        <div class='col-12  d-flex w-100 text-center mt-5'>

            <h2 class="position-relative w-100"><?php echo $usuario['CATEGORIA'] ?><br>
                <?php echo ($usuario["NAME"] . " " . $usuario["SURNAME"] . " ID:" . $usuario["ID"]);
                if ($total == 0) : ?>
                    <span class="bg-success p-2 rounded-pill text-white h6">PAYED</span>
                <?php else : ?>
                    <span class="bg-warning p-2 rounded-pill text-white h6">PENDING</span><?php endif; ?>
            </h2>
        </div>
        <?php if ($total != 0) : ?>
            <div class="container align-self-center mt-5">
                <div class="row justify-content-center">
                    <div class="col-8 mx-auto d-flex border-bottom py-2">
                        <h4 class="mb-0"><?php echo $nombre_cuota ?></h4>
                        <h4 class="ml-auto mb-0"><?php echo $cuota_a_pagar ?> €</h4>
                    </div>
                    <div class="col-8 mx-auto d-flex border-bottom py-2">
                        <h4 class="mb-0" style="color:<?php echo $evento['COLOR'] ?>">Total</h4>
                        <h4 class="ml-auto mb-0"><?php echo $total ?>.00 €</h4>
                    </div>
                    <div class="col-8 mx-auto px-0 mt-4">
                        <form autocomplete="off" action="../dashboard/stripe/checkout.php" method="POST">
                            <div class="d-none">
                                <input type="number" class="d-none" id="ph" name="phone" value="<?php echo $usuario["TELEFONO"] ?>" pattern="\d{10}" maxlength="10" disbaled required />
                            </div>
                            <div class="d-none">
                                <input type="text" name="price" value="<?php echo $total ?>" disabled required />
                            </div>

                            <input type="hidden" name="pedido" value="<?php echo $id2 ?>" class="d-none" />
                            <input type="hidden" name="descripcion" value="<?php echo "P_" . $id2 . "_USER_" . $usuario["ID"] ?>" class="d-none" />

                            <input type="hidden" name="amount" value="<?php echo $total ?>" class="d-none">
                            <input type="hidden" name="product_name" value="<?php echo  $nombre_cuota ?>">
                            <button class="btn btn-primary w-100" type="submit" style="background:<?php echo $evento['COLOR'] ?>">SAFE PAYMENT</button>
                        </form>
                    </div>


                </div>
                <!--end col-sm-7 col-md-7-->
                <div class="col-sm-3 d-none d-sm-block"> </div>
                <!--end col-sm-5 col-md-5 col-xl-5-->
            </div>
        <?php endif; ?>
        <!--end row-->
        </div>
    <?php endif;
    if ($pagos['TARJETA'] == 1) : ?>

        <section class="w-100 float-left service-con padding-bottom padding-top information-con blog-main-con">
            <div class="container mt-5">
                <div class='col-12  d-flex w-100 text-center mt-5'>

                    <h2 class="position-relative w-100"><?php echo $usuario['CATEGORIA'] ?><br>
                        <?php echo ($usuario["NAME"] . " " . $usuario["SURNAME"] . " ID:" . $usuario["ID"]);
                        if ($total == 0) : ?>
                            <span class="bg-success p-2 rounded-pill text-white h6">PAYED</span>
                        <?php else : ?>
                            <span class="bg-warning p-2 rounded-pill text-white h6">PENDING</span><?php endif; ?>
                    </h2>
                </div>
                <div class="position-relative dotted-img">
                    <div class="genric-heading">
                        <div class='price-plan-item row cuota-active acompa mb-5 mx-0'>

                            <?php if ($total != 0) : ?>
                                <div class="banner-con text-center col-lg-9 col-md-9 col-12 m-auto">
                                    <ul class="list-group list-group-flush">
                                        <?php if ($pagos['CUOTA_ESTADO'] == "PENDIENTE") : ?>
                                            <li class="list-group-item d-flex">
                                                <p class="w-100 text-left mb-0">CUOTA CONGRESISTA</p>
                                                <p class="text-right mb-0"><?php echo "550.00€" ?></p>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($pagos['ACOMPA_ESTADO'] == "PENDIENTE") : ?>
                                            <li class="list-group-item d-flex">
                                                <p class="w-100 text-left mb-0">CUOTA ACOMPAÑANTE</p>
                                                <p class="text-right mb-0"><?php echo "350.00€" ?></p>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($reserva != 0) : ?>
                                            <li class="list-group-item d-flex">
                                                <p class="w-100 text-left mb-0">HOTEL</p>
                                                <p class="text-right mb-0">
                                                    <?php echo $reserva . ".00€" ?>
                                                </p>
                                            </li>
                                        <?php endif; ?>
                                        <?php

                                        if ($precio_serv != "") :

                                            foreach ($precio_serv as $elemento) :


                                        ?>
                                                <li class="list-group-item d-flex">
                                                    <p class="w-100 text-left mb-0" style="text-transform: uppercase">
                                                        <?php echo $elemento["SERVICIO"] . " " . $cant ?></p>
                                                    <p class="text-right mb-0">
                                                        <?php echo $elemento["PRECIO"] . "€" ?>
                                                    </p>
                                                </li>
                                        <?php endforeach;
                                        endif; ?>
                                        <li class="list-group-item d-flex">
                                            <p class="w-100 text-left mb-0">REFUNDS</p>
                                            <p class="text-right mb-0">
                                                <?php if ($total_devolucion > $total_pendiente) : echo $total_devolucion * (-1) . ".00€";
                                                else : echo "0.00€";
                                                endif; ?>
                                            </p>
                                        </li>
                                        <li class="list-group-item d-flex">
                                            <p class="w-100 text-left mb-0"><strong>Total</strong></p>
                                            <p class="text-right mb-0"><strong><?php echo $total . ".00€" ?></strong></p>
                                        </li>
                                    </ul>

                                    <form name="frm" action="<?php echo $enlace; ?>" method="POST" target="_blank">



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
                                        <button class="btn btn-primary w-100 rounded-pill mt-5" type="submit" style="background:<?php echo $evento['COLOR'] ?>"><span class="far fa-lock-alt"></span>Go to pay</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
        </section>
    <?php endif; ?>
    <section>
        <div class="container" id="resumen">
            <div class="row">
                <?php if ($arrFiles[0] != "." and $arrFiles[0] != ".." and $arrFiles[0] != "") : ?>
                    <div class="col-12">
                        <div class="list-group"> <a class="list-group-item list-group-item-action active text-white" style="background: <?php echo $evento['COLOR'] ?>;border:none" aria-current="true">
                                Downloads</a>
                            <?php
                            foreach ($arrFiles as $elemento) :
                                if ($elemento != "." and $elemento != "..") :
                            ?>
                                    <a href="" onClick="DownloadFromUrl('../assets/archivos/descargas/<?php echo $id . "/" . $elemento ?>','Archivo_<?php echo $evento['NAME'] ?>_<?php echo $elemento ?>')" target='_blank' class="list-group-item list-group-item-action"> <i class="icon-cloud-download-alt"></i> <?php echo $elemento ?> </a>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                <?php endif;
                if ($total == 0) :
                ?>

                    <!-- <div class="col-sm-12 col-md-12  mx-auto">
                    <a class="nav-link streaming-button text-center p-3 mb-3" style="font-weight:300"
                        href="../dashboard/directo/"><i class="icon-video"></i>Streaming</a>
                </div> -->

                    <!-- <div class="col-sm-12 col-md-6  mx-auto">
                        <a class="nav-link streaming-button  text-center p-3 mb-3" style="font-weight:300" download="Certificado 7º Codigo Sepsis <?php echo $usuario['NAME'] . " " . $usuario['SURNAME'] ?>" href="../assets/archivos/certificados/codigosepsis/<?php echo $usuario['ID'] ?>.pdf">
                            <i class="icon-download1"></i>CERTTIFICATE ISICIP</a>
                    </div> -->
                <?php endif; ?>
                <div class="col-lg-12 col-md-12 my-3">
                    <h2 class="text-center mb-4">RESUME</h2>
                </div>
                <div class="col-lg-6 col-md-12 p-3">
                    <div class="bg-white shadow-sm p-3">
                        <h3 class="text-uppercase p-3 bg-white border w-75 title-card">Personal Information</h3>

                        <?php
                        foreach ($campos as $elemento) :

                            if (
                                $elemento['TIPO'] == "USUARIO"
                                and $elemento['CAMPO'] != "PASS"
                            ) :
                        ?>
                                <div class="col-lg-12 col-md-12 text-left">
                                    <h6 class='p-2 mb-1'><strong><?php echo $elemento['CAMPO'] ?>:</strong>
                                        <span><?php echo $usuario[$elemento['CAMPO']] ?></span>
                                    </h6>
                                </div>

                        <?php
                            endif;

                        endforeach;
                        ?>
                    </div>
                </div>
                <?php if ($fila5['ESTADO_PROF'] == 1) : ?>
                    <div class="col-lg-6 col-md-12 p-3">
                        <div class="border bg-white shadow-sm p-3">
                            <h3 class="text-uppercase p-3 bg-white border w-75 title-card">Professional Information</h3>

                            <?php
                            foreach ($campos as $elemento) :
                                if ($elemento['TIPO'] == "PROF") : ?>
                                    <div class="col-lg-12 col-md-12 text-left">
                                        <h6 class='p-2 mb-1'><strong><?php echo $elemento['PLACEHOLDER'] ?>:</strong>
                                            <span><?php echo $usuario["P" . $elemento['CAMPO']] ?></span>
                                        </h6>
                                    </div>
                        <?php
                                endif;
                            endforeach;
                        endif;
                        ?>
                        </div>
                    </div>
                    <?php if ($fila5['ESTADO_FACTURA'] == 1) : ?>
                        <div class="col-lg-6 col-md-12 mt-5 p-3">
                            <div class="border bg-white shadow-sm p-3">
                                <h3 class="text-uppercase p-3 bg-white border w-75 title-card">Invoice Information</h3>

                                <?php
                                foreach ($campos as $elemento) :
                                    if ($elemento['TIPO'] == "FACT") : ?>
                                        <div class="col-lg-12 col-md-12 text-left">
                                            <h6 class='p-2 mb-1'><strong><?php echo $elemento['PLACEHOLDER'] ?>:</strong>
                                                <span><?php echo $usuario["F" . $elemento['CAMPO']] ?></span>
                                            </h6>
                                        </div>
                            <?php
                                    endif;
                                endforeach;
                            endif;
                            ?>
                            </div>
                        </div>
                        <?php if ($fila5['ESTADO_ACOMPA'] == 1) : ?>
                            <div class="col-lg-6 col-md-12 mt-5 p-3">
                                <div class="border bg-white shadow-sm p-3">
                                    <h4 class="text-uppercase p-3 bg-white border w-75 title-card">Datos Acompañante</h4>

                                    <?php
                                    foreach ($campos as $elemento) :
                                        if (
                                            $elemento['TIPO'] == "ACOMPA"
                                            and $elemento['CAMPO'] != "DATE"
                                        ) : ?>
                                            <div class="col-lg-12 col-md-12 text-left">
                                                <h6 class='p-2 mb-1'>
                                                    <strong><?php echo $elemento['PLACEHOLDER'] ?>:</strong>
                                                    <span><?php echo $usuario["A" . $elemento['CAMPO']] ?></span>
                                                </h6>
                                            </div>
                                <?php
                                        endif;
                                    endforeach;
                                endif;
                                ?>
                                </div>
                            </div>
                            <?php if ($fila5['ESTADO_ALOJAMIENTO'] == 1) : ?>
                                <div class="col-lg-6 col-md-12 mt-5">
                                    <div class="border bg-white shadow-sm p-3">
                                        <h4 class="text-uppercase p-3 bg-white border w-75 title-card">Datos Alojamiento</h4>

                                        <?php
                                        foreach ($reservas as $elemento) :
                                            foreach ($habitaciones as $elemento2) :
                                                if ($elemento2['PRECIO'] == $elemento['HABITACION']) :
                                        ?>
                                                    <div class="col-lg-12 col-md-12 text-left">
                                                        <h6 class='p-2 mb-1'><strong>Reserva: </strong> <span><?php echo $elemento['ID'] ?></span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 text-left">
                                                        <h6 class='p-2 mb-1'><strong>Habitación: </strong>
                                                            <span><?php echo $elemento2['HABITACION'] . " | " . $elemento['HABITACION'] . "€/noche" ?></span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 text-left">
                                                        <h6 class=' p-2 mb-1'><strong>Noches:
                                                            </strong><span><?php echo $elemento['NOCHES'] ?></span></h6>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 text-left">
                                                        <h6 class='p-2 mb-1'><strong>Fecha de Entrada: </strong>
                                                            <span><?php echo $elemento['F_ENTRADA'] ?></span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 text-left">
                                                        <h6 class='p-2 mb-1'><strong>Fecha de Salida: </strong>
                                                            <span><?php echo $elemento['F_SALIDA'] ?></span>
                                                        </h6>
                                                    </div>
                                    <?php
                                                endif;
                                            endforeach;
                                        endforeach;
                                    endif;
                                    ?>
                                    </div>
                                </div>
                                <?php if ($fila5['ESTADO_EXTRAS'] == 1) : ?>
                                    <div class="col-lg-6 col-md-12 mt-5">
                                        <div class="border bg-white shadow-sm p-3">
                                            <h4 class="text-uppercase p-3 bg-white border w-75 title-card">Datos de Interés</h4>

                                            <?php

                                            foreach ($campos as $elemento) :
                                                if (
                                                    $elemento['TIPO'] == "EXTRA"
                                                    or $elemento['TIPO'] == "EXTRA_SER"
                                                ) : ?>
                                                    <div class="col-lg-12 col-md-12 text-left">
                                                        <h6 class='p-2 mb-1'><strong><?php echo $elemento['PLACEHOLDER'] ?>:</strong>
                                                            <span id='ERESUMEN_<?php echo $elemento['CAMPO'] ?>'></span>
                                                        </h6>
                                                    </div>
                                        <?php
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                        </div>
                                    </div>
            </div>
        </div>
    </section>
    <!-- blog section -->

    <!-- weight footer section -->
    <script src="../dashboard/js/registros/jquery-1.12.4.min.js"></script>
    <script src="../dashboard/js/registros/popper.min.js"></script>
    <script src="../dashboard/js/registros/bootstrap.min.js"></script>
    <script src="../dashboard/js/registros/equal-height.min.js"></script>
    <script src="../dashboard/js/registros/jquery.appear.js"></script>
    <script src="../dashboard/js/registros/jquery.easing.min.js"></script>
    <script src="../dashboard/js/registros/jquery.magnific-popup.min.js"></script>
    <script src="../dashboard/js/registros/modernizr.custom.13711.js"></script>
    <script src="../dashboard/js/registros/owl.carousel.min.js"></script>
    <script src="../dashboard/js/registros/wow.min.js"></script>
    <script src="../dashboard/js/registros/progress-bar.min.js"></script>
    <script src="../dashboard/js/registros/isotope.pkgd.min.js"></script>
    <script src="../dashboard/js/registros/imagesloaded.pkgd.min.js"></script>
    <script src="../dashboard/js/registros/count-to.js"></script>
    <script src="../dashboard/js/registros/YTPlayer.min.js"></script>
    <script src="../dashboard/js/registros/progresscircle.js"></script>
    <script src="../dashboard/js/registros/bootsnav.js"></script>
    <script src="../dashboard/js/registros/main.js"></script>
    <script>
        function goback() {
            window.history.go(-1);
        }

        $('#ph').on('keypress', function() {
            var text = $(this).val().length;
            if (text > 9) {
                return false;
            } else {
                $('#ph').text($(this).val());
            }

        });
    </script>

</body>

</html>