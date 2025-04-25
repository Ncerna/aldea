

<?php
    require '../../modelo/modelo_periodo.php';
    $MU = new Periodo_Eva();

    $yearid= htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');

$consulta = $MU->listar_periodos_Ev($yearid);
 echo json_encode($consulta);

?>