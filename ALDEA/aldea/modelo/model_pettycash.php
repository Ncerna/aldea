<?php

require_once 'model/model_validations.php';

class PettyCash {
    private $conexion;
    private $validations;

    public function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
        $this->validations = new Validations($this->conexion);
    }

    function Register_pettycash($pettycashname, $amountmax, $amountmin,$iscurrent) {
        // Validación de existencia en la tabla "pettycash" en función de la columna "pettycashname"

        if ($this->validations->recordExists('pettycash', 'pettycashname', $pettycashname)) {
            return array('status' => false, 'auth' => true, 'msg' => 'La caja chica con ese nombre ya existe');
        }

       
        $status = 1;   // Valor por defecto para "status" (1)

        $sql = "INSERT INTO pettycash (pettycashname, amountmax, amountmin, iscurrent, status, date_create, date_update) VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("siiss", $pettycashname, $amountmax, $amountmin, $iscurrent, $status);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Registro exitoso', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la inserción', 'data' => '');
        }
    }

    function get_pettycash() {
        $sql = "SELECT idpetty, pettycashname, amountmax, amountmin, iscurrent, status, date_create, date_update FROM pettycash";
       $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo["data"][]=$consulta_VU;

            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function Update_pettycash($id, $pettycashname, $amountmax, $amountmin, $iscurrent) {
        // Validación de existencia en la tabla "pettycash" en función de la columna "pettycashname"
        if (!$this->validations->recordExists('pettycash', 'pettycashname', $pettycashname)) {
            return array('status' => false, 'auth' => true, 'msg' => 'La caja chica con ese nombre ya existe');
        }
        $sql = "UPDATE pettycash SET pettycashname = ?, amountmax = ?, amountmin = ?, iscurrent = ?, date_update = NOW() WHERE idpetty = ?";
         $stmt = $this->conexion->conexion->prepare($sql);
         $stmt->bind_param("sdiis", $pettycashname, $amountmax, $amountmin, $iscurrent, $id);


        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Actualización exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la actualización', 'data' => '');
        }

  
    }

    function Remove_pettycash($id) {
        if (!$this->validations->recordExists('pettycash', 'idpetty', $id)) {
            return array('status' => false, 'auth' => true, 'msg' => 'No se encontró una caja chica con el ID especificado');
        }

        $sql = "DELETE FROM pettycash WHERE idpetty = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Eliminación exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la eliminación', 'data' => '');
        }
    }

    public function ShowPettyCash($id) {
        $sql = "SELECT idpetty, pettycashname, amountmax, amountmin, iscurrent, status, date_create, date_update FROM pettycash WHERE idpetty = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result(); // Obtener el resultado de la consulta
            $pettycash = $result->fetch_assoc();
            return array('status' => true, 'auth' => true, 'msg' => 'Caja chica encontrada', 'data' => $pettycash);
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Caja chica no encontrada', 'data' => '');
        }
    }

        public function get_exit_summary($start,$end){

     $sql = "select categoryexit AS categorias, fixedcoste.name, amount, 'Egreso' AS 'tipo', dateoperation FROM exits
             INNER JOIN categoryexit ON categoryexit.id = exits.category_id
             LEFT JOIN fixedcoste ON fixedcoste.idfixed = exits.fixedcoste_id
             UNION
            select categoryentry AS categorias, '' AS 'name', amount, 'Ingreso' AS 'tipo', dateoperation FROM entry
            INNER JOIN categoryentry ON categoryentry.id = entry.category_id
            UNION
            select tipo AS categorias,'' AS 'name',motoPago AS amount, 'Ingreso' AS 'tipo', dateoperation FROM registopagos;";

          if (!empty($start) && !empty($end)) {
            $sql .= " WHERE exits.dateoperation BETWEEN '$start' AND '$end'";
             }

        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo["data"][]=$consulta_VU;

            }
            return $arreglo;
            $this->conexion->cerrar();
        }

    }

}


 ?>