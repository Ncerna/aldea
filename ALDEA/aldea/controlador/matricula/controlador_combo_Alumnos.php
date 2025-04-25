
<?php
    require '../../modelo/modelo_matricula.php';
    $MU = new Matricula();
    $consulta = $MU->listar_combo_Alumnos_Matricular();
    echo json_encode($consulta);
?>