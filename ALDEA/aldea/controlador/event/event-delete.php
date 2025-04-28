<?php
require_once __DIR__ . '/init.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $eventId = intval($_GET['id'] ?? 0);
        $result = $eventService->deleteEvent($eventId);
        echo json_encode($result);
    } else {
        echo json_encode(['status' => false, 'msg' => 'Método no permitido']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => false, 'msg' => 'Error: ' . $e->getMessage()]);
}
