<?php

session_start();
if(isset($_SESSION['S_IDUSUARIO'])){
    
    require '../../modelo/modelo_docente.php';
    $MU = new Docente();
    $consulta = $MU->listar_docente();

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

}

 /*echo $joson = '{"data":[{"usu_id":"4","usu_nombre":"CERNA","usu_apellido":"CHAVEZ CORRY","usu_sexo":"M","rol_nombre":"ADMINISTRADOR","usu_estatus":"ACTIVO"},{"usu_id":"7","usu_nombre":"Maria","usu_apellido":"paz mendoza","usu_sexo":"M","rol_nombre":"ADMINISTRADOR","usu_estatus":"ACTIVO"}]}';*/

?>