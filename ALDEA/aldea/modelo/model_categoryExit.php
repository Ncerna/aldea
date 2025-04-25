<?php

require_once 'model/model_validations.php';

class CategoryExit {
    private $conexion;
    private $validations;

    public function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
        $this->validations = new Validations($this->conexion);
    }

    function Register_categoryexit($categoryexit) {
        // Validación de existencia en la tabla "categoryexit" en función de la columna "categoryexit"
        if ($this->validations->recordExists('categoryexit', 'categoryexit', $categoryexit)) {
            return array('status' => false, 'auth' => true, 'msg' => 'La categoría ya existe');
        }

        $sql = "INSERT INTO categoryexit (categoryexit, date_create, date_update) VALUES (?, NOW(), NOW())";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $categoryexit);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Registro exitoso', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la inserción', 'data' => '');
        }
    }

    function get_categoryexit() {
        
         $sql = "SELECT id, categoryexit, date_create, date_update FROM categoryexit";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo["data"][]=$consulta_VU;

            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function Update_categoryexit($id, $categoryexit) {
        // Validación de existencia en la tabla "categoryexit" en función de la columna "categoryexit"
        if ($this->validations->recordExists('categoryexit', 'categoryexit', $categoryexit, $id)) {
            return array('status' => false, 'auth' => true, 'msg' => 'La categoría ya existe');
        }
        $date_update = date('Y-m-d');
        $sql = "UPDATE categoryexit SET categoryexit = ?, date_update = ? WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("sss", $categoryexit, $date_update, $id);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Actualización exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la actualización', 'data' => '');
        }
    }

    function Remove_categoryexit($id) {
        if (!$this->validations->recordExists('categoryexit', 'id', $id)) {
            return array('status' => false, 'auth' => true, 'msg' => 'No se encontró una categoría con el ID especificado');
        }

        $sql = "DELETE FROM categoryexit WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Eliminación exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la eliminación', 'data' => '');
        }
    }

    public function ShowCategoryExit($id) {
        $sql = "SELECT id, categoryexit, date_create, date_update FROM categoryexit WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result(); // Obtener el resultado de la consulta
            $categoryexit = $result->fetch_assoc();
            return array('status' => true, 'auth' => true, 'msg' => 'Categoría encontrada', 'data' => $categoryexit);
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Categoría no encontrada', 'data' => '');
        }
    }
}


 ?>