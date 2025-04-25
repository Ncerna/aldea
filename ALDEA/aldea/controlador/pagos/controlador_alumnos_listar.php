<?php
    require '../../modelo/modelo_pagos.php';
    $MU = new Pagos();

  $yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
    
    $consulta = $MU->listar_alumnos_Pagos($yearid);
    if($consulta){
        echo json_encode($consulta);
    }else{
        echo '{
		    "sEcho": 1,
		    "iTotalRecords": "0",
		    "iTotalDisplayRecords": "0",
		    "aaData": []
		}';
    }

?>