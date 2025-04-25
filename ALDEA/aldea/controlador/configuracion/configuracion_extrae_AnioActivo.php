<?php
    require '../../modelo/modelo_configuracion.php';

    $MU = new Configuracion();

    $consulta = $MU->Extraer_Year_Actuvo();
   echo  json_encode($consulta);
   
?>