<?php

session_start();
if (!empty($_SESSION['user_evento_id'])) {
    include("../assets/php/config.php");
    include '../dashboard/stripe/dbConnect.php';
    date_default_timezone_set("Europe/Madrid");

    $id = $_SESSION['user_evento_id']['ID'];


    $sql = "SELECT * FROM evento";
    $resultado = $cnt->prepare($sql);
    $resultado->execute();
    $evento = $resultado->fetch(PDO::FETCH_ASSOC);
    $sql = "SELECT * FROM video ORDER BY CONTENT ASC";
    $resultado = $cnt->prepare($sql);
    $resultado->execute();
    while ($video = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $videos[] = $video;
    }
    $titulosTecno = [];
    $titulosSepsis = [];
    foreach ($videos as $video) {
        if ($video['event'] == 'tecnosepsis') {
            if (!in_array($video['CONTENT'],  $titulosTecno)) {
                array_push($titulosTecno, $video['CONTENT']);
            }
        }
        if ($video['event'] == 'encuentro') {
            if (!in_array($video['CONTENT'],  $titulosSepsis)) {
                array_push($titulosSepsis, $video['CONTENT']);
            }
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../dashboard/css/icon/iconfonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
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
            font-size: 40px;
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

        .nav-link {
            font-size: 15px !important;
            font-family: "Nunito", sans-serif;
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
                <header class="header-main-con">


                    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="./index.php"><img src="../dashboard/Imagenes/logo-dark.png" alt="logo-img" class="img-fluid" style="height:70px;"></a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse ms-auto navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                    <a class="nav-link" style="color:<?php echo $evento['COLOR'] ?>;font-weight:300" href="./">Personal Area </a>
                                    <li class="nav-item mx-3">
                                        <a class="nav-link" style="color:<?php echo $evento['COLOR'] ?>;font-weight:600" href="video.php">Previous sessions</a>
                                    </li>
                                    <!-- <li class="nav-item mx-3">
                                        <a class="nav-link <?php if ($total != 0) : echo "disabled";
                                                            endif; ?>" style="color:<?php echo $evento['COLOR'] ?>;font-weight:300" href="../dashboard/directo/">Streaming</a>
                                    </li> -->
                                    <li class="nav-item mx-3">
                                        <a class="nav-link" style="color:<?php echo $evento['COLOR'] ?>;font-weight:300" href="../dashboard/php/personal/end.php">Logout</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </nav>

                </header>
                <section class="banner-main-con " style="height:250px">

                    <div class="container" style="padding-top:150px;">

                        <div class="banner-con text-center position-relative " style="z-index:3">
                            <h1 class="text-white">Previous sessions<br></h1>

                        </div>

                        <!--banner-end-->

                    </div>
                    <div class="footer--overlay" style="background-image:url(../dashboard/Imagenes/fondo.png)"></div>
                </section>
            </div>
        </div>
    </section>
    <section>
        <article class="bg-white p-3 article-event sticky-top">
            <div class="container">
                <ul class="nav nav-pills " id="pills-tab" role="tablist">
                    <li class="nav-item w-50 rounded-0 p-2" role="presentation">
                        <button class="nav-link border p-4 w-100  rounded-0 text-muted active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Encuentros Código Sepsis (2024 / 2023)
                        </button>
                    </li>
                    <li class="nav-item w-50  rounded-0 p-2" role="presentation">
                        <button class="nav-link border p-4  w-100 rounded-0 text-muted" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Tecnosepsis (2024 / 2022)</button>
                    </li>

                </ul>
            </div>
        </article>
        <article class="container my-5">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                    <article class="bg-white p-3 article-event sticky-top">
                        <div class="container">
                            <ul class="nav nav-pills " id="pills-tab" role="tablist">
                                <li class="nav-item w-50 rounded-0 p-2" role="presentation">
                                    <button class="nav-link border p-4 w-100  rounded-0 text-muted active" id="pills-year1-tab" data-bs-toggle="pill" data-bs-target="#pills-year1" type="button" role="tab" aria-controls="pills-year1" aria-selected="true">7º
                                        Encuentros Código Sepsis 2024
                                    </button>
                                </li>
                                <li class="nav-item w-50  rounded-0 p-2" role="presentation">
                                    <button class="nav-link border p-4  w-100 rounded-0 text-muted" id="pills-year2-tab" data-bs-toggle="pill" data-bs-target="#pills-year2" type="button" role="tab" aria-controls="pills-year2" aria-selected="false">6º Encuentros Código Sepsis
                                        2023</button>
                                </li>

                            </ul>
                        </div>
                    </article>
                    <article class="container my-5">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-year1" role="tabpanel" aria-labelledby="pills-year1-tab" tabindex="0">
                                <div class="row">
                                    <?php
                                    foreach ($titulosSepsis as $titulo) :
                                        $titles = [];

                                        if (substr($titulo, strlen($titulo) - 4, strlen($titulo)) == '2024') :
                                    ?>
                                            <h3 class="my-5"><?php echo $titulo; ?></h3>
                                            <?php
                                            foreach ($videos as $video) :



                                                if (!in_array($video['TITLE'],  $titles)) :
                                                    array_push($titles, $video['TITLE']);


                                                    if ($video['CONTENT'] == $titulo) :
                                            ?>
                                                        <div class="card shadow-sm rounded-0 m-2 p-0" style="width: 18rem;">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?php echo $video['TITLE'] ?></h5>
                                                                <?php foreach ($videos as $speaker) : if ($speaker['TITLE'] == $video['TITLE']) : ?>
                                                                        <p class="card-subtitle  text-body-secondary">
                                                                            <?php echo $speaker['SPEAKER'] ?></p>
                                                                <?php endif;
                                                                endforeach; ?>

                                                            </div>

                                                            <div class="card-footer bg-white p-0">
                                                                <p class=" text-center card-subtitle text-body-secondary px-3 py-2">
                                                                    <strong>Time: </strong>
                                                                    <?php echo $video['HDURATION'] ?>H :<?php echo $video['MDURATION'] ?> M
                                                                </p>
                                                            </div>
                                                            <a href="./reproducir/?video=<?php echo $video['TITLE'] ?>" class="card-link">
                                                                <div class="card-footer text-center"> Play
                                                                    Video</div>
                                                            </a>
                                                        </div>
                                    <?php
                                                    endif;
                                                endif;

                                            endforeach;
                                        endif;
                                    endforeach;
                                    ?>

                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="pills-year2" role="tabpanel" aria-labelledby="pills-year2-tab" tabindex="0">
                                <div class="row">
                                    <?php
                                    foreach ($titulosSepsis as $titulo) :
                                        $titles = [];

                                        if (substr($titulo, strlen($titulo) - 4, strlen($titulo)) == '2023') :
                                    ?>
                                            <h3 class="my-5"><?php echo $titulo; ?></h3>
                                            <?php
                                            foreach ($videos as $video) :



                                                if (!in_array($video['TITLE'],  $titles)) :
                                                    array_push($titles, $video['TITLE']);


                                                    if ($video['CONTENT'] == $titulo) :
                                            ?>
                                                        <div class="card shadow-sm rounded-0 m-2 p-0" style="width: 18rem;">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?php echo $video['TITLE'] ?></h5>
                                                                <?php foreach ($videos as $speaker) : if ($speaker['TITLE'] == $video['TITLE']) : ?>
                                                                        <p class="card-subtitle  text-body-secondary">
                                                                            <?php echo $speaker['SPEAKER'] ?></p>
                                                                <?php endif;
                                                                endforeach; ?>

                                                            </div>

                                                            <div class="card-footer bg-white p-0">
                                                                <p class=" text-center card-subtitle text-body-secondary px-3 py-2">
                                                                    <strong>Time: </strong>
                                                                    <?php echo $video['HDURATION'] ?>H :<?php echo $video['MDURATION'] ?> M
                                                                </p>
                                                            </div>
                                                            <a href="./reproducir/?video=<?php echo $video['TITLE'] ?>" class="card-link">
                                                                <div class="card-footer text-center"> Play
                                                                    Video</div>
                                                            </a>
                                                        </div>
                                    <?php
                                                    endif;
                                                endif;

                                            endforeach;
                                        endif;
                                    endforeach;
                                    ?>

                                </div>
                            </div>


                        </div>
                    </article>
                </div>
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                    <article class="bg-white p-3 article-event sticky-top">
                        <div class="container">
                            <ul class="nav nav-pills " id="pills-tab" role="tablist">
                                <li class="nav-item w-50 rounded-0 p-2" role="presentation">
                                    <button class="nav-link border p-4 w-100  rounded-0 text-muted active" id="pills-year3-tab" data-bs-toggle="pill" data-bs-target="#pills-year3" type="button" role="tab" aria-controls="pills-year3" aria-selected="true">Tecnosepsis 2024
                                    </button>
                                </li>
                                <li class="nav-item w-50  rounded-0 p-2" role="presentation">
                                    <button class="nav-link border p-4  w-100 rounded-0 text-muted" id="pills-year4-tab" data-bs-toggle="pill" data-bs-target="#pills-year4" type="button" role="tab" aria-controls="pills-year4" aria-selected="false">Tecnosepsis 2022</button>
                                </li>

                            </ul>
                        </div>
                    </article>
                    <article class="container my-5">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-year3" role="tabpanel" aria-labelledby="pills-year3-tab" tabindex="0">
                                <div class="row">
                                    <?php
                                    foreach ($titulosTecno as $titulo) :
                                        $titles = [];

                                        if (substr($titulo, strlen($titulo) - 4, strlen($titulo)) == '2024') :
                                    ?>
                                            <h3 class="my-5"><?php echo $titulo; ?></h3>
                                            <?php
                                            foreach ($videos as $video) :



                                                if (!in_array($video['TITLE'],  $titles)) :
                                                    array_push($titles, $video['TITLE']);


                                                    if ($video['CONTENT'] == $titulo) :
                                            ?>
                                                        <div class="card shadow-sm rounded-0 m-2 p-0 wow fadInUp" style="width: 18rem;">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?php echo $video['TITLE'] ?></h5>
                                                                <?php foreach ($videos as $speaker) : if ($speaker['TITLE'] == $video['TITLE']) : ?>
                                                                        <p class="card-subtitle  text-body-secondary">
                                                                            <?php echo $speaker['SPEAKER'] ?></p>
                                                                <?php endif;
                                                                endforeach; ?>

                                                            </div>

                                                            <div class="card-footer bg-white p-0 wow fadInUp">
                                                                <p class=" text-center card-subtitle text-body-secondary px-3 py-2">
                                                                    <strong>Time: </strong>
                                                                    <?php echo $video['HDURATION'] ?>H :<?php echo $video['MDURATION'] ?> M
                                                                </p>
                                                            </div>
                                                            <a href="./reproducir/?video=<?php echo $video['TITLE'] ?>" class="card-link">
                                                                <div class="card-footer text-center"> Play
                                                                    Video</div>
                                                            </a>
                                                        </div>
                                    <?php
                                                    endif;
                                                endif;

                                            endforeach;
                                        endif;
                                    endforeach;
                                    ?>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-year4" role="tabpanel" aria-labelledby="pills-year4-tab" tabindex="0">
                                <div class="row">
                                    <?php
                                    foreach ($titulosTecno as $titulo) :
                                        $titles = [];

                                        if (substr($titulo, strlen($titulo) - 4, strlen($titulo)) == '2022') :
                                    ?>
                                            <h3 class="my-5"><?php echo $titulo; ?></h3>
                                            <?php
                                            foreach ($videos as $video) :



                                                if (!in_array($video['TITLE'],  $titles)) :
                                                    array_push($titles, $video['TITLE']);


                                                    if ($video['CONTENT'] == $titulo) :
                                            ?>
                                                        <div class="card shadow-sm rounded-0 m-2 p-0 wow fadInUp" style="width: 18rem;">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?php echo $video['TITLE'] ?></h5>
                                                                <?php foreach ($videos as $speaker) : if ($speaker['TITLE'] == $video['TITLE']) : ?>
                                                                        <p class="card-subtitle  text-body-secondary">
                                                                            <?php echo $speaker['SPEAKER'] ?></p>
                                                                <?php endif;
                                                                endforeach; ?>

                                                            </div>

                                                            <div class="card-footer bg-white p-0 wow fadInUp">
                                                                <p class=" text-center card-subtitle text-body-secondary px-3 py-2">
                                                                    <strong>Time: </strong>
                                                                    <?php echo $video['HDURATION'] ?>H :<?php echo $video['MDURATION'] ?> M
                                                                </p>
                                                            </div>
                                                            <a href="./reproducir/?video=<?php echo $video['TITLE'] ?>" class="card-link">
                                                                <div class="card-footer text-center"> Play
                                                                    Video</div>
                                                            </a>
                                                        </div>
                                    <?php
                                                    endif;
                                                endif;

                                            endforeach;
                                        endif;
                                    endforeach;
                                    ?>

                                </div>
                            </div>
                        </div>
                    </article>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
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