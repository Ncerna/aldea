


<?php
class Boletin_Notas{
  private $conexion;
  function __construct(){
    require_once 'modelo_conexion.php';
    $this->conexion = new conexion();
    $this->conexion->conectar();
  }


  function listar_alumnos_Parametrizado($idyear){
   $sql=  "select idalumno,apellidos,alumnonombre,Id_grado,gradonombre,nombreNivell,matricula.seccion from matricula
   inner join  niveles on niveles.idniveles = matricula.Id_nivls
   inner join  alumno on alumno.idalumno = matricula.Id_alumno
   inner join  grado on grado.idgrado = matricula.Id_grado 
   where matricula.year_id='$idyear'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

      $arreglo["data"][]=$consulta_VU;

    }
    return $arreglo;
    $this->conexion->cerrar();
  }

}

function listar_TiposEvaluacion_year($year_id){
 $sql = "select ordenTipo_periodo,tipo_periodo, tipo_nombre from periodo 
 inner join  tipoevaluacion on tipoevaluacion.tipo_id = periodo.tipo_periodo
 where year_id='$year_id'";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
  while ($consulta_VU = mysqli_fetch_array($consulta)) {
    $arreglo[] = $consulta_VU;
  }
  return $arreglo;
  $this->conexion->cerrar();
}
}



function listar_Criterios_Curso($idcurso,$id_year, $idgrado){
  $sql = "SELECT idboletNota,criteriosEvaluacion FROM criterio where curso_id='$idcurso' and grado_id='$idgrado' and yearEscolar_id='$id_year' ";
  $arreglo = array();
  if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
      $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();

  }
}


function listars_CriteriosCursoID($output,$id_year,$idgrado){
  $sql = "select idboletNota,curso_id, criteriosEvaluacion from criterio where curso_id='$output' and yearEscolar_id='$id_year'
  and grado_id='$idgrado' ";
  $arreglo = array();
  if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
      $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();

  }
}

function Notas_Criterios_CursoID($idcurso){
  $sql = "select id_Criterio,calificacions,id_curso from  libretanotas where id_curso='$idcurso' ";
  $arreglo = array();
  if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
      $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();

  }
}


function Verifica_Ya_Existe($idAlumno,$idcurso,$id_year,$gradoid,$idnivel,$tipo){

 $sql = "SELECT  idalumno, id_curso, di_year, gradoId, niveiId, tipoEva FROM libretanotas

 where idalumno='$idAlumno' and id_curso ='$idcurso' and di_year='$id_year' and gradoId='$gradoid' and niveiId='$idnivel' and tipoEva='$tipo'  ";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
   while ($consulta_VU = mysqli_fetch_array($consulta)) {
    $arreglo[] = $consulta_VU;
  }
  return count($arreglo);
  $this->conexion->cerrar();
}
}

function Resetear_Table_Libreta($idAlumno,$idcurso,$id_year,$gradoid,$idnivel,$tipo,$iddocente){
 $sql=   "delete  from libretanotas
 where idalumno='$idAlumno' and id_curso ='$idcurso' and di_year='$id_year' and gradoId='$gradoid' and niveiId='$idnivel' and tipoEva='$tipo' and userSession='$iddocente' ";

 if ($consulta = $this->conexion->conexion->query($sql)) {
  return 1;
}else{
  return 0;
}

}


function Registrar_Criterio_Curso_Alumno($idAlumno,$idcriterios,$califili_crite,$idcurso,$id_year,$gradoid,$idnivel,$tipo, $idsession){
 $sql = "INSERT INTO libretanotas(idalumno, id_curso, di_year, calificacions, id_Criterio, gradoId, niveiId, tipoEva, creteDte,userSession) 
 VALUES ('$idAlumno', '$idcurso', '$id_year','$califili_crite','$idcriterios','$gradoid','$idnivel','$tipo', NOW(),$idsession)"; 

 if ($consulta = $this->conexion->conexion->query($sql)) {
  return 1;
}else{
  return 0;
}

}

function Extraer_Notas_CRiterios($idAlumno,$idcurso,$id_year){
  $sql = "SELECT idalumno,id_curso,di_year,calificacions,id_Criterio FROM libretanotas 
  where idalumno='$idAlumno' and id_curso ='$idcurso' and di_year='$id_year' ";
  $arreglo = array();
  if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
      $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();

  }
}
/////////////////////////////////////////////////////
////////SECCION DE NOTAS ALFABETICOS//////////////////
////////////////////////////////////////////////////

function Extraer_Notas_Alfabeticos($idAlumno,$idcurso,$id_year){
  $sql = "SELECT idalumno,id_curso,di_year,calificacions,id_Criterio FROM notasalfabetico 
  where idalumno='$idAlumno' and id_curso ='$idcurso' and di_year='$id_year' ";
  $arreglo = array();
  if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
      $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();

  }
}


function Verifica_Exsistencia($idAlumno,$idcurso,$id_year,$gradoid,$idnivel,$tipo){

 $sql = "SELECT  idalumno, id_curso, di_year, gradoId, niveiId, tipoEva FROM notasalfabetico

 where idalumno='$idAlumno' and id_curso ='$idcurso' and di_year='$id_year' and gradoId='$gradoid' and niveiId='$idnivel' and tipoEva='$tipo'  ";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
   while ($consulta_VU = mysqli_fetch_array($consulta)) {
    $arreglo[] = $consulta_VU;
  }
  return count($arreglo);
  $this->conexion->cerrar();
}
}

function Resetear_Table_notasalfabetico($idAlumno,$idcurso,$id_year,$gradoid,$idnivel,$tipo,$iddocente){
 $sql=   "delete  from notasalfabetico
 where idalumno='$idAlumno' and id_curso ='$idcurso' and di_year='$id_year' and gradoId='$gradoid' and niveiId='$idnivel' and tipoEva='$tipo' and userSession='$iddocente' ";

 if ($consulta = $this->conexion->conexion->query($sql)) {
  return 1;
}else{
  return 0;
}

}

function Registrar_notas_Curso_Alumno_alfabeticos($idAlumno,$idcriterios,$califili_crite,$idcurso,$id_year,$gradoid,$idnivel,$tipo, $idsession){
 $sql = "INSERT INTO notasalfabetico(idalumno, id_curso, di_year, calificacions, id_Criterio, gradoId, niveiId, tipoEva, creteDte,userSession) 
 VALUES ('$idAlumno', '$idcurso', '$id_year','$califili_crite','$idcriterios','$gradoid','$idnivel','$tipo', NOW(),$idsession)"; 

 if ($consulta = $this->conexion->conexion->query($sql)) {
  return 1;
}else{
  return 0;
}

}
//////////////////////////////////////////////////////
////////////////FIN SECCION NOTA ALFABETICOS////////////
/////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
///////////////ECCION NETAMENTE DEL DOCEMNTE REGISTRRO NOTAS/////////////////
///////////////////////////////////////////////////////////////////////////////

function Registrar_Notas_Criterio_Docente($idAlumno,$idcriterios,$califili_crite,$idcurso,$id_year,$gradoid,$idnivel,$tipo,$iddocente){
 $sql = "INSERT INTO libretanotas(idalumno, id_curso, di_year, calificacions, id_Criterio, gradoId, niveiId, tipoEva, creteDte,userSession) 
 VALUES ('$idAlumno', '$idcurso', '$id_year','$califili_crite','$idcriterios','$gradoid','$idnivel','$tipo', NOW(),'$iddocente')"; 

 if ($consulta = $this->conexion->conexion->query($sql)) {
  return 1;
}else{
  return 0;
}

}



}
?>