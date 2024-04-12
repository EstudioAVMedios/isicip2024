<?php


//Color change #064684

session_start();


error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);


error_reporting(E_ALL ^ E_NOTICE);


error_reporting(E_ERROR | E_WARNING | E_PARSE);


$respuesta;


include("../../../assets/php/config.php");


if (isset($_POST['user_name'])) {


  $name = $_POST['user_name'];


  $pass = $_POST['user_pass'];


  $sql = "SELECT * FROM admin_log";


  $resultado = $cnt->prepare($sql);


  $resultado->execute();


  $fila = $resultado->fetch(PDO::FETCH_ASSOC);


  if ($name == $fila['EMAIL'] and $pass == $fila['PASS']) {



    $_SESSION['id_admin_login'] = "Correcto";

    echo ("<script>window.location.href='admin.php'</script>");
  } else {


    $respuesta = "true";
  }
} else {
}


?>

<!doctype html>

<html>

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../Imagenes/fav.png" />
  <title>DIRECTO ADMIN</title>

  <!-----------------------------------------Bootstrap css cdn----------------------------------------------------------->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/brands.min.css" rel="stylesheet">

  <!----------------------------------------------------------JQUERY------------------------------------------------------------->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <script src="https://kit.fontawesome.com/372c03154c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>

<body style="background:#e8f6ff">
  <nav class="navbar navbar-expand-lg navbar-light bg-white p-0 border-bottom w-100" style="border-top: 5px solid #064684">
    <div class="d-flex w-100 align-content-center"> <a class="navbar-brand p-0 m-0"><img src="../Imagenes/headerStreaming.png" class="p-0 m-0" style="vertical-align: middle"></a>
      <div class="ms-auto" id="navbarSupportedContent">
        <div class="border-end border-start h-100 ms-auto" id="out"> <a class="nav-link p-3" aria-current="page" href="#" style="color: rgb(68, 68, 68)" data-bs-toggle="modal" data-bs-target="#exampleModal3"><i class="fas fa-sign-out-alt"></i></a> </div>
      </div>
    </div>
  </nav>
  <div class="w-50 m-auto">
    <form class="p-5" action="<?php echo ($_SERVER['PHP_SELF']) ?>" method="post">
      <?php


      if ($respuesta == true) {


        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' style='display: block'>Lo sentimos el usuario y contraseña no son válidos, inténtelo nuevamente.<button type='button' class='btn-close' aria-label='Close'></button></div>";
      }


      ?>
      <div class="container row text-start p-5">
        <div class="mb-3">
          <label for="formGroupExampleInput" class="form-label">Usuario</label>
          <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Escriba aquí el usuario">
        </div>
        <div class="mb-3">
          <label for="formGroupExampleInput2" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="user_pass" name="user_pass" placeholder="Escriba aquí la contraseña">
          <span toggle="#user_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn text-white" style="background: #064684">Acceder</button>
        </div>
    </form>
  </div>
  <script>
    $(".btn-close").on("click", function() {



      $(this).closest('.alert').fadeOut();



    })
  </script>
  <script src="../js_admin.js"></script>
</body>

</html>