<?php
  require_once __DIR__ . '/init.php';
    try {
      if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $eventId = intval($_GET['id'] ?? 0);
        
          $response = $eventService->getById($eventId);
          echo json_encode($response);
    
        }
    
    } catch (Exception $e) {
        echo json_encode(["msg" => $e->getMessage()]);
    }
?>