<?php

session_start();
if (!empty($_SESSION['user_evento_id'])) {
    include("../../assets/php/config.php");
    include '../../dashboard/stripe/dbConnect.php';
    date_default_timezone_set("Europe/Madrid");

    $id = $_SESSION['user_evento_id']['ID'];
    $title = $_GET['video'];

    $sql = "SELECT * FROM evento";
    $resultado = $cnt->prepare($sql);
    $resultado->execute();

    $evento = $resultado->fetch(PDO::FETCH_ASSOC);
    $sql = "SELECT * FROM video WHERE TITLE=:title";
    $resultado = $cnt->prepare($sql);
    $resultado->execute(array(":title" => $title));
    while ($video = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $videos[] = $video;
    }
} else {

    header("location:../../login/");
}


?>

<!DOCTYPE html>

<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/x-icon" href="../assets/image/favicon.png">
    <link rel="stylesheet" href="../../dashboard/css/registros/animate.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../dashboard/css/registros/style.css">
    <link rel="stylesheet" href="../../dashboard/css/icon/iconfonts.css">
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
            font-size: 30px;
            letter-spacing: -0.01em;
            line-height: 1.2;
            color: <?php echo $evento['COLOR'] ?>;
        }

        body {
            background: #e8f6ff
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
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

    <!---header-and-banner-section-->
    <?php echo $id2 ?>
    <section>
        <div class="header-and-banner-con w-100 generic-banner-con" style="position: relative">
            <div class="header-and-banner-inner-con" style="background-image:url(../../dashboard/Imagenes/fondo.png)">
                <header class="header-main-con">


                    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="./index.php"><img src="../../dashboard/Imagenes/logo-dark.png" alt="logo-img" class="img-fluid" style="height:70px;"></a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse ms-auto navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                                    <li class="nav-item mx-3">
                                        <a class="nav-link" style="color:<?php echo $evento['COLOR'] ?>;font-weight:300" href="../video.php">Go back / Regresar</a>
                                    </li>
                                    <li class="nav-item mx-3">
                                        <a class="nav-link" style="color:<?php echo $evento['COLOR'] ?>;font-weight:300" href="../dashboard/php/personal/end.php">Logout / Salir</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </nav>

                </header>

            </div>
        </div>
    </section>
    <section class="mt-5">
        <article class="mt-5">
            <div class="container p-5 position-relative" style="margin-top: 100px;">
                <iframe src="<?php echo $videos[0]['URL'] ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" style="width:100%;height:72vh;"></iframe>
                <h3 class="p-2 mb-1"><?php echo $title ?></h3>
                <div class="d-flex">
                    <?php foreach ($videos as $video) : ?>
                        <p>| <strong><?php echo $video['SPEAKER'] ?> </strong></p>&nbsp;
                    <?php endforeach; ?>
                </div>
            </div>
        </article>

    </section>



    <!-- blog section -->

    <!-- weight footer section -->
    <script src="../dashboard/js/registros/jquery-1.12.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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