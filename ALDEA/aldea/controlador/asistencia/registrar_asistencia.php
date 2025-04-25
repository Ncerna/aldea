

<?php
require '../../modelo/modelo_asistencia.php';
$asistensia = new Asistensia;

$vectorIdpersonas = htmlspecialchars($_POST['vectorIdpersonas'],ENT_QUOTES,'UTF-8');
$vectorEst = htmlspecialchars($_POST['vectorEstado'],ENT_QUOTES,'UTF-8');
$fecha = htmlspecialchars($_POST['fechaAsisten'],ENT_QUOTES,'UTF-8');

$idgrado = htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');
$idnivel = htmlspecialchars($_POST['idnivel'],ENT_QUOTES,'UTF-8');
$idsecion = htmlspecialchars($_POST['idsecion'],ENT_QUOTES,'UTF-8');
$idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8'); 


date_default_timezone_set('America/Lima'); $fechas= date($fecha); 

$cont=$asistensia->verificar_Asistencia($fechas);
if($cont==0){

 $IdPersona = explode(",",$vectorIdpersonas );
 $vectorEstado = explode(",",$vectorEst );

 for ($i=0; $i <count($IdPersona) ; $i++) { 
  if ($IdPersona[$i] !='') {
   $consulta = $asistensia->Registro_Asistencia($IdPersona[$i],$fechas,$vectorEstado[$i],$idgrado,$idnivel,$idsecion,$idyear);

 }
}

if ($consulta==1) {
	$response = array('status' => true,'msg' => 'La Asistencia se registró corectamenter','data'=>$consulta);
echo json_encode($response,JSON_UNESCAPED_UNICODE);
}else{
	$response = array('status' => false,'msg' => 'Ocurrio un error al registrar asistencia','data'=>$consulta);
echo json_encode($response,JSON_UNESCAPED_UNICODE);
}

}else{
 $response = array('status' =>true,'msg' => 'Asistensia para la fecha de '.$fechas.' ya existe !!','data'=>'');

 echo json_encode($response,JSON_UNESCAPED_UNICODE);
}


?>