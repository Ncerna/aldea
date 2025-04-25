
<?php
    require '../../modelo/modelo_criterio.php';
    $MU = new Criterio();


    $id = htmlspecialchars($_POST['idcriterio'],ENT_QUOTES,'UTF-8');
    $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
    $idgrado=htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');
    $idcurso=htmlspecialchars($_POST['idcurso'],ENT_QUOTES,'UTF-8');

     $criterios = htmlspecialchars($_POST['criterios'],ENT_QUOTES,'UTF-8');
     $idnivel = htmlspecialchars($_POST['idnivel'],ENT_QUOTES,'UTF-8');
     $idcriterios = htmlspecialchars($_POST['idcriterios'],ENT_QUOTES,'UTF-8');


     //ID EXISTENTES EN BD
$idBD=$MU->Extraer_Ides_BD($idyear,$idgrado,$idcurso,$idnivel);
$idsBD = array();
foreach($idBD as $key=>$val) {   
  $idsBD[]=  $val['idboletNota'];
}


$idcriterio = explode(",",$idcriterios);
$c_riterios = explode(",",$criterios);


$quitados = array();
$ingresantes = array();


//FUNCIONOS DE FILTROS
function array_search_values( $m_needle, $a_haystack, $b_strict = false){
    return array_values(array_intersect_key( $a_haystack, array_flip( array_keys( $a_haystack, $m_needle, $b_strict))));
}
   
$quitados=array_diff($idsBD, $idcriterio);
$quitados = array_values($quitados);



for ($i=0; $i <count($idcriterio) ; $i++) { 

   

   if ($idcriterio[$i] !='') {
          $ingresantes = array_search_values($idcriterio[$i], $idsBD, true);


      if (!empty($ingresantes[0]?? '') ) {


     $resultado = $MU->Actualizar_Criterio($c_riterios[$i], $idyear,$idgrado,$idcurso,$idnivel,$ingresantes[0]);

      }
          

    if (count($quitados)>0) {

      if (!empty($quitados)) {

        for ($j=0; $j <count($quitados) ; $j++) { 
          
           $resultado = $MU->Eliminar_Criterios($quitados[$j]);
        }

     }
   }

   if($idcriterio[$i]==0){

      $resultado = $MU->Registrar_Criterio($c_riterios[$i], $idyear,$idgrado,$idcurso,$idnivel);
  }

}

}

if ($resultado>0) {
  echo $resultado;
}else{
  echo 0;
}
    
     
?>