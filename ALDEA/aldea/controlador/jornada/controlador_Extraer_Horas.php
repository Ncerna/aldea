
<?php
    require '../../modelo/modelo_jornadas.php';
    $MU = new JornasHoras();

     $idjornada = htmlspecialchars($_POST['idjornada'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->listar_Horas_Jornadas($idjornada);
    echo json_encode($consulta);
?>