<?php
require '../../modelo/modelo_alumnos.php';
$MU = new Alumno();
session_start();
if (!empty($_SESSION['S_IDENTYTI'])) {
	$alumnoid = $_SESSION['S_IDENTYTI'];

	$yearid = htmlspecialchars($_POST['year'],ENT_QUOTES,'UTF-8');

	$consulta = $MU->Listar_Periodos_Evaluacion_year($yearid);

	$response = array('status' => true,'auth' => true,'msg' => 'Is Autenticado','data'=>$consulta);
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



?>