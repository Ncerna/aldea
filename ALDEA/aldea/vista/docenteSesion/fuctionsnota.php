

<?php
include_once '../../modelo/modelo_notas.php';
$MU  = new  Nota();

$idgrado = htmlspecialchars($_GET['idgrado'],ENT_QUOTES,'UTF-8');
$cursoid = htmlspecialchars($_GET['idcurso'],ENT_QUOTES,'UTF-8');
$idsecion = htmlspecialchars($_GET['idsecion'],ENT_QUOTES,'UTF-8');
$tipoorden = htmlspecialchars($_GET['tipoorden'],ENT_QUOTES,'UTF-8');
$tipoid = htmlspecialchars($_GET['tipoid'],ENT_QUOTES,'UTF-8');
$idyear = htmlspecialchars($_GET['idyear'],ENT_QUOTES,'UTF-8');
$idnivel = htmlspecialchars($_GET['idnivel'],ENT_QUOTES,'UTF-8');

$alumnos = $MU->listar_alumnosParaPonerNotas($idgrado,$idnivel, $idyear, $idsecion);
$activity = $MU->listar_CargaAcademicaPorCadaCursoPorTipo($cursoid,$tipoorden,$tipoid,$idyear);
$notas_ = $MU->listar_alumnos_Notas($tipoorden,$tipoid,$cursoid,$idgrado,$idsecion,$idnivel,$idyear);
$notas = array_filter($notas_, function($item) use ($tipoorden) { return $item['ordentio'] == $tipoorden;});


$isTrue=true;


$notasTem = array();
function NotasAlum($i,$id,$notas){
	global $notasTem;
	$filtered = array_values(array_filter($notas, function($value) use ($id) {
		return $value['idalumno'] == $id;
	}));

	$notasTem[]= isset($filtered[$i]['nota_alum']) ? $filtered[$i]['nota_alum'] : "0.00";  
	return $filtered !=null ?  $filtered[$i]['nota_alum'] : 0.00;
}


function Ponderado(){
	global $notasTem;
	global $activity;
	$resultado=0;
	$puntajeTem = array();
	for ($i=0; $i <count($activity) ; $i++) { 
		$puntajeTem[]=$activity[$i]['puntajes'];
	}

	for ($i=0; $i <count($activity) ; $i++) { 
		$resultado = $resultado+ (($notasTem[$i]*$puntajeTem[$i])/100);
	}

	$notasTem=[];
	return  $resultado;
}

?>