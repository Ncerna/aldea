<?php
    require '../../modelo/modelo_configuracion.php';

    $MU = new Configuracion();
    $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->listar_Yearturnos($idyear);
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
