<?php
    class Matricula{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }


function listar_combo_Alumnos_Matricular(){
 $sql = "SELECT idalumno,apellidos, alumnonombre FROM alumno WHERE bajaAlumn='1'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }

}

function listar_combo_Grados_matricula(){
$sql = "select idgrado, gradonombre,nombreNivell from grado
       inner join  niveles on niveles.idniveles = grado.nivel_id";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }
}


function getStudentById($id_student, $idyear) {
    $sql = "SELECT apellidos, alumnonombre, dni, especiality, gradonombre, matricula.seccion, yearScolar 
            FROM matricula 
            INNER JOIN alumno ON alumno.idalumno = matricula.Id_alumno 
            INNER JOIN grado ON grado.idgrado = matricula.Id_grado 
            INNER JOIN yearscolar ON yearscolar.id_year = matricula.year_id 
            WHERE Id_alumno = ? AND matricula.year_id = ?";

    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->bind_param("ii", $id_student, $idyear);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $yearStart = (int)$row['yearScolar'];
        $yearEnd = $yearStart + 1;
        $yearRange = $yearStart . '-' . $yearEnd;
        $student = (object)[
            'id' => $id_student,
            'degreName' => $row['gradonombre'] ?? "",
            'mentiont' => $row['especiality'] ?? "",
            'student' => $row['apellidos'] . ' ' . $row['alumnonombre'] ?? "",
            'cedula' => $row['dni'] ?? "",
            'section' => $row['seccion'] ?? "",
            'currenYear' => $yearRange ?? ""
        ];
        return $student;
    } else {
        return null;
    }
}

function get_studentsBy_yearId($idyear) {
    $sql = "SELECT idmatricula, Id_alumno, apellidos, alumnonombre, Id_grado, Id_aula, Id_turno, Id_nivls, year_id, seccion
            FROM matricula 
            INNER JOIN alumno ON alumno.idalumno = matricula.Id_alumno 
            WHERE matricula.year_id = ?";
    
    $arreglo = array();
    if ($stmt = $this->conexion->conexion->prepare($sql)) {
        $stmt->bind_param('i', $idyear);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($consulta_VU = $result->fetch_assoc()) {
            $arreglo[] = $consulta_VU;
        }
        
        $stmt->close();
        $this->conexion->cerrar();
    }
    
    return $arreglo;
}


function getSchool() {
    $sql = "SELECT  directors, identity FROM colegio";
    $stmt = $this->conexion->conexion->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $school = (object) [
            
            'directors' => $row['directors']?? '',
            'identity' => $row['identity']?? ''
        ];
        
        return $school;
    } else  return null;
    
}

   

function listar_combo0_Grados0_matricula0(){
$sql = "select idgrado, gradonombre,nombreNivell,turno_nombre,seccion,nombreaula,aula_id, turnos.turno_id, nivel_id, vacantes
 from grado
        inner join  aula on aula.idaula = grado.aula_id
        inner join  turnos on turnos.turno_id = grado.turno_id
        inner join  niveles on niveles.idniveles = grado.nivel_id ";


      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }
}



function Extrae_datos_Grados($idgrado){
  $sql = "select aula_id, turnos.turno_id, nivel_id, vacantes, seccion,nombreaula,turno_nombre,nombreNivell from grado
        inner join  aula on aula.idaula = grado.aula_id
        inner join  turnos on turnos.turno_id = grado.turno_id
        inner join  niveles on niveles.idniveles = grado.nivel_id where idgrado='$idgrado'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }  
}

function alumnoMatriculado($Id_alumno, $Id_grado, $year_id) {
    $sql = "SELECT COUNT(*) as count 
            FROM matricula 
            WHERE Id_alumno = '$Id_alumno' AND Id_grado = '$Id_grado' AND year_id = '$year_id'";
    $resultado = $this->conexion->conexion->query($sql);
    
    if ($resultado) {
        $fila = $resultado->fetch_assoc();
        return $fila['count'] > 0;
    } else {
        return false;
    }
}


function Registrar_New_Matricula($alumno,$grado,$pago,$aula,$turno,$nivel,$yearid,$cargo,$seccion){
$sql = "insert into matricula (Id_alumno, Id_grado, Id_aula, Id_turno, Id_nivls, cargoPago, year_id, seccion, cargoMatricula, creatDate, updateDate)
  values ('$alumno','$grado','$aula','$turno','$nivel','$cargo','$yearid','$seccion','$pago',NOW(),NOW())";
    if ($consulta = $this->conexion->conexion->query($sql)) {

             return 1;  
    }else{return 0;}

}

function Verificar_Existencia($alumno,$yearid){
   $sql = "SELECT Id_alumno,year_id FROM matricula WHERE Id_alumno='$alumno' and year_id='$yearid'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return count($arreglo);
        $this->conexion->cerrar();
      }
}


function Registrar_Pagos_de_Penciones($alumno,$pago,$yearid,$fecha_actual,$fechmas){
$sql = "insert into registopagos (alumno_id, tipo, year_id, motoPago, stadoPago, fechasPagados, prox_pago,dateoperation)
  values ('$alumno','MATRÍCULA','$yearid','$pago','PAGADO','$fecha_actual','$fechmas',NOW())";
    if ($consulta = $this->conexion->conexion->query($sql)) {

             return 1;  
    }else{return 0;}

}

function Registrar_Pagos_stado_de_pagos($alumno,$yearid,$fecha_actual,$fechmas,$cargo){
$sql = "insert into stadopenciones ( entidad, ultimoPagofecha, proximoPagoFecha, stado, userSesion, createDate, updateDate, yeayid,aplicargo)
  values ('$alumno','$fecha_actual','$fechmas','PAGADO','1',NOW(),NOW(),'$yearid','$cargo')";
    if ($consulta = $this->conexion->conexion->query($sql)) {

             return 1;  
    }else{return 0;}

}



function Quitar_vacantes_Grados($grado, $newVacante,$yearid){
   $sql = "UPDATE  grado SET vacantes='$newVacante' WHERE idgrado='$grado' AND year_id = '$yearid'";
           if ($consulta = $this->conexion->conexion->query($sql)) {      
              return 1;
         }else{
              return 0;
         }
}

function Listar_Alumnos_matriculados($yearid){
   $sql=  "select idalumno,apellidos,alumnonombre,gradonombre,nombreNivell,matricula.seccion,nombreaula,turno_nombre,dni from matricula
                      inner join  aula on aula.idaula = matricula.Id_aula
                     inner join  turnos on turnos.turno_id = matricula.Id_turno
                      inner join  niveles on niveles.idniveles = matricula.Id_nivls
                      inner join  alumno on alumno.idalumno = matricula.Id_alumno
                       inner join  grado on grado.idgrado = matricula.Id_grado 
                       where matricula.year_id='$yearid'  ORDER BY  alumno.dni DESC";

            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
     }
function Retirar_Alumnos_matriculado($idalumno,$yearid){
 $sql=   "DELETE FROM matricula WHERE Id_alumno = '$idalumno' and year_id='$yearid'";
      if ($consulta = $this->conexion->conexion->query($sql)) {

         $this->Quitar_registro_pago($idalumno,$yearid);
         return 1;
      }else{
        return 0;
      }
}

function Quitar_registro_pago($idalumno,$yearid){
$sql=   "DELETE FROM registopagos WHERE alumno_id = '$idalumno' and year_id='$yearid'";
      if ($consulta = $this->conexion->conexion->query($sql)) {

        $this->Quitar_Estado_De_pago($idalumno,$yearid);
        return 1;
      }else{
        return 0;
      }

}

function Quitar_Estado_De_pago($idalumno,$yearid){
$sql=   "DELETE FROM stadopenciones WHERE entidad = '$idalumno' and yeayid='$yearid'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      }else{
        return 0;
      }

}


function Extraer_Grado_Actual($idalumno,$yearid,$section){
    $sql=  "select Id_grado,Id_nivls from matricula where Id_alumno='$idalumno' and year_id='$yearid'  and seccion= '$section' ";
       $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo[]=$consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
}

function Extraer_Vacantes_Grado($idgrado,$Id_nivls,$section){
 //$sql=  "select vacantes from grado where idgrado='$idgrado' and year_id='$yearid'";
    $sql=  "select vacantes from grado where nivel_id='$Id_nivls' and idgrado='$idgrado' and seccion='$section' ";;
       $arreglo = array();
     if ($consulta = $this->conexion->conexion->query($sql)) {
         while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
            $arreglo[]=$consulta_VU;
         }
         return $arreglo;
         $this->conexion->cerrar();
    }

}

function Aumentar_Vacantes_grado($idgrado,$yearid, $newvacante){

  $sql = "UPDATE grado SET vacantes ='$newvacante'  where idgrado ='$idgrado' ";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      }else{
        return 0;
      }
}

 }

?>