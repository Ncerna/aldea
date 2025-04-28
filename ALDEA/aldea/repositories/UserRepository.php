<?php 
require_once __DIR__ . '/BaseRepository.php';
require_once __DIR__ . '/../utils/ApiResponse.php';

class UserRepository extends BaseRepository {
    protected function getTableName(): string {
        return "usuarios";
    }
   

    public function getAllUsers(): array {
        $query = "SELECT usu_id as id ,usu_usuario  as name FROM ". $this->getTableName() ;
        $stmt = $this->executeQuery($query);
        $result = $stmt->get_result();
        $usuarios = [];
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
        return $usuarios;
    }

    // Otros métodos específicos para usuarios...
}


 ?>