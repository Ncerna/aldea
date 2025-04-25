<?php
    require '../../modelo/modelo_actididades.php';
    $MU = new Actyvite();
    $consulta = $MU->Listar_Combo_Cursos();
    echo json_encode($consulta);


?>