
<?php
    require '../../modelo/modelo_configuracion.php';

    $MU = new Configuracion();
    $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
    $fechainicio = htmlspecialchars($_POST['fechainicio'],ENT_QUOTES,'UTF-8');
    $fechafin=htmlspecialchars($_POST['fechafin'],ENT_QUOTES,'UTF-8');
    $cierrematricula = htmlspecialchars($_POST['cierrematricula'],ENT_QUOTES,'UTF-8');
    $tipoevaluacion = htmlspecialchars($_POST['tipoevaluacion'],ENT_QUOTES,'UTF-8');
    $inicioHora = htmlspecialchars($_POST['inicioHora'],ENT_QUOTES,'UTF-8');
    $finHora = htmlspecialchars($_POST['finHora'],ENT_QUOTES,'UTF-8');
    $turno = htmlspecialchars($_POST['turnos'],ENT_QUOTES,'UTF-8');
    $yearScolar = htmlspecialchars($_POST['yearScolar'],ENT_QUOTES,'UTF-8');
     //REGISTRAR AÑO ESCOLAR
   
   $resp =  $MU->Update_Configuracion_year($idyear,$fechainicio,$fechafin, $cierrematricula, $tipoevaluacion, $yearScolar);
   if($resp>0){

    $MU->Recetear_Turno_Hora($idyear);

     //REGISTRAR TURNOS-HORAS DEL AÑO ESCOLAR
      $inicioH = explode(",",$inicioHora );
      $finH = explode(",", $finHora);
      $turno_id=explode(",", $turno);

    for ($i=0; $i <count($inicioH) ; $i++) { 
      
      if ($inicioH[$i] !='') {
          $consulta = $MU->Registrar_Turno_Hora($idyear, $inicioH[$i], $finH[$i],$turno_id[$i]);
        }
    }
    }
    echo  $consulta ; 
?>
