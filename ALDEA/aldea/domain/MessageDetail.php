<?php 
class MessageDetail {
    private int $id;
    private int $messageId;
    private int $recipientId;
    private int $isRead;
    private int $status;
    private ?string $readAt;
    private int $deleted;
    private int $isFavorite;
    private string $createdAt;
    private string $updatedAt;

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getMessageId(): int {
        return $this->messageId;
    }

    public function getRecipientId(): int {
        return $this->recipientId;
    }

    public function getIsRead(): int {
        return $this->isRead;
    }

    public function getStatus(): int {
        return $this->status;
    }

    public function getReadAt(): ?string {
        return $this->readAt;
    }

    public function getDeleted(): int {
        return $this->deleted;
    }

    public function getIsFavorite(): int {
        return $this->isFavorite;
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string {
        return $this->updatedAt;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setMessageId(int $messageId): void {
        $this->messageId = $messageId;
    }

    public function setRecipientId(int $recipientId): void {
        $this->recipientId = $recipientId;
    }

    public function setIsRead(int $isRead): void {
        $this->isRead = $isRead;
    }

    public function setStatus(int $status): void {
        $this->status = $status;
    }

    public function setReadAt(?string $readAt): void {
        $this->readAt = $readAt;
    }

    public function setDeleted(int $deleted): void {
        $this->deleted = $deleted;
    }

    public function setIsFavorite(int $isFavorite): void {
        $this->isFavorite = $isFavorite;
    }

    public function setCreatedAt(string $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(string $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
}
