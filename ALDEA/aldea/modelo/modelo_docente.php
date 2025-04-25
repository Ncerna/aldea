<?php

class Docente{
  private $conexion;
  function __construct(){
    require_once 'modelo_conexion.php';
    $this->conexion = new conexion();
    $this->conexion->conectar();
  }

  function listar_docente(){
    $sql=  "select id_docente, nombres, apellidos, dni, nombreNivell,telefono, tipo_docente from docentes
   inner join  niveles on niveles.idniveles = docentes.nivelId where estado_baja ='1'";

    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
     while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

       $arreglo["data"][]=$consulta_VU;

     }
     return $arreglo;
     $this->conexion->cerrar();
   }
 }

function VerificarDocenteexiste($dniDocente,$emailDocente,$codigDocente){
$sql = "select dni, email, codigo from docentes where dni='$dniDocente' or  email='$emailDocente' or  codigo='$codigDocente'";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
  while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

   $arreglo[]=$consulta_VU;

 }
 return count($arreglo);
 $this->conexion->cerrar();
}

}
public function Show_Data_Docente($idDocente) {
    $sql = "SELECT 
              id_docente,
              nombres,
              apellidos,
              dni,
              email,
              telefono,
              codigo,
              nivelId,
              
              matricula,
              cargo_mec,
              cargo_int,
              clase_cargo,
              turno,
              nivel_mec,
              titulos_obtenidos,
              identificacion_aldea,
              estado_civil,
              lugar_nacimiento,
              cargo_aldea,
              nivel_grado,

              tipo_docente,
              fecha_ingreso,
              nacionalidad,
              antiguedad,
              antiguedad_docencia,
              renuncia,
              tipo_contrato,
              observaciones,

              foto_docente,
              cv_docente,
              titulo_docente,
              constancia_docente,
              capacitaciones_docente
            FROM docentes 
            WHERE id_docente = '$idDocente'";

    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        // $this->conexion->cerrar(); <-- Esto nunca se ejecuta, pero lo puedes mover fuera si quieres cerrar
    }
}

public function Actualizar_Docente(
    $nombreDocente, $apellidDocente, $dniDocente, $emailDocente, $telfDocente,
    $codigDocente, $nivelDocente,
    $matricula, $cargoMec, $cargoInt, $claseCargo, $turno, $nivelMec,
    $titulosObtenidos, $identificacionAldea, $estadoCivil, $lugarNacimiento,
    $cargoAldea, $nivelGrado,
    $tipoDocente, $fechaIngreso, $nacionalidad, $antiguedad, $antiguedadDocencia,
    $renuncia, $tipoContrato, $observaciones,
    $nombreFoto, $nombreCV, $nombreTitulo, $nombreConstancia, $nombreCapacitaciones,
    $idDocente
) {
    $sql = "UPDATE docentes SET 
        nombres='$nombreDocente',
        apellidos='$apellidDocente',
        dni='$dniDocente',
        email='$emailDocente',
        telefono='$telfDocente',
        codigo='$codigDocente',
        nivelId='$nivelDocente',

        matricula='$matricula',
        cargo_mec='$cargoMec',
        cargo_int='$cargoInt',
        clase_cargo='$claseCargo',
        turno='$turno',
        nivel_mec='$nivelMec',
        titulos_obtenidos='$titulosObtenidos',
        identificacion_aldea='$identificacionAldea',
        estado_civil='$estadoCivil',
        lugar_nacimiento='$lugarNacimiento',
        cargo_aldea='$cargoAldea',
        nivel_grado='$nivelGrado',

        tipo_docente='$tipoDocente',
        fecha_ingreso='$fechaIngreso',
        nacionalidad='$nacionalidad',
        antiguedad='$antiguedad',
        antiguedad_docencia='$antiguedadDocencia',
        renuncia='$renuncia',
        tipo_contrato='$tipoContrato',
        observaciones='$observaciones',
        updateDate=NOW()";

    // Agregar archivos si existen
    if ($nombreFoto !== null) {
        $sql .= ", foto_docente='$nombreFoto'";
    }
    if ($nombreCV !== null) {
        $sql .= ", cv_docente='$nombreCV'";
    }
    if ($nombreTitulo !== null) {
        $sql .= ", titulo_docente='$nombreTitulo'";
    }
    if ($nombreConstancia !== null) {
        $sql .= ", constancia_docente='$nombreConstancia'";
    }
    if ($nombreCapacitaciones !== null) {
        $sql .= ", capacitaciones_docente='$nombreCapacitaciones'";
    }

    $sql .= " WHERE id_docente='$idDocente'";

    if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
    } else {
        return 0;
    }
}


//REGISTRO DE DOCENTE CON ROL JARCODIN 2

function Registrar_Docente($nombreDocente, $apellidDocente, $dniDocente, $emailDocente, $telfDocente,
                           $codigDocente, $nivelDocente, $tipoDocente, $matricula, $cargoMec, $cargoInt,
                           $claseCargo, $turno, $nivelMec, $titulosObtenidos, $identificacionAldea, $estadoCivil,
                           $lugarNacimiento, $cargoAldea, $nivelGrado, $fechaIngreso, $nacionalidad,
                           $antiguedad, $antiguedadDocencia, $renuncia, $tipoContrato, $observaciones,
                           $nombreFoto, $nombreCV, $nombreTitulo, $nombreConstancia, $nombreCapacitaciones) {

  $sql = "INSERT INTO docentes(
              nombres, apellidos, dni, email, telefono, codigo, rolDocente, tipo_docente, nivelId,
              matricula, cargo_mec, cargo_int, clase_cargo, turno, nivel_mec, titulos_obtenidos,
              identificacion_aldea, estado_civil, lugar_nacimiento, cargo_aldea, nivel_grado,
              fecha_ingreso, nacionalidad, antiguedad, antiguedad_docencia, renuncia, tipo_contrato,
              observaciones, foto_docente, cv_docente, titulo_docente, constancia_docente,
              capacitaciones_docente, createDate
          ) VALUES (
              '$nombreDocente', '$apellidDocente', '$dniDocente', '$emailDocente', '$telfDocente',
              '$codigDocente', '2', '$tipoDocente', '$nivelDocente',
              '$matricula', '$cargoMec', '$cargoInt', '$claseCargo', '$turno', '$nivelMec', '$titulosObtenidos',
              '$identificacionAldea', '$estadoCivil', '$lugarNacimiento', '$cargoAldea', '$nivelGrado',
              '$fechaIngreso', '$nacionalidad', '$antiguedad', '$antiguedadDocencia', '$renuncia',
              '$tipoContrato', '$observaciones', '$nombreFoto', '$nombreCV', '$nombreTitulo',
              '$nombreConstancia', '$nombreCapacitaciones', NOW()
          )";

  if ($consulta = $this->conexion->conexion->query($sql)) {
    return 1;
  } else {
    return 0;
  }

  $this->conexion->cerrar();
}



function Baja_Docente_Registrado($idDocente){
 $sql = "update docentes set estado_baja ='0' where id_docente='$idDocente' ";
 if ($consulta = $this->conexion->conexion->query($sql)) {
  return 1;

}else{
  return 0;
}

}


/////////////////////////////////////////////////////////////////
///////////////DOCENTE CONFIGURACION////////////////////
//////////////SECCION CONFIGURACIONES///////////////////
///////////////////////////////////////////////

//COMOBO DE DOCENTE EN ASISGACION DE DOCENTE GRADOS
function Listar_Docentes_Disponibles(){
 $sql = "select id_docente, nombres, apellidos,idniveles,nombreNivell from docentes
 inner join  niveles on niveles.idniveles = docentes.nivelId";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
  while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

   $arreglo["data"][]=$consulta_VU;

 }
 return $arreglo;
 $this->conexion->cerrar();
}
}

//LISTAR COMBO DE GRADOS EN ASISGNACUON DE GRADOS DOCENTES

function listar_combo_Grados(){
 $sql = "select idgrado, gradonombre,nivel_id,nombreNivell,turno_id,seccion from grado
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

///VERIFICAR SI EL GRADO YA ESTA AGREGADO AL DOCENTE
function VerificarSiGradoYaEstaAgregadoParaDocente($idgrado,$idnivelgrado,$idsecciones,$yearid,$iddocente){
  $sql = "SELECT gradoId, nivelgradiId,idseccion, yearId FROM docente_grados where gradoId='$idgrado' and nivelgradiId='$idnivelgrado' and yearId='$yearid' and idseccion='$idsecciones' and docenteId= '$iddocente'";
  $arreglo = array();
  if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

      $arreglo[]=$consulta_VU;

    }
    return count($arreglo);
    $this->conexion->cerrar();
  }

}

//REGISTRAR DOCENTE Y SUS GRADOS
function Registro_Docente_Grado($iddocente,$idgrado,$idnivelgrado,$idsecciones,$yearid){
  $sql = "insert into docente_grados(docenteId, gradoId, nivelgradiId,idseccion,yearId,sesionId, createDate)
  values ('$iddocente','$idgrado','$idnivelgrado','$idsecciones','$yearid','0',NOW())";

  if ($consulta = $this->conexion->conexion->query($sql)) {
   return 1;

 }else{
  return 0;
}
}

//VER GRADOS ASISGNADOS A GRADOS A LOS DOCENTES
function listar_Grados_Docente($iddocente,$yearid){

 $sql = "select  gradoId, gradonombre,nivel_id,nombreNivell,idseccion FROM docente_grados
 inner join  grado on grado.idgrado = docente_grados.gradoId 
 inner join  niveles on niveles.idniveles = docente_grados.nivelgradiId
 where docenteId='$iddocente'  and yearId='$yearid' ";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
  while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
    $arreglo[]=$consulta_VU;
  }
  return $arreglo;
  $this->conexion->cerrar();
}

}

//QUITAR GRADOS ASIGNADOS A LOS DOCENTES
function Quitrar_Grados_Asignados($idgrado,$idocente,$yearid){
  $sql=   " DELETE FROM docente_grados WHERE gradoId = '$idgrado' and docenteId='$idocente' and yearId='$yearid'";
  if ($consulta = $this->conexion->conexion->query($sql)) {

     $this->Quitrar_Cursos_DelDocente ($idgrado,$idocente,$yearid);
    return 1;

  }else{
    return 0;
  }

}

//QUITAR CURSOS PERTENECIENTES AL GRADOS DEL DOCENTES

function Quitrar_Cursos_DelDocente ($idgrado,$idocente,$yearid){
  $sql=   " DELETE FROM docente_curso WHERE idGrado = '$idgrado' and idDocente='$idocente' and idyear='$yearid'";
  if ($consulta = $this->conexion->conexion->query($sql)) {
    return 1;

  }else{
    return 0;
  }

}

//iddocenteCurso, idDocente, idGrado, idCursos, idyear, Seccion, idSession, createDate, updateDate
//VERIFICAR SI YA EXITE CURSO ASIGNADO
function VerificarCursoYaExisteParaDocente($idgrado, $idcurso ,$iddocente,$yearid,$idseccion){

   $sql = "SELECT idDocente, idGrado, idCursos, idyear, Seccion FROM docente_curso where idDocente='$iddocente' and idGrado='$idgrado' and idCursos='$idcurso' and idyear='$yearid' and Seccion='$idseccion'";
  $arreglo = array();
  if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
      $arreglo[]=$consulta_VU;
    }
    return count($arreglo);
    $this->conexion->cerrar();
  }

}


//REGISTAR CUESO Y GRADOS INDIVIDUALMENTE
function RegistarCursosDocente($iddocente,$idgrado,$idcurso ,$yearid,$idseccion){
 $sql = "insert into docente_curso(idDocente, idGrado, idCursos, idyear, Seccion, createDate)
  values ('$iddocente','$idgrado','$idcurso ','$yearid','$idseccion',NOW())";
  if ($consulta = $this->conexion->conexion->query($sql)) {
   return 1;
 }else{
  return 0;
}

}

function Gados_Docente_Asignado($id_docente ,$yearid){
   $sql = "SELECT gradoId FROM docente_grados where docenteId='$id_docente' and yearId='$yearid' ";
  $arreglo = array();
  if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
      $arreglo[]=$consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();
  }
}

function CursosDelGado($idsBDCurso,$gradoId,$yearid){
   $sql = "select curso_id,nonbrecurso,grado_id,Idseccion FROM grado_curso
    inner join  curso on curso.idcurso = grado_curso.curso_id

    where grado_id='$gradoId' and yearEscolar='$yearid' ";
  if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

      array_push($idsBDCurso,$consulta_VU);
    }
    return $idsBDCurso;
    $this->conexion->cerrar();
  }
}




function listar_Materias_Docentes($id_docente ,$yearid){

  $sql = "select idCursos , nonbrecurso FROM docente_curso
 inner join  curso on curso.idcurso = docente_curso.idCursos
 where idDocente='$id_docente'  and idyear='$yearid' ";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
  while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
    $arreglo[]=$consulta_VU;
  }
  return $arreglo;
  $this->conexion->cerrar();
}
}

function Extraer_Ides_BD_CursosDocente($iddocente,$yearid){
   $sql = "select idCursos,nonbrecurso FROM docente_curso
    inner join  curso on curso.idcurso = docente_curso.idCursos
    where idDocente='$iddocente'   and idyear='$yearid'";
$arreglo = array();
  if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

      $arreglo[]=$consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();
  }
}

function RegistrarNuevoCursoDocente($iddocente,$yearid,$idgrado,$idcurso,$iseccion){

  $sql = "insert into docente_curso(idDocente, idGrado, idCursos, idyear,Seccion, updateDate)
  values ('$iddocente','$idgrado','$idcurso','$yearid','$iseccion',NOW())";
  if ($consulta = $this->conexion->conexion->query($sql)) {
   return 1;
 }else{
  return 0;
}
}

function QuitarCursosDocente($iddocente,$yearid,$val){ 
 $sql=   " DELETE FROM docente_curso WHERE idDocente = '$iddocente' and idyear='$yearid' and idCursos='$val'";
  if ($consulta = $this->conexion->conexion->query($sql)) {
    return 1;

  }else{
    return 0;
  }

  
}
//////////////////////////////////////////////////////////////////
////SECCION FUNCIONES NETAMENTE DOCENTE INDIVIDUALES//////////////
////////////////////////////////////////////////////////////////

function listar_MaterialesPorCadaGrado($iddocente,$yearid,$gradoId){
  $sql = "select idCursos , nonbrecurso FROM docente_curso
 inner join  curso on curso.idcurso = docente_curso.idCursos
 where idDocente='$iddocente'  and idyear='$yearid' and idGrado='$gradoId'";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
  while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
    $arreglo[]=$consulta_VU;

  }
  return $arreglo;
  $this->conexion->cerrar();
}

}

function CursosDelGadoByIdDocente($idsBDCurso, $gradoId,$yearid,$id_docente){
 $sql = "select idCursos,nonbrecurso,idGrado,Seccion FROM docente_curso
    inner join  curso on curso.idcurso = docente_curso.idCursos
    where idGrado='$gradoId' and idyear='$yearid' and idDocente='$id_docente'";
  if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

      array_push($idsBDCurso,$consulta_VU);
    }
    return $idsBDCurso;
    $this->conexion->cerrar();
  }

}


function listar_ActividadesDelCurso($cargas,$yearid,$idCursos){
    $sql=  "select idactiviti,yearId_act,idcurso,cursoCodigo,nonbrecurso,ordeperiodoTipo,tipo_nombre from activiti
    inner join  curso on curso.idcurso = activiti.curso_act
    inner join  tipoevaluacion on tipoevaluacion.tipo_id = activiti.tipo_evalu

     where yearId_act='$yearid' and curso_act ='$idCursos'";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
           
             array_push($cargas, $consulta_VU);
        }
        return $cargas;
        $this->conexion->cerrar();
    }

}

function Listar_cursos_docente($id_docente,$yearid){
  $sql = "select idCursos,nonbrecurso,cursoCodigo,docente_curso.idGrado,docente_curso.Seccion,grado.gradonombre,grado.seccion FROM docente_curso
    inner join  curso on curso.idcurso = docente_curso.idCursos
    LEFT join grado on grado.idgrado =docente_curso.idGrado

    where  idyear='$yearid' and idDocente='$id_docente'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }
}

  function listar_alumnos_de_Grados_Docente($alumnos, $gradoId,$yearid){

   $sql=  "select idalumno,apellidos,alumnonombre,Id_grado,gradonombre,nombreNivell,matricula.seccion from matricula
   inner join  niveles on niveles.idniveles = matricula.Id_nivls
   inner join  alumno on alumno.idalumno = matricula.Id_alumno
   inner join  grado on grado.idgrado = matricula.Id_grado 
   where matricula.year_id='$yearid' and Id_grado='$gradoId'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

       array_push($alumnos,$consulta_VU);

    }
    return $alumnos;
    $this->conexion->cerrar();
  }

}

function listar_Cursos_De_Docentes($iddocente,$gradoid,$yearid){
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


function Horarios_Grados_Docente($idgrados, $gradoId,$yearid){
   $sql=  " select idhorario,gradoId,gradonombre,turnoId,turno_nombre,nivelId,nombreNivell,seccionId,jornadId,horario25.aula_id,nombreaula from horario25
      inner join  grado on grado.idgrado = horario25.gradoId 
      inner join  turnos on turnos.turno_id = horario25.turnoId
      inner join  niveles on niveles.idniveles = horario25.nivelId
      inner join  aula on aula.idaula = horario25.aula_id

      where yearId='$yearid' and gradoId='$gradoId' ";
  
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

       array_push($idgrados,$consulta_VU);

    }
    return $idgrados;
    $this->conexion->cerrar();
  }

}

}
?>