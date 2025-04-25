
<?php


session_start();

if (!empty($_SESSION['S_IDENTYTI'])) {
  ///$_SESSION['S_IDUSUARIO']

    $idsession = $_SESSION['S_IDENTYTI'];

  }else{
     $idsession = $_SESSION['S_IDUSUARIO'];
  }

require '../../modelo/modelo_boletaNota.php';
$MU = new Boletin_Notas();

$idAlumno = htmlspecialchars($_POST['idAlumno'],ENT_QUOTES,'UTF-8');
$idcurso = htmlspecialchars($_POST['idcurso'],ENT_QUOTES,'UTF-8');
$gradoid = htmlspecialchars($_POST['gradoid'],ENT_QUOTES,'UTF-8');
$idnivel = htmlspecialchars($_POST['idnivel'],ENT_QUOTES,'UTF-8');
$tipo = htmlspecialchars($_POST['tipo'],ENT_QUOTES,'UTF-8');

$id_year = htmlspecialchars($_POST['id_year'],ENT_QUOTES,'UTF-8');
$long = htmlspecialchars($_POST['long'],ENT_QUOTES,'UTF-8');

$citerios = htmlspecialchars($_POST['citerios'],ENT_QUOTES,'UTF-8');
$calificaciones = htmlspecialchars($_POST['calificaciones'],ENT_QUOTES,'UTF-8');


$contador=0;
$idcriterios=explode(",", $citerios);
$califili_crite = explode(",",$calificaciones);



$verific= $MU->Verifica_Exsistencia($idAlumno,$idcurso,$id_year,$gradoid,$idnivel,$tipo);

if($verific>0){
  $resquet = $MU->Resetear_Table_notasalfabetico($idAlumno,$idcurso,$id_year,$gradoid,$idnivel,$tipo, $idsession);
}

$numero=0;

for ($i=0; $i <count($idcriterios) ; $i++) { 
  if ($idcriterios[$i] !='') {


   for ($j=0; $j< $long ; $j++) { 

      $consulta=$MU->Registrar_notas_Curso_Alumno_alfabeticos($idAlumno,$idcriterios[$i],$califili_crite[$j],$idcurso,$id_year,$gradoid,$idnivel,$tipo, $idsession);
      $contador++;

  }
  $califili_crite=array_slice($califili_crite,$contador);
  $contador=0;
}  

}
echo !empty($consulta) ? $consulta : 0;



?>