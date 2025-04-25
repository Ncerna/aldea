<?php
    class Periodo_Eva{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
        function Registrar_PeriodoEva($year,$tipoEvaluacioIds,$tipoOrden,$p_iniciofech,$p_finfech){
            $sql = "INSERT INTO periodo(year_id, tipo_periodo,ordenTipo_periodo, fech_inicio, fech_final, p_stado)
                  VALUES ('$year','$tipoEvaluacioIds','$tipoOrden','$p_iniciofech','$p_finfech','ACTIVO')";    
           if ($consulta = $this->conexion->conexion->query($sql)) {

          return 1;
               
           }else{
               return 0;
           }
        }

 function listar_periodos_Ev($yearid){
   $sql=  "select tipo_nombre, fech_inicio, fech_final  from periodo 
 inner join  tipoevaluacion on tipoevaluacion.tipo_id = periodo.tipo_periodo
  where year_id='$yearid'";
    $arreglo = array();
     if ($consulta = $this->conexion->conexion->query($sql)) {
         while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
           $arreglo[]=$consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }

    }


      function Verificar_Existencia_Periodo($year){
           $sql = "SELECT year_id FROM periodo where year_id='$year'";
          $arreglo = array();
          if ($consulta = $this->conexion->conexion->query($sql)) {
              while ($consulta_VU = mysqli_fetch_array($consulta)) {
                      $arreglo[] = $consulta_VU;
              }
              return count($arreglo);
              $this->conexion->cerrar();
          }
      }

function VerificarSiYaTieneActividades($idyear){
$sql = "SELECT tipo_evalu,yearId_act FROM activiti  where yearId_act='$idyear'";
          $arreglo = array();
          if ($consulta = $this->conexion->conexion->query($sql)) {
              while ($consulta_VU = mysqli_fetch_array($consulta)) {
                      $arreglo[] = $consulta_VU;
              }
              return count($arreglo);
              $this->conexion->cerrar();
          }

}

function Quitar_Periodo_Evaluacion($idyear){
 $sql=   "DELETE FROM periodo WHERE year_id = '$idyear'";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
      
    }else{
      return 0;
    }
  
}

function Estraer_Show_periodos_Edit($idyear){
  $sql=  "select tipo_periodo,tipo_nombre, fech_inicio, fech_final  from periodo 
 inner join  tipoevaluacion on tipoevaluacion.tipo_id = periodo.tipo_periodo
  where year_id='$idyear'";

            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo[]=$consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
}

function Listar_Combo_tipos_evalaucion(){
 $sql=  "select tipo_id, tipo_nombre from tipoevaluacion
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
function Resetear_Evaluacion_Periodo($year){
  $sql=   "DELETE FROM periodo WHERE year_id = '$year'";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
      
    }else{
      return 0;
    }

}

    }
?>