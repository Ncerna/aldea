<?php
    require '../../modelo/modelo_asistencia.php';
    $asistensia = new Asistensia;
    $fechainicio = htmlspecialchars($_POST['finicio'],ENT_QUOTES,'UTF-8');
    $fechafin = htmlspecialchars($_POST['fFinal'],ENT_QUOTES,'UTF-8'); 
    $consulta = $asistensia->Extraer_asistencias($fechainicio,$fechafin);
    
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