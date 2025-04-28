<?php
require_once 'BaseRepository.php';

class EventRepository extends BaseRepository {

    protected function getTableName(): string {
        return 'events';
    }

    
    public function listEvents(int $page = 1, int $size = 10): array {
        $table = $this->getTableName();
        $offset = ($page - 1) * $size;
        $query = "SELECT e.*, u.usu_nombre AS organizer_name FROM $table e
        LEFT JOIN usuarios u ON e.organizer_id = u.usu_id WHERE e.status = 1
        ORDER BY e.created_at DESC LIMIT ? OFFSET ?";
    
        $stmt = $this->executeQuery($query, [$size, $offset]);
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc())  $items[] = $row;
        $countQuery = "SELECT COUNT(*) as total FROM $table WHERE status = 1";
        $countResult = $this->conexion->query($countQuery);
        $total = $countResult->fetch_assoc()['total'];
        return [
            'list' => $items,
        'page' => (int)$page,
        'size' => (int)$size,
        'total' => (int)$total, // Convertir a entero
        'total_pages' => (int)ceil($total / $size)
        ];
    }

    public function getAttachmentsByEventId(int $eventId): array {
        $query = "SELECT * FROM event_attachments WHERE event_id = ? AND status = 1";
        $stmt = $this->executeQuery($query, [$eventId]);
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc())  $items[] = $row;
        return $items ;
    }

    public function saveEvent(Event $event): array {
        if (empty($event->getId())) {
            return $this->insert($event);
        } else {
            return $this->update($event);
        }
    }

    private function insert(Event $event): array {
        $columns = $this->getFilteredColumns();
        $query = $this->buildInsertQuery($columns, $this->getTableName());
        $params = $this->getParamsFromData($event->toArray(), $columns);
        
        try {
            $stmt = $this->executeQuery($query, $params);
            return ApiResponse::successResult($stmt->affected_rows, [], $stmt->insert_id);
        } catch (Exception $e) {
            throw new Exception("Error al guardar el mensaje: " . $e->getMessage());
        }
    }
    private function update(Event $event): array {
        $columns = $this->getFilteredColumns();
        $query = $this->buildUpdateQuery($columns, $this->getTableName());
        $params = array_merge($this->getParamsFromData($event->toArray(), $columns), [$event->getId()]);
        
        try {
            $stmt = $this->executeQuery($query, $params);
            return ApiResponse::successResult($stmt->affected_rows ,[],$event->getId());
        } catch (Exception $e) {
            throw new Exception("Error al actualizar el mensaje: " . $e->getMessage());
        }
    }

    public function deleteEvent(int $eventId): array {
        $query = "UPDATE " . $this->getTableName() . " SET status = 0 WHERE id = ?";
        $stmt = $this->executeQuery($query, [$eventId]);
        $this->deleteAttachmentsByEventId($eventId);
        return ApiResponse::successResult($stmt->affected_rows);
    }

    public function deleteAttachmentsByEventId(int $eventId): void {
        $query = "UPDATE attachments SET status = 0 WHERE event_id = ?";
        $this->executeQuery($query, [$eventId]);
    }

    public function approveEvent(int $eventId, int $approverId): array {
        $query = "UPDATE " . $this->getTableName() . " SET is_approved = 1, approver_id = ? WHERE id = ?";
        $stmt = $this->executeQuery($query, [$approverId, $eventId]);
        return ApiResponse::successResult($stmt->affected_rows);
    }
    public function getCurrentRecipientType(int $eventId): ?string {
        $query = "SELECT recipient_type FROM event_recipients WHERE event_id = ? AND status = 1 LIMIT 1";
        $stmt = $this->executeQuery($query, [$eventId]);
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['recipient_type'];
        }
        return null; 
    }

    public function updateEventRecipientsIfChanged(int $eventId, string $newRecipientType, array $newSelectedIds): void {
        $currentType = $this->getCurrentRecipientType($eventId);
    
        // Si no hay destinatarios previos o el tipo cambió, actualiza todo
        if ($currentType === null || $currentType !== $newRecipientType) {
            $this->updateEventRecipients($eventId, $newRecipientType, $newSelectedIds);
            return;
        }
    
        // Si el tipo es igual, verifica si cambiaron los destinatarios
        $currentRecipientIds = $this->getActiveRecipientIdsByType($eventId, $currentType);
    
        // Compara arrays (puedes ordenar para comparar)
        sort($currentRecipientIds);
        sort($newSelectedIds);
    
        if ($currentRecipientIds !== $newSelectedIds) {
            $this->updateEventRecipients($eventId, $newRecipientType, $newSelectedIds);
        }
        // Si no cambió nada, no hacer nada
    }

    public function updateEventRecipients(int $eventId, string $recipientType, array $selectedIds): void {
        // 1. Desactivar destinatarios anteriores
       // $this->deactivatePreviousRecipients($eventId);
    
        // 2. Obtener destinatarios reales según tipo y selección
       // $recipients = $this->getRecipientsByTypeAndIds($recipientType, $selectedIds);
    
        // 3. Insertar destinatarios activos
       // $this->insertRecipients($eventId, $recipientType, $recipients);
    }

    public function getActiveRecipientIdsByType(int $eventId, string $type): array {
        $query = "SELECT recipient_id FROM event_recipients WHERE event_id = ? AND recipient_type = ? AND status = 1";
        $stmt = $this->executeQuery($query, [$eventId,$type]);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $ids = [];
        while ($row = $result->fetch_assoc()) {
            $ids[] = (int)$row['recipient_id'];
        }
        return $ids;
    }
    public function approve(int $eventId): array {
        $query = "UPDATE events SET is_approved = 1 WHERE id = ?";
        $stmt = $this->executeQuery($query, [$eventId]);
        return ApiResponse::successResult($stmt->affected_rows,"Evento aprobado correctamente");
       
    }

    public function disapprove(int $eventId): array {
        $query = "UPDATE events SET is_approved = 0 WHERE id = ?";
        $stmt = $this->executeQuery($query, [$eventId]);
        return ApiResponse::successResult($stmt->affected_rows, "Evento desaprobado correctamente");
    }

    public function delete(int $eventId): array {
        $query = "DELETE FROM events WHERE id = ?";
        $stmt = $this->executeQuery($query, [$eventId]);
        return ApiResponse::successResult($stmt->affected_rows, "Evento eliminado correctamente");
    }

    public function toggleFavorite(int $eventId, int $userId): array {
       
            $deleteQuery = "DELETE FROM user_favorites WHERE event_id = ? AND user_id = ?";
            $stmt = $this->executeQuery($deleteQuery, [$eventId, $userId]);
        
            if ($stmt->affected_rows > 0) {
                return ApiResponse::successResult(1, "Removido de favoritos");
            }
        
            $insertQuery = "INSERT INTO user_favorites (event_id, user_id) VALUES (?, ?)";
            $stmt = $this->executeQuery($insertQuery, [$eventId, $userId]);
            return ApiResponse::successResult($stmt->affected_rows, "Marcado como favorito");
    
        
    }
  
    
    
    
}
