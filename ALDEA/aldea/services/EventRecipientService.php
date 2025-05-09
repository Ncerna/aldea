<?php
require_once __DIR__ . '/../utils/ApiResponse.php';
require_once __DIR__ . '/../utils/RecipientType.php';

require_once __DIR__ . '/../domain/EventRecipient.php';
class EventRecipientService {
    private EventRecipientRepository $eventRecipientRepository;
    private const VALID_TYPES = ['public', 'grade', 'role', 'individual'];
  
    public function __construct(EventRecipientRepository $eventRecipientRepository) {
        $this->eventRecipientRepository = $eventRecipientRepository;
    }

    public function markRead(int $eventRecipientId, bool $isRead = true): bool {
        try {
            return $this->eventRecipientRepository->markAsRead($eventRecipientId, $isRead);
        } catch (Exception $e) {
            throw new Exception("Error al actualizar estado leído: " . $e->getMessage());
        }
    }

    public function markFavorite(int $eventRecipientId, bool $isFavorite = true): bool {
        try {
            return $this->eventRecipientRepository->markAsFavorite($eventRecipientId, $isFavorite);
        } catch (Exception $e) {
            throw new Exception("Error al actualizar estado favorito: " . $e->getMessage());
        }
    }

    public function getStatus(int $eventRecipientId): ?array {
        try {
            return $this->eventRecipientRepository->getStatus($eventRecipientId);
        } catch (Exception $e) {
            throw new Exception("Error al obtener estado: " . $e->getMessage());
        }
    }
    private function validateRecipients(array $recipients): void {
        foreach ($recipients as $recipient) {
            $type = strtolower($recipient->getRecipientType());
            if (!in_array($type, self::VALID_TYPES, true)) {
                throw new Exception("Tipo de destinatario inválido: " . $type);
            }
        }
    }
  function createEventRecipient($event_id) :EventRecipient {
    $eventRecipient = new EventRecipient();
    $eventRecipient->setStatus(1);
    $eventRecipient->setEventId($event_id);
    $eventRecipient->setRecipientType('public');
    $eventRecipient->setRecipientId(null);
    $eventRecipient->setIsRead(0);  
    $eventRecipient->setIsFavorite(0); 
    return $eventRecipient;
}

    public function save(EventRecipient $recipient): array {
        try {
            return $this->eventRecipientRepository->save($recipient);
        } catch (Exception $e) {
            throw new Exception("Error al guardar destinatario: " . $e->getMessage());
        }
    }

    public function getRecipientsByEventId(int $eventId): array {
        try {
            return $this->eventRecipientRepository->getRecipientsByEventId($eventId);
        } catch (Exception $e) {
            throw new Exception("Error al guardar destinatario: " . $e->getMessage());
        }
        
    }
    public function syncRecipients(int $eventId, array $newRecipients,string $recipientType): void {
        try {
             $this->validateRecipientType(strtolower($recipientType));
             if ($recipientType === RecipientTypes::PUBLIC) {
                $this->handlePublicRecipients($eventId ,$newRecipients);
            } else {
                $this->syncSpecificRecipients($eventId, $newRecipients);
            }
        } catch (Exception $e) {
            throw new Exception("Error al sincronizar destinatarios: " . $e->getMessage());
        }
    }
    private function validateRecipientType(string $type): void {
        if (!in_array($type, self::VALID_TYPES, true)) {
            throw new Exception("Tipo de destinatario inválido: " . $type);
        }
    }

    private function handlePublicRecipients(int $eventId , array $recipients): void {
        try {
            $idsToDelete = $this->extractRecipientIds($recipients);
            $this->eventRecipientRepository->deleteRecipientsByIds($eventId ,$idsToDelete);
        } catch (Exception $e) {
            throw new Exception("Error al eliminar destinatarios públicos: " . $e->getMessage());
        }

    }
    private function extractRecipientIds(array $recipients): array {
        $ids = [];
        foreach ($recipients as $recipient) {
            $id = $recipient->getId();
            if ($id !== null) {
                $ids[] = (int)$id;
            }
        }
        return $ids;
    }
    

    private function syncSpecificRecipients(int $eventId, array $newRecipients): void {
        $currentRecipientsData = $this->eventRecipientRepository->getRecipientsByEventId($eventId);
        $currentRecipients = array_map(fn($r) => EventRecipient::fromArray($r), $currentRecipientsData);
        $createKey = fn(EventRecipient $r) => $r->getRecipientType() . ':' . $r->getRecipientId();
        $currentKeys = array_map($createKey, $currentRecipients);
        $newKeys = array_map($createKey, $newRecipients);
        $toDeleteKeys = array_diff($currentKeys, $newKeys);
        $toAddKeys = array_diff($newKeys, $currentKeys);
        foreach ($currentRecipients as $recipient) {
            if (in_array($createKey($recipient), $toDeleteKeys, true)) {
                $this->eventRecipientRepository->softDelete($recipient->getId(),$eventId);
            }
        }
        foreach ($newRecipients as $recipient) {
            if (in_array($createKey($recipient), $toAddKeys, true)) {
                $recipient->setEventId($eventId);
                $recipient->setStatus(1);
                $this->eventRecipientRepository->save($recipient);
            }
        }
    }
    
    
  
    
}
