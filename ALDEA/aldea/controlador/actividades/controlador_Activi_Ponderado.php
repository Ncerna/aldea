<?php
    require '../../modelo/modelo_actididades.php';
    $MU = new Actyvite();
    $idActivid = htmlspecialchars($_POST['idActivid'],ENT_QUOTES,'UTF-8');

     $consulta = $MU->listar_cursos_poderados($idActivid);
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