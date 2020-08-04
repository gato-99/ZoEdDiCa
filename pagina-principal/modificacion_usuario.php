<?php
session_start();
if($_SESSION['rol'] != 1)
{
	header("location: ./");
}	
include "../php/conexion-mysql/conexion.php";
if(!empty($_POST))
{
	$alert='';


	if(empty($_POST['nom']) || empty($_POST['ci']) || empty($_POST['user']) || empty($_POST['rol'])){
		$alert = "<p class='M-error'>Todos los campos son obligatorio</p>";
	}
	else  {
		$id_user=$_POST['id'];
		$nombre=$_POST['nom'];
		$ci=$_POST['ci'];
		$user=$_POST['user'];
		$clave=$_POST['clave'];
		$rol=$_POST['rol'];

		$query= mysqli_query($conection, "SELECT * FROM iniciopn WHERE (CI = '$ci' AND id_user !=$id_user) OR (nombre = '$user' AND id_user !=$id_user)");
		$resultado = mysqli_fetch_array($query);
		if($resultado > 0){
			$alert="<p class='M-error'>La CI y el usuario ya están registrado</p>";
		}
		else {
			if(empty($_POST['clave'])){
				$query_update= mysqli_query($conection,"UPDATE iniciopn SET nombre_user = '$nombre', CI = '$ci', nombre = '$user', rol_id = '$rol' WHERE id_user='$id_user'");
			}
			else {
				$query_update= mysqli_query($conection,"UPDATE iniciopn SET nombre_user = '$nombre', CI = '$ci', nombre = '$user', clave = '$clave', rol_id = '$rol' WHERE id_user = '$id_user'");

			}

			if($query_update){
				$alert="<p class='M-aprobado'>Usuario modificado exitosamente</p>";

			}
			else {
				$alert="<p class='M-error'>Error al modificar el usuario</p>";
			}
		}

	}

}

//mostrar datos 
if(empty($_REQUEST['id'])){
	header("location: consulta-modificar-elimina.php");
	mysqli_close($conection);
}
$id_user=$_REQUEST['id'];
$query_modi= mysqli_query($conection, "SELECT u.id_user, u.nombre_user, u.CI, u.nombre, (u.rol_id) as id_rol, (r.rol) as rol FROM iniciopn u INNER JOIN rol r on u.rol_id = r.id WHERE id_user = $id_user");
$resultado_modi=mysqli_num_rows($query_modi);
if($resultado_modi == 0){
	header("location: consulta-modificar-elimina.php");

}
else{
	$option= '';
	while($data = mysqli_fetch_array($query_modi)){
		$id_user =$data['id_user'];
		$nom_user =$data['nombre_user'];
		$ci =$data['CI'];
		$user =$data['nombre'];
		$id_rol =$data['id_rol'];
		$rol =$data['rol'];

		if($id_rol == 1){
			$option='<option value="'.$id_rol.'" select>'.$rol.'</option>';
		}else if($id_rol == 2) {
			$option='<option value="'.$id_rol.'" select>'.$rol.'</option>';
		}else if($id_rol == 3){
			$option='<option value="'.$id_rol.'" select>'.$rol.'</option>';
		}
	}
}									

?>



<!DOCTYPE html>
<html lang="es-ES">

<head>
	<meta charset="UTF-8">
	<title>Modificación de Usuario</title>
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
		<section class="com_modificar">

			<div class="for_de_modificar">
				<h1><i class="fas fa-user-edit colorp1"></i> Modificar Usuario</h1>
				<hr>

				<form method="post" action="#">
					<input type="hidden" name="id" value="<?php echo $id_user; ?>">

					<label for="nom">Nombre</label>
					<input type="text" name="nom" id="nom" placeholder="Nombre" value="<?php echo $nom_user; ?>">

					<label for="CI">CI</label>
					<input type="text" name="ci" id="CI" placeholder="Ingrase CI" title="Solo numero de CI sin letras" required pattern="[0-9]{7,8}" value="<?php echo $ci; ?>">

					<label for="user">Usuario</label>
					<input type="text" name="user" id="user" placeholder="Usuario" value="<?php echo $user; ?>">

					<label for="clave">Contraseña</label>
					<input type="password" name="clave" id="clave" placeholder="Contraseña">

					<label for="rango">Rango</label>

					<?php
					include "../php/conexion-mysql/conexion.php" ;
					$query_rol= mysqli_query($conection, "SELECT * FROM rol");
					$resultado_rol= mysqli_num_rows($query_rol);
					mysqli_close($conection);
					?>
					<select name="rol" id="rango" class="nodub">
						<?php 
						echo $option;
						if ($resultado_rol > 0) {
							while ($rol_id= mysqli_fetch_array($query_rol)) {
								?>
								<option value="<?php echo $rol_id['id'] ?>"><?php echo $rol_id['rol'] ?></option>
								<?php

							}
						} 
						?>
					</select>
					<div class="alerta">
						<?php echo isset($alert) ? $alert : ''; ?>
					</div>
					<center>
						<button type="submit" class="BT_crear"><i class="far fa-save tamaño_icon"></i> Modificar</button>
					</center>
				</form>
			</div>

		</section>

	
</body>
<?php
include "../funciones/footer.php";
?>

</html>
