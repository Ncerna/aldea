<?php


session_start();

if (!empty($_SESSION['S_IDUSUARIO'])) {
    $usu_id = $_SESSION['S_IDUSUARIO'];

    require '../../modelo/modelo_usuario.php';

    $MU = new Modelo_Usuario();

   
    $consulta = $MU->Extraer_Datos_Logeado($usu_id);

     $response = array('status' => true,'auth' => true,'msg' => 'is autorizado','data'=>$consulta);
        echo json_encode($response);

}else{
  $concat='';
       $concat.='<div class="col-lg-3" style="border-color: #f5c6cb;">';
      $concat.='<div id="avisomanual" class="alert  sm" role="alert" style="color: #721c24; background-color: #f8d7da;">';
        $concat.='<button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
        $concat.='<strong> NO AUTORIZADO PARA ESTA SECCION!! '.$usu_id.'</strong> ';
      $concat.='</div>';
   $concat.='</div>'; 
   
    $response = array('status' => true,'auth' => false,'msg' => 'Not autorizado','data'=>$concat);
        echo json_encode($response);

}
   

?>