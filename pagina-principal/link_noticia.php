<?php
session_start();

include "../php/conexion-mysql/conexion.php";
?>



<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <title>Noticias recientes</title>
    <?php include "../funciones/enlases.php";?>
</head>

<body>
  <?php include "../funciones/loader.php"; ?>
    
  <img class="logo" src="../imagenes/logo.png" alt="imagen no carga" height="60px">
    <!-- comienso del menu principal -->
    <?php include "../funciones/barra_seccion.php";?>
    <?php include "../funciones/barra.php";?>
    <!-- final del menu principal -->
    <div class="noti_resi">
        <h1><i class="far fa-newspaper tamaño_icon colorp1"></i> Noticias recientes</h1>
        <form method="get" action="buscar_noticia.php" class="for_busqueda busqueda_noticia">
            <fieldset>
                <input type="text" name="buscar" id="buscar" placeholder="Buscar...">
                <button type="submit" class="bot_buscar"><i class="fas fa-search tamaño_icon"></i></button>
            </fieldset>                   
        </form>
        <div class="con_noticia">
            <?php
            $buscar = strtolower($_REQUEST['buscar']);
            if (empty($buscar)) {
                header("location: buscar_noticia.php");
                mysqli_close($conection);
            }

            $query_conteo = mysqli_query($conection, "SELECT COUNT(*) as conteo FROM noticias WHERE (id_noticias LIKE '%$buscar%' OR titulo LIKE '%$buscar%' OR fecha LIKE '%$buscar%' )");

            $resultado_conteo = mysqli_fetch_array($query_conteo);
            $conteo           = $resultado_conteo['conteo'];
            $por_pagina       = 1;
            if (empty($_GET['pagina'])) {
                $pagina = 1;
            } else {
                $pagina = $_GET['pagina'];
            }
            $desde           = ($pagina - 1) * $por_pagina;
            $total_de_pagina = ceil($conteo / $por_pagina);

            $query     = mysqli_query($conection, "SELECT l.id_noticias,l.titulo,l.noticia,l.fecha,n.nombre_user,l.foto FROM noticias l INNER JOIN iniciopn n ON l.creador_id = n.id_user WHERE (l.id_noticias LIKE '%$buscar%' OR l.titulo LIKE '%$buscar%') ORDER BY l.id_noticias DESC LIMIT $desde,$por_pagina");
            $resultado = mysqli_num_rows($query);
            if ($resultado > 0) {
                while ($data = mysqli_fetch_array($query)) {
                    if ($data['foto'] != 'imagen_noticia.png') {
                        $foto = '../imagenes/noticias-img/' . $data['foto'];
                    } else {
                        $foto = '../imagenes/' . $data['foto'];
                    }
                    ?>
                    <div class="contenedor_de_nocticias">
                        <h2><?php echo $data['titulo']; ?></h2>
                        <hr>
                        <center>
                            <img src="<?php echo $foto; ?>" alt=""></center>
                            <p><?php echo $data['noticia']; ?></p>
                            <?php if ($_SESSION['rol'] == 1) {?>
                    <a class="noti_modi" href="modificar_noticia.php?id=<?php echo $data['id_noticias']; ?>" title="Modificar"><i class="fas fa-edit"></i> Modificar</a>
                    <a class="noti_eliminar" id="eli-mod" href="eliminar_noticia.php?id=<?php echo $data['id_noticias']; ?>" title="Eliminar"><i class="far fa-trash-alt"></i> Eliminar</a>
                            <?php }if($_SESSION['rol'] == 2){?>

                    <a class="noti_modi" href="modificar_noticia.php?id=<?php echo $data['id_noticias']; ?>" title="Modificar"><i class="fas fa-edit"></i> Modificar</a>
                        </div>
                        <?php 
                    }
                    }
                }
                ?>

            </div>
        </div>
    </body>
    <?php
    include "../funciones/footer.php";
    ?>
    </html>
