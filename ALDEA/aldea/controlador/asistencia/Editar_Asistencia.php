<?php
    require '../../modelo/modelo_asistencia.php';
    $asistensia = new Asistensia;

    $fechaEntrada = htmlspecialchars($_POST['fechaEntrada'],ENT_QUOTES,'UTF-8');
     $idgrado = htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');
      $idnivel = htmlspecialchars($_POST['idnivel'],ENT_QUOTES,'UTF-8');
       $idsecion = htmlspecialchars($_POST['idsecion'],ENT_QUOTES,'UTF-8');
        $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');

    $consulta = $asistensia->Buscar_Asistencias($fechaEntrada, $idgrado,$idnivel,$idsecion,$idyear);

        echo json_encode($consulta);

?>