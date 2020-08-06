<?php
session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
	header("location: ./");
}

include "../php/conexion-mysql/conexion.php";
if (!empty($_POST)) {
	$alert = '';
	
	if (empty($_POST['titulo']) || empty($_POST['noticia']) || empty($_REQUEST['id']) || empty($_POST['foto_actual']) || empty($_POST['foto_remove'])) {
		$alert = "<p class='M-error'>Todos los campos son obligatorios <i class='fas fa-times-circle'></i></p>";
	} else {

		$idnoti  = $_REQUEST['id'];
		$titulo  = $_POST['titulo'];
		$noticia = $_POST['noticia'];
		$img_noticia  = $_POST['foto_actual'];
		$imgRemo  = $_POST['foto_remove'];
		

		$imagen     = $_FILES['foto'];
		$nombre_img = $imagen['name'];
		$tipo_img   = $imagen['type'];
		$ruta_tmp   = $imagen['tmp_name'];

		$upd = '';

		if ($nombre_img != '') {
			$ruta        = '../imagenes/noticias-img/';
			$nombre_img  = 'img_' . md5(date('d-m-y H:m:s'));
			$img_noticia = $nombre_img . '.jpg';
			$src         = $ruta . $img_noticia;
		}else{
			if($_POST['foto_actual'] != $_POST['foto_remove']){
				$img_noticia = 'imagen_noticia.png';
			}
		}

		$query_modi = mysqli_query($conection, "UPDATE  noticias SET titulo = '$titulo', noticia = '$noticia', foto ='$img_noticia' WHERE id_noticias = $idnoti");
		if ($query_modi) {
			if(($nombre_img != '' && ($_POST['foto_actual'] != 'imagen_noticia.png')) || $_POST['foto_actual'] != $_POST['foto_remove']){
				unlink('../imagenes/noticias-img/'.$_POST['foto_actual']);
			}
			if ($nombre_img != '') {
				move_uploaded_file($ruta_tmp, $src);
			}
			$alert = "<p class='M-aprobado'>Noticia modificada <i class='far fa-check-circle'></i></p>";

		} else {
			$alert = "<p class='M-error'>Error al modificar la noticia <i class='fas fa-times-circle'></i></p>";
		}
	}
}

if (empty($_REQUEST['id'])){
	header("location: ver_noticia.php");
}else{
	$id_noti = $_REQUEST['id'];
	if (!is_numeric($id_noti)) {
		header("location: ver_noticia.php");
	}
	$query_mod_noti = mysqli_query($conection,"SELECT * FROM noticias WHERE id_noticias = $id_noti");
	$resustado_mod_noti = mysqli_num_rows($query_mod_noti);

	$foto = '';
	$classREmover = 'notBlock';
	if($resustado_mod_noti > 0){
		$data_noti = mysqli_fetch_assoc($query_mod_noti);
		// print_r($data_noti);
		if ($data_noti['foto'] != 'imagen_noticia.png' ) {
			$classREmover = '';
			$foto = '<img id="img" src="../imagenes/noticias-img/'.$data_noti['foto'].'" alt="">';
		}
	}else{
		header("location: ver_noticia.php");
	}}
	?>


	<!DOCTYPE html>
	<html lang="es-ES">
	<head>
		<meta charset="UTF-8">
		<title>Modificar noticias</title>

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
			<h1><i class="fas fa-edit colorp1"></i><i class="far fa-newspaper colorp1"></i> &nbsp;Modificar noticias</h1>
			<hr>
			<div class="con_noticia">
				<form method="post" action="#" enctype="multipart/form-data">
					<input type="hidden" id="id" value="<?php echo $data_noti['id_noticias']; ?>">
					<input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_noti['foto']; ?>">
					<input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_noti['foto']; ?>">
					<div class="alerta">
						<?php echo isset($alert) ? $alert : ''; ?>
					</div><!--  -->
					<label for="titulo">Titulo:</label>
					<input type="text" name="titulo" id="titulo" placeholder="Titulo" value='<?php echo $data_noti['titulo'];?>'>

					<label for="noticia">Noticia:</label>
					<textarea name="noticia" id="summernote"><?php echo $data_noti['noticia']; ?></textarea>
					<div class="photo">
						<input type="checkbox" name="" id="anadir-imgen">
						<label for="anadir-imgen"><i class="far fa-image"></i><i class="fas fa-plus icon-aco"></i> Añadir imagen:</label>
						<div class="prevPhoto">
							<span class="delPhoto <?php echo $classREmover; ?>"><i class="far fa-times-circle"></i></span>
							<label for="foto"></label>
							<?php echo $foto; ?>
						</div>
						<div class="upimg"><input type="file" name="foto" id="foto"></div>
						<div id="form_alert"></div>
					</div>
					<br>
					<center>
						<button type="submit" class="botom">Modificar noticia <i class="far fa-newspaper"></i></button>
					</center>
				</form>
			</div>

		</div>

	</body>
	<?php
	include "../funciones/footer.php";
	?>

	</html>
