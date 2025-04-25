
<?php
    class Alumno{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }

   /*
   function Extraer_contracena($usu_id){
        $sql = "SELECT usu_id,usu_contrasena FROM usuarios WHERE usu_id='$usu_id'";
     $arreglo = array();
     if ($consulta = $this->conexion->conexion->query($sql)) {
         while ($consulta_VU = mysqli_fetch_array($consulta)) {
                   
                 $arreglo[] = $consulta_VU;
                    
         }
         return $arreglo;
         $this->conexion->cerrar();
    }
 }
*/



function Verificar_Existencia($apellp,$nombre,$dni,$codi){

$sql = "SELECT apellidos, alumnonombre, dni,codigo FROM alumno WHERE apellidos='$apellp' and alumnonombre='$nombre' and dni='$dni' and codigo='$codi'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return count($arreglo);
        $this->conexion->cerrar();
      }

}

function listar_alumnos(){
 $sql=  " select idalumno,apellidos, alumnonombre, dni, telefono, codigo, sexo, stadoalumno from alumno where bajaAlumn='1'";

            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
}



function list_studentes_keys(){
    $sql = "SELECT a.idalumno, a.apellidos, a.alumnonombre, a.telefono, k.keys_text ,k.created_at
            FROM alumno a
            LEFT JOIN keys_students k ON a.idalumno = k.id_students
            WHERE a.bajaAlumn = '1'";

    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
            $arreglo["data"][] = $consulta_VU;
        }
        $this->conexion->cerrar(); // Mover esta línea fuera del bloque de condición
        return $arreglo;
    } else {
        // Manejo de error si la consulta falla
        return array("error" => "Error en la consulta: " . $this->conexion->conexion->error);
    }
}





function Registrar_New_Alumno($idalumno,$apellp,$nombre,$fechaN, $dni,$telf,$codi,$sexo,$direccion,$mail,$country,$age,$province,$municipality,$others,$planeStudy,$especiality){
$sql = "insert into alumno (apellidos, alumnonombre, dni, telefono, codigo, sexo, fnacimiento, stadoalumno, fechaRegisto, fechaUpdate, direccion, rolalumno, alumno_foto,mail,country,age,province,municipality,others ,planeStudy,especiality)
  values ('$apellp','$nombre','$dni','$telf','$codi','$sexo','$fechaN','ACTIVO',NOW(),NOW(),'$direccion','3','usuarios/images.png','$mail','$country','$age','$province','$municipality','$others','$planeStudy','$especiality' )";
    if ($consulta = $this->conexion->conexion->query($sql)) {

       $idalum = mysqli_insert_id($this->conexion->conexion);
             return $idalum;  
    }else{return 0;}

}

function registrarNuevoProcedente($id,$id_Alumno, $nombre, $localidad, $ep_data, $yeard) {
    $sql = "INSERT INTO procedente (id_Alumno, procedente, localitation, ep_data, year, status, created_at, updated_at) 
            VALUES ('$id_Alumno', '$nombre', '$localidad', '$ep_data', '$yeard', 1, NOW(), NOW())";
    
    if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;  
    } else {
        return 0;
    }
}

function actualizarProcedente($id, $id_Alumno, $nombre, $localidad, $ep_data, $yeard) {
    $sql = "UPDATE procedente  SET id_Alumno = '$id_Alumno',  procedente = '$nombre', localitation = '$localidad',
                ep_data = '$ep_data', year = '$yeard', updated_at = NOW()
            WHERE id = '$id' AND id_Alumno= '$id_Alumno' ";
    
    if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;  
    } else {
        return 0;
    }
}

 function Register_key($id_student, $key) {
        try{
       
        $sql = "INSERT INTO keys_students (id_students,keys_text ) VALUES (?,?)";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("is",$id_student, $key);


        if ($stmt->execute()) {
            return array('status' => true, 'auth' => true, 'msg' => 'Registro exitoso', 'data' => '');
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Error en la inserción'.$stmt->error, 'data' => '');
        }
         } catch (Exception $e) {
            return array('status' => false, 'auth' => true, 'msg' => 'Excepción: ' . $e->getMessage(), 'data' => '');
        }
    }


function Registrar_New_Apoderados($id_Alumno, $nom_pade, $apell_pade, $dni_pade, $nom_madre, $apell_madre, $dni_madre, $nom_cole, $nom_direc, $cole_codig, $telf_padre, $direc_padre, $email_padre) {
    // Preparar la consulta SQL
    $sql = "INSERT INTO apoderados (
                paderNombre, PadreApellidos, padreDni, madreNombres, madreApellidos, madreDni, 
                cole_procedente, coleUbicacion, coleCodigo, telf_padre, direc_padre, email_padre, dateCreat, dateUpdate, id_Alumn
            ) 
            VALUES (
                '$nom_pade', '$apell_pade', '$dni_pade', '$nom_madre', '$apell_madre', '$dni_madre', 
                '$nom_cole', '$nom_direc', '$cole_codig', '$telf_padre', '$direc_padre', '$email_padre', NOW(), NOW(), '$id_Alumno'
            )";

    // Ejecutar la consulta
    if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;  // Si la consulta fue exitosa
    } else {
        return 0;  // Si hubo algún error al ejecutar la consulta
    }
}

  function Extraer_Datos_Alumno($idalumno){
    $sql = "select idalumno, apellidos, alumnonombre, dni, telefono, codigo, sexo, fnacimiento, direccion,
      paderNombre, PadreApellidos, padreDni, madreNombres, madreApellidos, madreDni, cole_procedente, coleUbicacion, coleCodigo, telf_padre, direc_padre, email_padre, country,age,province,municipality,others, planeStudy, especiality, nombre_autorizado1, apellido_autorizado1, parentesco_autorizado1, nombre_autorizado2, apellido_autorizado2, parentesco_autorizado2 from alumno  LEFT JOIN apoderados ON apoderados.id_Alumn = alumno.idalumno
                       LEFT JOIN autorizados ON autorizados.id_Alumn = alumno.idalumno
        where idalumno='$idalumno';"; 
    
       $arreglo = array();
       if ($consulta = $this->conexion->conexion->query($sql)) {
       while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                $arreglo[]=$consulta_VU;
      }
       $arreglo['procedente']=  $this->ObtenerProcedentePorAlumno($idalumno);
       return $arreglo;
       $this->conexion->cerrar();

      }
  }

  function ObtenerProcedentePorAlumno($id_Alumno) {
    $sql = "SELECT * FROM procedente WHERE id_Alumno = '$id_Alumno';"; 
    $arreglo = array();
    
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
            $arreglo[] = $consulta_VU;
        }
    }
    
    return $arreglo;
}


function Dar_DeBaja_Alumnos($idalumno){
 $sql = "UPDATE alumno SET bajaAlumn ='0'  where idalumno ='$idalumno'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      }else{
        return 0;
      }

    /*  $sql=   "DELETE FROM alumno WHERE idalumno = '$idalumno'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      }else{
        return 0;
      }*/

}


function Actualizar_New_Alumno($idalumno,$apellp,$nombre,$fechaN, $dni,$telf,$codi,$sexo,$direccion,$mail,$country,$age,$province,$municipality,$others,$planeStudy,$especiality){

  $sql = "UPDATE alumno SET apellidos='$apellp', alumnonombre='$nombre', dni='$dni', telefono='$telf', codigo='$codi', sexo='$sexo', fnacimiento='$fechaN', fechaUpdate=NOW(), direccion='$direccion', mail='$mail',country='$country',age='$age',province='$province',municipality='$municipality',others='$others',planeStudy='$planeStudy',especiality='$especiality'  where idalumno ='$idalumno'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      }else{
        return 0;
      }
}

function Actualizar_New_Apoderados($idalumno, $nom_pade, $apell_pade, $dni_pade, $nom_madre, $apell_madre, $dni_madre, $nom_cole, $nom_direc, $cole_codig, $telf_padre, $direc_padre, $email_padre) {
    // Modificar la consulta para incluir los nuevos campos telf_padre y direc_padre
    $sql = "UPDATE apoderados 
            SET 
                paderNombre = '$nom_pade', 
                PadreApellidos = '$apell_pade', 
                padreDni = '$dni_pade', 
                madreNombres = '$nom_madre', 
                madreApellidos = '$apell_madre', 
                madreDni = '$dni_madre', 
                cole_procedente = '$nom_cole', 
                coleUbicacion = '$nom_direc', 
                coleCodigo = '$cole_codig', 
                telf_padre = '$telf_padre', 
                direc_padre = '$direc_padre', 
                email_padre = '$email_padre', 
                dateUpdate = NOW() 
            WHERE id_Alumn = '$idalumno'";

    // Ejecutar la consulta
    if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;  // Si la actualización fue exitosa
    } else {
        return 0;  // Si hubo algún error
    }
}


////////////////////////////////////////
///SECCION NETAMENTE ALUMNO//////////////
/////////////////////////////////////////

function Listar_Periodos_Evaluacion_year($yearid){
 $sql = "select tipo_periodo,ordenTipo_periodo,tipo_nombre FROM periodo
 inner join  tipoevaluacion on tipoevaluacion.tipo_id = periodo.tipo_periodo
where year_id='$yearid' "; 
    
  $arreglo = array();
       if ($consulta = $this->conexion->conexion->query($sql)) {
       while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                $arreglo[]=$consulta_VU;
      }
       return $arreglo;
       $this->conexion->cerrar();

      }
}

function Listar_Notas_Alumno_Tipo($yearid,$idorden,$alumnoid,$idcurso){
$sql = "select cargaacadId,notas.cursoid,actividades,puntajes,nota_alum from notas
   inner join  activ_curso on activ_curso.actcur_id = notas.cargaacadId
  where notas.cursoid='$idcurso' and notas.ordentipo='$idorden'  and notas.alumnoid='$alumnoid' and notas.yearid='$yearid' "; 
    
  $arreglo = array();
       if ($consulta = $this->conexion->conexion->query($sql)) {
       while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                $arreglo[]=$consulta_VU;
      }
       return $arreglo;
       $this->conexion->cerrar();

      }
}

function Grado_Alumno_Matriculado($yearid,$alumnoid){
$sql = " select Id_grado from matricula where Id_alumno='$alumnoid' and year_id='$yearid'"; 
    
  $arreglo = array();
       if ($consulta = $this->conexion->conexion->query($sql)) {
       while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                $arreglo[]=$consulta_VU;
      }
       return $arreglo;
       $this->conexion->cerrar();

      }


}

function Listar_cursos_Grado($yearid,$idgrado){
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

function Listar_Ponderacione_Acumulados($alumnoid,$idorden,$yearid){
   $sql  = "SELECT curso_id,notaacum FROM ponderados where alumno_id='$alumnoid' and year_id='$yearid' and ordentio='$idorden' ";     
            $arreglo = array();
                if ($consulta = $this->conexion->conexion->query($sql)) {
                 while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                         $arreglo[]=$consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();

               }
       }

       function Aulas_Alumno_Clases($yearid,$idgrado){
        $sql  = "select gradonombre,nombreNivell,nombreaula, piso,seccion FROM  grado
        inner join  niveles on niveles.idniveles = grado.nivel_id
        inner join  aula on aula.idaula = grado.aula_id
        where idgrado='$idgrado'";     
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
         while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
           $arreglo[]=$consulta_VU;
         }
         return $arreglo;
         $this->conexion->cerrar();

       }

     }


function Listar_Cursos_Docentes($yearid,$idgrado){
$sql  = "select nombres,apellidos,nonbrecurso,yearScolar FROM docente_curso
  inner join  docentes on docentes.id_docente = docente_curso.idDocente
    inner join  curso on curso.idcurso = docente_curso.idCursos
    inner join  yearscolar on yearscolar.id_year = docente_curso.idyear
where idGrado='$idgrado' and idyear='$yearid' ";     
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
         while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
           $arreglo[]=$consulta_VU;
         }
         return $arreglo;
         $this->conexion->cerrar();

       }
}
public function Registrar_New_Autorizados($id_Alumno, $autorizado1_nombre, $autorizado1_apellido, $autorizado1_parentesco, $autorizado2_nombre, $autorizado2_apellido, $autorizado2_parentesco) {
    // Preparar la consulta SQL
    $sql = "INSERT INTO autorizados (
                nombre_autorizado1, apellido_autorizado1, parentesco_autorizado1, 
                nombre_autorizado2, apellido_autorizado2, parentesco_autorizado2, id_Alumn
            ) 
            VALUES (
                '$autorizado1_nombre', '$autorizado1_apellido', '$autorizado1_parentesco', 
                '$autorizado2_nombre', '$autorizado2_apellido', '$autorizado2_parentesco','$id_Alumno'
            )";

    // Ejecutar la consulta
   if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
    } else {
        echo "Error SQL: " . $this->conexion->conexion->error;
        return 0;
    }
}
public function Actualizar_New_Autorizados($idalumno, $autorizado1_nombre, $autorizado1_apellido, $autorizado1_parentesco, $autorizado2_nombre, $autorizado2_apellido, $autorizado2_parentesco) {
    // Preparar la consulta SQL para actualizar los datos de los autorizados
    $sql = "UPDATE autorizados 
            SET 
                nombre_autorizado1 = '$autorizado1_nombre', 
                apellido_autorizado1 = '$autorizado1_apellido', 
                parentesco_autorizado1 = '$autorizado1_parentesco',
                nombre_autorizado2 = '$autorizado2_nombre',
                apellido_autorizado2 = '$autorizado2_apellido',
                parentesco_autorizado2 = '$autorizado2_parentesco'
            WHERE id_Alumn = '$idalumno'";

    // Ejecutar la consulta
    if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;  // Si la consulta fue exitosa
    } else {
        return 0;  // Si hubo algún error al ejecutar la consulta
    }
}
}
?>