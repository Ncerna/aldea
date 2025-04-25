


<?php
require '../../modelo/modelo_docente.php';
$MU = new Docente();


$iddocente = htmlspecialchars($_POST['iddocente'],ENT_QUOTES,'UTF-8');
$yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');



  $consulta = $MU->listar_Grados_Docente($iddocente,$yearid);

   echo json_encode($consulta);

       ?>