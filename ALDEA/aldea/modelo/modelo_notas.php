<?php
class Nota{
    private $conexion;
    function __construct(){
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }



    function listar_alumnosParaPonerNotas($idgrado,$idnivel, $idyear, $idsecion){
       $sql = "select idalumno,apellidos,alumnonombre FROM matricula
inner join alumno on alumno.idalumno =matricula.Id_alumno
 WHERE Id_grado='$idgrado'and Id_nivls='$idnivel'and year_id='$idyear' and seccion='$idsecion'";
       $arreglo = array();
       if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }
}

function ListarPeriodoDeEvaluacionSusFechas($idyear){
$sql = "select ordenTipo_periodo,tipo_periodo,tipo_nombre,fech_inicio, fech_final FROM periodo
inner join tipoevaluacion on tipoevaluacion.tipo_id =periodo.tipo_periodo where year_id='$idyear'";
       $arreglo = array();
       if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }

}


//FUNCION CLAVE DONDE SE ESPECIFICA LAS NOTAS DE LOA ALUMNOS
function listar_alumnos_Notas($tipoorden,$tipoid,$cursoid,$idgrado,$idsecion,$idnivel,$idyear){
  /* $sql = "select a.idalumno, a.apellidop ,n.nota_alum from alumno 
   as a left join notas as n on a.idalumno = n.alumnoid
   where grado='1';";*/
    $sql = "select n.idnotas,a.idalumno, a.apellidos ,n.nota_alum,p.susty,p.curso_id,p.ordentio from notas 
   as n join alumno as a on a.idalumno = n.alumnoid LEFT JOIN ponderados AS p ON p.alumno_id = a.idalumno
   where gradoid='$idgrado' and curso_id='$cursoid' and seccionid='$idsecion'  and ordentipo='$tipoorden'
   and tipoevaluacionid='$tipoid' and idnivel='$idnivel' and yearid='$idyear'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();
}
}

//LISTANDO CARGA ACADEMICO POR CADAD TIPO BIMESTRE O TREM O SEMSTRE 
function listar_CargaAcademicaPorCadaCursoPorTipo($idcurso,$tipoorden,$tipoid,$idyear){

   $sql = "SELECT actcur_id,actividades,puntajes FROM activ_curso where cursoid='$idcurso' and ordenTipoeva='$tipoorden' and evalu_tipo='$tipoid'  and yearId='$idyear'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();
}
}

  //REGISTRAR NOTAS aLUMNO//0:256:5,527:4,528:3,529:2,530:1
function Registrar_Notas_Alumno($alumnos,$actividad,$nota,$cursoid,$idgrado,$idsecion,$tipoorden,$tipoid,$idyear,$idnivel,$iddocente)
{

   $sql = "INSERT INTO notas( gradoid, cursoid, alumnoid, seccionid,cargaacadId, ordentipo, tipoevaluacionid, nota_alum, idnivel, yearid, usersession,createDate) 

     VALUES ('$idgrado', '$cursoid', '$alumnos','$idsecion','$actividad','$tipoorden','$tipoid','$nota','$idnivel','$idyear','$iddocente',NOW())"; 
   if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
  }else{
    return 0;
}

}

//GUARDAR PONDERACIONES POR CADA CURSO



function GuardarPonderadoNostadAlum($alumnos,$cursoid,$promedio,$idgrado,$tipoorden,$tipoid,$idyear,$idnivel,$idsecion,$iddocente,$susti){
 $sql = "INSERT INTO ponderados (alumno_id, curso_id, notaacum,susty, grado_id, ordentio, tipo_id, year_id, nivel_id, seccion,userseccion,cretedate) 
     VALUES ('$alumnos', '$cursoid', '$promedio','$susti','$idgrado','$tipoorden','$tipoid','$idyear','$idnivel','$idsecion','$iddocente',NOW())"; 
   if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
  }else{
    return 0;
}

}

function Editando_Nuevo($alumnos,$cursoid,$idgrado,$tipoorden,$tipoid,$idyear,$idnivel,$idsecion){
    $sql = "select  alumno_id from ponderados where alumno_id='$alumnos' and curso_id='$cursoid' and grado_id='$idgrado' and ordentio='$tipoorden'
     and  tipo_id='$tipoid' and  year_id='$idyear ' and nivel_id ='$idnivel' and seccion='$idsecion'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return count($arreglo);
    $this->conexion->cerrar();
}
}


function Actualizar_Ponderaciones($alumnos,$cursoid,$promedio,$idgrado,$tipoorden,$tipoid,$idyear,$idnivel,$idsecion,$iddocente,$susti){

 $sql = "update ponderados set notaacum = '$promedio', susty='$susti' ,userseccion='$iddocente' where alumno_id='$alumnos' and curso_id='$cursoid' and grado_id='$idgrado' and ordentio='$tipoorden'
and  tipo_id='$tipoid' and  year_id='$idyear ' and nivel_id ='$idnivel' and seccion='$idsecion'";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
            }else{
                return 0;
            }
}



  //Actualizar nota alumno
function Update_Promedio_Alumno($alumnos,$promedio){
 $sql = "update alumno set promedio = '$promedio' WHERE idalumno = '$alumnos'";
  if ($consulta = $this->conexion->conexion->query($sql)) {
  return 1;           
  }else{
    return 0;
 }
}

//listar combo grados
function listarComboGradosViewNotas(){
    $sql = "select idgrado, gradonombre,nivel_id,nombreNivell,seccion from grado
  inner join  niveles on niveles.idniveles = grado.nivel_id;";
  $arreglo = array();
  if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
      $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();
  }
}

function Listar_combo_tipos(){

   $sql = "SELECT id_periodo,tipo_periodo FROM periodo";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();
}

}

/*
function Listar_combo_Cursos_grado($gradoid){
 $sql = "select curso_id,nonbrecurso from grado_curso
  inner join curso on curso.idcurso=grado_curso.curso_id
   where grado_id='$gradoid'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();

}
}*/

function Listar_combo_Cursos_grado($gradoid, $idyear = null){
    $sql = "SELECT curso_id, nonbrecurso FROM grado_curso INNER JOIN curso ON curso.idcurso = grado_curso.curso_id
            WHERE grado_id = '$gradoid'";
    
   
    if ($idyear !== null)   $sql .= " AND yearEscolar = '$idyear'";
    
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        // Cerramos la conexión después de ejecutar la consulta
        $this->conexion->cerrar();
    }
    
    return $arreglo;
}


//FUNCION PARA VERIFICAR SI EXISTE UN REGISTRO SIMILILAR

 

///obtener los id de notas para editar o actualizar
 function getIdNotas($cursoid, $idgrado, $idsecion, $tipoorden, $tipoid, $idyear, $idnivel){
  $sql = "SELECT idnotas FROM notas
          WHERE gradoid='$idgrado' AND cursoid='$cursoid' AND seccionid='$idsecion' AND ordentipo='$tipoorden' AND tipoevaluacionid='$tipoid' 
          AND idnivel='$idnivel' AND yearid='$idyear'";

  $arreglo = array();

  if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_array($consulta)) {
          $arreglo[] = $consulta_VU['idnotas']; // Almacenar solo el valor de idnotas en el array
      }
      
     // $this->conexion->cerrar();
      return $arreglo; // Devolver el array con los valores de idnotas
  }

  return $arreglo; // Devolver un array vacío si la consulta falla
}


function Actualizar_Nota_Alumno($idNota, $nota) {
  $sql = "UPDATE notas SET nota_alum = '$nota' WHERE idnotas = '$idNota'";

  if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1; // Éxito en la actualización
  } else {
      return 0; // Fallo en la actualización
  }
}

//FUNCION PARA VERIFICAR LA FECHA PERMITIDA´PARA REGISTRAR NOTAS

 function VerrificarFechaEvaluacion($idyear){

$sql = "select ordenTipo_periodo,tipo_periodo,tipo_nombre,fech_inicio, fech_final FROM periodo
inner join tipoevaluacion on tipoevaluacion.tipo_id =periodo.tipo_periodo where year_id='$idyear'";
       $arreglo = array();
       if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }


 }





//////////////////////////////////////////////////////////
/////////////DE AQUI ES REPORTE POR BIMESTRES//////////////
///////////////////////////////////////////////////////////
function Listar_Notas_Periodo($idyear){

$sql = "select ordenTipo_periodo,tipo_periodo,tipo_nombre from periodo
  inner join  tipoevaluacion on tipoevaluacion.tipo_id = periodo.tipo_periodo
  where year_id='$idyear'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();

}


}







//triple t

function Listar_Alumnos_Ponderados($idgrado,$idnivel,$idyear,$idsecion){

  $sql = "select  distinct alumno_id,apellidos, alumnonombre,nonbrecurso,curso_id,notaacum,susty,ordentio from ponderados
  inner join  alumno on alumno.idalumno = ponderados.alumno_id
  inner join  curso on curso.idcurso = ponderados.curso_id
  where grado_id='$idgrado' and nivel_id='$idnivel' and year_id='$idyear' and seccion='$idsecion'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();
}
}

function getAssignedCourses($idGrado, $idYear, $idSeccion) {
    // Build the SQL query with the passed parameters
    $sql = "SELECT c.idcurso  FROM curso c WHERE c.idcurso IN (  SELECT cd.idCursos   FROM docente_curso cd WHERE cd.idyear = ? AND cd.idGrado = ? AND cd.Seccion = ? )";
    // Prepare the SQL statement
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param('iis', $idYear, $idGrado, $idSeccion); // 'iis' -> integer, integer, string
    // Execute the query and handle the result
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $data = $result->fetch_all(); // Fetch all results
        return array( 'status' => true, 'auth' => true, 'msg' => 'Query successful', 'data' => $data );
    } else {
        return array( 'status' => false, 'auth' => true, 'msg' => 'Query failed: ' . $stmt->error, 'data' => '' );
    }
}

function UpdateNotesByStudents($idpond, $alumno_id, $ordentio, $notaacum, $iduser) {
    try {
        $sql = "UPDATE ponderados SET notaacum = ?, userseccion = ? WHERE idpond = ? AND alumno_id = ? AND ordentio = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param('iiiii', $notaacum, $iduser, $idpond, $alumno_id, $ordentio);

        if ($stmt->execute()) {
            return array('status' => true, 'msg' => 'Update successful');
        } else {
            return array('status' => false, 'msg' => 'Update failed: ' . $stmt->error);
        }
    } catch (Exception $e) {
        return array('status' => false, 'msg' => $e->getMessage());
    }
}


function getPendingOrFailedCourses($idyear,$id_student,$id_couse,$idnivel,$section,$gradoId) {
    try {
        $sql = "SELECT DISTINCT alumno_id, idpond, notaacum, a.apellidos, a.alumnonombre, g.gradonombre, c.nonbrecurso, ordentio 
                FROM ponderados p
                INNER JOIN alumno a ON a.idalumno = p.alumno_id
                INNER JOIN curso c ON c.idcurso = p.curso_id
                INNER JOIN grado g ON g.idgrado = p.grado_id
                WHERE p.year_id = ?  AND a.idalumno = ?  AND p.curso_id = ?  AND p.grado_id = ? AND p.nivel_id=?
                AND (SELECT AVG(notaacum) FROM ponderados  WHERE year_id = ? AND alumno_id = ?  AND curso_id = ? 
                     AND grado_id = ?  AND nivel_id = ? ) < 10.5";

        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("iiiiiiiiii", $idyear, $id_student, $id_couse, $gradoId, $idnivel, $idyear, $id_student, $id_couse, $gradoId, $idnivel);

        $arreglo = array();

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($consulta_VU = $result->fetch_assoc()) {
                $arreglo[] = $consulta_VU;
            }

            return array('status' => true, 'auth' => true, 'msg' => 'Query successful', 'data' => $arreglo);
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Query failed: ' . $stmt->error, 'data' => '');
        }
    } catch (Exception $e) {
        return array('status' => false, 'auth' => true, 'msg' => 'Error: ' . $e->getMessage(), 'data' => '');
    } finally {
        $this->conexion->cerrar();
    }
}

/*
function getPendingOrFailedCourses($idyear,$id_student,$id_couse,$idnivel,$section,$gradoId){

    $sql = "SELECT  distinct alumno_id, idpond, notaacum , a.apellidos, a.alumnonombre, g.gradonombre, c.nonbrecurso,ordentio 
            FROM ponderados p
            INNER JOIN alumno a ON a.idalumno = p.alumno_id
            INNER JOIN curso c ON c.idcurso = p.curso_id
            INNER JOIN grado g ON g.idgrado = p.grado_id
            WHERE p.year_id = 1  
            and a.idalumno =1
            and p.curso_id =1
            and p.grado_id=1
            AND (SELECT AVG(notaacum) 
                 FROM ponderados 
                 WHERE alumno_id = 1 
                   AND curso_id = 1 
                   AND grado_id = 1 
                   AND year_id = 1) < 10.5";

             $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();
}

}*/





function getRatingByDegreAndLevelAndSectionAndCourseAndYear($idgrado,$idnivel,$idyear,$idsecion,$idcurso){

  $sql = "select  distinct alumno_id,apellidos, alumnonombre,nonbrecurso,curso_id,notaacum,ordentio from ponderados
  inner join  alumno on alumno.idalumno = ponderados.alumno_id
  inner join  curso on curso.idcurso = ponderados.curso_id
  where grado_id='$idgrado' and nivel_id='$idnivel' and year_id='$idyear' and seccion='$idsecion' and curso_id= '$idcurso'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();
}
}



function getReportcardByIdStudents($idgrado, $idyear, $idstudent) {
    // Consulta SQL para obtener el reporte del alumno por su ID de grado, ID de año y ID de estudiante
    $sql = "SELECT DISTINCT alumno_id, apellidos, alumnonombre, gradonombre, ponderados.seccion, codigo, nonbrecurso, nombreNivell, curso_id, notaacum, susty, ordentio 
            FROM ponderados
            INNER JOIN alumno ON alumno.idalumno = ponderados.alumno_id
            INNER JOIN curso ON curso.idcurso = ponderados.curso_id
            INNER JOIN grado ON grado.idgrado = ponderados.grado_id 
            INNER JOIN niveles ON niveles.idniveles = ponderados.nivel_id
            WHERE grado_id='$idgrado' AND ponderados.year_id='$idyear' AND alumno_id='$idstudent'";
   
    // Array para almacenar los resultados de la consulta
    $arreglo = array();
    
    // Ejecutar la consulta
    if ($consulta = $this->conexion->conexion->query($sql)) {
        // Recorrer los resultados y almacenarlos en el arreglo
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        // Devolver el arreglo con los resultados
        return $arreglo;
        // Cerrar la conexión después de obtener los resultados (esta línea nunca se alcanza debido al return anterior)
        $this->conexion->cerrar();
    }
}


public function showSchoolInformation()
{
    $sql = "SELECT idColegio, nameColegio, emailColegio, ubicacion, logoColegio, escudoPais, ugel FROM colegio";
    $stmt = $this->conexion->conexion->prepare($sql);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $schools = $result->fetch_all(MYSQLI_ASSOC);
        return array('status' => true, 'auth' => true, 'msg' => 'Información de colegios encontrada', 'data' => $schools);
    } else {
        return array('status' => false, 'auth' => true, 'msg' => 'No se pudo obtener información de colegios: ' . $stmt->error, 'data' => '');
    }
}


/*
function Listar_Alumnos_Ponderados_v2($idgrado, $idnivel, $idyear, $idsecion)
{
    $sql = "SELECT DISTINCT alumno_id, apellidos, alumnonombre, nonbrecurso, curso_id, notaacum, ordentio 
            FROM ponderados
            INNER JOIN alumno ON alumno.idalumno = ponderados.alumno_id
            INNER JOIN curso ON curso.idcurso = ponderados.curso_id
            WHERE grado_id='$idgrado' AND nivel_id='$idnivel' AND year_id='$idyear' AND seccion='$idsecion'";
    
    $arreglo = array();

    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $alumno = array(
                'alumno_id' => $consulta_VU['alumno_id'],
                'apellidos' => $consulta_VU['apellidos'],
                'nombres' => $consulta_VU['alumnonombre'],
                'curso' => $consulta_VU['nonbrecurso'],
                'notaacum' => array_fill(1, count($periodos_bd), ''), // Inicializar el array para las notas acumuladas
            );

            // Agregar la nota acumulada al array de notas del alumno
            $alumno['notaacum'][$consulta_VU['ordentio']] = $consulta_VU['notaacum'];

            // Guardar el alumno en el arreglo
            $arreglo[] = $alumno;
        }

       
    }

    return $arreglo;
}*/





function Listar_alumnos_periodo_curso($idyear){
$tipo=$this->Listar_Notas_Periodo($idyear);
  $concat='';
  $concat.='<table class="table table-striped" id="tbl-reporNota"  style=" width: 100%">';
  $concat.='<thead>';
        $concat.='<tr>';
          $concat.='<th>N°</th>';
          $concat.='<th>Apellidos</th>';
          $concat.='<th>Nombres</th>';
          $concat.='<th>Curso</th>';
          foreach ($tipo as $val) { 
            $concat.='<th>'.$val['ordenTipo_periodo'].'°_'.$val['tipo_nombre']. '</th>';
           } 
        $concat.='</tr>';
      $concat.='</thead>';
      $concat.='<tbody>';
        $concat.='<tr>';
           $concat.='<td align="center" >1</td>';
           $concat.='<td  align="center">cerna</td>';
           $concat.='<td align="center">nimer</td>';
           $concat.='<td align="center">mate</td>';
           $concat.='<td align="center">20</td>';
           $concat.='<td align="center">20</td>';
         $concat.='</tr>';
          $concat.='</tbody>';
    $concat.='</table>';
    return $concat;
}


}
?>
