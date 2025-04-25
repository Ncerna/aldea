
<?php
    require '../../modelo/modelo_jornadas.php';
    $MU = new JornasHoras();

     $idturno = htmlspecialchars($_POST['idturno'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->listar_Horas_Turnos($idturno);
    echo json_encode($consulta);
?>