<?php
session_start(); 
if (!empty($_SESSION['S_IDUSUARIO'])) {

 $idsesion = $_SESSION['S_IDENTYTI'] ?  $_SESSION['S_IDENTYTI']: $_SESSION['S_IDUSUARIO'];

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

     // $ordentipo ==esto es la pocision
    // $periotipoevaluacion== esto el el id real de periodo de evaliacion 

    $verificar=$MU->Verificar_Actividad($idyear,$curso,$ordentipo);


    if($verificar==0){
    	//REGISTRAR ACTIVIDADES CURSO
    	 $idActivid = $MU->Registrar_Activite($idyear,$curso,$periotipoevaluacion,$ordentipo,$idsesion);
         //REGISTRAR ACTIVIDES_PUNTAJES
         $activiti = explode(",",$actividades);
         $ponderado = explode(",", $puntajes);

         
          for ($i=0; $i <count($activiti) ; $i++) { 
            if ($activiti[$i] !='') {

              $consulta = $MU->Activite_CursoPuntajes($idActivid, $activiti[$i], $ponderado[$i],$curso,$periotipoevaluacion,$ordentipo,$idyear,$idsesion);
              }


           }
           echo $consulta;
      }else{echo 100;}

    }else{

      $response = array('status' => true,'auth' => false,'mensaje' => 'No estas autenticado en el sistema','data'=>'','session' => false,);
           echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }
     
?>