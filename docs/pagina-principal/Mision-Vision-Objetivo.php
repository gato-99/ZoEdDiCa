<?php session_start(); ?>


<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8">
    <title>Misión-Visión-Objetivo</title>
    <?php include "../funciones/enlases.php"; ?>
</head>

<body>
  <?php include "../funciones/loader.php"; ?>
    
  <img class="logo" src="../imagenes/logo.png" alt="imagen no carga" height="60px">
        <?php
        include "../funciones/barra_seccion.php";
        include "../funciones/barra.php";
		//<!-- final del menu principal -->
        
        ?>
        <div class="informacion">
            <h1>Misión</h1><br>
            <p>
                Garantizar que en los Planteles Educativos del Distrito Capital se imparta una educación integral y de calidad a la población de niños, niñas, adolescentes, jóvenes y adultos de todos los niveles y modalidades del sistema educativo, atendiendo a los principios de equidad y justicia social, para formar ciudadanos y ciudadanas aptos y aptas que se integren de manera activa al desarrollo productivo, económico, social y político del país.<br>
            </p>
            <hr>
            <h1>Visión</h1><br>
            <p>
                Prestar el mejor servicio a la comunidad, siempre en búsqueda de la excelencia en los procesos pedagógicos y administrativos que se ejecutan en los Planteles Educativos del Distrito Capital.<br>
            </p>
            <hr>
            <h1>Objetivo de la oficina de tecnologia de la informacion</h1><br>
            <p>La oficina de la tecnologia de la infromacion y comunicacion tiene como objetico asesorar y asistir en materia de uso de esta tecnologias a la Zona Educativa asi como promover el uso obtimmo de la misma, el govierno electronico y la tecnologia libre conforme a los liniamientos de la oficina de la tecnologia de la informacion y la comunicacion del ministerio del poder popular para la Educaion.</p>
        </div>

</body>
<?php
include "../funciones/footer.php";
?>

</html>
