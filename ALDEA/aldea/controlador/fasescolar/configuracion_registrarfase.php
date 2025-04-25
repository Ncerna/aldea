
<?php
    require '../../modelo/modelo_fasescolar.php';
    $MU = new Fasescolar();

    $year = htmlspecialchars($_POST['year'],ENT_QUOTES,'UTF-8');
    $fases = htmlspecialchars($_POST['fases'],ENT_QUOTES,'UTF-8');
    $inicios =htmlspecialchars($_POST['inicios'],ENT_QUOTES,'UTF-8');
    $finales = htmlspecialchars($_POST['finales'],ENT_QUOTES,'UTF-8');

     $verificar=$MU->Verificar_Existencia($year);

     if($verificar==0){
      $faSesE=explode(",", $fases);
      $inicioF = explode(",",$inicios);
      $finF= explode(",", $finales);

    for ($i=0; $i <count($faSesE) ; $i++) { 
      
      if ($faSesE[$i] !='') {
          $consulta = $MU->Registrar_FaseEscolar($year,$faSesE[$i], $inicioF[$i], $finF[$i]);
        }
    }
    echo $consulta ; 
   }
   else{
    echo 100; 
   }
   
?>