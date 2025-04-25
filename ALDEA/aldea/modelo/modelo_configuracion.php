
<?php
class Configuracion{
private $conexion;
function __construct(){
    require_once 'modelo_conexion.php';
    $this->conexion = new conexion();
    $this->conexion->conectar();
}

//REGISTAR AÑO ESCOLAR
function Registrar_Configuracion_year($fechainicio,$fechafin,$cierramatricula,$tipoevaluacion,$yearScolar){

    $sql = "INSERT INTO yearscolar(fechainicio, fechafin, cierramatricula,tipoevaluacion,yearScolar	,stadoyear)
     VALUES ('$fechainicio','$fechafin','$cierramatricula','$tipoevaluacion','$yearScolar', 'INACTIVO')"; 
    if (mysqli_query($this->conexion->conexion, $sql)) {
        return  mysqli_insert_id($this->conexion->conexion);
     }
   else{
       return 0;
     }
     }
    //UPDTE AÑO ESCOLAR 
function Update_Configuracion_year($idyear,$fechainicio,$fechafin, $cierrematricula, $tipoevaluacion, $yearScolar){

  $sql = "UPDATE yearscolar SET fechainicio='$fechainicio', fechafin = '$fechafin',cierramatricula = '$cierrematricula',tipoevaluacion='$tipoevaluacion',yearScolar='$yearScolar' WHERE id_year = '$idyear'";

if ($consulta = $this->conexion->conexion->query($sql)) {
    return 1; 
}else{
    return 0;
}

}

function Verificar_Estado_Year($id){

     $sql=  "select yearScolar from yearscolar where stadoyear='ACTIVO' ";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
            $arreglo[]=$consulta_VU;
        }
        return count($arreglo);
        $this->conexion->cerrar();
    } 
}

function Modificar_Estado_Year($id, $stad){
$sql = "UPDATE yearscolar SET stadoyear='$stad' WHERE id_year = '$id'";

if ($consulta = $this->conexion->conexion->query($sql)) {
    return 1; 
}else{
    return 0;
}

}

function Verificar_Existencia_year($yearScolar){
    $sql=  "select yearScolar from yearscolar where yearScolar='$yearScolar' ";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
            $arreglo[]=$consulta_VU;
        }
        return count($arreglo);
        $this->conexion->cerrar();
    } 
}

function Eliminando_Porque_noSeCreoHoras($idyear){

    $sql=   "DELETE FROM yearscolar WHERE id_year = '$idyear'";

     if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
       }else{
          return 0;
           }

}

//REGISTRAR TURNOS-HORAS DEL AÑO ESCOLAR
function Registrar_Turno_Hora($idyear, $inicioH, $finH,$turno_id){
   $sql = "INSERT INTO turnos_hora(Id_year, inicioHora, finHora, idturno, stad)
     VALUES ('$idyear', '$inicioH', '$finH','$turno_id','ACTIVO')"; 

     if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
       }else{
          return 0;
           }
}

//RESETAER TURNOS-HORAS DEL AÑO ESCOLAR
function Recetear_Turno_Hora($idyear){
    $sql=   "DELETE FROM turnos_hora WHERE Id_year = '$idyear'";

     if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
       }else{
          return 0;
           }
}

//FUNCION QUE SERA USADO EN LA VISTA INDEX
function Extraer_Year_Actuvo(){
   $sql=  "select id_year, yearScolar from yearscolar where stadoyear='ACTIVO'";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
            $arreglo[]=$consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    } 
}

//LISTAR AÑO ESCOLAR 
function listar_configuracionYear(){
    $sql=  "select id_year, fechainicio, fechafin, cierramatricula, tipoevaluacion, yearScolar, stadoyear from yearscolar";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
            $arreglo["data"][]=$consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }
}

//EXTAER TURNOS DEL AÑO ESCOLAR
function Extraer_TurnosYear($idyear){
$sql = "select Id_year,turno_nombre,inicioHora,finHora,idturno from turnos_hora
     inner join  turnos on turnos.turno_id = turnos_hora.idturno
    where Id_year ='$idyear'";

$arreglo = array();
if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[]=$consulta_VU;

    }
    return $arreglo;
    $this->conexion->cerrar();
}

}

 //LISTAR TURNOS PARA REGISTRAR AÑO ESCOLAR
function Listar_Turnos(){
	$sql = "SELECT turno_id, turno_nombre FROM turnos";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }
}
  
//VER TURNOS DEl AÑO ESCOLAR
function listar_Yearturnos($idyear){
     $sql = "select turno_nombre,inicioHora,finHora from turnos_hora
     inner join  turnos on turnos.turno_id = turnos_hora.idturno
    where Id_year ='$idyear'";
     $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
            $arreglo["data"][]=$consulta_VU;

        }
        return $arreglo;
        $this->conexion->cerrar();
    }

}

}

?>