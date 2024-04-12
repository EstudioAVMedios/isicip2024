<?php


session_start();

if ( $_GET[ 'cerrar' ] == true ) {
    $_SESSION[ 'id_admin_login' ] = "";

}
include( "encode.php" );

header( "Content-Type: text/html;charset=utf-8" );

if ( !empty( $_SESSION[ 'id_admin_login' ] ) ) {

    include( "../../../assets/php/config.php" );
    $usuarios2 = [];
    $usuarios = [];
    $activos = [];
    $columnas = [];
    $sql3 = "SELECT * FROM columns";
    $resultado4 = $cnt->prepare( $sql3 );
    $resultado4->execute();
    while ( $fila4 = $resultado4->fetch() ) {
        $columnas[] = $fila4;
    };

    $sql3 = "SELECT * FROM form WHERE VISIBILIDAD=:visi ORDER BY ID ASC";

    $resultado3 = $cnt->prepare( $sql3 );

    $resultado3->execute(array(":visi"=>0));

    while ( $fila3 = $resultado3->fetch( PDO::FETCH_ASSOC ) ) {

        if ( $fila3[ 'TYPE' ] == 1 ) {
            $activoscg[] = $fila3;
        } else if ( $fila3[ 'TYPE' ] == 2 ) {
            $usuarioscs[] = $fila3;
        } else if ( $fila3[ 'TYPE' ] == 3 ) {
            $usuariosponente[] = $fila3;
        } else if ( $fila3[ 'TYPE' ] == 4 ) {
            $usuariosmodera[] = $fila3;
        } else if ( $fila3[ 'TYPE' ] == 5 ) {
            $usuariospatro[] = $fila3;
        } else if ( $fila3[ 'TYPE' ] == 6 ) {
            $usuariosinvitado[] = $fila3;
        }
        $usuarios2[] = $fila3;
    }

    $sql = "SELECT * FROM form WHERE  VISIBILIDAD=:visi AND ESTADOQR=:estado ";
    $resultado = $cnt->prepare( $sql );
    $resultado->execute( array(":visi"=>0, ":estado" => 1 ) );
    while ( $fila = $resultado->fetch( PDO::FETCH_ASSOC ) ) {

        $usuarios3[] = $fila;

    }
    if ( $_GET[ 'search' ] != "" ) {

        $sql = "SELECT * FROM form WHERE SURNAME LIKE '%" . $_GET[ 'search' ] . "%' OR NAME LIKE '%" . $_GET[ 'search' ] . "%'";
        $resultado = $cnt->prepare( $sql );
        $resultado->execute();

        while ( $fila = $resultado->fetch( PDO::FETCH_ASSOC ) ) {

            $usuarios[] = $fila;

        }

    } elseif ( $_GET[ 'search2' ] != "" ) {
        if ( $_GET[ 'search2' ] == 3 ) {
            $sql = "SELECT * FROM form WHERE VISIBILIDAD=:visi";
            $resultado = $cnt->prepare( $sql );
            $resultado->execute(array(":visi"=>0));
            while ( $fila = $resultado->fetch( PDO::FETCH_ASSOC ) ) {

                $usuarios[] = $fila;

            }
        } else {
            $sql = "SELECT * FROM form WHERE ESTADOQR LIKE '%" . $_GET[ 'search2' ] . "%'";
            $resultado = $cnt->prepare( $sql );
            $resultado->execute();
            while ( $fila = $resultado->fetch( PDO::FETCH_ASSOC ) ) {

                $usuarios[] = $fila;

            }
        }


    } else {

        $sql2 = "SELECT * FROM form WHERE VISIBILIDAD=:visi ORDER BY ID ASC";

        $resultado2 = $cnt->prepare( $sql2 );

        $resultado2->execute(array(":visi"=>0));

        while ( $fila2 = $resultado2->fetch( PDO::FETCH_ASSOC ) ) {
            $usuarios[] = $fila2;

        }

    }


} else {
    session_destroy();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/css/tableexport.css"
        integrity="sha512-+m+NCQG6uttXsLjwxHTUdhov99LW3TSFEiM2LSFMwfOePszb2as348/96cCBG35mOK+3Gp4P0EQRWpKLZfGTnA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/icon/iconfonts.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <button class="ir-arriba" javascript:void(0) title="Volver arriba"> <span class="fa-stack"> <i
                class="fa fa-circle fa-stack-2x"></i> <i class="fa fa-arrow-up fa-stack-1x fa-inverse"></i> </span>
    </button>
    <div class="d-block">
        <nav class="navbar navbar-expand-lg navbar-light position-fixed w-100 shadow"
            style="z-index: 3;top:0px; background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);">
            <h1><a href="index.html" class="logo"><img src="Imagenes/logo_white.png" class="me-auto px-5 mx-5"
                        style='height: 70px'></a></h1>
            <div class="d-flex ms-auto" id="navbarNavDropdown">
                <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
                <ul class="navbar-nav ms-auto px-5">
                    <!-- <li class="nav-item"> <a class="nav-link  text-white" href="index.php"><i class="fas fa-tools"></i> Panel de Administración</a> </li>-->
                    <li class="nav-item"> <a class="nav-link  text-white text-dark" href="../../user.php"><i
                                class="icon-users"></i> Users</a> </li>
                    <!-- <li class="nav-item"> <a class="nav-link  text-white text-dark" href="../../user.php?cerrar=true"><i
                                class="icon-power"></i> Salir</a> </li> -->
                </ul>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-light position-fixed w-100 shadow"
            style="top:90px;height: 70px;z-index: 2">
            <div class="container">
                <div class='d-flex me-auto'>
                    <div class="dropdown">
                        <button class="btn bg-none text-secondary" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false"> Registrados <span class="badge rounded-pill bg-secondary"
                                style="font-size: 20px; padding: 5px 20px;"><?php echo count($usuarios2)?></span>
                        </button>
                        <button class="btn bg-none text-success" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false"> Presentes en sala <span class="badge rounded-pill bg-success"
                                style="font-size: 20px; padding: 5px 20px;"
                                id="contador"><?php echo count($usuarios3)?></span> </button>
                    </div>

                    <!--<h5 class="mx-4">CÓDIGOS <span class="badge bg-dark"><?php /*echo count($usuarios)-count($tpv)-count($bank)*/?></span></h5>-->
                </div>
                <div class="d-flex ms-auto" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto mt-2">

                        <!--<li> <a  href='#' class="ov-btn-slide-left mx-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop2"><i class="icon-cloud-download-alt"></i> Exportar usuarios</a></li>-->
                        <li> <a href="https://<?php echo $_SERVER['SERVER_NAME'] ?>/dashboard/scanner/dashboard/user.php"
                                class="ov-btn-slide-left mx-2" id="usuarios"><i class="icon-users"></i>Usuarios</a>
                        </li>
                        <!--  <li> <a href = "user.php" class="ov-btn-slide-left mx-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop3"><img src='Imagenes/user-plus.png' style="width: 25px"> </a></li>-->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div id="total_users" style="z-index: 0;margin-top:200px" class="d-block">
        <div class="mt-5 m-auto" style="width: 90%">

            <div class="row container-fluid controles">
                <form class="col-6  g-3 me-auto" action="<?php echo $_SERVER['PHP_SELF']?>" style="width: 40%"
                    id='control'>
                    <div class="col-auto d-inline-block">

                        <input type="text" class="form-control border" id="inputPassword2"
                            placeholder="Correo electrónico" name="search" style="width: 200px">
                    </div>
                    <div class="col-auto mb-3 d-inline-block">
                        <!--<button type="submit" class="btn btn-dark mb-3"><i class="fas fa-search"></i> Buscar</button>-->
                        <button href="user.php" class="ov-btn-slide-left "><i class="icon-search"></i> Buscar </button>
                    </div>
                </form>
                <form class="col-6 g-3 ms-auto d-inline-block text-end" action="<?php echo $_SERVER['PHP_SELF']?>"
                    style="width: 60%" id='control1'>
                    <a href="https://<?php echo $_SERVER['SERVER_NAME'] ?>/dashboard/scanner/dashboard/user.php"
                        class="btn btn-outline-dark btn-sm rounded-pill active selector" id="btn_all">Todos los
                        usuarios</a>
                    <button type='button' class="btn btn-outline-success btn-sm rounded-pill selector"
                        id="btn_presente">Presentes en
                        sala</button>
                    <button type='button' class="btn btn-outline-danger btn-sm btn-outline rounded-pill selector"
                        id="btn_ausente">Fuera
                        de
                        sala</button>
                    <div class="col-auto d-inline-block w-100">


                        <!-- <select name="search2" class="form-select border" style="cursor: pointer">
          <option hidden>Filtros...</option>
          <option value='3'>TODOS LOS USUARIOS</option>
          <option value='1'>PRESENTES EN SALA (Tiempo real)</option>
          <option value='0'>FUERA DE SALA (Tiempo real)</option>
        </select>-->
                    </div>

                </form>
            </div>
            <table class="table table-hover m-auto" id="data_table" style="font-size: 12px">
                <thead class="m-auto">
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>NOMBRE</th>
                        <th scope='col'>APELLIDOS</th>
                        <th scope='col'>EMAIL</th>
                        <th scope='col'>ESTADO</th>
                    </tr>
                </thead>
                <tbody id="todos">

                    <?php
        foreach ( $usuarios as $elemento ):
            if ( $elemento[ 'ESTADOQR' ] == 1 ) {

                $estado = "<span class=' bg-success  text-white p-1 px-2 rounded-pill' style='cursor:auto'>Presente en sala</span>";
            } else {

                $estado = "<p hidden>" . $elemento[ 'ID' ] . "</p><span class='bg-danger text-white p-1 px-2 cambio rounded-pill' style='cursor:default'>Fuera de sala</span>";


            }
 /******************************RELLENAR COLUMNAS*****************************/
?>

                    <tr class='border '>
                        <td scope='col'><?php echo $elemento['ID'];?></td>
                        <td scope='col'><?php echo $elemento['NAME'];?></td>
                        <td scope='col'><?php echo $elemento['SURNAME'];?></td>
                        <td scope='col'><?php echo $elemento['EMAIL'];?></td>
                        <td><?php echo $estado;?></td>
                    </tr>

                    <?php      
        endforeach;
        ?>
                </tbody>
            </table>
            <table class="table table-hover m-auto" id="data_table2" style="font-size: 12px;display: none;">
                <thead class="m-auto">
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>NOMBRE</th>
                        <th scope='col'>APELLIDOS</th>
                        <th scope='col'>EMAIL</th>
                        <th scope='col'>ESTADO</th>
                    </tr>
                </thead>
                <tbody id="activos">
                </tbody>
            </table>
            <table class="table table-hover m-auto" id="data_table3" style="font-size: 12px;display: none;">
                <thead class="m-auto">
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>NOMBRE</th>
                        <th scope='col'>APELLIDOS</th>
                        <th scope='col'>EMAIL</th>
                        <th scope='col'>ESTADO</th>
                    </tr>
                </thead>
                <tbody id="ausentes">
                </tbody>
            </table>
        </div>
    </div>
    <!----------------------------------MODAL---------------------------------------------->

    <!-- Button trigger modal -->

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

    <script>
    $(document).ready(function() {

        $(".cambio").click(function() {

            $.ajax({
                url: "php/present.php",
                type: "POST",
                data: "id=" + $(this).prevAll("p").text(),
                success: function(res) {
                    if ($.trim(res) == "ok") {
                        location.reload();
                    }
                    console.log(res);
                }

            })

        })


        var users = [''];
        var count = 0;
        setInterval(nuevo, 3000);



        $('#btn_presente').click(function() {

            $('#data_table').fadeOut();
            $('#data_table3').fadeOut();
            $('#data_table2').delay(1000).fadeIn();
            $('#control input').prop('disabled', 'true');

        })
        $('#btn_ausente').click(function() {

            $('#data_table').fadeOut();
            $('#data_table3').delay(1000).fadeIn();
            $('#data_table2').fadeOut();
            $('#control input').prop('disabled', 'true');

        })



        function resetear() {
            window.location.href =
                "https://<?php echo $_SERVER['SERVER_NAME'] ?>/dashboard/scanner/dashboard/user.php";
        }

        function reset() {
            window.location.href =
                "https://<?php echo $_SERVER['SERVER_NAME'] ?>/dashboard/scanner/dashboard/user.php";
        }


        function nuevo() {
            $.ajax({
                url: "php/activos.php",
                type: "POST",
                data: "data=si",
                success: function(res) {
                    var datos = JSON.parse(res);

                    $("#ausentes tr").remove();
                    $("#activos tr").remove();
                    $("#todos tr").remove();
                    for (var i = 0; i < datos.length; i++) {

                        if (datos[i].ESTADOQR == 1) {
                            var estado =
                                "<td class='presente'><span class='bg-success text-white py-1 px-2 rounded-pill' style='cursor:default'>Presente en sala</span></td>"
                        } else {
                            var estado =
                                "<td clas='ausente'><span class='bg-danger text-white py-1 px-2 rounded-pill' style='cursor:default'>Fuera de sala</span></td>"
                        }

                        $('#todos').append("<tr class='border'><td>" + datos[i].ID +
                            "</td><td>" + datos[i].NAME + "</td><td>" + datos[i].SURNAME +
                            "</td><td>" + datos[i].EMAIL + "</td>" + estado);

                        if (datos[i].ESTADOQR == 1) {
                            count++;
                            $('#activos').append("<tr class='border'><td>" + datos[i].ID +
                                "</td><td>" + datos[i].NAME + "</td><td>" + datos[i].SURNAME +
                                "</td><td>" + datos[i].EMAIL + "</td>" + estado)
                        } else {
                            $('#ausentes').append("<tr class='border'><td>" + datos[i].ID +
                                "</td><td>" + datos[i].NAME + "</td><td>" + datos[i].SURNAME +
                                "</td><td>" + datos[i].EMAIL + "</td>" + estado)
                        }




                    }
                    $('#contador').text(count);
                    count = 0;
                }

            })

        }

        $('#seguimiento').click(function() {

        })
        $('#usuarios').click(function() {

        })



    })
    $('.selector').on('click', function() {
        $('.selector').removeClass('active')
        $(this).addClass('active');
    })
    </script>
</body>

</html>