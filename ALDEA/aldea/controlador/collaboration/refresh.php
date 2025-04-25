<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
 if (isset($_SESSION['S_USER'])) {
     setcookie("activo", 1, time() + 3600);
     
     try {
			require '../../modelo/model_collaboration.php';
			$collaboration = new Collaboration();
		
			// Llamar a la función getStudents
			$students = $collaboration->getStudents();
		
			// Validar el estado de la respuesta
			$keys = $students['status'] ? $students['data'] : exit(json_encode($students));
		
			// Iterar sobre los resultados
			foreach ($keys as $value) {
				// Generar una nueva clave basada en la fecha y hora
				$keysNew = $value['id_students'] . date('YmdHis');
				$primerosCincoCaracteres = substr($keysNew, 0, 5);
		
				// Intentar actualizar cada registro
				$response = $collaboration->UpdateKeysStudentsById(
					$value['id_keys'],
					$value['id_students'],
					$primerosCincoCaracteres
				);
		
				// Lanzar una excepción si hay un error
				if (!$response['status']) {
					throw new Exception("Error: " . $response['msg']);
				}
			}
		    echo json_encode($response);

		} catch (Exception $e) {
		    // Manejar la excepción y devolver el mensaje de error
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