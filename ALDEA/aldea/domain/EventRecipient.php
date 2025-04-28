<?php

class EventRecipient
{
    private  $id ;
    private  $event_id;
    private  $recipient_type; // 'individual', 'grade', 'role', 'public'
    private  $recipient_id = null; // NULL para 'public'
    private  $status = 1; // 1=Activo, 0=Eliminado
    private  $is_read = 0; // 0=No leído, 1=Leído
    private  $is_favorite = 0; // 0=No favorito, 1=Favorito
    private  $created_at = null;
    private  $updated_at = null;
    

    // Getters y Setters

    public function getId()
    {
        return $this->id;
    }
    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function getEventId(): int
    {
        return $this->event_id;
    }
    public function setEventId(int $event_id): void
    {
        $this->event_id = $event_id;
    }

  
    public function getRecipientType(): ?string {
        return $this->recipient_type;
    }
    public function setRecipientType(string $recipient_type): void
    {
        $allowedTypes = ['individual', 'grade', 'role', 'public'];
        if (!in_array($recipient_type, $allowedTypes)) {
            throw new InvalidArgumentException("Tipo de destinatario inválido");
        }
        $this->recipient_type = $recipient_type;
    }

    public function getRecipientId()
    {
        return $this->recipient_id;
    }
    public function setRecipientId(?int $recipient_id)
    {
        $this->recipient_id = $recipient_id;
    }

    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function getIsRead()
    {
        return $this->is_read;
    }
    public function setIsRead(int $is_read)
    {
        $this->is_read = $is_read;
    }

    public function getIsFavorite()
    {
        return $this->is_favorite;
    }
    public function setIsFavorite(int $is_favorite)
    {
        $this->is_favorite = $is_favorite;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function setCreatedAt(?string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    public function setUpdatedAt(?string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    // Convierte el objeto a array
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    // Crea una instancia desde un array
    public static function fromArray(array $data): self
    {
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
    
        if (!is_array($recipientIds)) {
            throw new Exception("Formato JSON inválido");
        }
    
        foreach ($recipientIds as $item) {
            if (!isset($item['recipient_type'], $item['recipient_id'])) { // 👈 Validación crítica
                throw new Exception("El item no contiene recipient_type o recipient_id");
            }
    
            $recipient = new self();
            $recipient->setId($item['id'] ?? null);
            $recipient->setRecipientType($item['recipient_type']);
            $recipient->setRecipientId($item['recipient_id']);
            $recipients[] = $recipient;
        }
    
        return $recipients;
    }
    

    
}
