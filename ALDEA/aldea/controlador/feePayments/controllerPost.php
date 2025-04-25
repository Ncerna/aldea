<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (isset($_SESSION['S_NOMBRE'])) {
     setcookie("activo", 1, time() + 3600);
      try{

        $id = isset($_POST['id']) ? htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8') : null;
   
        $student_id = htmlspecialchars($_POST['student_id'], ENT_QUOTES, 'UTF-8');
        $year_id = htmlspecialchars($_POST['year_id'], ENT_QUOTES, 'UTF-8');
        $grade_id = htmlspecialchars($_POST['grade_id'], ENT_QUOTES, 'UTF-8');
        $type_id = htmlspecialchars($_POST['type_id'], ENT_QUOTES, 'UTF-8');//--(bimestre,trimestre,osemestre)
        $orderType = htmlspecialchars($_POST['orderType'], ENT_QUOTES, 'UTF-8');//--(1°,2°....)
        $status_payment = htmlspecialchars($_POST['status_payment'], ENT_QUOTES, 'UTF-8'); //status_payment= Pagado 1, falta pagar 0, anulado 2
        $payment_date = htmlspecialchars($_POST['payment_date'], ENT_QUOTES, 'UTF-8');//fecha actual fcha y hora
        $status = htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8');//activo 2 desactivo 1 eliminado 0
        $enrollment = filter_var($_POST['enrollment'], FILTER_VALIDATE_BOOLEAN); //falso o verdadero
        $count = htmlspecialchars($_POST['count'], ENT_QUOTES, 'UTF-8'); //generear numero de cotas de pago para es studiante

      
        
        require '../../modelo/model_feePayments.php';
        $feepayment = new FeePayments();

          require '../../modelo/model_paymentPlan.php';
        $type = new PaymentPlan();
         $plan = $type->getpayment();

         if ($plan['status']) {

             $planSTD001 = array_filter($plan['data'], function($paymentPlan) {
                 return $paymentPlan['code'] === 'STD001';
               });

                if (empty($planSTD001)) throw new Exception("Error No se encontraron planes de pago con el código 'STD001'", 1);

                for ($i = 0; $i < $count; $i++) {
                    if(empty( $id )){

                        $response = $feepayment->Register_Payment($planSTD001["id"], $student_id, $year_id, $grade_id, $type_id, $orderType, $status_payment, $payment_date, $status);

                            if (!$response['status'])  throw new Exception("Error Processing generate paymen paln", 1);    
                    }else{
                     $response =$type->Update_Payment();
                     if (!$response['status'])  throw new Exception("Error Processing update paymen plan", 1);  
                   }
               }

           if ($enrollment ) {

             $planPRM001 = array_filter($plan['data'], function($paymentPlan) {
                 return $paymentPlan['code'] === 'PRM001';
               });

              if (empty($planPRM001)) throw new Exception("Error No se encontraron planes de pago con el código 'PRM001'", 1);
    
                $response = $feepayment->Register_Enrollment($planPRM001["id"], $student_id, $year_id, $grade_id, $type_id, $orderType, $status_payment, $payment_date, $status);

                if (!$response['status'])   throw new Exception("Error Processing include Enrollment", 1);
                
          }


         }else {
            $response["msg"] = "Error: " . $plan['msg'];
        }
          
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