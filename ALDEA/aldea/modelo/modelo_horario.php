<?php
    class  Horario{
        public  $codigo;

        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
            $this->codigo='';
        }
    
 function Listar_combo_Jornadas($yearid){
     $sql = "select IdJornas,gradoid,gradonombre,tunoid,turno_nombre,nivelGrado,nombreNivell,seccionjor,jornadas.idAula,nombreaula from jornadas
    inner join  turnos on turnos.turno_id = jornadas.tunoid
    inner join  grado on grado.idgrado = jornadas.gradoid
     inner join  niveles on niveles.idniveles = jornadas.nivelGrado
     inner join  aula on aula.idaula = jornadas.idAula
    where IdJornYear ='$yearid'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
              $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }
  }

 function Listar_combo_Cursos_Grados($idgrado,$yearid){
     $sql = "select idcurso, nonbrecurso from grado_curso
         inner join  curso on curso.idcurso = grado_curso.curso_id
         where grado_id='$idgrado' and yearEscolar='$yearid'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
              $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }
  }

  function Datos_colegio_horario_imprimir(){
     $sql = "SELECT idColegio, nameColegio,  emailColegio, ubicacion, logoColegio, escudoPais,  ugel FROM colegio";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
              $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }
  }


function Listar_Horas_Jornadas($idjornada,$yearid,$idgrado,$idnivel,$seccion,$turnoId){
  
  $sql = "select HorJor_id, Hora_inicio, hora_final FROM jornas_horas
 where jorna_ID='$idjornada' and gradoId='$idgrado' and yearId='$yearid' and nivelGrado_id='$idnivel'  and seccionHor='$seccion' and turnoId='$turnoId'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
              $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }

}


function listar_Cursos_De_Docentes_Horario($iddocente,$gradoid,$yearid){
  $sql = "select idCursos,nonbrecurso  FROM docente_curso
    inner join  curso on curso.idcurso = docente_curso.idCursos
    where  idyear='$yearid' and idDocente='$iddocente' and idGrado='$gradoid' ";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }
}


 function Registar_horas_Crusos($tdId, $idhora, $idcurso, $dia,$idgrado,$idturno,$idnivel,$idseccion,$idjornada,$idyear,$ihorario) {
            
         $sql ="INSERT INTO horario_curso ( idtd, idhora, idcurso, dia, gradoid, turnoId, nivelId, seccionId, idjornada, idyear, FechRegistro,idhoraio)

          VALUES ('$tdId','$idhora','$idcurso','$dia','$idgrado','$idturno','$idnivel','$idseccion','$idjornada','$idyear',NOW(),'$ihorario') ";
            if ($consulta = $this->conexion->conexion->query($sql)) {
            return 1;
                
            }else{
                return 0;
                 $this->conexion->cerrar();
            } 
       
        }

/*
function Verificar_Existe($idcodigo){
$sql = "SELECT codigoId FROM horario25 where codigoId='$idcodigo'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
              $arreglo[] = $consulta_VU;
        }
        return count($arreglo);
        $this->conexion->cerrar();
      }

}*/

function All_Verificar_Exite_horario($idgrado,$idturno,$idnivel,$idseccion,$idjornada,$idyear,$idcodigo){
$sql=  "select  gradoId, turnoId, nivelId, seccionId, jornadId, yearId from horario25
                        
                       where  gradoId='$idgrado' and turnoId='$idturno' and nivelId='$idnivel' and seccionId='$idseccion' and jornadId='$idjornada' and yearId='$idyear' ";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo[]=$consulta_VU;

                }
                return count($arreglo);
                $this->conexion->cerrar();
            }

}

function Registar_horaios($idgrado,$idturno,$idnivel,$idseccion,$idjornada,$idyear,$idaula){
$sql ="INSERT INTO horario25 ( gradoId, turnoId, nivelId, seccionId, jornadId, yearId,aula_id, datecreat)
          VALUES ('$idgrado','$idturno','$idnivel','$idseccion','$idjornada','$idyear','$idaula',NOW()) ";
            if ($consulta = $this->conexion->conexion->query($sql)) {

             $ihorario = mysqli_insert_id($this->conexion->conexion);
            return $ihorario;
                
            }else{
                return 0;
                 $this->conexion->cerrar();
            } 
}

  function eliminar($tdId){
          
             $sql=  "DELETE FROM horario_curso WHERE idtd = '$tdId' ";

            if ($consulta = $this->conexion->conexion->query($sql)) {
              return 1;
        
            }else{
                return 0;
             }

    }


    function listar_Horario_Disponibles($yearid){
      $sql=  "select idhorario,gradoId,gradonombre,turnoId,turno_nombre,nivelId,nombreNivell,seccionId,jornadId,horario25.aula_id,nombreaula from horario25
      inner join  grado on grado.idgrado = horario25.gradoId 
      inner join  turnos on turnos.turno_id = horario25.turnoId
      inner join  niveles on niveles.idniveles = horario25.nivelId
      inner join  aula on aula.idaula = horario25.aula_id

      where yearId='$yearid'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

          $arreglo["data"][]=$consulta_VU;

        }
        return $arreglo;
        $this->conexion->cerrar();
      }
    }


  function delete_registro_horario($codigo){
     $sql=  "DELETE FROM horario25 WHERE idhorario = '$codigo' ";
            if ($consulta = $this->conexion->conexion->query($sql)) {

               $this->Delete_horario_Curso($codigo);
              return 1;
            }else{
                return 0;
             }
   }

 function Delete_horario_Curso($codigo){
     $sql=  "DELETE FROM horario_curso WHERE idhoraio = '$codigo' ";
            if ($consulta = $this->conexion->conexion->query($sql)) {
              return 1;
            }else{
                return 0;
             }
   }


   function ListarHoras($idjornada) {
     $sql = "select HorJor_id, Hora_inicio, hora_final FROM jornas_horas
     where jorna_ID='$idjornada' ";
     $arreglo = array();
     if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
      $this->conexion->cerrar();
    }

  }


 function mostratarHorario($dia,$hora,$seccion){

    $sql="select idhoraio, idtd,nonbrecurso from horario_curso 
             inner join curso  on curso.idcurso = horario_curso.idcurso
             WHERE idhora = '$hora' AND dia = '$dia' and seccionId='$seccion' ";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo[]=$consulta_VU;

                }
                return $arreglo;
                $this->conexion->cerrar();
            }
            
           }

function Verificar_Existe($idgrado,$idturno,$idnivel,$idseccion,$idjornada,$idyear){
 $sql="select  gradoId, turnoId, nivelId, seccionId, jornadId, yearId, datecreat from horario25 
 WHERE gradoId = '$idgrado' and turnoId = '$idturno'
and nivelId='$idnivel' and seccionId='$idseccion' and jornadId='$idjornada' and yearId='$idyear'";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo[]=$consulta_VU;

                }
                return count($arreglo);
                $this->conexion->cerrar();
            }

}




    function Imprimir_horario_clases25($idhorario){
      $sql=  "select gradonombre,turno_nombre,nombreNivell,seccionId,nombreaula from horario25
      inner join  grado on grado.idgrado = horario25.gradoId 
      inner join  turnos on turnos.turno_id = horario25.turnoId
      inner join  niveles on niveles.idniveles = horario25.nivelId
      inner join  aula on aula.idaula = horario25.aula_id

      where idhorario='$idhorario'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

          $arreglo[]=$consulta_VU;

        }
        return $arreglo;
        $this->conexion->cerrar();
      }
    }

  ///////////////////////////////////////////////////







   function ConsultarHorario($dia,$hora){

    $sql="select idtd,nonbrecurso from horario_curso 
             inner join curso  on curso.idcurso = horario_curso.idcurso
             WHERE idhora = '$hora' AND dia = '$dia' ";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo[]=$consulta_VU;

                }
                return $arreglo;
                $this->conexion->cerrar();
            }
            
           }


///MOSTRAR CURSOS DE LOS GRADOS ASIGNADOS A LOS DOCENTES

 function Mostrar_Cursos_De_Grados_Docente($dia,$hora,$seccion){

    $sql="select idhoraio, idtd,horario_curso.idcurso,nonbrecurso from horario_curso 
             inner join curso  on curso.idcurso = horario_curso.idcurso
             WHERE idhora = '$hora' AND dia = '$dia' and seccionId='$seccion' ";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo[]=$consulta_VU;

                }
                return $arreglo;
                $this->conexion->cerrar();
            }
            
           }

////////////////////////////////////////
//////////HORARIO nETAMENTE ALUMNO/////////
//////////////////////////////////////////
function Grado_Alumno_Matriculado_Horario($yearid,$alumnoid){
$sql = " select Id_grado,Id_turno,Id_nivls,seccion from matricula where Id_alumno='$alumnoid' and year_id='$yearid'"; 
    
  $arreglo = array();
       if ($consulta = $this->conexion->conexion->query($sql)) {
       while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                $arreglo[]=$consulta_VU;
      }
       return $arreglo;
       $this->conexion->cerrar();

      }


}


function Listar_Horas_Horario_Alumno($yearid,$idgrado,$seccion,$turnoId){
  
  $sql = "SELECT HorJor_id, Hora_inicio,hora_final, gradoId FROM jornas_horas
where gradoId='$idgrado' and turnoId='$turnoId' and seccionHor='$seccion' and yearId='$yearid'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
              $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }

}

 function Mostrar_Cursos_Horario_Alumno($dia,$hora,$seccion,$idgrado){

    $sql="select idhoraio, idtd,nonbrecurso from horario_curso 
             inner join curso  on curso.idcurso = horario_curso.idcurso
             WHERE idhora = '$hora' AND dia = '$dia' and seccionId='$seccion' and gradoid='$idgrado' ";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo[]=$consulta_VU;

                }
                return $arreglo;
                $this->conexion->cerrar();
            }
            
           } 

function Imprimir_horario_clases25_Alumno($yearid,$idgrado,$idseccion,$Id_turno){
      $sql=  "select gradonombre,turno_nombre,nombreNivell,seccionId,nombreaula from horario25
      inner join  grado on grado.idgrado = horario25.gradoId 
      inner join  turnos on turnos.turno_id = horario25.turnoId
      inner join  niveles on niveles.idniveles = horario25.nivelId
      inner join  aula on aula.idaula = horario25.aula_id

      where gradoId='$idgrado' and seccionId='$idseccion' and turnoId='$Id_turno' and yearId='$yearid' ";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

          $arreglo[]=$consulta_VU;

        }
        return $arreglo;
        $this->conexion->cerrar();
      }
    }

function Extraer_Year_Activo(){
   $sql=  "SELECT id_year FROM yearscolar where stadoyear='ACTIVO'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

          $arreglo[]=$consulta_VU;

        }
        return $arreglo;
        $this->conexion->cerrar();
      }
}

    }
?>