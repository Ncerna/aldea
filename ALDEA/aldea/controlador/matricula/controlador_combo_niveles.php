<?php
    require '../../modelo/modelo_matricula.php';
    $MU = new Matricula();
    $consulta = $MU->listar_combo_niveles();
    echo json_encode($consulta);
?>