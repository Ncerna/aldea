
<?php
    require '../../modelo/modelo_aula.php';
    $aula = new Aula();
     $idAula = htmlspecialchars($_POST['idAula'],ENT_QUOTES,'UTF-8');
     if ($idAula==null) {
        $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
        $piso=htmlspecialchars($_POST['piso'],ENT_QUOTES,'UTF-8');
        $numero = htmlspecialchars($_POST['numero'],ENT_QUOTES,'UTF-8');
        $aforro = htmlspecialchars($_POST['aforro'],ENT_QUOTES,'UTF-8');
         $estado = htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');

        $exist = $aula->Verificar_Existencia($nombre,$piso);

        if($exist==0){
          $consulta = $aula->Registrar_Aula($nombre,$piso,$numero,$aforro,$estado);
         echo $consulta;
        }else{ echo 100; }
     }else{
        
        $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
        $piso=htmlspecialchars($_POST['piso'],ENT_QUOTES,'UTF-8');
        $numero = htmlspecialchars($_POST['numero'],ENT_QUOTES,'UTF-8');
        $aforro = htmlspecialchars($_POST['aforro'],ENT_QUOTES,'UTF-8');
         $estado = htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');
        //$exist = $aula->Verificar_Existencia($nombre,$piso);
        //if($exist==0){
          $consulta = $aula->Actualizar_Aula($idAula,$nombre,$piso,$numero,$aforro,$estado);
       echo $consulta;
       // }else{echo 100;}
       

     }
    
?>