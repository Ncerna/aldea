<?php
    require '../../modelo/modelo_configuracion.php';

    $MU = new Configuracion();
    $id = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
    $fechainicio = htmlspecialchars($_POST['fechainicio'],ENT_QUOTES,'UTF-8');
    $fechafin=htmlspecialchars($_POST['fechafin'],ENT_QUOTES,'UTF-8');
    $cierrematricula = htmlspecialchars($_POST['cierrematricula'],ENT_QUOTES,'UTF-8');
    $tipoevaluacion = htmlspecialchars($_POST['tipoevaluacion'],ENT_QUOTES,'UTF-8');
    $inicioHora = htmlspecialchars($_POST['inicioHora'],ENT_QUOTES,'UTF-8');
    $finHora = htmlspecialchars($_POST['finHora'],ENT_QUOTES,'UTF-8');
    $turno = htmlspecialchars($_POST['turnos'],ENT_QUOTES,'UTF-8');
    $yearScolar = htmlspecialchars($_POST['yearScolar'],ENT_QUOTES,'UTF-8');

    $exist = $MU->Verificar_Existencia_year($yearScolar);

    if($exist==0){
        //REGISTRAR AÑO ESCOLAR
    $idyear = $MU->Registrar_Configuracion_year($fechainicio,$fechafin, $cierrematricula, $tipoevaluacion, $yearScolar);
    if($idyear>0){

     //REGISTRAR TURNOS-HORAS DEL AÑO ESCOLAR
      $inicioH = explode(",",$inicioHora );
      $finH = explode(",", $finHora);
      $turno_id=explode(",", $turno);

    for ($i=0; $i <count($turno_id) ; $i++) { 
      
      if ($turno_id[$i] !='') {
          $consulta = $MU->Registrar_Turno_Hora($idyear, $inicioH[$i], $finH[$i],$turno_id[$i]);
        }
    }
    }

    
     echo  $consulta; 
    
   

    }else{
      echo 100;
    }

   
?>

