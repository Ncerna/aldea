<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_SESSION['S_USER'])) {
        setcookie("activo", 1, time() + 3600);
        $id_student = empty($_GET['id_studentd']) || $_GET['id_studentd'] == 'undefined' ? $_SESSION['S_IDENTYTI'] : $_GET['id_studentd'];
         $idyear = $_GET['idyear'];

        if (empty($id_student)) exit(json_encode(["error" => "Student_not_found"]));
        ob_start();
        require '../../modelo/modelo_matricula.php';
        $mat = new Matricula();
        ob_end_clean();
        $student = $mat->getStudentById($id_student, $idyear);
        $school = $mat->getSchool();
        echo json_encode(["student" => $student, "school" => $school]);
    } else {
        echo json_encode(["error" => "Student ID not provided.".$_SESSION['S_USER']]);
    }
} else {
    $response = array('status' => false, 'auth' => false, 'msg' => 'No Autorizado', 'data' => '');
    http_response_code(403);
    echo json_encode($response);
    return;
}

?>
