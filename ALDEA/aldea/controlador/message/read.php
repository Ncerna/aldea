<?php 
require_once __DIR__ . '/init.php';
try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $messageId = $_GET['id'];

    $result = $messageService->getMessagesWithSenderAndRecipient($messageId);
    echo json_encode($result);
    }
} catch (Exception $e) {
  
    echo json_encode(["msg" => $e->getMessage()]);
}


 ?>

