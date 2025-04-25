<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 if (isset($_SESSION['S_USER'])) {
     setcookie("activo", 1, time() + 3600);

     $idpetty=htmlspecialchars($_POST['idpetty'],ENT_QUOTES,'UTF-8');
         $pettycashname=htmlspecialchars($_POST['pettycashname'],ENT_QUOTES,'UTF-8');
           $amountmax=htmlspecialchars($_POST['amountmax'],ENT_QUOTES,'UTF-8');
             $amountmin=htmlspecialchars($_POST['amountmin'],ENT_QUOTES,'UTF-8');
              $iscurrent=htmlspecialchars($_POST['iscurrent'],ENT_QUOTES,'UTF-8');
                 $date_create=htmlspecialchars($_POST['date_create'],ENT_QUOTES,'UTF-8');
     
       require '../../Modelo/model_pettycash.php';
        $pettycash = new PettyCash();
        $consulta =$pettycash->Register_pettycash($pettycashname, $amountmax, $amountmin,$iscurrent);

        echo json_encode($consulta);
        $response = array('status' => false, 'auth' => false, 'msg' => 'No Autorizado', 'data' => '');
        echo json_encode($response);
          
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