<?php

session_start();

if ( !empty( $_SESSION[ 'log_user_id' ] ) ) {

    $name = $_SESSION[ 'log_user_data' ];
    $correo = $_SESSION[ 'log_user_id' ];
    $key = $_SESSION[ 'code_id' ];

    include( "../../php/config.php" );

    $sql = "SELECT * FROM session WHERE CODE=:code";
    $resultado = $cnt->prepare( $sql );
    $resultado->execute( array( ":code" => $key ) );
    $fila = $resultado->rowCount();
    if ( $fila == 0 ) {
        header( "location:../../index.php?key=false" );
    }

} else {

    header( "location:../../index.php" );

}
$sql = "SELECT * FROM form WHERE email=:id";
$resultado = $cnt->prepare( $sql );
$resultado->execute( array( ":id" => $correo ) );
$fila2 = $resultado->fetch( PDO::FETCH_ASSOC );

header( "Cache-Control: no-cache, must-revalidate" ); // HTTP/1.1

header( "Expires: Sat, 1 Jul 2000 05:00:00 GMT" ); // Fecha en el pasado

?>

<!doctype html>

<html>

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../../Imagenes/genericas/logo.png" />
    <title>Streaming</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---------------bloqueo de cache------------------------------------>

    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <!-----------------------------------------Bootstrap css cdn----------------------------------------------------------->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/brands.min.css" rel="stylesheet">

    <!----------------------------------------------------------JQUERY------------------------------------------------------------->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/372c03154c.js" crossorigin="anonymous"></script>
    <style>
    :root {
        --bg-color: #12A3A8;
    }

    body {
        font-family: 'Exo 2', sans-serif;
    }

    ::selection {
        background: var(--bg-color);
        color: white;
    }

    @media(max-width:1300px) {
        nav {
            display: none;
        }

        #video {
            width: 100%;
        }
    }

    ::placeholder {
        color: rgba(191, 191, 191, 1.00);
        font-size: 14px;
    }

    input:focus {
        border
    }

    .dropdown-item:focus {
        background: var(--bg-color);
    }
    </style>
    <script language="JavaScript" type="text/javascript"></script>
</head>

<body onclick="bPreguntar = true;">
    <nav class="navbar navbar-expand-lg navbar-light bg-white p-0 border-bottom w-100 align-content-center"
        style="border-top: 5px solid var(--bg-color)">
        <div class="d-flex w-100 align-content-center"> <a class="navbar-brand w-100 p-0 m-0" id="brand-navbar"><img
                    src="../../Imagenes/directo/headerStreaming.png" class="p-0" style="height: 60px"></a>

            <div class="ms-auto" id="navbarSupportedContent">
                <div class="border-end border-start h-100 ms-auto pt-3" id="out">
                    <div class="btn-group mx-4" id="user">
                        <button class="btn btn-light btn-sm dropdown-toggle border-0" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="background-color: var(--bg-color);color: white"> <i class="fas fa-reply-all"></i> <i
                                class="fas fa-user"></i>
                            <!--<span><?php echo $correo ?></span>-->
                        </button>
                        <ul class="dropdown-menu p-2 m-2">
                            <li><a class="dropdown-item p-2" data-bs-toggle="modal" data-bs-target="#exampleModal3"
                                    data-bs-whatever="@mdo"><i class="fas fa-sign-out-alt"></i>Exit the Streaming</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div style="padding:45.25% 0 0 0;position:relative; width: 40%!important; height: auto; vertical-align: top"
        class="d-inline-block" id="video">
        <iframe src="https://vimeo.com/event/3761356/embed" frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
            style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
    </div>

    <div class="h-100 d-inline-block text-center" style="vertical-align: top; color:rgb(136, 136, 136)"
        id="chat_general">
        <!-- <a class="btn py-1 ms-auto m-2" style="background:var(--bg-color); color: white; font-size: 14px;" href="https://vimeo.com/event/2275909/embed" id="2opt">If you are having problems with the streaming click here</a>-->
        <div class="d-flex" id="button">

            <button class="btn py-1 ms-auto m-2" style="background:var(--bg-color); color: white; font-size: 14px;"
                data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i
                    class="fas fa-plus-circle"></i>Ask a question</button>
        </div>
        <div style="overflow-y: scroll; flex: 1 1 100%; display: block;height: 700px;"
            class="border-top text-center justify-content-center align-content-center" id="preguntas">
            <div class="container" id="chat">
                <p class="p-3 text-center" style="font-size: 15px;" id="nadie">Ask the speaker something</p>
            </div>
        </div>
    </div>
    <div class="h-100 d-inline-block text-center" style="vertical-align: top; color:rgb(136, 136, 136)"
        id="chat_general">
        <div class="d-flex" id="button">

        </div>

    </div>




    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Write your question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Question:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="background: var(--bg-color); color:white"
                        id="send_question" data-bs-dismiss="modal">Send</button>
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
                <div class="modal-body"> ¿Sigues con nosotros? </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary border-0" data-bs-dismiss="modal" id="presente"
                        style="background: var(--bg-color);">Seguir viendo <i class="far fa-play-circle"></i></button>
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
                    </h5>
                    </button>
                </div>
                <div class="modal-body"> ¿Estas seguro que deseas abandonar el directo? </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                    <button type="button" class="btn text-white" style="background: var(--bg-color);"
                        id="salir">Salir</button>
                </div>
            </div>
        </div>
    </div>



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


    <script src="../../assets/js/js.js"></script>

</body>

</html>