<?php
class WeightedGrade {
    public int $idPond;
    public int $studentId;
    public int $courseId;
    public float $accumulatedGrade; // notaacum
    public int $substitution; // susty
    public int $gradeId;
    public int $orderType;
    public int $typeId;
    public int $yearId;
    public int $levelId;
    public string $sectionId;
    public int $userSession;
    public string $createDate;

    public function toArray(): array {
        return get_object_vars($this);
    }

    public static function fromArray(array $data): self {
        $instance = new self();
        foreach ($data as $key => $value) {
            if (property_exists($instance, $key)) $instance->$key = $value;
        }
        return $instance;
    }
}