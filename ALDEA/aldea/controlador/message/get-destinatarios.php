<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../services/UserService.php';
require_once __DIR__ . '/../../repositories/UserRepository.php';
try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Método no permitido');
    }
    $userService = new UserService(new UserRepository());
    $response = $userService->handleGetAllUsersRequest();

    echo json_encode($response);

} catch (Exception $e) {
    echo json_encode([
        "status" => false,
        "msg" => $e->getMessage()
    ]);
}
