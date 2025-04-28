<?php
require_once __DIR__ . '/../../interfaces/IRecipientStrategy.php';
class GradeStrategy implements IRecipientStrategy {
    private $repository;
    public function __construct(GradeRepository $repository) {
        $this->repository = $repository;
    }
    public function getRecipients(): array {
        try {
            return $this->repository->listGrades();
        } catch (Exception $e) {
            throw new Exception("Error al obtener los destinatarios (grades): " . $e->getMessage());
        }
    }
}

