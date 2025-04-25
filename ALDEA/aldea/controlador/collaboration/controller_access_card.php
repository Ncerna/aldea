<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
 if (isset($_SESSION['S_USER'])) {
     setcookie("activo", 1, time() + 3600);
     
     try{

        
        $key_access = isset($_GET['key_access']) ? $_GET['key_access'] : '';
        $idyear = isset($_GET['id_year'])? htmlspecialchars($_GET['id_year'],ENT_QUOTES,'UTF-8') : '';
        
       if(empty($key_access)) throw new Exception("Debes ingresar una clave", 1);
       if(empty($idyear)) throw new Exception("Ingrese el año académico", 1);
      
        
         require '../../modelo/model_collaboration.php';
        $collaboration = new Collaboration();
        $exists = $collaboration->checkExistskeyStudent($key_access);
        if(empty($exists)) throw new Exception("La clave ingresada no existe", 1);
        $exists = $exists[0];
       

        if(empty($exists)) throw new Exception("La clave ingresada no existe", 1);
        $response = $collaboration->getDatesStudentsById($exists['id_students'], $idyear); 
        if(empty($response))  throw new Exception("No se encontraron datos del estudiante", 1);

        $response = array('status' => true, 'auth' => true, 'msg' => 'Datos encontrados correctamente', 'data' => $response);
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
    $response = array('status' => false,'auth' => false,'msg' => 'SOLO SE PUEDE GET.','data'=> '' ,'tipo'=>'alert-danger');
    echo json_encode($response);
}

 ?>