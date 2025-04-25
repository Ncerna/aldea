<?php
session_start();
 
if (!empty($_SESSION['S_IDUSUARIO'])) {

 $idsesion = $_SESSION['S_IDENTYTI']?  $_SESSION['S_IDENTYTI']: $_SESSION['S_IDUSUARIO'];

//POR EL MOMENTO SLO ESTA PERMITIDO EDITAR CURSO Y NOMBRE DE ACTIVIDAD
require '../../modelo/modelo_actididades.php';
$MU = new Actyvite();
$idActivid = htmlspecialchars($_POST['idActivid'],ENT_QUOTES,'UTF-8');
$idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
$curso=htmlspecialchars($_POST['curso'],ENT_QUOTES,'UTF-8');
$periotipoevaluacion=htmlspecialchars($_POST['periotipoevaluacion'],ENT_QUOTES,'UTF-8');
$ordentipo=htmlspecialchars($_POST['tipoevalu'],ENT_QUOTES,'UTF-8');

$actividades = htmlspecialchars($_POST['actividades'],ENT_QUOTES,'UTF-8');
$puntajes = htmlspecialchars($_POST['puntajes'],ENT_QUOTES,'UTF-8');
$idActividaedes = htmlspecialchars($_POST['idActividaedes'],ENT_QUOTES,'UTF-8');


//QUITANDO O SEPARANDO , DE LOS ARRAY
$activiti = explode(",",$actividades);
$ponderado = explode(",", $puntajes);
//IDES ENTRANTE GUI
$idsActividdad = explode(",", $idActividaedes);

     //ID EXISTENTES EN BD
$idBD=$MU->Extraer_Ides_BD($idActivid);
$idsBD = array();
foreach($idBD as $key=>$val) {   
  $idsBD[]=  $val['actcur_id'];
}
//////////////////////

//ARRAYS

$restantes = array();
$quitados = array();
$ingresantes = array();


//FUNCIONOS DE FILTROS
function array_search_values( $m_needle, $a_haystack, $b_strict = false){
    return array_values(array_intersect_key( $a_haystack, array_flip( array_keys( $a_haystack, $m_needle, $b_strict))));
}
   
$quitados=array_diff($idsBD, $idsActividdad);
$quitados = array_values($quitados);





//ACTUALIZAR LA TABLA
$resultado = $MU->Actualizar_Activite($idActivid,$idyear,$curso,$periotipoevaluacion,$ordentipo);


if($resultado>0){
 

  for ($i=0; $i <count($idsActividdad) ; $i++) { 

   

   if ($idsActividdad[$i] !='') {
          $ingresantes = array_search_values($idsActividdad[$i], $idsBD, true);


      if (!empty($ingresantes[0]?? '') ) {

        $consulta = $MU->Actualizar_Actividedes($activiti[$i], $ponderado[$i],$curso,$ingresantes[0],$idsesion);

      }
          

    if (count($quitados)>0) {

      if (!empty($quitados)) {

        for ($j=0; $j <count($quitados) ; $j++) { 
          
           $consulta = $MU->Eliminar_Actividedes($quitados[$j],$idActivid);
        }

     }
   }

   if($idsActividdad[$i]==0){

    $consulta = $MU->Activite_CursoPuntajes($idActivid, $activiti[$i], $ponderado[$i],$curso,$periotipoevaluacion,$ordentipo,$idyear,$idsesion);

  }

}

}

echo json_encode($consulta);


}else{}

}





?>