<?php
    require '../../modelo/modelo_jornadas.php';
    $MU = new JornasHoras();
    $consulta = $MU->listar_combo_grdos();
    echo json_encode($consulta);
?>