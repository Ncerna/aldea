<?php
    require '../../modelo/modelo_fasescolar.php';
    $MU = new Fasescolar();
       $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');

     $consulta = $MU->Extraer_Fase_DelYear($idyear);
     echo json_encode($consulta);  
?>