
<?php
    require '../../modelo/modelo_docente.php';
    $MU = new Docente();
    $consulta = $MU->Listar_Docentes_Disponibles();

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