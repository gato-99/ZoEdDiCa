<?php
require('../PDF/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
	function Header()
	{

	// Logo
		$this->Image('../imagenes/logo.png',0,2,210);
    // Arial bold 15
		$this->SetFont('Arial','B',18);
    // Movernos a la derecha
		$this->Cell(65);
    // Título
		$this->Cell(40,25,'Usuarios registrados');
    // Salto de línea
		$this->Ln(20);
		//tabla
		$this->Cell(100,10,'Nombre',1,0,'C',0);
		$this->Cell(45,10,'CI',1,0,'C',0);
		$this->Cell(45,10,'Rol',1,1,'C',0);
	}

// Pie de página
	function Footer()
	{
    // Posición: a 1,5 cm del final
		$this->SetY(-15);
    // Arial italic 8
		$this->SetFont('Arial','I',8);
    // Número de página
		$this->Cell(0,10,utf8_decode('página').$this->PageNo().'/{nb}',0,0,'C');
	}
}
include "../php/conexion-mysql/conexion.php";
$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbpages();
$pdf->SetFont('Arial','',16);
$query= mysqli_query($conection, "SELECT n.id_user, n.nombre_user, n.CI, n.nombre, r.rol FROM iniciopn n INNER JOIN rol r ON n.rol_id = r.id");
$resultado = mysqli_num_rows($query);
if($resultado>0){
	while($data=mysqli_fetch_array($query)){
		$pdf->Cell(100,10,utf8_decode($data['nombre_user']),1,0,'C',0);
		$pdf->Cell(45,10,utf8_decode($data['CI']),1,0,'C',0);
		$pdf->Cell(45,10,utf8_decode($data['rol']),1,1,'C',0);
	}
}

$pdf->Output();
?>