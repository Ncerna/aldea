<?php
// Asegúrate de que tu archivo maneje el contenido como JSON
header('Content-Type: application/json');
require '../../modelo/modelo_notas.php';
    $MU = new Nota();
// Captura los parámetros de la URL
$yearId = isset($_GET['idyear']) ? $_GET['idyear'] : 1;

// Aquí puedes llamar a tu función getPendingOrFailedCourses
$result = $MU->Listar_Notas_Periodo($yearId);

// Envía la respuesta JSON de vuelta al cliente
echo json_encode($result);
?>