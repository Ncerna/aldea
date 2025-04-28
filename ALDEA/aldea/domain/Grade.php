<?php
class Grade implements JsonSerializable {
    public int $id;
    public string $name;
    public ?int $aula_id = null;
    public ?int $turno_id = null;
    public ?int $nivel_id = null;
    public ?int $vacantes = null;
    public ?string $seccion = null;
    public ?string $fechaRegistro = null;
    public ?string $fechaActualizacion = null;
    public ?int $gradostatus = null;
    public ?int $grade_status = null;
    public ?int $year_id = null;

    public static function fromArray(array $data): self {
        $instance = new self();
        foreach ($data as $key => $value) {
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



