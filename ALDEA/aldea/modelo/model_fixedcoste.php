<?php

require_once 'model/model_validations.php';

class FixedCoste {
    private $conexion;
    private $validations;

    public function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
        $this->validations = new Validations($this->conexion);
    }

   

     function Register_fixedcoste($idfixed, $name) {
    // Validación de duplicados en la tabla "fixedcoste" con "idfixed" como columna de ID
    if ($this->validations->isDuplicate('fixedcoste', 'name', $name)) {
        return array('status' => false, 'auth' => true, 'msg' => 'Ya existe un registro con el mismo Nombre');
    }

    $sql = "INSERT INTO fixedcoste (name, date_create, date_update) VALUES (?, NOW(), NOW())";
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param("s", $name); // Cambio "s" a "ss" para vincular dos parámetros de tipo cadena

    if ($stmt->execute()) {
        return array('status' => true, 'auth' => true, 'msg' => 'Registro exitoso', 'data' => '');
    } else {
        return array('status' => false, 'auth' => true, 'msg' => 'Error en la inserción', 'data' => '');
    }
}

    function get_fixedcoste() {
        $sql = "SELECT idfixed, name, date_create, date_update FROM fixedcoste";
       $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo["data"][]=$consulta_VU;

            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function Update_fixedcoste($idfixed, $name) {
        // Validación de duplicados en la tabla "fixedcoste" con "idfixed" como columna de ID
        if ($this->validations->isDuplicate('fixedcoste', 'idfixed', $idfixed,$idfixed,'idfixed')) {
            return array('status' => false, 'auth' => true, 'msg' => 'Ya existe un registro con el mismo ID');
        }
        $date_update = date('Y-m-d');
        $sql = "UPDATE fixedcoste SET name = ?,  date_update = ? WHERE idfixed = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("sss", $name, $date_update, $idfixed);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Actualización exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la actualización', 'data' => '');
        }
    }

    function Remove_fixedcoste($idfixed) {
        if (!$this->validations->recordExists('fixedcoste', 'idfixed', $idfixed)) {
            return array('status' => false, 'auth' => true, 'msg' => 'No se encontró un registro con el ID especificado');
        }

        $sql = "DELETE FROM fixedcoste WHERE idfixed = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $idfixed);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Eliminación exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la eliminación', 'data' => '');
        }
    }

    public function ShowFixedCoste($idfixed) {
        $sql = "SELECT idfixed, name, date_create, date_update FROM fixedcoste WHERE idfixed = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $idfixed);

        if ($stmt->execute()) {
            $result = $stmt->get_result(); // Obtener el resultado de la consulta
            $fixedcoste = $result->fetch_assoc();
            return array('status' => true, 'auth' => true, 'msg' => 'Costo fijo encontrado', 'data' => $fixedcoste);
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Costo fijo no encontrado', 'data' => '');
        }
    }
}


 ?>