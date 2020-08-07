<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}
include "../php/conexion-mysql/conexion.php";
if (!empty($_POST)) {
    if ($_POST['id_user'] == 1) {
        header("location: consulta-modifica-elimina.php");
        mysqli_close($conection);
        exit;
    }
    $id_user        = $_POST['id_user'];
    $query_eliminar = mysqli_query($conection, "DELETE FROM iniciopn WHERE id_user = $id_user");
    mysqli_close($conection);
    if ($query_eliminar) {
        header("location: consulta-modifica-elimina.php");
    } else {
        echo "Error al eliminar el usuario";
    }

}

if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
    header("location: consulta-modifica-elimina.php");
    mysqli_close($conection);
} else {

    $id_user = $_REQUEST['id'];
    $query   = mysqli_query($conection, "SELECT u.nombre_user, u.CI, u.nombre, r.rol FROM iniciopn u INNER JOIN rol r ON u.rol_id = r.id WHERE u.id_user = $id_user");
    mysqli_close($conection);
    $resultado = mysqli_num_rows($query);

    if ($resultado > 0) {
        while ($data = mysqli_fetch_array($query)) {
            $nombre_user = $data['nombre_user'];
            $ci          = $data['CI'];
            $user        = $data['nombre'];
            $rol         = $data['rol'];

        }
    } else {
        header("location: consulta-modifica-elimina.php");
    }

}

?>

<!DOCTYPE html>
<html lang="es-ES">

<head>
  <meta charset="UTF-8">
  <title>Eliminar Usuario</title>
  <?php include "../funciones/enlases.php";?>
</head>

<body>
  <?php include "../funciones/loader.php"; ?>

  <img class="logo" src="../imagenes/logo.png" alt="imagen no carga" height="60px">
  <!-- comienso del menu principal -->
  <?php include "../funciones/barra_seccion.php";?>
  <?php include "../funciones/barra.php";?>
  <!-- final del menu principal -->
  <section class="con_eliminar">
    <h2><i class="fas fa-user-times colorp1"></i> ¿Desea eliminar el usuario?</h2>
    <hr>
    <div class="eliminar_use">

      <p>Nombre: <span><?php echo $nombre_user; ?></span></p>
      <p>CI de usuario: <span><?php echo $ci; ?></span></p>
      <p>Usuario: <span><?php echo $user; ?></span></p>
      <p>Tipo de usuario: <span><?php echo $rol; ?></span></p>
      <form method="post" action="#">
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
        <a href="consulta-modifica-elimina.php" class="botom botom--celi"><i
            class="far fa-caret-square-left tamaño_icon"></i> Cancelar</a>
        <button type="submit" class="botom botom--eli"><i class="far fa-trash-alt tamaño_icon"></i> Eliminar</button>
      </form>

    </div>


  </section>


</body>
<?php
include "../funciones/footer.php";
?>

</html>