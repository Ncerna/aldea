<?php 
session_start(); 
if (!empty($_SESSION['S_IDENTYTI'])) {
  
$yearid   = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
 $id_docente = $_SESSION['S_IDENTYTI'];



///RECUPERAMOS LOS GRADOS DEL DOCENTE
require '../../modelo/modelo_docente.php';
$MU = new Docente();
$idgrados = array();
$grados=$MU->Gados_Docente_Asignado($id_docente ,$yearid);

///LISTAMOS horario de los grados DOCENTE

if (!empty($grados)) {
    foreach ($grados as $value) {
        $idgrados = $MU->Horarios_Grados_Docente($idgrados, $value['gradoId'],$yearid); 
    }
}



$consulta = array('data' =>  $idgrados);


    
    if(isset( $consulta)){
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




     
?>