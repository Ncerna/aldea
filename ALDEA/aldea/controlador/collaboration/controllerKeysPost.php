<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (isset($_SESSION['S_USER'])) {
     setcookie("activo", 1, time() + 3600);
     
     try{

        $key = isset($_POST['key'])? htmlspecialchars($_POST['key'],ENT_QUOTES,'UTF-8') : '';
         $id = isset($_POST['id'])? htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8') : '';
       
        if(empty($key)) throw new Exception("Deves ingresar un clave", 1);
        if(empty($id)) throw new Exception("Deves ingresar el studiante.", 1);
        
         require '../../modelo/model_collaboration.php';
        $collaboration = new Collaboration();
         $exists = $collaboration->checkExists($id);
         if(empty($exists)){
               $response =$collaboration->Register_key($id, $key); 
         }else{
            $response =$collaboration->Update_key($exists['id_keys'],$id, $key);
         }

       
         echo json_encode($response);

       } catch (Exception $e) {
        $response = array('status' => false, 'auth' => false, 'msg' => 'Error: ' . $e->getMessage(), 'data' => '', 'tipo' => 'alert-danger');
        echo json_encode($response);
        }

    } else {
        $response = array('status' => false, 'auth' => false, 'msg' => 'No Autorizado', 'data' => '');
        echo json_encode($response);
        return;
    }

}else {
    $response = array('status' => false,'auth' => false,'msg' => 'SOLO SE PUEDE POST.','data'=> '' ,'tipo'=>'alert-danger');
    echo json_encode($response);
}

 ?>