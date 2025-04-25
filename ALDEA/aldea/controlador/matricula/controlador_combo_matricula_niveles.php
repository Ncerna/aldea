<?php
    require '../../modelo/modelo_matricula.php';
    $MU = new Matricula();
    $consulta = $MU->listar_combo_Matricula_Niveles();
    echo json_encode($consulta);
?>