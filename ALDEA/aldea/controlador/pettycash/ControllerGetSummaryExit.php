<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
 if (isset($_SESSION['S_USER'])) {
     setcookie("activo", 1, time() + 3600);

       $start = htmlspecialchars(isset($_POST['start']),ENT_QUOTES,'UTF-8');
         $end = htmlspecialchars(isset($_POST['end']),ENT_QUOTES,'UTF-8');
     
        require '../../modelo/model_exit.php';
        $exit = new Exits();
        $consulta =$exit->get_exit($start,$end);

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
    $response = array('status' => false,'auth' => false,'msg' => 'SOLO SE PUEDE POST.','data'=> '' ,'tipo'=>'alert-danger');

    echo json_encode($response);
}

 ?>