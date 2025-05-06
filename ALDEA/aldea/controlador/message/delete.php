<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../services/MessageService.php';
require_once __DIR__ . '/../../repositories/MessageRepository.php';
require_once __DIR__ . '/../../services/AttachmentService.php';
require_once __DIR__ . '/../../services/MessageRecipientService.php';
require_once __DIR__ . '/../../repositories/AttachmentRepository.php';
require_once __DIR__ . '/../../repositories/MessageRecipientRepository.php';
require_once __DIR__ . '/../../domain/Strategy/DirectoryStrategy.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true); 

    if (!is_array($data)) {
        http_response_code(400);
        echo json_encode(["msg" => "Formato inválido"]);
        exit;
    }

    try {
        $messageService = new MessageService(
            new MessageRepository(),
            new AttachmentService(
                new AttachmentRepository(),
                new DirectoryStrategy()
            ),
            new MessageRecipientService(
                new MessageRecipientRepository(),
                new AttachmentService(
                    new AttachmentRepository(),
                    new DirectoryStrategy()
                )
            )
        );

        $result = $messageService->deleteMessagesByIds($data); // Asumiendo que existe este método
        echo json_encode($result);

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}

