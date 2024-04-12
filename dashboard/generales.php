<?php


session_start();

if ( $_GET[ 'cerrar' ] == true ) {
    $_SESSION[ 'id_admin_login' ] = "";
    session_destroy();
}

include( "php/encode.php" );
header( "Content-Type: text/html;charset=utf-8" );

if ( !empty( $_SESSION[ 'id_admin_login' ] ) ) {

    include( "../assets/php/config.php" );

    $ocultos = [];
    $usuarios2 = [];
    $usuarios = [];
    $activos = [];
    $columnas = [];
    $pagos = [];
    $facturacion = [];
    $ponente = [];
    $moderadores = [];
    $decanos = [];
    $junta = [];
    $categorias = [];
    $autoridad = [];
    $profesionales = [];

    $sql3 = "SELECT * FROM CATEGORIAS";
    $resultado3 = $cnt->prepare( $sql3 );
    $resultado3->execute();
    while ( $fila6 = $resultado3->fetch( PDO::FETCH_ASSOC ) ) {
        $categorias[] = $fila6;
    }
    $sql3 = "SELECT * FROM profesionales";
    $resultado3 = $cnt->prepare( $sql3 );
    $resultado3->execute();
    while ( $fila6 = $resultado3->fetch( PDO::FETCH_ASSOC ) ) {
        $profesionales[] = $fila6;
    }

    $sql = "SELECT * FROM reservas_hotel";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute();
    while ( $fila6 = $respuesta->fetch( PDO::FETCH_ASSOC ) ) {
        $reservas[] = $fila6;
    }

    $sql = "SELECT * FROM all_campos";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute();
    while ( $fila3 = $respuesta->fetch( PDO::FETCH_ASSOC ) ) {

        $campos[] = $fila3;


    }
    $sql3 = "SELECT * FROM generales_form";
    $resultado3 = $cnt->prepare( $sql3 );
    $resultado3->execute();
    $generales_form = $resultado3->fetch( PDO::FETCH_ASSOC );

    $sql3 = "SELECT * FROM pagos";
    $resultado3 = $cnt->prepare( $sql3 );
    $resultado3->execute();
    $m_pagos = $resultado3->fetch( PDO::FETCH_ASSOC );

    $sql3 = "SELECT * FROM habitaciones";
    $resultado3 = $cnt->prepare( $sql3 );
    $resultado3->execute();
    while ( $fila6 = $resultado3->fetch( PDO::FETCH_ASSOC ) ) {
        $habitaciones[] = $fila6;
    }
    $sql3 = "SELECT * FROM cuotas";
    $resultado3 = $cnt->prepare( $sql3 );
    $resultado3->execute();
    while ( $fila6 = $resultado3->fetch( PDO::FETCH_ASSOC ) ) {
        $cuotas[] = $fila6;
    }

    $sql3 = "SELECT * FROM form WHERE VISIBILIDAD=1 ORDER BY ID ASC";
    $resultado3 = $cnt->prepare( $sql3 );
    $resultado3->execute();
    while ( $fila = $resultado3->fetch( PDO::FETCH_ASSOC ) ) {
        $ocultos[] = $fila;
    }

    $sql = "SELECT * FROM pais";
    $respuesta = $cnt->prepare( $sql );
    $respuesta->execute();
    while ( $fila2 = $respuesta->fetch( PDO::FETCH_ASSOC ) ) {
        $paises[] = $fila2;
    }

    $sql3 = "SELECT * FROM columns";
    $resultado4 = $cnt->prepare( $sql3 );
    $resultado4->execute();
    while ( $fila4 = $resultado4->fetch() ) {
        $columnas[] = $fila4;
    };
    $sql3 = "SELECT * FROM facturacion";
    $resultado4 = $cnt->prepare( $sql3 );
    $resultado4->execute();
    while ( $fila4 = $resultado4->fetch() ) {
        $facturacion[] = $fila4;
    };
    $pendientes = 0;
    $pagados = 0;
    $devoluciones = 0;
    $sql3 = "SELECT * FROM pendiete";
    $resultado4 = $cnt->prepare( $sql3 );
    $resultado4->execute();
    while ( $fila4 = $resultado4->fetch() ) {


        foreach ( $reservas as $elemento8 ) {
            if ( $elemento8[ 'USER_ID' ] == $fila4[ 'USER_ID' ] ):
                if ( $elemento8[ 'HOTEL_ESTADO' ] == "PENDIENTE"
                    and $elemento8[ 'HOTEL_CUOTA' ] == 0.00 ) {
                    $pendientes = $pendientes + $elemento8[ 'HOTEL_APOYO' ];
                } else if ( $elemento8[ 'HOTEL_ESTADO' ] == "PENDIENTE"
                and $elemento8[ 'HOTEL_CUOTA' ] != 0.00 ) {
                $pendientes = $pendientes + $elemento8[ 'HOTEL_APOYO' ];
                $pagados = $pagados + ( $elemento8[ 'HOTEL_CUOTA' ] - $elemento8[ 'HOTEL_APOYO' ] );
            } else if ( $elemento8[ 'HOTEL_ESTADO' ] == "PAGADO" ) {
                $pagados = $pagados + $elemento8[ 'HOTEL_CUOTA' ];
            } else if ( $elemento8[ 'HOTEL_ESTADO' ] == "DEVOLUCION"
                and $elemento8[ 'HOTEL_CUOTA' ] == 0.00 ) {
                $devoluciones = $devoluciones + $elemento8[ 'HOTEL_APOYO' ];
            } else if ( $elemento8[ 'HOTEL_ESTADO' ] == "DEVOLUCION"
                and $elemento8[ 'HOTEL_CUOTA' ] != 0.00 ) {
                $devoluciones = $devoluciones + $elemento8[ 'HOTEL_APOYO' ];
                $pagados = $pagados + ( $elemento8[ 'HOTEL_CUOTA' ] + $elemento8[ 'HOTEL_APOYO' ] );
            }
            endif;
        }


        if ( $fila4[ 'CUOTA_ESTADO' ] == "PENDIENTE"
            and $fila4[ 'CUOTA_APOYO' ] == 0.00 ) {
            $pendientes = $pendientes + $fila4[ 'CUOTA' ];

        } else if ( $fila4[ 'CUOTA_ESTADO' ] == "PENDIENTE"
            and $fila4[ 'CUOTA_APOYO' ] != 0.00 ) {
            $pendientes = $pendientes + $fila4[ 'CUOTA_APOYO' ];
            $pagados = $pagados + ( $fila4[ 'CUOTA' ] - $fila4[ 'CUOTA_APOYO' ] );
        }
        if ( $fila4[ 'ACOMPA_ESTADO' ] == "PENDIENTE"
            and $fila4[ 'ACOMPA_CUOTA' ] == 0.00 ) {
            $pendientes = $pendientes + $fila4[ 'ACOMPA_APOYO' ];
        } else if ( $fila4[ 'ACOMPA_ESTADO' ] == "PENDIENTE"
            and $fila4[ 'ACOMPA_CUOTA' ] != 0.00 ) {
            $pendientes = $pendientes + $fila4[ 'ACOMPA_APOYO' ];
            $pagados = $pagados + ( $fila4[ 'ACOMPA_CUOTA' ] - $fila4[ 'ACOMPA_APOYO' ] );
        }


        if ( $fila4[ 'CUOTA_ESTADO' ] == "PAGADO"
            and $fila4[ 'CUOTA' ] != 0 ) {
            $pagados = $pagados + $fila4[ 'CUOTA' ];
        }
        if ( $fila4[ 'ACOMPA_ESTADO' ] == "PAGADO"
            and $fila4[ 'ACOMPA_CUOTA' ] != 0 ) {
            $pagados = $pagados + $fila4[ 'CUOTA_ACOMPA' ];
        }

        if ( $fila4[ 'CUOTA_ESTADO' ] == "DEVOLUCION"
            and $fila4[ 'CUOTA' ] == 0.00 ) {
            $devoluciones = $devoluciones + $fila4[ 'CUOTA_APOYO' ];
        } else if ( $fila4[ 'CUOTA_ESTADO' ] == "DEVOLUCION"
            and $fila4[ 'CUOTA' ] != 0.00 ) {
            $devoluciones = $devoluciones + $fila4[ 'CUOTA_APOYO' ];
            $pagados = $pagados + ( $fila4[ 'CUOTA' ] + $fila4[ 'CUOTA_APOYO' ] );
        }

        if ( $fila4[ 'ACOMPA_ESTADO' ] == "DEVOLUCION"
            and $fila4[ 'ACOMPA_CUOTA' ] == 0.00 ) {
            $devoluciones = $devoluciones + $fila4[ 'CUOTA_APOYO' ];
        } else if ( $fila4[ 'ACOMPA_ESTADO' ] == "DEVOLUCION"
            and $fila4[ 'ACOMPA_CUOTA' ] != 0.00 ) {
            $devoluciones = $devoluciones + $fila4[ 'ACOMPA_APOYO' ];
            $pagados = $pagados + ( $fila4[ 'ACOMPA_CUOTA' ] + $fila4[ 'ACOMPA_APOYO' ] );
        }

        if ( $fila4[ 'ACOMPA_ESTADO' ] == "DEVOLUCION" ) {
            $devoluciones = $devoluciones + $fila4[ 'CUOTA_ACOMPA' ];
        }


        $pagos[] = $fila4;
    }


    $sql3 = "SELECT * FROM hoteles ORDER BY FECHA ASC";
    $resultado4 = $cnt->prepare( $sql3 );
    $resultado4->execute();
    while ( $fila4 = $resultado4->fetch() ) {
        $hoteles[] = $fila4;
    };

    $sql3 = "SELECT * FROM form WHERE VISIBILIDAD=0 ORDER BY ID ASC";

    $resultado3 = $cnt->prepare( $sql3 );

    $resultado3->execute();

    while ( $fila3 = $resultado3->fetch( PDO::FETCH_ASSOC ) ) {

        if ( $fila3[ 'ACOMPA' ] == "Si"
            and $fila3[ 'VISIBILIDAD' ] == 0 ) {
            $acompa[] = $fila3;
        }
        if ( $fila3[ 'CATEGORIA' ] != "Staff"
            and $fila3[ 'VISIBILIDAD' ] == 0 ) {
            $registrados[] = $fila3;
        }


    }


    if ( $_GET[ 'search' ] != "" ) {

        $sql = "SELECT * FROM form WHERE ID LIKE '%" . $_GET[ 'search' ] . "%' OR EMAIL LIKE '%" . $_GET[ 'search' ] . "%' OR NAME LIKE '%" . $_GET[ 'search' ] . "%'";
        $resultado = $cnt->prepare( $sql );
        $resultado->execute();

        while ( $fila = $resultado->fetch( PDO::FETCH_ASSOC ) ) {

            $usuarios[] = $fila;

        }

    } else {

        $sql2 = "SELECT * FROM form WHERE VISIBILIDAD=0 ORDER BY ID ASC";
        $resultado2 = $cnt->prepare( $sql2 );
        $resultado2->execute();
        $count = 0;
        while ( $fila2 = $resultado2->fetch( PDO::FETCH_ASSOC ) ) {
            $usuarios[] = $fila2;

            foreach ( $profesionales as $elemento ) {
                if ( $fila2[ 'ID' ] == $elemento[ 'USER_ID' ] ) {
                    $usuarios[ $count ][ 'PESPECIALIDAD' ] = $elemento[ 'ESPECIALIDAD' ];
                    $usuarios[ $count ][ 'PTIPO_CENTRO' ] = $elemento[ 'TIPO_CENTRO' ];
                    $usuarios[ $count ][ 'PPAIS' ] = $elemento[ 'PAIS' ];
                    $usuarios[ $count ][ 'PCIUDAD' ] = $elemento[ 'CIUDAD' ];
                    $usuarios[ $count ][ 'PDIRECCION' ] = $elemento[ 'ESPECIALIDAD' ];
                    $usuarios[ $count ][ 'PCODIGO_POSTAL' ] = $elemento[ 'CODIGO_POSTAL' ];
                    $usuarios[ $count ][ 'PHOSPITAL' ] = $elemento[ 'HOSPITAL' ];
                }
            }
            $count++;
        }
    }
    $filtro_pendiente = [];
    foreach ( $usuarios as $elemento ) {
        foreach ( $pagos as $elemento3 ) {
            if ( $elemento[ 'ID' ] == $elemento3[ 'USER_ID' ] ) {
                $cuota_devolucion = 0;
                $cuota_pendiete = 0;
                $acompa_devolucion = 0;
                $acompa_pendiete = 0;
                $hotel_devolucion = 0;
                $hotel_pendiete = 0;
                $total_pendiete = 0;
                $total_devolucion = 0;

                if ( $elemento3[ 'CUOTA_ESTADO' ] == "PENDIENTE"
                    and $elemento3[ 'CUOTA_APOYO' ] != 0 ) {
                    $cuota_pendiete = $elemento3[ 'CUOTA_APOYO' ];
                } else if ( $elemento3[ 'CUOTA_ESTADO' ] == "PENDIENTE"
                    and $elemento3[ 'CUOTA_APOYO' ] == 0 ) {
                    $cuota_pendiete = $elemento3[ 'CUOTA' ];
                } else if ( $elemento3[ 'CUOTA_ESTADO' ] == "DEVOLUCION" ) {
                    $cuota_devolucion = $elemento3[ 'CUOTA_APOYO' ];
                } else if ( $elemento3[ 'CUOTA_ESTADO' ] == "PAGADO"
                    and $elemento3[ 'CUOTA_PAGO' ] == "FREE" ) {
                    $cuota_devolucion = 0;
                } else {
                    $cuota_devolucion = 0;
                }
                if ( $elemento3[ 'ACOMPA_ESTADO' ] == "PENDIENTE"
                    and $elemento3[ 'ACOMPA_APOYO' ] != 0 ) {
                    $acompa_pendiete = $elemento3[ 'ACOMPA_APOYO' ];
                } elseif ( $elemento3[ 'ACOMPA_ESTADO' ] == "PENDIENTE"
                    and $elemento3[ 'ACOMPA_APOYO' ] == 0 ) {
                    $acompa_pendiete = $elemento3[ 'ACOMPA_CUOTA' ];
                } else if ( $elemento3[ 'ACOMPA_ESTADO' ] == "DEVOLUCION" ) {
                    $acompa_devolucion = $elemento3[ 'ACOMPA_APOYO' ];
                } else if ( $elemento3[ 'ACOMPA_ESTADO' ] == "PAGADO"
                    and $elemento3[ 'ACOMPA_PAGO' ] == "FREE" ) {
                    $acompa_devolucion = 0;
                } else {
                    $acompa_devolucion = 0;
                }
                foreach ( $reservas as $elemento8 ) {
                    if ( $elemento8[ 'USER_ID' ] == $elemento[ 'ID' ] ):
                        if ( $elemento8[ 'HOTEL_ESTADO' ] == "PENDIENTE" ) {
                            $hotel_pendiete = $hotel_pendiete + $elemento8[ 'HOTEL_APOYO' ];
                        } else if ( $elemento8[ 'HOTEL_ESTADO' ] == "DEVOLUCION" ) {
                        $hotel_devolucion = $hotel_devolucion + $elemento8[ 'HOTEL_APOYO' ];
                    } else if ( $elemento8[ 'HOTEL_ESTADO' ] == "" ) {
                        $hotel_devolucion = $hotel_devolucion + 0;
                    } else {
                        $hotel_devolucion = $hotel_devolucion + 0;
                    }
                    endif;
                }

                $total_pendiete = $cuota_pendiete + $acompa_pendiete + $hotel_pendiete;
                $total_devolucion = $cuota_devolucion + $acompa_devolucion + $hotel_devolucion;

                if ( $total_pendiete > $total_devolucion ) {
                    $filtro_pendiente[] = $elemento;
                } else if ( $total_pendiete < $total_devolucion ) {
                    $filtro_devolucion[] = $elemento;
                }
            }
        }

    }
    $usuarios_filtro = [];
    $sql = "SELECT * FROM form WHERE VISIBILIDAD=0";
    $resultado = $cnt->prepare( $sql );
    $resultado->execute();


    while ( $fila = $resultado->fetch( PDO::FETCH_ASSOC ) ) {
        if ( $fila[ 'ESTADO' ] == 1 ) {
            $filtro_resuelto[] = $fila;
        }
    }


    if ( $_GET[ 'filtro_pendiente' ] != "" ) {
        $usuarios = [];
        foreach ( $filtro_pendiente as $elemento ) {
            $usuarios[] = $elemento;
        }

    }

    if ( $_GET[ 'filtro_devolucion' ] != "" ) {
        $usuarios = [];
        foreach ( $filtro_devolucion as $elemento ) {
            $usuarios[] = $elemento;
        }

    }

    if ( $_GET[ 'filtro_resuelto' ] != "" ) {
        $usuarios = [];
        foreach ( $filtro_resuelto as $elemento ) {
            $usuarios[] = $elemento;
        }


    }
    if ( $_GET[ 'acompa' ] ) {


        $acompanante = [];
        $sql2 = "SELECT * FROM acompa  ORDER BY ID ASC";

        $resultado2 = $cnt->prepare( $sql2 );

        $resultado2->execute();

        while ( $fila2 = $resultado2->fetch( PDO::FETCH_ASSOC ) ) {
            $acompanante[] = $fila2;

        }
    }


    $arrFiles = array();
    $array_conteo = [];
    $handle = opendir( '../assets/archivos/descargas/' );
    $no_archivos = 0;
    if ( $handle ) {
        while ( ( $entry = readdir( $handle ) ) !== FALSE ) {
            $arrFiles[] = $entry;
        }
    }
    foreach ( $arrFiles as $elemento ) {
        $no_archivos = count( glob( '../assets/archivos/descargas/' . $elemento . '/{*.pdf,*.xlsx,*.jpg,*.png}', GLOB_BRACE ) );
        array_push( $array_conteo, array( "$elemento" => $no_archivos ) );
    }
    closedir( $handle );

    $sql3 = "SELECT * FROM evento";
    $resultado3 = $cnt->prepare( $sql3 );
    $resultado3->execute();
    $evento = $resultado3->fetch( PDO::FETCH_ASSOC );


} else {

    header( "location:access.php" );
}


?>

<!doctype html>

<html lang="en">
<head>
<title>Dashboard INICIO</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" href="Imagenes/logo_white.png" type="image/x-icon">
<!---------------bloqueo de cache------------------------------------>

<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/css/tableexport.css"  />
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/icon/iconfonts.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

<!---------------------------- MENU LATERAL ------------------->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header" style="background:linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%)">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"><img src="Imagenes/logo_white.png" class="me-3" style='height: 30px'> Opciones y Configuración</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="col-12 mb-3 px-0">
      <button class="btn rounded-pill btn-light w-100 text-start border-bottom collapsed button_submenu" data-bs-toggle="collapse" href="#importar-exportar" role="button" aria-expanded="false" aria-controls="importar-exportar"><i class="icon-plus"></i> Importar / Exportar </button>
      <div class="collapse" id="importar-exportar">
        <div class="card card-body p-0 border-0">
          <ul class="menu_lateral w-100 ps-0 ms-auto mb-0">
            <li class='item_menu_lateral' data-bs-toggle='modal' data-bs-target='#exampleModalimport' data-bs-dismiss="offcanvas"><i class="icon-cloud-upload-alt" style="transform: rotate(180deg)"></i> Importar usuarios</li>
            <a href="php/export2.php">
            <li class='item_menu_lateral'><i class="icon-cloud-upload-alt"></i> Exportar usuarios</li>
            </a>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-12 mb-3 px-0">
      <button class="btn rounded-pill btn-light w-100 text-start border-bottom collapsed button_submenu" data-bs-toggle="collapse" href="#eventos" role="button" aria-expanded="false" aria-controls="eventos"><i class="icon-plus"></i> Evento </button>
      <div class="collapse" id="eventos">
        <div class="card card-body p-0 border-0">
          <ul class="menu_lateral w-100 ps-0 ms-auto mb-0">
            <li class='item_menu_lateral'  data-bs-toggle="modal" data-bs-target='#generales_evento' data-bs-dismiss="offcanvas" ><i class="icon-plus-circle"></i> Generales</li>
            <li class='item_menu_lateral' data-bs-toggle="modal" data-bs-target='#modulos' data-bs-dismiss="offcanvas" id="modulos_item"><i class="icon-plus-circle"></i> Módulos</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-12 mb-3 px-0">
      <button class="btn rounded-pill btn-light w-100 text-start border-bottom collapsed button_submenu" data-bs-toggle="collapse" href="#gestion_usuarios" role="button" aria-expanded="false" aria-controls="gestion_usuarios"><i class="icon-plus"></i> Gestión de Usuarios </button>
      <div class="collapse" id="gestion_usuarios">
        <div class="card card-body p-0 border-0">
          <ul class="menu_lateral w-100 ps-0 ms-auto mb-0">
            <li class='item_menu_lateral' data-bs-toggle="modal" data-bs-target="#staticBackdrop5" data-bs-dismiss="offcanvas"><i class="icon-plus-circle"></i> Crear usuario</li>
            <li class='item_menu_lateral' data-bs-toggle='modal' data-bs-target='#categorias' data-bs-dismiss="offcanvas"><i class="icon-plus-circle"></i> Categorías de usuario</li>
            <li class='item_menu_lateral' data-bs-toggle='modal' data-bs-target='#staticBackdrop6' data-bs-dismiss="offcanvas"><i class="icon-send"></i> Notificación directa</li>
            <li class='item_menu_lateral' data-bs-toggle='modal' data-bs-target='#masivos_confirmaciones' data-bs-dismiss="offcanvas"><i class="icon-send"></i> Confirmaciones</li>
          </ul>
        </div>
      </div>
    </div>
    <?php if($generales_form[ 'ESTADO_ALOJAMIENTO' ] == 1):?>
    <div class="col-12 mb-3 px-0">
      <button class="btn rounded-pill btn-light w-100 text-start border-bottom collapsed button_submenu" data-bs-toggle="collapse" href="#gestion_hoteles" role="button" aria-expanded="false" aria-controls="gestion_hoteles"><i class="icon-plus"></i> Gestión de Alojamiento </button>
      <div class="collapse" id="gestion_hoteles">
        <div class="card card-body p-0 border-0">
          <ul class="menu_lateral w-100 ps-0 ms-auto mb-0">
            <li class='item_menu_lateral'data-bs-toggle='modal' data-bs-target='#crear_habitacion' data-bs-dismiss="offcanvas"><i class="icon-plus-circle"></i> Crear habitación</li>
            <li class='item_menu_lateral' data-bs-toggle='modal' data-bs-target='#staticBackdrop3' data-bs-dismiss="offcanvas"><i class="icon-plus-circle"></i> Gestión de capacidades</li>
          </ul>
        </div>
      </div>
    </div>
    <?php endif;?>
    <div class="col-12 mb-3 px-0">
      <button class="btn rounded-pill btn-light w-100 text-start border-bottom collapsed button_submenu" data-bs-toggle="collapse" href="#gestion_formulario" role="button" aria-expanded="false" aria-controls="gestion_formulario"><i class="icon-plus"></i> Gestión de Formularios </button>
      <div class="collapse" id="gestion_formulario">
        <div class="card card-body p-0 border-0">
          <ul class="menu_lateral w-100 ps-0 ms-auto mb-0">
            <li class='item_menu_lateral' data-bs-toggle='modal' data-bs-target='#campos_formularios' data-bs-dismiss="offcanvas"><i class="icon-plus-circle"></i> Selección de campos</li>
            <li class='item_menu_lateral' ><i class="icon-plus-circle"></i> Agregar cuotas</li>
            <li class='item_menu_lateral' ><i class="icon-plus-circle"></i> Configuración de campos</li>
            <li class='item_menu_lateral' ><i class="icon-plus-circle"></i> Métodos de pago</li>
            <li class='item_menu_lateral' ><i class="icon-plus-circle"></i> Email de confirmación</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!---------------------------- FIN MENU LATERAL ------------------->
<button class="ir-arriba"  javascript:void(0) title="Volver arriba"> <span class="fa-stack"> <i class="fa fa-circle fa-stack-2x"></i> <i class="fa fa-arrow-up fa-stack-1x fa-inverse"></i> </span> </button>
<div class="d-block">
  <nav class="navbar navbar-expand-lg navbar-light position-fixed w-100 shadow-sm" style="z-index: 3;top:0px; background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);">
    <h1><a href="index.html" class="logo"><img src="Imagenes/logo_white.png" class="me-auto px-5 mx-5" style='height: 70px'></a></h1>
    <div class="d-flex ms-auto" id="navbarNavDropdown">
      <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
      <ul class="navbar-nav ms-auto px-5">
        <!-- <li class="nav-item"> <a class="nav-link  text-white" href="index.php"><i class="fas fa-tools"></i> Panel de Administración</a> </li>-->
        
        <li class="nav-item"> <a class="nav-link  text-white text-dark" href="generales.php"><i class="icon-chart-area"></i> Generales</a> </li>
        <li class="nav-item"> <a class="nav-link  text-white text-dark" href="user.php"><i class="icon-users"></i> Users</a> </li>
        <li class="nav-item"> <a class="nav-link  text-white text-dark" href="user.php?cerrar=true"><i class="icon-power"></i> Salir</a> </li>
      </ul>
    </div>
  </nav>
  <nav class="navbar navbar-expand-lg navbar-light bg-light position-fixed w-100 shadow-sm px-0" style="top:90px;height: 70px;z-index: 2">
    <div class="row w-100 px-5 m-auto">
      <div class="  col-12 ms-auto p-0" id="navbarNavDropdown">
        <h5 class="mt-2" style="text-transform: uppercase; color: #a7a7a7;;"><?php echo $evento['NAME']?></h5>
      </div>
    </div>
  </nav>
</div>
<div id="total_users" style="z-index: 0;margin-top:200px" class="d-block">
  <div style="width: 95%" class="mx-auto mb-5">
    <div class="m-auto w-100">
      <div class="row m-auto" >
        <div class="col-3 ms-auto p-1">
          <div class="tarjeta_generales p-2 shadow-sm" id="filtro_all">
            <div class="border-bottom "><i class="icon-users"></i> REGISTRADOS</div>
            <div class=" text-end"><?php echo count($registrados)+count($acompa)?></div>
          </div>
        </div>
        <div class="col-3 ms-auto p-1">
          <div class="tarjeta_generales p-2 shadow-sm" id="filtro_resuelto">
            <div class="border-bottom "><i class="icon-users"></i>(<?php echo count($filtro_resuelto) ?>) Confirmados</div>
            <div class=" text-end"><?php echo number_format( $pagados, 2, ',', '.' ) .'€' ?></div>
          </div>
        </div>
        <div class="col-3 ms-auto p-1">
          <div class="tarjeta_generales p-2 shadow-sm" id="filtro_pendiente">
            <div class="border-bottom"><i class="icon-users"></i>(<?php echo count($filtro_pendiente) ?>) Pendientes </div>
            <div class=" text-end"><?php echo number_format( $pendientes, 2, ',', '.' ).'€' ?></div>
          </div>
        </div>
        <div class="col-3  p-1 ms-auto">
          <div class="tarjeta_generales  p-2 shadow-sm" id="filtro_devolucion">
            <div class="border-bottom "><i class="icon-users"></i>(<?php echo count($filtro_devolucion) ?>) Devoluciones</div>
            <div class=" text-end"><?php echo number_format(  $devoluciones, 2, ',', '.' ).'€' ?></div>
          </div>
        </div>
      </div>
    </div>
    <div class="m-auto mt-5" style="border-radius: 20px;margin-bottom:35px!important;">
      <div class="row m-auto" >
        <?php
        foreach ( $categorias as $elemento ):
            $cuenta_usuarios = 0;
        if ( $elemento[ 'NAME' ] != "Staff" ):
            ?>
        <div class="col-2  p-1">
          <div class="tarjeta_generales2 p-2 shadow-sm">
            <div class="border-bottom "><?php echo $elemento['NAME'] ?></div>
            <div class=" text-end">
              <?php
              foreach ( $usuarios as $usuario ):
                  if ( $usuario[ 'CATEGORIA' ] == $elemento[ 'NAME' ] ):
                      $cuenta_usuarios++;
              endif;
              endforeach;
              ?>
              <?php echo $cuenta_usuarios; ?> </div>
          </div>
        </div>
        <?php endif; endforeach; if($generales_form['ESTADO_ACOMPA']==1): ?>
        <div class="col-2  p-1">
          <div class="tarjeta_generales2 p-2 shadow-sm">
            <div class="border-bottom "> Acompañantes</div>
            <div class=" text-end"><?php echo count($acompa); ?></div>
          </div>
        </div>
        <?php endif;?>
      </div>
    </div>
    <div class="m-auto w-100  p-3 shadow-sm bg-white" style="border-radius: 20px;position:relative">
      <form class="row g-3 me-auto d-inline-block" action="<?php echo $_SERVER['PHP_SELF']?>" style='width: 81%'>
        <div class="col-auto d-inline-block">
          <label for="inputPassword2" class="visually-hidden">Correo electrónico</label>
          <input type="text" class="form-control border rounded-pill" id="inputPassword2" placeholder="Correo electrónico" name="search" style="width: 200px">
        </div>
        <div class="col-auto mb-3 d-inline-block ps-0">
          <button href = "user.php" class="btn btn-dark btn-sm rounded-pill " style="font-size: 11px"><i class="icon-search"></i> Buscar </button>
        </div>
      </form>
      <?php if(!$_GET['acompa']): ?>
      <div class="p-2" style="overflow-x: scroll">
        <table class="table table-hover m-auto" id="data_table" style="font-size: 10px">
          <thead class="m-auto">
            <tr> 
              <!--******************************************CREAR TABLA*****************************************-->
              <?php
              $cuota = 0;
              /*echo"<th><strong>ICON</strong></th>";*/
              foreach ( $columnas as $elemento ) {
                  if ( $elemento[ 'ESTADO' ] == 1 or $elemento[ 'ESTADO' ] == 0 ):
                      if ( $elemento[ 'COLUMNS' ] == "TYPE" ): ?>
              <th scope='col'><strong><?php echo $elemento[ 'COLUMNS' ];?></strong></th>
              <th scope='col'><strong>CUOTA</strong></th>
              <?php
              else :
                  if ( $elemento[ 'COLUMNS' ] == "ACOMPA"
                      or $elemento[ 'COLUMNS' ] == "CUOTA_ACOMPA" ):
                      if ( $generales_form[ 'ESTADO_ACOMPA' ] == 1 ): ?>
              <th scope='col'><strong><?php echo $elemento[ 'COLUMNS' ];?></strong></th>
              <?php
              endif;
              else :
                  if ( $elemento[ 'COLUMNS' ] == "HOTEL"
                      or $elemento[ 'COLUMNS' ] == "PAGO_HOTEL" ):
                      if ( $generales_form[ 'ESTADO_ALOJAMIENTO' ] == 1 ):
                          ?>
              <th scope='col'><strong><?php echo $elemento[ 'COLUMNS' ];?></strong></th>
              <?php
              endif;
              else :
				  if($elemento[ 'COLUMNS' ] == "INTOLERANCIA" or $elemento[ 'COLUMNS' ] == "GESTION"):
				  if ( $generales_form[ 'ESTADO_EXTRAS' ] == 1 ):?>  
				 <th scope='col'><strong><?php echo $elemento[ 'COLUMNS' ];?></strong></th>
              <?php
				  endif;
            
				  else:?>
				  <th scope='col'><strong><?php echo $elemento[ 'COLUMNS' ];?></strong></th>
				<?php
              endif;
				 endif;
              endif;

              endif;

              endif;
              }
              ?>
              <th scope='col'><strong>ESTADO BALANCE</strong></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ( $usuarios as $elemento ):

                if ( $elemento[ 'ESTADO' ] == 1 ):

                    $icon = "<p hidden>" . $elemento[ 'ID' ] . "</p><i class='icon-send elicon send ' data-bs-toggle='modal' data-bs-target='#exampleModal5'><span> Confirmación</span></i>";
            $estado = "<td class='start'><p hidden>" . $elemento[ 'ID' ] . "</p><p class=' w-100 text-center bg-success  text-white px-2 mb-0 rounded-pill activar' style='cursor:pointer'>CONFIRMADO</p></td>";
            $total_pendiete = 0;
            $total_devolucion = 0;
            else :

                if ( $elemento[ 'ESTADO' ] == 0 ) {
                    foreach ( $pagos as $elemento3 ) {
                        if ( $elemento[ 'ID' ] == $elemento3[ 'USER_ID' ] ) {
                            $cuota_devolucion = 0;
                            $cuota_pendiete = 0;
                            $acompa_devolucion = 0;
                            $acompa_pendiete = 0;
                            $hotel_devolucion = 0;
                            $hotel_pendiete = 0;
                            $total_pendiete = 0;
                            $total_devolucion = 0;

                            if ( $elemento3[ 'CUOTA_ESTADO' ] == "PENDIENTE"
                                and $elemento3[ 'CUOTA_APOYO' ] != 0 ) {
                                $cuota_pendiete = $elemento3[ 'CUOTA_APOYO' ];
                            } else if ( $elemento3[ 'CUOTA_ESTADO' ] == "PENDIENTE"
                                and $elemento3[ 'CUOTA_APOYO' ] == 0 ) {
                                $cuota_pendiete = $elemento3[ 'CUOTA' ];
                            } else if ( $elemento3[ 'CUOTA_ESTADO' ] == "DEVOLUCION" ) {
                                $cuota_devolucion = $elemento3[ 'CUOTA_APOYO' ];
                            } else if ( $elemento3[ 'CUOTA_ESTADO' ] == "PAGADO"
                                and $elemento3[ 'CUOTA_PAGO' ] == "FREE" ) {
                                $cuota_devolucion = 0;
                            } else {
                                $cuota_devolucion = 0;
                            }
                            if ( $elemento3[ 'ACOMPA_ESTADO' ] == "PENDIENTE"
                                and $elemento3[ 'ACOMPA_APOYO' ] != 0 ) {
                                $acompa_pendiete = $elemento3[ 'ACOMPA_APOYO' ];
                            } elseif ( $elemento3[ 'ACOMPA_ESTADO' ] == "PENDIENTE"
                                and $elemento3[ 'ACOMPA_APOYO' ] == 0 ) {
                                $acompa_pendiete = $elemento3[ 'ACOMPA_CUOTA' ];
                            } else if ( $elemento3[ 'ACOMPA_ESTADO' ] == "DEVOLUCION" ) {
                                $acompa_devolucion = $elemento3[ 'ACOMPA_APOYO' ];
                            } else if ( $elemento3[ 'ACOMPA_ESTADO' ] == "PAGADO"
                                and $elemento3[ 'ACOMPA_PAGO' ] == "FREE" ) {
                                $acompa_devolucion = 0;
                            } else {
                                $acompa_devolucion = 0;
                            }

                            foreach ( $reservas as $elemento8 ) {
                                if ( $elemento8[ 'USER_ID' ] == $elemento[ 'ID' ] ):
                                    if ( $elemento8[ 'HOTEL_ESTADO' ] == "PENDIENTE" ) {
                                        $hotel_pendiete = $hotel_pendiete + $elemento8[ 'HOTEL_APOYO' ];
                                    } else if ( $elemento8[ 'HOTEL_ESTADO' ] == "DEVOLUCION" ) {
                                    $hotel_devolucion = $hotel_devolucion + $elemento8[ 'HOTEL_APOYO' ];
                                } else if ( $elemento8[ 'HOTEL_ESTADO' ] == "" ) {
                                    $hotel_devolucion = $hotel_devolucion + 0;
                                } else {
                                    $hotel_devolucion = $hotel_devolucion + 0;
                                }
                                endif;

                            }
                            $total_pendiete = $cuota_pendiete + $acompa_pendiete + $hotel_pendiete;
                            $total_devolucion = $cuota_devolucion + $acompa_devolucion + $hotel_devolucion;


                        }
                    }

                    if ( $total_pendiete > $total_devolucion ) {
                        $total_pendiete = $total_pendiete - $total_devolucion;

                        $estado = "<td ><p hidden>" . $elemento[ 'ID' ] . "</p><p class=' text-center w-100 bg-warning text-white activar mb-0 px-2 rounded-pill'  style='cursor:pointer'>PENDIENTE</p></td>";
                    } else {

                        $estado = "<td><p hidden>" . $elemento[ 'ID' ] . "</p><p class='w-100 bg-danger text-white text-center activar mb-0 px-2 rounded-pill'  style='cursor:pointer'>DEVOLVER</p></td>";
                        $total_pendiete = $total_devolucion - $total_pendiete;
                    }
                } else {

                    $estado = "<td><p hidden>" . $elemento[ 'ID' ] . "</p><span class=' bg-danger text-white activar py-1 px-2 rounded-pill'  style='cursor:pointer'>Error TPV</span></td>";
                }

            endif;


            ?>
            <!-- /******************************RELLENAR COLUMNAS*****************************/-->
            <tr>
              <?php
              $success = '';
              $count_files = 0;
              foreach ( $arrFiles as $archivos ):
                  if ( $elemento[ 'ID' ] == $archivos ):
                      $success = 'text-success';
              endif;
              endforeach;
              foreach ( $array_conteo as $elemento7 ):
                  if ( $elemento7[ $elemento[ 'ID' ] ] ):
                      $count_files = $elemento7[ $elemento[ 'ID' ] ];
              endif;

              endforeach;
              foreach ( $columnas as $elemento2 ):
                  if ( $elemento2[ 'ESTADO' ] == 1 or $elemento2[ 'ESTADO' ] == 0 ):
                      if ( $elemento2[ 'COLUMNS' ] == "EMAIL" ): ?>
              <td class='email'><?php echo $elemento[ $elemento2[ 'COLUMNS' ] ] ?></td>
              <?php
              else :
                  if ( $elemento2[ 'COLUMNS' ] == "ACOMPA" ):
                      if ( $generales_form[ 'ESTADO_ACOMPA' ] == 1 ):
                          if ( $elemento[ $elemento2[ 'COLUMNS' ] ] == "Si" ): ?>
              <td class='text-start'>Si</td>
              <?php else:?>
              <td class='text-start'>No</td>
              <?php
              endif;
              endif;
              elseif ( $elemento2[ 'COLUMNS' ] == "HOTEL" ):
                  if ( $generales_form[ 'ESTADO_ALOJAMIENTO' ] == 1 ):
                      if ( !empty( $reservas ) ):
                          $count = 0;
              foreach ( $reservas as $elemento1 ):
                  if ( $elemento1[ 'USER_ID' ] == $elemento[ 'ID' ]and $elemento1[ 'HABITACION' ] != 0.00 ): ?>
              <td class='text-start'>Si</td>
              <?php
              $count++;
              break;
              endif;
              endforeach;
              if ( $count == 0 ): ?>
              <td class='text-start'><p hidden><?php echo $elemento[ 'ID' ] ?></p>
                No</td>
              <?php
              endif;

              else :?>
              <td class='text-start'>No</td>
              <?php
              endif;
              endif;
              else :
                  if ( $elemento2[ 'COLUMNS' ] == "ID" ): ?>
              <td class='text-start '><p hidden><?php echo $elemento[ 'ID' ] ?></p>
                <?php echo $elemento[ 'ID' ] ?></td>
              <?php
              else :
                  if ( $elemento2[ 'COLUMNS' ] == "CUOTA" ):
                      foreach ( $pagos as $elemento3 ) {
                          if ( $elemento[ 'ID' ] == $elemento3[ "USER_ID" ] ): ?>
              <td class='text-start'><?php echo $elemento3[ 'CUOTA' ]?>€</td>
              <?php
              endif;
              } else :

                  if ( $elemento2[ 'COLUMNS' ] == "CUOTA_ACOMPA" ) {
                      if ( $generales_form[ 'ESTADO_ACOMPA' ] == 1 ):
                          foreach ( $pagos as $elemento3 ) {
                              if ( $elemento[ 'ID' ] == $elemento3[ "USER_ID" ] ) {

                                  if ( $elemento3[ "ACOMPA_CUOTA" ] != 0 ): ?>
              <td class='text-start'><?php echo $elemento3[ 'ACOMPA_CUOTA' ] ?>€</td>
              <?php elseif ( $elemento3[ "ACOMPA_CUOTA" ] == 0 and $elemento3[ "ACOMPA_PAGO" ] == "FREE" ):?>
              <td class='text-start'><?php echo $elemento3[ 'ACOMPA_CUOTA' ] ?>€</td>
              <?php
              elseif ( $elemento3[ "ACOMPA_CUOTA" ] == 0 and $elemento3[ "ACOMPA_PAGO" ] != ""
                  and $elemento3[ "ACOMPA_PAGO" ] != "" ):
                  if ( $elemento[ 'ACOMPA' ] == "Si" ): ?>
              <td class='text-start'><?php echo $elemento3[ 'ACOMPA_CUOTA' ] ?>€</td>
              <?php  else :?>
              <td class='text-start'>(N.S)</td>
              <?php
              endif;

              else :?>
              <td class='text-start'>(N.S)</td>
              <?php
              endif;

              }
              }
              endif;
              } else {

                  if ( $elemento2[ 'COLUMNS' ] == "PAGO_HOTEL" ) {
                      if ( $generales_form[ 'ESTADO_ALOJAMIENTO' ] == 1 ):
                          $total_hotel = 0;
                      foreach ( $reservas as $elemento3 ) {
                          if ( $elemento[ 'ID' ] == $elemento3[ "USER_ID" ] ):
                              if ( $elemento3[ "HOTEL_CUOTA" ] != 0 ):
                                  $total_hotel = $total_hotel + $elemento3[ 'HOTEL_CUOTA' ];
                              elseif ( $elemento3[ "HOTEL_CUOTA" ] == 0 and $elemento3[ "HOTEL_ESTADO" ] == "PENDIENTE" ):
                                  $total_hotel = $total_hotel + $elemento3[ 'HOTEL_APOYO' ];
                          elseif ( $elemento3[ "HOTEL_CUOTA" ] == 0 and $elemento3[ "HOTEL_ESTADO" ] == "PAGADO" ):
                              $total_hotel = $total_hotel + 0;
                          elseif ( $elemento3[ "HOTEL_CUOTA" ] == 0 and $elemento3[ "HOTEL_PAGO" ] == "FREE" ):
                              $total_hotel = $total_hotel + 0;
                          endif;
                          endif;
                      }
                      if ( $total_hotel == 0 ): ?>
              <td class='text-start'>(N.S)</td>
              <?php else:?>
              <td class='text-start'><?php echo number_format( $total_hotel, 2, ',', '.' )  ?>€</td>
              <?php
              endif;
              endif;
              } else {
                  if ( $elemento2[ 'COLUMNS' ] == "BALANCE" ): ?>
              <td><?php echo number_format( $total_pendiete, 2, ',', '.' ) ?>€</td>
              <?php
              else :
                  if ( $elemento2[ 'COLUMNS' ] == "HABITACION" ):
                      $count = 0;
              if ( count( $reservas ) != 0 ):
                  foreach ( $reservas as $elemento5 ):

              if ( $elemento[ 'ID' ] == $elemento5[ 'USER_ID' ]and $count == 0 ):
                  $count++;
              foreach ( $habitaciones as $elemento7 ):
                  if ( $elemento7[ "PRECIO" ] == $elemento5[ 'HABITACION' ] ):
                      ?>
              <td class='text-start'><?php echo $elemento7['HABITACION']?></td>
              <td class='text-start'><?php echo $elemento5['NOCHES']?></td>
              <td class='text-start'><?php echo $elemento5['F_ENTRADA']?></td>
              <td class='text-start'><?php echo $elemento5['F_SALIDA']?></td>
              <?php
              break;
              endif;

              endforeach;
              elseif ( $count == 0 ): ?>
              <td class='text-start'>(N.S)</td>
              <td class='text-start'>(N.S)</td>
              <td class='text-start'>(N.S)</td>
              <td class='text-start'>(N.S)</td>
              <?php
              $count++;
              endif;
              endforeach;
              else :?>
              <td class='text-start'>(N.S)</td>
              <td class='text-start'>(N.S)</td>
              <td class='text-start'>(N.S)</td>
              <td class='text-start'>(N.S)</td>
              <?php
              endif;
              else :
                  if ( $elemento2[ 'COLUMNS' ] == "NOCHES"
                      or $elemento2[ 'COLUMNS' ] == "F_ENTRADA"
                      or $elemento2[ 'COLUMNS' ] == "F_SALIDA" ):
                      else :
                          if ( $elemento2[ 'COLUMNS' ] == "INTOLERANCIA"
                              or $elemento2[ 'COLUMNS' ] == "GESTION" ):
                              if ( $generales_form[ 'ESTADO_EXTRAS' ] == 1 ): ?>
              <td class='text-start'><?php echo $elemento[ $elemento2[ 'COLUMNS' ] ]?></td>
              <?php
              endif;
              else :?>
              <td class='text-start'><?php echo $elemento[ $elemento2[ 'COLUMNS' ] ]?></td>
              <?php
              endif;
              endif;
              endif;
              endif;
              }


              }

              endif;
              endif;
              endif;
              endif;
              endif;
              endforeach;
              ?>
              <?php  echo $estado?>
              <?php if($generales_form['ESTADO_FACTURA']==1):?>
              <?php endif;?>
            </tr>
            <?php    endforeach;?>
          </tbody>
        </table>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php include('php/Layouts/modales.php'); ?>
<?php include('php/Layouts/menu_lateral.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> 
<script src="js/plugins.js"></script> 
<script src="js/dashboard_user.js"></script> 
<script src="js/usuarios.js"></script> 
<script src="js/acompa.js"></script> 
<script>
$(document).ready(function(){

/*********************************** ALOJAMIENTO **********************************/	

var habitacion=0;
var total_hab = 0;
var bbdd_total_hab = 0;
var hotel_apoyo = 0;
var bbdd_apoyo = 0;
var bbdd_estado;
var id3=0;
var categoria = false;
var m_pago = false;
var estado_pago = false;
var cuota = 0;
var bbdd_pago_hotel;
var id_reserva=0;
var hab=new Array();
	<?php foreach($habitaciones as $elemento): ?>
	hab['<?php echo $elemento['HABITACION']?>']=<?php echo $elemento['PRECIO']?>;
	<?php endforeach;?>


$(".hotel-modal").click(function () {
	habitacion=0;
    id3 = $(this).prev("p").text();
	
$('#campos_hotel').fadeOut();
    $.ajax({
        url: "php/hotel_data.php",
        type: "POST",
        data: "id=" + id3 + "&get=no",
        success: function (res) {
				var data=JSON.parse(res)
       
			$('.m-reserva').closest('.col-3').remove()
				if(data){
			for(var i=0;i<data.length;i++){
				$('.reservas_hotel').prepend("<div class='col-3 mt-3'><div class='m-reserva'><p hidden>"+data[i].ID+"</p>Reserva | "+ data[i].ID+"</div></div>");
			}    }
			
			
$('.m-reserva').click(function(){
	$("#update_hotel").text("Actualizar");
	$('#estado-pago12').fadeIn();
$('#estado-pago32').fadeIn();
	$('#campos_hotel').fadeIn();
var id_reserva=$(this).find("p").text();
$('.reserva-hotel-check').removeClass('reserva-hotel-check').addClass('.m-reserva');
$(this).addClass('reserva-hotel-check').removeClass('.m-reserva');
	   $.ajax({
        url: "php/hotel_data.php",
        type: "POST",
        data: "id=" + id_reserva + "&get=Si",
        success: function (res) {
			var data2=JSON.parse(res)
					
	
            if (data2[0].F_ENTRADA != "") {
                $("#fentrada").val(data2[0].F_ENTRADA);
            }
            if (data2[0].F_SALIDA != "") {
                $("#fsalida").val(data2[0].F_SALIDA);
            }
			id_reserva=data2[0].ID;
			 bbdd_total_hab = data2[0].HOTEL_CUOTA;
            m_pago = data2[0].HOTEL_PAGO;
			bbdd_pago_hotel=data2[0].HOTEL_PAGO;
            estado_pago = data2[0].HOTEL_ESTADO;
            hotel_apoyo = data2[0].HOTEL_APOYO;
            total_hab = data2[0].HOTEL_CUOTA;
            bbdd_apoyo = parseInt(data2[0].HOTEL_APOYO);
            bbdd_estado = data2[0].HOTEL_ESTADO;
			
			$('.categoria_hab').removeClass('hotel_hab_check');
			$('.m-pago-check-pago').removeClass('m-pago-check-pago').addClass('m-pago');
            $(".m-pago").removeClass('m-pago-check-pago m-pago').addClass('m-pago');
			$('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
            if (m_pago == "TRANSFERENCIA") {
                $("#m-pago12").addClass('m-pago-check-pago').removeClass('m-pago');
            } else if (m_pago == "TARJETA ECI") {
                $("#m-pago22").addClass('m-pago-check-pago').removeClass('m-pago');
            } else if (m_pago == "TPV") {
                $("#m-pago32").addClass('m-pago-check-pago').removeClass('m-pago');
            } else if (m_pago == "FREE") {
                $("#m-pago42").addClass('m-pago-check-pago').removeClass('m-pago');
            }	
				 $('.devolver2').fadeIn();  
				$('.devolver3').fadeOut();
				$('.devolver4').fadeOut();
			if(data2[0].HABITACION==""){
			   $('.devolver2').fadeOut();
			
			   }else{
				 $('.devolver2').fadeIn();  
			   }

            if (estado_pago == "PENDIENTE" && total_hab != 0) {
                $("#estado-pago22").addClass('estado-pago-hotel-check').removeClass('estado-pago-hotel');
                $('.devolver2').find('div').find('div:first-child').text('PENDIENTE').removeClass('text-danger text-warning').addClass('text-warning');
                $('.devolver2').find('div').find('div:last-child').text(bbdd_apoyo.toFixed(2) + '€').removeClass('text-danger text-warning').addClass('text-warning');
                $('.devolver3').fadeIn();
                $('.devolver3').find('div').find('div:first-child').text('TOTAL PAGADO').addClass('text-success');
                $('.devolver3').find('div').find('div:last-child').text((bbdd_total_hab - bbdd_apoyo).toFixed(2) + '€').addClass('text-success');
                $('.devolver4').fadeIn();
                $('.devolver4').find('div').find('div:last-child').text(Number.parseFloat(bbdd_total_hab).toFixed(2) + '€');
				
				
            } else if (estado_pago == "PENDIENTE" && total_hab == 0) {
				
                $("#estado-pago22").addClass('estado-pago-hotel-check').removeClass('estado-pago-hotel');
                $('.devolver2').find('div').find('div:first-child').text('PENDIENTE').removeClass('text-danger text-warning').addClass('text-warning');
                $('.devolver2').find('div').find('div:last-child').text(bbdd_apoyo.toFixed(2) + '€').removeClass('text-danger text-warning').addClass('text-warning');
				

            } else if (estado_pago == "DEVOLUCION" && total_hab == 0) {
                $("#estado-pago32").addClass('estado-pago-hotel-check').removeClass('estado-pago-hotel');
				$('.devolver2').fadeIn();
                $('.devolver2').find('div').find('div:first-child').text('A DEVOLVER').addClass('text-danger');
                $('.devolver2').find('div').find('div:last-child').text(bbdd_apoyo.toFixed(2) + '€').removeClass('text-danger text-warning').addClass('text-danger');
				
            } else if (estado_pago == "DEVOLUCION" && total_hab != 0) {
                $("#estado-pago32").addClass('estado-pago-hotel-check').removeClass('estado-pago-hotel');
				$('.devolver2').fadeIn();
                $('.devolver2').find('div').find('div:first-child').text('A DEVOLVER').removeClass('text-danger text-warning').addClass('text-danger');
                $('.devolver2').find('div').find('div:last-child').text(Number.parseFloat(bbdd_apoyo).toFixed(2) + '€').removeClass('text-danger text-warning').addClass('text-danger');
                $('.devolver3').fadeIn();
                $('.devolver3').find('div').find('div:first-child').text('TOTAL PAGADO').removeClass('text-danger text-warning').addClass('text-success');
                $('.devolver3').find('div').find('div:last-child').text(Number(parseFloat(bbdd_total_hab) + parseFloat(bbdd_apoyo)).toFixed(2) + '€').removeClass('text-danger text-warning').addClass('text-success');
                $('.devolver4').fadeIn().find('div').find('div:last-child').text(data2[0].HOTEL_CUOTA + "€");
				
            } else if (estado_pago == "PAGADO") {
				  $('.devolver2').find('div').find('div:first-child').text('CONFIRMADO').removeClass('text-danger text-warning');
                $('.devolver2').find('div').find('div:last-child').text(Number.parseFloat(bbdd_apoyo).toFixed(2) + '€').removeClass('text-danger text-warning');
                $("#estado-pago12").addClass('estado-pago-hotel-check').removeClass('estado-pago-hotel');
                $('.devolver3').fadeIn();
                $('.devolver3').find('div').find('div:first-child').text('TOTAL PAGADO').removeClass('text-danger text-warning').addClass('text-success');
                $('.devolver3').find('div').find('div:last-child').text(bbdd_total_hab + '€').removeClass('text-danger text-warning').addClass('text-success');
				
            } else if (estado_pago == null && m_pago == null) {
                $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');

            } else if (estado_pago == "" && m_pago == "") {
                $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');

            } else {

                $("#estado-pago32").addClass('estado-pago-hotel-check').removeClass('estado-pago-hotel');
                $('.devolver3').fadeIn();
                $('.devolver3').find('div').find('div:first-child').text('TOTAL PAGADO').addClass('text-success');
                $('.devolver3').find('div').find('div:last-child').text(parseFloat(bbdd_total_hab) + parseFloat(bbdd_apoyo) + '€').removeClass('text-danger text-warning').addClass('text-success');
                $('.devolver2').find('div').find('div:first-child').text('A DEVOLVER').removeClass('text-danger text-warning').addClass('text-danger');
                $('.devolver2').find('div').find('div:last-child').text(hotel_apoyo + '€').removeClass('text-danger text-warning').addClass('text-danger');
                $('.devolver4').fadeIn();
                $('.devolver4').find('div').find('div:first-child').text('COSTE ACTUAL');
                $('.devolver4').find('div').find('div:last-child').text(bbdd_total_hab + '€');

            }
           
				habitacion=data2[0].HABITACION;
	
	
				$('.categoria_hab').each(function(){					
					if($(this).find('p').text()==habitacion){
				$(this).addClass('hotel_hab_check');
				}else{
				$(this).removeClass('hotel_hab_check');	
				}
				})                
 $('#noches').text(data2[0].NOCHES);

		}
	   })
})
        }

    })
cuenta_noches()

$('.new-reserva').click(function(){
$("#update_hotel").text("Crear reserva");
$('#campos_hotel').fadeIn();	
$('.reserva-hotel-check').removeClass('reserva-hotel-check').addClass('.m-reserva');
$(this).addClass('reserva-hotel-check').removeClass('.m-reserva');
id_reserva=0;
$('.categoria_hab').removeClass('hotel_hab_check');
$('.m-pago-check-pago').removeClass('m-pago-check-pago').addClass('m-pago');
$(".m-pago").removeClass('m-pago-check-pago m-pago').addClass('m-pago');
$('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
$('.devolver2').fadeOut();
$('.devolver3').fadeOut();
$('.devolver4').fadeOut();
$('#estado-pago12').fadeOut();
$('#estado-pago32').fadeOut();
	
id_reserva=0;
bbdd_total_hab = 0;
m_pago = 0;
bbdd_pago_hotel=0;
estado_pago = 0;
hotel_apoyo = 0;
bbdd_apoyo = 0;
bbdd_estado = 0;
})
		
})
var count_noches=0;
		
function cuenta_noches() {
    var entrada = new Date($('#fentrada').val());
    var salida = new Date($('#fsalida').val());
    count_noches = parseInt((salida.getTime() - entrada.getTime()) * 0.000000012);
    $("#noches").text(count_noches);

}


function cuentas_hotel(valor1) {

    total_hab = valor1;
    if (bbdd_estado == "DEVOLUCION") {

        var pagado = parseInt(bbdd_total_hab) + parseInt(bbdd_apoyo);

        if (total_hab < pagado) {

            $('.devolver4').fadeIn();
            hotel_apoyo = pagado - total_hab;
            $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
            $('.devolver2').find('div').find('div:first-child').text('A DEVOLVER').removeClass('text-danger text-danger').addClass('text-danger')
            $('.devolver2').find('div').find('div:last-child').text(hotel_apoyo + '.00€').removeClass('text-danger text-danger').addClass('text-danger')
            $('#estado-pago32').removeClass('estado-pago-hotel').addClass('estado-pago-hotel-check');
            estado_pago = $('#estado-pago32').find('p').text();

        } else if (total_hab > pagado) {

            $('.devolver4').fadeIn();
            hotel_apoyo = total_hab - pagado;
            $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
            $('.devolver2').find('div').find('div:first-child').text('PENDIENTE').removeClass('text-danger text-warning').addClass('text-warning')
            $('.devolver2').find('div').find('div:last-child').text(hotel_apoyo + '.00€').removeClass('text-danger text-warning').addClass('text-warning')
            $('#estado-pago22').removeClass('estado-pago-hotel').addClass('estado-pago-hotel-check');
            estado_pago = $('#estado-pago22').find('p').text();

        } else {

            $('.devolver4').fadeOut();
            hotel_apoyo = total_hab - pagado;
            $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
            $('.devolver2').find('div').find('div:first-child').text('CONFIRMADO').removeClass('text-danger text-warning')
            $('.devolver2').find('div').find('div:last-child').text(hotel_apoyo + '.00€').removeClass('text-danger text-warning')
            $('#estado-pago12').removeClass('estado-pago-hotel').addClass('estado-pago-hotel-check');
            estado_pago = $('#estado-pago12').find('p').text();
        }


    } else if (bbdd_estado == "PENDIENTE" && bbdd_total_hab != 0) {
        var pagado = parseFloat(bbdd_total_hab) - parseFloat(bbdd_apoyo);

        if (total_hab < pagado) {

            $('.devolver4').fadeIn();
            hotel_apoyo = pagado - total_hab;
            $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
            $('.devolver2').find('div').find('div:first-child').text('A DEVOLVER').removeClass('text-danger text-danger').addClass('text-danger')
            $('.devolver2').find('div').find('div:last-child').text(hotel_apoyo + '.00€').removeClass('text-danger text-danger').addClass('text-danger')
            $('#estado-pago32').removeClass('estado-pago-hotel').addClass('estado-pago-hotel-check');
            estado_pago = $('#estado-pago32').find('p').text();

        } else if (total_hab > pagado) {

            $('.devolver4').fadeIn();
            hotel_apoyo = total_hab - pagado;
            $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
            $('.devolver2').find('div').find('div:first-child').text('PENDIENTE').removeClass('text-danger text-warning').addClass('text-warning')
            $('.devolver2').find('div').find('div:last-child').text(hotel_apoyo + '.00€').removeClass('text-danger text-warning').addClass('text-warning')
            $('#estado-pago22').removeClass('estado-pago-hotel').addClass('estado-pago-hotel-check');
            estado_pago = $('#estado-pago22').find('p').text();

        } else {

            $('.devolver4').fadeOut();
            hotel_apoyo = total_hab - pagado;
            $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
            $('.devolver2').find('div').find('div:first-child').text('CONFIRMADO').removeClass('text-danger text-warning')
            $('.devolver2').find('div').find('div:last-child').text(hotel_apoyo + '.00€').removeClass('text-danger text-warning')
            $('#estado-pago12').removeClass('estado-pago-hotel').addClass('estado-pago-hotel-check');
            estado_pago = $('#estado-pago12').find('p').text();
        }


    } else if (bbdd_estado == "PENDIENTE" && bbdd_total_hab == 0) {

        hotel_apoyo = total_hab;
        $('.devolver2').find('div').find('div:first-child').text('PENDIENTE').removeClass('text-danger text-danger').addClass('text-warning')
        $('.devolver2').find('div').find('div:last-child').text(hotel_apoyo + '.00€').removeClass('text-danger text-danger').addClass('text-warning')
        total_hab = 0;

    } else if (bbdd_estado == "PAGADO") {

        var pagado = parseInt(bbdd_total_hab) + parseInt(bbdd_apoyo);

        if (total_hab < bbdd_total_hab) {
            $('.devolver4').fadeIn();
            hotel_apoyo = pagado - total_hab;
            $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
            $('.devolver2').find('div').find('div:first-child').text('A DEVOLVER').removeClass('text-danger text-danger').addClass('text-danger')
            $('.devolver2').find('div').find('div:last-child').text(hotel_apoyo + '.00€').removeClass('text-danger text-danger').addClass('text-danger')
            $('#estado-pago32').removeClass('estado-pago-hotel').addClass('estado-pago-hotel-check');
            estado_pago = $('#estado-pago32').find('p').text();

        } else if (total_hab > bbdd_total_hab) {

            $('.devolver4').fadeIn();
            hotel_apoyo = total_hab - pagado;
            $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
            $('.devolver2').find('div').find('div:first-child').text('PENDIENTE').removeClass('text-danger text-warning').addClass('text-warning')
            $('.devolver2').find('div').find('div:last-child').text(hotel_apoyo + '.00€').removeClass('text-danger text-warning').addClass('text-warning')
            $('#estado-pago22').removeClass('estado-pago-hotel').addClass('estado-pago-hotel-check');
            estado_pago = $('#estado-pago22').find('p').text();

        } else {
            $('.devolver4').fadeOut();
            hotel_apoyo = 0;
            $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
            $('.devolver2').find('div').find('div:first-child').text('CONFIRMADO').removeClass('text-danger text-warning')
            $('.devolver2').find('div').find('div:last-child').text(hotel_apoyo + '.00€').removeClass('text-danger text-warning')
            $('#estado-pago12').removeClass('estado-pago-hotel').addClass('estado-pago-hotel-check');
            estado_pago = $('#estado-pago12').find('p').text();
        }

    } else if (bbdd_estado == "" && bbdd_apoyo == 0 && bbdd_total_hab == 0) {
        hotel_apoyo = total_hab;
        $('.devolver2').find('div').find('div:first-child').text('PENDIENTE').addClass('text-warning');
        $('.devolver2').find('div').find('div:last-child').text(total_hab + '.00€').addClass('text-warning')
        $('#estado-pago22').removeClass('estado-pago-hotel').addClass('estado-pago-hotel-check');
        total_hab = 0
        estado_pago = $('#estado-pago22').find('p').text();
    }

    $('.devolver4').find('div').find('div:last-child').text(total_hab + '.00€')

}
$('.categoria_hab').on('click', function () {
	$('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel')
    $('.hotel_hab_check').removeClass('hotel_hab_check').addClass('categoria_hab');
	$('.m-pago-check-pago').removeClass('m-pago-check-pago').addClass('m-pago');
	 $('.devolver2').fadeIn(); 
    $(this).removeClass('categoria_hab').addClass('hotel_hab_check');
    habitacion = $(this).find('p').text();
    cuenta_noches()
	habitacion=$('.hotel_hab_check').find('p').text();
	cuentas_hotel(count_noches * habitacion);

})
$("#fentrada, #fsalida").change(function () {
    if ($(this).val() > "<?php echo $generales_form['F_SALIDA']?>" || $(this).val() < "<?php echo $generales_form['F_ENTRADA']?>") {
        alert("Debe introducir una fecha válida entre el <?php echo $generales_form['F_ENTRADA']?> y el <?php echo $generales_form['F_ENTRADA']?>.");
        $(this).val("<?php echo $generales_form['F_ENTRADA']?>");
    }
    cuenta_noches()
	habitacion=$('.hotel_hab_check').find('p').text();
   	cuentas_hotel(count_noches * habitacion);
})



$('.estado-pago-hotel').on("click", function () {
    $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
	
    $(this).removeClass('estado-pago-hotel').addClass('estado-pago-hotel-check')
    estado_pago = $('.estado-pago-hotel-check').find('p').text();
    if ($('.estado-pago-hotel-check').find('p').text() == "PAGADO" && bbdd_estado == "DEVOLUCION" && bbdd_apoyo != 0 && m_pago == 'FREE') {

        hotel_apoyo = 0;
        estado_pago = "PAGADO";
        m_pago = "FREE";
        total_hab = 0;
        cuota = 0;

    } else if ($('.estado-pago-hotel-check').find('p').text() == "PAGADO" && bbdd_total_hab == 0 && bbdd_estado == "DEVOLUCION" && bbdd_apoyo != 0) {

        hotel_apoyo = 0;
        estado_pago = "";
        m_pago = "";
        total_hab = 0;
        cuota = 0;

    } else if ($('.estado-pago-hotel-check').find('p').text() == "PENDIENTE" && bbdd_total_hab == 0 && bbdd_estado == "PAGADO" && bbdd_apoyo == 0) {
        $('.hotel_hab_check').removeClass('hotel_hab_check').addClass('categoria_hab');
        hotel_apoyo = total_hab;
        estado_pago = $('.estado-pago-hotel-check').find('p').text();
        m_pago = $('.m-pago-check-pago').find('p').text();

    } else if ($('.estado-pago-hotel-check').find('p').text() == "PENDIENTE" && bbdd_total_hab != 0 && bbdd_estado == "PAGADO" && bbdd_apoyo == 0) {

        hotel_apoyo = total_hab;
        estado_pago = $('.estado-pago-hotel-check').find('p').text();
        total_hab = 0;
    } else if ($('.estado-pago-hotel-check').find('p').text() == "DEVOLUCION" && bbdd_total_hab != 0 && bbdd_estado == "PENDIENTE") {
        alert("ACCION PROHIBIDA, NO PUDE DEVOLVER CON COBROS PENDIENTES, DEBE CONFIRMAR PRIMERO EL PENDEINTE.");
        $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
        $('#estado-pago22').removeClass('estado-pago-hotel').addClass('estado-pago-hotel-check')

    } else if ($('.estado-pago-hotel-check').find('p').text() == "PAGADO" && bbdd_total_hab == 0) {

        total_hab = bbdd_apoyo;
        hotel_apoyo = 0;
        estado_pago = $('.estado-pago-hotel-check').find('p').text();

    } else if ($('.estado-pago-hotel-check').find('p').text() == "PAGADO" && bbdd_total_hab != 0) {

        hotel_apoyo = 0;
        estado_pago = $('.estado-pago-hotel-check').find('p').text();


    } else if ($('.estado-pago-hotel-check').find('p').text() == "PENDIENTE" && bbdd_total_hab == 0) {

        hotel_apoyo = bbdd_total_hab;
        total_hab = 0;
        estado_pago = $('.estado-pago-hotel-check').find('p').text();

    } else if ($('.estado-pago-hotel-check').find('p').text() == "DEVOLUCION" && bbdd_total_hab == 0) {

        hotel_apoyo = bbdd_total_hab;
        total_hab = 0;
        estado_pago = $('.estado-pago-hotel-check').find('p').text();

    } else if ($('.estado-pago-hotel-check').find('p').text() == "DEVOLUCION" && bbdd_total_hab != 0) {

        hotel_apoyo = 0;
        estado_pago = $('.estado-pago-hotel-check').find('p').text();

    }

})

$('#update_hotel').click(function () {
id_reserva=$('.reserva-hotel-check').find('p').text();
    enviar_hotel('contactform-hotel',total_hab,id_reserva);
    return false;
})	

function enviar_hotel(valor,valor1,id_reserva) {	

    var datos = new FormData(document.getElementById(valor));
    datos.append("id", id3);
    datos.append("noches", $("#noches").text());
    datos.append("habitacion", $('.hotel_hab_check').find('p').text());
    datos.append("hotel_cuota", valor1);
    datos.append("m-pago", m_pago);
    datos.append("estado-pago", estado_pago);
    datos.append("hotel_apoyo", hotel_apoyo);
	datos.append("id_reserva", id_reserva);
console.log(datos.get('hotel_apoyo'))
    if (valor == 'contactform-acompa') {
        datos.append("acompanante", "Si");
    }
    $.ajax({
        url: "php/update.php",
        type: "POST",
        clearForm: true,
        contentType: false,
        processData: false,
        data: datos,
        success: function (res) {
		
console.log(res)
            if ($.trim(res) == "ok") {

          location.reload();

            } else if ($.trim(res) == "full") {
                $("#formalert2").append("<p class='bg-blue-2 text-center p-2'>!Lo Sentimos, existe un registro con el email que intenta registrar.</p>");
            } else if ($.trim(res) == "fecha") {
                alert("Lo sentimos no hay disponibilidad para el día " + res);

            }


        }


    });

    return false;

}
	
$('#delete-hotel').click(function () {
	id_reserva=$('.reserva-hotel-check').find('p').text();
    var datos = new FormData(document.getElementById('contactform-hotel'));
    datos.append("id", id3);
    datos.append("noches", $("#noches").text());
    datos.append("habitacion", $('.m-pago-check').find('p').text());
	datos.append("id_reserva", id_reserva);

    $.ajax({
        url: "php/hotel.php",
        type: "POST",
        clearForm: true,
        contentType: false,
        processData: false,
        data: datos,
        success: function (res) {

            if ($.trim(res) == "ok") {

                location.reload();

            }

        }


    });

    return false;
})	
	
$("#contactform-hotel .m-pago").click(function () {
$('.m-pago-check-pago').removeClass('m-pago-check-pago').addClass('m-pago')
$(this).addClass('m-pago-check-pago').removeClass('m-pago');
m_pago = $(this).find('p').text();
if(bbdd_pago_hotel=="FREE" && m_pago!="FREE"){

	cuentas_hotel(count_noches * habitacion);
}
})


var mpago2 = false;
$('#m-pago42').click(function () {

    if (bbdd_total_hab != 0) {

        $('.devolver2').fadeIn();
        if (bbdd_estado == "PAGADO") {
            $('.devolver2').find('div').find('div:first-child').text('A DEVOLVER').removeClass('text-danger text-warning').addClass('text-danger')
            $('.devolver2').find('div').find('div:last-child').text(bbdd_total_hab + '€').removeClass('text-danger text-warning').addClass('text-danger')
			hotel_apoyo = parseFloat(bbdd_total_hab);	

        } else if (bbdd_estado == "PENDIENTE") {
            $('.devolver2').find('div').find('div:first-child').text('A DEVOLVER').removeClass('text-danger text-warning').addClass('text-danger')
            $('.devolver2').find('div').find('div:last-child').text(Number(parseFloat(bbdd_total_hab) - parseFloat(bbdd_apoyo)).toFixed(2) + '€').removeClass('text-danger text-warning').addClass('text-danger')
			$('.devolver4').fadeOut();
			hotel_apoyo = parseFloat(bbdd_total_hab) - parseFloat(bbdd_apoyo);

        } else if (bbdd_estado == "DEVOLUCION") {
            $('.devolver2').find('div').find('div:first-child').text('A DEVOLVER').removeClass('text-danger text-warning').addClass('text-danger')
            $('.devolver2').find('div').find('div:last-child').text(Number(parseFloat(bbdd_total_hab) + parseFloat(bbdd_apoyo)).toFixed(2)+ '€').removeClass('text-danger text-warning').addClass('text-danger')
			hotel_apoyo = parseFloat(bbdd_total_hab) + parseFloat(bbdd_apoyo);			

        }
        estado_pago = "DEVOLUCION";
        $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
        $('#estado-pago32').addClass('estado-pago-hotel-check').removeClass('estado-pago-hotel');

    } else {
        $('.devolver2').fadeIn();
        if (bbdd_estado == "PAGADO") {
            $('.devolver2').find('div').find('div:first-child').text('A DEVOLVER').removeClass('text-danger text-warning').addClass('text-danger')
            $('.devolver2').find('div').find('div:last-child').text(bbdd_total_hab + '€').removeClass('text-danger text-warning').addClass('text-danger')

        } else if (bbdd_estado == "PENDIENTE") {
			estado_pago = "PAGADO";
            $('.devolver2').find('div').find('div:first-child').text('CONFIRMADO').removeClass('text-danger text-warning')
            $('.devolver2').find('div').find('div:last-child').text('0.00€').removeClass('text-danger text-warning')
	
			$('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
        $('#estado-pago12').fadeIn().addClass('estado-pago-hotel-check').removeClass('estado-pago-hotel');
        } else if (bbdd_estado == "DEVOLUCION") {
            $('.devolver2').find('div').find('div:first-child').text('A DEVOLVER').removeClass('text-danger text-warning').addClass('text-danger')
            $('.devolver2').find('div').find('div:last-child').text(bbdd_total_hab + bbdd_apoyo + '€').removeClass('text-danger text-warning').addClass('text-danger')

        }else if(bbdd_estado == ""){
		estado_pago = "PAGADO";
		hotel_apoyo = 0;
        $('.estado-pago-hotel-check').removeClass('estado-pago-hotel-check').addClass('estado-pago-hotel');
        $('#estado-pago12').fadeIn().addClass('estado-pago-hotel-check').removeClass('estado-pago-hotel');
		$('.devolver2').find('div').find('div:first-child').text('CONFIRMADO').removeClass('text-danger text-warning')
        $('.devolver2').find('div').find('div:last-child').text(Number.parseFloat(bbdd_total_hab + bbdd_apoyo).toFixed(2) + '€').removeClass('text-danger text-warning')
	

		}
        
		
    }
})
	$(".tarjeta_generales").on("click", function () {
    window.location.href = "https://<?php echo $_SERVER['HTTP_HOST']?>/dashboard/user.php?" + $(this).attr('id') + "=true";
})
	

	
})		
	</script>
</body>
</html>