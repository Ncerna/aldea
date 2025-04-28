<?php
class Agent {
    // Propiedades de la tabla
    public $id;
    // Step 8
    public $firstName;
    public $lastName;
    public $idNumber;
    public $relationship;
    public $profession;
    public $birthDate;
    public $maritalStatus;
    public $nationality;
    public $birthCountry;
    public $educationLevel;
    public $homePhone;
    public $cellPhone;
    public $whatsApp;
    public $company;
    public $workPhone;
    // Step 9
    public $code;
    public $serial;
    public $bankName;
    public $accountType;
    public $accountNumber;
    public $homeAddress;
    // Por defecto
    public $sign_ups_id;
    public $created_at;
    public $updated_at;
    public $status;


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function getSignUpsId() {
        return $this->sign_ups_id;
    }

    public function setSignUpsId($sign_ups_id) {
        $this->sign_ups_id = $sign_ups_id;
    }
    // Método para convertir el objeto en un array
    public function toArray(): array {
        return get_object_vars($this);
    }
    // Método estático para crear una instancia desde dos arrays (step9Data es opcional)
    public static function fromArray(array $step8Data, array $step9Data = []): self {
        $instance = new self();
        // Combinar los datos de step_8 y step_9 en un solo array
        $combinedData = array_merge($step8Data, $step9Data);
        // Mapear los datos combinados a las propiedades de la clase
        foreach ($combinedData as $key => $value) {
            if (property_exists($instance, $key)) {
                $instance->$key = $value;
            }
        }
        return $instance;
    }
    public function isValid() {

        if (empty($this->firstName))  throw new Exception("El nombre es obligatorio.");
        if (empty($this->lastName))   throw new Exception("El apellido es obligatorio.");
        if (empty($this->idNumber))  throw new Exception("El número de identificación es obligatorio.");
        if (empty($this->relationship))   throw new Exception("La relación es obligatoria.");
       // if (!preg_match("/^[0-9]+$/", $this->idNumber))   throw new Exception("El número de identificación debe ser numérico.");
        return true;
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