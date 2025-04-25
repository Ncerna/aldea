
<?php
    require '../../modelo/modelo_configuracion.php';

    $MU = new Configuracion();
    $id = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
    $stad = htmlspecialchars($_POST['stad'],ENT_QUOTES,'UTF-8');

    //$consulta = $MU->Verificar_Estado_Year($id);
   /// if($consulta==0){

    	$con = $MU->Modificar_Estado_Year($id,$stad);
    	echo json_encode($con);
    //}else{
    	
   // }

    
?>