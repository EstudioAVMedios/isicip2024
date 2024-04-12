<?php

error_reporting(0);
if ($_GET['pass'] == true) {
    $pass = true;
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>ISICIP 2024</title>


    <meta name="author" content="tansh">
    <meta name="description" content="27th International Symposium on Infections in the Criticaly Ill Patient">
    <meta name="keywords" content="ISICIP 2024, isicip, ISICIP, isicip 24, isicip 2024, Congreso, medicine">

    <!-- FAVICON FILES -->

    <link href="assets/images/icons/apple-touch-icon-144-precomposed.png" rel="apple-touch-icon" sizes="144x144">
    <link href="assets/images/icons/apple-touch-icon-120-precomposed.png" rel="apple-touch-icon" sizes="120x120">
    <link href="assets/images/icons/apple-touch-icon-76-precomposed.png" rel="apple-touch-icon" sizes="76x76">
    <link href="assets/images/icons/favicon.png" rel="shortcut icon">

    <!-- CSS FILES -->

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/iconfonts.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/color.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<body>
    <?php

    $ip = $_SERVER['REMOTE_ADDR'];
    $dataArray = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip), true);
    $country = $dataArray["geoplugin_countryName"];
    ?>
    <a class="ir-arriba" javascript:void(0)="" title="Volver arriba" style="display: none;"> <span class="fa-stack"> <i class="icon-arrow-up"></i> </span> </a>
    <div id="dtr-wrapper" class="clearfix">

        <div class="dtr-responsive-header fixed-top ">
            <div class="container"> <a href="index.html"><img src="assets/images/logo-dark.png" alt="logo"></a>

                <button id="dtr-menu-button" class="dtr-hamburger " type="button"><span class="dtr-hamburger-lines-wrapper"><span class="dtr-hamburger-lines"></span></span></button>
            </div>
            <div class="dtr-responsive-header-menu"></div>
        </div>
        <header id="dtr-header-global" class="fixed-top trans-header">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="dtr-header-left">
                        <a class="logo-default dtr-scroll-link" href="#home"><img src="assets/images/logo-light.png" alt="logo"></a> <a class="logo-alt dtr-scroll-link" href="#home"><img src="assets/images/logo-dark.png" alt="logo"></a>

                    </div>
                    <div class="dtr-header-right ml-auto">
                        <div class="main-navigation dtr-menu-light">
                            <ul class="sf-menu dtr-scrollspy dtr-nav light-nav-on-load dark-nav-on-scroll sf-js-enabled sf-arrows dtr-menu-light" style="touch-action: pan-y;">
                                <li> <a class="nav-link active2 px-3 py-1" href="index.php">Home</a> </li>
                                <li> <a class="nav-link px-3 py-1" href="assets/archivos/Programa2024.pdf" target="_blank">Program</a> </li>
                                <li> <a class="nav-link px-3 py-1 " href="#speakers">Ponentes</a> </li>
                                <li> <a class="nav-link px-3 py-1" href="abstract.php">Submit a Poster</a> </li>
                                <li> <a class="nav-link px-3 active2 py-1 border-white intermitente" href="#services" style="border:1px solid white">Register now!</a> </li>
                                <li> <a class="nav-link px-3 py-1" href="login/">Personal Area</a> </li>
                                <li> <a class="nav-link px-3 py-1" href="#dtr-footer">Contact</a> </li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </header>
    </div>
    <div id="dtr-main-content">
        <section id="home" class="dtr-section dtr-section-with-bg dtr-hero-section-top-padding bg-blue" style="background-image: url(assets/images/white-shape-bg.png);background-position: top">
            <?php if ($_GET['key']) {
                echo "<div class='bg-red text-white text-center p-4' style='z-index: 10001'> Sorry! We have detected more than one open session, we remind you that registrations are personal.</div>";
            } ?>
            <?php
            if ($_GET['success_payment'] == "true") {
                echo "<div class='bg-success text-white text-center p-4' style='z-index: 10001'> Congratulations! Your payment process has been completed successfully</div>";
            } else if ($_GET['failed_payment'] == "true") {
                echo "<div class='bg-red text-white text-center p-4' style='z-index: 10001'> Lo sentimos! ha habido un fallo en el proceso de pago, inténtelo de nuevo en unos minutos y si el problema persiste póngase en contacto con nosotros.</div>";
            } else if ($_GET['pay'] == "success_payment") {
                echo "<div class='bg-red text-white text-center p-4' style='z-index: 10001'> Uppps! parece que ha cancelado el proceso de pago, vuelva a iniciarlo desde el enlace en el correo de confirmación de registro.</div>";
            }

            ?>
            <div class="dtr-bottom-shape-img">
                <div class="container">
                    <div class="row d-flex align-items-center dtr-pb-100 mt-5">
                        <div class="col-12 col-md-12 text-center">
                            <img src="assets/images/indeximg1.png" class="w-75 mb-5">
                        </div>
                    </div>
                </div>
        </section>
        <!---/ INFORMATION /--->
        <section id="information"></section>
        <!---/ WELCOME LETTER /--->
        <section id="letter"></section>
        <!---/ SPEAKERS /--->
        <section id="speakers"></section>
        <!---/ FOOTER /--->
        <section id="footer"></section>
        <!---/ MODALS /--->
        <section id="modals"></section>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="assets/js/custom.js"></script>

    <script>
        new WOW().init();
        $('#information').load('assets/layouts/information.php');
        $('#speakers').load('assets/layouts/speakers.php');
        $('#footer').load('assets/layouts/footer.php');
        $('#letter').load('assets/layouts/letter.php');
        $('#modals').load('assets/layouts/modals.php');
        // Set the date we're counting down to
        var countDownDate = new Date("Nov 7, 2024 08:30:00").getTime();
        // Update the count down every 1 second
        var x = setInterval(function() {
            // Get today's date and time
            var now = new Date().getTime();
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
</body>

</html>