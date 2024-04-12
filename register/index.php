<?php
include('../assets/php/config.php');
session_start();

if (!empty($_GET['cuota'])) :
    $codigo = substr(base64_decode($_GET['cuota']), 0, 1);
    $paises = [];
    $habitaciones = [];
    $campos = [];

    $sql = "SELECT * FROM cuotas WHERE ID=$codigo";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute();
    $fila = $respuesta->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM pagos";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute();
    $pagos = $respuesta->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM codes WHERE ID=:id";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute(array(":id" => $codigo));
    $fila6 = $respuesta->fetch(PDO::FETCH_ASSOC);
    $code = $fila6['CODE'];



    $sql = "SELECT * FROM cuotas WHERE TIPO='ACOMPA' AND VISIBILIDAD=1";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute();
    while ($fila4 = $respuesta->fetch(PDO::FETCH_ASSOC)) {
        $cuotas[] = $fila4;
    }


    $sql = "SELECT * FROM generales_form";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute();
    $fila5 = $respuesta->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM evento";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute();
    $evento = $respuesta->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM habitaciones";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute();
    while ($fila3 = $respuesta->fetch(PDO::FETCH_ASSOC)) {
        $habitaciones[] = $fila3;
    }

    $sql = "SELECT * FROM all_campos2";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute();
    while ($fila3 = $respuesta->fetch(PDO::FETCH_ASSOC)) {
        if ($fila3['ESTADO'] != 0) {
            $campos[] = $fila3;
        }
    }

    $sql = "SELECT * FROM pais";
    $respuesta = $cnt->prepare($sql);
    $respuesta->execute();
    while ($fila2 = $respuesta->fetch(PDO::FETCH_ASSOC)) {
        $paises[] = $fila2;
    }
else :
    header('location:inscripciones.php');
endif;


?>

<!DOCTYPE html>

<html lang="en">

<head>

    <!-- ========== Meta Tags ========== -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Digilab - SEO & Digital Marketing Agency Template">

    <!-- ========== Page Title ========== -->

    <title>ISICIP 2024</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="This event promises to be an extraordinary blend of cutting-edge lectures, esteemed speakers, and invaluable insights into the latest critical care medicine advancements, particularly on sepsis and infections.
This conference aims to redefine the conventional approach to medical gatherings by seamlessly intertwining top-tier scientific discussions with Barcelona's unmatched beauty and charm" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="ISICIP 2024" />
    <meta property="og:description"
        content="This event promises to be an extraordinary blend of cutting-edge lectures, esteemed speakers, and invaluable insights into the latest critical care medicine advancements, particularly on sepsis and infections.
This conference aims to redefine the conventional approach to medical gatherings by seamlessly intertwining top-tier scientific discussions with Barcelona's unmatched beauty and charm" />
    <meta property="og:image" content="https://isicip2024.com/assets/images/indeximg1.png" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:url" content="https://isicip.com/register/" />
    <meta name="keywords" content="isicip, isicip 2024, medical congress, fundacion codigo sepsis">

    <!-- ========== Favicon Icon ========== -->

    <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->

    <link href="../dashboard/css/registros/bootstrap.min.css" rel="stylesheet" />
    <link href="../dashboard/css/registros/font-awesome.min.css" rel="stylesheet" />
    <link href="../dashboard/css/registros/themify-icons.css" rel="stylesheet" />
    <link href="../dashboard/css/registros/flaticon-set.css" rel="stylesheet" />
    <link href="../dashboard/css/registros/magnific-popup.css" rel="stylesheet" />
    <link href="../dashboard/css/registros/owl.carousel.min.css" rel="stylesheet" />
    <link href="../dashboard/css/registros/owl.theme.default.min.css" rel="stylesheet" />
    <link href="../dashboard/css/registros/animate.css" rel="stylesheet" />
    <link href="../dashboard/css/registros/bootsnav.css" rel="stylesheet" />
    <link href="../dashboard/css/registros/style.css" rel="stylesheet">
    <link href="../dashboard/css/registros/responsive.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
    * {
        font-family: "Poppins", sans-serif;
    }
    </style>
</head>

<body
    style="background:#fff; background-image:url(../dashboard/Imagenes/fondo.png); background-size:cover;background-attachment:fixed">

    <!-- Start Register 

    ============================================= -->

    <div class="login-area mt-5">
        <div style='width: 98%;margin: auto'>
            <div class="row">
                <div class="col-lg-4 col-md-8 col-sm-12" style="margin-top:20px; z-index: 99;">
                    <div class="content p-0 carrito1"
                        style='position: fixed;width: 40px; height: 40px;  left:10px; display: none;cursor: pointer'>
                        <div class="col-12 text-left p-0" style="font-size: 25px;color:<?php echo $evento['COLOR'] ?>">
                            <i class="fas fa-shopping-cart" style="padding: 6px;"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-12" style="margin-top:100px; z-index: 99;">
                    <div class="content carrito" style='position: fixed;width: 32%; left: 10px;transition: all 0.5s'>
                        <div class="row">
                            <div class="col-12 text-left mb-4"
                                style="font-size: 25px;color:<?php echo $evento['COLOR'] ?>"><i
                                    class="fas fa-shopping-cart"></i> Resume</div>
                            <div class="col-8 border-bottom">
                                <p style="line-height: normal;font-size: 12px;text-align: left">
                                    <?php echo $fila['NAME'] ?><br><?php if ($fila['PRECIO'] == 0) :
                                                                        echo substr(base64_decode($_GET['cuota']), 2);
                                                                    endif; ?></p>
                            </div>
                            <div class="col-4 border-bottom">
                                <p style="text-align:right"><strong><?php echo $fila['PRECIO'] ?>€</strong></p>
                            </div>
                            <div class="col-12" id="piloto_acompa" style="display: none">
                                <div class="row">
                                    <div class="col-8 border-bottom">
                                        <p style="font-size: 12px;text-align: left">Companion</p>
                                    </div>
                                    <div class="col-4 border-bottom">
                                        <p style="text-align:right"><strong id="precio_acompa">0.00€</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" id="piloto_hotel" style="display: none">
                                <div class="row">
                                    <div class="col-8 border-bottom">
                                        <p style="font-size: 12px;text-align: left">Nights x <span
                                                id="noches_no">0</span></p>
                                    </div>
                                    <div class="col-4 border-bottom">
                                        <p style="text-align:right"><strong id="precio_hab">0.00€</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 border-bottom">
                                <p class="text-left">TOTAL</p>
                            </div>
                            <div class="col-4 border-bottom">
                                <p style="text-align:right"><strong id="total_compra">0.00€</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 ml-auto">
                    <div class="login-box pt-0">
                        <div class="login">
                            <form action="#" id="formulario">
                                <div class="content" id="datos_p">
                                    <div class="row">
                                        <div class="col-6"> <a href="/"><img src="../dashboard/Imagenes/logo-dark.png"
                                                    alt="Logo"></a> </div>
                                        <div class="col-6"> <a class="btn-simple2 "
                                                style="background:<?php echo $evento['COLOR'] ?>" href="/"><img
                                                    src="../dashboard/Imagenes/arrow.png" width="15px"
                                                    class="mb-1 me-2">
                                                Go back</a> </div>
                                    </div>
                                    <div class=" row">
                                        <?php if ($fila['PRECIO'] != 0) : ?>
                                        <div class="col-12">

                                            <h3>Do you have a code?
                                            </h3>
                                            <!-- <p class="mb-0">Si desea optar por un descuento del 100% debe ponerse en
                                                contacto con un
                                                delegado de VIATRIS.</p>
                                            <p class="mb-0">If you wnat a 100% descount, you must get in touch with a
                                                VIATRIS
                                                representative.</p> -->
                                            <div class="row mb-5 mt-3">
                                                <div class='col-lg-6 col-sm-12 mb-3'>
                                                    <button type='button' class="code_btn w-75 m-auto">Yes</button>
                                                </div>
                                                <div class='col-lg-6 col-sm-12 mb-3'>
                                                    <button type='button'
                                                        class="code_btn code_btn_select w-75 m-auto">No</button>
                                                </div>
                                            </div>
                                            <div class="form-group" id="input_code" style="display:none">
                                                <input class="form-control" placeholder="Code" type="text"
                                                    name="descuento">
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-lg-12 col-md-12 my-3">
                                            <h2><?php echo $fila['NAME'] ?> <span
                                                    style="color:<?php echo $evento['COLOR'] ?>">
                                                    <strong>
                                                        <?php echo $fila['PRECIO'] ?>€</strong>
                                                </span><br>
                                                <?php if ($fila['PRECIO'] == 0) :
                                                    echo substr(base64_decode($_GET['cuota']), 2);
                                                endif; ?>
                                            </h2>

                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-5">
                                            <?php if ($fila['PRECIO'] == 0) : ?>
                                            <h4 class="text-uppercase">Select Options
                                            </h4>
                                            <div class="col-lg-6 col-md-12 mx-auto mb-4">
                                                <div class="form-group">
                                                    <select class="select rounded mt-2" id="categoria" name="categoria"
                                                        <?php echo $elemento['PRIORIDAD'] ?>>
                                                        <option value=''>Choose your registration</option>
                                                        <option value="Asistente presencial">In-person
                                                            registration.
                                                        </option>
                                                        <option value="Asistente Virtual">Virtual
                                                            registration.
                                                        </option>


                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 mx-auto my-5">
                                                <div class="form-group">
                                                    <label>Send an Incription copy to my agency.</label>
                                                    <input class="form-control" placeholder="Agency email" type="email"
                                                        name="AGENCIA_EMAIL">
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <h4 class="text-uppercase">Included
                                            </h4>
                                            <div class="includes"> <?php echo $fila['INCLUDES'] ?></div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <h4 class="text-uppercase">Personal Information</h4>
                                        </div>
                                        <?php
                                        foreach ($campos as $elemento) :
                                            if ($elemento['TIPO'] == "USUARIO") :
                                                if (
                                                    $elemento['CAMPO'] != "PAIS"
                                                    and $elemento['CAMPO'] != "TITULO"
                                                    and $elemento['CAMPO'] != "TIPO_CENTRO"
                                                    and $elemento['CAMPO'] != "PASS"
                                                    and $elemento['CAMPO'] != "PATROCINADOR"
                                                    and $elemento['CAMPO'] != "EMAIL_PATROCINADOR"
                                                ) : ?>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <input class="form-control"
                                                    placeholder="<?php echo $elemento['PLACEHOLDER'] ?>" type="text"
                                                    name="<?php echo $elemento['CAMPO'] ?>"
                                                    <?php echo $elemento['PRIORIDAD'] ?>>
                                            </div>
                                        </div>
                                        <?php
                                                elseif ($elemento['CAMPO'] == "PASS") : ?>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <input class="form-control"
                                                    placeholder="<?php echo $elemento['PLACEHOLDER'] ?>" type="password"
                                                    name="<?php echo $elemento['CAMPO'] ?>"
                                                    <?php echo $elemento['PRIORIDAD'] ?>>
                                            </div>
                                        </div>
                                        <?php
                                                elseif ($elemento['CAMPO'] == "TITULO") : ?>
                                        <div class="col-lg-6 col-md-12 mt-2" <?php echo $elemento['PRIORIDAD'] ?>>
                                            <div class="form-group">
                                                <select class="select rounded" name="<?php echo $elemento['CAMPO'] ?>"
                                                    <?php echo $elemento['PRIORIDAD'] ?>>
                                                    <option value='0'> Título</option>
                                                    <option value='Sr.'>Sr</option>
                                                    <option value='Sra.'>Sra</option>
                                                    <option value='Dr.'>Dr</option>
                                                    <option value='Dra.'>Dra</option>
                                                    <option value='Prof.'>Prof</option>
                                                    <option value='Prof.ª'>Prof.ª</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                                elseif ($elemento['CAMPO'] == "PAIS") : ?>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <select class="select rounded mt-2"
                                                    name="<?php echo $elemento['CAMPO'] ?>"
                                                    <?php echo $elemento['PRIORIDAD'] ?>>
                                                    <option value='0'> Location* (Choose one)
                                                    </option>
                                                    <?php
                                                                foreach ($paises as $elemento2) : ?>
                                                    <option value="<?php echo $elemento2['PAIS'] ?>">
                                                        <?php echo $elemento2['PAIS'] ?></option>
                                                    <?php
                                                                endforeach;
                                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                                endif;
                                            endif;
                                        endforeach;
                                        if ($fila5['ESTADO_PROF'] == 1) :
                                            ?>
                                        <div class="col-lg-12 col-md-12 mt-5">
                                            <h4 class="text-uppercase">Professional Information
                                            </h4>
                                        </div>
                                        <?php
                                            foreach ($campos as $elemento) :
                                                if ($elemento['TIPO'] == "PROF") :
                                                    if (
                                                        $elemento['CAMPO'] != "PAIS"
                                                        and $elemento['CAMPO'] != "TITULO"
                                                        and $elemento['CAMPO'] != "TIPO_CENTRO"
                                                    ) : ?>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <input class="form-control"
                                                    placeholder="<?php echo $elemento['PLACEHOLDER'] ?>" type="text"
                                                    name="P<?php echo $elemento['CAMPO'] ?>"
                                                    <?php echo $elemento['PRIORIDAD'] ?>>
                                            </div>
                                        </div>
                                        <?php

                                                    elseif ($elemento['CAMPO'] == "TIPO_CENTRO") : ?>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <select class="select rounded mt-2"
                                                    name="P<?php echo $elemento['CAMPO'] ?>"
                                                    <?php echo $elemento['PRIORIDAD'] ?>>
                                                    <option value='0'> Título</option>
                                                    <option value='Sr.'>Sr</option>
                                                    <option value='Sra.'>Sra</option>
                                                    <option value='Dr.'>Dr</option>
                                                    <option value='Dra.'>Dra</option>
                                                    <option value='Prof.'>Prof</option>
                                                    <option value='Prof.ª'>Prof.ª</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php elseif ($elemento['CAMPO'] == "PAIS") : ?>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <select class="select rounded mt-2"
                                                    name="P<?php echo $elemento['CAMPO'] ?>"
                                                    <?php echo $elemento['PRIORIDAD'] ?>>
                                                    <option value='0'>Country</option>
                                                    <?php
                                                                    foreach ($paises as $elemento2) : ?>
                                                    <option value="<?php echo $elemento2['PAIS'] ?>">
                                                        <?php echo $elemento2['PAIS'] ?></option>
                                                    <?php
                                                                    endforeach;
                                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                                    endif;
                                                endif;
                                            endforeach;
                                        endif;
                                        if ($fila5['ESTADO_FACTURA'] == 1) :
                                            ?>
                                        <div class="col-lg-12 col-md-12 mt-5">
                                            <h4 class="text-uppercase">Invoice Data</h4>
                                            <p>Would you need an invoice of this payment?</p>
                                        </div>
                                        <div class='col-lg-6 col-sm-12 mb-3'>
                                            <button type='button' class="fact_btn w-75 m-auto">Yes</button>
                                        </div>
                                        <div class='col-lg-6 col-sm-12 mb-3'>
                                            <button type='button'
                                                class="fact_btn fact_btn_select w-75 m-auto">No</button>
                                        </div>
                                        <div class="mt-5 row facturacion_campos" style="display: none">
                                            <?php
                                                foreach ($campos as $elemento) :
                                                    if ($elemento['TIPO'] == "FACT") :
                                                        if ($elemento['CAMPO'] != "PAIS") : ?>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <input class="form-control  <?php echo $elemento['PRIORIDAD'] ?>"
                                                        placeholder="<?php echo $elemento['PLACEHOLDER'] ?>" type="text"
                                                        name="F<?php echo $elemento['CAMPO'] ?>">
                                                </div>
                                            </div>
                                            <?php
                                                        elseif ($elemento['CAMPO'] == "PAIS") : ?>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <select
                                                        class="select rounded mt-2  <?php echo $elemento['PRIORIDAD'] ?>"
                                                        name="F<?php echo $elemento['CAMPO'] ?>">
                                                        <option value='0'>Cuntry</option>
                                                        <?php
                                                                        foreach ($paises as $elemento2) : ?>
                                                        <option value="<?php echo $elemento2['PAIS'] ?>">
                                                            <?php echo $elemento2['PAIS'] ?></option>
                                                        <?php
                                                                        endforeach;
                                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <?php
                                                        endif;
                                                    endif;
                                                endforeach; ?>
                                        </div>
                                        <?php endif;
                                        ?>

                                    </div>
                                    <div class="col-lg-12 pl-0 col-md-12 my-4 text-left">
                                        <div class="form-check pl-0 text-left px-5" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            <input class="form-check-input" type="checkbox" id="pp">
                                            <label class="form-check-label" for="pp"
                                                style="text-decoration:underline;cursor: pointer"> I have read and
                                                accept the privacy policy. </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="row">
                                            <button type="button" class="btn-simple2 mt-2 siguiente"
                                                style="background:<?php echo $evento['COLOR'] ?>" id='siguiente'><img
                                                    src="../dashboard/Imagenes/arrow_2.png" width="15px"
                                                    class="mb-1 me-2">
                                                Next</button>
                                        </div>
                                    </div>

                                </div>
                                <?php if ($fila5['ESTADO_ACOMPA'] == 1) : ?>
                                <div class="content" id="acompa" style="display: none">
                                    <div class="row">
                                        <div class="col-6"> <a href="index.html"><img
                                                    src="../dashboard/Imagenes/logo-dark.png" alt="Logo"></a> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 my-3">
                                            <h2>
                                                Companion <br>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <h4 class="text-uppercase">Are you bringing any companion?</h4>
                                        </div>
                                        <div class='col-lg-6 col-sm-12'>
                                            <button type="button" class="acompa_btn w-75 m-auto" href="">Yes</button>
                                        </div>
                                        <div class='col-lg-6 col-sm-12'>
                                            <button type="button" class="acompa_btn w-75 m-auto" href="">No</button>
                                        </div>
                                        <div class="col-12 mt-5" id="campos-acompa" style="display: none">
                                            <?php if (count($cuotas) > 0) : count($cuotas); ?>
                                            <div class="col-lg-12 col-md-12">
                                                <h4 class="text-uppercase">Comapnion</h4>
                                            </div>
                                            <?php endif; ?>
                                            <div class="row my-5">
                                                <?php foreach ($cuotas as $elemento) : ?>
                                                <div class='col-lg-4 col-sm-12 px-1'>
                                                    <p hidden><?php echo $elemento['PRECIO'] ?></p> <a
                                                        class="cuota_acompa_btn w-100 px-1 m-auto <?php echo $elemento['TIPO']; ?>">
                                                        <?php echo $elemento['NAME'] ?> <br>
                                                        ( <?php echo $elemento['PRECIO'] ?>€)</a>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <h4 class="text-uppercase">Companion Information</h4>
                                            </div>
                                            <div class="row">
                                                <?php
                                                    foreach ($campos as $elemento) :
                                                        if ($elemento['TIPO'] == "ACOMPA") :
                                                            if (
                                                                $elemento['CAMPO'] != "PAIS"
                                                                and $elemento['CAMPO'] != "TITULO"
                                                                and $elemento['CAMPO'] != "TIPO_CENTRO"
                                                            ) : ?>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <input class="form-control"
                                                            placeholder="<?php echo $elemento['PLACEHOLDER'] ?>"
                                                            type="text" name="A<?php echo $elemento['CAMPO'] ?>"
                                                            <?php echo $elemento['PRIORIDAD'] ?>>
                                                    </div>
                                                </div>
                                                <?php
                                                            elseif ($elemento['CAMPO'] == "TITULO") : ?>
                                                <div class="col-lg-6 col-md-12 mt-2"
                                                    <?php echo $elemento['PRIORIDAD'] ?>>
                                                    <div class="form-group">
                                                        <select class="select rounded"
                                                            name="A<?php echo $elemento['CAMPO'] ?>"
                                                            <?php echo $elemento['PRIORIDAD'] ?>>
                                                            <option value='0'> Título</option>
                                                            <option value='Sr.'>Sr</option>
                                                            <option value='Sra.'>Sra</option>
                                                            <option value='Dr.'>Dr</option>
                                                            <option value='Dra.'>Dra</option>
                                                            <option value='Prof.'>Prof</option>
                                                            <option value='Prof.ª'>Prof.ª</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php
                                                            elseif ($elemento['CAMPO'] == "PAIS") : ?>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <select class="select rounded mt-2"
                                                            name="A<?php echo $elemento['CAMPO'] ?>"
                                                            <?php echo $elemento['PRIORIDAD'] ?>>
                                                            <option value='0'>Country</option>
                                                            <?php
                                                                            foreach ($paises as $elemento2) : ?>
                                                            <option value="<?php echo $elemento2['PAIS'] ?>">
                                                                <?php echo $elemento2['PAIS'] ?></option>
                                                            <?php
                                                                            endforeach;
                                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php
                                                            endif;
                                                        endif;
                                                    endforeach;
                                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-4 text-left">
                                            <button class="btn-simple2 mt-2 anterior"
                                                style="background:<?php echo $evento['COLOR'] ?>" id='siguiente2'
                                                type='button'><img src="../dashboard/Imagenes/arrow.png" width="15px"
                                                    class="mb-1 me-2">
                                                Go back</button>
                                        </div>
                                        <div class="col-4 text-left"></div>
                                        <div class="col-4 text-right">
                                            <button class="btn-simple2 mt-2 siguiente"
                                                style="background:<?php echo $evento['COLOR'] ?>" type='button'><img
                                                    src="../dashboard/Imagenes/arrow_2.png" width="15px"
                                                    class="mb-1 me-2">
                                                Next</button>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($fila5['ESTADO_ALOJAMIENTO'] == 1) : ?>
                                <div class="content" id="alojamiento" style="display: none">
                                    <div class="row">
                                        <div class="col-6"> <a href="index.html"><img
                                                    src="../dashboard/Imagenes/logo-dark.png" alt="Logo"></a> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 my-3">
                                            <h2>AHotel booking<br>
                                                <span style="color:<?php echo $evento['COLOR'] ?>"><strong>RafaelHoteles
                                                        Atocha
                                                        Madrid</strong></span>
                                            </h2>
                                        </div>
                                        <div class="col-12">
                                            <div id="carouselExampleControls" class="carousel slide"
                                                data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active"> <img class="d-block w-100"
                                                            src="../assets/img/hotel/img1.jpg" alt="First slide">
                                                    </div>
                                                    <div class="carousel-item"> <img class="d-block w-100"
                                                            src="../assets/img/hotel/img2.jpg" alt="Second slide">
                                                    </div>
                                                    <div class="carousel-item"> <img class="d-block w-100"
                                                            src="../assets/img/hotel/img3.jpg" alt="Third slide">
                                                    </div>
                                                    <div class="carousel-item"> <img class="d-block w-100"
                                                            src="../assets/img/hotel/img4.jpg" alt="Third slide">
                                                    </div>
                                                    <div class="carousel-item"> <img class="d-block w-100"
                                                            src="../assets/img/hotel/img5.jpg" alt="Third slide">
                                                    </div>
                                                    <div class="carousel-item"> <img class="d-block w-100"
                                                            src="../assets/img/hotel/img6.jpg" alt="Third slide">
                                                    </div>
                                                    <div class="carousel-item"> <img class="d-block w-100"
                                                            src="../assets/img/hotel/img7.jpg" alt="Third slide">
                                                    </div>
                                                    <div class="carousel-item"> <img class="d-block w-100"
                                                            src="../assets/img/hotel/img8.jpg" alt="Third slide">
                                                    </div>
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleControls"
                                                    role="button" data-slide="prev"> <span
                                                        class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span> </a> <a
                                                    class="carousel-control-next" href="#carouselExampleControls"
                                                    role="button" data-slide="next"> <span
                                                        class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span> </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <h4 class="text-uppercase">Would you like to book a hotel?</h4>
                                        </div>
                                        <div class='col-lg-6 col-sm-12'>
                                            <button type='button' class="aloja_btn w-75 m-auto">Si</button>
                                        </div>
                                        <div class='col-lg-6 col-sm-12'>
                                            <button type='button' class="aloja_btn w-75 m-auto">No</button>
                                        </div>
                                        <div class="col-12 mt-5" id="campos-alojamiento" style="display: none">
                                            <div class="col-lg-12 col-md-12">
                                                <h4 class="text-uppercase">Reservation dates</h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <input class="form-control" type="date" id="f-entrada"
                                                            value='<?php echo $fila5['F_ENTRADA'] ?>'>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <input class="form-control" type="date" id="f-salida"
                                                            value='<?php echo ($fila5['F_SALIDA']) ?>'>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 mt-5">
                                                <h4 class="text-uppercase">Sort of rooms</h4>
                                            </div>
                                            <div class="row mt-5">
                                                <?php
                                                    $count = 0;
                                                    foreach ($habitaciones as $elemento) : ?>
                                                <div class='col-lg-4 col-sm-12 px-1'>
                                                    <p hidden><?php echo $elemento['PRECIO'] ?></p>
                                                    <a class="hab_btn w-100 px-1 m-auto <?php echo $elemento['TIPO']; ?>"
                                                        id="simple_hab<?php echo $count++; ?>">
                                                        <?php echo $elemento['HABITACION'] ?> <br>
                                                        ( <?php echo $elemento['PRECIO'] ?>€)</a>
                                                </div>
                                                <?php
                                                    endforeach;
                                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-4 text-left">
                                            <button class="btn-simple2 mt-2 anterior" type='button' id='siguiente2'
                                                style="background:<?php echo $evento['COLOR'] ?>"><img
                                                    src="../dashboard/Imagenes/arrow.png" width="15px"
                                                    class="mb-1 me-2">
                                                Go back</button>
                                        </div>
                                        <div class="col-4 text-left"></div>
                                        <div class="col-4 text-right">
                                            <button class="btn-simple2 mt-2 siguiente" type='button'
                                                style="background:<?php echo $evento['COLOR'] ?>"><img
                                                    src="../dashboard/Imagenes/arrow_2.png" width="15px"
                                                    class="mb-1 me-2">
                                                Next</button>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($fila5['ESTADO_EXTRAS'] == 1) : ?>
                                <div class="content" id="extras" style="display: none">
                                    <div class="row">
                                        <div class="col-6"> <a href="index.html"><img
                                                    src="../dashboard/Imagenes/logo-dark.png" alt="Logo"></a> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 my-3">
                                            <h2>Others<br>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <h4 class="text-uppercase">Servicios derivados del evento</h4>
                                        </div>
                                        <?php
                                            foreach ($campos as $elemento) :
                                                if ($elemento['TIPO'] == "EXTRA_SER") :
                                            ?>
                                        <div class="col-lg-12 pl-0 col-md-12 my-4 text-left">
                                            <div class="form-check pl-0 text-left px-5">
                                                <input class="form-check-input" type="checkbox" value="No"
                                                    id="<?php echo $elemento['CAMPO'] ?>"
                                                    name="E<?php echo $elemento['CAMPO'] ?>">
                                                <label class="form-check-label"
                                                    for="<?php echo $elemento['CAMPO'] ?>"><?php echo $elemento['PLACEHOLDER'] ?></label>
                                            </div>
                                        </div>
                                        <?php
                                                endif;
                                            endforeach;
                                            ?>
                                        <div class="col-lg-12 col-md-12">
                                            <h4 class="text-uppercase">Información de Interés Logístico</h4>
                                        </div>
                                        <?php
                                            foreach ($campos as $elemento) :
                                                if ($elemento['TIPO'] == "EXTRA") : ?>
                                        <div class="col-12 mt-5">
                                            <div class="form-group">
                                                <input class="form-control"
                                                    placeholder="<?php echo $elemento['PLACEHOLDER'] ?>" type="text"
                                                    name="E<?php echo $elemento['CAMPO'] ?>"
                                                    <?php echo $elemento['PRIORIDAD'] ?>>
                                            </div>
                                        </div>
                                        <?php
                                                endif;
                                            endforeach;
                                            ?>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-4 text-left">
                                            <button class="btn-simple2 mt-2 anterior" type='button' id='siguiente2'
                                                style="background:<?php echo $evento['COLOR'] ?>"><img
                                                    src="../dashboard/Imagenes/arrow.png" width="15px"
                                                    class="mb-1 me-2">
                                                Go back</button>
                                        </div>
                                        <div class="col-4 text-left"></div>
                                        <div class="col-4 text-right">
                                            <button class="btn-simple2 mt-2 siguiente" type='button'
                                                style="background:<?php echo $evento['COLOR'] ?>"><img
                                                    src="../dashboard/Imagenes/arrow_2.png" width="15px"
                                                    class="mb-1 me-2">
                                                Next</button>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="content" id="resumen" style="display: none">
                                    <div class="row">
                                        <div class="col-6"> <a href="index.html"><img
                                                    src="../dashboard/Imagenes/logo-dark.png" alt="Logo"></a> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 my-3">
                                            <h2>RESUME</h2>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <h4 class="text-uppercase">personal Information</h4>
                                        </div>
                                        <?php
                                        foreach ($campos as $elemento) :
                                            if ($elemento['TIPO'] == "USUARIO") :
                                        ?>
                                        <div class="col-lg-12 col-md-12 text-left">
                                            <h6 class='bg-light border-bottom p-2'>
                                                <strong><?php echo $elemento['PLACEHOLDER'] ?>:</strong> <span
                                                    id='RESUMEN_<?php echo $elemento['CAMPO'] ?>'></span>
                                            </h6>
                                        </div>
                                        <?php
                                            endif;
                                        endforeach;
                                        ?>
                                        <?php if ($fila5['ESTADO_PROF'] == 1) : ?>
                                        <div class="col-lg-12 col-md-12">
                                            <h4 class="text-uppercase">Professional Information</h4>
                                        </div>
                                        <?php
                                            foreach ($campos as $elemento) :
                                                if ($elemento['TIPO'] == "PROF") : ?>
                                        <div class="col-lg-12 col-md-12 text-left">
                                            <h6 class='bg-light border-bottom p-2'>
                                                <strong><?php echo $elemento['PLACEHOLDER'] ?>:</strong> <span
                                                    id='PRESUMEN_<?php echo $elemento['CAMPO'] ?>'></span>
                                            </h6>
                                        </div>
                                        <?php
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                        <?php if ($fila5['ESTADO_FACTURA'] == 1) : ?>
                                        <div class="col-lg-12 col-md-12">
                                            <h4 class="text-uppercase">Invoice Information</h4>
                                        </div>
                                        <?php
                                            foreach ($campos as $elemento) :
                                                if ($elemento['TIPO'] == "FACT") : ?>
                                        <div class="col-lg-12 col-md-12 text-left">
                                            <h6 class='bg-light border-bottom p-2'>
                                                <strong><?php echo $elemento['PLACEHOLDER'] ?>:</strong> <span
                                                    id='FRESUMEN_<?php echo $elemento['CAMPO'] ?>'></span>
                                            </h6>
                                        </div>
                                        <?php
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                        <?php if ($fila5['ESTADO_ACOMPA'] == 1) : ?>
                                        <div class="col-lg-12 col-md-12">
                                            <h4 class="text-uppercase">Companion information</h4>
                                        </div>
                                        <?php
                                            foreach ($campos as $elemento) :
                                                if ($elemento['TIPO'] == "ACOMPA") : ?>
                                        <div class="col-lg-12 col-md-12 text-left">
                                            <h6 class='bg-light border-bottom p-2'>
                                                <strong><?php echo $elemento['PLACEHOLDER'] ?>:</strong> <span
                                                    id='ACOMPA_RESUMEN_<?php echo $elemento['CAMPO'] ?>'></span>
                                            </h6>
                                        </div>
                                        <?php
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                        <?php if ($fila5['ESTADO_ALOJAMIENTO'] == 1) : ?>
                                        <div class="col-lg-12 col-md-12">
                                            <h4 class="text-uppercase">Hotel booking</h4>
                                        </div>
                                        <?php
                                            foreach ($campos as $elemento) :
                                                if ($elemento['TIPO'] == "ALOJAMIENTO") : ?>
                                        <div class="col-lg-12 col-md-12 text-left">
                                            <h6 class='bg-light border-bottom p-2'>
                                                <strong><?php echo $elemento['PLACEHOLDER'] ?>:</strong> <span
                                                    id='ARESUMEN_<?php echo $elemento['CAMPO'] ?>'></span>
                                            </h6>
                                        </div>
                                        <?php
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                        <?php if ($fila5['ESTADO_EXTRAS'] == 1) : ?>
                                        <div class="col-lg-12 col-md-12">
                                            <h4 class="text-uppercase">Others</h4>
                                        </div>
                                        <?php

                                            foreach ($campos as $elemento) :
                                                if (
                                                    $elemento['TIPO'] == "EXTRA"
                                                    or $elemento['TIPO'] == "EXTRA_SER"
                                                ) : ?>
                                        <div class="col-lg-12 col-md-12 text-left">
                                            <h6 class='bg-light border-bottom p-2'>
                                                <strong><?php echo $elemento['PLACEHOLDER'] ?>:</strong> <span
                                                    id='ERESUMEN_<?php echo $elemento['CAMPO'] ?>'></span>
                                            </h6>
                                        </div>
                                        <?php
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                        <?php if ($pagos['TRANSFERENCIA'] == 1 and $fila['PRECIO'] != 0) : ?>
                                        <div class="col-lg-6 col-md-12 text-left">
                                            <button class="btn-simple mt-2 w-100"
                                                style="background:<?php echo $evento['COLOR'] ?>" type='button'
                                                data-toggle="modal" data-target="#transferencia"><i
                                                    class="fas fa-euro-sign"></i> Bank transfer</button>
                                        </div>
                                        <?php endif; ?>
                                        <?php if ($pagos['TARJETA_VECI'] == 1 and $fila['PRECIO'] != 0) : ?>
                                        <div class="col-lg-6 col-md-12 text-left">
                                            <button class="btn-simple mt-2 w-100"
                                                style="background:<?php echo $evento['COLOR'] ?>" type='button'
                                                data-toggle="modal" data-target="#tarjetaveci"><i
                                                    class="fas fa-wallet"></i> Pago por
                                                Tarjeta El Corte Inglés</button>
                                        </div>
                                        <?php endif; ?>
                                        <?php if ($pagos['TARJETA'] == 1 and $fila['PRECIO'] != 0) : ?>
                                        <div class="col-lg-6 col-md-12 text-left" style="opacity: 1">
                                            <button class="btn-simple mt-2 w-100"
                                                style="background:<?php echo $evento['COLOR'] ?>" type='button'
                                                data-toggle="modal" data-target="#tarjeta"><i
                                                    class="fas fa-credit-card"></i>Debit / Credit card</button>
                                        </div>
                                        <?php endif; ?>
                                        <?php if ($pagos['STRIPE'] == 1 and $fila['PRECIO'] != 0) : ?>
                                        <div class="col-lg-6 col-md-12 text-left" style="opacity: 1">
                                            <button class="btn-simple mt-2 w-100"
                                                style="background:<?php echo $evento['COLOR'] ?>" type='button'
                                                data-toggle="modal" data-target="#tarjeta" id="stripe_pay"><i
                                                    class="fas fa-credit-card"></i>Debit / Credit card</button>
                                        </div>
                                        <?php endif; ?>
                                        <?php if ($pagos['REGISTRO_FREE'] == 1 and $fila['PRECIO'] == 0) : ?>
                                        <div class="col-lg-6 col-md-12 text-left" style="opacity: 1">
                                            <button class="btn-simple mt-2 w-100"
                                                style="background:<?php echo $evento['COLOR'] ?>" type='button'
                                                data-toggle="modal" data-target="#for_free"> Submit
                                            </button>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-6 text-left">
                                            <button class="btn-simple2 mt-2 anterior"
                                                style="background:<?php echo $evento['COLOR'] ?>" type='button'><img
                                                    src="../dashboard/Imagenes/arrow.png" width="15px"
                                                    class="mb-1 me-2">
                                                Go back</button>
                                        </div>
                                        <div class="col-4 text-left"></div>
                                        <div class="col-4 text-right"> </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!--MODAL ALERTAS -->
    <article class="modal fade" id="alertas" tabindex="-1" role="dialog" aria-labelledby="alertasLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertasLabel">Page Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body"> ... </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </article>
    <!-- MODAL TRANSFERENCIA -->
    <article class="modal fade" id="transferencia" tabindex="-1" role="dialog" aria-labelledby="transferenciaLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transferenciaLabel">bank transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <p>
                        (Once we verify the deposit in our bank statement, confirmation of registration will be notified
                        by e-mail).<br>
                        <br>
                        <?php if ($pagos['TITULAR_CUENTA'] != "") : ?> <strong>Titular de la
                            Cuenta:</strong><?php echo $pagos['TITULAR_CUENTA']; ?><br><?php endif; ?>
                        <?php if ($pagos['ENTIDAD'] != "") : ?>
                        <strong>Entidad:</strong><?php echo $pagos['ENTIDAD']; ?><br><?php endif; ?>
                        <?php if ($pagos['IBAM'] != "") : ?>
                        <strong>TIBAN:</strong><?php echo $pagos['IBAM']; ?><br><?php endif; ?>
                        <?php if ($pagos['SWIFT_CODE'] != "") : ?> <strong>SWIFT CODE
                            (BIC):</strong><?php echo $pagos['SWIFT_CODE']; ?><br><?php endif; ?>
                        <?php if ($pagos['CONCEPTO'] != "") : ?>
                        <strong>Concepto:</strong><?php echo $pagos['CONCEPTO']; ?><br><?php endif; ?>
                        <br>
                        <strong>
                            The bank transfer details will be sent to your email once you complete the pre-registration.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-light rounded-pill" id='send_transferencia'>Submit</button>
                </div>
            </div>
        </div>
    </article>
    <!-- MODAL TARJETA EL CORTE INGLES -->
    <article class="modal fade" id="tarjetaveci" tabindex="-1" role="dialog" aria-labelledby="tarjetaveciLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tarjetaveciLabel">Pago por Tarjeta de Compra El Corte Inglés</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <p>Nuestro equipo se pondrá en contacto con usted para facilitarle el enlace de pago. en breve
                        recibirá un correo electrónico con el resumen de su pre registro y las instrucciones a seguir.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-light rounded-pill" id='send_tarjetaveci'>Inscribirme</button>
                </div>
            </div>
        </div>
    </article>
    <!-- MODAL TARJETA EL CORTE INGLES -->
    <article class="modal fade" id="tarjeta" tabindex="-1" role="dialog" aria-labelledby="tarjetaLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tarjetaLabel">Credit / Debit card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <p>Your data will be saved and we will transfer you to our secure payment gateway. If you decide not
                        continue with the payment you will be able to complete it from your personal area later and it
                        will not be necessary make a new registration.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-light rounded-pill" id='send_tarjeta'
                        style="opacity: 1">Submit</button>
                </div>
            </div>
        </div>
    </article>
    <!-- MODAL TARJETA EL CORTE INGLES -->
    <article class="modal fade" id="for_free" tabindex="-1" role="dialog" aria-labelledby="for_freeLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="for_freeLabel">Registration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <p>You are submiting your information to <?php echo $evento["NAME"] ?>. If you want to get in touch
                        with us write to <?php echo $evento['EMAIL_SECRETARIA'] ?>.</p>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-light rounded-pill" id='send_free'
                        style="opacity: 1">Submit</button>
                </div>
            </div>
        </div>
    </article>
    <!-- MODAL FEE END -->


    <!-- MODAL FEE END -->
    <article class="modal fade" id="modal_free_end" tabindex="-1" role="dialog" aria-labelledby="modal_free_endLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_free_endLabel">Registration completed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <p>Your registration has been completed successfully, you will shortly receive an email with
                        confirmation of registration.</p>
                </div>
                <div class="modal-footer">
                    <a href="/" type="button" class="btn btn-light rounded-pill" style="opacity: 1">Go back</a>
                </div>
            </div>
        </div>
    </article>
    <!-- jQuery Frameworks
modal_free_end
    ============================================= -->

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
    var noches = 0;
    var habitacion = "";
    var costo_habitacion = 0;
    var total_hab = 0;
    var entrada;
    var salida;
    var cuota = <?php echo $fila['PRECIO'] ?>;
    var codigo_descuento = "<?php if ($fila['PRECIO'] == 0) : echo substr(base64_decode($_GET['cuota']), 2);
                                endif; ?>";
    var categoria = "<?php echo $fila['NAME']; ?>";
    var stripe_pay = false;
    var datos;
    var cuota_acompa = 0;
    var acompa = "No";
    var costo_cuota_acompa = 0;
    $("#stripe_pay").click(function() {
        stripe_pay = true;
        console.log(stripe_pay);
    })
    console.log(categoria);
    //---------------------------------CLASE QUE RESUELVE CALCULOS------------------------//	
    class HAB {
        constructor(valor, valor2, valor3) {

            if (valor2 >= '<?php echo $fila5['F_ENTRADA'] ?>' && valor3 <= '<?php echo $fila5['F_SALIDA'] ?>') {
                this.f_entrada = valor2;
                this.f_salida = valor3;
                this.entrada = new Date(this.f_entrada);
                this.salida = new Date(this.f_salida);
                this.noches = parseInt((this.salida.getTime() - this.entrada.getTime()) * 0.000000012);
                this.costo = valor;
                this.total = this.noches * this.costo;
                this.get_total_hab();
                total(cuota, costo_cuota_acompa, this.total);
            } else {
                if (valor != 0 && valor2 != "" && valor3 != "") {
                    this.total = 0;
                    $('#f-salida').val('<?php echo $fila5['F_SALIDA'] ?>');
                    $('#f-entrada').val('<?php echo $fila5['F_ENTRADA'] ?>');
                    alertas(
                        "Your dates most <?php echo $fila5['F_ENTRADA'] ?> and <?php echo $fila5['F_SALIDA'] ?>."
                    );
                    $('.hab_btn').removeClass('hab_select');
                    costo_habitacion = 0;
                    $('#precio_hab').text(Number.parseFloat(this.total).toFixed(2) + "€");
                    total(cuota, costo_cuota_acompa, this.total);
                } else {
                    total(cuota, costo_cuota_acompa, this.total);
                }

            }
        }
        get_total_hab() {

            if (this.noches <= 0) {
                alertas("Please select a different dante to leave the hotel.");
                $('#f-salida').val('<?php echo $fila5['F_SALIDA'] ?>')
            } else {
                $('#noches_no').text(this.noches);
                $('#precio_hab').text(Number.parseFloat(this.total).toFixed(2) + "€");
            }

        }
        validar_fechas() {
            if (this.f_salida > '<?php echo $fila5['F_SALIDA'] ?>' || this.f_entrada <
                '<?php echo $fila5['F_ENTRADA'] ?>') {
                return 1;
            }
            return 0;
        }
        get_noches() {
            if (isNaN(this.noches)) {
                return 0;
            } else {
                return this.noches;
            }

        }
        get_total() {

            return this.total;


        }


    }

    //---------------------------------FUNCION GESTIONA LOS CALCULOS------------------------//

    function instancia_hab(valor) {
        const total_hotel = new HAB(valor, $('#f-entrada').val(), $('#f-salida').val());
    }
    //---------------------------------FUNCIONES-------------------------------------------//
    function alertas(valor) {
        $('#alertas').modal('show');
        $('#alertas .modal-body').text(valor);

    }
    //---------------------------------FUNCIONES ADJUNTANDO DATOS-------------------------------------------//
    function resumen_datos() {
        datos = new FormData(document.getElementById('formulario'));
        var hab = new HAB(costo_habitacion, $('#f-entrada').val(), $('#f-salida').val());
        datos.append('CODE', codigo_descuento);
        datos.append('AF_ENTRADA', $('#f-entrada').val());
        datos.append('AF_SALIDA', $('#f-salida').val());
        datos.append('ANOCHES', hab.get_noches());
        datos.append('ATOTAL_HAB', hab.get_total());
        datos.append('ACOMPA_CUOTA', costo_cuota_acompa);
        datos.append('CUOTA', cuota);
        datos.append('ACOMPA', acompa);
        datos.append('LAN', "EN");
        datos.append('CUOTA_NAME', '<?php echo $fila['NAME'] ?>');
        datos.append('CATEGORIA', categoria);
        datos.append('AGENCIA_EMAIL', $("input[name='AGENCIA_EMAIL']").val());
        console.log(categoria);
        var count_hab_select = 0;
        <?php foreach ($habitaciones as $elemento) : ?>
        if ($('.hab_select').prev('p').text() == <?php echo $elemento['PRECIO'] ?>) {
            datos.append('AHABITACION', '<?php echo $elemento['HABITACION'] ?>');
            count_hab_select++;
        } else {
            if (count_hab_select != 1) {
                datos.append('AHABITACION', '');
            }

        }
        <?php endforeach; ?>
        <?php foreach ($campos as $elemento) : if ($elemento['TIPO'] == "USUARIO") : ?>
        if (datos.get('<?php echo $elemento['CAMPO'] ?>') != null) {
            $("#RESUMEN_<?php echo $elemento['CAMPO'] ?>").text(datos.get('<?php echo $elemento['CAMPO'] ?>'));
        }
        <?php
                elseif ($elemento['TIPO'] == "PROF") : ?>
        if (datos.get('P<?php echo $elemento['CAMPO'] ?>') != null) {
            $("#PRESUMEN_<?php echo $elemento['CAMPO'] ?>").text(datos.get('P<?php echo $elemento['CAMPO'] ?>'));
        }
        <?php
                elseif ($elemento['TIPO'] == "ACOMPA") : ?>
        if (datos.get('A<?php echo $elemento['CAMPO'] ?>') != null) {
            $("#ACOMPA_RESUMEN_<?php echo $elemento['CAMPO'] ?>").text(datos.get('A<?php echo $elemento['CAMPO'] ?>'));
        }
        <?php
                elseif ($elemento['TIPO'] == "ALOJAMIENTO") : ?>
        if (datos.get('A<?php echo $elemento['CAMPO'] ?>') != null) {
            $("#ARESUMEN_<?php echo $elemento['CAMPO'] ?>").text(datos.get('A<?php echo $elemento['CAMPO'] ?>'));
        }
        <?php
                elseif ($elemento['TIPO'] == "EXTRA_SER" or $elemento['TIPO'] == "EXTRA") : ?>
        if (datos.get('E<?php echo $elemento['CAMPO'] ?>') != null) {
            $("#ERESUMEN_<?php echo $elemento['CAMPO'] ?>").text(datos.get('E<?php echo $elemento['CAMPO'] ?>'));
        }
        <?php
                elseif ($elemento['TIPO'] == "FACT") : ?>
        if (datos.get('F<?php echo $elemento['CAMPO'] ?>') != null) {
            $("#FRESUMEN_<?php echo $elemento['CAMPO'] ?>").text(datos.get('F<?php echo $elemento['CAMPO'] ?>'));
        }
        <?php endif;
            endforeach; ?>

    }

    function total(valor, valor1, valor2) {
        if (valor2 == undefined) {
            valor2 = 0;
        }
        $('#total_compra').text(Number.parseFloat(parseFloat(valor) + parseFloat(valor1) + parseFloat(valor2)).toFixed(
            2) + "€");
    }

    function individual() {
        $('.hab_select').fadeOut().removeClass('.hab_select');
        $('.Personal').fadeOut();
        costo_habitacion = 0;
        instancia_hab(costo_habitacion);
        alertas(
            'Su reserva de Alojamiento se ha reiniciado ya que ha seleccionado un acompañante con una habitación personal.'
        );
    }
    total(cuota, costo_cuota_acompa, 0);
    //-----------------------------SELECCION DE ALOJAMIENTO SI/NO-------------------------//
    $('.aloja_btn').click(function() {
        $('.aloja_btn').removeClass('aloja_select');
        $(this).addClass('aloja_select');

        if ($(this).text() == "Yes") {
            $('#campos-alojamiento').fadeIn();
            $('#piloto_hotel').fadeIn();
            $('#f-salida').val('<?php echo $fila5['F_SALIDA'] ?>');
            $('#f-entrada').val('<?php echo $fila5['F_ENTRADA'] ?>');
            instancia_hab(costo_habitacion);

        } else if ($(this).text() == "No") {
            $('#f-entrada').val("");
            $('#f-salida').val("");
            costo_habitacion = 0;
            $('.hab_select').removeClass('.hab_select');
            $('#campos-alojamiento').fadeOut();
            $('#piloto_hotel').fadeOut();
            $('.hab_btn').removeClass('hab_select');
            instancia_hab(costo_habitacion);

        } else {
            alertas("There is no room selected.");
        }
        return false;
    })
    //-----------------------------SELECCION DE ACOMPA SI/NO-------------------------//
    $('.acompa_btn').click(function() {
        $('.acompa_btn_select').removeClass('acompa_btn_select').addClass('acompa_btn');
        $(this).addClass('acompa_btn_select').removeClass('acompa_btn');

        if ($(this).text() == "Yes") {
            $('#campos-acompa').fadeIn();
            $('#piloto_acompa').fadeIn();
            acompa = "Yes";
            if ($('.hab_select').hasClass('Personal')) {
                individual();
            } else {
                $('.Personal').fadeOut();
            }
        } else {
            acompa = "No";
            console.log(acompa);
            costo_cuota_acompa = 0;
            $('#precio_acompa').text(costo_cuota_acompa + "€")
            $('#campos-acompa').fadeOut();
            $('#piloto_acompa').fadeOut();
            $('#simple_hab0').fadeIn();

        }

        instancia_hab(costo_habitacion);
        return false;
    })

    $('.hab_btn').click(function() {
        $('.hab_btn').removeClass('hab_select');
        $(this).addClass('hab_select');
        costo_habitacion = $(this).prevAll('p').text();
        instancia_hab(costo_habitacion);
        return false;
    })

    $('.cuota_acompa_btn').click(function() {
        $('.cuota_acompa_btn').removeClass('cuota_acompa_btn_select');
        $(this).addClass('cuota_acompa_btn_select');
        costo_cuota_acompa = $(this).prevAll('p').text();
        $('#precio_acompa').text(Number.parseFloat(costo_cuota_acompa).toFixed(2) + "€");
        instancia_hab(costo_habitacion);
        return false;
    })
    $('input[type=date]').on('change', function() {
        instancia_hab(costo_habitacion);
    })
    //--------------------------------------------------- BOTONES DE SIGUIENTE-------------------------------------------------------------//
    $('.siguiente').on('click', function() {
        var cunt = 0;
        var id = $(this).closest('.row').closest('.content').attr('id');
        if (id == "acompa") {
            if ($('button').hasClass('acompa_btn_select') == false) {
                alertas("You most select if you are going to bring a companion.");
                return false;
            } else {
                <?php if (count($cuotas) > 0) : count($cuotas); ?>
                if ($(".cuota_acompa_btn").hasClass('cuota_acompa_btn_select') == true) {
                    <?php endif; ?>
                    if ($('.acompa_btn_select').text() == "No") {

                        $('#acompa input').each(function() {
                            $(this).val("")
                        })
                        $('#simple_hab').fadeIn();
                        $(this).closest('.row').closest('.content').fadeOut().next('.content').fadeIn();
                        return false;
                    } else {

                        $('#simple_hab').fadeOut();

                    }
                    <?php if (count($cuotas) > 0) : count($cuotas); ?>
                } else {
                    alertas("Debe seleccionar una cuota de acompañante, este paso es obligatorio.");
                    return false;
                }
                <?php endif; ?>
            }


        }
        if ($("#categoria").val() == "") {
            $("#categoria").addClass('invalid');
            cunt++;
        }
        $("#" + id + " input:required").each(function() {
            if ($(this).val() == "") {
                $(this).addClass('invalid');
                cunt++;
            }
        });
        $("#" + id + " select:required").each(function() {
            if ($(this).val() == 0) {
                $(this).addClass('invalid');
                cunt++;
            }
        });

        if (cunt != 0) {
            alertas("You most complete all the required fields.")
        } else {
            var validEmail = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
            if (validEmail.test($("input[name='EMAIL']").val())) {
                if ($('#pp').prop('checked')) {
                    if (id == "alojamiento") {

                        if ($('.aloja_select').text() == "Yes") {

                            if (costo_habitacion == 0) {
                                alertas(
                                    "Debe escoger una habitación para continuar con su registro con alojamiento."
                                )
                            } else {
                                $(this).closest('.row').closest('.content').fadeOut().next('.content').fadeIn();
                            }
                        } else if ($('.aloja_select').text() == "No") {
                            $(this).closest('.row').closest('.content').fadeOut().next('.content').fadeIn();
                        } else {
                            alertas("You mos answer all the questions before go next.");
                        }
                    } else {
                        $(this).closest('.row').closest('.content').fadeOut().next('.content').fadeIn();
                    }

                } else {
                    alertas("You most accepted the Privacy policy.");
                }
            } else {
                alertas('You most write a valid email address.');
            }
        }
        resumen_datos()
    })

    $('.anterior').on('click', function() {
        $(this).closest('.row').closest('.content').fadeOut().prev('.content').fadeIn();
        return false;
    })

    $('input, select').on('focus', function() {
        $(this).removeClass('invalid');
    })

    $('input[type=checkbox]').on('click', function() {
        if ($(this).prop('checked') == true) {
            $(this).val("Yes");
        } else {
            $(this).val("No");
        }

    })
    $(document).ready(function() {

        $("input").each(function() {
            if ($(this).prop('required') == true) {
                $(this).attr('placeholder', $(this).attr('placeholder') + "*");
            }
        })
        $("select").each(function() {
            if ($(this).prop('required') == true) {
                $(this).find('option:first-child').text($(this).find('option:first-child').text() +
                    "*");
            }
        })

        $('#send_transferencia, #send_tarjetaveci, #send_tarjeta,#send_free').on('click', function() {
            console.log(datos);
            if ($(this).attr('id') == "send_transferencia") {
                datos.append('PAGO', "TRANSFERENCIA");
            } else if ($(this).attr('id') == "send_tarjetaveci") {
                datos.append('PAGO', "TARJETA ECI");
            } else if ($(this).attr('id') == "send_tarjeta") {
                datos.append('PAGO', "TPV");
            } else {
                datos.append('PAGO', "FREE");

            }
            if (stripe_pay == true) {
                datos.append('STRIPE', "Yes");
            }
            $.ajax({
                url: "../dashboard/php/registros/form.php",
                type: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function(res) {
                    if ($.trim(res) == "exist") {
                        alertas(
                            "There is a register with this email address."
                        );
                    } else if ($.trim(res) == "ok") {
                        window.location.href =
                            "https://<?php echo $_SERVER['HTTP_HOST'] ?>/";
                    } else if ($.trim(res) == "tpv") {
                        window.location.href =
                            "https://<?php echo $_SERVER['HTTP_HOST'] ?>/personal/";
                    } else if ($.trim(res) == "free") {
                        $("#modal_free_end").modal("show");

                    }
                    console.log(res);
                }
            })
        })


    })
    carrito();
    $(window).resize(function() {
        carrito();
    })

    function carrito() {

        if ($(window).width() < 768) {
            $('.carrito').css({
                width: "97%",
                left: "-900px"
            })
            $('.carrito1').fadeIn();

        } else {
            $('.carrito').css({
                width: "32%",
                left: "10px"
            })
            $('.carrito1').fadeOut();

        }
    }
    var carrito1 = true;
    $('.carrito1').on('click', function() {
        if (carrito1 == true) {
            $('.carrito').css({
                left: "10px"
            })
            carrito1 = false;
        } else {
            $('.carrito').css({
                left: "-900px"
            })
            carrito1 = true;
        }

    })
    $('#pp').change(function() {
        window.open("<?php echo $evento["PP"] ?>", '_blank');
        //alertas( "Comunicamos que de conformidad con el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos y en la legislación nacional de desarrollo del mismo, le informamos que sus datos se hallan en un fichero informático. Si ud. no esta conforme con el tratamiento de sus datos le rogamos lo comunique por escrito a la atención del Responsable de Seguridad de la Sociedad Española de Infectología Pediátrica por correo electrónico a secretaria.seip@viajeseci.es o vía postal a C/ Villanueva 11 - 28001 Madrid (España) pudiendo ejercitar su derecho de acceso, rectificación o supresión, limitación de su tratamiento, oposición, portabilidad, y a no ser objeto a decisiones individuales automatizadas. ")

    })


    //-----------------------------SELECCION DE ALOJAMIENTO SI/NO-------------------------//
    $('.fact_btn').click(function() {
        $('.fact_btn').removeClass('fact_btn_select');
        $(this).addClass('fact_btn_select');
        if ($(this).text() == "Yes") {
            $('.facturacion_campos').fadeIn().find('input').each(function() {
                if ($(this).hasClass('required')) {
                    $(this).prop('required', true).attr("placeholder", $(this).attr("placeholder") +
                        "*");
                }

            })
            $('.facturacion_campos').find('select').each(function() {
                if ($(this).hasClass('required')) {
                    $(this).prop('required', true).attr("placeholder", $(this).attr("placeholder") +
                        "*");
                }

            })
        } else {
            $('.facturacion_campos').fadeOut().find('input').each(function() {
                if ($(this).hasClass('required')) {
                    $(this).prop('required', false);
                }

            })
            $('.facturacion_campos').find('select').each(function() {
                if ($(this).hasClass('required')) {
                    $(this).prop('required', false);
                }

            })

        }
        return false;
    })
    //-------------------------CODIGO DESCUENTO--------------------------//

    $('.code_btn').click(function() {
        $('.code_btn_select').removeClass('code_btn_select');
        $(this).addClass('code_btn_select');
        if ($(this).text() == "Yes") {
            $('#input_code').fadeIn().find('input').attr('required', true);

        } else {
            $('#input_code').fadeOut().find('input').attr('required', false);
        }
    })

    $('#input_code input').on('blur', function() {
        var code = $(this).val();

        if (code != "") {

            $.ajax({
                url: "../dashboard/php/registros/code_verify.php",
                type: "POST",
                data: "code=" + code + "&action=verify_descount&",
                success: function(res) {
                    if ($.trim(res) == "nocode") {
                        alertas("The code does not exist.")
                    } else {
                        window.location.href = "<?php echo $_SERVER['PHP_SELF'] ?>" + "?cuota=" +
                            res + "&categoria=" + categoria;
                    }
                    console.log(res);
                }
            })
        }
    })

    $("select[name='categoria']").change(function() {
        categoria = this.value;
        $.ajax({
            url: "../dashboard/php/registros/code_verify.php",
            type: "POST",
            data: "code=" + this.value + "&action=verify_meeting",
            success: function(res) {
                let datos = JSON.parse(res);
                $('.includes').find('div').remove();
                $('.includes').append('<div>' + datos.INCLUDES + '</div>');
            }
        })
    })
    </script>
</body>

</html>