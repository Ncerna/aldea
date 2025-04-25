
<?php
    class Asistensia{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }


/*
function Listar_AsistenciasPersonl(){
   $sql="select idalumno,apellidos,alumnonombre from matricula
                    
                      
                      inner join  alumno on alumno.idalumno = matricula.Id_alumno
                       ";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo[]=$consulta_VU;

                }
                return $arreglo;
                $this->conexion->cerrar();
            }

}
*/


function Listar_AsistenciasPersonl($idgrado,$idnivel,$idsecion,$idyear){
 $sql="select idalumno,apellidos,alumnonombre,gradonombre,nombreNivell,matricula.seccion from matricula
 
 inner join  niveles on niveles.idniveles = matricula.Id_nivls
 inner join  alumno on alumno.idalumno = matricula.Id_alumno
 inner join  grado on grado.idgrado = matricula.Id_grado 
 where matricula.year_id='$idyear' and Id_nivls='$idnivel' and Id_grado='$idgrado' and matricula.seccion='$idsecion'";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
  while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

    $arreglo[]=$consulta_VU;

  }
  return $arreglo;
  $this->conexion->cerrar();
}

}

function Registro_Asistencia($vectorIdpersonas,$fechas,$vectorEstado,$idgrado,$idnivel,$idsecion,$idyear){
  $sql="INSERT INTO asistencia(idalumno_asi, Fechas, Est_Asis, idgrado, idnivel, idseccion, yearid) VALUES ('$vectorIdpersonas','$fechas','$vectorEstado','$idgrado','$idnivel','$idsecion','$idyear')";
  if ($consulta = $this->conexion->conexion->query($sql)) {
   return 1;

 }else{
  return 0;
}


}

function Buscar_Asistencias($fechaEntrada, $idgrado,$idnivel,$idsecion,$idyear){

  $sql="select idalumno,apellidos,alumnonombre,gradonombre,nombreNivell,idseccion,Est_Asis from asistencia
  inner join  niveles on niveles.idniveles = asistencia.idnivel
 inner join  alumno on alumno.idalumno = asistencia.idalumno_asi
 inner join  grado on grado.idgrado = asistencia.idgrado 
  where Fechas='$fechaEntrada' and asistencia.idgrado='$idgrado' and idnivel='$idnivel' and idseccion='$idsecion' and yearid='$idyear' ";

  $arreglo = array();
  if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

      $arreglo[]=$consulta_VU;

    }
    return $arreglo;
    $this->conexion->cerrar();
  }


}


function Actualizar_Asistencia($IdPersona,$vectorEstado,$fechas) {

    $sql = "UPDATE  asistencia SET Est_Asis='$vectorEstado' WHERE Fechas='$fechas' AND idalumno_asi = '$IdPersona'";
           if ($consulta = $this->conexion->conexion->query($sql)) {      
              return 1;
              
            }else{
              return 0;
            }

}

function Filtrar_asistencias($fechainicio,$fechafin,$idgrado,$idnivel,$idsecion,$idyear){
$sql=" select apellidos,alumnonombre,Fechas,stadoalumno,Est_Asis from asistencia
  inner join  alumno on alumno.idalumno= asistencia.idalumno_asi
 WHERE (Fechas >= '$fechainicio' AND Fechas <= '$fechafin') and idgrado='$idgrado' and idnivel='$idnivel' and idseccion='$idsecion' and yearid='$idyear' ";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo[]=$consulta_VU;

                }
                return $arreglo;
                $this->conexion->cerrar();
            }

}

function Extraer_asistencias($fechainicio,$fechafin){

  $sql=" select idalumno,apellidos,alumnonombre,Fechas,stadoalumno,Est_Asis from asistencia
  inner join  alumno on alumno.idalumno= asistencia.idalumno_asi
 WHERE (Fechas >= '$fechainicio' AND Fechas <= '$fechafin')";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo["data"][]=$consulta_VU;

                }
                return $arreglo;
                $this->conexion->cerrar();
            }
}





function Eliminar_asistencias($fechainicio,$fechafin,$idgrado,$idnivel,$idsecion,$idyear){

$sql=   "DELETE FROM asistencia WHERE (Fechas >= '$fechainicio' AND Fechas <= '$fechafin') and idgrado='$idgrado' and idnivel='$idnivel' and idseccion='$idsecion' and yearid='$idyear'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      }else{
        return 0;
      }


}


function verificar_Asistencia($fechas){
 $sql = "SELECT Fechas FROM asistencia where Fechas='$fechas'";
    $arreglo = array();

    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        return count($arreglo);
        $this->conexion->cerrar();
    }

}


    }
?>
