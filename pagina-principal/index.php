<?php session_start();?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Zona Educativa Distrito Capital</title>
    <?php include "../funciones/enlases.php";?>
</head>

<body>
  <?php include "../funciones/loader.php"; ?>
    
  <img class="logo" src="../imagenes/logo.png" alt="imagen no carga" height="60px">
    <?php
//<!-- comienso del menu principal -->
    include "../funciones/barra_seccion.php";
    include "../funciones/barra.php";
//<!-- final del menu principal -->
    ?>
    <?php include "../funciones/slider_noticias.php"; ?>
    <div class="contentt">
        <div class="cal_conte">
            <!--calendario-->
            <div class="calendario">
                <a href="../imagenes/calendario/calendario.jpg" target="_blank"><img src="../imagenes/calendario/calendario.jpg" alt=""></a>
            </div>
            <!--fin calendario-->
        </div>
        <!--bloke de twitter-->
        <div class="twitter_timeline">
            <a class="twitter-timeline" data-width="230" data-height="300" href="https://twitter.com/ZonaEducativaDC?ref_src=twsrc%5Etfw">Twitter</a>
            <script async src="../js/widgets.js" charset="utf-8"></script>
        </div>
        <!--fin bloke de twitter-->
    </div>
</body>

<?php
include "../funciones/footer.php";
?>
</html>
