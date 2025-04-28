
<?php
require_once __DIR__ . '/../../interfaces/IRecipientStrategy.php';

class UserStrategy implements IRecipientStrategy {
    private UserRepository $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    public function getRecipients(): array {
        try {
            return $this->repository->getAllUsers();
        } catch (Exception $e) {
            throw new Exception("Error al obtener los usuarios: " . $e->getMessage());
        }
    }
}
