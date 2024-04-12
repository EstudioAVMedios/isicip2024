<?php

session_start();
session_destroy();
$_SESSION['login_avm_user']="";

if($_GET['email']){
 include('../../assets/php/config.php');

	 $sql = "SELECT * FROM admin_log WHERE EMAIL=:usuario AND PASS=:pass";
    $resultado = $cnt->prepare( $sql );
    $resultado->execute( array( ":usuario" => $_GET['email'],":pass"=>$_GET['pass'] ) );
    $fila = $resultado->rowCount();
	if($fila==0){
		
		$respuesta="Lo sentimos!! La combinación de usuario y contraseña no es correcta";
	}else{
		session_start();
		$_SESSION['login_avm_user']=true;
		header("location:scanner.php");
	}
	
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
        transition: all 1s;
    }

    h1 {
        font-size: 20px;
        font-weight: 300;
        margin-top: 40px;
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
        position: relative;
        z-index: 9999999;
        top: 60px;
        transition: all 3s ease;
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
    </style>
</head>

<body>
    <div id="menu" class="container-fluid d-flex shadow"> <img src="assets/Imagenes/logo.png"
            style="height: 60px!important;margin-top: 20px;">
        <h1 class="text-white"> QRScanner AVM</h1>
    </div>
    <section class="container mt-5">
        <div class='border rounded-5 shadow mt-4'>
            <form class="p-3" method="get" action="<?php echo $_SERVER['PHP_SELF']?>">
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput">Correo electrónico</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="pass" class="form-control" id="floatingPassword"
                        placeholder="Password">
                    <label for="floatingPassword">Contraseña</label>
                </div>
                <p><?php echo $respuesta; ?></p>
                <button type="submit" class="btn w-100 rounded-pill p-4 mt-5"
                    style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);color:white">Acceder</button>
            </form>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>