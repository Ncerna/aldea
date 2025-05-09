<?php
require_once __DIR__ . '/init.php';
function getSessionUserName()
{
  return isset($_SESSION['S_ROL']) ? trim($_SESSION['S_ROL']) : '';
}
$userName = getSessionUserName();
$isAdmin = (strtoupper($userName) === 'ADMINISTRADOR');
try {
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

    $response = $eventService->listEvents($userId,$isAdmin, $page, $limit);
    echo json_encode($response);
  }
} catch (Exception $e) {
  echo json_encode(["status"=> false,"msg" => $e->getMessage()]);
}
