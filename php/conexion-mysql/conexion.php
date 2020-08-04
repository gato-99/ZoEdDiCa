<?php
$host = 'localhost';
$nombre = 'root';
$clave = '';
$db = 'unexca_pn';

$conection = @mysqli_connect($host,$nombre,$clave,$db);
if (!$conection) {
	echo "Error en la conexión";
}

?>
