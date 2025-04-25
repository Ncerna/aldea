<?php
session_start();
if (!empty($_SESSION['S_IDENTYTI'])) {

	require '../../modelo/modelo_pagos.php';
	$MU = new Pagos();

	$yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
	$idalumno = $_SESSION['S_IDENTYTI'];

	$consulta = $MU->Extraer_Estado_Pago_Alumno($yearid,$idalumno);
	if($consulta){
		date_default_timezone_set('America/Lima');
		$FechaActual=date('Y-m-d');



		if ($consulta[0]['proximoPagoFecha'] <= $FechaActual) {
			$stado= 'PAGO PENDIENTE';
			$ctualizar = $MU-> ActualizarEstadoPago($idalumno, $yearid,$stado);

		}else{
			$stado= 'PAGADO';
			$ctualizar = $MU-> ActualizarEstadoPago($idalumno, $yearid,$stado);

		}


		echo $ctualizar;
	}else{

	}
}

?>