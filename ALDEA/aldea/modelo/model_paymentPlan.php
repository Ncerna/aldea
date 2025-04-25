<?php 
require_once 'model/model_validations.php';

class PaymentPlan
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

  

    function get_paymentesPlan($date_init, $date_end, $search, $status=null)
    {
        try{
        $sql = "SELECT id as tipo_id, name, code, amount,status, created_at, updated_at FROM paymentplan";

        if (!empty($date_end) && !empty($date_init)) {
          $sql .= " WHERE (paymentplan.created_at BETWEEN '$date_init 00:00:00' AND '$date_end 23:59:59')";
        }

        // Agregar condición de estado
        if ($status !== null && $status !== '') {
            $sql .= (!empty($date_end) && !empty($date_init)) ? " AND" : " WHERE";
            $sql .= " status = '$status'";
        } else {
            $sql .= (!empty($date_end) && !empty($date_init)) ? " AND" : " WHERE";
            $sql .= " status <> 0";
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
            return array('status' => false, 'auth' => true, 'msg' => 'Error al recuperar los datos: ' . $this->conexion->conexion->error, 'data' => '');
        }
        } catch (Exception $e) {
            return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
        }
    }

    function Update_PaymentPlan($id, $name, $amount, $stado)
    {
        try{
       // Verificar si el nombre ya existe
        if ($this->Check_PaymentPlan_name_exists($name,$id)) {
            return array('status' => false, 'auth' => true, 'msg' => 'El nombre ya existe', 'data' => '');
        }

        $sql = "UPDATE paymentplan SET name = ?, status = ?,amount=?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("ssss", $name, $stado, $amount, $id);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Actualización exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la actualización' . $stmt->error, 'data' => '');
        }
        } catch (Exception $e) {
            return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
        }
    }

    function Check_PaymentPlan_name_exists($name, $id = null) {
        $sql = "SELECT COUNT(*) AS count FROM paymentplan WHERE name = ?";
        $params = array($name);
        // Si se proporciona un ID, excluimos ese registro de la verificación
        if ($id !== null) {
            $sql .= " AND id != ?";
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


function Register_PaymentPlan($id, $name,$code, $amount, $stado) { 
    try {
         

        // Verificar si el nombre ya existe
        if ($this->Check_PaymentPlan_name_exists($name)) {
            return array('status' => false, 'auth' => true, 'msg' => 'El nombre ya existe', 'data' => '');
        }
        $id=null;
        // Si el nombre no existe, proceder con la inserción
        $sql = "INSERT INTO paymentplan (name,code, amount, status, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("ssss",  $name,$code, $amount,$stado);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Registro exitoso', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la inserción' . $stmt->error, 'data' => '');
        }
    } catch (Exception $e) {
        return array('status' => false, 'auth' => true, 'msg' => 'Excepción_2: ' . $e->getMessage(), 'data' => '');
    }
}



function getpayment(){
    try {
        $sql = "SELECT id as tipo_id, name, code, amount, status, created_at, updated_at FROM paymentplan WHERE status <> 0 ";
        $result = $this->conexion->conexion->query($sql);
        if ($result) {
            $types = array();
            while ($row = $result->fetch_assoc()) {
                $types[] = $row;
            }

            return array('status' => true, 'auth' => true, 'msg' => 'Datos recuperados con éxito', 'data' => $types);
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error al recuperar los datos: ' . $this->conexion->conexion->error, 'data' => '');
        }
    } catch (Exception $e) {
        return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
    }
}

    
}



 ?>