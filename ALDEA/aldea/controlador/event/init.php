<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['S_NOMBRE']) || empty($_SESSION['S_NOMBRE'])) {
    http_response_code(401); // No autorizado
    echo json_encode(['status' => false, 'msg' => 'Acceso no autorizado. Por favor, inicie sesión.']);
    exit; 
}

require_once __DIR__ . '/../../services/EventService.php';
require_once __DIR__ . '/../../repositories/EventRepository.php';
require_once __DIR__ . '/../../services/EventRecipientService.php';
require_once __DIR__ . '/../../repositories/EventRecipientRepository.php';
require_once __DIR__ . '/../../services/AttachmentService.php';
require_once __DIR__ . '/../../repositories/AttachmentRepository.php';
require_once __DIR__ . '/../../domain/Strategy/DirectoryStrategy.php';
require_once __DIR__ . '/../../domain/Event.php';

// Instancia de servicios
$eventService = new EventService(
    new EventRepository(),
    new EventRecipientService(new EventRecipientRepository()),
    new AttachmentService(new AttachmentRepository(), new DirectoryStrategy())
);
