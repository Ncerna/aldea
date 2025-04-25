<?php
    require '../../modelo/modelo_horario.php';

$horario = new Horario();

$idtd = htmlspecialchars($_POST['idtd'],ENT_QUOTES,'UTF-8');
$idhora = htmlspecialchars($_POST['hora'],ENT_QUOTES,'UTF-8');
$dia = htmlspecialchars($_POST['dia'],ENT_QUOTES,'UTF-8');
$idcurso = htmlspecialchars($_POST['idcurso'],ENT_QUOTES,'UTF-8');
$idgrado = htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');
$idturno = htmlspecialchars($_POST['idturno'],ENT_QUOTES,'UTF-8');
$idnivel = htmlspecialchars($_POST['idnivel'],ENT_QUOTES,'UTF-8');
$idseccion = htmlspecialchars($_POST['idseccion'],ENT_QUOTES,'UTF-8');
$idjornada = htmlspecialchars($_POST['idjornada'],ENT_QUOTES,'UTF-8');
$idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
$php_idHorario = htmlspecialchars($_POST['php_idHorario'],ENT_QUOTES,'UTF-8');
//$idaula = htmlspecialchars($_POST['idaula'],ENT_QUOTES,'UTF-8'); Antes
$idaula = isset($_POST['idaula']) && $_POST['idaula'] !== null ? htmlspecialchars($_POST['idaula'], ENT_QUOTES, 'UTF-8') : '';//despes


	$tdId  = substr($idtd  , -2);


$consulta  =  $horario->Registar_horas_Crusos($tdId, $idhora, $idcurso, $dia,$idgrado,$idturno,$idnivel,$idseccion,$idjornada,$idyear,$php_idHorario);

   
echo $consulta;

?>