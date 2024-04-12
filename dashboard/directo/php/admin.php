<?php



session_start();

if (empty($_SESSION['id_admin_login'])) {

    header('location:login-admin.php');
}

if (isset($_GET['close'])) {
    $_SESSION['id_admin_login'] = '';
    header('location:./login-admin.php');
}
include("../../../assets/php/config.php");
$sql3 = "SELECT * FROM evento";
$resultado3 = $cnt->prepare($sql3);
$resultado3->execute();
$evento = $resultado3->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>

<html>



<head>

    <meta charset="utf-8">



    <title>DIRECTO ADMIN</title>

    <!-----------------------------------------Bootstrap css cdn----------------------------------------------------------->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/brands.min.css" rel="stylesheet">

    <!----------------------------------------------------------JQUERY------------------------------------------------------------->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://kit.fontawesome.com/372c03154c.js" crossorigin="anonymous"></script>



</head>



<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white p-0 border-bottom w-100" style="border-top: 5px solid <?php echo $evento['COLOR'] ?>">

        <div class="d-flex w-100 align-content-center">

            <a class="navbar-brand p-0 m-0"><img src="../Imagenes/headerStreaming.png" class="p-0 m-0" style="vertical-align: middle"></a>

            <div class="ms-auto" id="navbarSupportedContent">

                <div class="border-end border-start h-100 ms-auto" id="out">

                    <a class="nav-link p-3" aria-current="page" href="<?php echo $_SERVER['PHP_SELF'] . "?close=true" ?>" style="color: rgb(68, 68, 68)"><i class="fas fa-sign-out-alt"></i></a>

                </div>

            </div>

        </div>

    </nav>
    <div class="m-auto">
        <div class="h-100 d-inline-block text-center border bg-white" style="vertical-align: top; width: 49%; color:<?php echo $evento['COLOR'] ?>" id="chat_general">

            <div class="d-flex" id="button">
                <button class="btn m-2 py-1" style="background: <?php echo $evento['COLOR'] ?>;" id="close1"><i class="fas fa-times text-white"></i></button>
                <p class="btn py-1 ms-auto m-2" style="background: <?php echo $evento['COLOR'] ?>; color: white; font-size: 14px;" id='espectadores_content'><i class="fas fa-question-circle"></i> Preguntas de espectadores</p>

            </div>

            <div style="overflow-y: scroll; flex: 1 1 100%; display: block;height: 700px;" class="border-top text-center justify-content-center align-content-center" id="preguntas">

                <div class="container" id="chat">

                    <p class="p-3 text-center" style="font-size: 15px;" id="nadie">Nadie ha preguntado</p>

                </div>

            </div>

        </div>
        <div class="h-100 d-inline-block text-center border" style="vertical-align: top; width: 49%; color:<?php echo $evento['COLOR'] ?>" id="chat_general2">

            <div class="d-flex" id="button">

                <button class="btn m-2 py-1" style="background: <?php echo $evento['COLOR'] ?>;" id="close2"><i class="fas fa-align-left text-white"></i></button><span id='procesain'></span>
                <p class="btn py-1 ms-auto m-2" style="background: <?php echo $evento['COLOR'] ?>; color: white; font-size: 14px;" id='espectadores_content'><i class="fas fa-user-check"></i> Preguntas Seleccionadas</p>

            </div>

            <div style="overflow-y: scroll; flex: 1 1 100%; display: block;height: 700px;" class="border-top text-center justify-content-center align-content-center" id="preguntas">

                <div class="container" id="chat2">

                    <p class="p-3 text-center" style="font-size: 15px;" id="nadie2">Nadie ha preguntado</p>

                </div>

            </div>

        </div>
    </div>
    <!-----------------------------------------Bootstrap js cdn------------------------->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous">
    </script>

    <!------------------------------------------------VIMEO API------------------------------------------------------------>

    <script src="../js_admin.js"></script>

</body>



</html>