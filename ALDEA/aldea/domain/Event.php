<?php
class Event {
    public  $id;
    public  $title;
    public  $description;
    public  $start_date;
    public  $end_date;
    public  $location = null;
    public  $is_virtual = false;
    public  $virtual_link = null;
    public  $organizer_id = null;
    public  $is_approved = 0;
    public  $approver_id = null;
    public  $status = 1;
    private  $background_color = '#01FF70 !important';
    public  $created_at;
    public  $updated_at;

    private  $recipient_type;

    public function getRecipientType(): string {
        return $this->recipient_type;
    }

    public function setRecipientType(string $recipientType): void {
        $this->recipient_type = $recipientType;
    }


    public function getId()  {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getTitle(): string {
        return $this->title;
    }
    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getDescription(): string {
        return $this->description;
    }
    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getStartDate(): string {
        return $this->start_date;
    }
    public function setStartDate(string $start_date): void {
        $this->start_date = $start_date;
    }

    public function getEndDate(): string {
        return $this->end_date;
    }
    public function setEndDate(string $end_date): void {
        $this->end_date = $end_date;
    }

    public function getLocation(): ?string {
        return $this->location;
    }
    public function setLocation(?string $location): void {
        $this->location = $location;
    }

    public function getOrganizerId(): ?int {
        return $this->organizer_id;
    }
    public function setOrganizerId(?int $organizer_id): void {
        $this->organizer_id = $organizer_id;
    }

    public function getIsApproved(): int {
        return $this->is_approved;
    }
    public function setIsApproved(int $is_approved): void {
        $this->is_approved = $is_approved;
    }

    public function getApproverId(): ?int {
        return $this->approver_id;
    }
    public function setApproverId(?int $approver_id): void {
        $this->approver_id = $approver_id;
    }

    public function getStatus(): int {
        return $this->status;
    }
    public function setStatus(int $status): void {
        $this->status = $status;
    }

    public function getCreatedAt(): ?string {
        return $this->created_at;
    }
    public function setCreatedAt(?string $created_at): void {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): ?string {
        return $this->updated_at;
    }
    public function setUpdatedAt(?string $updated_at): void {
        $this->updated_at = $updated_at;
    }

    // Convierte el objeto a array
    public function toArray(): array {
        return get_object_vars($this);
    }

    // Crea una instancia desde un array
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

    /**
     * Get the value of background_color
     */ 
    public function getBackground_color()
    {
        return $this->background_color;
    }

    /**
     * Set the value of background_color
     *
     * @return  self
     */ 
    public function setBackground_color($background_color)
    {
        $this->background_color = $background_color;

        return $this;
    }
}
