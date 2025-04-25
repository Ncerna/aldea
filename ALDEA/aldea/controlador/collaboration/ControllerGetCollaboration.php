<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
 if (isset($_SESSION['S_USER'])) {
     setcookie("activo", 1, time() + 3600);

       try{
         $start = isset($_GET['start']) ? $_GET['start'] : "";
         $end = isset($_GET['end']) ? $_GET['end'] : "";
         $search = isset($_GET['search']) ? $_GET['search'] : "";
         $id_user = isset($_GET['id']) ? $_GET['id'] : "";
         $page = isset($_GET['paginate']) ? $_GET['paginate'] : 1;
         $xpage = 10; // Número de elementos por página
         $status=1;
     
         require '../../modelo/model_collaboration.php';
        $collaboration = new Collaboration();
         $response =$collaboration ->get_collaboration($start,$end,$search, $id_user,$page,$xpage,$status);
        if(!empty( $response)){
        echo json_encode( $response);
          }else{
        echo '{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
           }';
         }
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