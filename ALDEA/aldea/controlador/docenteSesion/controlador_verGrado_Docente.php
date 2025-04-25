<?php
session_start();
require '../../modelo/modelo_docente.php';
$MU = new Docente();

if (!empty($_SESSION['S_IDENTYTI'])) {
	$iddocente = $_SESSION['S_IDENTYTI'];

$yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');

  $consulta = $MU->listar_Grados_Docente($iddocente,$yearid);

  $response = array('status' => true,'auth' => true,'msg' => 'is autorizado a esta seccion','data'=>$consulta);
echo json_encode($response);

}else{
	$concat='';
       $concat.='<div class="col-lg-12" style="border-color: #f5c6cb;">';
      $concat.='<div id="avisomanual" class="alert  sm" role="alert" style="color: #721c24; background-color: #f8d7da;">';
        $concat.='<button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
        $concat.='<strong> NO AUTORIZADO PARA ESTA SECCION!! '.$iddocente.'</strong> ';
      $concat.='</div>';
   $concat.='</div>'; 

    $response = array('status' => true,'auth' => false,'msg' => 'No se encontro Sesión Activa','data'=>$concat);
echo json_encode($response);
}




       ?>