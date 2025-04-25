
<?php

require '../../modelo/modelo_asistencia.php';
$asistensia = new Asistensia;

$vectorIdpersonas = htmlspecialchars($_POST['vectorIdpersonas'],ENT_QUOTES,'UTF-8');
$vectorEst = htmlspecialchars($_POST['vectorEstado'],ENT_QUOTES,'UTF-8');
$fecha = htmlspecialchars($_POST['fechaAsisten'],ENT_QUOTES,'UTF-8');


       date_default_timezone_set('America/Lima'); $fechas= date($fecha); 

       $IdPersona = explode(",",$vectorIdpersonas );
       $vectorEstado = explode(",",$vectorEst );

       

       for ($i=0; $i <count($IdPersona) ; $i++) { 
        if ($IdPersona[$i] !='') {

        
        $consulta = $asistensia->Actualizar_Asistencia($IdPersona[$i],$vectorEstado[$i],$fechas);
        }

      }


   if (isset($consulta)==1) {
  $response = array('status' => true,'msg' => 'La Asistencia se Actualizo corectamenter','data'=>isset($consulta));
echo json_encode($response,JSON_UNESCAPED_UNICODE);
}else{
  $response = array('status' => false,'msg' => 'Ocurrio un error al Actualizar asistencia','data'=>isset($consulta));
echo json_encode($response,JSON_UNESCAPED_UNICODE);
}



     ?>