<?php
session_start();
if (!empty($_SESSION['S_IDENTYTI'])) {
    $alumnoid = $_SESSION['S_IDENTYTI'];


    require '../../modelo/modelo_pagos.php';
    $MU = new Pagos();

    $yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Pagos_Realizados_Alumno_Year($yearid,$alumnoid);

    $concat='';$cout=1;

    if (!empty($consulta)) {
        $concat.='<table class="table table-condensed">';
        $concat.='<tbody>';
        $concat.='<tr>';
        $concat.='<th style="width: 10px">N°</th>';
        $concat.='<th >Descripción</th>';
        $concat.='<th>Fechas Pagados</th>';
        $concat.='<th>Estado</th>';
        $concat.='<th>Día</th>';
        $concat.='<th>Monto</th>';
        $concat.='</tr>';
        foreach ($consulta as  $value) {
            $concat.='<tr>';
            $concat.='<td>'.$cout.'</td>';
            $concat.='<td>'.$value['tipo'].'</td>';
            $concat.='<td>'.$value['fechasPagados'].'</td>';
            $concat.='<td><span class="label label-success">'.$value['stadoPago'].'</span></td>';
            $concat.='<td>'.$value['dateoperation'].'</td>';
            $concat.='<td>'.$value['motoPago'].' S/.'.'</td>';
            $concat.='</tr>';

            $cout++;
        }
        $concat.='</tbody>';
        $concat.='</table>';



    }else{
       $concat.='<div class="col-lg-12" style="border-color: #f5c6cb;">';
      $concat.='<div id="avisomanual" class="alert  sm" role="alert" style="color: #0e0102; background-color: #acefe4;">';
        $concat.='<button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
        $concat.='NO SE ENCONTRO NINGUN TIPO DE PAGO REALIZADO  DE ESTE AÑO!! ';
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


 