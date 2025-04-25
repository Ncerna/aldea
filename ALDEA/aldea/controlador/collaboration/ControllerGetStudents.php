<?php
    require '../../modelo/modelo_alumnos.php';
    $MU = new Alumno();
    $consulta = $MU->list_studentes_keys();
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