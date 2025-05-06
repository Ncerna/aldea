<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['S_NOMBRE']) || empty($_SESSION['S_NOMBRE'])) {
    http_response_code(401);
    echo json_encode(['status' => false, 'msg' => 'Acceso no autorizado. Por favor, inicie sesión.']);
    exit;
}
require_once __DIR__ . '/../../services/MessageService.php';
require_once __DIR__ . '/../../services/AttachmentService.php';
require_once __DIR__ . '/../../services/MessageRecipientService.php';
require_once __DIR__ . '/../../repositories/AttachmentRepository.php';
require_once __DIR__ . '/../../repositories/MessageRepository.php';
require_once __DIR__ . '/../../repositories/MessageRecipientRepository.php';
require_once __DIR__ . '/../../domain/Message.php';
require_once __DIR__ . '/../../domain/MessageRecipient.php';
require_once __DIR__ . '/../../domain/Strategy/DirectoryStrategy.php';
$messageService = new MessageService(
    new MessageRepository(),
    new AttachmentService(new AttachmentRepository(), new DirectoryStrategy()),
    new MessageRecipientService(new MessageRecipientRepository())
);
