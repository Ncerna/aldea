<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (isset($_SESSION['S_NOMBRE'])) {
     setcookie("activo", 1, time() + 3600);
      try{
         $id = isset($_POST['id'])? htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8') : null;
         $typeName=htmlspecialchars($_POST['typeName'],ENT_QUOTES,'UTF-8');
         $typeAmount=htmlspecialchars($_POST['typeAmount'],ENT_QUOTES,'UTF-8');
          $typeDate=htmlspecialchars($_POST['typeDate'],ENT_QUOTES,'UTF-8');
          $typeStado=htmlspecialchars($_POST['typeStado'],ENT_QUOTES,'UTF-8');

          if(empty($typeName)) throw new Exception("Ingrese el nombre", 1);
          if(empty($typeAmount)) throw new Exception("Ingrese monto", 1);
          if ($typeStado === '') throw new Exception("Debe seleccionar el estado", 1);

         require '../../modelo/model_paymentPlan.php';
        $type = new PaymentPlan();

          if(empty( $id )){
            $response =$type->Register_PaymentPlan($id, $typeName,"FAC-GLOB",$typeAmount, $typeStado);
            // $response =$type->Register_type($id, $name, $of_rank, $stado);
             // throw new Exception("Por ahora, solo puedes cambiar el nombre de los tipos existentes. Gracias por tu comprensión.", 1);

          }else{
             $response =$type->Update_PaymentPlan($id, $typeName, $typeAmount, $typeStado);
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