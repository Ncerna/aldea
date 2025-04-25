
<?php
require '../../modelo/modelo_matricula.php';
$MU = new Matricula();
$idalumno = htmlspecialchars($_POST['idalumno'],ENT_QUOTES,'UTF-8');
$yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
$section = htmlspecialchars($_POST['section'],ENT_QUOTES,'UTF-8');

$consulta= $MU->Extraer_Grado_Actual($idalumno,$yearid,$section);

if(isset($consulta[0]['Id_grado'])){

 $idgrado=$consulta[0]['Id_grado'];
 $Id_nivls=$consulta[0]['Id_nivls'];

$vacantes= $MU->Extraer_Vacantes_Grado($idgrado,$Id_nivls,$section);

if(isset($vacantes[0]['vacantes'])){
  $vact = $vacantes[0]['vacantes'];

  $newvacante= $vact+1;

  $consulta= $MU->Aumentar_Vacantes_grado($idgrado,$yearid, $newvacante);

  $consulta=  $MU->Retirar_Alumnos_matriculado($idalumno,$yearid);
  echo $consulta;

}else{echo 404;}
}else{echo 404;}


    /// foreach ($consulta as $resul) {$idgrado= $resul['Id_grado']? $resul['Id_grado']:0 ; }


     ///foreach ($vacantes as $resul) {$vact = $resul['vacantes']? $resul['vacantes']:0 ; }


?>