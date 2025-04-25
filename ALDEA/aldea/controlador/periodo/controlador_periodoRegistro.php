<?php
    require '../../modelo/modelo_periodo.php';
    $MU = new Periodo_Eva();


       ///SE ESTA INGRESANDO ORDEN POR MOTIVOS
    //QUE EL TIPO ES UN ID DE IGUALES PARA DISTINGIRLO SE ESTA PONIENDO OTRO ADICIONAL 

    $year=htmlspecialchars($_POST['yearescolar'],ENT_QUOTES,'UTF-8');
    $tipoEvaluacioIds = htmlspecialchars($_POST['tipoEvaluacioIds'],ENT_QUOTES,'UTF-8');
    $finicioPeriodo = htmlspecialchars($_POST['finicioPeriodo'],ENT_QUOTES,'UTF-8');
    $ffinPeriodo = htmlspecialchars($_POST['ffinPeriodo'],ENT_QUOTES,'UTF-8');
     $tipoPosiciones = htmlspecialchars($_POST['tipoPosiciones'],ENT_QUOTES,'UTF-8');
    
      $resp = $MU->Verificar_Existencia_Periodo($year);
      if ($resp==0) {

      $tipoEvaluacioIds=explode(",", $tipoEvaluacioIds);
      $p_iniciofech = explode(",",$finicioPeriodo);
      $p_finfech= explode(",", $ffinPeriodo);
       $tipoOrden= explode(",", $tipoPosiciones);

    for ($i=0; $i <count($p_iniciofech) ; $i++) { 
      
      if ($p_iniciofech[$i] !='') {
          $consulta = $MU->Registrar_PeriodoEva( $year,$tipoEvaluacioIds[$i],$tipoOrden[$i],$p_iniciofech[$i],$p_finfech[$i]);
        }
    }
    echo $consulta ; 
      }else{
       echo 100;
      }

       

?>
