
<?php
require_once __DIR__ . '/../../interfaces/IRecipientStrategy.php';

class RoleStrategy implements IRecipientStrategy {
    private RoleRepository $repository;

    public function __construct(RoleRepository $repository) {
        $this->repository = $repository;
    }

    public function getRecipients(): array {
        try {
            return $this->repository->listRoles();
        } catch (Exception $e) {
            throw new Exception("Error al obtener los roles: " . $e->getMessage());
        }
    }
}
