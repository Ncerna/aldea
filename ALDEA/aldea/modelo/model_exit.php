<?php

require_once 'model/model_validations.php';

class Exits {
    private $conexion;
    private $validations;

    public function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
        $this->validations = new Validations($this->conexion);
    }

    function Register_exit($idexit, $description, $payment, $amount, $beneficiary,$dateoperation,$category_id,$fixedcoste_id) {
        // Validación de duplicados en la tabla "exits" con "idexit" como columna de ID
        if ($this->validations->isDuplicate('exits', 'idexit', $idexit)) {
            return array('status' => false, 'auth' => true, 'msg' => 'Ya existe un registro con el mismo ID');
        }

        $sql = "INSERT INTO exits (idexit, description, payment, amount, dateoperation, beneficiary,category_id,fixedcoste_id) VALUES (?, ?, ?, ?, NOW(), ?,?,?)";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("sssssss", $idexit, $description, $payment, $amount, $beneficiary,$category_id,$fixedcoste_id);

        if ($stmt->execute()) {

             $currentAmount = $this->GetPettyCashAmountMax(1);//pasando el id de la caja
             $newAmount = max(0, $currentAmount - min($amount, $currentAmount));
             $this->UpdatePettyCashAmountMax(1, $newAmount);//pasando el id de la caja
            return array('status' => true, 'auth' => true, 'msg' => 'Registro exitoso', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la inserción', 'data' => '');
        }
    }

    function get_exit($start,$end) {
        $sql = "SELECT e.idexit, e.description, ce.categoryexit,  fc.name AS fixedcoste_name, e.payment, e.amount, 
          e.dateoperation,  e.beneficiary FROM  exits AS e
          inner join  categoryexit AS ce ON ce.id = e.category_id 
          left join   fixedcoste AS fc ON fc.idfixed = e.fixedcoste_id";

          if (!empty($start) && !empty($end)) {
            $sql .= " WHERE dateoperation BETWEEN '$start' AND '$end'";
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

    function Update_exit($idexit, $description, $payment, $amount, $beneficiary,$category_id,$fixedcoste_id) {
        // Validación de duplicados en la tabla "exit" con "idexit" como columna de ID
        if (!$this->validations->isDuplicate('exits', 'idexit', $idexit)) {
            return array('status' => false, 'auth' => true, 'msg' => 'Ya existe un registro con el mismo ID');
        }
        $currentAmount = $this->GetExitsAmount($idexit);//saldo anterio
        $pettyCashAmount = $this->GetPettyCashAmountMax(1);//saldo actual de la caja
        $operation =0;
        if($currentAmount != $amount){

            if($currentAmount < $amount){
                $rest  =   $pettyCashAmount - $amount;
                $operation= $currentAmount + $rest ;
            }
            if($currentAmount > $amount){
               $c=  $currentAmount - $amount;
               $operation = $pettyCashAmount + $c;
           }
           $this->UpdatePettyCashAmountMax(1,  $operation);
       }

       $sql = "UPDATE exits SET description = ?, payment = ?, amount = ?, dateoperation = NOW(), beneficiary = ?, category_id = ?, fixedcoste_id = ?  WHERE idexit = ?";
       $stmt = $this->conexion->conexion->prepare($sql);
       $stmt->bind_param("sssssss", $description, $payment, $amount, $beneficiary, $category_id,$fixedcoste_id,$idexit);

       if ($stmt->execute()) {

        return array('status' => true, 'auth' => true, 'msg' => 'Actualización exitosa', 'data' => '');
    } else {
        return array('status' => false, 'auth' => true, 'msg' => 'Error en la actualización', 'data' => '');
    }
}

    function Remove_exit($idexit) {
        if (!$this->validations->recordExists('exits', 'idexit', $idexit)) {
            return array('status' => false, 'auth' => true, 'msg' => 'No se encontró un registro con el ID especificado');
        }

        $sql = "DELETE FROM exits WHERE idexit = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $idexit);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Eliminación exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la eliminación', 'data' => '');
        }
    }

    public function ShowExit($idexit) {
        $sql = "SELECT idexit, description, payment, amount, dateoperation, beneficiary, category_id, fixedcoste_id FROM exits WHERE idexit = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $idexit);

        if ($stmt->execute()) {
            $result = $stmt->get_result(); // Obtener el resultado de la consulta
            $exit = $result->fetch_assoc();
            return array('status' => true, 'auth' => true, 'msg' => 'Salida encontrada', 'data' => $exit);
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Salida no encontrada', 'data' => '');
        }
    }

    public function UpdatePettyCashAmountMax($idpetty, $newAmount) {
    $sql = "UPDATE pettycash SET amountmax = ? WHERE idpetty = ?";
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param("ii", $newAmount, $idpetty);
    return $stmt->execute() ? true : false;       
    }
    public function GetPettyCashAmountMax($idpetty) {
    $sql = "SELECT amountmax FROM pettycash WHERE idpetty = ?";
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param("i", $idpetty);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $pettycash = $result->fetch_assoc();
        return $pettycash['amountmax'];
    } else {
        // Manejo de error si es necesario
        return 0;
    }
}

  public function GetExitsAmount($idexit) {
    $sql = "SELECT amount FROM exits WHERE idexit = ?";
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param("i", $idexit);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $pettycash = $result->fetch_assoc();
        return $pettycash['amount'];
    } else {
        // Manejo de error si es necesario
        return 0;
    }
}


}


 ?>