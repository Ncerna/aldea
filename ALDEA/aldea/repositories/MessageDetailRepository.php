<?php

class MessageDetailRepository extends BaseRepository {
    protected function getTableName(): string {
        return "message_details";
    }

    public function markAsRead(int $messageId): array {
        $query = "UPDATE " . $this->getTableName() . " SET is_read = 1 WHERE message_id = ?";
        $stmt = $this->executeQuery($query, [$messageId]);
        return ApiResponse::successResult($stmt->affected_rows);
    }

    public function markAsDeleted(int $messageId): array {
        $query = "UPDATE " . $this->getTableName() . " SET deleted = 1 WHERE message_id = ?";
        $stmt = $this->executeQuery($query, [$messageId]);
        return ApiResponse::successResult($stmt->affected_rows);
    }

    public function getByMessageId(int $messageId): array {
        $query = "SELECT * FROM " . $this->getTableName() . " WHERE message_id = ?";
        $stmt = $this->executeQuery($query, [$messageId]);
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            return ApiResponse::errorResult('Detalle del mensaje no encontrado');
        }
        $data = $result->fetch_assoc();
        return ApiResponse::successResult(1, $data);
    }

    public function save(MessageDetail $messageDetail): array {
        $columns = array_filter($this->getTableColumns(), function ($column) {
            return !in_array($column, ['id', 'created_at', 'updated_at']);
        });
        $query = "INSERT INTO " . $this->getTableName() . " (" . implode(", ", $columns) . ") VALUES (" . str_repeat("?, ", count($columns) - 1) . "?)";
        $params = [];
        $data = $messageDetail->toArray();
        foreach ($columns as $column) {
            $params[] = $data[$column] ?? null;
        }
        $stmt = $this->executeQuery($query, $params);
        return ApiResponse::successResult($stmt->affected_rows, [], $stmt->insert_id);
    }

  
   
}
