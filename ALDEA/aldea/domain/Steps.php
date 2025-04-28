<?php
class Steps {
    // Propiedades para cada paso
    public $step_1;
    public $step_2;
    public $step_3;
    public $step_4;
    public $step_5;
    public $step_6;
    public $step_7;
    public $step_8;
    public $step_9;
    public $step_10;
    public $step_11;
    public $step_13;

    // Constructor para inicializar la clase con los datos
    public function __construct(array $data = []) {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (property_exists($this, $key)) {
                  
                    $this->$key = $value;
                }
            }
        }
    }

    // Método para convertir el objeto en un array
    public function toArray(): array {
        return get_object_vars($this);
    }

    // Método estático para crear una instancia desde un array
    public static function fromArray(array $data): self {
        return new self($data);
    }

    // Método para validar los datos
    public function validate(): bool {
        // Ejemplo de validación: verificar que el paso 1 tenga datos
        if (empty($this->step_1)) {
            throw new Exception('El paso 1 es obligatorio.');
        }
        // Puedes agregar más validaciones aquí
        return true;
    }

}
