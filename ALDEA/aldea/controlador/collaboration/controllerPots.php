<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (isset($_SESSION['S_USER'])) {
     setcookie("activo", 1, time() + 3600);
     
     try{

        $id = isset($_POST['id'])? htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8') : '';
        $namePeople=htmlspecialchars($_POST['namePeople'],ENT_QUOTES,'UTF-8');
        $lastName = htmlspecialchars($_POST['lastName'],ENT_QUOTES,'UTF-8');
        $numbreCi = htmlspecialchars($_POST['numbreCi'],ENT_QUOTES,'UTF-8');
        $description=htmlspecialchars($_POST['description'],ENT_QUOTES,'UTF-8');
        $payment = htmlspecialchars($_POST['payment'],ENT_QUOTES,'UTF-8');
        $amount = htmlspecialchars($_POST['amount'],ENT_QUOTES,'UTF-8');
       
        $category_id = htmlspecialchars($_POST['category'],ENT_QUOTES,'UTF-8');

        if(empty($namePeople) || empty($lastName) ) throw new Exception("El nombre y apellidos son es querridos", 1);
        if(empty($numbreCi)) throw new Exception("Deves ingresar el numero CI.", 1);
        if(empty($amount)) throw new Exception("Ingresa el monto", 1);
        if (!is_numeric($amount) || intval($amount) != $amount) throw new Exception("monto debe ser númerico.", 1);
        
         require '../../modelo/model_collaboration.php';
        $collaboration = new Collaboration();
        if(empty($id)){
         $response =$collaboration->Register($id,$namePeople,$lastName,$numbreCi, $description, $payment, $amount,$category_id);   
        }else{
        $response =$collaboration->Register_Update($id,$namePeople,$lastName,$numbreCi, $description, $payment, $amount,$category_id);
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