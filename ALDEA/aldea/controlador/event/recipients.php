<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../../domain/Strategy/RecipientContext.php';
require_once __DIR__ . '/../../domain/Strategy/GradeStrategy.php';
require_once __DIR__ . '/../../domain/Strategy/RoleStrategy.php';
require_once __DIR__ . '/../../domain/Strategy/UserStrategy.php';
require_once __DIR__ . '/../../repositories/GradeRepository.php';
require_once __DIR__ . '/../../repositories/RoleRepository.php';
require_once __DIR__ . '/../../repositories/UserRepository.php';

try {
    $container = [
        'grade' => fn() => new GradeStrategy(new GradeRepository()),
        'role' => fn() => new RoleStrategy(new RoleRepository()),
        'individual' => fn() => new UserStrategy(new UserRepository()),
    ];

    $type = strtolower($_GET['type'] ?? '');

    if (!isset($container[$type])) {
        http_response_code(400);
        echo json_encode(['error' => 'Tipo inválido']);
        exit;
    }

    $strategy = $container[$type]();
    $context = new RecipientContext($strategy);
    $recipients = $context->getRecipients();

    echo json_encode($recipients);
} catch (Exception $e) {
    echo json_encode([ 'status' => false,  'msg' => $e->getMessage()
    ]);
}
?>

