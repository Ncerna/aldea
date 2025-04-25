<?php
    require '../../modelo/modelo_boletaNota.php';
    $MU = new Boletin_Notas();

    $idcurso = htmlspecialchars($_POST['idcurso'],ENT_QUOTES,'UTF-8');
    $id_year = htmlspecialchars($_POST['id_year'],ENT_QUOTES,'UTF-8');
     $idgrado = htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->listar_Criterios_Curso($idcurso,$id_year, $idgrado);
    echo json_encode($consulta);
?>
