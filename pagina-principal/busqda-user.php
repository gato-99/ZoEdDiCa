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
  <title class="t">Consulta, Modifica y Elimina</title>
  <?php include "../funciones/enlases.php";?>
</head>

<body>
  <?php include "../funciones/loader.php"; ?>

  <img class="logo" src="../imagenes/logo.png" alt="imagen no carga" height="60px">
  <?php  $buscar= strtolower($_REQUEST['buscar']);
    if(empty($buscar)){
        header("location: consulta-modifica-elimina.php");
    }
    ?>
  <!-- comienso del menu principal -->
  <?php include "../funciones/barra_seccion.php";?>
  <?php include "../funciones/barra.php";?>
  <!-- final del menu principal -->

  <div class="con_edi_eli">
    <div class="titulo_cee">
      <h1><i class="fas fa-users colorp1 fa-1x"></i>&nbsp; Usuarios registrados</h1><br>
    </div>

    <form method="get" action="" class="for_busqueda borderPres">
      <fieldset>
        <input type="text" name="buscar" id="buscar" placeholder="Buscar..." value="<?php echo "$buscar"; ?>">
        <button type="submit" class="bot_buscar borderPres"><i class="fas fa-search tamaño_icon"></i></button>
      </fieldset>
    </form>
    <div class="conter_PDF">
      <a href="../pagina-principal/PDF.php" class="botom botom--pdf">Descargar PDF <i class="fas fa-download CV"></i></a>
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
            $rol = '';
            if($buscar == 'administrador'){
                $rol = "OR rol_id LIKE '%1%'";
            }else if($buscar == 'supervisor'){
                $rol = "OR rol_id LIKE '%2%'";
            }else if($buscar == 'trabajador'){
                $rol = "OR rol_id LIKE '%3%'";
            }
            $query_conteo = mysqli_query($conection,"SELECT COUNT(*) as conteo FROM iniciopn WHERE (id_user LIKE '%$buscar%' OR nombre_user LIKE '%$buscar%' OR CI LIKE '%$buscar%' OR nombre LIKE '%$buscar%' $rol)");
            $resultado_conteo=mysqli_fetch_array($query_conteo);
            $conteo = $resultado_conteo['conteo'];
            $por_pagina =10;
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

            $query= mysqli_query($conection, "SELECT n.id_user, n.nombre_user, n.CI, n.nombre, r.rol FROM iniciopn n INNER JOIN rol r ON n.rol_id = r.id WHERE (n.id_user LIKE '%$buscar%' OR n.nombre_user LIKE '%$buscar%' OR n.CI LIKE '%$buscar%' OR n.nombre LIKE '%$buscar%' OR r.rol LIKE '%$buscar%') LIMIT $desde,$por_pagina");
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
          <a class="botom botom--celi botom--pd" href="modificacion_usuario.php?id=<?php echo $data['id_user']; ?>">
            Modificar <i class="fas fa-edit"></i></a>
          <?php if($data['id_user'] != 1 ){ ?>
          <a class="botom botom--eli botom--pd" href="eliminar-user.php?id=<?php echo $data['id_user']; ?>"> Eliminar <i
              class="fas fa-trash-alt"></i></a>
          <?php } ?>
        </td>
      </tr>
      <?php	
                }
            }
            ?>
    </table>
    <?php if($conteo !=0){ ?>
    <div class="pginador" id="pginador">
      <ul>
        <?php
                    if($pagina != 1){?>
        <li><a href="?pagina=<?php echo 1;?>&buscar=<?php echo "$buscar"; ?>"><i class="fas fa-step-backward"></i></a>
        </li>
        <li><a href="?pagina=<?php echo $pagina-1;?>&buscar=<?php echo "$buscar"; ?>"><i
              class="fas fa-backward"></i></a></li>
        <?php } ?>

        <?php for($i=$pmin; $i<=$pmax; $i++){
                        if($i == $pagina){
                            echo'<li class="pagsele">'.$i.'</li>';
                        }else{
                            echo '<li><a href="?pagina='.$i.'&buscar='.$buscar.'">'.$i.'</a></li>';
                        }
                    }
                    ?>

        <?php if($pagina != $total_de_pagina){?>
        <li><a href="?pagina=<?php echo $pagina+1;?>&buscar=<?php echo "$buscar"; ?>"><i class="fas fa-forward"></i></a>
        </li>
        <li><a href="?pagina=<?php echo $total_de_pagina;?>&buscar=<?php echo "$buscar"; ?>"><i
              class="fas fa-step-forward"></i></a></li>
        <?php } ?>
      </ul>
    </div>
    <?php } ?>
  </div>
</body>
<?php
    include "../funciones/footer.php";
    ?>

</html>