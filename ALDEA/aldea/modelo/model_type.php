<?php 
require_once 'model/model_validations.php';

class Type
{
    private $conexion;
    private $validations;

    public function __construct()
    {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
        $this->validations = new Validations($this->conexion);
    }

   

    function get_types($date_init, $date_end, $search)
    {
        try{
        $sql = "SELECT tipo_id, tipo_nombre, t_stado, of_rank, created_at, updated_at FROM tipoevaluacion";

        if (!empty($date_end) && !empty($date_init)) {
          $sql .= " WHERE (tipoevaluacion.created_at BETWEEN '$date_init 00:00:00' AND '$date_end 23:59:59')";
        }
         // Agregar orden predeterminado y límite solo cuando no hay filtro de fecha
        if (empty($date_end) || empty($date_init)) {
           $sql .= " ORDER BY created_at DESC LIMIT 10";
        }

        $result = $this->conexion->conexion->query($sql);

        if ($result) {
            $types = array();
            while ($row = $result->fetch_assoc()) {
                $types[] = $row;
            }

            return array('status' => true, 'auth' => true, 'msg' => 'Datos recuperados con éxito', 'data' => $types);
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error al recuperar los datos' . $stmt->error, 'data' => '');
        }
        } catch (Exception $e) {
            return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
        }
    }

    function Update_type($id, $name, $of_rank, $stado)
    {
        try{
       // Verificar si el nombre ya existe
        if ($this->Check_type_name_exists($name,$id)) {
            return array('status' => false, 'auth' => true, 'msg' => 'El nombre ya existe', 'data' => '');
        }

        $sql = "UPDATE tipoevaluacion SET tipo_nombre = ?, t_stado = ?,of_rank=?, updated_at = NOW() WHERE tipo_id = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("ssss", $name, $stado, $of_rank, $id);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Actualización exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la actualización' . $stmt->error, 'data' => '');
        }
        } catch (Exception $e) {
            return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
        }
    }

    function Check_type_name_exists($name, $id = null) {
        $sql = "SELECT COUNT(*) AS count FROM tipoevaluacion WHERE tipo_nombre = ?";
        $params = array($name);
        // Si se proporciona un ID, excluimos ese registro de la verificación
        if ($id !== null) {
            $sql .= " AND tipo_id != ?";
            $params[] = $id;
        }
        $stmt = $this->conexion->conexion->prepare($sql);
        $types = str_repeat('s', count($params)); // cadena de tipos de parámetros
        $stmt->bind_param($types, ...$params); // pasamos los parámetros como argumentos separados
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] > 0;
     }


function Register_type($id, $name, $of_rank, $stado) { 
    try {
        // Verificar si el nombre ya existe
        if ($this->Check_type_name_exists($name)) {
            return array('status' => false, 'auth' => true, 'msg' => 'El nombre ya existe', 'data' => '');
        }
        $id=null;
        // Si el nombre no existe, proceder con la inserción
        $sql = "INSERT INTO tipoevaluacion (tipo_id, tipo_nombre, t_stado, of_rank, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("ssss", $id, $name, $stado, $of_rank);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Registro exitoso', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la inserción' . $stmt->error, 'data' => '');
        }
    } catch (Exception $e) {
        return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
    }
}


    
}



 ?>