<?php 
class Attachment {
    private  $id;
    private  $message_id = null;
    private $event_id = null;
    private  $file_name;
    private  $file_type;
    private  $file_path;
    private  $isFavorite =0;
    private  $status =1;
    private  $created_at;
    private  $updated_at;
    private  $tempPath;

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

    public function getFileName(): string {
        return $this->file_name;
    }

    public function setFileName(string $file_name): void {
        $this->file_name = $file_name;
    }

    public function getFileType(): string {
        return $this->file_type;
    }

    public function setFileType(string $file_type): void {
        $this->file_type = $file_type;
    }

    public function getFilePath(): string {
        return $this->file_path;
    }

    public function setFilePath(string $file_path): void {
        $this->file_path = $file_path;
    }

    public function getStatus(): int {
        return $this->status;
    }

    public function setStatus(int $status): void {
        $this->status = $status;
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
    public function setTempPath(string $tempPath): void {
        $this->tempPath = $tempPath;
    }
    public function getTempPath(): string {
        return $this->tempPath;
    }
    public function getIsFavorite(): int
    {
        return $this->isFavorite;
    }
    public function setIsFavorite($isFavorite): void
    {
        $this->isFavorite = $isFavorite;
    }
    public function getEventId(): int
    {
        return $this->event_id;
    }
    public function setEventId($event_id): void
    {
        $this->event_id = $event_id;
    }

    public  static function getAttachments($id, $files) {
        $attachments = [];
        if (isset($files['attachments']) && is_array($files['attachments']['name'])) {
            foreach ($files['attachments']['name'] as $index => $fileName) {
                if (!empty($files['attachments']['tmp_name'][$index])) {
                    $attachment = new Attachment();
                    $attachment->setFileName($fileName);
                    $attachment->setFileType($files['attachments']['type'][$index]);
                    $attachment->setTempPath($files['attachments']['tmp_name'][$index]);
                    $attachment->setMessageId($id); 
                    $attachments[] = $attachment;
                }
            }
        }

        return $attachments; 
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
public function toArray(): array {
    return get_object_vars($this);
}
}

