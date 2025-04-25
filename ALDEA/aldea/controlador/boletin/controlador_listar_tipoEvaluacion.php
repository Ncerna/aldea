<?php
    require '../../modelo/modelo_boletaNota.php';
    $MU = new Boletin_Notas();

    $id_year = htmlspecialchars($_POST['id_year'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->listar_TiposEvaluacion_year($id_year);
    echo json_encode($consulta);
?>
