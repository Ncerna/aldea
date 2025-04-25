
<?php
     require '../../modelo/modelo_horario.php';

   $horario = new Horario();
    $idhorario = htmlspecialchars($_POST['idtd'],ENT_QUOTES,'UTF-8');

     $tdId = substr($idhorario, -2);

     $respuesta = $horario->eliminar($tdId);

    //$consulta = $MU->Datos_Usuario_eliminar( $idusuario);
    echo $respuesta;

?>

