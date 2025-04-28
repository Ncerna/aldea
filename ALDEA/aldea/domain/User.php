<?php

class User {
    private int $id;
    private string $name;
    private string $username;
    private string $email;
    private string $fullName;
    private int $status;
    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getFullName(): string {
        return $this->fullName;
    }

    public function getStatus(): int {
        return $this->status;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setFullName(string $fullName): void {
        $this->fullName = $fullName;
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

}