<?php

class Role implements JsonSerializable {
    private int $id;
    private string $name;
    private string $description;
    private int $status;

     // Getters
     public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getStatus(): int {
        return $this->status;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setStatus(int $status): void {
        $this->status = $status;
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
    public function jsonSerialize(): array {
        return array_filter(get_object_vars($this), fn($value) => $value !== null);
    }
}