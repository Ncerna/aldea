<?php

class BaseEntity {
    protected $created_at;
    protected $updated_at;
    protected $status;

    public function __construct() {
        $this->created_at = date('Y-m-d H:i:s'); // Fecha actual
        $this->updated_at = date('Y-m-d H:i:s'); // Fecha actual
        $this->status = 1; // Valor por defecto
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }
}
?>