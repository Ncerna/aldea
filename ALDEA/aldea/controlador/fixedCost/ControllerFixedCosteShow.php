<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (isset($_SESSION['S_USER'])) {
     setcookie("activo", 1, time() + 3600);

     $idfixed = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
     
        require '../../modelo/model_fixedcoste.php';
        $fixedcoste = new FixedCoste();
        $consulta =$fixedcoste->ShowFixedCoste($idfixed);
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