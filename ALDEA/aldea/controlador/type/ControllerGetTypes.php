<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
 if (isset($_SESSION['S_NOMBRE'])) {
     setcookie("activo", 1, time() + 3600);
     $date_init = isset($_GET['params']['date_init']) ? $_GET['params']['date_init'] : null;
     $date_end = isset($_GET['params']['date_end']) ? $_GET['params']['date_end'] : null;
      $search = isset($_GET['params']['search']) ? $_GET['params']['search'] : null;
     
          require '../../modelo/model_type.php';
        $type = new Type();
        
        $consulta = $type->get_types($date_init,$date_end,$search);

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