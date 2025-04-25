

<?php

session_start();
if(isset($_SESSION['S_IDUSUARIO'])){
    
    require '../../modelo/modelo_usuario.php';
    $MU = new Modelo_Usuario();
    $consulta = $MU->listar_usuario();

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