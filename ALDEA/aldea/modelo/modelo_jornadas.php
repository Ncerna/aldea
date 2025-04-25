
<?php
class JornasHoras{
private $conexion;
function __construct(){
	require_once 'modelo_conexion.php';
	$this->conexion = new conexion();
	$this->conexion->conectar();
}

function listar_combo_grdos(){
	  $sql = "select idgrado, gradonombre,nivel_id,nombreNivell,seccion,aula_id,nombreaula from grado 
       inner join  aula on aula.idaula = grado.aula_id
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


function Verificar_Jornada($turno,$grado,$id_GradosNivel,$seccion){
	$sql = "SELECT tunoid, gradoid,nivelGrado ,seccionjor FROM jornadas where tunoid='$turno' and gradoid='$grado' and nivelGrado='$id_GradosNivel' and seccionjor='$seccion' ";
	$arreglo = array();

	if ($consulta = $this->conexion->conexion->query($sql)) {
		while ($consulta_VU = mysqli_fetch_array($consulta)) {
			$arreglo[] = $consulta_VU;
		}
		return count($arreglo);
		$this->conexion->cerrar();
	}
}

function Registrar_Jornada($idyear,$turno,$grado,$inicioacde,$fialacde,$id_GradosNivel,$seccion,$idaula){
	 $sql = "insert into jornadas(IdJornYear,tunoid, gradoid,nivelGrado,seccionjor,idAula, Horainicio, horafinal, createDate, status) 
        values ('$idyear','$turno','$grado','$id_GradosNivel','$seccion','$idaula','$inicioacde','$fialacde',NOW(),'ACTIVO')";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return mysqli_insert_id($this->conexion->conexion);
         }else{
      return 0;
     }
}

function Resetaer_datos_Horas($Idjornada){
 $sql=   "DELETE  FROM jornas_horas WHERE  jorna_ID = '$Idjornada'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      }else{
        return 0;
      }

}

function Registrar_Jornadas_Horas($Idjornada, $Horainicio, $Horafinal,$idyear,$id_GradosNivel,$grado,$seccion,$turno,$idaula){
$sql = "insert into jornas_horas(jorna_ID, Hora_inicio, hora_final, createDate,gradoId, yearId, nivelGrado_id,seccionHor,turnoId,aulaId) 
        values ('$Idjornada','$Horainicio','$Horafinal',NOW(),'$grado','$idyear','$id_GradosNivel','$seccion','$turno','$idaula')";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
         }else{
      return 0;
     }

}

function listar_combo_Turnos($idyear){
	$sql = "select turno_id,turno_nombre,inicioHora,finHora from turnos_hora
	inner join  turnos on turnos.turno_id = turnos_hora.idturno
	where Id_year ='$idyear'";
	$arreglo = array();
	if ($consulta = $this->conexion->conexion->query($sql)) {
		while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
			$arreglo[] = $consulta_VU;
		}
		return $arreglo;
		$this->conexion->cerrar();
	}
}

function Actualizar_Jornada_Grado_Nivel($Idjornada,$grado,$id_GradosNivel,$seccion){

	$sql = "update jornadas set gradoid='$grado',nivelGrado='$id_GradosNivel',seccionjor='$seccion' WHERE IdJornas= '$Idjornada'";
	if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
                
            }else{
                return 0;
            }
}


/*
function listar_combo_Turnos($idyear){
	$sql = "select turno_id,turno_nombre from turnos_hora
	inner join  turnos on turnos.turno_id = turnos_hora.idturno
	where Id_year ='$idyear'";
	$arreglo = array();
	if ($consulta = $this->conexion->conexion->query($sql)) {
		while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
			$arreglo[] = $consulta_VU;
		}
		return $arreglo;
		$this->conexion->cerrar();
	}
}
function listar_Horas_Turnos($idturno){
$sql = "select inicioHora,finHora from turnos_hora
	where idturno ='$idturno'";
	$arreglo = array();
	if ($consulta = $this->conexion->conexion->query($sql)) {
		while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
			$arreglo[] = $consulta_VU;
		}
		return $arreglo;
		$this->conexion->cerrar();
	}
}*/

function listar_Jornadas_Horas($yearid){
      $sql = "select IdJornas,yearScolar, turno_nombre,gradoid, gradonombre,nombreNivell,seccionjor, Horainicio,   horafinal  from jornadas
                     inner join yearscolar AS yearScolar  on yearScolar.id_year =jornadas.IdJornYear 
                     inner join grado on grado.idgrado =jornadas.gradoid
                     inner join niveles on niveles.idniveles =jornadas.nivelGrado
                     inner join turnos on turnos.turno_id =jornadas.tunoid
                      where jornadas.IdJornYear = '$yearid' ";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
}

function listar_Horas_Jornadas($idjornada){ 
$sql = "select Hora_inicio,hora_final from jornas_horas
	where jorna_ID ='$idjornada'";
	$arreglo = array();
	if ($consulta = $this->conexion->conexion->query($sql)) {
		while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
			$arreglo[] = $consulta_VU;
		}
		return $arreglo;
		$this->conexion->cerrar();
	}

}

}
?>
