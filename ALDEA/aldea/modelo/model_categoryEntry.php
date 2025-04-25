<?php

require_once 'model/model_validations.php';

class CategoryEntry {
    private $conexion;
    private $validations;

    public function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
        $this->validations = new Validations($this->conexion);
    }

    function Register_categoryentry($categoryentry) {
        // Validación de existencia en la tabla "categoryentry" en función de la columna "categoryentry"
        if ($this->validations->recordExists('categoryentry', 'categoryentry', $categoryentry)) {
            return array('status' => false, 'auth' => true, 'msg' => 'La categoría ya existe');
        }

        $sql = "INSERT INTO categoryentry (categoryentry, date_create, date_update) VALUES (?, NOW(), NOW())";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $categoryentry);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Registro exitoso', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la inserción', 'data' => '');
        }
    }

    function get_categoryentry() {

         $sql=  "SELECT id, categoryentry, date_create, date_update FROM categoryentry";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo["data"][]=$consulta_VU;

            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function Update_categoryentry($id, $categoryentry) {
        // Validación de existencia en la tabla "categoryentry" en función de la columna "categoryentry"
        if ($this->validations->recordExists('categoryentry', 'categoryentry', $categoryentry, $id)) {
            return array('status' => false, 'auth' => true, 'msg' => 'La categoría ya existe');
        }
        $date_update = date('Y-m-d');

        $sql = "UPDATE categoryentry SET categoryentry = ?, date_update = ? WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("sss", $categoryentry, $date_update, $id);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Actualización exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la actualización', 'data' => '');
        }
    }

    function Remove_categoryentry($id) {
        if (!$this->validations->recordExists('categoryentry', 'id', $id)) {
            return array('status' => false, 'auth' => true, 'msg' => 'No se encontró una categoría con el ID especificado');
        }

        $sql = "DELETE FROM categoryentry WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Eliminación exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la eliminación', 'data' => '');
        }
    }

    public function ShowCategoryEntry($id) {
        $sql = "SELECT id, categoryentry, date_create, date_update FROM categoryentry WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result(); // Obtener el resultado de la consulta
            $categoryentry = $result->fetch_assoc();
            return array('status' => true, 'auth' => true, 'msg' => 'Categoría encontrada', 'data' => $categoryentry);
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Categoría no encontrada', 'data' => '');
        }
    }
}


 ?>