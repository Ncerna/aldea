<?php
session_start();
require '../../modelo/modelo_docente.php';
$MU = new Docente();
	$iddocente = $_SESSION['S_IDENTYTI'];
	$yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
	$gradoId = htmlspecialchars($_POST['gradoid'],ENT_QUOTES,'UTF-8');
	$consulta = $MU->listar_MaterialesPorCadaGrado($iddocente,$yearid,$gradoId);
	echo json_encode($consulta);


?>