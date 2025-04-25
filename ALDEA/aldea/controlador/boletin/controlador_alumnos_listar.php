<?php
    require '../../modelo/modelo_boletaNota.php';
    $MU = new Boletin_Notas();

    $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->listar_alumnos_Parametrizado($idyear);
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