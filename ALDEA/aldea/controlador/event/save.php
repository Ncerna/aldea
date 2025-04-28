<?php
require_once __DIR__ . '/init.php';

    try {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST')   throw new Exception('Método no permitido');
            
        $rawData = $_POST;
        $files = $_FILES;
        $event = Event::fromArray($rawData);
        $existingFiles = json_decode($rawData['existing_files'] ?? '[]', true);
    
        $newFilesMeta = [];
        foreach ($_POST['new_files_meta'] ?? [] as $meta) {
            $newFilesMeta[] = json_decode($meta, true);
        }
        $recipients = [];

        if (isset($rawData['recipient_ids'])) {
            $recipients = EventRecipient::getRecipientIds($rawData['recipient_ids']);
        }
        $saved = $eventService->save($event, $files, $recipients,$existingFiles ,$newFilesMeta);
        echo json_encode($saved);
    
    } catch (Exception $e) {
        echo json_encode(["msg" => $e->getMessage()]);
    }
