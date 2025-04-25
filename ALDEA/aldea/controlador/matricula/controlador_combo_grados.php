<?php
    require '../../modelo/modelo_matricula.php';
    $MU = new Matricula();
    $consulta = $MU->listar_combo_Grados_matricula();
    echo json_encode($consulta);
?>