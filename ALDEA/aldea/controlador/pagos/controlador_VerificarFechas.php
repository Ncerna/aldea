<?php
require '../../modelo/modelo_pagos.php';
$MU = new Pagos();

$yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');


$consulta = $MU->ExtraerAlumnosQueRealizanPagos($yearid);
if($consulta){
   date_default_timezone_set('America/Lima');
   $FechaActual=date('Y-m-d');
   
   foreach ($consulta as $value) {

    if ($value['proximoPagoFecha'] <= $FechaActual) {
     $stado= 'PAGO PENDIENTE';
     $ctualizar = $MU-> ActualizarEstadoPago($value['entidad'], $yearid,$stado);
     
 }else{
   $stado= 'PAGADO';
   $ctualizar = $MU-> ActualizarEstadoPago($value['entidad'], $yearid,$stado);

}
}

echo $ctualizar;
}else{
 
}

?>