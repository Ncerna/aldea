<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (isset($_SESSION['S_USER'])) {
     setcookie("activo", 1, time() + 3600);
          
          $fixedcoste_id=null;
          $idexit = htmlspecialchars($_POST['idexit'],ENT_QUOTES,'UTF-8');
          $description=htmlspecialchars($_POST['description'],ENT_QUOTES,'UTF-8');
          $payment = htmlspecialchars($_POST['payment'],ENT_QUOTES,'UTF-8');
          $amount = htmlspecialchars($_POST['amount'],ENT_QUOTES,'UTF-8');
          $dateoperation=htmlspecialchars($_POST['dateoperation'],ENT_QUOTES,'UTF-8');
          $beneficiary = htmlspecialchars($_POST['beneficiary'],ENT_QUOTES,'UTF-8');
          $category_id=htmlspecialchars($_POST['cmb_category'],ENT_QUOTES,'UTF-8');
          if(isset($_POST['fixed_expenses'])) $fixedcoste_id = htmlspecialchars($_POST['fixed_expenses'],ENT_QUOTES,'UTF-8');

        require '../../modelo/model_exit.php';
        $exit = new Exits();
        $consulta =$exit->Register_exit($idexit, $description, $payment, $amount, $beneficiary,$dateoperation,$category_id,$fixedcoste_id);

        echo json_encode($consulta);
          
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