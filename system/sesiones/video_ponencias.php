<?php

session_start();

if ( !empty( $_SESSION[ 'log_user_id' ] ) ) {

  $name = $_SESSION[ 'log_user_data' ];
  $correo = $_SESSION[ 'log_user_id' ];
  $key = $_SESSION[ 'code_id' ];

  include( "../../php/config.php" );

  $sql2 = "SELECT * FROM session WHERE CODE=:code";
  $resultado2 = $cnt->prepare( $sql2 );
  $resultado2->execute( array( ":code" => $key ) );
  $fila2 = $resultado2->rowCount();
  if ( $fila2 == 0 ) {
    header( "location:../index.php?key=false" );
  }

} else {

  header( "location:../index.php" );

}

 $sql = "SELECT * FROM video WHERE TITLE=:video";
  $resultado = $cnt->prepare( $sql );
  $resultado->execute( array( ":video" => $_GET['video'] ) );
  $fila = $resultado->fetch(PDO::FETCH_ASSOC);

$sql4 = "SELECT * FROM webinar WHERE EMAIL=:email AND TITLE=:title";
  $resultado4 = $cnt->prepare( $sql4 );
  $resultado4->execute( array( ":email" => $correo,":title"=>$_GET['video']));
  $fila4 = $resultado4->rowCount();

if($fila4==0){
	$sql3 = "INSERT INTO webinar (TITLE, NAME, EMAIL) VALUES (:title, :name, :email)";
  $resultado3 = $cnt->prepare( $sql3 );
  $resultado3->execute( array( ":title" => $_GET['video'], ":name"=>$name, ":email"=>$correo) );

}


 
	

header( "Cache-Control: no-cache, must-revalidate" ); // HTTP/1.1

header( "Expires: Sat, 1 Jul 2000 05:00:00 GMT" ); // Fecha en el pasado

?>

<!doctype html>

<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="../../Imagenes/genericas/logo.png" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!---------------------------------------------bloqueo de cache--------------------------------------------------->

<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">
<title></title>

<!-----------------------------------------------------------Bootstrap css cdn----------------------------------------------------------->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/brands.min.css" rel="stylesheet">


<!-----------------------------------------------------------------jquery js cdn----------------------------------------------------------> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<script src="https://kit.fontawesome.com/372c03154c.js" crossorigin="anonymous"></script> 

<!----------------------------------------------------------------jcss-----------------------------------------------------------------> 

<script src="../../js/pagina/video.js"></script>
<style>

:root {
--bg-color:#12A3A8;
}
</style>
</head>

<body  id="contenedor">

<!-------------------------boton arriba---------------------------------------------------> 



<!-----------------------------------------Menu Logos y Redes------------------------------------->

<div class="w-100 bg-white m-0 p-0" style="z-index: 10001;">
  <div class="container text-end">
    <div class="p-1">
      <div class="btn-group mx-4" id="user1">
        <button class="btn btn-light btn-sm dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: var(--bg-color);color: white"> <i class="fas fa-user"></i> <?php echo $correo ?> </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</a> <?php echo $video?></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-----------------------------------------Menu Navegacion------------------------------------->

<nav class="navbar navbar-expand-lg navbar-light  bg-white">
  <div class="container-fluid">
    <div class="bg-white">
      <div class="container"> <a href="#"><img  class="my-3" src="../../assets/images/logo-dark.png" style="height: 70px;"></a> </div>
    </div>

    <div class="container">
      <div class="collapse navbar-collapse" id="navbarNav" style="vertical-align: middle">
        <ul class="navbar-nav py-2 ms-auto" >
          <li>
            <div class="nav-link h6" id="video_name"><?php echo $_GET['video']?></div>
          </li>
          <li class="nav-item mx-2 px-2 rounded py-0 my-0"> <a class="nav-link active  h6" aria-current="page"  href="sessions.php" id="menu"><i class="fa fa-reply-all"></i> Go back to Webinars</a> </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<!------------------------------------------Preguntas--------------------------------------------->

<section class='container m-auto text-center'>
	<div class='m-auto w-100 text-center mt-3'>

        <div style="padding:56.25% 0 0 0;position:relative; width: 100%; height: auto; vertical-align: top" class="shadow d-inline-block" id="video">
          <iframe src="<?php echo $fila['URL'];?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
        </div>
	</div>

</section>

<!------------------------------------call to action-----------------------------------> 

<!-----------------------------------------Bootstrap js cdn-------------------------> 

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> 

<!-----------------------------------------js cdn-----------------------------------> 

<script src="../../assets/js/all.js"></script> 
<script src="../../assets/js/logout.js"></script> 
<script src="../../assets/js/content _video.js"></script>
</body>
</html>