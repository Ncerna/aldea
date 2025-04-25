<?php
    require '../../modelo/modelo_matricula.php';
    $MU = new Matricula();
    $idyear = isset($_GET['idyear']) ? $_GET['idyear'] : null;
    $consulta = $MU->get_studentsBy_yearId($idyear);
    echo json_encode($consulta);
?>