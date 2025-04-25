<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
 if (isset($_SESSION['S_NOMBRE'])) {
     setcookie("activo", 1, time() + 3600);
      try{

        $id_year = htmlspecialchars($_GET['id_year'], ENT_QUOTES, 'UTF-8');
        $count = htmlspecialchars($_GET['count'], ENT_QUOTES, 'UTF-8');
        $enrollment = filter_var($_GET['enrollment'], FILTER_VALIDATE_BOOLEAN); //falso o verdadero
         require '../../modelo/model_feePayments.php';
         $feepayment = new FeePayments();
         if (empty($id_year)) throw new Exception('El valor de year académico está vacío');
        if (empty($count)) throw new Exception('El valor de contador está vacío');
        if ($enrollment === false) throw new Exception('El valor de seleccione uno al menos  está vacío');


        $response= $feepayment->generatePaymentPlansForAllStudents($id_year,$count,$enrollment);
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
    $response = array('status' => false,'auth' => false,'msg' => 'SOLO SE PUEDE GET.','data'=> '' ,'tipo'=>'alert-danger');
    http_response_code(405);
    echo json_encode($response);
}

 ?>