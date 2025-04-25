<?php

require_once 'model/model_validations.php';

class Collaboration {
    private $conexion;
    private $validations;

    public function __construct() {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
        $this->validations = new Validations($this->conexion);
    }

    function Register($id,$namePeople,$lastName,$numbreCi, $description, $payment, $amount,$category_id) {
        try{
        $id=null;
        $category_id = empty($category_id) ? null: $category_id;
        $sql = "INSERT INTO collaborations (id ,name_people,last_name,number_ci,  description, payment, amount,  category_id) VALUES (?,?,?,?,?, ?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("ssssssss",$id, $namePeople, $lastName, $numbreCi, $description, $payment, $amount,  $category_id);


        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Registro exitoso', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la inserción'.$stmt->error, 'data' => '');
        }
         } catch (Exception $e) {
            return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
        }
    }



function get_collaboration($start, $end, $search, $id, $page, $xpage, $status) {
    try {
        $sql = "SELECT id, name_people, last_name, number_ci, description, payment, amount, created_at FROM collaborations WHERE 1";

        $params = array();
        $types = "";

        if (!empty($id)) {
            $sql .= " AND id = ?";
            $params[] = $id;
            $types .= "i";
        }
        if (!empty($search)) {
            $searchTerm = "%$search%";
            $sql .= " AND (name_people LIKE ? OR last_name LIKE ? OR number_ci LIKE ?)";
            $params = array_merge($params, array($searchTerm, $searchTerm, $searchTerm));
            $types .= "sss";
        }
        if (!empty($start) && !empty($end)) {
            $sql .= " AND created_at BETWEEN ? AND ?";
            $params = array_merge($params, array($start. ' 00:00:00', $end. ' 23:59:59'));
            $types .= "ss";
        }
        if (!empty($status)) {
            $sql .= " AND status = ?";
            $params[] = $status;
            $types .= "i";
        }

        $stmt = $this->conexion->conexion->prepare($sql);
        if (!$stmt) throw new Exception('Error preparing SQL statement', 1);
        if (!empty($types)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        if ($stmt->errno)  throw new Exception('Error executing SQL statement: ' . $stmt->error, 1);
        
        $result = $stmt->get_result();
        $collab = array();
        while ($row = $result->fetch_assoc()) {
            $collab[] = $row;
        }
        return array('status' => true, 'auth' => true, 'msg' => 'Datos recuperados con éxito', 'data' => $collab);
    } catch (Exception $e) {
        return array('status' => false, 'auth' => true, 'msg' => 'Error: ' . $e->getMessage(), 'data' => '');
    }
}





  

    function Register_Update($id,$namePeople,$lastName,$numbreCi, $description, $payment, $amount,$category_id) {
        // Validación de duplicados en la tabla "entry" con "identry" como columna de ID
         try{
        $category_id=null;
        $sql = "UPDATE collaborations SET name_people=?, last_name=?, number_ci=?, description = ?, payment = ?, amount = ?, updated_at = NOW(), category_id=?  WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("ssssssss",$namePeople,$lastName,$numbreCi, $description, $payment, $amount, $category_id,$id);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Actualización exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la actualización'.$stmt->error, 'data' => '');
        }
         } catch (Exception $e) {
            return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
        }
    }

    function Remove_collaboration($id) {
        try{
        if (!$this->validations->recordExists('collaborations', 'id', $id)) {
            return array('status' => false, 'auth' => true, 'msg' => 'Este registro no se puede eliminar por que se registro en otro módulo. gracias.');
        }

        $sql = "UPDATE collaborations SET status = 0 WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Eliminación exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la eliminación', 'data' => '');
        }
    } catch (Exception $e) {
        return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
    }
    }

    function checkExists($id){

        $sql = "SELECT id_keys, keys_text FROM keys_students WHERE id_students = ? ";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute() && ($data = $stmt->get_result()->fetch_assoc())) {
            return $data;
        }
        return null;

    }

      /* function checkExistskeyStudent($key_lock){

        $sql = "SELECT id_keys,id_students, keys_text FROM keys_students WHERE keys_text = ? ";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("s", $key_lock);

        if ($stmt->execute() && ($data = $stmt->get_result()->fetch_assoc())) {
            return $data;
        }
        return null;

    }*/

      function checkExistskeyStudent($key_lock){
 
      $sql = "SELECT id_keys,id_students, keys_text FROM keys_students WHERE keys_text = '$key_lock' ";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }

}

   function getDatesStudentsById($id_students,$idyear){

     $sql = "select Id_alumno,Id_grado,year_id, seccion from matricula where Id_alumno= ? and year_id= ? ";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("ii", $id_students,$idyear);

        if ($stmt->execute() && ($data = $stmt->get_result()->fetch_assoc())) {
            return $data;
        }
        return null;
   }


      function Register_key($id_student, $key) {
        try{
       
        $sql = "INSERT INTO keys_students (id_students,keys_text ) VALUES (?,?)";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("is",$id_student, $key);


        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Registro exitoso', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la inserción'.$stmt->error, 'data' => '');
        }
         } catch (Exception $e) {
            return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
        }
    }

    function Update_key($id,$id_student, $key ) {
        // Validación de duplicados en la tabla "entry" con "identry" como columna de ID
         try{
      
        $sql = "UPDATE keys_students SET keys_text=?, updated_at = NOW() WHERE id_keys = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("si", $key,$id);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Actualización exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la actualización'.$stmt->error, 'data' => '');
        }
         } catch (Exception $e) {
            return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
        }
    }

    function getStudents() {
    // Validación de duplicados en la tabla "entry" con "identry" como columna de ID
    try {
        $sql = "SELECT id_keys, id_students FROM keys_students";
        $stmt = $this->conexion->conexion->prepare($sql);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Obtener el resultado de la consulta
            $result = $stmt->get_result();
            $students = array();
            // Recorrer los resultados y almacenarlos en un array
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
            return array('status' => true, 'auth' => true, 'msg' => 'Operación éxito', 'data' => $students);
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la actualización: ' . $stmt->error, 'data' => '');
        }
    } catch (Exception $e) {
        return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
    }
}

   function UpdateKeysStudentsById($id,$id_student, $key ) {
        // Validación de duplicados en la tabla "entry" con "identry" como columna de ID
         try{
      
        $sql = "UPDATE keys_students SET keys_text=?,  updated_at = NOW() WHERE id_keys = ? AND id_students=?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("sii", $key,$id,$id_student);

        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Actualización exitosa', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la actualización'.$stmt->error, 'data' => '');
        }
         } catch (Exception $e) {
            return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
        }
    }


   
}


 ?>