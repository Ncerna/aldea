<?php
require_once 'BaseRepository.php';

class EventRecipientRepository extends BaseRepository {
    protected function getTableName(): string {
        return 'event_recipients';
    }

    public function softDeleteByEventId(int $eventId): void {
        $query = "UPDATE " . $this->getTableName() . " SET status = 0 WHERE event_id = ?";
        $this->executeQuery($query, [$eventId]);
    }

    public function save(EventRecipient $recipient): array {
        if (empty($recipient->getId())) {
            return $this->insert($recipient);
        } else {
            return $this->update($recipient);
        }
    }

    private function insert(EventRecipient $recipient): array {
        $columns = $this->getFilteredColumns();
        $query = $this->buildInsertQuery($columns, $this->getTableName());
        $params = $this->getParamsFromData($recipient->toArray(), $columns);

        try {
            $stmt = $this->executeQuery($query, $params);
            return ApiResponse::successResult($stmt->affected_rows, [], $stmt->insert_id);
        } catch (Exception $e) {
            throw new Exception("Error al insertar destinatario: " . $e->getMessage());
        }
    }

    private function update(EventRecipient $recipient): array {
        $columns = $this->getFilteredColumns();
        $query = $this->buildUpdateQuery($columns, $this->getTableName());
        $params = array_merge($this->getParamsFromData($recipient->toArray(), $columns), [$recipient->getId()]);

        try {
            $stmt = $this->executeQuery($query, $params);
            return ApiResponse::successResult($stmt->affected_rows, [], $recipient->getId());
        } catch (Exception $e) {
            throw new Exception("Error al actualizar destinatario: " . $e->getMessage());
        }
    }

    public function markAsRead(int $eventRecipientId, bool $isRead = true): bool {
        $value = $isRead ? 1 : 0;
        $query = "UPDATE " . $this->getTableName() . " SET is_read = ? WHERE id = ?";
        $stmt = $this->executeQuery($query, [$value, $eventRecipientId]);
        return $stmt->affected_rows > 0;
    }


    public function markAsFavorite(int $eventRecipientId, bool $isFavorite = true): bool {
        $value = $isFavorite ? 1 : 0;
        $query = "UPDATE " . $this->getTableName() . " SET is_favorite = ? WHERE id = ?";
        $stmt = $this->executeQuery($query, [$value, $eventRecipientId]);
        return $stmt->affected_rows > 0;
    }

    public function getStatus(int $eventRecipientId): ?array {
        $query = "SELECT is_read, is_favorite FROM " . $this->getTableName() . " WHERE id = ?";
        $stmt = $this->executeQuery($query, [$eventRecipientId]);
        $result = $stmt->get_result()->fetch_assoc();
        return $result ?: null;
    }

    public function getRecipientsByEventId(int $eventId): array {
        $query = "SELECT id, recipient_type, recipient_id, status FROM event_recipients WHERE event_id = ? AND status = 1";

        $stmt = $this->executeQuery($query, [$eventId]);
        $result = $stmt->get_result();
        $attachments = [];
        while ($row = $result->fetch_assoc()) {
            $attachments[] = EventRecipient::fromArray($row)->toArray();
            
        }
        return $attachments;
    }

    /*public function getRecipientsByEventId(int $eventId): array {
        $query = "SELECT id, recipient_type, recipient_id, status FROM event_recipients WHERE event_id = ? AND status = 1";
    
        $stmt = $this->executeQuery($query, [$eventId]);
        $result = $stmt->get_result();
        $recipients = [];
    
        while ($row = $result->fetch_assoc()) {
            $recipients[] = EventRecipient::fromArray($row); // <-- devuelve objetos
        }
    
        return $recipients;
    }*/

    public function deleteRecipientsByIds(int $eventId, array $recipientIds): void {
        if (empty($recipientIds))  return;
        $placeholders = implode(',', array_fill(0, count($recipientIds), '?'));
        $query = "DELETE FROM ". $this->getTableName(). " WHERE event_id = ? AND id IN ($placeholders)";
        $params = array_merge([$eventId], $recipientIds);
        $this->executeQuery($query, $params);
    }
    
    public function softDelete(int $id,int $eventId): void {
        $table = $this->getTableName();
        $query = "UPDATE $table SET status = -1 WHERE id= ? AND event_id = ?";
        $this->executeQuery($query,[$id,$eventId]);
    }

    public function clearRecipientsForPublic(int $eventId): void {
        $query = "UPDATE event_recipients SET recipient_id = NULL WHERE event_id = ?";
        $this->executeQuery($query, [$eventId]); 
    }
    
    public function deleteByEventId(int $eventId): void {
        $query = "DELETE FROM event_recipients WHERE event_id = ?";
        $this->executeQuery($query, [$eventId]); 
    }
   
    public function getRecipientsByEventAndType(int $eventId, string $recipientType): array {
        $query = "SELECT id, recipient_type, recipient_id, status 
                  FROM " . $this->getTableName() . " 
                  WHERE event_id = ? 
                  AND recipient_type = ?
                  AND status = 1"; 
    
        $stmt = $this->executeQuery($query, [$eventId, $recipientType]);
        $result = $stmt->get_result();
        
        $recipients = [];
        while ($row = $result->fetch_assoc()) {
            $recipients[] = EventRecipient::fromArray($row);
        }
        return $recipients;
    }
    
    

}
