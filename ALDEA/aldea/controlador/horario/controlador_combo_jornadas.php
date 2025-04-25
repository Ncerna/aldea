

<?php
     require '../../modelo/modelo_horario.php';

   $horario = new Horario();
    $yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');

     $consulta = $horario->Listar_combo_Jornadas($yearid);
   echo json_encode($consulta);

?>
