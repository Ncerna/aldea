
<?php
    require '../../modelo/modelo_matricula.php';
    $MU = new Matricula();
     $yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Listar_Alumnos_matriculados($yearid);
    
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