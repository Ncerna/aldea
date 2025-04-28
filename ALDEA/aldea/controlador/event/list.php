<?php
require_once __DIR__ . '/init.php';

    try {
      if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

          $response = $eventService->listEvents(7,$page, $limit);
          echo json_encode($response);
    
        }
    
    } catch (Exception $e) {
        echo json_encode(["msg" => $e->getMessage()]);
    }
?>