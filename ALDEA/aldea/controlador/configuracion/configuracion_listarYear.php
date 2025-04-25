<?php
    require '../../modelo/modelo_configuracion.php';
    $MU = new Configuracion();
    $consulta = $MU->listar_configuracionYear();
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