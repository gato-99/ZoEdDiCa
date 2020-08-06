<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}
include "../php/conexion-mysql/conexion.php";
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nom']) || empty($_POST['ci']) || empty($_POST['user']) || empty($_POST['clave']) || empty($_POST['rol'])) {
        $alert = "<p class='M-error'>Todo los campos son obligatorio</p>";
    } else {
        $nombre = $_POST['nom'];
        $ci     = $_POST['ci'];
        $user   = $_POST['user'];
        $clave  = $_POST['clave'];
        $rol    = $_POST['rol'];
        $query = mysqli_query($conection, "SELECT * FROM iniciopn WHERE CI = '$ci' OR nombre = '$user'");
        $resultado = mysqli_fetch_array($query);
        if ($resultado > 0) {
            $alert = "<p class='M-error'>CI o Usuario ya está registrado</p>";
        } else {
            $query_ing = mysqli_query($conection, "INSERT INTO iniciopn(nombre_user,CI,nombre,clave,rol_id) VALUES('$nombre','$ci','$user','$clave','$rol')");
            if ($query_ing) {
                $alert = "<p class='M-aprobado'>Usuario registrado exitosamente</p>";
            } else {
                $alert = "<p class='M-error'>Error al registrar el usuario</p>";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es-ES">

<head>
  <meta charset="UTF-8">
  <title>Crear Usuario</title>
  <link rel="stylesheet" href="">
  <?php include "../funciones/enlases.php";?>
</head>

<body>
  <?php include "../funciones/loader.php"; ?>

  <img class="logo" src="../imagenes/logo.png" alt="imagen no carga" height="60px">
  <!-- comienso del menu principal -->
  <?php include "../funciones/barra_seccion.php";?>
  <?php include "../funciones/barra.php";?>
  <!-- final del menu principal -->
  <section class="com_register">

    <div class="for_de_registro">
      <h1><i class="fas fa-user-plus colorp1"></i>Registro de Usuario</h1>
      <hr>
      <form method="post" action="#">
        <label for="nom">Nombre</label>
        <input type="text" name="nom" id="nom" placeholder="Nombre....">

        <label for="CI">CI</label>
        <input type="number" name="ci" id="CI" placeholder="Ingrase CI...." title="Solo número de CI sin letras"
          required pattern="[0-9]{7,8}">

        <label for="user">Usuario</label>
        <input type="text" name="user" id="user" placeholder="Usuario....">

        <label for="clave">Contarseña</label>
        <input type="password" name="clave" id="clave" placeholder="Contraseña....">

        <label for="rango">Rango</label>
        <?php $query_rol = mysqli_query($conection, "SELECT * FROM rol");
                $resultado_rol = mysqli_num_rows($query_rol);?>
        <select name="rol" id="rango">
          <?php if ($resultado_rol > 0) {
                        while ($rol_id = mysqli_fetch_array($query_rol)) {?>
          <option value="<?php echo $rol_id['id'] ?>"><?php echo $rol_id['rol'] ?></option>
          <?php }} ?>
        </select>
        <div class="alerta">
          <?php echo isset($alert) ? $alert : ''; ?>
        </div>
        <center>
          <button type="submit" class="BT_crear"><i class="far fa-save tamaño_icon"></i> Crear usuario </button>
        </center>
      </form>
    </div>
  </section>
</body>
<?php include "../funciones/footer.php";?>

</html>