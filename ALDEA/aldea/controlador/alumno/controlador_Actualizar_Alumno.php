<?php

// Activar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require '../../modelo/modelo_alumnos.php';
    $MU = new Alumno();

     header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['student'])) {}
    $student = $data['student'];

   // Acceder a los datos del estudiante
    $idalumno = $student['idalumnoedit'];
    $apellp = $student['apellp'];
    $nombre = $student['nomb'];
    $fechaN = $student['fechaN'];
    $dni = $student['dni'];
    $telf = $student['telf'];
    $codi = $student['codi'];
    $sexo = $student['sex'];
    $direccion = $student['direccion'];

    // Datos de los padres
    $nom_pade = $student['nom_pade'];
    $apell_pade = $student['apell_pade'];
    $dni_pade = $student['dni_pade'];
    $nom_madre = $student['nom_madre'];
    $apell_madre = $student['apell_madre'];
    $dni_madre = $student['dni_madre'];
    // Datos escolares
    $nom_cole = $student['nom_cole'];
    $nom_direc = $student['nom_direc'];
    $cole_codig = $student['cole_codig'];

    $mail = $student['mail'];
    $country = $student['country'];
    $age = !empty($student['age']) ? $student['age'] : 0;
    $province = $student['province'];
    $municipality = $student['municipality'];
    $others = $student['others'];

     $planeStudy = $student['planeStudy'];
    $especiality = $student['especiality'];
    // Datos de procedencia
    $procedente = $student['procedente']; 
    $telf_padre = $student['telf_padre']; 
    $direc_padre = $student['direc_padre']; 
    $email_padre = $student['email_padre']; 
     $autorizado1_nombre = $student['autorizado1_nombre'];
        $autorizado1_apellido = $student['autorizado1_apellido'];
        $autorizado1_parentesco = $student['autorizado1_parentesco'];
        $autorizado2_nombre = $student['autorizado2_nombre'];
        $autorizado2_apellido = $student['autorizado2_apellido'];
        $autorizado2_parentesco = $student['autorizado2_parentesco'];


  // $Existe= $MU->Verificar_Existencia($apellp,$nombre,$dni,$codi);
    //if($Existe==0){

       $MU->Actualizar_New_Alumno($idalumno,$apellp,$nombre,$fechaN, $dni,$telf,$codi,$sexo,$direccion,$mail,$country,$age,$province,$municipality,$others,$planeStudy,$especiality);

     $consulta = $MU->Actualizar_New_Apoderados($idalumno,$nom_pade,$apell_pade,$dni_pade,$nom_madre,$apell_madre,$dni_madre,$nom_cole, $nom_direc,$cole_codig,$telf_padre,$direc_padre, $email_padre);

      // Insertar o actualizar los datos de los autorizados
       

        // Insertar datos de los autorizados en la tabla `autorizados`
        $consulta_autorizados = $MU->Actualizar_New_Autorizados($idalumno, $autorizado1_nombre, $autorizado1_apellido, $autorizado1_parentesco, $autorizado2_nombre, $autorizado2_apellido, $autorizado2_parentesco);
        if (!$consulta_autorizados) {
            echo json_encode(['error' => 'Error al registrar autorizados']);
            exit;
        }

        // Insertar datos de procedencia si existen

       if(!empty($procedente)) {
            foreach ($procedente as $item) {
                if ($item['id'] === null) {
                     $MU->registrarNuevoProcedente($item['id'],$idalumno,$item['nombre'],$item['localidad'],$item['ep_data'],$item['yeard']);
                } else {
                   
                     $MU-> actualizarProcedente($item['id'],$idalumno,$item['nombre'],$item['localidad'],$item['ep_data'],$item['yeard']);
                }
            }

          }
   
    echo  $consulta;
//}else{
   // echo 100;
//}

?>