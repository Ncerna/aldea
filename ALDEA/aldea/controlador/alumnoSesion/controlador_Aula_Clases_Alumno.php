<?php
session_start();
if (!empty($_SESSION['S_IDENTYTI'])) {
    $alumnoid = $_SESSION['S_IDENTYTI'];
    require '../../modelo/modelo_alumnos.php';
    $MU = new Alumno();

  $yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');

  //RECUPERAR EL GRADO DEL ALUMNO////
	$idgrado= $MU->Grado_Alumno_Matriculado($yearid,$alumnoid);
    $consulta = $MU->Aulas_Alumno_Clases($yearid,$idgrado[0]['Id_grado']);

     $concat='';$cout=1;

    if (!empty($consulta)) {
        $concat.='<table class="table table-condensed">';
        $concat.='<tbody>';
        $concat.='<tr>';
        $concat.='<th style="width: 10px">N°</th>';
        $concat.='<th >Grado</th>';
        $concat.='<th>Nivel</th>';
        $concat.='<th>Aula (Salón)</th>';
        $concat.='<th>Piso</th>';
        $concat.='<th>Sección</th>';
        $concat.='</tr>';
        foreach ($consulta as  $value) {
            $concat.='<tr>';
            $concat.='<td>'.$cout.'</td>';
            $concat.='<td>'.$value['gradonombre'].'</td>';
            $concat.='<td>'.$value['nombreNivell'].'</td>';
            $concat.='<td>'.$value['nombreaula'].'</td>';
            $concat.='<td>'.$value['piso'].'</td>';
            $concat.='<td>'.$value['seccion'].' </td>';
            $concat.='</tr>';

            $cout++;
        }
        $concat.='</tbody>';
        $concat.='</table>';



    }else{
       $concat.='<div class="col-lg-12" style="border-color: #f5c6cb;">';
      $concat.='<div id="avisomanual" class="alert  sm" role="alert" style="color: #0e0102; background-color: #acefe4;">';
        $concat.='<button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
        $concat.='NO SE ENCONTRO NINGUN AULA ASIGNADO PARA EL AÑO ESCOLAR!! ';
      $concat.='</div>';
   $concat.='</div>'; 
  }
        echo json_encode($concat);
    
}else{

    $concat='';
       $concat.='<div class="col-lg-12" style="border-color: #f5c6cb;">';
      $concat.='<div id="avisomanual" class="alert  sm" role="alert" style="color: #721c24; background-color: #f8d7da;">';
        $concat.='<button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
        $concat.='<strong> NO AUTORIZADO PARA ESTA SECCION!! '.$alumnoid.'</strong> ';
      $concat.='</div>';
   $concat.='</div>'; 

   echo json_encode($concat);
}



?>
