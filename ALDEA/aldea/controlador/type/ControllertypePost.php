<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (isset($_SESSION['S_NOMBRE'])) {
     setcookie("activo", 1, time() + 3600);
      try{
         $id = isset($_POST['id'])? htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8') : null;
         $name=htmlspecialchars($_POST['name'],ENT_QUOTES,'UTF-8');
         $of_rank=htmlspecialchars($_POST['of_rank'],ENT_QUOTES,'UTF-8');
          $stado=htmlspecialchars($_POST['stado'],ENT_QUOTES,'UTF-8');

          if(empty($name)) throw new Exception("Ingrese el nombre", 1);
          if(empty($of_rank)) throw new Exception("Ingrese el numero de cuantos compone este tipo", 1);
          if(empty($stado)) throw new Exception("Deves selecciommar el estado", 1);

        require '../../modelo/model_type.php';
        $type = new Type();

          if(empty( $id )){
            // $response =$type->Register_type($id, $name, $of_rank, $stado);
              throw new Exception("Por ahora, solo puedes cambiar el nombre de los tipos existentes. Gracias por tu comprensión.", 1);

          }else{
             $response =$type->Update_type($id, $name, $of_rank, $stado);
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