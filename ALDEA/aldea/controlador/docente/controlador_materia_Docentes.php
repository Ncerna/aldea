<?php
require '../../modelo/modelo_docente.php';
$MU = new Docente();


$id_docente = htmlspecialchars($_POST['id_docente'],ENT_QUOTES,'UTF-8');
$yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');


//GRAOS DEL DOCENTE
$idsBDCurso = array();
$grados=$MU->Gados_Docente_Asignado($id_docente ,$yearid);

//CURSOS DEL GRAO
if (!empty($grados)) {
	foreach ($grados as $value) {
		$idsBDCurso = $MU->CursosDelGado($idsBDCurso, $value['gradoId'],$yearid); 
	}
}

//MATERIALES ASIGNADOS AL DOCENTE YA
$cursosAsig = $MU->listar_Materias_Docentes($id_docente ,$yearid);
$values = array();
foreach ($cursosAsig as $value) {
	$values[]=$value['idCursos'];
}


$concat='';
foreach ($idsBDCurso as $value) {
	$concat.='<tr>';

	if (in_array($value['curso_id'], $values,true)) {
		$concat.='<td ><input type="checkbox" checked></td>';

		$concat.='<td hidden>'.$value['curso_id'].'</td>';
		$concat.='<td hidden>'.$value['grado_id'].'</td>';
		$concat.='<td hidden>'.$value['Idseccion'].'</td>';

		$concat.='<td>' .$value['nonbrecurso'].'</td>';
	}else{
		$concat.='<td ><input type="checkbox"></td>';

		$concat.='<td hidden>'.$value['curso_id'].'</td>';
		$concat.='<td hidden>'.$value['grado_id'].'</td>';
		$concat.='<td hidden>'.$value['Idseccion'].'</td>';

		$concat.='<td>' .$value['nonbrecurso'].'</td>';
	}

	$concat.='</tr>';

}

//$response = array('status' => false,'idyear' => $yearid,'idcocente' => $id_docente,'data'=>$concat);

echo json_encode($concat);



       ?>