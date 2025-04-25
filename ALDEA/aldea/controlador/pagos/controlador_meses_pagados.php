<?php
     require '../../modelo/modelo_pagos.php';
    $MU = new Pagos();

    $nombAlum = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->listar_meses_pagados($nombAlum);
    
       echo json_encode($consulta);
    
?>