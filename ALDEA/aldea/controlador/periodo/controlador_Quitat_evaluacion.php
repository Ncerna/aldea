
<?php
    require '../../modelo/modelo_periodo.php';
    $MU = new Periodo_Eva();
    $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
    //VErificar si esta ya siendo evaluado

     $verificar = $MU->VerificarSiYaTieneActividades($idyear);
     if($verificar==0){
       $consulta = $MU->Quitar_Periodo_Evaluacion($idyear);
       echo json_encode($consulta);
     }else{
      echo 504;
     }


    

?>