<?php 
require_once 'model/model_validations.php';

class FeePayments
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

    function get_feePayments($paymentPlan_id, $student_id, $year_id, $grade_id, $type_id, $orderType, $status_payment, $start_date, $end_date, $status) {
    try {
        $sql_select = (!empty($student_id)) ? "SELECT student_id " : "SELECT DISTINCT(student_id) ";

        $sql = $sql_select . ", fe.id as id_fee, alumno.alumnonombre, alumno.apellidos, grado.gradonombre, fe.year_id, yearscolar.yearScolar, turnos.turno_nombre, seccion, amount, fe.created_at, payment_date, DATE(next_date) AS next_date, paymentplan.name, paymentplan.amount, status_payment
                FROM feepayments fe
                INNER JOIN grado ON grado.idgrado = fe.grade_id
                INNER JOIN turnos ON grado.turno_id = turnos.turno_id
                INNER JOIN alumno ON alumno.idalumno = fe.student_id
                INNER JOIN yearscolar ON yearscolar.id_year = fe.year_id
                INNER JOIN paymentplan ON paymentplan.id = fe.paymentPlan_id";
        
        $conditions = [];
        $params = [];
        $types = '';

        if (!empty($paymentPlan_id)) { $conditions[] = "fe.paymentPlan_id = ?"; $params[] = $paymentPlan_id; $types .= 'i'; }
        if (!empty($student_id)) { $conditions[] = "fe.student_id = ?"; $params[] = $student_id; $types .= 'i'; }
        if (!empty($year_id)) { $conditions[] = "fe.year_id = ?"; $params[] = $year_id; $types .= 'i'; }
        if (!empty($grade_id)) { $conditions[] = "fe.grade_id = ?"; $params[] = $grade_id; $types .= 'i'; }
        if (!empty($type_id)) { $conditions[] = "fe.type_id = ?"; $params[] = $type_id; $types .= 'i'; }
        if (!empty($orderType)) { $conditions[] = "fe.orderType = ?"; $params[] = $orderType; $types .= 's'; }
        if (!empty($status_payment)) { $conditions[] = "fe.status_payment = ?"; $params[] = $status_payment; $types .= 's'; }
        if (!empty($start_date) && !empty($end_date)) {
            $conditions[] = "fe.created_at BETWEEN ? AND ?";
            $params[] = $start_date . " 00:00:00";
            $params[] = $end_date . " 23:59:59";
            $types .= 'ss'; // Dos parámetros de tipo string
        }
        if (!empty($status)) { $conditions[] = "fe.status = ?"; $params[] = $status; $types .= 's'; }

        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $sql .= " ORDER BY fe.created_at DESC";

        $stmt = $this->conexion->conexion->prepare($sql);

        // Vincular los parámetros
        if ($params) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if ($stmt) {
            return array('status' => true, 'msg' => 'Datos recuperados con éxito', 'data' => $data);
        } else {
            return array('status' => false, 'msg' => 'No se encontraron registros que coincidan con los filtros', 'data' => []);
        }
    } catch (Exception $e) {
        return array('status' => false, 'msg' => 'Error al recuperar los datos: ' . $e->getMessage(), 'data' => []);
    }
}


 /*function get_feePayments($paymentPlan_id, $student_id, $year_id, $grade_id, $type_id, $orderType, $status_payment, $start_date, $end_date, $status) {
    try {
       
       $sql_select = (!empty($student_id)) ? "SELECT student_id " : "SELECT DISTINCT(student_id) ";

        $sql = $sql_select . ",fe.id as id_fee, alumno.alumnonombre, alumno.apellidos, grado.gradonombre,fe.year_id, yearscolar.yearScolar, turnos.turno_nombre, seccion, amount,fe.created_at, payment_date,  DATE(next_date) AS next_date, paymentplan.name,paymentplan.amount, status_payment
                FROM feepayments fe
                INNER JOIN grado ON grado.idgrado = fe.grade_id
                INNER JOIN turnos ON grado.turno_id = turnos.turno_id
                INNER JOIN alumno ON alumno.idalumno = fe.student_id
                INNER JOIN yearscolar ON yearscolar.id_year = fe.year_id
                INNER JOIN paymentplan ON paymentplan.id = fe.paymentPlan_id";
        $conditions = [];
        $params = [];

        if (!empty($paymentPlan_id)) { $conditions[] = "fe.paymentPlan_id = ?"; $params[] = $paymentPlan_id; }
        if (!empty($student_id)) { $conditions[] = "fe.student_id = ?"; $params[] = $student_id; }
        if (!empty($year_id)) { $conditions[] = "fe.year_id = ?"; $params[] = $year_id; }
        if (!empty($grade_id)) { $conditions[] = "fe.grade_id = ?"; $params[] = $grade_id; }
        if (!empty($type_id)) { $conditions[] = "fe.type_id = ?"; $params[] = $type_id; }
        if (!empty($orderType)) { $conditions[] = "fe.orderType = ?"; $params[] = $orderType; }
        if (!empty($status_payment)) { $conditions[] = "fe.status_payment = ?"; $params[] = $status_payment; }
        if (!empty($start_date) && !empty($end_date)) {
            $conditions[] = "fe.created_at BETWEEN ? AND ?";
            $params[] = $start_date . " 00:00:00";
            $params[] = $end_date . " 23:59:59";
        }
        if (!empty($status)) { $conditions[] = "fe.status = ?"; $params[] = $status; }

        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }


        $sql .= " ORDER BY fe.created_at DESC";

        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
      

        if ($stmt) {
            return array('status' => true, 'msg' => 'Datos recuperados con éxito', 'data' => $data);
        } else {
            return array('status' => false, 'msg' => 'No se encontraron registros que coincidan con los filtros', 'data' => []);
        }
    } catch (Exception $e) {
        return array('status' => false, 'msg' => 'Error al recuperar los datos: ' . $e->getMessage(), 'data' => []);
    }
}*/
 

function Register_Payment($paymentPlan_id, $student_id, $year_id, $grade_id, $type_id, $orderType, $status_payment, $payment_date,$next_date, $status,$count,$isTrue) {

    if(!$isTrue){
     $duplicateResult = $this->ValidateDuplicates($student_id, $year_id, $grade_id, $type_id, $orderType,$count);
        if (!$duplicateResult['status'])   return array('status' => false, 'auth' => true, 'msg' => $duplicateResult['msg'], 'data' => '');
    }

    $sql = "INSERT INTO feepayments (paymentPlan_id, student_id, year_id, grade_id, type_id, orderType, status_payment, payment_date,next_date, status, created_at, updated_at)  VALUES (?, ?, ?, ?, ?, ?, ?, ?,?, ?, NOW(), NOW())";
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param("iiiiiiisss", $paymentPlan_id, $student_id, $year_id, $grade_id, $type_id, $orderType, $status_payment, $payment_date,$next_date, $status);

    try {
        if ($stmt->execute()) {
            return array('status' => true, 'msg' => 'Cotas de planes registrado correctamente');
        } else {
            return array('status' => false, 'msg' => 'Error en la inserción: ' . $stmt->error);
        }
    } catch (Exception $e) {
        return array('status' => false, 'msg' => 'Excepción: ' . $e->getMessage());
    }
}

/*function ValidateDuplicates($student_id, $year_id, $grade_id, $type_id, $orderType,$count,$isTrue) {
    $sql = "SELECT COUNT(*) as count 
            FROM feePayments
            WHERE student_id = ? 
            AND year_id = ?
            AND grade_id = ? "; //AND type_id = ? AND orderType = ?
    
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param("iii", $student_id, $year_id, $grade_id);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            return array('status' => false, 'msg' => 'Ya existe un registro con los mismos valores de student_id, year_id, grade_id');
        } else {
            return array('status' => true, 'msg' => 'No se encontraron duplicados');
        }
    } else {
        return array('status' => true, 'msg' => 'Error al validar duplicados: ' . $stmt->error);
    }
}*/

function ValidateDuplicates($student_id, $year_id, $grade_id, $type_id, $orderType, $count) {
    $sql = "SELECT COUNT(*) as count 
            FROM feepayments
            WHERE student_id = ? 
            AND year_id = ?
            AND grade_id = ?
            HAVING COUNT(*) >= ?";
    
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param("iiii", $student_id, $year_id, $grade_id, $count);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row !== null && $row['count'] >= $count) {
            return array('status' => false, 'msg' => 'Ya se alcanzó el límite de ' . $count . ' registros con los mismos valores de student_id, year_id, grade_id');
        } else {
            return array('status' => true, 'msg' => 'No se alcanzó el límite de ' . $count . ' registros');
        }
    } else {
        return array('status' => true, 'msg' => 'Error al validar duplicados: ' . $stmt->error);
    }
}

//obtener alumnos matriculados par ese ano
// Obtener alumnos matriculados para ese año
function GetStudentsByYear($id_year) {
    $sql = "SELECT * FROM matricula WHERE year_id = ?";
    $stmt = $this->conexion->conexion->prepare($sql);
    if ($stmt && $stmt->bind_param("i", $id_year) && $stmt->execute()) {
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    return array();
}


//verificar si aun no se a generado su cuenta de pagos
function CheckStudentInFeePayments($student_id, $grade_id, $year_id) {
    $sql = "SELECT COUNT(*) as count FROM feepayments WHERE student_id = ? AND grade_id = ? AND year_id = ?";
    
    $stmt = $this->conexion->conexion->prepare($sql);
    if (!$stmt) {
        return array('status' => false, 'msg' => 'Error al preparar la consulta: ' . $this->conexion->conexion->error);
    }
    $stmt->bind_param("iii", $student_id, $grade_id, $year_id);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $result->free();
        
        if ($row['count'] > 0) {
            return array('status' => true, 'msg' => 'Ya se a generado cotas de pagos para todo los estudiantes.');
        } else {
            return array('status' => false, 'msg' => 'El estudiante no tiene un registro en la tabla feepayments');
        }
    } else {
        $stmt->close();
        return array('status' => false, 'msg' => 'Error al verificar registro en feepayments: ' . $stmt->error);
    }
}

//optener planes
function getpayment(){
    try {
        $sql = "SELECT id , name, code, amount, status, created_at, updated_at FROM paymentplan WHERE status <> 0 ";
        $result = $this->conexion->conexion->query($sql);
        if ($result) {
            $types = array();
            while ($row = $result->fetch_assoc()) { $types[] = $row;}
            return array('status' => true, 'auth' => true, 'msg' => 'Datos recuperados con éxito', 'data' => $types);
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error al recuperar los datos: ' . $this->conexion->conexion->error, 'data' => '');
        }
    } catch (Exception $e) {
        return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
    }
}

//genera plan de pagos
function generatePaymentPlansForAllStudents($id_year,$count,$enrollment){ 

    try {
    date_default_timezone_set('America/Lima');
    $dateCurrent = new DateTime('now');
    $payment_date = $dateCurrent->format('Y-m-d H:i:s');
    $type_id=null;
    $orderType=null;
    $status_payment=0;//status_payment= Pagado 1, falta pagar 0, anulado 2
    $status=2;//activo 2 desactivo 1 eliminado 0
    $msg="";
    $next_date=null;
    $start_time = microtime(true);

       //idmatricula, Id_alumno, Id_grado, Id_aula, Id_turno, Id_nivls, cargoPago, year_id, seccion, cargoMatricula, creatDate, updateDate
       $students = $this->GetStudentsByYear($id_year);
       if(empty($students)) return array('status' => false, 'msg' => 'No hay estudiantes matriculados para el año academico seleccionado.');

        $plan = $this->getpayment();
       if(empty($plan)) return array('status' => false, 'msg' => 'no hay planes de pagos:');

        foreach ($students as $student) {
            $result = $this->CheckStudentInFeePayments($student['Id_alumno'],$student['Id_grado'],$student['year_id']);
            
            if (!$result['status']){
                //echo "El estudiante con ID $student_id ya tiene un registro en la tabla feePayments.\n";
                 $planSTD001 = array_filter($plan['data'], function($paymentPlan) { return $paymentPlan['code'] === 'STD001'; });
                 if (empty($planSTD001)) throw new Exception("Error No se encontraron planes de pago con el código 'STD001'", 1);
                    //genera cotas de pagos
                     for ($i = 0; $i < $count; $i++) {
                         $next_date = date('Y-m-d', strtotime($dateCurrent->format('Y-m-d') . ' + ' . $i . ' month'));
                         
                       $request=  $this->Register_Payment($planSTD001[0]["id"], $student['Id_alumno'], $student['year_id'], $student['Id_grado'], $type_id, $orderType, $status_payment, $payment_date,$next_date, $status,$count,false);
                          if (!$request['status'])  throw new Exception("Error al registrar planes de pago  de penciones del studiantes", 1);  


                     }
                  if($enrollment){
                   $planPRM001 = array_filter($plan['data'], function($paymentPlan) { return $paymentPlan['code'] === 'PRM001'; });
                    if (empty($planPRM001)) throw new Exception("Error No se encontraron planes de pago con el código 'PRM001'", 1);

                     $request=  $this->Register_Payment($planPRM001[1]["id"], $student['Id_alumno'], $student['year_id'], $student['Id_grado'], $type_id, $orderType, $status_payment, $payment_date,$next_date, $status,$count,true);
                          if (!$request['status'])  throw new Exception("Error al registrar planes de pago  de matriculas del studiantes", 1); 

                  }
              $msg=  $request["msg"];  
            }
        }
        $end_time = microtime(true);
        $execution_time = $end_time - $start_time;
        return array('status' => true, 'auth' => true, 'msg' => empty($msg)? $result["msg"]: $msg , 'data' => '', 'execution_time' => $execution_time);
        
    } catch (Exception $e) {
        return array('status' => false, 'msg' => 'Excepción5: ' . $e->getMessage());
    }


}



function Register_PaymentByStudent($idalum, $motoPago, $nuevafecha, $yearid, $nextMonthD) {
    $sql = "INSERT INTO registopagos (alumno_id, tipo, year_id, motoPago, stadoPago, fechasPagados,prox_pago, dateoperation) 
            VALUES (?, 'PENCION', ?, ?, 'PAGADO', ?,?, NOW())";
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param("iisss", $idalum, $yearid, $motoPago,$nextMonthD, $nuevafecha);

    try {
        if ($stmt->execute()) {
            return array('status' => true, 'msg' => 'Registro de pago guardado correctamente');
        } else {
            return array('status' => false, 'msg' => 'Error en la inserción: ' . $stmt->error);
        }
    } catch (Exception $e) {
        return array('status' => false, 'msg' => 'Excepción: ' . $e->getMessage());
    }
}

function Update_Payment_Status($idalum, $dateMayor, $fechaProximoPago, $yearid, $FechaActual) {
    $sql = "UPDATE stadopenciones 
            SET ultimoPagofecha = ?, proximoPagoFecha = ?
            WHERE entidad = ?";
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param("sss", $dateMayor, $fechaProximoPago, $idalum);

    try {
        if ($stmt->execute()) {
            return array('status' => true, 'msg' => 'Estado de pago actualizado correctamente');
        } else {
            return array('status' => false, 'msg' => 'Error en la actualización: ' . $stmt->error);
        }
    } catch (Exception $e) {
        return array('status' => false, 'msg' => 'Excepción: ' . $e->getMessage());
    }
}
  
function Update_Payment_Status_feePayments($student_id, $id_fee, $year_id,$next_date) {
    $sql = "UPDATE feepayments 
            SET status_payment = 1,
            next_date=?

            WHERE student_id = ? 
            AND id = ?
            AND year_id = ?";
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param("siii",$next_date, $student_id, $id_fee, $year_id);

    try {
        if ($stmt->execute()) {
            return array('status' => true, 'msg' => 'Estado de pago actualizado correctamente en la tabla feepayments');
        } else {
            return array('status' => false, 'msg' => 'Error en la actualización: ' . $stmt->error);
        }
    } catch (Exception $e) {
        return array('status' => false, 'msg' => 'Excepción: ' . $e->getMessage());
    }
}

    
}



 ?>