<?php
   require '../../modelo/modelo_alumnos.php';
    $MU = new Alumno();
    $idalumno = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Dar_DeBaja_Alumnos($idalumno);
    echo $consulta;

?>