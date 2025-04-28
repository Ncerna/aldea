<?php

class GradeNote {
    public int $idNotes;
    public int $gradeId;
    public int $courseId;
    public int $studentId;
    public string $sectionId;
    public int $academicLoadId; // cargaacadId, optional if needed
    public int $orderType;
    public int $evaluationTypeId; // tipoevaluacionid
    public float $studentGrade; // nota_alum
    public int $levelId;
    public int $yearId;
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


