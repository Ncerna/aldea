<?php
    require '../../modelo/modelo_configuracion.php';

    $MU = new Configuracion();
    $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Extraer_TurnosYear($idyear);
    $data = json_encode($consulta);
    if(count($consulta)>0){
        echo $data;
    }else{
        echo 0;
    }
?>