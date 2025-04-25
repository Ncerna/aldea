
<?php


$idjornada = htmlspecialchars($_GET['idjornada'],ENT_QUOTES,'UTF-8');
$yearid = htmlspecialchars($_GET['yearid'],ENT_QUOTES,'UTF-8');
$idgrado = htmlspecialchars($_GET['idgrado'],ENT_QUOTES,'UTF-8');
$idnivel = htmlspecialchars($_GET['idnivel'],ENT_QUOTES,'UTF-8');
$seccion = htmlspecialchars($_GET['seccion'],ENT_QUOTES,'UTF-8');
$turnoId = htmlspecialchars($_GET['turnoId'],ENT_QUOTES,'UTF-8');
$idhorario = htmlspecialchars($_GET['idhorario'],ENT_QUOTES,'UTF-8');

$idaula = htmlspecialchars($_GET['idaula'],ENT_QUOTES,'UTF-8');

$a[0] = 1;

include_once '../../modelo/modelo_horario.php';
$horario  = new  Horario();
$cursos = $horario->Listar_combo_Cursos_Grados($idgrado,$yearid);
$horas  =  $horario->Listar_Horas_Jornadas($idjornada,$yearid,$idgrado,$idnivel,$seccion,$turnoId);

?>