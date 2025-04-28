<?php
require_once 'BaseRepository.php';
require_once __DIR__ . '/../domain/Grade.php';
class GradeRepository extends BaseRepository {

    protected function getTableName(): string {
        return 'grado';
    }

    public function listGrades(): array {
        $query = "SELECT idgrado as id, gradonombre as name FROM grado ORDER BY gradonombre ASC";
        $stmt = $this->executeQuery($query);
        $grades = [];
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $grades[] = Grade::fromArray($row);
        }
        return $grades;
    }
}
