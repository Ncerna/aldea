<?php
header('Content-Type: application/json');

$idyear = isset($_GET['idyear']) ? $_GET['idyear'] : null;
$id_student = isset($_GET['id_student']) ? $_GET['id_student'] : null;
$id_couse = isset($_GET['id_couse']) ? $_GET['id_couse'] : null;
$idnivel = isset($_GET['idnivel']) ? $_GET['idnivel'] : null;
$section = isset($_GET['section']) ? $_GET['section'] : null;
$gradoId = isset($_GET['gradoId']) ? $_GET['gradoId'] : null;

try {
    require '../../modelo/modelo_notas.php';
   $MU = new Nota();

  $result = $MU->getPendingOrFailedCourses($idyear,$id_student,$id_couse,$idnivel,$section,$gradoId);

  echo json_encode($result);

} catch (Exception $e) {
    // Manejo de errores
    echo json_encode(array('status' => false, 'msg' => $e->getMessage()));
}

?>

