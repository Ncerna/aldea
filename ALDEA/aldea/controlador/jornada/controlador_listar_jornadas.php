
<?php
    require '../../modelo/modelo_jornadas.php';
    $MU = new JornasHoras();
    
     $yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
     $consulta = $MU->listar_Jornadas_Horas($yearid);
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