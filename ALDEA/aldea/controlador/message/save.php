<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../../services/MessageService.php';
require_once __DIR__ . '/../../repositories/AttachmentRepository.php';
require_once __DIR__ . '/../../repositories/MessageRepository.php';
require_once __DIR__ . '/../../repositories/MessageRecipientRepository.php';
require_once __DIR__ . '/../../domain/Message.php';
require_once __DIR__ . '/../../domain/MessageRecipient.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido');
    }

    $messageService = new MessageService( new MessageRepository(),
        new AttachmentService(new AttachmentRepository(), new DirectoryStrategy()),
        new MessageRecipientService(new MessageRecipientRepository())
    );

    $rawData = $_POST;
    $files = $_FILES;
    $message = Message::fromArray($rawData);
    $recipients = [];
    if (isset($rawData['recipient_ids'])) {
        $recipients = MessageRecipient::getRecipientIds($rawData['recipient_ids']);
    }
    $deletedAttachmentIds = isset($_POST['deleted_files']) 
    ? json_decode($_POST['deleted_files'], true)
    : [];

   /* $deletedAttachments = array_map(function($fileData) {
        return Attachment::fromArray($fileData);
    }, json_decode($_POST['deleted_files'], true));
    */

    $saved = $messageService->save($message, $files, $recipients,$deletedAttachmentIds);
    echo json_encode($saved);

} catch (Exception $e) {
    echo json_encode(["msg" => $e->getMessage()]);
}
?>

