<?php
    require '../../modelo/modelo_usuario.php';

    session_start();
if(isset($_SESSION['S_IDUSUARIO'])){
	
$idusuario = htmlspecialchars($_POST['idusuario'],ENT_QUOTES,'UTF-8');
	if ($_SESSION['S_IDUSUARIO'] != $idusuario) {

		 $MU = new Modelo_Usuario();
    $idusuario = htmlspecialchars($_POST['idusuario'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Datos_Usuario_eliminar( $idusuario);
    echo $consulta;

   
}else{
echo 0;
}
}

?>