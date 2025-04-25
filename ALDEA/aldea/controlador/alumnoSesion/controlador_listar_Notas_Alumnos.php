<?php
require '../../modelo/modelo_alumnos.php';
$MU = new Alumno();
session_start();

if (!empty($_SESSION['S_IDENTYTI'])) {
	$alumnoid = $_SESSION['S_IDENTYTI'];

	$yearid = htmlspecialchars($_POST['year'],ENT_QUOTES,'UTF-8');
	$idorden = htmlspecialchars($_POST['idorden'],ENT_QUOTES,'UTF-8');

	//RECUPERAR EL GRADO DEL ALUMNO////
	$idgrado= $MU->Grado_Alumno_Matriculado($yearid,$alumnoid);

	if (!empty($idgrado)) {
		///LISTAR CURSOS DEL GRADO//////
	$cursos= $MU->Listar_cursos_Grado($yearid,$idgrado[0]['Id_grado']);

	}else{
		$concat='';
       $concat.='<div class="col-lg-12" style="border-color: #f5c6cb;">';
      $concat.='<div id="avisomanual" class="alert  sm" role="alert" style="color: #721c24; background-color: #f8d7da;">';
        $concat.='<button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
        $concat.='<strong> Dato no identificado  Ups! Paso algo no identificado</strong> ';
      $concat.='</div>';
   $concat.='</div>'; 


	$response = array('status' => true,'auth' => true,'msg' => 'No autorizado','data'=>$concat);
        echo json_encode($response);

		return;
	}

	

	
//llenando el div y la tabla/////////////
	$concat='';
	foreach ($cursos as $elemt) {
		$concat.='<div class="col-md-12">';
		$concat.='<div class="box box-warning ">';
		$concat.='<div class="box-body">';
		$concat.='<div class="box-header">';
		$concat.='<h5 class="box-title">'.$elemt['nonbrecurso'].'</h5>';
		$concat.='</div>';

		$notas = $MU->Listar_Notas_Alumno_Tipo($yearid,$idorden,$alumnoid,$elemt['idcurso']);
		if (!empty($notas)) { $cout=1; $total=0;

		$concat.='<table class="table table-condensed">';
		$concat.='<tbody>';
		$concat.='<tr>';
		$concat.='<th style="width: 10px">N°</th>';
		$concat.='<th >Actividades</th>';
		$concat.='<th>Procentaje</th>';
		$concat.='<th style="width: 20px">Nota</th>';
		$concat.='</tr>';

			foreach ($notas as  $value) {
				$concat.='<tr>';
				$concat.='<td>'.$cout.'</td>';
				$concat.='<td>'.$value['actividades'].'</td>';
				$concat.='<td><span class="label label-success">'.$value['puntajes'].'%'.'</span></td>';

				($value['nota_alum']>10.5)?
				 $concat.='<td><p  id="id_aprob">'.$value['nota_alum']?? '0'.'</p></td>' :
				 $concat.='<td><p  id="id_desap">'.$value['nota_alum']?? '0'.'</p></td>';
                $total += ($value['nota_alum']*$value['puntajes'])/100;
				//$concat.='<td>'.$value['nota_alum'].'</td>';
				$concat.='</tr>';
				$concat.='<tr>';
				$cout++;
			}

		$concat.='<td></td>';
		$concat.='<td><strong>Total Ponderado Acumulado </strong> </td>';
		$concat.='<td colspan=1></td>';


		( $total>10.5)? $concat.='<td> <label  id="id_aprob">'. $total.'</label></td>': $concat.='<td> <label  id="id_desap">'. $total.'</label></td>';
		$concat.='</tr>';
		$concat.='</tbody>';
		$concat.='</table>';

		}else{
         $concat.='<h5 class="box-title">Curso con evaluación pendiente</h5>';
		}
		$concat.='</div>';
		$concat.='</div>';
		$concat.='</div>';

	}


	 $response = array('status' => true,'auth' => true,'msg' => 'is autorizado','data'=>$concat);
        echo json_encode($response);

	
}else{
	$concat='';
       $concat.='<div class="col-lg-12" style="border-color: #f5c6cb;">';
      $concat.='<div id="avisomanual" class="alert  sm" role="alert" style="color: #721c24; background-color: #f8d7da;">';
        $concat.='<button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
        $concat.='<strong> NO AUTORIZADO PARA ESTA SECCION!! '.$alumnoid.'</strong> ';
      $concat.='</div>';
   $concat.='</div>'; 


	$response = array('status' => true,'auth' => false,'msg' => 'No autorizado','data'=>$concat);
        echo json_encode($response);

}

//funcion ponderados



?>