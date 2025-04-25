<?php
require '../../modelo/modelo_docente.php';
$MU = new Docente();


$yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
$iddocente = htmlspecialchars($_POST['iddocente'],ENT_QUOTES,'UTF-8');
$idniveldocent = htmlspecialchars($_POST['idniveldocent'],ENT_QUOTES,'UTF-8');

$idgrados = htmlspecialchars($_POST['idgrados'],ENT_QUOTES,'UTF-8');
$idnivelgrados = htmlspecialchars($_POST['idnivelgrado'],ENT_QUOTES,'UTF-8');
$idseccion = htmlspecialchars($_POST['seccionesid'],ENT_QUOTES,'UTF-8');

$selecionado = htmlspecialchars($_POST['data'],ENT_QUOTES,'UTF-8');
$data=(isset($_POST['data']))? json_decode($_POST['data'],true): array("error"=>"no se pudo completar el registro");


       $idgrado    = explode(",",$idgrados );//separanso vector
       $idnivelgrado = explode(",",$idnivelgrados );//separanso vector
       $idsecciones = explode(",",$idseccion);//separanso vector

       for ($i=0; $i <count($idgrado) ; $i++) { 
       	if ($idgrado[$i] !='') {

       		$vefific=$MU->VerificarSiGradoYaEstaAgregadoParaDocente($idgrado[$i],$idnivelgrado[$i],$idsecciones[$i],$yearid,$iddocente);

       		if($vefific>0){
       			$consulta=1;
       		}else{
       			$consulta = $MU->Registro_Docente_Grado($iddocente,$idgrado[$i],$idnivelgrado[$i],$idsecciones[$i],$yearid);
       		}

       	}
       }
      // echo $consulta;

       foreach ($data as $value) {

              $consultar=$MU->VerificarCursoYaExisteParaDocente($value['idgrado'],$value['idcurso'],$iddocente,$yearid,$value['idseccion']);

              if ($consultar==0) {
              
              $registra=$MU->RegistarCursosDocente($iddocente,$value['idgrado'],$value['idcurso'],$yearid,$value['idseccion']);

              }
              
       }

       echo $registra?? $consulta;

       ?>