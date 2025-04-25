<?php
    require '../../modelo/modelo_grado.php';
    $grado = new Grado();

    $idgrado = htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');
     $yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
      $idseccion = htmlspecialchars($_POST['idseccion'],ENT_QUOTES,'UTF-8');
      $idcursos = htmlspecialchars($_POST['arregloidcurso'],ENT_QUOTES,'UTF-8');
  
       $arreglo= explode(",",$idcursos );//separanso vector
       for ($i=0; $i <count($arreglo) ; $i++) { 
          if ($arreglo[$i] !='') {

             $vefific=$grado->VerificarSiCursoYaEstaAgregadoParaElGrado($idgrado,$arreglo[$i],$yearid);
             
             if($vefific>0){$consulta=1;}else{$consulta = $grado->Registro_Curso_Grado($idgrado,$arreglo[$i],$yearid,$idseccion);}

           }
     }
     echo $consulta;
?>