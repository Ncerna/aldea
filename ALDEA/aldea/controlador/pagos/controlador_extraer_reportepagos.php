
<?php
    require '../../modelo/modelo_pagos.php';
    $MU = new Pagos();

     $finicio = isset($_POST['finicio']) ? htmlspecialchars($_POST['finicio'], ENT_QUOTES, 'UTF-8') : null;
    $fFinal = isset($_POST['fFinal']) ? htmlspecialchars($_POST['fFinal'], ENT_QUOTES, 'UTF-8') : null;


    $consulta = $MU->listar_Reportes_PorFechas($finicio, $fFinal);
  
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