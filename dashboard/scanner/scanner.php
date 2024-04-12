<?php
session_start();
if(!empty($_SESSION['login_avm_user'])){
	
}else{
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-store,max-age=0" />
    <meta name="robots" content="noindex" />
    <title>SCANNER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    * {
        margin: auto;
    }

    #menu {
        height: 100px;
        width: 100%;
        background: linear-gradient(45deg, rgba(50, 225, 159, 1) 32%, rgba(229, 255, 71, 1) 100%);
    }

    video {
        width: 100%;
        border-radius: 25px;
        ººº
    }

    h3 {
        font-size: 20px;
        font-weight: 300;
        margin-top: 10px;
    }

    #datos {
        display: none;
        margin-top: 150px;
    }

    .datos {
        font-size: 16px;
    }

    h5 {
        font-size: 18px;
    }

    #estado {
        font-size: 20px;
        padding: 10px;
    }

    #marcador {
        height: 2px;
        background: rgba(229, 255, 71, 1);
        width: 100%;
        position: absolute;
        z-index: 9999999;
        top: 0px;
        transition: all 2.5s ease;
        box-shadow: 0px 0px 15px rgba(229, 255, 71, 1);
        display: none;
    }

    #marcador-titulo {
        background: rgba(50, 225, 159, 1);
        padding: 8px;
        position: relative;
        bottom: -585px;
        width: 150px;
        color: white;
        text-align: center;
        z-index: 9999999;
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
        display: none;
    }

    a {
        text-decoration: none;
    }

    #scanner {
        position: relative;
    }
    </style>
</head>

<body>
    <div id="menu" class="container-fluid d-flex shadow"> <img src="assets/Imagenes/logo.png"
            style="height: 60px!important;margin-top: 20px;">

        <a href="index.php">
            <h3 class="text-white"> Salir</h3>
        </a>
    </div>
    <section class="container">
        <div class="col-12 mt-2 justify-content-center" id="scanner" style="position:relative">
            <div id="marcador" style=""></div>
            <div id="rotate_camera" style="position:absolute;bottom:30px;z-index: 999999;right:30px;"><img
                    src="assets/Imagenes/rotate.png" width="100%"></div>
            <div id="marcador-titulo" style="position: relative;bottom: 0px;" class="m-auto justify-content-center">
                QRScanner AVM</div>
            <video id="camera" class="shadow"></video>
        </div>
        <div class="col-12 mb-5" id="datos">
            <div class="card rounded-5 shadow mb-5" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title" id="name">QR no válido</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <!-- <li class="list-group-item">FILA: <span id="fila" class="datos"></span></li>
                    <li class="list-group-item">ASIENTO: <span id="asiento" class="datos"></span></li> -->
                    <li class="list-group-item"><span id="estado" class="datos"></span></li>
                </ul>
            </div>
            <button id="escanear" class="btn w-100 rounded-pill p-4"
                style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);color:white">Escanear</button>
        </div>
    </section>
    <audio id="audio">
        <source src="assets/Audio/bip.wav" preload type="audio/mpeg">
    </audio>
    <audio src="assets/Audio/bip.wav"> Your browser does not support the <code>audio</code> element. </audio>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="assets/js-pluguin/instascan.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {

        var move = 0;
        setInterval(intervalo, 3000);
        $('video').css({
            border: "5px solid rgba(50,225,159,1)"
        })
        $('#marcador').fadeIn().css({
            top: "580px"
        });
        $('#marcador-titulo').fadeIn();

        function intervalo() {
            if (move == 0) {
                $('#marcador').css({
                    top: "13%"
                });
                move = 1;
            } else {
                $('#marcador').css({
                    top: "93%"
                });
                move = 0;
            }

        }
    })

    let scanner = new Instascan.Scanner({
        video: document.getElementById("camera"),
        mirror: false
    });


    scanner.addListener("scan", function(content) {
        $('#datos').fadeIn();
        $('#scanner').fadeOut();
        scanner.stop();

        $.ajax({
            url: "assets/php/proceso.php",
            type: "POST",
            data: "id=" + content,
            success: function(res) {
                if ($.trim(res) == "nodata") {
                    alert('Lo sentimos! Este CodigoQR no pertenece a este evento.');
                    $('#name').text("Este usuario no existe.");
                    $('#estado').text("NO VALIDO").removeClass(
                        'text-success text-danger text-secondary').addClass('text-secondary');
                } else {
                    var datosjson = JSON.parse(res);
                    document.getElementById('audio').play();
                    $('#name').text(datosjson.NAME + " " + datosjson.SURNAME);
                    // $('#fila').text(datosjson.FILA);
                    // $('#asiento').text(datosjson.ASIENTO);
                    if (datosjson.ESTADOQR == 1) {
                        $('#estado').text("PRESENTE EN SALA").removeClass(
                            'text-success text-danger text-secondary').addClass('text-success');
                    } else {
                        $('#estado').text("FUERA DE SALA").removeClass(
                                'text-success text-danger text-secondary')
                            .addClass('text-danger');
                    }

                }

                console.log(res);
            }
        })
    });
    $('#escanear').click(function() {
        $('#datos').fadeOut();

        scanner.start();
        $('#scanner').fadeIn();
    })
    var rotate = 1;
    generarcamara(rotate);
    $("#rotate_camera").click(function() {
        if (rotate == 1) {
            rotate = 0;
        } else {
            rotate = 1;
        }
        generarcamara(rotate);
    })

    function generarcamara(valor) {
        Instascan.Camera.getCameras()
            .then(function(cameras) {
                if (cameras.length > 1) {
                    scanner.start(cameras[valor]);
                } else {
                    resultado.innerText = "No cameras found.";
                }
            })
            .catch(function(e) {
                resultado.innerText = e;
            });
    }
    </script>
</body>

</html>