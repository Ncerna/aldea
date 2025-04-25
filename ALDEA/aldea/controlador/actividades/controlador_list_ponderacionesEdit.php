<?php
    require '../../modelo/modelo_actididades.php';
    $MU = new Actyvite();
    $idActivid = htmlspecialchars($_POST['idActivid'],ENT_QUOTES,'UTF-8');

     $consulta = $MU->listar_puntajes_Edit($idActivid);
     echo json_encode($consulta);
   
     
?>