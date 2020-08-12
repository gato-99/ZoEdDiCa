<?php
$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
 header('location: pagina-principal/');
} else {
 if (!empty($_POST)) {
  if (empty($_POST['usuario']) || empty($_POST['clave'])) {
   $alert = "<p class='M_error'>Ingrese Usuario y Contraseña <i class='fas fa-times-circle'></i></p>";
} else {
   require_once "php/conexion-mysql/conexion.php";
   $user  = mysqli_real_escape_string($conection,$_POST['usuario']);
   $clave = md5(mysqli_real_escape_string($conection,$_POST['clave']));

   $query = mysqli_query($conection, "SELECT * FROM iniciopn WHERE nombre='$user' AND clave='$clave'");
   mysqli_close($conection);
   $resultado = mysqli_num_rows($query);
   if ($resultado > 0) {
    $data                    = mysqli_fetch_array($query);
    $_SESSION['active']      = true;
    $_SESSION['iduser']      = $data['id_user'];
    $_SESSION['nombre_user'] = $data['nombre_user'];
    $_SESSION['nombre']      = $data['nombre'];
    $_SESSION['rol']         = $data['rol_id'];
    header('location: pagina-principal/');
} else {
    $alert = "<p class='M_error'>Usuario o Contraseña invalido <i class='fas fa-times-circle'></i></p>";
    session_destroy();
}
}
}
}
?>


<!DOCTYPE html>
<html lang="es-ES">

<head>
  <meta charset="UTF-8">
  <title>Inicio sección ZED.Capital</title>
  <?php include "funciones/enlases.php";?>
  <script>
  window.onload = function() {
    var contenedor = document.getElementById('con_sinbolo');
    contenedor.style.visibility = 'hidden';
    contenedor.style.opacity = '0';
  }
  </script>
</head>

<body>
  <?php include "funciones/loader.php"; ?>
  <img class="logo" src="imagenes/logo.png" alt="imagen no carga" height="60px">
  <div class="login">
    <form method="post" action="" data-netlify="true">
      <h1>Login</h1>
      <label for="user"><i class="far fa-address-card"></i> Usuario:
        <input type="text" id="user" name="usuario" placeholder="Usuario" class="borderPres"></label>
      <label for="clave"><i class="fas fa-unlock"></i> Clave:
        <input type="password" id="clave" name="clave" placeholder="Clave" class="borderPres"></label>
      <div class="alerta"><?php echo isset($alert) ? $alert : ''; ?></div>

      <button type="submit" class="botom">Ingresar&nbsp;<i class="fas fa-check-circle"></i></button>
    </form>
  </div>
</body>
<?php include "funciones/footer.php";?>

</html>