<?php
    require '../../modelo/modelo_notas.php';
    $MU = new Nota();

  
   $idgrado = htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');
   $idnivel = htmlspecialchars($_POST['idnivel'],ENT_QUOTES,'UTF-8');
   $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
   $idsecion = htmlspecialchars($_POST['idsecion'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->listar_alumnosParaPonerNotas($idgrado,$idnivel, $idyear, $idsecion);
    echo json_encode($consulta);
?>