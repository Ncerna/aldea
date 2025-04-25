<?php


    session_start();
if(isset($_SESSION['S_IDUSUARIO'])){
    require '../../modelo/modelo_usuario.php';

    $MU = new Modelo_Usuario();
    $idusuario = htmlspecialchars($_POST['idusuario'],ENT_QUOTES,'UTF-8');

    if ($_SESSION['S_IDUSUARIO'] != $idusuario) {

    $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Modificar_Estatus_Usuario($idusuario,$estatus);
    echo $consulta;
    
}else{
	echo 0;
}
}

?>