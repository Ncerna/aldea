<?php
require_once __DIR__ . '/BaseRepository.php';

class AttachmentRepository extends BaseRepository {
    protected function getTableName(): string {
        return "attachments";
    }

    public function save(Attachment $attachment): array {
        if (empty($attachment->getId())) {
            return $this->insert($attachment);
        } else {
            return $this->update($attachment);
        }
    }

    private function insert(Attachment $attachment): array {
        $columns = $this->getFilteredColumns();
        $query = $this->buildInsertQuery($columns, $this->getTableName());
        $params = $this->getParamsFromData($attachment->toArray(), $columns);
        
        try {
            $stmt = $this->executeQuery($query, $params);
            return ApiResponse::successResult($stmt->affected_rows, [], $stmt->insert_id);
        } catch (Exception $e) {
            throw new Exception("Error al guardar el adjunto: " . $e->getMessage());
        }
    }

    private function update(Attachment $attachment): array {
        $columns = $this->getFilteredColumns();
        $query = $this->buildUpdateQuery($columns, $this->getTableName());
        $params = array_merge($this->getParamsFromData($attachment->toArray(), $columns), [$attachment->getId()]);
        
        try {
            $stmt = $this->executeQuery($query, $params);
            return ApiResponse::successResult($stmt->affected_rows);
        } catch (Exception $e) {
            throw new Exception("Error al actualizar el adjunto: " . $e->getMessage());
        }
    }
    public function getAttachmentsByMessageId($messageId): array {
    $query = "SELECT * FROM " . $this->getTableName() . " WHERE message_id = ? AND status NOT IN (0, -1) ";
    $stmt = $this->executeQuery($query, [$messageId]);
    $result = $stmt->get_result();
    $attachments = [];
    while ($row = $result->fetch_assoc()) {
        $attachments[] = Attachment::fromArray($row)->toArray();
    }
    return $attachments;
}


public function getAttachmentsByEventId(int $eventId): array {
    $query = "SELECT * FROM attachments WHERE event_id = ? AND status = 1 ";
    $stmt = $this->executeQuery($query, [$eventId]);
    $result = $stmt->get_result();
    $attachments = [];
    while ($row = $result->fetch_assoc()) {
        $attachments[] = Attachment::fromArray($row)->toArray();
    }
    return $attachments;
}

public function getByMessageId(int $messageId): array {
        try {
            $query = "SELECT mr.*, u.usu_nombre as recipient_name 
                      FROM message_recipients mr
                      JOIN usuarios u ON mr.user_id = u.usu_id
                      WHERE mr.message_id = ? AND mr.status = 1 ";
            $stmt = $this->executeQuery($query, [$messageId]);
            $result = $stmt->get_result();
            $recipients = [];
            while ($row = $result->fetch_assoc()) {
                $recipients[] = MessageRecipient::fromArray($row);
            }
            return $recipients;
        } catch (Exception $e) {
            throw new Exception("Error al obtener destinatarios: " . $e->getMessage());
        }
    }

    public function findById(int $id): ?Attachment {
        $attachment = $this->getById($id, Attachment::class);
        if (!$attachment) {
            return null; 
        }
        return $attachment; 
    }

    public function findAllByMessageId(int $messageId): array {
        $table = $this->getTableName();
        $query = "SELECT * FROM $table WHERE message_id = ? AND status NOT IN (0, -1)";
        $stmt = $this->conexion->prepare($query);
        if (!$stmt)  throw new Exception("Error preparing query: " . $this->conexion->error);
        $stmt->bind_param('i', $messageId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $attachments = [];
        while ($row = $result->fetch_assoc()) {
            $attachments[] = Attachment::fromArray($row);
        }
    
        return $attachments;
    }
    
    public function softDelete(int $id): void {
        $table = $this->getTableName();
        $query = "UPDATE $table SET status = -1 WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        if (!$stmt)  throw new Exception("Error preparing query: " . $this->conexion->error);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public function findFirstActiveByEventId(int $eventId): ?Attachment {
        $query = "SELECT * FROM " . $this->getTableName() . " WHERE event_id = ? AND status = 1 ORDER BY id ASC LIMIT 1";
    
        // Usamos executeQuery que asumo prepara, bind y ejecuta la consulta
        $stmt = $this->executeQuery($query, [$eventId]);
    
        $result = $stmt->get_result();
    
        $attachment = null;
    
        if ($row = $result->fetch_assoc()) {
            $attachment = Attachment::fromArray($row);
        }
    
        $stmt->close();
    
        return $attachment;
    }
    
    
    
}


    

