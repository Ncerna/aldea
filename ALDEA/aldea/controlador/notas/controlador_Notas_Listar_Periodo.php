<?php
//NO SE ESTA USANDO EN NINGUNA PRTE
    require '../../modelo/modelo_notas.php';
    $MU = new Nota();
    $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Listar_alumnos_periodo_curso($idyear);
    echo json_encode($consulta);
?>