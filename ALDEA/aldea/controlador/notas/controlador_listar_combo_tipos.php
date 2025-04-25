
<?php
    require '../../modelo/modelo_notas.php';
    $MU = new Nota();

    $consulta = $MU->Listar_combo_tipos();
    echo json_encode($consulta);
?>