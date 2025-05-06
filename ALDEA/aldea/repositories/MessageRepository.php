<?php
require_once __DIR__ . '/BaseRepository.php';

class MessageRepository extends BaseRepository {
    protected function getTableName(): string {
        return "messages";
    }
        public function startTransaction(): void {
            parent::startTransaction();
        }

        public function commitTransaction(): void {
            parent::commitTransaction();
        }

        public function rollbackTransaction(): void {
            parent::rollbackTransaction();
        }
 
        public function save(Message $message): array {
            if (empty($message->getId())) {
                return $this->insert($message);
            } else {
                return $this->update($message);
            }
        }
       
    
        private function insert(Message $message): array {
            $columns = $this->getFilteredColumns();
            $query = $this->buildInsertQuery($columns, $this->getTableName());
            $params = $this->getParamsFromData($message->toArray(), $columns);
            
            try {
                $stmt = $this->executeQuery($query, $params);
                return ApiResponse::successResult($stmt->affected_rows, [], $stmt->insert_id);
            } catch (Exception $e) {
                throw new Exception("Error al guardar el mensaje: " . $e->getMessage());
            }
        }
    
        private function update(Message $message): array {
            $columns = $this->getFilteredColumns();
            $query = $this->buildUpdateQuery($columns, $this->getTableName());
            $params = array_merge($this->getParamsFromData($message->toArray(), $columns), [$message->getId()]);
            
            try {
                $stmt = $this->executeQuery($query, $params);
                return ApiResponse::successResult($stmt->affected_rows ,[],$message->getId());
            } catch (Exception $e) {
                throw new Exception("Error al actualizar el mensaje: " . $e->getMessage());
            }
        }
       
        public function deleteMessagesByIds(array $ids): array {
            try {
                $ids = implode(',', array_map('intval', $ids));
                $query = "DELETE FROM " . $this->getTableName() . " WHERE id IN ($ids)";
                $stmt = $this->executeQuery($query);
                return ApiResponse::successResult($stmt->affected_rows);
            } catch (Exception $e) {
                throw new Exception("Error eliminando mensajes: " . $e->getMessage());
            }
        }
    
        public function changeStatus(int $id, int $newStatus): array {
            $query = "UPDATE " . $this->getTableName() . " SET is_approved = ? WHERE id = ?";
            $stmt = $this->executeQuery($query, [$newStatus, $id]);
            return ApiResponse::successResult($stmt->affected_rows);
        }
    
      
    
        public function listMessagesByUser(int $userId): array {
            $query = "SELECT * FROM " . $this->getTableName() . " WHERE sender_id = ? OR recipient_id = ?";
            $stmt = $this->executeQuery($query, [$userId, $userId]);
            $result = $stmt->get_result();
            $messages = [];
            while ($row = $result->fetch_assoc()) {
                $messages[] = Message::fromArray($row);
            }
            return ApiResponse::successResult(count($messages), $messages);
        }
     
        public function findById(int $id): array {
            $message = $this->getById($id, Message::class);
            if (!$message)  return []; 
            return $message->toArray();
        }
      
        public function findByIdAndRemite($messageId): array {
            $query = "SELECT m.*, CONCAT(u.usu_nombre, ' ', u.usu_apellidos, ' (', u.usu_usuario, ')') as sender_name 
            FROM messages m
            JOIN usuarios u ON m.sender_id = u.usu_id
            WHERE m.id = ? AND m.status != 0 ";
            $stmt = $this->executeQuery($query, [$messageId]);
            $result = $stmt->get_result();
          
            $recipient= $result->fetch_assoc();
             return $recipient;
                }
        
        public function paginateWithSender(int $page = 1, int $size = 10): array {
        $table = $this->getTableName();
        $offset = ($page - 1) * $size;
        $startTime = microtime(true);
        $query = "SELECT m.*, u.usu_nombre as sender_name, r.usu_nombre as recipient_name 
                  FROM $table m
                  JOIN usuarios u ON m.sender_id = u.usu_id
                  LEFT JOIN usuarios r ON m.recipient_id = r.usu_id AND m.status = 1
                  ORDER BY m.created_at DESC LIMIT ? OFFSET ?";

        $stmt = $this->executeQuery($query, [$size, $offset]);
        $result = $stmt->get_result();

        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $countQuery = "SELECT COUNT(*) as total FROM $table";
        $countResult = $this->conexion->query($countQuery);
        $total = $countResult->fetch_assoc()['total'];

        foreach ($items as &$item) {
            $messageId = $item['id'];
            $countStmt = $this->executeQuery("SELECT COUNT(*) as total FROM attachments WHERE message_id = ?", [$messageId]);
            $countResult = $countStmt->get_result();
            $totalAttachments = $countResult->fetch_assoc()['total'];
            $item['count_attachments'] = ($totalAttachments > 0) ? 1 : 0; // 1 si tiene archivos, 0 si no
        }
         $endTime = microtime(true);
         $queryTime = $endTime - $startTime;
        return [
            'list' => $items,
            'page' => $page,
            'size' => $size,
            'total' => $total,
            'total_pages' => ceil($total / $size),
             'query_time_seconds' => round($queryTime, 3),
        ];
        }

        public function paginateReceivedMessages(int $userId, bool $userIsAdmin , int $page = 1, int $size = 10): array {
            $table = $this->getTableName();
            $offset = ($page - 1) * $size;
            $startTime = microtime(true);
            $baseQuery = "FROM $table m JOIN usuarios u_sender ON m.sender_id = u_sender.usu_id
                           LEFT JOIN usuarios u_recipient ON m.recipient_id = u_recipient.usu_id
                           JOIN message_recipients mr ON mr.message_id = m.id
                           WHERE mr.status = 1";
            $params = [];
            if (!$userIsAdmin) {
                $baseQuery .= " AND mr.user_id = ?";
                $params[] = $userId;
            }
            $query = "SELECT m.*, u_sender.usu_nombre AS sender_name,   u_recipient.usu_nombre AS recipient_name,
                             mr.is_read, mr.is_favorite  $baseQuery   ORDER BY m.created_at DESC
                      LIMIT ? OFFSET ?";
        
            $params[] = $size;
            $params[] = $offset;
            $stmt = $this->executeQuery($query, $params);
            $result = $stmt->get_result();
            $items = [];
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
            // Consulta para total de mensajes
            $countQuery = "SELECT COUNT(*) as total $baseQuery";
            $countStmt = $this->executeQuery($countQuery, $userIsAdmin ? [] : [$userId]);
            $total = $countStmt->get_result()->fetch_assoc()['total'];
            // Agregar indicador de archivos adjuntos
            foreach ($items as &$item) {
                $messageId = $item['id'];
                $countStmt = $this->executeQuery("SELECT COUNT(*) as total FROM attachments WHERE message_id = ?", [$messageId]);
                $countResult = $countStmt->get_result();
                $totalAttachments = $countResult->fetch_assoc()['total'];
                $item['count_attachments'] = ($totalAttachments > 0) ? 1 : 0;
            }
            $endTime = microtime(true);
            $queryTime = $endTime - $startTime;
            return [
                'list' => $items,
                'page' => $page,
                'size' => $size,
                'total' => $total,
                'total_pages' => ceil($total / $size),
                'query_time_seconds' => round($queryTime, 3),
            ];
        }
        
/*
        public function paginateReceivedMessages(int $userId, int $page = 1, int $size = 10): array {
            $table = $this->getTableName();
            $offset = ($page - 1) * $size;
            $startTime = microtime(true);

            $query = " SELECT m.*,   u_sender.usu_nombre AS sender_name, 
                       u_recipient.usu_nombre AS recipient_name,
                       mr.is_read,mr.is_favorite 
                FROM $table m
                JOIN usuarios u_sender ON m.sender_id = u_sender.usu_id
                LEFT JOIN usuarios u_recipient ON m.recipient_id = u_recipient.usu_id
                JOIN message_recipients mr ON mr.message_id = m.id
                WHERE mr.user_id = ? AND mr.status = 1
                ORDER BY m.created_at DESC
                LIMIT ? OFFSET ?
            ";

            $stmt = $this->executeQuery($query, [$userId, $size, $offset]);
            $result = $stmt->get_result();

            $items = [];
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }

            // Contar total mensajes recibidos para paginación
            $countQuery = " SELECT COUNT(*) as total FROM $table m
                JOIN message_recipients mr ON mr.message_id = m.id
                WHERE mr.user_id = ? AND mr.status = 1
            ";
            $countStmt = $this->executeQuery($countQuery, [$userId]);
            $total = $countStmt->get_result()->fetch_assoc()['total'];

            // Agregar indicador de archivos adjuntos
            foreach ($items as &$item) {
                $messageId = $item['id'];
                $countStmt = $this->executeQuery("SELECT COUNT(*) as total FROM attachments WHERE message_id = ?", [$messageId]);
                $countResult = $countStmt->get_result();
                $totalAttachments = $countResult->fetch_assoc()['total'];
                $item['count_attachments'] = ($totalAttachments > 0) ? 1 : 0;
            }

            $endTime = microtime(true);
            $queryTime = $endTime - $startTime;

            return [
                'list' => $items,
                'page' => $page,
                'size' => $size,
                'total' => $total,
                'total_pages' => ceil($total / $size),
                'query_time_seconds' => round($queryTime, 3),
            ];
        }

        public function paginateAllReceivedMessages(int $page = 1, int $size = 10): array {
            $table = $this->getTableName();
            $offset = ($page - 1) * $size;
            $startTime = microtime(true);
        
            $query = " SELECT m.*, 
                              u_sender.usu_nombre AS sender_name, 
                              u_recipient.usu_nombre AS recipient_name,
                              mr.is_read, mr.is_favorite 
                       FROM $table m
                       JOIN usuarios u_sender ON m.sender_id = u_sender.usu_id
                       LEFT JOIN usuarios u_recipient ON m.recipient_id = u_recipient.usu_id
                       JOIN message_recipients mr ON mr.message_id = m.id
                       WHERE mr.status = 1
                       ORDER BY m.created_at DESC
                       LIMIT ? OFFSET ?";
        
            $stmt = $this->executeQuery($query, [$size, $offset]);
            $result = $stmt->get_result();
        
            $items = [];
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        
            // Contar total mensajes para paginación
            $countQuery = " SELECT COUNT(*) as total FROM $table m
                            JOIN message_recipients mr ON mr.message_id = m.id
                            WHERE mr.status = 1";
        
            $countStmt = $this->executeQuery($countQuery, []);
            $total = $countStmt->get_result()->fetch_assoc()['total'];
        
            // Agregar indicador de archivos adjuntos
            foreach ($items as &$item) {
                $messageId = $item['id'];
                $countStmt = $this->executeQuery("SELECT COUNT(*) as total FROM attachments WHERE message_id = ?", [$messageId]);
                $countResult = $countStmt->get_result();
                $totalAttachments = $countResult->fetch_assoc()['total'];
                $item['count_attachments'] = ($totalAttachments > 0) ? 1 : 0;
            }
        
            $endTime = microtime(true);
            $queryTime = $endTime - $startTime;
        
            return [
                'list' => $items,
                'page' => $page,
                'size' => $size,
                'total' => $total,
                'total_pages' => ceil($total / $size),
                'query_time_seconds' => round($queryTime, 3),
            ];
        }
        */

        public function paginateSentMessages(int $userId, int $page = 1, int $size = 10): array {
            $table = $this->getTableName();
            $offset = ($page - 1) * $size;
            $startTime = microtime(true);

            $query = "
                SELECT m.*, 
                       u_sender.usu_nombre AS sender_name, 
                       u_recipient.usu_nombre AS recipient_name
                FROM $table m
                JOIN usuarios u_sender ON m.sender_id = u_sender.usu_id
                LEFT JOIN usuarios u_recipient ON m.recipient_id = u_recipient.usu_id
                WHERE m.sender_id = ? AND m.status = 1
                ORDER BY m.created_at DESC
                LIMIT ? OFFSET ?
            ";

            $stmt = $this->executeQuery($query, [$userId, $size, $offset]);
            $result = $stmt->get_result();

            $items = [];
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }

            // Contar total mensajes enviados para paginación
            $countQuery = "SELECT COUNT(*) as total FROM $table WHERE sender_id = ? AND status = 1";
            $countStmt = $this->executeQuery($countQuery, [$userId]);
            $total = $countStmt->get_result()->fetch_assoc()['total'];

            // Agregar indicador de archivos adjuntos
            foreach ($items as &$item) {
                $messageId = $item['id'];
                $countStmt = $this->executeQuery("SELECT COUNT(*) as total FROM attachments WHERE message_id = ? AND status = 1 ", [$messageId]);
                $countResult = $countStmt->get_result();
                $totalAttachments = $countResult->fetch_assoc()['total'];
                $item['count_attachments'] = ($totalAttachments > 0) ? 1 : 0;
            }

            $endTime = microtime(true);
            $queryTime = $endTime - $startTime;

            return [
                'list' => $items,
                'page' => $page,
                'size' => $size,
                'total' => $total,
                'total_pages' => ceil($total / $size),
                'query_time_seconds' => round($queryTime, 3),
            ];
        }


        public function deleteMessageRecipientsByMessageIds(array $ids): array {
            try {
                $ids = implode(',', array_map('intval', $ids));
                $query = "DELETE FROM message_recipients WHERE message_id IN ($ids)";
                $stmt = $this->executeQuery($query);
                return ApiResponse::successResult($stmt->affected_rows);
            } catch (Exception $e) {
                throw new Exception("Error eliminando destinatarios: " . $e->getMessage());
            }
        }
        
        public function deleteAttachmentsByMessageIds(array $ids): array {
            try {
                $ids = implode(',', array_map('intval', $ids));
                $query = "DELETE FROM attachments WHERE message_id IN ($ids)";
                $stmt = $this->executeQuery($query);
                return ApiResponse::successResult($stmt->affected_rows);
            } catch (Exception $e) {
                throw new Exception("Error eliminando adjuntos: " . $e->getMessage());
            }
        }
        public function markMessageAsFavorite(int $messageId,int $userId): array {
             $userId = $this->getCurrentUserId() ?? $userId;

            $query = "UPDATE message_recipients SET is_favorite = IF(is_favorite = 1, 0, 1) WHERE message_id = ? AND user_id = ?";
           
            $stmt = $this->executeQuery($query, [$messageId, $userId]);
            return ApiResponse::successResult($stmt->affected_rows);
        }
        private function getCurrentUserId() {
            return $_SESSION['user_id'] ?? null;
        }
        
        public function getMessagesForRecipient(int $recipientId): array {
            $query = "SELECT m.* FROM messages m JOIN message_recipients mr ON m.id = mr.message_id WHERE mr.user_id = ?";
            $stmt = $this->executeQuery($query, [$recipientId]);
            $result = $stmt->get_result();
            $items = [];
            while ($row = $result->fetch_assoc())   $items[] = $row;
           return $items;
        }
         
        public function markMessageAsRead(int $messageId, int $recipientId): array {
            $query = "UPDATE message_recipients SET is_read = 1 WHERE message_id = ? AND user_id = ?";
            $stmt = $this->executeQuery($query, [$messageId, $recipientId]);
            return ApiResponse::successResult($stmt->affected_rows);
        }
       
        public function setApprovalStatus(int $messageId, int $status): array {
            $query = "UPDATE " . $this->getTableName() . " SET is_approved = ? WHERE id = ?";
            $stmt = $this->executeQuery($query, [$status, $messageId]);
            return ApiResponse::successResult($stmt->affected_rows);
        }
        

    
}
