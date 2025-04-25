

<?php

require '../../modelo/modelo_docente.php';
$MU = new Docente();



$iddocente = htmlspecialchars($_POST['iddocente'],ENT_QUOTES,'UTF-8');
$yearid=htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
$selecionado = htmlspecialchars($_POST['data'],ENT_QUOTES,'UTF-8');
$data=(isset($_POST['data']))? json_decode($_POST['data'],true): array("error"=>"no se pudo completar el registro");


//EXTRAER ID DE CURSOS ASIGNADOS AL DOCENTE SEGUN LOS GRADOS
$idBD = $MU->Extraer_Ides_BD_CursosDocente($iddocente,$yearid);


$datas=array();
foreach ($data as  $value) { $datas[]=$value['idcurso'];}


$idBDs = array();
foreach ($idBD as  $value) { $idBDs[]=$value['idCursos'];}




$quitados = array();
$quitados = array_diff($idBDs,$datas);
$quitados = array_values($quitados);


foreach ($data as  $value) {

  if (in_array($value['idcurso'],$idBDs,true)) {

   

  }else{
    $resultado = $MU->RegistrarNuevoCursoDocente($iddocente,$yearid,$value['idgrado'],$value['idcurso'],$value['iseccion']);
  }

}

 if (count($quitados)>0) {

      if (!empty($quitados)) {

        foreach ($quitados as  $val) {
          $resultado = $MU->QuitarCursosDocente($iddocente,$yearid,$val);
          } 
    
     }
   }
 echo json_encode($resultado?? '');

?>