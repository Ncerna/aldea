<?php
    require '../../modelo/modelo_horario.php';

$horario = new Horario();

$selecionado = htmlspecialchars($_POST['horarios'],ENT_QUOTES,'UTF-8');
$data =(isset($_POST['horarios']))? json_decode($_POST['horarios'],true): array("error"=>"no se pudo completar el registro");




if (!empty($data)) {
	# code...


//VERIFICAR SI YA EXISTE HORARIO PARA EL GRADO SELECIONADO
 $consulta = $horario->Verificar_Existe($data[0]['idgrado'],$data[0]['idturno'],$data[0]['idnivel'],$data[0]['idseccion'],$data[0]['idjornada'],$data[0]['idyear']);
 if ($consulta>0) {
 	echo 100;return;
 }else{
 $idhorario = $horario->Registar_horaios($data[0]['idgrado'],$data[0]['idturno'],$data[0]['idnivel'],$data[0]['idseccion'],$data[0]['idjornada'],$data[0]['idyear'],$data[0]['idaula']);	
 }

   foreach ($data as $value) {
   	$tdId  = substr($value['idtd'] , -2);

$resquest = $horario->Registar_horas_Crusos($tdId, $value['hora'], $value['idcurso'], $value['dia'],$value['idgrado'],$value['idturno'],$value['idnivel'],$value['idseccion'],$value['idjornada'],$value['idyear'],$idhorario);

   }

echo 1;
}else{
	echo 500;
}

?>