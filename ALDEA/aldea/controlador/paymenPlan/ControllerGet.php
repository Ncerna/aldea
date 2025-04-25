<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
 if (isset($_SESSION['S_NOMBRE'])) {
     setcookie("activo", 1, time() + 3600);
     $date_init = isset($_GET['date_init']) ? $_GET['date_init'] : null;
     $date_end = isset($_GET['date_end']) ? $_GET['date_end'] : null;
      $search = isset($_GET['search']) ? $_GET['search'] : null;
      $status = isset($_GET['status']) ? $_GET['status'] : null;
     
          require '../../modelo/model_paymentPlan.php';
        $type = new PaymentPlan();
        
        $consulta = $type->get_paymentesPlan($date_init,$date_end,$search,$status);

        if($consulta){
        echo json_encode($consulta);
          }else{
        echo '{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
           }';
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