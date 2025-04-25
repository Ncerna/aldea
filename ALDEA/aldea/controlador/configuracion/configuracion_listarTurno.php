

<?php
    require '../../modelo/modelo_configuracion.php';
    $MU = new Configuracion();
    $consulta = $MU->Listar_Turnos();
    echo json_encode($consulta);



    /*public GearmanClient::addTaskHighBackground(
    string $function_name,
    string $workload,
    mixed &$context = ?,
    string $unique = ?
): GearmanTask*/

?>