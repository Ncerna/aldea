<?php
require '../../modelo/modelo_docente.php';
$MU = new Docente();
session_start();
if (!empty($_SESSION['S_IDENTYTI'])) {
	$iddocente = $_SESSION['S_IDENTYTI'];

$gradoid = htmlspecialchars($_POST['gradoid'],ENT_QUOTES,'UTF-8');
$yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');


  $consulta = $MU->listar_Cursos_De_Docentes($iddocente,$gradoid,$yearid);

   echo json_encode($consulta);
}



       ?>