
<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
 if (isset($_SESSION['S_NOMBRE'])) {
     setcookie("activo", 1, time() + 3600);

            $paymentPlan_id = isset($_GET['paymentPlan_id']) ? $_GET['paymentPlan_id'] : null;
			$student_id = isset($_GET['student_id']) ? $_GET['student_id'] : null;
			$year_id = isset($_GET['year_id']) ? $_GET['year_id'] : null;
			$grade_id = isset($_GET['grade_id']) ? $_GET['grade_id'] : null;
			$type_id = isset($_GET['type_id']) ? $_GET['type_id'] : null;
			$orderType = isset($_GET['orderType']) ? $_GET['orderType'] : null;
			$status_payment = isset($_GET['status_payment']) ? $_GET['status_payment'] : null;
			$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
			$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
			$status = isset($_GET['status']) ? $_GET['status'] : null;

			require '../../modelo/model_feePayments.php';
			$feepayment = new FeePayments();
			$consulta = $feepayment->get_feePayments($paymentPlan_id, $student_id, $year_id, $grade_id, $type_id, $orderType, $status_payment, $start_date, $end_date, $status);

			if ($consulta['status']) {
				if(empty($student_id)){
				    $data = $consulta['data'];
					    $uniqueStudentIds = array_unique(array_column($data, 'student_id'));

						    $result = array();
						    foreach ($uniqueStudentIds as $studentId) {
						        $studentData = array_filter($data, function($item) use ($studentId) {
						            return $item['student_id'] == $studentId;
						        });
						        if (!empty($studentData)) {
						            $firstItem = reset($studentData);
						            $result[] = $firstItem;
						        }
						    }

					 $consulta['data'] = $result;
					 echo json_encode($consulta);
					 return;
				}
                echo json_encode($consulta);
			} else {
			    echo '{
			        "sEcho": 1,
			        "iTotalRecords": "0",
			        "iTotalDisplayRecords": "0",
			        "aaData": []
			    }';
			}  
          /*require '../../modelo/model_feePayments.php';
	        $feepayment = new FeePayments();
	        $consulta = $feepayment->get_feePayments($paymentPlan_id, $student_id, $year_id, $grade_id, $type_id, $orderType, $status_payment, $start_date, $end_date, $status);
	        if($consulta){
	        echo json_encode($consulta);
	          }else{
	        echo '{
	            "sEcho": 1,
	            "iTotalRecords": "0",
	            "iTotalDisplayRecords": "0",
	            "aaData": []
	           }';
	         }*/

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