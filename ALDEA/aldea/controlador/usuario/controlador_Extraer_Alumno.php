<?php
    require '../../modelo/modelo_usuario.php';

    $MU = new Modelo_Usuario();
    $idalumno = htmlspecialchars($_POST['idalumno'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Extraer_Datos_Alumno($idalumno);
   echo json_encode($consulta);

?>