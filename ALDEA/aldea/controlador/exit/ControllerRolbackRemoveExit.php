<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (isset($_SESSION['S_USER'])) {
       setcookie("activo", 1, time() + 3600);

       $idexit = htmlspecialchars($_POST['idexit'],ENT_QUOTES,'UTF-8');
       
       
       require '../../modelo/model_exit.php';
       $exit = new Exits();
       $consulta =$exit->Remove_exit($idexit);

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