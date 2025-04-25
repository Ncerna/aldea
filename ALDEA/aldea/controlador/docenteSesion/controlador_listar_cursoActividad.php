<?php  
session_start();
if (!empty($_SESSION['S_IDENTYTI'])) {
    //require '../../modelo/modelo_actididades.php';
   // $MU = new Actyvite();
$yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
 $id_docente = $_SESSION['S_IDENTYTI'];


///RECUPERAMOS LOS GRADOS DEL DOCENTE
require '../../modelo/modelo_docente.php';
$MU = new Docente();
$idsBDCurso = array();
$grados=$MU->Gados_Docente_Asignado($id_docente ,$yearid);

///LISTAMOS CURSOS DE LOS GRADOS RECUPERADOS PERO DEL DOCENTE

if (!empty($grados)) {
    foreach ($grados as $value) {
        $idsBDCurso = $MU->CursosDelGadoByIdDocente($idsBDCurso, $value['gradoId'],$yearid,$id_docente); 
    }
}


$cargas = array();
//DUSCAMOA LAS ACTIVIDADES DEL CURSO O CARGAS ACADEMICOS//

if (!empty($idsBDCurso)) {
   foreach ($idsBDCurso as  $value) {

     $cargas=  $MU->listar_ActividadesDelCurso($cargas,$yearid,$value['idCursos']);
   }
}
$consulta = array('data' =>  $cargas);


    
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