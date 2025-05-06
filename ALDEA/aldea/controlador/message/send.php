<?php
require_once __DIR__ . '/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    if ($userId === null) {
        http_response_code(400);
        echo json_encode(['error' => 'user_id is required']);
        exit;
    }
    try {
        $response = $messageService->getSentMessages($userId, $page, $limit);
        echo json_encode($response);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([ 'status' => false,'msg' => $e->getMessage()]);
    }
}
