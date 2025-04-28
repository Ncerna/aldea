<?php 

class Province {
    public $id;
    public $name;

    public static function fromArray(array $data): self {
        $province = new self();
        $province->id = $data['id'];
        $province->name = $data['name'];
        return $province;
    }
}

 ?>