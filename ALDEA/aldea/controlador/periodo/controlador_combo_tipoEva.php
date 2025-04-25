<?php
    require '../../modelo/modelo_periodo.php';
    $MU = new Periodo_Eva();
    $consulta = $MU->Listar_Combo_tipos_evalaucion();
    echo json_encode($consulta);


?>