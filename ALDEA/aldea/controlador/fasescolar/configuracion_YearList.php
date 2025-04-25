
<?php
    require '../../modelo/modelo_fasescolar.php';
    $MU = new Fasescolar();

     $consulta = $MU->listar_configuracionFase();
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