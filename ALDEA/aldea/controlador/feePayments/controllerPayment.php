<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (isset($_SESSION['S_NOMBRE'])) {
     setcookie("activo", 1, time() + 3600);
      try{
        $amount = htmlspecialchars($_POST['amount'], ENT_QUOTES, 'UTF-8');
        $student_id = htmlspecialchars($_POST['student_id'], ENT_QUOTES, 'UTF-8');
        $id_fee = htmlspecialchars($_POST['id_fee'], ENT_QUOTES, 'UTF-8');
        $id_year = htmlspecialchars($_POST['id_year'], ENT_QUOTES, 'UTF-8');
         $next_date = htmlspecialchars($_POST['next_date'], ENT_QUOTES, 'UTF-8');
        if (empty($amount))  throw new Exception('Campo "amount" vacío.');
        if (empty($student_id)) throw new Exception('Campo "student_id" vacío.');
        if (empty($id_fee))   throw new Exception('Campo "id_fee" vacío.');
        if (empty($id_year))   throw new Exception('Campo "year is requeried" vacío.');
        if (empty($next_date))   throw new Exception('Ingrese la fecha de pago.');
        date_default_timezone_set('America/Lima');
        $currentD = date('Y-m-d');
        $masUnMes = strtotime('+1 month', strtotime($currentD));
        $nextMonthD = date('Y-m-d', $masUnMes);

        require '../../modelo/model_feePayments.php';
         $feepayment = new FeePayments();

        // Llamar a las tres funciones
        $result1 = $feepayment->Register_PaymentByStudent($student_id, $amount, date('Y-m-d H:i:s'),$id_year, $nextMonthD);
        if (!$result1['status']) {
            $response = array('status' => false, 'auth' => false, 'msg' => 'Error en la inserción: ' . $result1['msg'], 'data' => '', 'tipo' => 'alert-danger');
            echo json_encode($response);
            return;
        }
      
        $result2 = $feepayment->Update_Payment_Status($student_id,  $currentD, $nextMonthD, $id_year, $currentD);
        if (!$result2['status']) {
            $response = array('status' => false, 'auth' => false, 'msg' => 'Error en la actualización: ' . $result2['msg'], 'data' => '', 'tipo' => 'alert-danger');
            echo json_encode($response);
            return;
        }

        $result3 = $feepayment->Update_Payment_Status_feePayments($student_id, $id_fee, $id_year,$next_date);
        if (!$result3['status']) {
            $response = array('status' => false, 'auth' => false, 'msg' => 'Error en la actualización: ' . $result3['msg'], 'data' => '', 'tipo' => 'alert-danger');
            echo json_encode($response);
            return;
        }

        // Si todas las funciones tienen éxito
        $response = array('status' => true, 'auth' => true, 'msg' => 'Datos procesados exitosamente.', 'data' => '', 'tipo' => 'alert-success');
        echo json_encode($response);

      } catch (Exception $e) {
        $response = array('status' => false, 'auth' => false, 'msg' => 'Error: ' . $e->getMessage(), 'data' => '', 'tipo' => 'alert-danger');
        echo json_encode($response);
        }

    } else {
        $response = array('status' => false, 'auth' => false, 'msg' => 'No Autorizado', 'data' => '');
        http_response_code(403);
        echo json_encode($response);
        return;
    }

}else {
    $response = array('status' => false,'auth' => false,'msg' => 'SOLO SE PUEDE POST.','data'=> '' ,'tipo'=>'alert-danger');
    http_response_code(405);
    echo json_encode($response);
}

 ?>