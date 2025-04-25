<?php
    require '../../modelo/modelo_matricula.php';
    $MU = new Matricula();
    $consulta = $MU->listar_combo0_Grados0_matricula0();
    echo json_encode($consulta);
?>