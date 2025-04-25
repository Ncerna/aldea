<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
 if (isset($_SESSION['S_USER'])) {
     setcookie("activo", 1, time() + 3600);

       $start = htmlspecialchars(isset($_POST['start']),ENT_QUOTES,'UTF-8');
         $end = htmlspecialchars(isset($_POST['end']),ENT_QUOTES,'UTF-8');
     
        require '../../modelo/model_entry.php';
        $entry = new Entry();
        $entrycurrent =$entry->get_entry($start,$end);
        $paymentrecord =$entry->get_entry2($start,$end);

        // $arreglo["data"] = ($entrycurrent["data"] ?? []) + ($paymentrecord["data"] ?? []);

          $combinedEntries = array_merge_recursive($entrycurrent, $paymentrecord);

        if(!empty($combinedEntries)){
        echo json_encode($combinedEntries);
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