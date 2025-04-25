
<?php
    require '../../modelo/modelo_notas.php';
    $MU = new Nota();
  
   $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->ListarPeriodoDeEvaluacionSusFechas($idyear);
    echo json_encode($consulta);
?>