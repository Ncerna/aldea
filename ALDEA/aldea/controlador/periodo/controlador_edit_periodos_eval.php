
<?php
    require '../../modelo/modelo_periodo.php';
    $MU = new Periodo_Eva();

    $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
   
    $consulta = $MU->Estraer_Show_periodos_Edit($idyear);
    echo json_encode($consulta);

?>