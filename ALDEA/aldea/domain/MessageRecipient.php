<?php 
class MessageRecipient {
    private  $id;
    private  $message_id;
    private  $user_id;
    private  $status =1;
    private  $is_read =0;
    private  $is_favorite =0;
    private  $created_at;
    private  $updated_at;


    // Getters y Setters

    public function getId() {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getMessageId(): int {
        return $this->message_id;
    }

    public function setMessageId(int $message_id): void {
        $this->message_id = $message_id;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void {
        $this->user_id = $user_id;
    }

    public function getStatus(): int {
        return $this->status;
    }

    public function setStatus(int $status): void {
        $this->status = $status;
    }

    public function getIsRead(): int {
        return $this->is_read;
    }

    public function setIsRead(int $is_read): void {
        $this->is_read = $is_read;
    }

    public function getIsFavorite(): int {
        return $this->is_favorite;
    }

    public function setIsFavorite(int $is_favorite): void {
        $this->is_favorite = $is_favorite;
    }

    public function getCreatedAt(): string {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): string {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): void {
        $this->updated_at = $updated_at;
    }
    
    public function toArray(): array {
        return get_object_vars($this);
    }

    public static function fromArray(array $data): self {
        $instance = new self();
        $combinedData = array_merge($data);
        foreach ($combinedData as $key => $value) {
            if (property_exists($instance, $key)) {
                $instance->$key = $value;
            }
        }
        return $instance;
    }
 
    public static function getRecipientIds($recipientIds): array {
        $recipients = [];
        $recipientIds = json_decode($recipientIds, true);
        if (is_array($recipientIds)) {
            foreach ($recipientIds as $recipientId) {
                $recipient = new self();
                $recipient->setUserId($recipientId);
                $recipients[] = $recipient;
            }
        } else {
            throw new Exception("recipient_ids no es un formato válido.");
        }

        return $recipients;
    }
}

