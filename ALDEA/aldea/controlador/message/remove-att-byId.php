<?php 

header('Content-Type: application/json');
require_once __DIR__ . '/../../domain/Strategy/DirectoryStrategy.php';
require_once __DIR__ . '/../../services/AttachmentService.php';
require_once __DIR__ . '/../../repositories/AttachmentRepository.php';
require_once __DIR__ . '/../../domain/Attachment.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $attachmentId = $_GET['id'];
    $attachmentService = new AttachmentService( new AttachmentRepository(),  new DirectoryStrategy());
    try {
       $response= $attachmentService->deleteAttachmentById($attachmentId);
        echo json_encode($response);
    } catch (Exception $e) {
        echo json_encode(['msg' => $e->getMessage()]);
    }
}



 ?>