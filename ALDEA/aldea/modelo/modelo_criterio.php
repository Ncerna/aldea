

<?php


class Criterio{
  private $conexion;
  function __construct(){
    require_once 'modelo_conexion.php';
    $this->conexion = new conexion();
    $this->conexion->conectar();
  }


  function Consulta_limitd_CriteriosAdd($idyear){

   $sql = "SELECT di_year FROM libretanotas where di_year='$idyear';";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
      $arreglo[] = $consulta_VU;
    }
    return count($arreglo);
    $this->conexion->cerrar();
  }

}

///listar criterios del curso
function listar_Criterios_Grado($idyear,$idgrado,$idcurso,$idnivel){

 $sql = " select idboletNota,criteriosEvaluacion from criterio  where curso_id='$idcurso' and grado_id='$idgrado' and yearEscolar_id='$idyear' and idnivel='$idnivel'";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
  while ($consulta_VU = mysqli_fetch_array($consulta)) {
    $arreglo[] = $consulta_VU;
  }
  return $arreglo;
  $this->conexion->cerrar();
}

}

function Extraer_Ides_BD($idyear,$idgrado,$idcurso,$idnivel){

 $sql = " select idboletNota from criterio  where curso_id='$idcurso' and grado_id='$idgrado' and yearEscolar_id='$idyear' and idnivel='$idnivel'";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
  while ($consulta_VU = mysqli_fetch_array($consulta)) {
    $arreglo[] = $consulta_VU;
  }
  return $arreglo;
  $this->conexion->cerrar();
}

}



function Eliminar_Criterios($quitados){
 $sql=   "DELETE  FROM criterio WHERE  idboletNota='$quitados'";
 if ($consulta = $this->conexion->conexion->query($sql)) {
  return 1;
}else{
  return 0;
}
}


function Registrar_Criterio($c_riterios, $idyear,$idgrado,$idcurso,$idnivel){

 $sql = "insert into criterio(criteriosEvaluacion, curso_id, grado_id, yearEscolar_id,idnivel, fechRegistro) 
 values ('$c_riterios','$idcurso','$idgrado','$idyear','$idnivel',NOW())";
 if ($consulta = $this->conexion->conexion->query($sql)) {
   return 1;
 }else{
  return 0;
}

}

function Actualizar_Criterio($c_riterios, $idyear,$idgrado,$idcurso,$idnivel,$ingresantes){

   $sql = "UPDATE criterio SET criteriosEvaluacion = '$c_riterios',curso_id='$idcurso', grado_id='$idgrado', yearEscolar_id='$idyear', idnivel='$idnivel',  fechaUpdate=NOW() WHERE idboletNota = '$ingresantes'";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
                
            }else{
                return 0;
            }
}

}
?>