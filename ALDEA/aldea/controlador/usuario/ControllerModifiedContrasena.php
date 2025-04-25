<?php


session_start();

if (!empty($_SESSION['S_IDUSUARIO'])) {
  $usu_id = $_SESSION['S_IDUSUARIO'];

  require '../../modelo/modelo_usuario.php';
  $MU = new Modelo_Usuario();

  $NameImg = htmlspecialchars($_POST['NameImg'],ENT_QUOTES,'UTF-8');
  $contraActual = htmlspecialchars($_POST['contraActual'],ENT_QUOTES,'UTF-8');
  $newcontra = htmlspecialchars($_POST['newcontra'],ENT_QUOTES,'UTF-8');
  $segundacontra = htmlspecialchars($_POST['segundacontra'],ENT_QUOTES,'UTF-8');
   $fotoActual = htmlspecialchars($_POST['fotoActual'],ENT_QUOTES,'UTF-8');


  if (empty($newcontra) || empty($contraActual) || empty($segundacontra)) {
    $concat='';
    $concat.='<div class="" style="border-color: #f5c6cb;">';
    $concat.='<div id="avisomanual" class="alert  sm" role="alert" style="color: #721c24; background-color: #f8d7da;">';
    $concat.='<button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    $concat.='Llene los Campos vacios !!';
    $concat.='</div>';
    $concat.='</div>'; 

    $response = array('status' => true,'auth' => true,'msg' => 'is autorizado','data'=>$concat);
    echo json_encode($response);

    return;
  }

  if ($newcontra != $segundacontra) {
   $concat='';
    $concat.='<div class="" style="border-color: #f5c6cb;">';
    $concat.='<div id="avisomanual" class="alert  sm" role="alert" style="color: #721c24; background-color: #f8d7da;">';
    $concat.='<button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    $concat.='Las contraseñas nuevas no Coisiden (No son iguales)';
    $concat.='</div>';
    $concat.='</div>'; 

    $response = array('status' => true,'auth' => true,'msg' => 'is autorizado','data'=>$concat);
    echo json_encode($response);

    return;
  }


  $consulta = $MU->Extraer_contrasena_verifiy($usu_id);

//////////////////

  if(password_verify($contraActual, $consulta[0]["usu_contrasena"])){

   if(password_verify($segundacontra, $consulta[0]["usu_contrasena"])){
    
     $concat='';
    $concat.='<div class="" style="border-color: #f5c6cb;">';
    $concat.='<div id="avisomanual" class="alert  sm" role="alert" style="color: #721c24; background-color: #f8d7da;">';
    $concat.='<button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    $concat.=' La contraseña ya ha sido utilizados es similar al anterio';
    $concat.='</div>';
    $concat.='</div>'; 

    $response = array('status' => true,'auth' => true,'msg' => 'is autorizado','data'=>$concat);
    echo json_encode($response);
    return;

   }else{


   if(is_array($_FILES) && count($_FILES)>0){
    if (!empty($_FILES["bystImg"])) {

      $phatlogo ="../../imagenes/usuarios/".$fotoActual;
      if (file_exists($phatlogo)) {
       unlink($phatlogo);
     }
     $Upl=move_uploaded_file($_FILES["bystImg"]["tmp_name"],"../../imagenes/usuarios/".$NameImg);


      $segundacontra = password_hash($segundacontra,PASSWORD_ARGON2I,['cost'=>10]);
     $Request = $MU->Update_foto_and_contrasena($usu_id,$NameImg,$segundacontra);

     $response = array('status' => true,'auth' => true,'msg' => 'is autorizado','data'=>$Request);
    echo json_encode($response);

   }
 }else{
      $segundacontra = password_hash($segundacontra,PASSWORD_ARGON2I,['cost'=>10]);
     $Request = $MU->Update_Solo_contrasena($usu_id,$segundacontra);
      $response = array('status' => true,'auth' => true,'msg' => 'is autorizado','data'=>$Request);

    echo json_encode($response);
 }




   }


}else{
   $concat='';
    $concat.='<div class="" style="border-color: #f5c6cb;">';
    $concat.='<div id="avisomanual" class="alert  sm" role="alert" style="color: #721c24; background-color: #f8d7da;">';
    $concat.='<button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    $concat.=' La Contraseña Actual ingresado es incorecto !!';
    $concat.='</div>';
    $concat.='</div>'; 

    $response = array('status' => true,'auth' => true,'msg' => 'is autorizado','data'=>$concat);
    echo json_encode($response);
    return;

}

 

}else{
  $concat='';
  $concat.='<div class="" style="border-color: #f5c6cb;">';
  $concat.='<div id="avisomanual" class="alert  sm" role="alert" style="color: #721c24; background-color: #f8d7da;">';
  $concat.='<button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
  $concat.='<strong> NO AUTORIZADO PARA ESTA SECCION!! '.$usu_id.'</strong> ';
  $concat.='</div>';
  $concat.='</div>'; 

  $response = array('status' => true,'auth' => false,'msg' => 'Not autorizado','data'=>$concat);
  echo json_encode($response);

}


?>