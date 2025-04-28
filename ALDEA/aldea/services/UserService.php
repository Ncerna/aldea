<?php 
require_once __DIR__ . '/../utils/ApiResponse.php';
class UserService {
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): array {
        return $this->userRepository->getAllUsers();
    }

    public function handleGetAllUsersRequest(): array {
        $usuarios = $this->getAllUsers();
        return ApiResponse::successResult(count($usuarios), $usuarios);
    }
}


 ?>