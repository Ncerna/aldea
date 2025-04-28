<?php

class Region {
    private $idDepartment;
    private $departmentName;

    private $idProvince;
    private $provinceName;

    private $idDistrict;
    private $districtName;
 
    public function getIdDepartment() {
        return $this->idDepartment;
    }

    public function getDepartmentName() {
        return $this->departmentName;
    }

    // Province
    public function getIdProvince() {
        return $this->idProvince;
    }

    public function getProvinceName() {
        return $this->provinceName;
    }

    // District
    public function getIdDistrict() {
        return $this->idDistrict;
    }

    public function getDistrictName() {
        return $this->districtName;
    }

     public function toArray(): array {
       return get_object_vars($this); 
    }
}
?>
