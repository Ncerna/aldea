<?php
require '../../modelo/modelo_notas.php';
$MU = new Nota();

$tipoorden = htmlspecialchars($_POST['tipoorden'],ENT_QUOTES,'UTF-8');
$tipoid = htmlspecialchars($_POST['tipoid'],ENT_QUOTES,'UTF-8');
$cursoid = htmlspecialchars($_POST['cursoid'],ENT_QUOTES,'UTF-8');
$idgrado = htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');
$idsecion = htmlspecialchars($_POST['idsecion'],ENT_QUOTES,'UTF-8');
$idnivel = htmlspecialchars($_POST['idnivel'],ENT_QUOTES,'UTF-8');
$idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');

$consulta = $MU->listar_alumnos_Notas($tipoorden,$tipoid,$cursoid,$idgrado,$idsecion,$idnivel,$idyear);
echo json_encode($consulta);
?>