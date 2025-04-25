<?php
    require '../../modelo/modelo_fasescolar.php';
    $MU = new Fasescolar();
    $consulta = $MU->Listar_YearEscolar();
    echo json_encode($consulta);
?>