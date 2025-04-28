<?php
require_once __DIR__ . '/../utils/ApiResponse.php';
class MessageRecipientService {
    private MessageRecipientRepository $repository;

    public function __construct(MessageRecipientRepository $repository) {
        $this->repository = $repository;
    }

    public function save(MessageRecipient $recipient): array {
        return $this->repository->save($recipient);
    }
 
  public function getRecipientsByMessageId($messageId): array {
    return $this->repository->getRecipientsByMessageId($messageId);
}

public function getByMessageId(int $messageId): array {
    return $this->repository->getByMessageId($messageId);
}
public function syncRecipients(int $messageId, array $newRecipients): void {
    try {
    // 1. Obtener destinatarios actuales en la base de datos
    $currentRecipients = $this->repository->getByMessageId($messageId);
    $currentUserIds = array_map(fn($r) => $r->getUserId(), $currentRecipients);
    $newUserIds = array_map(fn($r) => $r->getUserId(), $newRecipients);

    // 2. Determinar cuáles eliminar
    $toDelete = array_diff($currentUserIds, $newUserIds);
    foreach ($toDelete as $userId) {
        $this->repository->deleteByMessageAndUser($messageId, $userId);
    }

    // 3. Determinar cuáles agregar
    $toAdd = array_diff($newUserIds, $currentUserIds);
    foreach ($newRecipients as $recipient) {
        if (in_array($recipient->getUserId(), $toAdd)) {
            $recipient->setMessageId($messageId);
            $this->save($recipient); // ya existente en tu flujo
        }
    }
    
    } catch (Exception $e) {
        throw new Exception("Error al sincronizar destinatarios: {$e->getMessage()}", 0, $e);
 }
}
public function getRecipientsWithFullNames($messageId): array {
   return $this->repository->getRecipientsWithFullNames($messageId);
}
public function markAsRead(int $messageId, int $userId): array {
    try {
        return $this->repository->markAsRead($messageId, $userId);
    } catch (Exception $e) {
        throw new Exception("Error al marcar mensaje como leído: " . $e->getMessage());
    }
}

   
}
