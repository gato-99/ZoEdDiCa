<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}
include "../php/conexion-mysql/conexion.php";
if (!empty($_POST)) {
    $id_noticias    = $_POST['id_noticias'];
    $query_eliminar = mysqli_query($conection, "DELETE FROM noticias WHERE id_noticias = $id_noticias");
    mysqli_close($conection);
    if ($query_eliminar) {
        header("location: ver_noticia.php");
    } else {
        echo "Error al eliminar la noticia";
    }
}
if (empty($_REQUEST['id'])) {
    header("location: ver_noticia.php");
    mysqli_close($conection);
} else {

    $id_noticias = $_REQUEST['id'];
    $query       = mysqli_query($conection, "SELECT * FROM noticias WHERE id_noticias = $id_noticias");
    mysqli_close($conection);
    $resultado = mysqli_num_rows($query);

    if ($resultado > 0) {
        while ($data = mysqli_fetch_array($query)) {
            $titulo     = $data['titulo'];
            $noticia    = $data['noticia'];
            $fecha      = $data['fecha'];
            $creador_id = $data['creador_id'];
            $foto       = $data['foto'];

            
            if ($data['foto'] != 'imagen_noticia.png' ) {
                $foto = '../imagenes/noticias-img/'.$data['foto'];
            }else{
                $foto = '../imagenes/'.$data['foto'];
            }
            
        }

    } else {
        header("location:ver_noticia.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es-ES">

<head>
  <meta charset="UTF-8">
  <title>Eliminar noticia</title>
  <?php include "../funciones/enlases.php";?>
</head>

<body>
  <?php include "../funciones/loader.php"; ?>

  <img class="logo" src="../imagenes/logo.png" alt="imagen no carga" height="60px">
  <!-- comienso del menu principal -->
  <?php include "../funciones/barra_seccion.php";?>
  <?php include "../funciones/barra.php";?>
  <!-- final del menu principal -->
  <div class="con_eli">
    <h2><i class="far fa-newspaper"></i> ¿Desea eliminar la noticia?</h2>
    <hr>
    <p class="titulo_noti"><?php echo $titulo; ?></p>

    <div class="imgen_noti"><img src="<?php echo $foto; ?>" alt=""></div>

    <form method="post" action="#">
      <input type="hidden" name="id_noticias" value="<?php echo $id_noticias; ?>">
      <center>
        <a href="ver_noticia.php" class=" botom botom--celi"> Cancelar <i class="far fa-caret-square-left tamaño_icon"></i></a>
        <button type="submit" class=" botom botom--eli"> Eliminar <i class="far fa-trash-alt tamaño_icon"></i></button>
      </center>
    </form>
  </div>
</body>
<?php
include "../funciones/footer.php";
?>

</html>