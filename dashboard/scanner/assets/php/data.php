<?php

include( "../../../../assets/php/config.php" );

if ( $_GET[ 'usuario' ] ) {
    $id = $_GET[ 'usuario' ];
    $sql = "SELECT * FROM registro_spa WHERE ID=:id";
    $resultado = $cnt->prepare( $sql );
    $resultado->execute( array( ":id" => $id ) );
    $fila = $resultado->rowCount();
    $datos = $resultado->fetch( PDO::FETCH_ASSOC );

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
</head>

<body>
    <section class="container">
        <div class="card m-auto w-100 shadow rounded-4 mt-5" style="width: 18rem;">
            <div class="rounded-4"
                style="background: linear-gradient(45deg, rgba(50,225,159,1) 32%, rgba(229,255,71,1) 100%);"> <img
                    src="../Imagenes/logo.png" class="card-img-top p-4 text-center m-auto" style='width: 50%!important'>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $datos['NAME'] . " " . $datos["SURNAME"]?></h5>

            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>FILA: </strong><?php echo $datos['FILA']?></li>
                <li class="list-group-item"><strong>ASIENTO: </strong><?php echo $datos['ASIENTO']?></li>
                <li class="list-group-item">
                    <?php
        if ( $datos[ 'ESTADO' ] == 0 ) {
            echo "FUERA DE SALA";
        } else {
            echo "PRESENTE EN SALA";
        }
        ?>
                </li>
            </ul>

        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</body>

</html>