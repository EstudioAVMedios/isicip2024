<?php

session_start();

if (empty($_SESSION['user_evento_id'])) {

    header("location:../../../../personal/");
} else {
    include("../../assets/php/config.php");
    $name = $_SESSION['user_evento_id_directo']['name'] . " " . $_SESSION['user_evento_id_directo']['surname'];
    $email = $_SESSION['user_evento_id_directo']['email'];

    $sql3 = "SELECT * FROM evento";
    $resultado3 = $cnt->prepare($sql3);
    $resultado3->execute();
    $evento = $resultado3->fetch(PDO::FETCH_ASSOC);
}

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

?>

<!doctype html>

<html>

<head>

    <meta charset="utf-8">



    <title>Directo</title>

    <!---------------bloqueo de cache------------------------------------>

    <meta http-equiv="Expires" content="0">

    <meta http-equiv="Last-Modified" content="0">

    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">

    <meta http-equiv="Pragma" content="no-cache">



    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-----------------------------------------Bootstrap css cdn----------------------------------------------------------->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/brands.min.css" rel="stylesheet">

    <!----------------------------------------------------------JQUERY------------------------------------------------------------->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://kit.fontawesome.com/372c03154c.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="css/style.css" />



    <script language="JavaScript" type="text/javascript">





    </script>



</head>

<body onclick="bPreguntar = true;">

    <nav class="navbar navbar-expand-lg navbar-light bg-white p-0 border-bottom w-100"
        style="border-top: 5px solid <?php echo $evento['COLOR'] ?>">
        <div class="d-flex w-100 align-content-center">
            <a class="navbar-brand p-0 m-0"><img src="Imagenes/headerStreaming.png" class="p-0 m-0"></a>
            <div class="ms-auto" id="navbarSupportedContent">
                <div class="border-end border-start h-100 ms-auto" id="out">
                    <a class="nav-link p-3" aria-current="page" href="#" style="color: <?php echo $evento['COLOR'] ?>"
                        data-bs-toggle="modal" data-bs-target="#exampleModal3"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
    </nav>




    <!---VIMEO---------------->
    <div style="padding:45.25% 0 0 0;position:relative; width: 80%; height: auto; vertical-align: top"
        class="d-inline-block" id="video"><iframe src="https://vimeo.com/event/4073297/embed/interaction"
            frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
            style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe></div>
    <div class="h-100 d-inline-block text-center" style="vertical-align: top; width: 19%; color:rgb(136, 136, 136)"
        id="chat_general">

        <!---WOWZA-----------
<div style="float: left; position:relative; width: 80%; height: auto; vertical-align: top" id='wowza_player'></div>
<script id='player_embed' src='//player.cloud.wowza.com/hosted/abcdef00/wowza.js' type='text/javascript'></script>
<div class="h-100 d-inline-block text-center" style="vertical-align: top; width: 20%; color:rgb(136, 136, 136)" id="chat_general">
----->



        <div class="d-flex" id="button">
            <!-- <a href='index-en.php' class="ms-3"><button class="btn py-1 ms-auto m-2"
                    style="background:<?php echo $evento['COLOR'] ?>; color: white; font-size: 14px;"><i
                        class="far fa-play-circle"></i> English </button></a> -->
            <button class="btn py-1 ms-auto m-2"
                style="background:<?php echo $evento['COLOR'] ?>; color: white; font-size: 14px;" data-bs-toggle="modal"
                data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="fas fa-plus-circle"></i> Hacer
                Pregunta</button>

        </div>



        <div style="overflow-y: scroll; flex: 1 1 100%; display: block;height: 700px;"
            class="border-top text-center justify-content-center align-content-center" id="preguntas">

            <div class="container" id="chat">
                <p class="p-3 text-center" style="font-size: 15px;color:<?php echo $evento['COLOR'] ?>" id="nadie">No
                    has realizado ninguna pregunta</p>
            </div>

        </div>



    </div>







    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Escriba su pregunta</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <form>

                        <div class="mb-3">

                            <label for="message-text" class="col-form-label">Mensaje:</label>

                            <textarea class="form-control" id="message-text"></textarea>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn" style="background: <?php echo $evento['COLOR'] ?>; color:white"
                        id="send_question" data-bs-dismiss="modal">Enviar</button>

                </div>

            </div>

        </div>

    </div>

    <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">

  Launch demo modal

</button>-->

    <div style="background:black; width: 100%; height: 100%;z-index: 1; position: absolute;top: 0; opacity: 0.7;display: none"
        id="fondo_modal"></div>

    <div class="modal" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">



                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel2"><i class="fas fa-exclamation-triangle"></i> Alerta
                    </h5>



                </div>

                <div class="modal-body">

                    ¿Sigues con nosotros?

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary border-0" data-bs-dismiss="modal" id="presente"
                        style="background: <?php echo $evento['COLOR'] ?>;">Seguir viendo <i
                            class="far fa-play-circle"></i></button>

                </div>

            </div>

        </div>

    </div>



    <!-- Modal -->

    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel3"><i class="fas fa-exclamation-triangle"></i> Alerta
                    </h5></button>

                </div>

                <div class="modal-body">

                    ¿Estas seguro que deseas abandonar el directo?

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>

                    <button type="button" class="btn text-white" style="background: <?php echo $evento['COLOR'] ?>;"
                        id="salir">Salir</button>

                </div>

            </div>

        </div>

    </div>



    <!-- Modal

<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel4" >

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel4"><i class="fas fa-door-open"></i> Bienvenida</h5>

      </div>

      <div class="modal-body">

      Hola <?php // echo $name
            ?>, te damos la bienvenida a nuestro evento<br><strong> I Encuentro sobre Obesidad.</strong>

		  Queremos trasmitirte nuestro agradecimiento por su participación y de esta forma informarle que durate el directo estaremos monitorizando su tiempo de participación.</br>

		  Un cordial saludo.

      </div>

      <div class="modal-footer">

        <button type="button" class="btn text-white" style="background: #ce2181;" id="aceptar">Aceptar</button>

      </div>

    </div>

  </div>

</div>		 -->





    <!-----------------------------------------Bootstrap js cdn------------------------->



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous">
    </script>

    <!------------------------------------------------VIMEO API------------------------------------------------------------>

    <!--<script src="https://player.vimeo.com/api/player.js"></script>-->

    <!------------------------------------------------Javascript---------------------------------------------------->

    <script src="js.js"></script>



</body>

</html>