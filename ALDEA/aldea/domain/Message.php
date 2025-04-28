<?php
class Message {
    private  $id;
    private  $sender_id;
    private  $recipient_id = null;
    private  $subject = '';
    private  $content = '';
    private  $is_approved = 0;
    private  $status = 1;
    private  $send_type = 1;
    private  $parent_message_id = null;
    private  $parent_comment_id = null;
    private  $approver_id = null;
    private  $likes_count = 0;
    private  $created_at;
    private  $updated_at;

    // Getters y Setters

    public function getId() {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getSenderId(): int {
        return $this->sender_id;
    }

    public function setSenderId(int $sender_id): void {
        $this->sender_id = $sender_id;
    }

    public function getRecipientId(): ?int {
        return $this->recipient_id;
    }

    public function setRecipientId(?int $recipient_id): void {
        $this->recipient_id = $recipient_id;
    }

    public function getSubject(): string {
        return $this->subject;
    }

    public function setSubject(string $subject): void {
        $this->subject = $subject;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function getIsApproved(): int {
        return $this->is_approved;
    }

    public function setIsApproved(int $is_approved): void {
        $this->is_approved = $is_approved;
    }

    public function getStatus(): int {
        return $this->status;
    }

    public function setStatus(int $status): void {
        $this->status = $status;
    }

    public function getSendType(): int {
        return $this->send_type;
    }

    public function setSendType(int $send_type): void {
        $this->send_type = $send_type;
    }

    public function getParentMessageId(): ?int {
        return $this->parent_message_id;
    }

    public function setParentMessageId(?int $parent_message_id): void {
        $this->parent_message_id = $parent_message_id;
    }

    public function getParentCommentId(): ?int {
        return $this->parent_comment_id;
    }

    public function setParentCommentId(?int $parent_comment_id): void {
        $this->parent_comment_id = $parent_comment_id;
    }

    public function getApproverId(): ?int {
        return $this->approver_id;
    }

    public function setApproverId(?int $approver_id): void {
        $this->approver_id = $approver_id;
    }

    public function getLikesCount(): int {
        return $this->likes_count;
    }

    public function setLikesCount(int $likes_count): void {
        $this->likes_count = $likes_count;
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

    public function validate() {
        if (empty($this->senderId)) {
            throw new Exception('El campo senderId es obligatorio.');
        }
 }
 function isMultipleMessage(Message $message): bool {
    return $message->getSendType() == 2;
}

}


