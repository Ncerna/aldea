<?php 
class Department {
    public $id;
    public $name;
    public function __construct(array $data = []) {
        if (!empty($data)) {
            $this->id = $data['id'];
            $this->name = $data['name'];
        }
    }

    public static function fromArray(array $data): self {
        return new self($data);
    }
}


 ?>