<?php
   
  require '../../modelo/modelo_alumnos.php';
    $MU = new Alumno();
    $idalumno = htmlspecialchars($_POST['idalumno'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Extraer_Datos_Alumno($idalumno);
    echo json_encode($consulta);;



?>