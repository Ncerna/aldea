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

  $resp =$MU->Actualizar_Jornada_Grado_Nivel($Idjornada,$grado,$id_GradosNivel,$seccion);

  if($resp>0){

    //VERIFICAR SI ESTA HORAS DE LA JORNA ESTA SIENDO YA UTILIZADOS EN LOS HORARIOS DEVOLVER UN 504

    $res=$MU->Resetaer_datos_Horas($Idjornada);

      $Horainicio=explode(",", $inicios);
      $Horafinal = explode(",",$finales);

       for ($i=0; $i <count($Horainicio) ; $i++) { 

         if ($Horainicio[$i] !='') {
           $consulta = $MU->Registrar_Jornadas_Horas($Idjornada, $Horainicio[$i], $Horafinal[$i],$idyear,$id_GradosNivel,$grado,$seccion,$turno,$idaula);
         }
       }
  echo   $consulta ; 
  }
  else{
  echo 0; 
  }
   //echo "<script> alert('".$var."'); </script>";
  ?>