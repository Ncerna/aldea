<?php

require_once 'model/model_validations.php';

class Entry {
    private $conexion;
    private $validations;

    public function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
        $this->validations = new Validations($this->conexion);
    }

    function Register_entry($identry, $description, $payment, $amount, $dateoperation,$category_id) {
        // Validación de duplicados en la tabla "entry" con "identry" como columna de ID
        if ($this->validations->isDuplicate('entry', 'identry', $identry)) {
            return array('status' => false, 'auth' => true, 'msg' => 'Ya existe un registro con el mismo ID');
        }

        if (!is_numeric($category_id) || intval($category_id) != $category_id) return array('status' => false, 'auth' => true, 'msg' => 'categoría no es un número entero válido'.$category_id, 'data' => '');


        $sql = "INSERT INTO entry (description, payment, amount, dateoperation, category_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("ssdss", $description, $payment, $amount, $dateoperation, $category_id);


        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Registro exitoso', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la inserción'.$stmt->error, 'data' => '');
        }
    }

    function get_entry($start,$end) {

      if (empty($start) || empty($end)) {
            $start = isset($start) ? $start : ''; 
            $end = isset($end) ? $end : ''; 
        }

       
          $sql =  "select idregistropagos AS identry,tipo AS description, tipo AS categoryentry,'EFECTIVO' AS payment,motoPago AS amount,
            dateoperation AS dateoperation FROM registopagos";

             if (!empty($start) && !empty($end)) {
            $sql .= " WHERE dateoperation BETWEEN '$start' AND '$end'";
             }

        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo["data"][]=$consulta_VU;

            }
           
            return $arreglo;
           
        }
    }

    function get_entry2($start,$end){
        if (empty($start) || empty($end)) {
            $start = isset($start) ? $start : ''; 
            $end = isset($end) ? $end : ''; 
        }

      $sql = "select identry, description,categoryentry, payment, amount, dateoperation FROM entry 
                inner join  categoryentry on categoryentry.id = entry.category_id ";

         if (!empty($start) && !empty($end)) {
            $sql .= " WHERE dateoperation BETWEEN '$start' AND '$end'";
          }
          $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo["data"][]=$consulta_VU;

            }
             $this->conexion->cerrar();
            return $arreglo;
           
        }
    }

    function Update_entry($identry, $description, $payment, $amount, $dateoperation, $category_id) {
        // Validación de duplicados en la tabla "entry" con "identry" como columna de ID
        if (!$this->validations->isDuplicate('entry', 'identry', $identry)) {
            return array('status' => false, 'auth' => true, 'msg' => 'Ya existe un registro con el mismo ID');
        }

        if (!is_numeric($category_id) || intval($category_id) != $category_id) return array('status' => false, 'auth' => true, 'msg' => 'categoría no es un número entero válido'.$category_id, 'data' => '');
         
        $sql = "UPDATE entry SET description = ?, payment = ?, amount = ?, dateoperation = NOW(), category_id=?  WHERE identry = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("sssss", $description, $payment, $amount, $category_id,$identry);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Actualización exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la actualización'.$stmt->error, 'data' => '');
        }
    }

    function Remove_entry($identry) {
        if (!$this->validations->recordExists('entry', 'identry', $identry)) {
            return array('status' => false, 'auth' => true, 'msg' => 'Este registro no se puede eliminar por que se registro en otro módulo. gracias.');
        }

        $sql = "DELETE FROM entry WHERE identry = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $identry);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Eliminación exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la eliminación', 'data' => '');
        }
    }

    public function ShowEntry($identry) {
        $sql = "SELECT identry, description, payment, amount, dateoperation,category_id FROM entry WHERE identry = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $identry);

        if ($stmt->execute()) {
            $result = $stmt->get_result(); // Obtener el resultado de la consulta
            $entry = $result->fetch_assoc();
            return array('status' => true, 'auth' => true, 'msg' => 'Entrada encontrada', 'data' => $entry);
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Entrada no encontrada', 'data' => '');
        }
    }
}


 ?>