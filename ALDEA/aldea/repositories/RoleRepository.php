<?php
require_once __DIR__ . '/BaseRepository.php';
require_once __DIR__ . '/../domain/Role.php';

class RoleRepository extends BaseRepository {
    protected function getTableName(): string {
        return "rol"; // Ajusta según el nombre real de tu tabla
    }

    /**
     * Obtiene todos los roles activos (status = 1)
     * @return Role[]
     * @throws Exception
     */
    public function listRoles(): array {
        $query = "SELECT  rol_id as id ,rol_nombre as name FROM " . $this->getTableName() . "  ORDER BY name ASC";
        $stmt = $this->executeQuery($query);
        $result = $stmt->get_result();

        $roles = [];
        while ($row = $result->fetch_assoc()) {
            $roles[] = Role::fromArray($row);
        }

        $stmt->close();
        return $roles;
    }

    /**
     * Busca un role por su ID
     * @param int $id
     * @return Role|null
     * @throws Exception
     */
    public function findById(int $id): ?Role {
        $query = "SELECT * FROM " . $this->getTableName() . " WHERE id = ? LIMIT 1";
        $stmt = $this->executeQuery($query, [$id]);
        $result = $stmt->get_result();

        $role = null;
        if ($row = $result->fetch_assoc()) {
            $role = Role::fromArray($row);
        }

        $stmt->close();
        return $role;
    }

    /**
     * Inserta un nuevo role en la base de datos
     * @param Role $role
     * @return array Resultado de la operación
     * @throws Exception
     */
    public function insert(Role $role): array {
        $columns = ['name', 'description', 'status'];
        $query = $this->buildInsertQuery($columns, $this->getTableName());
        $params = [
            $role->getName(),
            $role->getDescription(),
            $role->getStatus()
        ];

        $stmt = $this->executeQuery($query, $params);
        $affectedRows = $stmt->affected_rows;
        $insertId = $stmt->insert_id;
        $stmt->close();

        return [
            'affected_rows' => $affectedRows,
            'insert_id' => $insertId
        ];
    }

    /**
     * Actualiza un role existente
     * @param Role $role
     * @return array Resultado de la operación
     * @throws Exception
     */
    public function update(Role $role): array {
        $columns = ['name', 'description', 'status'];
        $query = $this->buildUpdateQuery($columns, $this->getTableName());
        $params = [
            $role->getName(),
            $role->getDescription(),
            $role->getStatus(),
            $role->getId()
        ];

        $stmt = $this->executeQuery($query, $params);
        $affectedRows = $stmt->affected_rows;
        $stmt->close();

        return [
            'affected_rows' => $affectedRows
        ];
    }

    /**
     * Guarda un role (inserta o actualiza según si tiene ID)
     * @param Role $role
     * @return array
     * @throws Exception
     */
    public function save(Role $role): array {
        if (empty($role->getId()) || $role->getId() === 0) {
            return $this->insert($role);
        } else {
            return $this->update($role);
        }
    }
}
