
<?php
    require '../../modelo/modelo_notas.php';
    $MU = new Nota();

    $consulta = $MU->listarComboGradosViewNotas();
    echo json_encode($consulta);
?>

