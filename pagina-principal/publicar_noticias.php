<?php
session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
    header("location: ./");
}

include "../php/conexion-mysql/conexion.php";
if (!empty($_POST)) {
    $alert = '';

    if (empty($_POST['titulo']) || empty($_POST['noticia'])) {
        $alert = "<p class='M-error'>Ambos campos son obligatorio <i class='fas fa-times-circle'></i></p>";
    } else {
        $titulo  = $_POST['titulo'];
        $noticia = $_POST['noticia'];
        $iduser  = $_SESSION['iduser'];

        $imagen     = $_FILES['foto'];
        $nombre_img = $imagen['name'];
        $tipo_img   = $imagen['type'];
        $ruta_tmp   = $imagen['tmp_name'];

        $img_noticia = 'imagen_noticia.png';

        if ($nombre_img != '') {
            $ruta        = '../imagenes/noticias-img/';
            $nombre_img  = 'img_' . md5(date('d-m-y H:m:s'));
            $img_noticia = $nombre_img . '.jpg';
            $src         = $ruta . $img_noticia;
        }

        $query = mysqli_query($conection, "INSERT INTO noticias (titulo,noticia,creador_id,foto) VALUES('$titulo','$noticia','$iduser','$img_noticia')");
        if ($query) {
            if ($nombre_img != '') {
                move_uploaded_file($ruta_tmp, $src);
            }
            $alert = "<p class='M-aprobado'>Noticia publicada <i class='far fa-check-circle'></i></p>";

        } else {
            $alert = "<p class='M-error'>Error al publicar la noticia <i class='fas fa-times-circle'></i></p>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <title>Publicar noticias</title>
    
    <?php include "../funciones/enlases.php";?>
</head>

<body>
  <?php include "../funciones/loader.php"; ?>
    
  <img class="logo" src="../imagenes/logo.png" alt="imagen no carga" height="60px">
    <!-- comienso del menu principal -->
    <?php include "../funciones/barra_seccion.php";?>
    <?php include "../funciones/barra.php";?>
    <!-- final del menu principal -->

    <div class="for_de_noticias">
        <h1><i class="far fa-newspaper colorp1"></i> &nbsp;Publica noticias</h1>
        <hr>
        <div class="con_noticia">
            <form method="post" action="#" enctype="multipart/form-data">
                <div class="alerta">
                    <?php echo isset($alert) ? $alert : ''; ?>
                </div>
                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo" class="borderPres">

                <label for="noticia">Noticia:</label>
                <textarea name="noticia" id="summernote"></textarea>

                <div class="photo">
                    <input type="checkbox" name="" id="anadir-imgen">
                    <label for="anadir-imgen"><i class="far fa-image"></i><i class="fas fa-plus icon-aco"></i> Añadir imagen:</label>
                    <div class="prevPhoto">
                        <span class="delPhoto notBlock"><i class="far fa-times-circle"></i></span>
                        <label for="foto"></label></div>
                        <div class="upimg"><input type="file" name="foto" id="foto"></div>
                        <div id="form_alert"></div>
                    </div>
                    <br>
                    <center>
                        <button type="submit" class="BT_crear bt_noti"><i class="far fa-newspaper"></i> Publicar noticia </button>
                    </center>
                </form>
            </div>

        </div>

    </body>
    <?php
    include "../funciones/footer.php";
    ?>

    </html>
