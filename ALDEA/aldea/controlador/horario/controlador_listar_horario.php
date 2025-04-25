

<?php
     require '../../modelo/modelo_horario.php';

   $horario = new Horario();
   
   $yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
   
   $consulta = $horario->listar_Horario_Disponibles($yearid);
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