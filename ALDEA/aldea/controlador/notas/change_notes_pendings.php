<?php
session_start();
if (!empty($_SESSION['S_ROL'])) {
    $iddocente = $_SESSION['S_IDUSUARIO'];
    $datosJson = file_get_contents('php://input');
    $notasStudent = json_decode($datosJson, true);
    require '../../modelo/modelo_notas.php';
    $notes = new Nota();
    try {
        if (!empty($notasStudent) && is_array($notasStudent)) {
            foreach ($notasStudent as $alumno) {
                if (isset($alumno['alumno_id']) && isset($alumno['notas']) && is_array($alumno['notas'])) {
                    $alumno_id = $alumno['alumno_id'];
                    foreach ($alumno['notas'] as $nota) {
                        if (isset($nota['ordentio'], $nota['nota'], $nota['idpond'])) {
                            $ordentio = $nota['ordentio'];
                            $notaacum = $nota['nota'];
                            $idpond = $nota['idpond'];
                            $response = $notes->UpdateNotesByStudents($idpond, $alumno_id, $ordentio, $notaacum, $iddocente);
                        }
                    }
                }
            }
            echo json_encode($response);
        } else {
            echo json_encode(array('status' => false, 'msg' => 'No hay notas para procesar.'));
        }
    } catch (Exception $e) {
        echo json_encode(array('status' => false, 'msg' => $e->getMessage()));
    }
}
?>