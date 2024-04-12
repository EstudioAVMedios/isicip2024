<?php

session_start();


if ( !empty( $_SESSION[ 'id_admin_login' ] )or!empty( $_SESSION[ 'id_admin_login2' ] ) ) {

} else {

    session_destroy();

    header( "location:access.php" );

}


include( "../../assets/php/config.php" );


date_default_timezone_set( "Europe/Madrid" );
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
$sql2 = "SELECT * FROM form WHERE VISIBILIDAD=0";
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
$sql3 = "SELECT * FROM habitaciones";
$resultado3 = $cnt->prepare( $sql3 );
$resultado3->execute();
while ( $fila6 = $resultado3->fetch( PDO::FETCH_ASSOC ) ) {
    $habitaciones[] = $fila6;
}


$sql3 = "SELECT * FROM generales_form";
$resultado3 = $cnt->prepare( $sql3 );
$resultado3->execute();
$generales_form = $resultado3->fetch( PDO::FETCH_ASSOC );


$sql3 = "SELECT * FROM evento";
$resultado3 = $cnt->prepare( $sql3 );
$resultado3->execute();
$evento = $resultado3->fetch( PDO::FETCH_ASSOC );

$sql3 = "SELECT * FROM columns";
$resultado4 = $cnt->prepare( $sql3 );
$resultado4->execute();
while ( $fila4 = $resultado4->fetch() ) {
    $columnas[] = $fila4;
};


if ( $generales_form[ 'ESTADO_ACOMPA' ] == 1 ):
    $sql2 = "SELECT * FROM acompa  ORDER BY ID ASC";

$resultado2 = $cnt->prepare( $sql2 );

$resultado2->execute();

while ( $fila2 = $resultado2->fetch( PDO::FETCH_ASSOC ) ) {
    $acompanante[] = $fila2;

}
endif;
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
header( 'Content-type: application/vnd.ms-excel' );

header( "Content-Disposition: attachment; filename=" . $evento[ 'NAME' ] . "_" . date( "m.d.y" ) . ".xls" ); //Indica el nombre del archivo resultante

header( "Pragma: no-cache" );

header( "Expires: 0" );

?>
<html lang="en">

<head>
    <title>Dashboard INICIO</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!---------------bloqueo de cache------------------------------------>

    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style></style>
</head>

<table class="table table-hover m-auto" id="data_table" style="font-size: 10px">
    <thead class="m-auto">
        <tr>
            <!--******************************************CREAR TABLA*****************************************-->
            <?php
      $cuota = 0;
      foreach ( $columnas as $elemento ):
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
            <?php else:?>
            <?php
      endif;
      else :?>
            <th scope='col'><strong><?php echo $elemento[ 'COLUMNS' ];?></strong></th>
            <?php endif;endif; endif; endforeach;?>
            <th scope='col'><strong>ESTADO BALANCE</strong></th>
            <th scope='col'><strong>METODO DE PAGO</strong></th>
            <th scope='col'><strong>CODE</strong></th>
        </tr>
    </thead>
    <tbody>

        <?php
    foreach ( $usuarios as $elemento ):
        $code="<td class='start' style='vertical-align: top'>".$elemento['CODE']."</td>";
        if ( $elemento[ 'ESTADO' ] == 1 ):
            $estado = "<td class='start' style='vertical-align: top'>CONFIRMADO</td>";
            foreach ( $pagos as $elemento3 ) {               
                if ( $elemento[ 'ID' ] == $elemento3[ 'USER_ID' ] ) {
            $metodo = "<td class='start' style='vertical-align: top'>".$elemento3['CUOTA_PAGO']."</td>";
                }};
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
                    $metodo = "<td class='start' style='vertical-align: top'>".$elemento3['CUOTA_PAGO']."</td>";
               
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

                $estado = "<td style='vertical-align: top'>PENDIENTE</td>";
            } else {

                $estado = "<td style='vertical-align: top'>DEVOLVER</td>";
                $total_pendiete = $total_devolucion - $total_pendiete;
            }
        } else {

            $estado = "<td style='vertical-align: top'>Error TPV</td>";
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
            <td class='email' style="vertical-align: top"><?php echo $elemento[ $elemento2[ 'COLUMNS' ] ] ?></td>
            <?php
      else :
          if ( $elemento2[ 'COLUMNS' ] == "ACOMPA" ):
              if ( $generales_form[ 'ESTADO_ACOMPA' ] == 1 ):
                  if ( $elemento[ $elemento2[ 'COLUMNS' ] ] == "Si" ): ?>
            <td class='text-start' style="vertical-align: top"> Si</td>
            <?php else:?>
            <td class='text-start' style="vertical-align: top">No</td>
            <?php
      endif;
      endif;
      elseif ( $elemento2[ 'COLUMNS' ] == "HOTEL" ):
          if ( $elemento[ 'HABITACION' ] != 0.00 ): ?>
            <td class='text-start' style="vertical-align: top"> Si</td>
            <?php else:?>
            <td class='text-start' style="vertical-align: top"> No</td>
            <?php
      endif;

      else :
          if ( $elemento2[ 'COLUMNS' ] == "ID" ): ?>
            <td class='text-start ' style="vertical-align: top"><?php echo $elemento[ 'ID' ] ?></td>
            <?php
      else :
        
          if ( $elemento2[ 'COLUMNS' ] == "CUOTA" ):
              foreach ( $pagos as $elemento3 ) {
                  if ( $elemento[ 'ID' ] == $elemento3[ "USER_ID" ] ): ?>
            <td class='text-start' style="vertical-align: top"><?php echo $elemento3[ 'CUOTA' ]?>€</td>
            <?php
      endif;
      } else :

          if ( $elemento2[ 'COLUMNS' ] == "CUOTA_ACOMPA" ) {
              if ( $generales_form[ 'ESTADO_ACOMPA' ] == 1 ):
                  foreach ( $pagos as $elemento3 ) {
                      if ( $elemento[ 'ID' ] == $elemento3[ "USER_ID" ] ) {

                          if ( $elemento3[ "ACOMPA_CUOTA" ] != 0 ): ?>
            <td class='text-start' style="vertical-align: top"><?php echo $elemento3[ 'ACOMPA_CUOTA' ] ?>€</td>
            <?php elseif ( $elemento3[ "ACOMPA_CUOTA" ] == 0 and $elemento3[ "ACOMPA_PAGO" ] == "FREE" ):?>
            <td class='text-start' style="vertical-align: top"><?php echo $elemento3[ 'ACOMPA_CUOTA' ] ?>€</td>
            <?php
      elseif ( $elemento3[ "ACOMPA_CUOTA" ] == 0 and $elemento3[ "ACOMPA_PAGO" ] != ""
          and $elemento3[ "ACOMPA_PAGO" ] != "" ):
          if ( $elemento[ 'ACOMPA' ] == "Si" ): ?>
            <td class='text-start' style="vertical-align: top"><?php echo $elemento3[ 'ACOMPA_CUOTA' ] ?>€</td>
            <?php  else :?>
            <td class='text-start' style="vertical-align: top">(N.S)</td>
            <?php
      endif;

      else :?>
            <td class='text-start' style="vertical-align: top">(N.S)</td>
            <?php
      endif;

      }
      }
      endif;
      } else {
$total_hotel=0;
          if ( $elemento2[ 'COLUMNS' ] == "PAGO_HOTEL" ) {
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
            <td class='text-start' style="vertical-align: top">(N.S)</td>
            <?php else:?>
            <td class='text-start' style="vertical-align: top">
                <?php echo number_format( $total_hotel, 2, ',', '.' )  ?>€</td>
            <?php
      endif;
      } else {
          if ( $elemento2[ 'COLUMNS' ] == "BALANCE" ): ?>
            <td style="vertical-align: top"><?php echo number_format( $total_pendiete, 2, ',', '.' ) ?>€</td>
            <?php
      else :


          if ( $elemento2[ 'COLUMNS' ] == "HABITACION" ):
              $habita = "Sin Reserva";
      $noch = "Sin Reserva";
      $entrada = "Sin Reserva";
      $salida = "Sin Reserva";
      $count = 0;
      foreach ( $reservas as $elemento8 ) {
          if ( $elemento8[ 'USER_ID' ] == $elemento[ 'ID' ] ) {
              $count++;
              if ( $habita == "Sin Reserva" ) {
                  $habita = $elemento8[ 'HABITACION' ];
                  $noch = $elemento8[ 'NOCHES' ];
                  $entrada = $elemento8[ 'F_ENTRADA' ];
                  $salida = $elemento8[ 'F_SALIDA' ];
              } else {
                  $count++;
                  $habita .= " <br>" . $elemento8[ 'HABITACION' ];
                  $noch .= " <br>" . $elemento8[ 'NOCHES' ];
                  $entrada .= " <br>" . $elemento8[ 'F_ENTRADA' ];
                  $salida .= " <br>" . $elemento8[ 'F_SALIDA' ];
              }

          }
      }
      if ( $count>1):
          ?>
            <td class='text-start bg-light' style="vertical-align: top; background:#e3e3e3"><?php echo $habita?></td>
            <td class='text-start bg-light' style="vertical-align: top; background:#e3e3e3"><?php echo $noch?></td>
            <td class='text-start bg-light' style="vertical-align: top; background:#e3e3e3"><?php echo $entrada?></td>
            <td class='text-start bg-light' style="vertical-align: top; background:#e3e3e3"><?php echo $salida?></td>
            <?php
      else :?>
            <td class='text-start' style="vertical-align: top;"><?php echo $habita?></td>
            <td class='text-start' style="vertical-align: top;"><?php echo $noch?></td>
            <td class='text-start ' style="vertical-align: top;"><?php echo $entrada?></td>
            <td class='text-start ' style="vertical-align: top;"><?php echo $salida?></td>
            <?php
      endif;
      else :
          if ( $elemento2[ 'COLUMNS' ] == "NOCHES"
              or $elemento2[ 'COLUMNS' ] == "F_ENTRADA"
              or $elemento2[ 'COLUMNS' ] == "F_SALIDA" ):
              else :
                  if ( $elemento2[ 'COLUMNS' ] == "ID" ):
                      ?>
            <td class='text-start id_lista' id="<?php echo $elemento['ID']?>" style="vertical-align: top">
                <?php echo $elemento[ $elemento2[ 'COLUMNS' ] ]?></td>
            <?php
      else :?>
            <td class='text-start' style="vertical-align: top"><?php echo $elemento[ $elemento2[ 'COLUMNS' ] ]?></td>
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
            <?php  echo $estado.$metodo.$code; ?>
        </tr>
        <?php    endforeach;?>
    </tbody>
</table>