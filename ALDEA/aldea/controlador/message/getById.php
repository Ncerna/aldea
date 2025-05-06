<?php 
header('Content-Type: application/json');
require_once __DIR__ . '/../../services/MessageService.php';
require_once __DIR__ . '/../../repositories/AttachmentRepository.php';
require_once __DIR__ . '/../../repositories/MessageRepository.php';
require_once __DIR__ . '/../../repositories/MessageRecipientRepository.php';
require_once __DIR__ . '/../../domain/Message.php';
require_once __DIR__ . '/../../domain/MessageRecipient.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $messageId = $_GET['id'];
    $messageService = new MessageService(
        new MessageRepository(),
        new AttachmentService(new AttachmentRepository(), new DirectoryStrategy()),
        new MessageRecipientService(new MessageRecipientRepository())
    );
    $messageData = $messageService->findById($messageId);
    echo json_encode($messageData);
}


 ?>