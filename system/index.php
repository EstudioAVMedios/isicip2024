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
$fila2 = $resultado->fetch( PDO::FETCH_ASSOC );

header( "Cache-Control: no-cache, must-revalidate" ); // HTTP/1.1

header( "Expires: Sat, 1 Jul 2000 05:00:00 GMT" ); // Fecha en el pasado

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>ISICIP</title>
    <meta name="author" content="tansh">
    <meta name="description" content="ISICIP 2023">
    <meta name="keywords" content="Events, medicine">

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
        --bg-color: #2D819C !important;
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

        <!-- preloader ends -->

        <!-- Small Devices Header 

============================================= -->
        <div class="dtr-responsive-header fixed-top ">
            <div class="container">

                <!-- small devices logo -->
                <a href="index.html"><img src="../assets/images/logo-dark.png" width="40%" alt="logo"></a>

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

                    <div class="dtr-header-right">
                        <div class="main-navigation dtr-menu-light">
                            <ul class="sf-menu dtr-scrollspy dtr-nav light-nav-on-load dark-nav-on-scroll sf-js-enabled sf-arrows dtr-menu-light"
                                style="touch-action: pan-y;">
                                <li> <a class="nav-link active2 active px-2 py-1" href="index.php">Home</a> </li>
                                <li> <a class="nav-link px-1 py-1" href="program.php">Program</a> </li>
                                <li> <a class="nav-link px-1 py-1" href="comittees.php">Comittees</a> </li>
                                <li> <a class="nav-link px-1 py-1" href="participants.php">Participants</a> </li>
                                <li> <a class="nav-link px-1 py-1" href="sesiones/sessions.php">Last Edition</a> </li>
                                <li> <a class="nav-link px-1 py-1" href="patrocinio.php">Sponsorship</a> </li>
                                <li> <a class="nav-link px-1 py-1" href="sesiones/directo.php">Streaming</a> </li>
                                <li> <a class="nav-link px-1 py-1" href="contact.php">Contact</a> </li>
                                <li><a class="btn bg-red  text-white mx-3" download='Certificate-ISICIP-2023'
                                        href='../assets/CEERTIFICADOS/certificado%EF%BB%BF<?php echo $fila2['ID']?>.pdf'>
                                        Download Certicate </a></li>
                                <li>
                                    <div class="dropdown">
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

                        <div class="row d-flex align-items-center dtr-pb-100 mt-5">

                            <!-- column 1 starts -->

                            <div class="col-12 col-md-7">

                                <!-- intro text -->

                                <img src="../assets/images/indeximg1.png" class="w-100">
                            </div>
                            <div class="col-12 col-md-5 small-device-space">
                                <div class="bg-white" style="border-radius: 15px; position: relative; ">
                                    <h3 class="text-center p-3 m-3">Welcome <br>
                                        "<?php echo $name ?>"</h3>
                                    <div class="w-100 m-auto text-center mb-5 p-3">

                                        <a class="btn bg-red text-white btn-lg rounded-pill text-center m-auto mb-5"
                                            href="sesiones/directo.php">STREAMING</a>
                                    </div>
                                </div>

                                <!-- img 2 -->

                                <!--=== img slider - 1col ends ===-->

                                <!-- column 2 ends -->

                            </div>

                            <!--===== row 1 ends =====-->

                        </div>
                    </div>
            </section>

            <!-- hero section ends

================================================== -->

            <!-- features section starts

================================================== -->

            <!-- features section ends

================================================== -->

            <section id="services" class="dtr-sticky-tabs-wrapper">

                <!-- wrapping div for top shape image - easy to change color / no need to edit image - refer help doc -->
                <div class="dtr-top-shape-img" style="background-image: url(../assets/images/inner-nav-bg.svg);">

                    <!-- tabs nav ends -->

                    <div data-target=".dtr-scrollspy-tabs">

                        <!-- tab 1 starts -->
                        <section id="tab1" class="dtr-sticky-tabs-section">
                            <div class="dtr-sticky-tabs-content">
                                <div class="container">
                                    <div class="row">

                                        <!-- column 1 starts -->
                                        <div class="col-12 col-md-6"> <img src="../assets/images/service-img1.png"
                                                alt="image"> </div>
                                        <!-- column 1 ends -->

                                        <!-- column 2 starts -->
                                        <div class="col-12 col-md-6 small-device-space">
                                            <!-- Heading -->
                                            <h2>Welcome letter</h2>
                                            <img src="../assets/images/program/welcomedemo.png" class="w-100">
                                            <p><strong style='color:#094341;cursor: pointer' data-bs-toggle="modal"
                                                    data-bs-target="#Modalletter" data-bs-whatever="@getbootstrap">Read
                                                    More...</strong></p>
                                        </div>
                                    </div>
                                    <!-- column 2 ends -->

                                </div>
                            </div>
                    </div>
            </section>

            <!-- sticky tabs starts

================================================== -->

            <!-- top background curve image - easy to change color / no need to edit image - refer help doc -->

            <section id="contact" class="dtr-section dtr-section-with-bg bg-blue color-white mt-5"
                style="background-image: url(../assets/images/white-shape-bg.png);">

                <!-- wrapping div for top shape image - easy to change color / no need to edit image - refer help doc -->

                <div class="dtr-py-100 dtr-top-shape-img"
                    style="background-image: url(../assets/images/contact-section-top.svg);">
                    <div class="container">

                        <!--== row starts ==-->

                        <div class="row">

                            <!-- column 1 starts -->

                            <div class="col-12 col-md-6 p-3">

                                <!-- heading starts -->

                                <div class="dtr-styled-heading">
                                    <h2>Information</h2>
                                    <ul style='list-style: none'>
                                        <li>
                                            <p class="p-2"><strong><img src="../Imagenes/icon/icon_event.png"
                                                        width="35px"></strong> 27<sup>th</sup> International Symposium
                                                on Infections in the Criticaly Ill Patient </p>
                                        </li>
                                        <li class="d-flex">
                                            <p class="px-2 py-1"><strong><img src="../Imagenes/icon/icon_calendar.png"
                                                        width="35px"></strong> 5<sup>th</sup> and 6<sup>th</sup> October
                                                2023 </p>
                                        </li>
                                        <li class="d-flex">
                                            <p class="px-2 py-1"><strong><img src="../Imagenes/icon/icon_countdown.png"
                                                        width="35px"></strong> </p>
                                            <p id="demo" class="bg-white p-2 rounded-pill" style="color:#0A4F86"></p>
                                        </li>
                                        <li>
                                            <p class="p-2"><strong><img src="../Imagenes/icon/icon_location.png"
                                                        width="35px"></strong> Auditori MGS Enteca 325-335 Barcelona,
                                                08029 </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--       <div class="col-12 col-md-6 p-3">
          <div class="dtr-styled-heading">
            <h2 ></h2>
            <ul style='list-style: none'>
              <li class="mt-5">
                <div class="row">
                  <div class="col-12">
                    <div class="row">
                      <div class="col-6 text-center">
                        <div class="bg-white shadow p-2" style="border-radius:15px;color:#0A4F86">VIRTUAL RATE
                          <h4 style="color:#0A4F86" class="mb-1">75€</h4>
                          <p class="p-3 text-left" style="font-size: 12px;line-height: normal">✔︎ Access pass to ISICIP platform which attendees from outside the venue could join a live meeting & symposia or view the on-demand recording later.</p>
                        </div>
                      </div>
                      <div class="col-6 text-center">
                        <div class="bg-white shadow p-2" style="border-radius:15px;color:#0A4F86">ON SITE RATE
                          <h4 style="color:#0A4F86" class="mb-1">255€</h4>
                          <p class="p-3 text-left" style="font-size: 12px;line-height: normal">✔︎ Attendance to roundtables and symposia at Universitary Clinic Hospital<br>
                            ✔︎ Coffee, snacks & lunch<br>
                            ✔︎ Badge.</p>
                        </div>
                      </div>
                      <div class="col-12 text-center mt-3"><a href="https://isicip23.com/form.php" class="btn btn-outline-light rounded-3 w-100" style="border-radius:15px;">Register now</a></div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>

          
        </div>-->

                            <!--== row ends ==-->

                        </div>
                    </div>
            </section>
            <?php include('../footer.php')?>

            <!-- footer section ends

================================================== -->

            <!-----------------------------------MODAL---------------------------------------->

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                style="background: none; border: none"><i
                                    class="icon-window-close color-red"></i></button>
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
                            <button type="button" class="btn bg-red text-white" id="send-change">Cambiar
                                contraseña</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- == main content area ends == -->

    </div>

    <!-- #dtr-wrapper ends -->
    <!--MODAL-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2"><strong style="text-decoration: underline">Privacy
                            Policy</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container p-4">
                        <div>
                            <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Confidentiality and
                                Data Protection</h3>
                            <p>Pursuant to the GDPR, of April 27, 2016, Fundación Código Sepsis informs Users of the
                                existence of an automated file containing personal data, created by, for and under the
                                liability Fundación Código Sepsis for purposes of maintaining and managing relationships
                                with Users and providing information. Upon acceptance of these general terms and
                                conditions, the User will be asked by Fundación Código Sepsis to provide certain data
                                essential for the provision of its services.</p>
                        </div>
                        <div>
                            <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Registration of files
                                and forms</h3>
                            <p>To access and use certain services provided via the Website, it is compulsory to complete
                                a registration form. Failure to provide the personal details required or to accept this
                                data protection policy will result in the User being unable to subscribe to, register
                                for or participate in any promotion for which personal details are requested.<br>
                                Pursuant to the GDPR, of April 27, 2016, we inform you that the personal data provided
                                as a result of User registration will be incorporated into a file owned by [NOMBRE
                                CLIENTE], with C.I.F num. G98775976 and corporate address at C/ DEL JUSTICIA, 1 ENTLO.
                                PUERTA 13, VALENCIA, 46003, VALENCIA , and that the security measures have been
                                implemented. </p>
                        </div>
                        <div>
                            <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Accuracy and
                                truthfulness of data provided</h3>
                            <p>The User accepts full liability for the accuracy and truthfulness of the data provided
                                and exonerates Fundación Código Sepsis from any liability in this regard. The User
                                assures and is answerable in any event for the accuracy, currency and authenticity of
                                the personal data provided and undertakes to keep those data properly updated. The User
                                agrees to provide full and correct information on registration/subscription forms.
                                Fundación Código Sepsis provides no assurances as to the truthfulness of any information
                                not drawn up by the Company itself and identified as coming from other sources and,
                                therefore, assumes no liability for any harm that might be caused by the use of such
                                information. Fundación Código Sepsis provided on its Website and to limit or deny access
                                thereto. Fundación Código Sepsis accepts no liability for any damage or harm that Users
                                may suffer as a result of errors, shortcomings or omissions in information provided by
                                Fundación Código Sepsis provided that it comes from sources other than Fundación Código
                                Sepsis.<br>
                                The site (symposiumsepsis22.com) does not use cookies, considering such physical
                                information files hosted in the user's own terminal and serve to facilitate the user's
                                navigation through the portal. In any case, the user has the possibility of configuring
                                the browser in such a way that it prevents the installation of these files. </p>
                        </div>
                        <div>
                            <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Purposes</h3>
                            <p>The purposes of Fundación Código Sepsis are to maintain and manage relationships with its
                                Users and to provide information.</p>
                        </div>
                        <div>
                            <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Assignment of data to
                                third parties</h3>
                            <p>Fundación Código Sepsis undertakes not to assign data on Users to third parties.</p>
                        </div>
                        <div>
                            <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Exercise of rights of
                                access, rectification, cancellation and opposition</h3>
                            <p>You may send any communications and exercise the rights of access, rectification,
                                erasure, restriction, portability and opposition to the email address
                                eventos03@cerotreseventos.es or by regular mail to Fundación Código Sepsis Ref. GDPR, at
                                C/ DEL JUSTICIA, 1 ENTLO. PUERTA 13, VALENCIA, 46003, VALENCIA. In order to exercise
                                these rights, it is necessary for you to verify your identity before Fundación Código
                                Sepsis by sending a photocopy of your Spanish National identity Document or any other
                                legally valid means. However, you may modify or rectify your registration data on the
                                Website itself after you identify yourself with your username and password. </p>
                        </div>
                        <div>
                            <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Security measures</h3>
                            <p>Fundación Código Sepsis has implemented the standards of security for the protection of
                                personal data required by law and makes every attempt to install such further technical
                                means and measures as may be available to it to prevent loss of, misuse of, manipulation
                                of, unauthorized access to and theft of the personal data provided to Fundación Código
                                Sepsis accepts no liability for any damage or harm that might result from interference,
                                omissions, interruptions, computer viruses, telephone malfunctions or disconnections in
                                the course of the operation of this electronic system for reasons not attributable to
                                Fundación Código Sepsis; or delays or blockages in the use of this electronic system
                                caused by shortcomings or overloads in telephone lines or overloads at data processing
                                centers, on the Internet or in other electronic systems; or for any damage that may be
                                caused by third parties as a result of unlawful interference beyond the control of
                                Fundación Código Sepsis. Notwithstanding the foregoing, Users should be aware that
                                Internet security measures are not infallible. </p>
                        </div>
                        <div>
                            <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Acceptance and consent
                            </h3>
                            <p>The User declares that he/she has been informed of the terms and conditions governing the
                                protection of personal data and hereby accepts and consents to the automatic processing
                                of such data by Fundación Código Sepsis in the way and for the purposes indicated in
                                this Personal Data Protection Policy. Some services provided via the portal may entail
                                particular terms and conditions with specific provisions in regard to Personal Data
                                protection.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
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
                                portal service symposiumsepsis22.com (hereinafter, the “Website”) of Fundación Código
                                Sepsis, with corporate address at C/ DEL JUSTICIA, 1 ENTLO. PUERTA 13, VALENCIA, 46003,
                                VALENCIA and C.I.F G98775976</p>
                        </div>
                        <div>
                            <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Legislation</h3>
                            <p>The relationship between Fundación Código Sepsis and the Users of its remote services on
                                the Website is subject, in general, to the legislation and jurisdiction of Spain. <br>
                                The parties expressly waive any other jurisdictional rights and submit expressly to the
                                rulings of the courts and tribunals of Valencia for the settlement of any dispute that
                                may arise in the construal or enforcement of these terms and conditions. </p>
                        </div>
                        <div>
                            <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Intellectual and
                                industrial property</h3>
                            <p>Fundación Código Sepsis is the owner of the intellectual property rights of its website’s
                                content, graphic design and codes; therefore, its reproduction, distribution, public
                                communication, transformation or any other activity performed with the webpage’s content
                                is prohibited (even if the sources were mentioned), unless written consent is given by
                                Fundación Código Sepsis. All the commercial names, trademarks and distinctive signs of
                                any kind contained on the Company’s website are the property of its owners and protected
                                by law. </p>
                        </div>
                        <div>
                            <h3 style="background: var(--bg-color);color:white" class="w-100 p-2">Links</h3>
                            <p>The links provided on symposiumsepsis22.com ’s website serve a mere informational purpose
                                and under no circumstance imply any suggestion, invitation or recommendation. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Modalletter" tabindex="-1" aria-labelledby="ModalLabelletter" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabelletter">Welcome Letter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style='width: 100%'><img src='../assets/images/program/welcome.png' class="w-100"> </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- JS FILES -->
    <!----------------------------------MODAL-------------------------------------------->
    <div class="modal fade" id="exampleModal7" tabindex="-1" aria-labelledby="exampleModalLabel7" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel7">Alert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="width: 100%;"><img src="../assets/images/mail/header.png" width="100%"></div>
                    <div style="width: 100%;"><img src="../Imagenes/POPUPwebinar.png" width="100%"></div>
                    <div></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script>
    // Set the date we're counting down to
    var countDownDate = new Date("Oct 5, 2023 08:30:00").getTime();

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