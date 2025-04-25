<?php
require '../../modelo/modelo_asistencia.php';
$asistensia = new Asistensia;

$idgrado = htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');
$idnivel = htmlspecialchars($_POST['idnivel'],ENT_QUOTES,'UTF-8');
$idsecion = htmlspecialchars($_POST['idsecion'],ENT_QUOTES,'UTF-8');
$idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');

 $consulta = $asistensia->Listar_AsistenciasPersonl($idgrado,$idnivel,$idsecion,$idyear);
//$consulta = $asistensia->Listar_AsistenciasPersonl();

echo json_encode($consulta);

?>