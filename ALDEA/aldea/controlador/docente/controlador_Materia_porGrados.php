
<?php
require '../../modelo/modelo_docente.php';
$MU = new Docente();

session_start();

	$iddocente = $_SESSION['S_IDENTYTI'];
	$yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
	$gradoId = htmlspecialchars($_POST['gradoId'],ENT_QUOTES,'UTF-8');

	$consulta = $MU->listar_MaterialesPorCadaGrado($iddocente,$yearid,$gradoId);
	$concat='';
    $cont=1;
	$concat.='<div class="col-md-3" id="key_elemt'.$gradoId.'">';
	$concat.='<table class="table table-condensed table-sm" >';
	$concat.='<thead style="background-color:#989d9c; color: white;">';
	$concat.='<tr>';
	$concat.='<th style="width: 5px; ">N°</th>';
	$concat.='<th>Nombre ('. count($consulta).')</th>';
	$concat.='</tr>';
	$concat.='</thead>';
	$concat.='<tbody>';
	if (!empty($consulta)) {
		foreach ($consulta as $value) {
			$concat.='<tr>';
			$concat.='<td>'.$cont.'</td>';
			$concat.='<td>'.$value['nonbrecurso'].'</td>';
			$concat.='</tr>';
		$cont++;}
	}else{$concat.='<tr><td>No hay Cursos!</td></tr>';}

	$concat.='</tbody>';
	$concat.='</table>';
	$concat.='</div>';

	echo json_encode($concat);


?>