<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (isset($_SESSION['username'])) {
     setcookie("activo", 1, time() + 3600);
     
     $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
      $name=htmlspecialchars($_POST['name'],ENT_QUOTES,'UTF-8');
     $description=htmlspecialchars($_POST['description'],ENT_QUOTES,'UTF-8');

       
        require '../../Models/model_category.php';
        $category = new Category();
        $response =$category->Update_category($id, $name, $description, '', $status=1);
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