<?php
if (empty($_SESSION['active'])) {
	header("location: ../pagina-principal/");
}
?>
<div class="hed">
	
	<p class="fecha">Caracas, <?php echo fechaC(); ?></p>

	<div class="menu-de-opciones">

		<span class="NUsuari"><i class="fas fa-user-circle tamaño_icon "></i>&nbsp;<?php echo $_SESSION['nombre_user']; ?>&nbsp;
			<a  href="../php/proseso-y-cierre-seccion/cerrar_sesion.php" ><i class="fas fa-sign-in-alt tamaño_icon " title="Salir"></i></a>
		</span>
	</div>
</div>
