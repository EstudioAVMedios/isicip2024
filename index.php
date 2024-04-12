<?php
header("location:https://isicip.com");
echo "<script>window.location.href='https://isicip.com'</script>";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISICIP 2024</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Enlaza tu archivo CSS aquí si lo tienes -->
    <link rel="icon" href="assets/images/fav.png" type="image/x-icon">
</head>

<body>

    <!-- Encabezado de la página -->
    <header>
        <div class="logo">
            <img src="assets/images/logo-light.png" alt="Logo" style="width:100%;height:auto;">
        </div>
        <nav>
            <ul>
                <li><a href="https://isicip2024.com">Home</a></li>
                <li><a href="https://isicip2024.com/#programa">Program</a></li>

            </ul>
        </nav>
    </header>


    <section style="background-image: url(assets/images/banner.png);width:100%;height:1080px;margin-top:-180px;">
        <div class="container">
            <!-- Columna con imagen -->
            <div class="column" style="margin-top:200px;">
                <img src="assets/images/fecha.png" alt="Imagen" style="width:800px;">
            </div>
            <!-- Columna con pastilla redondeada 
        <div class="column" style="padding-top:200px;">
            <div class="pill">
                <h3 style="color:black;font-weight:bold;font-family: 'Poppins', sans-serif;">Personal area</h3>
            </div>
        </div>
        -->
        </div>
    </section>

    <section>
        <div id="programa" class="tarifa">
            <img src="assets/images/tarifa.jpg" alt="PRICES">
            <a href="assets/files/programa.pdf" download class="download-button">Program Download</a>
    </section>

</body>

</html>