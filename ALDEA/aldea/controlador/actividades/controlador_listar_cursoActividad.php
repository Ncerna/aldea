<?php
    require '../../modelo/modelo_actididades.php';
    $MU = new Actyvite();

   
     $yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
     $consulta = $MU->listar_cursosActividad($yearid );
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