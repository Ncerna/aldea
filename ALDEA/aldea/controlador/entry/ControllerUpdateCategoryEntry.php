<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (isset($_SESSION['S_USER'])) {
     setcookie("activo", 1, time() + 3600);

         $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
          $categoryentry_name=htmlspecialchars($_POST['categoryentry'],ENT_QUOTES,'UTF-8');
          $date_create = htmlspecialchars($_POST['date_create'],ENT_QUOTES,'UTF-8');
     
        require '../../modelo/model_categoryEntry.php';
        $categoryentry = new CategoryEntry();

      

        $response =$categoryentry->Update_categoryentry($id, $categoryentry_name);
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
