<?php


header("location:access.php");
session_start();

if($_GET['cerrar']==true){
	$_SESSION['id_admin_login']="";
	
}
if(!empty($_SESSION['id_admin_login'])){

include( "../php/config.php" );

	
}else{
	session_destroy();
	header("location:access.php");
}

header( "Cache-Control: no-cache, must-revalidate" ); // HTTP/1.1

header( "Expires: Sat, 1 Jul 2000 05:00:00 GMT" ); // Fecha en el pasado


?>

<!doctype html>

<html lang="en">
<head>
<title>Dashboard INICIO</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!---------------bloqueo de cache------------------------------------>

<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<script src="https://kit.fontawesome.com/372c03154c.js" crossorigin="anonymous"></script>
</head>

<body>
<div  class="position-fixed top-0">
<nav class="navbar navbar-expand-lg navbar-light bg-dark position-fixed w-100" style="z-index: 2">

  <h1><a href="index.html" class="logo"><img src="../Imagenes/genericas/logo_white.png" class="me-auto px-5 mx-5" style='height: 70px'></a></h1>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto px-5">
        <li class="nav-item"> <a class="nav-link  text-white" href="index.php"><i class="fas fa-tools"></i> Panel de Administración</a> </li>
        <li class="nav-item"> <a class="nav-link  text-white" href="user.php"><i class="fas fa-users"></i> Users</a> </li>
		  <li class="nav-item"> <a class="nav-link  text-white" href="user.php?cerrar=true"><i class="fas fa-power-off"></i> Salir</a> </li>
      </ul>
    </div>

</nav>
</div>
<div class='position-fixed'style='top:0px;'>
  <nav id="sidebar" class="bg-none " style="z-index: 1; width: 120px;">
    <div class="bg-dark h-100" style="width: 140px">
      <ul class="list-unstyled components mb-5" style='margin-top: 80px; padding-top:50px;height: 100%!important;padding-bottom:100px;' >
        <li class="active p-3 text-center" id="style"> <i class="fas fa-paint-brush" style='font-size:30px;'></i><br> Evento </li>
        <li id="form" class="p-3 text-center" > <i class="far fa-check-square" style='font-size:30px;'></i><br> Form </li>
        <li id="inicio" class="p-3 text-center"> <i class="fas fa-home" style='font-size:30px;'></i><br> Inicio </li>
        <li id="programa" class="p-3 text-center"> <i class="far fa-calendar-plus" style='font-size:30px;'></i><br> Programa </li>
        <li id="ponentes" class="p-3 text-center" > <i class="fas fa-users" style='font-size:30px;'></i><br> Ponentes </li>
        </li>
        <li id="videos" class="p-3 text-center" > <i class="fas fa-video " style='font-size:30px;'></i><br> Videos </li>
        </li>
        <li id="preguntas" class="p-3 text-center"> <i class="fas fa-question-circle" style="font-size: 30px;"></i><br> Preguntas </li>
        <li id="patrocinio" class="p-3 text-center"> <i class="far fa-flag" style='font-size:30px;'></i><br> Patrocinadores </li>
        
      </ul>
    </div>
  </nav>
</div>
  <div class="wrapper d-flex align-items-stretch ms-5 ps-5">
  <!-- Page Content  -->
  
  <div id="content" class="p-4 p-md-5 pt-5 container">
    <form id="form_style" method="post" action="php/connect.php" enctype="multipart/form-data" class="p-3 d-none row">
      <div class="py-5">
        <h2><i class="fas fa-paint-brush"></i> Evento</h2>
      </div>
      <div class="input-group mb-3"> <span class="input-group" id="basic-addon1" >Color corporativo</span>
        <input type="text" class="form-control" name="color" value="#32e19f" id='color_evento'>
      </div>
      <div class="input-group mb-3"> <span class="input-group" id="basic-addon1" >Nombre del Evento</span>
        <input type="text" class="form-control "  name="titulo" id="titulo">
      </div>
      <div class="input-group mb-3 ">
        <label class="input-group" for="inputGroupFile01" >Logo</label>
        <input type="file" class="form-control form-control-lg" name="logo">
      </div>
      <div class="input-group mb-3">
        <label class="input-group" for="inputGroupFile01" >Header</label>
        <input type="file" class="form-control form-control-lg" name="header">
      </div>
      <div class="input-group mb-3">
        <label class="input-group" for="inputGroupFile01" >Fondo</label>
        <input type="file" class="form-control form-control-lg" name="fondo">
      </div>
      <div class="input-group col-4 mb-3">
        <label class="input-group" for="inputGroupFile01" >Fecha Inicio</label>
        <input type="date" class="form-control  form-control-sm" name="startdate" id="startdate">
      </div>
      <div class="input-group col-4 mb-3">
        <label class="input-group" for="inputGroupFile01" >Fecha Cierre</label>
        <input type="date" class="form-control  form-control-sm" name="finishdate" id="finishdate">
      </div>
      <div class='input-group w-100'>
        <button class="btn btn-primary col-md-4 my-4 rounded-3" id="style" type="submit">Enviar <i class="fas fa-paper-plane"></i></button>
        <button class="btn btn-light col-md-2 my-4 rounded-3 ms-auto descartar" id="descartar" type="button" >Descartar</button>
      </div>
    </form>
    
    <!----------------------------------------------INDEX-------------------------------------------------------------------->
    
    <form id="form_inicio" method="post" action="php/connect_index.php" enctype="multipart/form-data" class="p-3 row">
      <div class="py-5 d-flex">
        <h2><i class="fas fa-home"></i> Contenido de Inicio</h2>
      </div>
      <div class="input-group mb-3 col-md-10"> <span class="input-group" id="basic-addon1" >Título</span>
        <input type="text" class="form-control border" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="titulo">
      </div>
      <div class="input-group w-100 mb-3 col-md-10"> <span class="input-group  w-100">Texto de Bienvenida</span>
        <textarea class="overflow-scroll w-100 border"  name="texto" style="height: 100px;" aria-label="With textarea" maxlength="1000" id="texto_inicio"></textarea>
        <p class="text-muted character_counter" ></p>
      </div>
      <div class="input-group mb-3 col-md-4"> <span class="input-group" id="basic-addon1" >Firma</span>
        <input type="text" class="form-control border" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="firma">
      </div>
      <div class="input-group mb-3  col-md-6">
        <label class="input-group" for="inputGroupFile01" >Imagen</label>
        <input type="file" class="form-control form-control-lg border" name="imagen1">
      </div>
      <div class="input-group mb-3 w-100">
        <button class="btn btn-primary col-md-4 my-4 rounded-3" id="style" type="submit">Enviar <i class="fas fa-paper-plane"></i></i></button>
        <button class="btn btn-light col-md-2 my-4 rounded-3 ms-auto descartar" id="descartar" type="button" >Descartar</button>
      </div>
    </form>
    
    <!----------------------------------------------REGISTROS-------------------------------------------------------------------->
    
    <form id="form_form" method="post" action="php/connect_index.php" class="p-3 row text-center">
      <div class="py-5 d-flex text-start">
        <h2><i class="far fa-check-square"></i> Formulario de registro</h2>
      </div>
      <div class="form-check form-switch col-form-label-lg  col">
        <input class="form-check-input" type="checkbox" id="Nombre">
        <label class="form-check-label" for="Nombre">Nombre</label>
      </div>
      <div class="form-check form-switch col-form-label-lg col">
        <input class="form-check-input" type="checkbox" id="Apellidos">
        <label class="form-check-label" for="Apellidos">Apellidos</label>
      </div>
      <div class="form-check form-switch col-form-label-lg col">
        <input class="form-check-input" type="checkbox" id="Email">
        <label class="form-check-label" for="Email">Email</label>
      </div>
      <div class="form-check form-switch col-form-label-lg col">
        <input class="form-check-input" type="checkbox" id="Código">
        <label class="form-check-label" for="Código">Código</label>
      </div>
      <div class="form-check form-switch col-form-label-lg col">
        <input class="form-check-input" type="checkbox" id="Password">
        <label class="form-check-label" for="Password">Password</label>
      </div>
      <div class="input-group w-50">
        <button class="btn btn-primary col-md-4 my-4 rounded-3" id="style" type="submit">Enviar <i class="fas fa-paper-plane"></i></button>
      </div>
    </form>
    
    <!----------------------------------------------PROGRAMA-------------------------------------------------------------------->
    
    <form id="form_programa" method="post" action="php/connect_programa.php" enctype="multipart/form-data" class="p-3 row h-50 mt-4">
      <div class="py-5 d-flex">
        <h2><i class="far fa-calendar-plus"></i> Programa</h2>
        <div class="input-group ms-auto mb-3 col-md-4">
          <button type="button" class="btn btn-secondary ms-auto" data-bs-toggle="modal" data-bs-target="#programa_modal"> Ver Programa </button>
        </div>
      </div>
      <div class="alert alert-warning alert-dismissible" role="alert" style="display: none" id="alerta_programa"> <strong>Antención!</strong> Todos los campos son obligatorios.
        <button type="button" class="btn-close"></button>
      </div>
      <div class="input-group mb-3" id="check_fecha"> </div>
      <div class="input-group mb-3 col-md-4"> <span class="input-group" id="basic-addon1" >Título</span>
        <input type="text" class="form-control border form-control-sm" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="titulo_p" id="titulo_programa"  required>
      </div>
      <div class="input-group mb-3 col-md-4"> <span class="input-group" id="basic-addon1" >Hora Inicio</span>
        <input type="time" class="form-control border form-control-sm" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="h_inicio" id="h_inicio_programa" required>
      </div>
      <div class="input-group mb-3 col-md-4"> <span class="input-group" id="basic-addon1" >Hora Finalización</span>
        <input type="time" class="form-control border form-control-sm" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="h_final" id="h_final_programa" required>
      </div>
      <div class="input-group mb-3 col-md-2"> <span class="input-group" id="basic-addon1" >ID</span>
        <input type="text" class="form-control border form-control-sm" placeholder="Id" name="id" id="id_programa_input" disabled  required>
      </div>
      <div class="input-group w-100"> <span class="input-group  w-100">Descripción</span>
        <textarea class="overflow-scroll w-100 border"  name="texto" style="height: 100px;" id="texto_programa" maxlength="500" required ></textarea>
        <p class="text-muted character_counter" ></p>
      </div>
      <div class="input-group w-100">
        <button class="btn btn-primary col-md-4 my-4 rounded-3" type="button" id="enviar_programa">Enviar <i class="fas fa-paper-plane"></i></button>
        <button class="btn btn-light col-md-2 my-4 rounded-3 ms-auto descartar" id="descartar" type="button" >Descartar</button>
      </div>
      
      <!-- Modal -->
      
      <div class="modal fade" id="programa_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="programa_modalLabel" aria-hidden="true" style="z-index: 1000000001">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="programa_modalLabel">Programa</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="input-group w-100">
                <table class='table table-striped table-bordered table-sm table-hover' cellspacing='0'

  width='100%' >
                  <thead>
                    <tr class='text-center'>
                      <th class='th-sm'>No</th>
                      <th class='th-sm'>Titulo</th>
                      <th class='th-sm'>Texto</th>
                      <th class='th-sm'>Inicio</th>
                      <th class='th-sm'>Fin</th>
                      <th class='th-sm'>Fecha</th>
                      <th class='th-sm'>Editar</th>
                      <th class='th-sm'>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody id='table_programa'>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    
    <!----------------------------------------------PONENTES-------------------------------------------------------------------->
    
    <form id="form_ponentes" method="post"  enctype="multipart/form-data" class="p-3 row h-50 mt-4">
      <div class="py-5 d-flex">
        <h2><i class="fas fa-users"></i> Ponentes</h2>
        <div class="input-group mb-3 col-md-3 ms-auto">
          <button type="button" class="btn btn-secondary ms-auto" data-bs-toggle="modal" data-bs-target="#ponentes_modal"> Ver Ponentes <span class="badge bg-dark" id="nom_ponentes">0</span> </button>
        </div>
      </div>
      <div class="alert alert-warning alert-dismissible" role="alert" style="display: none" id="alerta_ponente" required> <strong>Antención!</strong> Todos los campos son obligatorios.
        <button type="button" class="btn-close"></button>
      </div>
      <div class="input-group w-100">
        <div class='form-group border mb-3 col-md-2'>
          <div class="form-check form-switch m-2">
            <input class="form-check-input" type="radio" name="rol_p" id="rol_p"  checked required value="Ponente">
            <label class="form-check-label" for="flexRadioDefault1"> Ponente </label>
          </div>
        </div>
        <div class='form-group border mb-3 col-md-2'>
          <div class="form-check form-switch m-2">
            <input class="form-check-input" type="radio" name="rol_p" id="rol_p2"required value="Comite">
            <label class="form-check-label" for="flexRadioDefault2"> Comité </label>
          </div>
        </div>
        <div class="input-group mb-3 col-md-4"  id="ctype_select" style="display: none"> <span class="input-group" id="basic-addon1" >Categoría comité</span>
          <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" id="comitetype_p" name='comitetype_p' required>
            <option selected>Elija categoría...</option>
            <option >Local Committee</option>
            <option >Scientific Committee</option>
            <option >Organizating Committee</option>
            <option >Otros</option>
          </select>
        </div>
      </div>
      <div class="input-group mb-3 col-md-4"> <span class="input-group" id="basic-addon1" >Contenido</span>
        <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" id="titulo_p" name='titulo_p' required>
          <option selected>...</option>
          <option >Dr.</option>
          <option >Dra.</option>
          <option >Prof.</option>
          <option >Profa.</option>
          <option >Mr.</option>
          <option >Ms.</option>
        </select>
      </div>
      <div class="input-group mb-3 col-md-4"> <span class="input-group" id="basic-addon1" >Nombre</span>
        <input type="text" class="form-control border form-control-sm"  aria-label="Username"  name="nombre_p" id="nombre_p" required>
      </div>
      <div class="input-group mb-3 col-md-4"> <span class="input-group" id="basic-addon1" >Apellidos</span>
        <input type="text" class="form-control border form-control-sm"  aria-label="Username"  name="apellidos_p" id="apellidos_p" required>
      </div>
      <div class="input-group mb-3 col-md-4"> <span class="input-group" id="basic-addon1" >Cargo</span>
        <input type="text" class="form-control border" aria-label="Username"  name="cargo_p" id="cargo_p" required>
      </div>
      <div class="input-group mb-3 col-md-4"> <span class="input-group" id="basic-addon1" >Empresa</span>
        <input type="text" class="form-control border form-control-sm"  aria-label="Username"  name="empresa_p" id="empresa_p" required>
      </div>
      <div class="input-group mb-3 col-md-4"> <span class="input-group" id="basic-addon1" >Pais</span>
        <input type="text" class="form-control border" aria-label="Username"  name="pais_p" id="pais_p" required>
      </div>
      <div class="input-group mb-3 col-md-4"> <span class="input-group" id="basic-addon1" >Linkedin</span>
        <input type="text" class="form-control border" aria-label="Username"  name="linkedin_p" id="linkedin_p" required>
      </div>
      <div class="input-group mb-3 col-md-4"> <span class="input-group" id="basic-addon1" >Email@</span>
        <input type="email" class="form-control border form-control-sm"   name="email_p" id="email_p" required>
      </div>
      <div class="input-group mb-3 col-md-4">
        <label class="input-group form-label" for="inputGroupFile01" >Foto</label>
        <input type="file" class="form-control form-control-lg" name="foto_p" id="foto_p">
      </div>
      <div class="input-group w-100"> <span class="input-group  w-100">Biografía</span>
        <textarea class="overflow-scroll w-100 border form-control-sm"  name="bio_p" style="height: 100px;" id="biografia" maxlength="7500" id="bio_p" required>
        </textarea>
        <p class="text-muted character_counter" >0 / 7500</p>
      </div>
      <div class="input-group mb-3 col-md-3 me-auto">
        <button type="button" class="btn btn-secondary me-auto" data-bs-toggle="modal" data-bs-target="#ponentes_modal_programa"> Agregar al Programa </button>
      </div>
      <div class="input-group mb-3">
        <button class="btn btn-primary col-md-4 my-4 rounded-3" type="button" id="enviar_ponente">Enviar <i class="fas fa-paper-plane"></i></button>
        <button class="btn btn-light col-md-2 my-4 rounded-3 ms-auto descartar" id="descartar" type="button" >Descartar</button>
      </div>
      
      <!-- Modal -->
      
      <div class="modal fade" id="ponentes_modal_programa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ponentes_modal_programaLabel" aria-hidden="true" style="z-index: 1000000001">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ponentes_modal_programaLabel">Ponentes</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id='fechas_programa_ponente'></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Agregar</button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Modal -->
      
      <div class="modal fade" id="ponentes_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ponentes_modalLabel" aria-hidden="true" style="z-index: 1000000001">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ponentes_modalLabel">Ponentes</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="input-group w-100">
                <table class='table table-striped table-bordered table-sm table-hover' cellspacing='0'

  width='100%' >
                  <thead>
                    <tr class='text-center'>
                      <th class='th-sm'>Nombre</th>
                      <th class='th-sm'>Apellidos</th>
                      <th class='th-sm'hidden>Cargo</th>
                      <th class='th-sm' hidden>Título</th>
                      <th class='th-sm'>Empresa</th>
                      <th class='th-sm'hidden>Pais</th>
                      <th class='th-sm'hidden>Linkedin</th>
                      <th class='th-sm'>email</th>
                      <th class='th-sm'hidden>Bio</th>
                      <th class='th-sm'hidden>C Type</th>
                      <th class='th-sm'>Editar</th>
                      <th class='th-sm'>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody id='table_ponentes'>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    
    <!----------------------------------------------Videos------------------------------------------------------------------->
    
    <form id="form_videos" method="post"  enctype="multipart/form-data" class="p-3 h-50 mt-4 row">
      <div class="py-5 d-flex">
        <h2><i class="fas fa-video"></i> Videos</h2>
        <div class="input-group mb-3 col-md-3 ms-auto">
          <button type="button" class="btn btn-secondary ms-auto" data-bs-toggle="modal" data-bs-target="#video_modal"> Ver videos <span class="badge bg-dark p-1" id="nom_videos">0</span> </button>
        </div>
      </div>
      <div class="input-group mb-3 col-md-5"> <span class="input-group" id="basic-addon1" >Título</span>
        <input type="text" class="form-control border form-control-sm"  aria-label="Username"  name="titulo_v" id="titulo_v" required>
      </div>
      <div class="input-group mb-3 col-md-5"> <span class="input-group" id="basic-addon1" >URL - Vimeo</span>
        <input type="text" class="form-control border form-control-sm"  aria-label="Username"  name="url_v" id="url_v" required>
      </div>
      <div class="input-group mb-3 col-md-5"> <span class="input-group" id="basic-addon1" >Videos</span>
        <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" id="video_name" name='video_name' required>
          <option selected>Elija el video...</option>
          <?php

          foreach ( $videos as $elemento ) {

            if ( $elemento != "."
              or $elemento != ".." ) {

              echo "<option>" . $elemento . "</option>";

            }

          }


          ?>
        </select>
      </div>
      <div class="input-group mb-3 col-md-5"> <span class="input-group" id="basic-addon1" >Contenido</span>
        <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" id="contenido_v" name='contenido_v' required>
          <option selected>Elija el contenido...</option>
          <option >A la Carta</option>
          <option >Sesiones</option>
        </select>
      </div>
      <div class="input-group mb-3 col-md-6">
        <label class="input-group" for="inputGroupFile01" >Miniatura</label>
        <input type="file" class="form-control form-control-lg border" name="video" id="video" >
      </div>
      <div class="input-group mb-3 col-md-2">
        <label class="input-group" for="inputGroupFile01" >Duración horas</label>
        <input type="number" class="form-control border horas" name="video_h" id="video_h" value='0'>
      </div>
      <div class="input-group mb-3 col-md-2">
        <label class="input-group" for="inputGroupFile01">Duración minutos</label>
        <input type="number" class="form-control border minutos" name="video_m" id="video_m" value='0'>
      </div>
      <div class="input-group mb-3 col-md-10"> <span class="input-group" id="basic-addon1" >Ponentes</span>
        <select class="form-select form-select-md mb-3"  id="videos_ponente" name='videos_ponente'>
          <option selected>Elija ponentes...</option>
        </select>
      </div>
      <div class="input-group mb-3 col-md-9" id="seleccion_ponente"> </div>
      <div class="input-group mb-3 col-md-9">
        <button class="btn btn-primary col-md-4 my-4 rounded-3" type="button" id="enviar_video">Enviar <i class="fas fa-paper-plane"></i></button>
        <button class="btn btn-light col-md-2 my-4 rounded-3 ms-auto descartar" id="descartar" type="button" >Descartar</button>
      </div>
      <div class="input-group mb-3 col-md-6"> </div>
      
      <!-- Modal -->
      
      <div class="modal fade" id="video_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="video_modalLabel" aria-hidden="true" style="z-index: 1000000001">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="video_modalLabel">Ponentes</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="input-group w-100">
                <table class='table table-striped table-bordered table-sm table-hover' cellspacing='0'

  width='100%' >
                  <thead>
                    <tr class='text-center'>
                      <th class='th-sm'>Nombre</th>
                      <th class='th-sm' hidden>Video</th>
                      <th class='th-sm'>Contenido</th>
                      <th class='th-sm'hidden>Miniatura</th>
                      <th class='th-sm'>Horas</th>
                      <th class='th-sm'>Minutos</th>
                      <th class='th-sm'>Ponentes</th>
                      <th class='th-sm'>Editar</th>
                      <th class='th-sm'>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody id='table_video'>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    
    <!----------------------------------------------POLLING------------------------------------------------------------------->
    
    <form id="form_poll" method="post"  enctype="multipart/form-data" class="p-3 h-50 mt-4 row">
      <div class="d-flex py-5">
        <h2><i class="fas fa-question-circle"></i> Preguntas </h2>
        <div class="input-group mb-3 col-md-3 ms-auto">
          <button type="button" class="ms-auto btn btn-secondary py-0" data-bs-toggle="modal" data-bs-target="#pregunta_modal"> Ver preguntas <span class="badge bg-dark p-1" id="nom_preguntas">0</span> </button>
        </div>
      </div>
      <div class="alert alert-warning alert-dismissible" role="alert" style="display: none" id="alerta_poll" required> <strong>Antención!</strong> Todos los campos son obligatorios.
        <button type="button" class="btn-close"></button>
      </div>
      <div class="input-group mb-3 col-md-10"> <span class="input-group" id="basic-addon1" >Pregunta</span>
        <input type="text" class="form-control border form-control-sm"  name="poll" id="poll" required>
      </div>
      <div class="input-group mb-3 col-md-6 mb-3" id="respuestas"> <span class="input-group respuesta" id="basic-addon1" >Respuesta 1</span>
        <input type="text" class="form-control border form-control-sm mb-3 respuesta_input"  name="respuesta_1" id="respuesta_1" required>
        <span class="input-group respuesta" id="basic-addon1" >Respuesta 2</span>
        <input type="text" class="form-control border form-control-sm mb-3 respuesta_input"  name="respuesta_2" id="respuesta_2" required>
      </div>
      <div class="input-group mb-3 col-md-9">
        <button class="btn btn-secondary col-md-4 my-4 rounded-3 mx-1" type="button" id="add_poll">Agregar Respuesta +</button>
        <button class="btn btn-warning col-md-4 my-4 rounded-3 mx-1" id="less_poll" type="button" >Quitar última respuesta -</button>
      </div>
      <div class="input-group mb-3 col-md-5"> <span class="input-group" id="basic-addon1" >Videos</span>
        <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" id="video_select" name='video_select' required>
          <option selected>Elija el video...</option>
          <option >Streaming</option>
        </select>
      </div>
      <div class="input-group mb-3 col-md-5"> <span class="input-group" id="basic-addon1" >Tipo de pregunta</span>
        <select class="form-select form-select-md mb-3"  id="poll_type" name='poll_type' required>
          <option selected>Elija tipo de pregunta...</option>
          <option value='radio'>Respuesta única</option>
          <option value='checkbox'>Respuestas múltiples</option>
        </select>
      </div>
      <h6 class="mb-3 col-md-12">Indique el momento en el que dea mostrar la pregunta.</h6>
      <div class="input-group mb-3 col-md-2">
        <label class="input-group" for="inputGroupFile01" >Horas</label>
        <input type="number" class="form-control border horas" name="pregunta_h" id="pregunta_h" value='0' max="2">
      </div>
      <div class="input-group mb-3 col-md-2">
        <label class="input-group" for="inputGroupFile01">Minutos</label>
        <input type="number" class="form-control border minutos" name="pregunta_m" id="pregunta_m" value='0' max="59">
      </div>
      <div class="input-group mb-3 col-md-2">
        <label class="input-group" for="inputGroupFile01">Segundos</label>
        <input type="number" class="form-control border minutos" name="pregunta_s" id="pregunta_s" value='0' max="59">
      </div>
      <div class="input-group mb-3 col-md-9">
        <button class="btn btn-primary col-md-4 my-4 rounded-3" type="button" id="send_poll">Enviar <i class="fas fa-paper-plane"></i></button>
        <button class="btn btn-light col-md-2 my-4 rounded-3 ms-auto descartar" id="descartar" type="button" >Descartar</button>
      </div>
      <div class="input-group mb-3 col-md-6"> </div>
      
      <!-- Modal -->
      
      <div class="modal fade" id="pregunta_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="pregunta_modalLabel" aria-hidden="true" style="z-index: 1000000001">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="video_modalLabel">Ponentes</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="input-group w-100">
                <table class='table table-striped table-bordered table-sm table-hover' cellspacing='0'

  width='100%' >
                  <thead>
                    <tr class='text-center'>
                      <th class='th-sm'>Pregunta</th>
                      <th class='th-sm'>Respuestas</th>
                      <th class='th-sm'>Tipo</th>
                      <th class='th-sm'>Video</th>
                      <th class='th-sm'>Tiempo (s)</th>
                      <th class='th-sm'>Editar</th>
                      <th class='th-sm'>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody id='table_pregunta'>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    
    <!----------------------------------------------PATROCINIO------------------------------------------------------------------->
    
    <form id="form_patrocinio" method="post"  enctype="multipart/form-data" class="p-3 h-50 mt-4 row">
      <div class="d-flex py-5">
        <h2><i class="far fa-flag"></i> Patrocinadores </h2>
        <div class="input-group mb-3 col-md-3 ms-auto">
          <button type="button" class="ms-auto btn btn-secondary py-0" data-bs-toggle="modal" data-bs-target="#patrocinio_modal"> Ver Patrocinadores <span class="badge bg-dark p-1" id="nom_patrocionio">0</span> </button>
        </div>
      </div>
      <div class="alert alert-warning alert-dismissible" role="alert" style="display: none" id="alerta_poll" required> <strong>Antención!</strong> Todos los campos son obligatorios.
        <button type="button" class="btn-close"></button>
      </div>
      <div class="input-group mb-3 col-md-10"> <span class="input-group" id="basic-addon1" >Empresa</span>
        <input type="text" class="form-control border form-control-sm"  name="empresa_patrocinio" id="empresa_patrocinio" required>
      </div>
      <div class="input-group mb-3 col-md-5"> <span class="input-group" id="basic-addon1" >Sitio Web</span>
        <input type="url" class="form-control border form-control-sm"  name="url_patrocinio" id="url_patrocinio" required>
      </div>
		<div class="input-group mb-3 col-md-5"> <span class="input-group" id="basic-addon1" >Usuario de contacto</span>
        <input type="url" class="form-control border form-control-sm"  name="contact_patrocinio" id="contact_patrocinio" required>
      </div>
      <div class="input-group mb-3 col-md-5"> <span class="input-group" id="basic-addon1" >Video</span>
        <input type="url" class="form-control border form-control-sm"  name="video_patrocinio" id="video_patrocinio" required>
      </div>
      <div class="input-group mb-3 col-md-5"> <span class="input-group" id="basic-addon1" >Email de contacto</span>
        <input type="email" class="form-control border form-control-sm"  name="email_patrocinio" id="email_patrocinio" required>
      </div>
      <div class="input-group mb-3 col-md-5"> <span class="input-group" id="basic-addon1" >Teléfono de contácto</span>
        <input type="phone" class="form-control border form-control-sm"  name="phone_patrocinio" id="phone_patrocinio" required>
      </div>
      <div class="input-group mb-3 col-md-5"> <span class="input-group" id="basic-addon1" >Linkedin</span>
        <input type="url" class="form-control border form-control-sm"  name="linkedin_patrocinio" id="linkedin_patrocinio" required>
      </div>
      <div class="input-group mb-3 col-md-5">
        <label class="input-group" for="inputGroupFile01" >Grupo de patrocinio</label>
        <select class="form-select form-select-md mb-3" id="type_patrocinio" name='type_patrocinio' required>
          <option selected>Elija un grupo...</option>
          <option value="Gold">Patrocinador Gold</option>
          <option value="Silver">Patrocinador Silver</option>
          <option value="Bronze">Patrocinador Bronze</option>
          <option value="Colaborador">Colaborador</option>
        </select>
      </div>
      <div class="input-group mb-3 col-md-5">
        <label class="input-group" for="logo_patrocinador" >Logo</label>
        <input type="file" class="form-control form-control-lg border" name="logo_patrocinio" id="logo_patrocinio" >
      </div>
      <div class="input-group mb-3 col-md-5">
        <label class="input-group" for="logo_patrocinador" >Fondo</label>
        <input type="file" class="form-control form-control-lg border" name="fondo_patrocinio" id="fondo_patrocinio" >
      </div>
      <div class="input-group mb-3 col-md-5">
        <label class="input-group" for="logo_patrocinador" >Archivo de Interés</label>
        <input type="file" class="form-control form-control-lg border" name="archivo_patrocinio" id="archivo_patrocinio" >
      </div>
		<div class="input-group mb-3 col-md-5">
        <label class="input-group" for="logo_patrocinador" >Archivo de Interés2</label>
        <input type="file" class="form-control form-control-lg border" name="archivo2_patrocinio" id="archivo2_patrocinio" >
      </div>
      <div class="input-group col-md-10"> <span class="input-group  w-100">Descripción</span>
        <textarea class="overflow-scroll w-100 border form-control-sm"  name="info_patrocinio" style="height: 100px;" id="info_patrocinio" maxlength="3000" id="bio_p" required>
        </textarea>
      </div>
      <p class="text-muted character_counter" >0 / 1000</p>
      <div class="input-group mb-3 col-md-10">
        <button class="btn btn-primary col-md-4 my-4 rounded-3" type="button" id="send_patrocinio">Enviar <i class="fas fa-paper-plane"></i></button>
        <button class="btn btn-light col-md-2 my-4 rounded-3 ms-auto descartar" id="descartar" type="button" >Descartar</button>
      </div>
      
      <!-- Modal -->
      
      <div class="modal fade" id="patrocinio_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="patrocinio_modalLabel" aria-hidden="true" style="z-index: 1000000001">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="patrocinio_modalLabel">Ponentes</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="input-group w-100">
                <table class='table table-striped table-bordered table-sm table-hover' cellspacing='0'

  width='100%' >
                  <thead>
                    <tr class='text-center'>
                      <th class='th-sm'>Name</th>
                      <th class='th-sm'>Sitio Web</th>
                      <th class='th-sm' hidden>Video</th>
                      <th class='th-sm' hidden>info</th>
                      <th class='th-sm'>email</th>
                      <th class='th-sm'>Teléfono</th>
                      <th class='th-sm'hidden>Linkedin</th>
					<th class='th-sm'>Contact</th>
                      <th class='th-sm'>Grupo de Patrocinadores</th>
                      <th class='th-sm'>Editar</th>
                      <th class='th-sm'>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody id='table_patrocinio'>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    
   
    
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> 
<script src="../js/pagina/dashboard.js"></script>
</body>
</html>