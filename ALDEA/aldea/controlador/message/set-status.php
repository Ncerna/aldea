<?php 
header('Content-Type: application/json');
require_once __DIR__ . '/../../services/MessageService.php';
require_once __DIR__ . '/../../repositories/AttachmentRepository.php';
require_once __DIR__ . '/../../repositories/MessageRepository.php';
require_once __DIR__ . '/../../repositories/MessageRecipientRepository.php';
require_once __DIR__ . '/../../domain/Message.php';
require_once __DIR__ . '/../../domain/MessageRecipient.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   $messageId = isset($_GET['messageId']) ? (int)$_GET['messageId'] : null;
   $isApproved = isset($_GET['isApproved']) ? (int)$_GET['isApproved'] : null;

    $messageService = new MessageService(
        new MessageRepository(),
        new AttachmentService(new AttachmentRepository(), new DirectoryStrategy()),
        new MessageRecipientService(new MessageRecipientRepository())
    );
    try {
       $response= $messageService->handleMessageApproval($messageId,$isApproved );
        echo json_encode($response);
    } catch (Exception $e) {
        echo json_encode(['msg' => $e->getMessage()]);
    }
}


 ?>