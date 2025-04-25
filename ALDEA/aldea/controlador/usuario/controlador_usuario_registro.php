<?php
    require '../../modelo/modelo_usuario.php';

    $MU = new Modelo_Usuario();

    $rolnombre = htmlspecialchars($_POST['rolnombre'],ENT_QUOTES,'UTF-8');
    $id_docente=htmlspecialchars($_POST['docente'],ENT_QUOTES,'UTF-8');
    $id_alumno = htmlspecialchars($_POST['alumno'],ENT_QUOTES,'UTF-8');
    $id_otro = htmlspecialchars($_POST['otro'],ENT_QUOTES,'UTF-8');

    $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
    $apellido = htmlspecialchars($_POST['apellido'],ENT_QUOTES,'UTF-8');
    $usuario = htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8');
    $token_log = htmlspecialchars($_POST['contra'],ENT_QUOTES,'UTF-8');
    $contra = password_hash($_POST['contra'],PASSWORD_ARGON2I,['cost'=>10]);
    $cbm_rol = htmlspecialchars($_POST['cbm_rol'],ENT_QUOTES,'UTF-8');
    $NameImg = htmlspecialchars($_POST['NameImg'],ENT_QUOTES,'UTF-8');

    $verfivica=$MU->Verificar_Existe_Usuario($cbm_rol,$usuario);

    if ($verfivica==0) {


     if ($rolnombre=='DOCENTE') {
        $check =$MU->Chequear_Usuario_Ya_Generado($id_docente,$cbm_rol);
         
         if ($check==0) {

                if(is_array($_FILES) && count($_FILES)>0){

                $Upl=move_uploaded_file($_FILES["ImgPerfil"]["tmp_name"],"../../imagenes/usuarios/".$NameImg);

                 }

                  if (empty($_FILES["ImgPerfil"])) {
                    $NameImg= '';
                  }

                 $consulta = $MU->Registrar_Docente($id_docente,$nombre,$apellido,$usuario, $contra, $cbm_rol,$NameImg,$token_log);
                echo $consulta;
               }else{echo 100;}      
        return;


        }

      if ($rolnombre=='ALUMNO') {
        $check =$MU->Chequear_Usuario_Ya_Generado($id_alumno,$cbm_rol);
      
      if ($check==0) {

         if(is_array($_FILES) && count($_FILES)>0){
                $Upl=move_uploaded_file($_FILES["ImgPerfil"]["tmp_name"],"../../imagenes/usuarios/".$NameImg);
                 }

                 if (empty($_FILES["ImgPerfil"])) {
                    $NameImg= '';
                  }

         $consulta = $MU->Registrar_Alumno($id_alumno,$nombre,$apellido,$usuario, $contra, $cbm_rol,$NameImg,$token_log);
         echo $consulta;
      }else{echo 100;}
         return;
    }

    
    if ($rolnombre=='ADMINISTRADOR' || $rolnombre=='FUNCIONARIO' || $rolnombre=='APODERADO') {

         if(is_array($_FILES) && count($_FILES)>0){
                $Upl=move_uploaded_file($_FILES["ImgPerfil"]["tmp_name"],"../../imagenes/usuarios/".$NameImg);
                 }

if (empty($_FILES["ImgPerfil"])) {
                    $NameImg= '';
                  }
    	 $consulta = $MU->Registrar_Usuario($id_otro,$nombre,$apellido,$usuario,$contra, $cbm_rol,$NameImg,$token_log);
    echo $consulta;
   // return;
   }

   }else{
    echo  100;
   }
    
   
    /*$consulta = $MU->Registrar_Usuario($usuario,$contra,$sexo,$rol,$usuapell);
    echo $consulta;*/

?>