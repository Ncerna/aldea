
<?php
require '../../modelo/modelo_docente.php';
$MU = new Docente();


$idgrado = htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');
$idocente = htmlspecialchars($_POST['idocente'],ENT_QUOTES,'UTF-8');
$yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');

  $consulta = $MU->Quitrar_Grados_Asignados($idgrado,$idocente,$yearid);

   echo json_encode($consulta);

       ?>