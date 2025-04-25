<?php
    class Grado{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }

        function listar_combo_grados(){
         $sql = "SELECT idgrado, gradonombre FROM grado";
          $arreglo = array();
           if ($consulta = $this->conexion->conexion->query($sql)) {
           while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
           }
          return $arreglo;
           $this->conexion->cerrar();
      }
}

//VERIFICAR SI YA EXSISTE EL GRADO CON ESOSO PARAMETROS
function Verificacion_Grado_existe($nombre, $turno,$nivel, $seccion,$aula,$yearid){
  $sql  = "select gradonombre, turno_id,nivel_id, seccion,aula_id,year_id from grado
           where gradonombre='$nombre'and turno_id='$turno'and nivel_id='$nivel'and  seccion='$seccion'and aula_id='$aula' and year_id='$yearid'";     
            $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
           while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                   $arreglo['data'][]=$consulta_VU;
                }
           return count($arreglo);
           $this->conexion->cerrar();

          }
    }


//REGISTRAR GRADOS
function Registrar_Grado($idGrado,$nombre, $turno,$nivel, $seccion,$aula,$vacantes,$yearid){
 $sql = "insert into grado(gradonombre, aula_id, turno_id, nivel_id, vacantes, seccion, fechaRegistro, fechaActualizacion, gradostatus,year_id) values ( '$nombre', '$aula','$turno','$nivel','$vacantes','$seccion',NOW(),NOW(),'ACTIVO','$yearid')";
     
            if ($consulta = $this->conexion->conexion->query($sql)) {
                $this->cambiarestadoAula($aula);
             return 1;  
               }else{
                return 0;
           }
    }
//CAMBIAR ESTADO DE AULA CUANDO SE ASIGNA A UN GRADO
function cambiarestadoAula($aula){
     $sql = "update aula set status = 'OCUPADO' where idaula = '$aula'";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
            }else{
                return 0;
            }
}

function Update_Grado($idGrado,$nombre, $turno,$nivel, $seccion,$aula,$vacantes){
    $sql = "update grado set gradonombre = '$nombre',aula_id='$aula',turno_id='$turno',nivel_id='$nivel',vacantes='$vacantes',seccion='$seccion', fechaActualizacion=NOW()  where idgrado = '$idGrado'";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
            }else{
                return 0;
            }
}

function listar_Config_gradosAll(){

  $sql = "select idgrado, gradonombre,nombreNivell,seccion from grado  inner join  niveles on niveles.idniveles = grado.nivel_id";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo["data"][]=$consulta_VU;

                }
                return $arreglo;
                $this->conexion->cerrar();
            }
}


   function listar_grados(){ 
          $sql = "select idgrado, gradonombre, nivel_id,nombreNivell,seccion,aula_id,nombreaula,grado.turno_id,turno_nombre,vacantes from grado
                      inner join  aula on aula.idaula = grado.aula_id
                      inner join  turnos on turnos.turno_id = grado.turno_id
                      inner join  niveles on niveles.idniveles = grado.nivel_id";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo["data"][]=$consulta_VU;

                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }


function Eliminar_Grado($idgrado){
  $sql=   "DELETE FROM grado WHERE idgrado = '$idgrado'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
        
      }else{
        return 0;
      }
}


function Registro_Curso_Grado($idgrado,$arreglo,$yearid,$idseccion){
 $sql = "insert into grado_curso(grado_id, curso_id, yearEscolar,Idseccion, dateRegistro, dateUpdate)
  values ('$idgrado','$arreglo','$yearid','$idseccion' ,NOW(),NOW())";
     
            if ($consulta = $this->conexion->conexion->query($sql)) {
             return 1;
                
               }else{
                return 0;
              }
}


function VerificarSiCursoYaEstaAgregadoParaElGrado($idgrado,$arreglo,$yearid){
  $sql = "select grado_id, curso_id, yearEscolar from grado_curso where grado_id='$idgrado'  and curso_id='$arreglo' and  yearEscolar='$yearid' ";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo[]=$consulta_VU;

                }
                return count($arreglo);
                $this->conexion->cerrar();
            }

}



function Ver_Grado_Curso($idgrado,$yearid){
   $sql  = "select idcurso, nonbrecurso from grado_curso
            inner join  curso on curso.idcurso = grado_curso.curso_id
          where grado_id='$idgrado' and yearEscolar='$yearid' ";     
            $arreglo = array();
                if ($consulta = $this->conexion->conexion->query($sql)) {
                 while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                         $arreglo[]=$consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();

               }
       }

function Quitar_curso($idcurso,$grado_id ){//eliminar solo si estado de curso esta PENDIENTE
 $sql=   "DELETE FROM grado_curso  WHERE grado_id ='$grado_id ' and curso_id = '$idcurso'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
       $this->Quitrar_Cursos_Del_Docente ($idcurso,$grado_id );

        return 1;
        
      }else{
        return 0;
      }

}

//QUITAR CURSOS PERTENECIENTES AL GRADOS DEL DOCENTES

function Quitrar_Cursos_Del_Docente ($idcurso,$grado_id ){
  $sql=   " DELETE FROM docente_curso WHERE idCursos = '$idcurso' and idGrado='$grado_id'";
  if ($consulta = $this->conexion->conexion->query($sql)) {
    return 1;

  }else{
    return 0;
  }

}
//////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
/////////////EXCEL//////////////////////////////////////////
///////////////////////////////////////////////////////////////
function getCousesByIdGrado($idgrado, $yearid, $idseccion) {
    // Prepara la consulta SQL con parámetros
    $sql = "SELECT curso_id AS id, abbreviation AS name, components AS id_compont 
            FROM grado_curso 
            INNER JOIN curso ON curso.idcurso = grado_curso.curso_id
            WHERE grado_id = ? AND Idseccion = ? AND yearEscolar = ?";

    // Prepara la sentencia
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param('isi', $idgrado, $idseccion, $yearid);
    $stmt->execute();
    $result = $stmt->get_result();
    $courses = [];
    while ($row = $result->fetch_assoc()) {
        $courses[] = [
            "id" => $row['id'],
            "id_compont" => $row['id_compont'],
            "name" => $row['name']
        ];
    }
    $stmt->close();
    
    return $courses;
}


function getStudentsWithCoursesAndGrades($grado_id, $year_id, $seccion) {
    // Consulta SQL para obtener los datos de los estudiantes
    $sql = "SELECT   alumno.idalumno AS id,  alumno.apellidos, alumno.alumnonombre AS nombres, municipality as ef, alumno.dni AS cedula, 
                alumno.sexo, alumno.fnacimiento AS fechaNac, alumno.others AS lugarNac  FROM matricula
            INNER JOIN alumno ON alumno.idalumno = matricula.Id_alumno
            WHERE matricula.Id_grado = ? AND matricula.year_id = ? AND matricula.seccion = ?";
    
    // Prepara la sentencia
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param('iis', $grado_id, $year_id, $seccion);
    $stmt->execute();
    $result = $stmt->get_result();
    // Array para almacenar los estudiantes con sus datos
    $students = [];
    while ($student = $result->fetch_assoc()) {
        // Obtener los cursos y las notas del estudiante
        $notas = $this->getCoursesAndGradesByStudent($student['id'], $grado_id,$year_id,$seccion);

        // Agregar el estudiante al array
        $students[] = [
            "id" => $student['id'],
            "cedula" => $student['cedula'],
            "apellidos" => $student['apellidos'],
            "nombres" => $student['nombres'],
            "lugarNac" => $student['lugarNac'],
            "sexo" => $student['sexo'],
            "fechaNac" => $student['fechaNac'],
            "notas" => $notas
        ];
    }
    
    $stmt->close();
    return $students;
}

function getCoursesAndGradesByStudent($alumno_id, $grado_id,$year_id,$seccion) {
    $sqlCourses = "SELECT  curso_id,  abbreviation AS name  FROM grado_curso 
    INNER JOIN curso ON curso.idcurso = grado_curso.curso_id 
                   WHERE grado_id = ? and yearEscolar =? and Idseccion=? ";

    $stmtCourses = $this->conexion->conexion->prepare($sqlCourses);
    $stmtCourses->bind_param('iis', $grado_id,$year_id,$seccion);
    $stmtCourses->execute();
    $resultCourses = $stmtCourses->get_result();
    // Array para almacenar las notas por curso
    $coursesAndGrades = [];

    // Iteramos sobre los cursos
    while ($course = $resultCourses->fetch_assoc()) {
        // Para cada curso, obtenemos las notas del estudiante
        $sqlGrades = "SELECT 
                          AVG(notaacum) as promedio 
                      FROM ponderados 
                      WHERE alumno_id = ? AND grado_id = ? AND curso_id = ? AND year_id=? and seccion=?";
                      
        $stmtGrades = $this->conexion->conexion->prepare($sqlGrades);
        $stmtGrades->bind_param('iiiis', $alumno_id, $grado_id, $course['curso_id'],$year_id,$seccion);
        $stmtGrades->execute();
        $resultGrades = $stmtGrades->get_result();
        // Obtenemos el promedio de las tres notas
        $grade = $resultGrades->fetch_assoc();

        // Agregamos el curso y la nota promedio al array
        $coursesAndGrades[] = [
            "course_id" => $course['curso_id'],
            "nota" => round($grade['promedio'] ?? 0, 2)
        ];
    }
    
    // Cierra las sentencias
    $stmtCourses->close();
    $stmtGrades->close();
    return $coursesAndGrades;
}

function getCourseStatisticsFromStudents($students) {
    // Array para almacenar la información de los cursos
    $courseInfo = [];

    // Iterar sobre cada estudiante
    foreach ($students as $student) {
        foreach ($student['notas'] as $nota) {
            $course_id = $nota['course_id'];
            $nota_value = $nota['nota'];

            // Si el curso aún no está en el array, lo inicializamos
            if (!isset($courseInfo[$course_id])) {
                $courseInfo[$course_id] = [
                    "course_id" => $course_id,
                    "Inscritos" => 0,
                     "Inasistentes" => 0,
                    "Aprobados" => 0,
                    "No_Aprobados" => 0,
                    "No_Cursantes" => 0,
                ];
            }

            // Aumentamos el número de inscritos
            $courseInfo[$course_id]["Inscritos"]++;

            // Verificamos si el estudiante ha aprobado o no
            if ($nota_value >= 10) {
                $courseInfo[$course_id]["Aprobados"]++;
            } else {
                $courseInfo[$course_id]["No_Aprobados"]++;
            }
        }
    }

    // Convertimos el array asociativo en un array indexado
    return array_values($courseInfo);
}


function getTeachersWithCoursesAndSignatures($grado_id, $year_id, $seccion) {
    // Consulta SQL para obtener los datos de los docentes y cursos
    /*$sql = "SELECT DISTINCT 
                docentes.id_docente AS id, 
                docentes.nombres, 
                docentes.apellidos, 
                docentes.dni AS cedula, 
                docentes.codigo AS firma,
                curso.nonbrecurso,  
                curso.abbreviation 
            FROM docente_grados
            INNER JOIN grado_curso ON grado_curso.grado_id = docente_grados.gradoId
            INNER JOIN curso ON curso.idcurso = grado_curso.curso_id
            INNER JOIN docentes ON docentes.id_docente = docente_grados.docenteId
            WHERE docente_grados.gradoId = ? 
              AND docente_grados.idseccion = ? 
              AND docente_grados.yearId = ?";*/
    $sql="select id_docente AS id,nombres,apellidos,nonbrecurso,abbreviation,dni AS cedula,codigo AS firma FROM docente_curso
      inner join  docentes on docentes.id_docente = docente_curso.idDocente
      inner join  curso on curso.idcurso = docente_curso.idCursos
      inner join  yearscolar on yearscolar.id_year = docente_curso.idyear
      where idGrado=?   and idyear=? and Seccion=? ";
    
    // Preparar la consulta
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param('iis', $grado_id, $year_id,$seccion);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Array para almacenar los docentes con sus datos
    $docentes = [];
    
    while ($docente = $result->fetch_assoc()) {
        // Estructura del array de respuesta para cada docente
        $docentes[] = [
            'id' => $docente['id'],
            'nombre' => $docente['nombres'],
            'apellidos' => $docente['apellidos'],
            'cedula' => $docente['cedula'],
            'firma' =>"",// $docente['firma'],  // Puedes obtener la firma como un archivo si es necesario
            'curso' => $docente['nonbrecurso'],
            'abrebiatura' => $docente['abbreviation']
        ];
    }
    
    // Cerrar el statement
    $stmt->close();
    
    // Retornar la lista de docentes
    return $docentes;
}


public function getCourseInfo($idgrado, $year_id, $seccion){
    $sql = "SELECT  g.gradonombre,   g.seccion, 
                (SELECT COUNT(*)  FROM matricula m  WHERE m.Id_grado = g.idgrado  AND m.seccion = g.seccion  AND m.year_id = g.year_id) AS numStudentsPerSection
            FROM grado g
            WHERE g.idgrado = ?  AND g.year_id = ?  AND g.seccion = ?";

    // Preparar y ejecutar la consulta
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param("iis", $idgrado, $year_id, $seccion);

    // Inicializar el arreglo de resultado
    $courseInfo = [
        'studyPlan' => '',  // Inicializa con valores vacíos o predeterminados
        'specialization' => '',
        'major' => '',
        'code' => '',
        'year' => '',
        'section' => '',
        'numStudentsPerSection' => 0,
        'numStudentsOnPage' => 0
    ];

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            // Divide el valor de 'gradonombre' en año y especialización
            $gradonombreParts = explode(' ', $row['gradonombre'], 2);
            $year = $gradonombreParts[0] ?? ''; // Primera parte
            $specialization = $gradonombreParts[1] ?? ''; // Segunda parte

            $courseInfo = [
                'studyPlan' => 'PLAN DE ESTUDIO:',  // Ajusta estos valores según lo que necesitas
                'specialization' => $specialization,
                'major' => '',  // Puedes agregar más datos si es necesario
                'code' => '',   // Agrega el código adecuado
                'year' => $year,
                'section' => $row['seccion'],
                'numStudentsPerSection' => $row['numStudentsPerSection'],  // Usa el valor de la consulta
                'numStudentsOnPage' => 0  // Ajusta estos valores según tus necesidades
            ];
        }
    }

    return $courseInfo;
}

 function getSchoolInfo() {
    // Consulta SQL
    $sql = "SELECT idColegio, nameColegio, telefColegio, emailColegio, ubicacion, logoColegio, escudoPais, bannerColegio, idiomaColegio, colorSidebar, colorHeader, yearCeation, descrition, ugel, municipio, txt_ep, txt_code, federal, txt_cdcee, denomination, identity, directors, dateCreate, dateUpdate FROM colegio";

    // Preparar y ejecutar la consulta
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->execute();

    // Obtener el resultado
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Crear un objeto con los datos obtenidos
    $colegio = (object) [
        'idColegio'     => $row['idColegio'] ?? '',
        'nameColegio'   => $row['nameColegio'] ?? '',
        'telefColegio'  => $row['telefColegio'] ?? '',
        'emailColegio'  => $row['emailColegio'] ?? '',
        'ubicacion'     => $row['ubicacion'] ?? '',
        'yearCreation'  => $row['yearCeation'] ?? '',
        'description'   => $row['descrition'] ?? '',
        'ugel'          => $row['ugel'] ?? '',
        'municipio'     => $row['municipio'] ?? '',
        'txt_ep'        => $row['txt_ep'] ?? '',
        'txt_code'      => $row['txt_code'] ?? '',
        'federal'       => $row['federal'] ?? '',
        'txt_cdcee'     => $row['txt_cdcee'] ?? '',
        'denomination'  => $row['denomination'] ?? '',
        'identity'      => $row['identity'] ?? '',
        'directors'     => $row['directors'] ?? '',
         'title'         => '',
        'emtp'          => '',
        'egresyear'     => '',
        'expid'         => '',
        'finaly'        => '',
        'degre'         => '',
        'reviw'         => '',
        'coursePending'   => '',
        'oters'         => '',
        'degrecode'     => ''
    ];

    return $colegio;
}


function getStudentsByDegrees($grado_id, $year_id, $seccion) {
    // Consulta SQL para obtener los datos de los estudiantes
    $sql = "SELECT alumno.idalumno AS id, alumno.apellidos,  alumno.alumnonombre AS nombres,   alumno.municipality AS ef,  alumno.dni AS cedula, 
                   alumno.sexo, alumno.fnacimiento AS fechaNac, alumno.others AS lugarNac   FROM matricula
            INNER JOIN alumno ON alumno.idalumno = matricula.Id_alumno
            WHERE matricula.Id_grado = ? AND matricula.year_id = ? AND matricula.seccion = ?";
    
    // Prepara la sentencia
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param('iis', $grado_id, $year_id, $seccion);
    // Ejecuta la consulta
    $stmt->execute();
    
    // Obtiene los resultados
    $result = $stmt->get_result();
    
    // Arreglo donde almacenaremos los estudiantes
    $estudiantes = [];
    
    // Procesa los resultados
    while ($row = $result->fetch_assoc()) {
        // Formatea cada estudiante en el arreglo con los nombres de claves requeridos
        $estudiantes[] = [
            "cedula" => $row['cedula'],
            "apellidos" => $row['apellidos'],
            "nombres" => $row['nombres'],
            "lugarNacimiento" => $row['lugarNac'],
            "EF" => $row['ef'],  // EF es la entidad federal (estado/municipio)
            "municipio" => $row['ef'], // Asumiendo que 'municipality' es lo que se refiere a "municipio"
            "fechaNac" => $row['fechaNac'],
            "observacion" => "" // Campo de observación vacío, puedes agregar lógica para llenarlo si es necesario
        ];
    }
    
    // Retorna el arreglo de estudiantes
    return $estudiantes;
}

function getGrades($grado_id, $seccion, $year_id) {
    // Consulta SQL para obtener los datos del grado
    $sql = "SELECT idgrado, gradonombre, turno_id, nivel_id, seccion 
            FROM grado 
            WHERE idgrado = ? AND seccion = ? AND year_id = ?";
    
    // Prepara la sentencia
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param('isi', $grado_id, $seccion, $year_id);
    
    // Ejecuta la consulta
    $stmt->execute();
    
    // Obtiene los resultados
    $result = $stmt->get_result();
    
    // Arreglo donde almacenaremos el grado
    $grados = [];
    
    // Procesa los resultados
    while ($row = $result->fetch_assoc()) {
        // Formatea cada grado en el arreglo con los nombres de claves requeridos
        $grados[] = [
            "idgrado" => $row['idgrado'],
            "gradonombre" => $row['gradonombre'],
            "turno_id" => $row['turno_id'],
            "nivel_id" => $row['nivel_id'],
            "seccion" => $row['seccion'],
            "degrecode"=>''
        ];
    }
    
    // Retorna el arreglo de grados
    return $grados;
}



/////reporte individual estudiante/////////

function getDegreesByStudent($id_student) {
    // Consulta para obtener los grados cursados por el estudiante
    $sql = "SELECT Id_grado, gradonombre, matricula.seccion, matricula.year_id
            FROM matricula
            INNER JOIN grado ON grado.idgrado = matricula.Id_grado
            WHERE Id_alumno = ?";

    // Preparar y ejecutar la consulta
    $stmtDegrees = $this->conexion->conexion->prepare($sql);
    $stmtDegrees->bind_param('i', $id_student);
    $stmtDegrees->execute();
    $resultDegrees = $stmtDegrees->get_result();

    // Iniciar la estructura de grados
    $degrees = [];

    // Recorrer los grados obtenidos de la base de datos
    while ($row = $resultDegrees->fetch_assoc()) {
        // Obtener los cursos para el grado actual
        $courses = $this->getCoursesByGrade($id_student,$row["Id_grado"], $row["seccion"],$row["year_id"]);

        // Añadir el grado a la lista de grados
        $degrees[] = [
            "name" => $row["gradonombre"], // Nombre del grado
            "components" => [ // Componentes que son comunes para todos los grados
                ["id" => 1, "name" => "FORMACIÓN GENERAL"],
                ["id" => 2, "name" => "FORMACIÓN CIENTÍFICA TECNOLÓGICA Y PRODUCTIVA"],
                ["id" => 3, "name" => "PRÁCTICA VOCACIONAL Y PROFESIONAL"],
                ["id" => 4, "name" => "TECNICATURA"]
                // Puedes agregar más componentes si es necesario
            ],
            "courses" => $courses // Llenar con los cursos obtenidos
        ];
    }

    return $degrees;
}

function getCoursesByGrade($id_student,$grado_id, $seccion, $year_id) {
    // Consulta para obtener los cursos asociados a un grado específico y sección
    $sql = "SELECT curso_id AS id, nonbrecurso AS area, components AS id_component, curso_id AS number
            FROM grado_curso
            INNER JOIN curso ON curso.idcurso = grado_curso.curso_id
            WHERE grado_id = ? AND Idseccion = ? AND yearEscolar=?";

    // Preparar y ejecutar la consulta
    $stmtCourses = $this->conexion->conexion->prepare($sql);
    $stmtCourses->bind_param('isi', $grado_id, $seccion,$year_id);
    $stmtCourses->execute();
    $resultCourses = $stmtCourses->get_result();

    // Iniciar el arreglo de cursos
    $courses = [];

    // Recorrer los resultados de la consulta
    while ($row = $resultCourses->fetch_assoc()) {
        // Añadir cada curso a la lista de cursos

         $gradeData = $this->getAverageGrade($id_student, $grado_id, $row["id"], $year_id, $seccion);

        $courses[] = [
            "id" => $row["id"],
            "id_component" => $row["id_component"],
            "area" => $row["area"],
            "number" => $row["number"],
            "letter" => '', // Puedes modificar o eliminar esto si es necesario
            "te" => $gradeData['average'], // Promedio obtenido de getAverageGrade
            "month" => $gradeData['month'], // Mes obtenido de getAverageGrade
            "year" => $gradeData['year'], // Año obtenido de getAverageGrade
            "ins_edu" => '' // Completar si tienes más información
            // Puedes agregar más campos si es necesario
        ];
    }

    return $courses;
}

function getAverageGrade($alumno_id, $grado_id, $curso_id, $year_id, $seccion) {
    // Consulta para obtener el promedio de notas y el mes/año de una fecha específica
    $sql = "SELECT AVG(notaacum) AS promedio, 
                   MONTHNAME(MIN(cretedate)) AS month, 
                   YEAR(MIN(cretedate)) AS year 
            FROM ponderados 
            WHERE alumno_id = ? AND grado_id = ? AND curso_id = ? AND year_id = ? AND seccion = ?";

    // Preparar y ejecutar la consulta
    $stmtAverage = $this->conexion->conexion->prepare($sql);
    $stmtAverage->bind_param('iiisi', $alumno_id, $grado_id, $curso_id, $year_id, $seccion);
    $stmtAverage->execute();
    $resultAverage = $stmtAverage->get_result();

    // Verificar si hay resultados
    if ($resultAverage->num_rows > 0) {
        // Obtener la fila del resultado
        $row = $resultAverage->fetch_assoc();

        // Redondear el promedio
        $average = isset($row['promedio']) ? round($row['promedio']) : 0; // Redondea a entero
        $month = isset($row['month']) ? $row['month'] : ''; // Obtener el nombre del mes o cadena vacía si no hay valor
        $year = isset($row['year']) ? $row['year'] : ''; // Obtener el año o cadena vacía si no hay valor
    } else {
        // Si no hay resultados, asignar valores por defecto
        $average = 0;
        $month = '';
        $year = '';
    }

    // Cerrar el statement
    $stmtAverage->close();

    // Devolver el promedio, mes y año como un arreglo
    return [
        'average' => $average,
        'month' => $month,
        'year' => $year
    ];
}


function getDegresCousedStudent($id_student) {
    $sql = "SELECT Id_grado, seccion, year_id FROM matricula WHERE Id_alumno = ?";

    // Preparar y ejecutar la consulta
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param('i', $id_student); // Asumiendo que Id_alumno es un entero
    $stmt->execute();

    // Obtener los resultados
    $result = $stmt->get_result();

    // Crear un array para almacenar los grados cursados
    $degrees = [];

    // Iterar sobre los resultados
    while ($row = $result->fetch_assoc()) {
        $degrees[] = [
            'Id_grado' => $row['Id_grado'] ?? '',
            'seccion'  => $row['seccion'] ?? '',
            'year_id'  => $row['year_id'] ?? ''
        ];
    }

    // Retornar el arreglo de grados cursados
    return $degrees;
}

function informationSchool() {
    $sql = "SELECT txt_code, denomination, ubicacion, telefColegio, municipio, emailColegio, federal, identity, directors, txt_ep 
            FROM colegio";

    // Preparar y ejecutar la consulta
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->execute();

    // Obtener el resultado
    $result = $stmt->get_result();
    $schoolData = $result->fetch_assoc();

    // Crear el objeto con la estructura específica
    $school = (object) [
        'txt_code'      => $schoolData['txt_code'] ?? '',
        'denomination'  => $schoolData['denomination'] ?? '',
        'ubicacion'     => $schoolData['ubicacion'] ?? '',
        'telefColegio'  => $schoolData['telefColegio'] ?? '',
        'municipio'     => $schoolData['municipio'] ?? '',
        'emailColegio'  => $schoolData['emailColegio'] ?? '',
        'federal'       => $schoolData['federal'] ?? '',
        'identity'      => $schoolData['identity'] ?? '',
        'directors'     => $schoolData['directors'] ?? '',
        'emtp'          => $schoolData['txt_ep'] ?? ''
    ];

    // Retornar el objeto
    return $school;
}

function getProcedentsEstudentById($id_student) {
    $sql = "SELECT id, id_Alumno, procedente, localitation, ep_data, year FROM procedente WHERE id_Alumno = ?";
    // Preparar y ejecutar la consulta
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param('i', $id_student); // Asumiendo que id_Alumno es un entero
    $stmt->execute();
    // Obtener los resultados
    $result = $stmt->get_result();
    // Crear un array para almacenar los resultados
    $origins = [];
    // Recorrer los resultados y construir el arreglo de objetos
    while ($row = $result->fetch_assoc()) {
        $origins[] = [
            'id' => $row['id'] ?? '',
            'denomination' => $row['procedente'] ?? '',
            'locality' => $row['localitation'] ?? '',
            'ef' => $row['ep_data'] ?? '',
            'year' => $row['year'] ?? ''
        ];
    }

    // Retornar el arreglo de orígenes
    return $origins;
}

function getStudentsWihtOrigins($id_student) {
    $sql = "SELECT idalumno, apellidos, alumnonombre, dni, codigo, fnacimiento, country, province, municipality ,others ,planeStudy,especiality
            FROM alumno WHERE idalumno = ?";

    // Preparar y ejecutar la consulta
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param('i', $id_student); // Asumiendo que el id_student es un entero
    $stmt->execute();

    // Obtener los resultados
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    // Crear el objeto con la estructura específica
    $studentObject = (object) [
        'degreName'   => 'EDUCACIÓN MEDIA TÉCNICA ESPECIALIDAD ECONOMÍA SOCIAL',
        'mentiont'    => '',
        'apellidos'   => $student['apellidos'] ?? '',
        'cedula'      => $student['dni'] ?? '',
        'dateBriht'   => $student['fnacimiento'] ?? '',
        'country'     => $student['country'] ?? '',
        'province'    => $student['province'] ?? '',
        'monicipliy'  => $student['municipality'] ?? '',
        'originBriht' => $student['others'] ?? '',
        'name'        => $student['alumnonombre'] ?? '',
        'code'        => $student['codigo'] ?? '',
        'planeStudy'        => $student['planeStudy'] ?? '',
       'especiality' => $student['especiality'] ?? '',

    ];

    return $studentObject;
}
/*
function Cambiar_estado_curso($arreglo){

 $sql = "UPDATE curso SET statuscurso = 'ASIGNADO' WHERE idcurso = '$arreglo'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
        
      }else{
        return 0;
      }

}*/
/*
function Recontruit_stado_curso($idcurso){

 $sql = "UPDATE curso SET statuscurso = 'LIBRE' WHERE idcurso = '$idcurso'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1; 
      }else{
        return 0;
      }

}*/





 }
?>


