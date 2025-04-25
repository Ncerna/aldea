<?php
session_start();
if (!empty($_SESSION['S_IDENTYTI'])) {
    //require '../../modelo/modelo_actididades.php';
   // $MU = new Actyvite();
$yearid = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
 $id_docente = $_SESSION['S_IDENTYTI'];



///RECUPERAMOS LOS GRADOS DEL DOCENTE
require '../../modelo/modelo_docente.php';
$MU = new Docente();
$grados=$MU->Gados_Docente_Asignado($id_docente ,$yearid);


///LISTAMOS ALUMNOS PERTENECIENTES AL GRADO MATRICULADOS
$alumnos = array();
if (!empty($grados)) {

    foreach ($grados as $value) {
        $alumnos = $MU->listar_alumnos_de_Grados_Docente($alumnos, $value['gradoId'],$yearid); 
    }
}

  $consulta = array('data' =>  $alumnos);
    
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