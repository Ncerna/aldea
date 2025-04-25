

<?php
    require '../../modelo/modelo_fasescolar.php';
    $MU = new Fasescolar();
    $idfase = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Estraer_fasesShow($idfase);
    echo json_encode($consulta);
?>