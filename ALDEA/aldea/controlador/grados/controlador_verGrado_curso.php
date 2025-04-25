<?php
    require '../../modelo/modelo_grado.php';
    $grado = new Grado();

    $idgrado = htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');
     $yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');

    $consulta =  $grado->Ver_Grado_Curso($idgrado,$yearid);
    
       echo json_encode($consulta);




?>