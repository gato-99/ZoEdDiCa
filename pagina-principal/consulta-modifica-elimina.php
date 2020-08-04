<?php
session_start();
if($_SESSION['rol'] != 1)
{
	header("location: ./");
}	
include "../php/conexion-mysql/conexion.php";

?>
<!DOCTYPE html>
<html lang="es-ES">

<head>
  <meta charset="UTF-8">
  <title>Consulta, Modifica y Elimina</title>
  <?php include "../funciones/enlases.php";?>
</head>

<body>
  <?php include "../funciones/loader.php"; ?>

  <img class="logo" src="../imagenes/logo.png" alt="imagen no carga" height="60px">
  <!-- comienso del menu principal -->
  <?php include "../funciones/barra_seccion.php";?>
  <?php include "../funciones/barra.php";?>
  <!-- final del menu principal -->
  <div class="con_edi_eli">
    <div class="titulo_cee">
      <h1><i class="fas fa-users colorp1 fa-1x"></i>&nbsp; Usuarios registrados</h1><br>
    </div>

      <form method="get" action="busqda-user.php" class="for_busqueda borderPres">
        <fieldset>
          <input type="search" name="buscar" id="buscar" placeholder="Buscar...">
          <button type="submit" class="bot_buscar borderPres"><i class="fas fa-search tamaño_icon"></i></button>
        </fieldset>
      </form>
      <div class="conter_PDF">
        <a href="../pagina-principal/PDF.php" class="PDF borderPres">Descargar PDF <i
            class="fas fa-download CV"></i></a>
    
    </div>
    <table>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>CI</th>
        <th>Usuario</th>
        <th>Rol</th>
        <th>Acción</th>
      </tr>
      <?php 
//paginador
			$query_conteo = mysqli_query($conection,"SELECT COUNT(*) as conteo FROM iniciopn");
			$resultado_conteo=mysqli_fetch_array($query_conteo);
			$conteo = $resultado_conteo['conteo'];
			$por_pagina = 10;
			$enlace = 3;
			if(empty($_GET['pagina'])){
				$pagina = 1;
			}
			else {
				$pagina=$_GET['pagina'];
			}
			$desde = ($pagina - 1) * $por_pagina;
			$total_de_pagina = ceil($conteo / $por_pagina);

			$pmin = ($pagina>$enlace) ? ($pagina-$enlace) : 1;
			$pmax = ($pagina<($total_de_pagina - $enlace)) ? ($pagina+$enlace) : $total_de_pagina;

			$query= mysqli_query($conection, "SELECT n.id_user, n.nombre_user, n.CI, n.nombre, r.rol FROM iniciopn n INNER JOIN rol r ON n.rol_id = r.id LIMIT $desde,$por_pagina");
			mysqli_close($conection);
			$resultado = mysqli_num_rows($query);
			if($resultado>0){
				while($data=mysqli_fetch_array($query)){
					?>
      <tr>
        <td><?php echo $data['id_user']; ?></td>
        <td><?php echo $data['nombre_user']; ?></td>
        <td><?php echo $data['CI']; ?></td>
        <td><?php echo $data['nombre']; ?></td>
        <td><?php echo $data['rol']; ?></td>
        <td>

          <a class="en_editar" href="modificacion_usuario.php?id=<?php echo $data['id_user']; ?>"><i
              class="fas fa-edit"></i> Modificar</a>

          <?php if($data['id_user'] != 1 ){ ?>
          <a class="en_eliminar" href="eliminar-user.php?id=<?php echo $data['id_user']; ?>"><i
              class="fas fa-trash-alt"></i> Eliminar</a>
          <?php } ?>
        </td>
      </tr>
      <?php	
				}
			}
			?>
    </table>
    <div class="pginador" id="pginador">
      <ul>
        <?php
				if($pagina != 1){?>
        <li><a href="?pagina=<?php echo 1;?>">primero<i class="fas fa-step-backward"></i></a></li>
        <li><a href="?pagina=<?php echo $pagina-1;?>">anterior<i class="fas fa-backward"></i></a></li>
        <?php } ?>

        <?php for($i=$pmin; $i<=$pmax; $i++){
					if($i == $pagina){
						echo'<li class="pagsele">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}
				?>

        <?php if($pagina != $total_de_pagina){?>
        <li><a href="?pagina=<?php echo $pagina+1;?>">siguiente<i class="fas fa-forward"></i></a></li>
        <li><a href="?pagina=<?php echo $total_de_pagina;?>">ultimo<i class="fas fa-step-forward"></i></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</body>
<?php
include "../funciones/footer.php";
?>

</html>