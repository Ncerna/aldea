<?php
    require '../../modelo/modelo_jornadas.php';
    $MU = new JornasHoras();
   
    $Idjornada = htmlspecialchars($_POST['idejorna'],ENT_QUOTES,'UTF-8');
    $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
    $turno = htmlspecialchars($_POST['turno'],ENT_QUOTES,'UTF-8');
    $grado = htmlspecialchars($_POST['nivelacade'],ENT_QUOTES,'UTF-8');
    $inicioacde = htmlspecialchars($_POST['inicioacde'],ENT_QUOTES,'UTF-8');
    $fialacde =htmlspecialchars($_POST['fialacde'],ENT_QUOTES,'UTF-8');
    
     $inicios = htmlspecialchars($_POST['inicios'],ENT_QUOTES,'UTF-8');
     $finales = htmlspecialchars($_POST['finales'],ENT_QUOTES,'UTF-8');

     $id_GradosNivel = htmlspecialchars($_POST['id_GradosNivel'],ENT_QUOTES,'UTF-8');
      $seccion = htmlspecialchars($_POST['seccion'],ENT_QUOTES,'UTF-8');
       $idaula = htmlspecialchars($_POST['idaula'],ENT_QUOTES,'UTF-8');

     $verificar=$MU->Verificar_Jornada($turno,$grado,$id_GradosNivel,$seccion);


     if($verificar==0){

     $Idjornada =$MU->Registrar_Jornada($idyear,$turno,$grado,$inicioacde,$fialacde,$id_GradosNivel,$seccion,$idaula);

      $Horainicio=explode(",", $inicios);
      $Horafinal = explode(",",$finales);

    for ($i=0; $i <count($Horainicio) ; $i++) { 
      
      if ($Horainicio[$i] !='') {
          $consulta = $MU->Registrar_Jornadas_Horas($Idjornada, $Horainicio[$i], $Horafinal[$i],$idyear,$id_GradosNivel,$grado,$seccion,$turno, $idaula);
        }
    }
    echo   $consulta ; 
   }
   else{
    echo  100;
   }
   //echo "<script> alert('".$var."'); </script>";
?>