<?php
    require '../../modelo/modelo_aula.php';
    $aula = new Aula();
    $consulta = $aula->listar_combo_editTurnos();
    echo json_encode($consulta);
?>