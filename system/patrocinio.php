<?php

session_start();

if ( !empty( $_SESSION[ 'log_user_id' ] ) ) {

  $name = $_SESSION[ 'log_user_data' ];
  $correo = $_SESSION[ 'log_user_id' ];
  $key = $_SESSION[ 'code_id' ];

  include( "../php/config.php" );

  $sql = "SELECT * FROM session WHERE CODE=:code";
  $resultado = $cnt->prepare( $sql );
  $resultado->execute( array( ":code" => $key ) );
  $fila = $resultado->rowCount();
  if ( $fila == 0 ) {
    header( "location:../index.php?key=false" );
  }

} else {

  header( "location:../index.php" );

}
$sql = "SELECT * FROM form WHERE email=:id";
  $resultado = $cnt->prepare( $sql );
  $resultado->execute( array( ":id" => $correo ) );
  $fila2 = $resultado->fetch(PDO::FETCH_ASSOC);

header( "Cache-Control: no-cache, must-revalidate" ); // HTTP/1.1

header( "Expires: Sat, 1 Jul 2000 05:00:00 GMT" ); // Fecha en el pasado

?>

<!DOCTYPE html>

<!-- saved from url=(0021)http://localhost/FAM/ -->

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ISICIP 2023</title>
    <meta name="author" content="tansh">
    <meta name="description" content="27th International Symposium on Infections in the Criticaly Ill Patient">
    <meta name="keywords" content="ISICIP 2023, isicip, ISICIP, isicip 23, isicip 2023, Congreso, medicine">

    <!-- FAVICON FILES -->

    <link href="../assets/images/icons/apple-touch-icon-144-precomposed.png" rel="apple-touch-icon" sizes="144x144">
    <link href="../assets/images/icons/apple-touch-icon-120-precomposed.png" rel="apple-touch-icon" sizes="120x120">
    <link href="../assets/images/icons/apple-touch-icon-76-precomposed.png" rel="apple-touch-icon" sizes="76x76">
    <link href="../assets/images/icons/favicon.png" rel="shortcut icon">

    <!-- CSS FILES -->

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/iconfonts.css">
    <link rel="stylesheet" href="../assets/css/plugins.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/color.css">
    <style>
    .active2 {
        background: #2D819C;
        border-radius: 5px;

    }

    .nav-link:hover {
        background: rgba(18, 163, 168, 0.44);
        border-radius: 5px;
    }

    :root {
        --bg-color: #2D819C;

    }
    </style>
</head>

<body>
    <?php

$ip = $_SERVER[ 'REMOTE_ADDR' ];
$dataArray = json_decode( file_get_contents( "http://www.geoplugin.net/json.gp?ip=" . $ip ), true );
$country = $dataArray[ "geoplugin_countryName" ];
?>
    <a class="ir-arriba" javascript:void(0)="" title="Volver arriba" style="display: none;"> <span class="fa-stack"> <i
                class="icon-arrow-up"></i> </span> </a>
    <div id="dtr-wrapper" class="clearfix">

        <!-- preloader starts -->

        <div class="dtr-preloader" style="display: none;">
            <div class="dtr-preloader-inner">
                <div class="dtr-loader">Loading...</div>
            </div>
        </div>

        <!-- preloader ends -->

        <!-- Small Devices Header 

============================================= -->

        <div class="dtr-responsive-header fixed-top ">
            <div class="container">

                <!-- small devices logo -->
                <a href="index.html"><img src="../assets/images/logo-dark.png" alt="logo"></a>
                <!-- small devices logo ends -->

                <!-- menu button -->
                <button id="dtr-menu-button" class="dtr-hamburger " type="button"><span
                        class="dtr-hamburger-lines-wrapper"><span class="dtr-hamburger-lines"></span></span></button>
            </div>
            <div class="dtr-responsive-header-menu"></div>
        </div>
        <!-- Small Devices Header ends -->

        <!-- Small Devices Header ends 

============================================= -->

        <!-- Header 

============================================= -->

        <header id="dtr-header-global" class="fixed-top trans-header">
            <div class="container">
                <div class="w-100" style="text-align: right">
                </div>
                <div class="d-flex align-items-center justify-content-between">

                    <!-- header left starts -->
                    <div class="dtr-header-left"> <a class="logo-default dtr-scroll-link" href="#home"><img
                                src="../assets/images/logo-light.png" alt="logo" width="70%"></a> <a
                            class="logo-alt dtr-scroll-link" href="#home"><img src="../assets/images/logo-dark.png"
                                alt="logo" width="70%"></a> </div>


                    <!-- header left ends -->

                    <!-- menu starts-->
                    <div class="dtr-header-right ml-auto">
                        <div class="main-navigation dtr-menu-light">
                            <ul class="sf-menu dtr-scrollspy dtr-nav light-nav-on-load dark-nav-on-scroll sf-js-enabled sf-arrows dtr-menu-light"
                                style="touch-action: pan-y;">
                                <li> <a class="nav-link  px-1 py-1" href="index.php">Home</a> </li>
                                <li> <a class="nav-link px-1 py-1" href="program.php">Program</a> </li>
                                <li> <a class="nav-link px-1 py-1" href="comittees.php">Comittees</a> </li>
                                <li> <a class="nav-link px-1 py-1" href="participants.php">Participants</a> </li>
                                <li> <a class="nav-link px-1 py-1" href="sesiones/sessions.php">Last Edition</a> </li>
                                <li> <a class="nav-link px-1 py-1   active active2"
                                        href="patrocinio.php">Sponsorship</a> </li>
                                <li> <a class="nav-link px-1 py-1" href="sesiones/directo.php">Streaming</a> </li>
                                <li> <a class="nav-link px-1 py-1" href="contact.php">Contact</a> </li>
                                <li>
                                    <div class="dropdown">
                                        <!--<a class="btn bg-red  text-white mx-3"  download='Certificate-ISICIP-2022' href='../assets/CEERTIFICADOS/certificado<?php echo $fila2['ID']?>.pdf'> Download Certicate </a>-->
                                        <button class="btn bg-red dropdown-toggle text-white" style="font-size: 11px"
                                            type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                            aria-expanded="false"> <?php echo $correo ?> </button>
                                        <ul class="dropdown-menu py-0" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="../php/log_close.php">Logout</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- menu ends -->

                    <!-- header button starts -->

                    <!-- header button ends -->

                </div>
            </div>
        </header>

        <!-- header ends

================================================== -->

        <!-- == main content area starts == -->

        <div id="dtr-main-content">

            <!-- hero section starts

================================================== -->


            <section id="home" class="dtr-section dtr-section-with-bg dtr-hero-section-top-padding bg-blue"
                style="background-image: url(../assets/images/white-shape-bg.png);background-position: top">

                <!-- wrapping div for background bottom curve stripes image - easy to change color - no need to edit image - refer help doc -->

                <div class="dtr-bottom-shape-img" style="background-image: url(../assets/images/hero-bottom.svg);">
                    <div class="container">

                        <!--===== row 1 starts =====-->

                    </div>
            </section>

            <!-- hero section ends

================================================== -->

            <!-- features section starts

================================================== -->

            <!-- features section ends

================================================== -->

            <!-- sticky tabs starts

================================================== -->

            <section id="services" class="dtr-sticky-tabs-wrapper mt-5">

                <!-- wrapping div for top shape image - easy to change color / no need to edit image - refer help doc -->



                <!-- tabs nav ends -->

                <div data-target=".dtr-scrollspy-tabs">

                    <!-- tab 1 starts -->

                    <section>
                        <div class="container my-5 px-5 py-3">
                            <div class="d-flex">
                                <div class="p-2">
                                    <h2 style="color: var(--bg-color);font-weight: 600"><i class="fas fa-flag"></i>
                                        Sponsors Area</h2>
                                </div>

                            </div>
                        </div>
                        <div class="container p-3 text-center">
                            <ul class="nav nav-pills my-5" id="botones_patrocinio" role="tablist">
                                <li class='nav-item' role='presentation'><button
                                        class='nav-link programa_active p-3 m-2 programaoff border-0' id='btn1'
                                        data-bs-toggle='tab' data-bs-target='#Gold_content' type='button' role='tab'
                                        aria-controls='home' aria-selected='true'>Gold Sponsors</button></li>
                                <li class='nav-item' role='presentation'><button
                                        class='nav-link programa_active p-3 m-2 programaoff border-0' id='btn2'
                                        data-bs-toggle='tab' data-bs-target='#Silver_content' type='button' role='tab'
                                        aria-controls='home' aria-selected='true'>Silver Sponsors</button></li>
                                <li class='nav-item' role='presentation'><button
                                        class='nav-link programa_active p-3 m-2 programaoff border-0' id='btn3'
                                        data-bs-toggle='tab' data-bs-target='#Bronze_content' type='button' role='tab'
                                        aria-controls='home' aria-selected='true'>Bronze Sponsors</button></li>

                            </ul>
                            <div class="tab-content" id="botones_patrocinioContent">
                                <div class="tab-pane fade show active" id="Gold_content" role="tabpanel"
                                    aria-labelledby="oro">

                                    <div class='card d-inline-block m-3 border shadow' style='width: 20rem;'><img
                                            src='../Imagenes/sponsors/BD.png' class='card-img-top'>
                                        <ul class='list-group list-group-flush'>
                                            <div class='card-body text-start mt-3 dtr-border-top'>
                                                <h4 class='card-title py-2'>BD</h4>
                                                <a class='btn btn-outline border-0 py-2 px-4 open_modal_patrocinador'
                                                    style='background-color: var(--bg-color);color:white'
                                                    data-bs-target='#datos_patrocinador' data-bs-toggle='modal'><i
                                                        class='fas fa-plus-square'></i> &nbsp;See More</a>
                                            </div>
                                            <ul>
                                    </div>

                                    <div class='card d-inline-block m-3 border shadow' style='width: 20rem;'><img
                                            src='../Imagenes/sponsors/ESTOR2.png' class='card-img-top'>
                                        <ul class='list-group list-group-flush'>
                                            <div class='card-body text-start mt-3 dtr-border-top'>
                                                <h4 class='card-title py-2'>ESTOR - DIREX</h4>
                                                <!--<a class='btn btn-outline border-0 py-2 px-4 open_modal_patrocinador' style='background-color: var(--bg-color);color:white' data-bs-target='#datos_patrocinador' data-bs-toggle='modal'><i class='fas fa-plus-square'></i> &nbsp;See More</a>-->
                                            </div>
                                            <ul>
                                    </div>
                                    <div class='card d-inline-block m-3 border shadow' style='width: 20rem;'><img
                                            src='../Imagenes/sponsors/MSD.png' class='card-img-top'>
                                        <ul class='list-group list-group-flush'>
                                            <div class='card-body text-start mt-3 dtr-border-top'>
                                                <h4 class='card-title py-2'>MSD</h4>
                                                <!--<a class='btn btn-outline border-0 py-2 px-4 open_modal_patrocinador' style='background-color: var(--bg-color);color:white' data-bs-target='#datos_patrocinador' data-bs-toggle='modal'><i class='fas fa-plus-square'></i> &nbsp;See More</a>-->
                                            </div>
                                            <ul>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="Silver_content" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <div class='card d-inline-block m-3 border shadow' style='width: 20rem;'><img
                                            src='../Imagenes/sponsors/multitrade.png' class='card-img-top p-3'>
                                        <ul class='list-group list-group-flush'>
                                            <div class='card-body text-start mt-3 dtr-border-top'>
                                                <h4 class='card-title py-2'>NOB - 166 / Multitrade</h4>
                                                <!--<a class='btn btn-outline border-0 py-2 px-4 open_modal_patrocinador' style='background-color: var(--bg-color);color:white' data-bs-target='#datos_patrocinador' data-bs-toggle='modal'><i class='fas fa-plus-square'></i> &nbsp;See More</a>-->
                                            </div>
                                            <ul>
                                    </div>
                                    <div class='card d-inline-block m-3 border shadow' style='width: 20rem;'><img
                                            src='../Imagenes/sponsors/viatris2.png' class='card-img-top p-3'>
                                        <ul class='list-group list-group-flush'>
                                            <div class='card-body text-start mt-3 dtr-border-top'>
                                                <h4 class='card-title py-2'>VIATRIS</h4>
                                                <a class='btn btn-outline border-0 py-2 px-4 open_modal_patrocinador'
                                                    style='background-color: var(--bg-color);color:white'
                                                    data-bs-target='#datos_patrocinador' data-bs-toggle='modal'><i
                                                        class='fas fa-plus-square'></i> &nbsp;See More</a>
                                            </div>
                                            <ul>
                                    </div>

                                    <!---------------------------aqui se insertan las tarjetas de patrocinadores Plata--------------------------------->

                                </div>
                                <div class="tab-pane fade" id="Bronze_content" role="tabpanel"
                                    aria-labelledby="contact-tab">
                                    <div class='card d-inline-block m-3 border shadow' style='width: 20rem;'><img
                                            src='../Imagenes/sponsors/AOP2.png' class='card-img-top p-3'>
                                        <ul class='list-group list-group-flush'>
                                            <div class='card-body text-start mt-3 dtr-border-top'>
                                                <h4 class='card-title py-2'>AOP Health</h4>
                                                <a class='btn btn-outline border-0 py-2 px-4 open_modal_patrocinador'
                                                    style='background-color: var(--bg-color);color:white'
                                                    data-bs-target='#datos_patrocinador' data-bs-toggle='modal'><i
                                                        class='fas fa-plus-square'></i> &nbsp;See More</a>
                                            </div>
                                            <ul>
                                    </div>
                                    <div class='card d-inline-block m-3 border shadow' style='width: 20rem;'><img
                                            src='../Imagenes/sponsors/baxter1.png' class='card-img-top p-3'>
                                        <ul class='list-group list-group-flush'>
                                            <div class='card-body text-start mt-3 dtr-border-top'>
                                                <h4 class='card-title py-2'>BAXTER</h4>
                                                <a class='btn btn-outline border-0 py-2 px-4 open_modal_patrocinador'
                                                    style='background-color: var(--bg-color);color:white'
                                                    data-bs-target='#datos_patrocinador' data-bs-toggle='modal'><i
                                                        class='fas fa-plus-square'></i> &nbsp;See More</a>
                                            </div>
                                            <ul>
                                    </div>
                                    <div class='card d-inline-block m-3 border shadow' style='width: 20rem;'><img
                                            src='../Imagenes/sponsors/biotest.png' class='card-img-top p-3'>
                                        <ul class='list-group list-group-flush'>
                                            <div class='card-body text-start mt-3 dtr-border-top'>
                                                <h4 class='card-title py-2'>BIOTEST</h4>
                                                <a class='btn btn-outline border-0 py-2 px-4 open_modal_patrocinador'
                                                    style='background-color: var(--bg-color);color:white'
                                                    data-bs-target='#datos_patrocinador' data-bs-toggle='modal'><i
                                                        class='fas fa-plus-square'></i> &nbsp;See More</a>
                                            </div>
                                            <ul>
                                    </div>
                                    <div class='card d-inline-block m-3 border shadow' style='width: 20rem;'><img
                                            src='../Imagenes/sponsors/BIOVERSYS.png' class='card-img-top p-3'>
                                        <ul class='list-group list-group-flush'>
                                            <div class='card-body text-start mt-3 dtr-border-top'>
                                                <h4 class='card-title py-2'>BIOVERSYS</h4>
                                                <!--<a class='btn btn-outline border-0 py-2 px-4 open_modal_patrocinador' style='background-color: var(--bg-color);color:white' data-bs-target='#datos_patrocinador' data-bs-toggle='modal'><i class='fas fa-plus-square'></i> &nbsp;See More</a>-->
                                            </div>
                                            <ul>
                                    </div>
                                    <div class='card d-inline-block m-3 border shadow' style='width: 20rem;'><img
                                            src='../Imagenes/sponsors/Grifols_1.png' class='card-img-top p-3'>
                                        <ul class='list-group list-group-flush'>
                                            <div class='card-body text-start mt-3 dtr-border-top'>
                                                <h4 class='card-title py-2'>Grifols</h4><a
                                                    class='btn btn-outline border-0 py-2 px-4 open_modal_patrocinador'
                                                    style='background-color: var(--bg-color);color:white'
                                                    data-bs-target='#datos_patrocinador' data-bs-toggle='modal'><i
                                                        class='fas fa-plus-square'></i> &nbsp;See More</a>
                                            </div>
                                            <ul>
                                    </div>
                                    <div class='card d-inline-block m-3 border shadow' style='width: 20rem;'><img
                                            src='../Imagenes/sponsors/mena.png' class='card-img-top p-3'>
                                        <ul class='list-group list-group-flush'>
                                            <div class='card-body text-start mt-3 dtr-border-top'>
                                                <h4 class='card-title py-2'>GRUPO MENARINI</h4>
                                                <a class='btn btn-outline border-0 py-2 px-4 open_modal_patrocinador'
                                                    style='background-color: var(--bg-color);color:white'
                                                    data-bs-target='#datos_patrocinador' data-bs-toggle='modal'><i
                                                        class='fas fa-plus-square'></i> &nbsp;See More</a>
                                            </div>
                                            <ul>
                                    </div>
                                    <div class='card d-inline-block m-3 border shadow' style='width: 20rem;'><img
                                            src='../Imagenes/sponsors/shion2.png' class='card-img-top p-3'>
                                        <ul class='list-group list-group-flush'>
                                            <div class='card-body text-start mt-3 dtr-border-top'>
                                                <h4 class='card-title py-2'>SHIONOGI</h4>
                                                <a class='btn btn-outline border-0 py-2 px-4 open_modal_patrocinador'
                                                    style='background-color: var(--bg-color);color:white'
                                                    data-bs-target='#datos_patrocinador' data-bs-toggle='modal'><i
                                                        class='fas fa-plus-square'></i> &nbsp;See More</a>
                                            </div>
                                            <ul>
                                    </div>
                                    <div class='card d-inline-block m-3 border shadow' style='width: 20rem;'><img
                                            src='../Imagenes/sponsors/thermofisher2.png' class='card-img-top p-3'>
                                        <ul class='list-group list-group-flush'>
                                            <div class='card-body text-start mt-3 dtr-border-top'>
                                                <h4 class='card-title py-2'>THERMOFISHER</h4><a
                                                    class='btn btn-outline border-0 py-2 px-4 open_modal_patrocinador'
                                                    style='background-color: var(--bg-color);color:white'
                                                    data-bs-target='#datos_patrocinador' data-bs-toggle='modal'><i
                                                        class='fas fa-plus-square'></i> &nbsp;See More</a>
                                            </div>
                                            <ul>
                                    </div>
                                    <div class='card d-inline-block m-3 border shadow' style='width: 20rem;'><img
                                            src='../Imagenes/sponsors/Bbbraun-orig.png' class='card-img-top p-3'>
                                        <ul class='list-group list-group-flush'>
                                            <div class='card-body text-start mt-3 dtr-border-top'>
                                                <h4 class='card-title py-2'>B. Braun</h4>
                                                <a class='btn btn-outline border-0 py-2 px-4 open_modal_patrocinador'
                                                    style='background-color: var(--bg-color);color:white'
                                                    data-bs-target='#datos_patrocinador' data-bs-toggle='modal'><i
                                                        class='fas fa-plus-square'></i> &nbsp;See More</a>
                                            </div>
                                            <ul>
                                    </div>

                                    <!---------------------------aqui se insertan las tarjetas de patrocinadores Bronce--------------------------------->

                                </div>
                                <div class="tab-pane fade" id="Colaborador_content" role="tabpanel"
                                    aria-labelledby="contact-tab">

                                    <!---------------------------aqui se insertan las tarjetas de  Colaboradores--------------------------------->

                                </div>
                            </div>
                        </div>

                        <!-- Modal -->

                        <div class="modal fade" id="datos_patrocinador" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="datos_patrocinadorLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-scrollable" style="overflow-x: hidden">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="datos_patrocinadorLabel">Gold Sponsors</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <a id="a_banner" target="_blank">
                                            <div class="w-100"
                                                style='height: 260px;display: none; background-image: url("../Imagenes/patrocinadores/0.png");background-size: 100% auto; background-repeat: no-repeat'
                                                id="fondo_patrocinador"></div>
                                        </a>
                                        <section class="container p-5">
                                            <div class="border-bottom d-flex py-3">
                                                <div class="d-inline-block">
                                                    <h2 style="font-weight: 700" class="py-2" id='company_name'>Nombre
                                                        de la Empresa</h2>
                                                    <h6 style="color:var(--bg-color)"><i class="fas fa-globe"></i><a
                                                            id="web_patrocinador" class="text-decoration-none"
                                                            target="_blank" style="display:none"><span
                                                                class="h6 mx-2">Web site</span></a> </h6>
                                                    <h6 style="color:var(--bg-color)" id="container_contactname"></h6>
                                                    <h6 style="color:var(--bg-color)"><i
                                                            class="fas fa-phone-square-alt"></i> <span class="h6  mx-2"
                                                            style="color: black; display: none;"
                                                            id="phone_patrocinador">+34 645 85 35 78</span></h6>
                                                    <h6 style="color:var(--bg-color)"><i
                                                            class="fas fa-envelope-open-text"></i> <span
                                                            class="h6  mx-2" style="color: black;display: none;"
                                                            id="nombre_contacto">Nombre</span></h6>
                                                    <h6 style="color:var(--bg-color)"><i
                                                            class="fas fa-envelope-open-text"></i> <span
                                                            class="h6  mx-2" style="color: black;"
                                                            id="email_patrocinador">info@avmedios.com</span></h6>
                                                    <h6 style="color:var(--bg-color)" id="container_address"></h6>
                                                </div>
                                                <div class="ms-auto" style="width: 240px;margin-left: auto"><a href='#'
                                                        id="enlace_logo_patrocinador" target='_blank'><img
                                                            src="../Imagenes/patrocinadores/AV Medios Design.png"
                                                            class="p-2" style="width: 100%;vertical-align:bottom"
                                                            id="logo_patrocinador"></a></div>
                                            </div>
                                            <div class="pt-3">
                                                <h2 style="background-color: var(--bg-color);"
                                                    class="py-2 px-4 text-white">Description</h2>
                                                <ul class="w-100 m-auto p-3" style="list-style: none"
                                                    id="content_patrocinio_list">
                                                    <li class="w-100">
                                                        <p id="info_patrocinador">Lorem ipsum dolor sit amet,
                                                            consectetur adipiscing elit. Fusce fermentum est non nisi
                                                            aliquam sollicitudin. Duis eget nibh ac nunc porta blandit.
                                                            Donec ut lacinia augue, sed suscipit massa. Praesent nec
                                                            elit tellus. Aliquam interdum metus et metus lacinia semper.
                                                            Maecenas lacus quam, elementum eu urna et, sollicitudin
                                                            aliquet eros. Duis pellentesque, enim a finibus tempor, leo
                                                            mauris scelerisque purus.<br>
                                                        </p>
                                                        <br>
                                                    </li>
                                                    <li class="w-100 d-flex">
                                                        <div style="padding:56.25% 0 0 0;position:relative; width: 100%; height: auto; vertical-align: top"
                                                            class="d-inline-block" id="video">
                                                            <iframe src="" frameborder="0"
                                                                allow="autoplay; fullscreen; picture-in-picture"
                                                                allowfullscreen
                                                                style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
                                                        </div>
                                                    </li>
                                                    <li class="w-100  mt-4" style="display: none" id="archivo1">
                                                        <div class="border w-100 d-flex">
                                                            <a href="" dounload="" class="btn m-3 text-white"
                                                                style="background:var(--bg-color)">Descargar
                                                                archivo</a>
                                                            <p class="mt-4"></p>
                                                        </div>
                                                    </li>
                                                    <li class="w-100  mt-4" style="display: none" id="archivo2">
                                                        <div class="border w-100 d-flex">
                                                            <a href="" dounload="" class="btn m-3 text-white"
                                                                style="background:var(--bg-color)">Descargar
                                                                archivo</a>
                                                            <p class="mt-4"></p>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Salir</button>
                                    </div>
                                </div>
                            </div>

                    </section>

                    <!-- tab 1 ends -->

                    <!-- tab 2 starts -->

                    <section id="tab2" class="dtr-sticky-tabs-section">
                        <div class="dtr-sticky-tabs-content">
                            <div class="container">
                                <div class="row">


                                    <!-- column 2 ends -->

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
        </div>
        </section>

        <!-- top background curve image - easy to change color / no need to edit image - refer help doc -->

        <?php include('../footer.php')?>

        <!-- footer section ends

================================================== -->

        <!-----------------------------------MODAL---------------------------------------->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2"><strong
                                style="text-decoration: underline">Privacy Policy</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container p-4">
                            <div>
                                <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Confidentiality
                                    and Data Protection</h3>
                                <p>Pursuant to the GDPR, of April 27, 2016, Fundación Código Sepsis informs Users of the
                                    existence of an automated file containing personal data, created by, for and under
                                    the liability Fundación Código Sepsis for purposes of maintaining and managing
                                    relationships with Users and providing information. Upon acceptance of these general
                                    terms and conditions, the User will be asked by Fundación Código Sepsis to provide
                                    certain data essential for the provision of its services.</p>
                            </div>
                            <div>
                                <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Registration of
                                    files and forms</h3>
                                <p>To access and use certain services provided via the Website, it is compulsory to
                                    complete a registration form. Failure to provide the personal details required or to
                                    accept this data protection policy will result in the User being unable to subscribe
                                    to, register for or participate in any promotion for which personal details are
                                    requested.<br>
                                    Pursuant to the GDPR, of April 27, 2016, we inform you that the personal data
                                    provided as a result of User registration will be incorporated into a file owned by
                                    [NOMBRE CLIENTE], with C.I.F num. G98775976 and corporate address at C/ DEL
                                    JUSTICIA, 1 ENTLO. PUERTA 13, VALENCIA, 46003, VALENCIA , and that the security
                                    measures have been implemented. </p>
                            </div>
                            <div>
                                <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Accuracy and
                                    truthfulness of data provided</h3>
                                <p>The User accepts full liability for the accuracy and truthfulness of the data
                                    provided and exonerates Fundación Código Sepsis from any liability in this regard.
                                    The User assures and is answerable in any event for the accuracy, currency and
                                    authenticity of the personal data provided and undertakes to keep those data
                                    properly updated. The User agrees to provide full and correct information on
                                    registration/subscription forms. Fundación Código Sepsis provides no assurances as
                                    to the truthfulness of any information not drawn up by the Company itself and
                                    identified as coming from other sources and, therefore, assumes no liability for any
                                    harm that might be caused by the use of such information. Fundación Código Sepsis
                                    provided on its Website and to limit or deny access thereto. Fundación Código Sepsis
                                    accepts no liability for any damage or harm that Users may suffer as a result of
                                    errors, shortcomings or omissions in information provided by Fundación Código Sepsis
                                    provided that it comes from sources other than Fundación Código Sepsis.<br>
                                    The site (symposiumsepsis22.com) does not use cookies, considering such physical
                                    information files hosted in the user's own terminal and serve to facilitate the
                                    user's navigation through the portal. In any case, the user has the possibility of
                                    configuring the browser in such a way that it prevents the installation of these
                                    files. </p>
                            </div>
                            <div>
                                <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Purposes</h3>
                                <p>The purposes of Fundación Código Sepsis are to maintain and manage relationships with
                                    its Users and to provide information.</p>
                            </div>
                            <div>
                                <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Assignment of data
                                    to third parties</h3>
                                <p>Fundación Código Sepsis undertakes not to assign data on Users to third parties.</p>
                            </div>
                            <div>
                                <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Exercise of rights
                                    of access, rectification, cancellation and opposition</h3>
                                <p>You may send any communications and exercise the rights of access, rectification,
                                    erasure, restriction, portability and opposition to the email address
                                    eventos03@cerotreseventos.es or by regular mail to Fundación Código Sepsis Ref.
                                    GDPR, at C/ DEL JUSTICIA, 1 ENTLO. PUERTA 13, VALENCIA, 46003, VALENCIA. In order to
                                    exercise these rights, it is necessary for you to verify your identity before
                                    Fundación Código Sepsis by sending a photocopy of your Spanish National identity
                                    Document or any other legally valid means. However, you may modify or rectify your
                                    registration data on the Website itself after you identify yourself with your
                                    username and password. </p>
                            </div>
                            <div>
                                <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Security measures
                                </h3>
                                <p>Fundación Código Sepsis has implemented the standards of security for the protection
                                    of personal data required by law and makes every attempt to install such further
                                    technical means and measures as may be available to it to prevent loss of, misuse
                                    of, manipulation of, unauthorized access to and theft of the personal data provided
                                    to Fundación Código Sepsis accepts no liability for any damage or harm that might
                                    result from interference, omissions, interruptions, computer viruses, telephone
                                    malfunctions or disconnections in the course of the operation of this electronic
                                    system for reasons not attributable to Fundación Código Sepsis; or delays or
                                    blockages in the use of this electronic system caused by shortcomings or overloads
                                    in telephone lines or overloads at data processing centers, on the Internet or in
                                    other electronic systems; or for any damage that may be caused by third parties as a
                                    result of unlawful interference beyond the control of Fundación Código Sepsis.
                                    Notwithstanding the foregoing, Users should be aware that Internet security measures
                                    are not infallible. </p>
                            </div>
                            <div>
                                <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Acceptance and
                                    consent</h3>
                                <p>The User declares that he/she has been informed of the terms and conditions governing
                                    the protection of personal data and hereby accepts and consents to the automatic
                                    processing of such data by Fundación Código Sepsis in the way and for the purposes
                                    indicated in this Personal Data Protection Policy. Some services provided via the
                                    portal may entail particular terms and conditions with specific provisions in regard
                                    to Personal Data protection.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3"><strong style="text-decoration: underline">Legal
                                Notice</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container p-4">
                            <div>
                                <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Legal Notice</h3>
                                <p>This legal notice (hereinafter, the “Legal Notice”) regulates the use of the Internet
                                    portal service symposiumsepsis22.com (hereinafter, the “Website”) of Fundación
                                    Código Sepsis, with corporate address at C/ DEL JUSTICIA, 1 ENTLO. PUERTA 13,
                                    VALENCIA, 46003, VALENCIA and C.I.F G98775976</p>
                            </div>
                            <div>
                                <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Legislation</h3>
                                <p>The relationship between Fundación Código Sepsis and the Users of its remote services
                                    on the Website is subject, in general, to the legislation and jurisdiction of Spain.
                                    <br>
                                    The parties expressly waive any other jurisdictional rights and submit expressly to
                                    the rulings of the courts and tribunals of Valencia for the settlement of any
                                    dispute that may arise in the construal or enforcement of these terms and
                                    conditions.
                                </p>
                            </div>
                            <div>
                                <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Intellectual and
                                    industrial property</h3>
                                <p>Fundación Código Sepsis is the owner of the intellectual property rights of its
                                    website’s content, graphic design and codes; therefore, its reproduction,
                                    distribution, public communication, transformation or any other activity performed
                                    with the webpage’s content is prohibited (even if the sources were mentioned),
                                    unless written consent is given by Fundación Código Sepsis. All the commercial
                                    names, trademarks and distinctive signs of any kind contained on the Company’s
                                    website are the property of its owners and protected by law. </p>
                            </div>
                            <div>
                                <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Links</h3>
                                <p>The links provided on symposiumsepsis22.com’s website serve a mere informational
                                    purpose and under no circumstance imply any suggestion, invitation or
                                    recommendation. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="background: none; border: none"><i class="icon-window-close color-red"></i></button>
                    </div>
                    <div class="modal-body">
                        <form id="change-form">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Email:</label>
                                <input type="text" class="form-control" id="recipient-name" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Nueva contraseña:</label>
                                <input type="password" class="form-control" id="change-pass" name="pass">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Repita nueva contraseña:</label>
                                <input type="password" class="form-control" id="change-pass2">
                            </div>
                            <div id="change-alert"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn bg-red text-white" id="send-change">Cambiar contraseña</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- == main content area ends == -->

    </div>

    <!-- #dtr-wrapper ends -->

    <!-- JS FILES -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script>
    const exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        const modalTitle = exampleModal.querySelector('.modal-title')
        const modalBodyInput = exampleModal.querySelector('.modal-body input')

        modalTitle.textContent = `New message to ${recipient}`
        modalBodyInput.value = recipient
    })
    </script>
</body>

</html>