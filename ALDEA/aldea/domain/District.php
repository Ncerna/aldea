<?php 
class District {
    public $id;
    public $name;

    public static function fromArray(array $data): self {
        $district = new self();
        $district->id = $data['id'];
        $district->name = $data['name'];
        return $district;
    }
}



 ?>