<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (isset($_SESSION['S_USER'])) {
     setcookie("activo", 1, time() + 3600);

         $identry = htmlspecialchars($_POST['identry'],ENT_QUOTES,'UTF-8');
        $description=htmlspecialchars($_POST['description'],ENT_QUOTES,'UTF-8');
        $payment = htmlspecialchars($_POST['payment'],ENT_QUOTES,'UTF-8');
        $amount = htmlspecialchars($_POST['amount'],ENT_QUOTES,'UTF-8');
        $dateoperation = htmlspecialchars($_POST['dateoperation'],ENT_QUOTES,'UTF-8');
        $category_id = htmlspecialchars($_POST['category'],ENT_QUOTES,'UTF-8');
     
         require '../../modelo/model_entry.php';
        $entry = new Entry();
        $response =$entry->Update_entry($identry, $description, $payment, $amount, $dateoperation, (int)$category_id );
         echo json_encode($response);

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