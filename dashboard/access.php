<?php

	
session_start();

if($_GET['pass'] and $_GET['user']){

include( "../assets/php/config.php" );
$usuarios=[];

$sql3 = "SELECT * FROM admin_log WHERE EMAIL = :email AND PASS=:pass";

$resultado3 = $cnt->prepare( $sql3 );

$resultado3->execute(array(":email"=>$_GET['user'],":pass"=>$_GET['pass']));
$fila=$resultado3->rowCount();
$fila2=$resultado3->fetch(PDO::FETCH_ASSOC);
if($fila!=0){
if($fila2['CATEGORIA']=="ADMIN"){
$_SESSION['id_admin_login']=true;
	header("location:user.php");
	echo("<script>window.location.href='user.php'</script>");	
}else{
$_SESSION['id_admin_login2']=true;
	header("location:generales.php");
	echo("<script>window.location.href='generales.php'</script>");	
}
	
}else{
	$res=false;
}
		

}
?>

<!doctype html>

<html lang="en">

<head>
    <title>Dashboard INICIO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="Imagenes/logo_white.png" type="image/x-icon">
    <!---------------bloqueo de cache------------------------------------>

    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/372c03154c.js" crossorigin="anonymous"></script>
    <style>
    #show {
        background: white;
        color: #343a40;
    }

    #show:hover {
        background: #343a40;
        color: white;
    }
    </style>
</head>

<body>
    <div class="d-block">
        <nav class="navbar navbar-expand-lg navbar-light position-fixed w-100 shadow-sm"
            style="z-index: 2;top:0px; background:linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);">

            <h1><a href="index.html" class="logo"><img src="Imagenes/logo_white.png" class="me-auto px-5 mx-5"
                        style='height: 70px'></a></h1>
            <div class="d-flex ms-auto" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto px-5">
                </ul>

            </div>

        </nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-light position-fixed w-100 shadow-sm"
            style="top:90px;height: 70px;z-index: 1">
            <div class="container">


                <div class="d-flex ms-auto" id="navbarNavDropdown">

                </div>
            </div>
        </nav>
    </div>

    <div id="total_users" style="z-index: 0;margin-top:200px" class="d-block">
        <div class="container">
            <div class="bg-white shadow-sm rounded-3 p-5 m-auto w-50">
                <?php if($res===false){
echo "<div class='alert alert-secondary' role='alert'>Lo sentimos pero el usuario o contraseña no son correctos. <b>Inténtelo nuevamente". $res."</b>.</div>";
}
	?>

                <form class="row g-3 m-auto w-100" action="<?php $_SESSION['PHP_SELF']?>">
                    <div class="mb-3 col-12">
                        <label for="exampleFormControlInput1" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control border " id="exampleFormControlInput2"
                            placeholder="name@example.com" name="user" required>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="exampleFormControlInput1" class="form-label">Contraseña</label>
                        <input type="password" class="form-control border " id="exampleFormControlInput1"
                            placeholder="name@example.com" name="pass" required>
                        <p style="margin-top: -30px; width: 20%;cursor:pointer"
                            class="border rounded-pill text-center ms-auto me-2" id="show">Mostrar</p>
                    </div>
                    <div class="form-control col-6 border-0">
                        <button class="ov-btn-slide-left">Enviar <i class="far fa-paper-plane"></i></button>

                    </div>
                </form>

            </div>
        </div>

        <!----------------------------------MODAL---------------------------------------------->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" style="z-index:5">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal YES NO ACVTIVAR -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Activar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás segur@ de que deseas activar a este usuario <br><span class="badge bg-dark p-1"
                            id='modal_email'>EMAIL</span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-dark" id='send_active'>Si estoy segur@</button>
                    </div>
                </div>
            </div>
        </div>
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
        <script src="js/dashboard_user.js"></script>
</body>

</html>