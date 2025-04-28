<?php

require_once __DIR__ . '/BaseRepository.php';
class MessageRecipientRepository extends BaseRepository {
    protected function getTableName(): string {
        return "message_recipients";
    }

    public function save(MessageRecipient $recipient): array {
        if (empty($recipient->getId())) {
            return $this->insert($recipient);
        } else {
            return $this->update($recipient);
        }
    }

    private function insert(MessageRecipient $recipient): array {
        $columns = $this->getFilteredColumns();
        $query = $this->buildInsertQuery($columns, $this->getTableName());
        $params = $this->getParamsFromData($recipient->toArray(), $columns);

        try {
            $stmt = $this->executeQuery($query, $params);
            return ApiResponse::successResult($stmt->affected_rows, [], $stmt->insert_id);
        } catch (Exception $e) {
            throw new Exception("Error al guardar el destinatario: " . $e->getMessage());
        }
    }

    private function update(MessageRecipient $recipient): array {
        $columns = $this->getFilteredColumns();
        $query = $this->buildUpdateQuery($columns, $this->getTableName());
        $params = array_merge($this->getParamsFromData($recipient->toArray(), $columns), [$recipient->getId()]);

        try {
            $stmt = $this->executeQuery($query, $params);
            return ApiResponse::successResult($stmt->affected_rows);
        } catch (Exception $e) {
            throw new Exception("Error al actualizar el destinatario: " . $e->getMessage());
        }
    }
    public function getRecipientsByMessageId($messageId): array {
        $query = "SELECT * FROM " . $this->getTableName() . " WHERE message_id = ? AND status = 1";
        $stmt = $this->executeQuery($query, [$messageId]);
        $result = $stmt->get_result();
        $recipients = [];
        while ($row = $result->fetch_assoc()) {
            $recipients[] = MessageRecipient::fromArray($row)->toArray();
        }
        return $recipients;
    }

    
    public function getByMessageId(int $messageId): array {
        try {
            $query = "SELECT mr.*, CONCAT(u.usu_nombre, ' ', u.usu_apellidos, ' (', u.usu_usuario, ')') as recipient_name 
                      FROM message_recipients mr
                      JOIN usuarios u ON mr.user_id = u.usu_id
                      WHERE mr.message_id = ? AND mr.status != 0 ";
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
    public function deleteByMessageAndUser(int $messageId, int $userId): array {
        $query = "UPDATE " . $this->getTableName() . " SET status = 0 WHERE message_id = ? AND user_id = ?";
        try {
            $stmt = $this->executeQuery($query, [$messageId, $userId]);
            return ApiResponse::successResult($stmt->affected_rows);
        } catch (Exception $e) {
            throw new Exception("Error al eliminar el destinatario: " . $e->getMessage());
        }
    }
    public function getRecipientsWithFullNames($messageId): array {
        $query = " SELECT  mr.*, CONCAT(u.usu_nombre, ' ', u.usu_apellidos, ' (', u.usu_usuario, ')') AS recipient_name
            FROM " . $this->getTableName() . " mr JOIN  usuarios u ON mr.user_id = u.usu_id
            WHERE   mr.message_id = ? AND mr.status = 1 ";
        $stmt = $this->executeQuery($query, [$messageId]);
        $result = $stmt->get_result();
        $recipients = [];
        while ($row = $result->fetch_assoc()) {
            $recipients[] = $row; 
        }
        return $recipients;
    }
    public function markAsRead(int $messageId, int $userId): array {
        $query = "UPDATE message_recipients SET is_read = 1 WHERE message_id = ? AND user_id = ?";
        $stmt = $this->executeQuery($query, [$messageId, $userId]);
        return ApiResponse::successResult($stmt->affected_rows);
    }
    

}
