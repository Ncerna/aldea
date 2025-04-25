

<?php
require '../../modelo/modelo_docente.php';
$MU = new Docente();


$idDocente = htmlspecialchars($_POST['idDocente'],ENT_QUOTES,'UTF-8');


  $consulta = $MU->Show_Data_Docente($idDocente);

   echo json_encode($consulta);

       ?>