<?php
      class Fasescolar{
          private $conexion;
          function __construct(){
              require_once 'modelo_conexion.php';
              $this->conexion = new conexion();
              $this->conexion->conectar();
          }
       //LISTAR AÑO ESCOLAR PARA REGISTRAR FASE ESCOLAR
          function Listar_YearEscolar(){
              $sql = "SELECT id_year, yearScolar FROM yearscolar";
              $arreglo = array();
              if ($consulta = $this->conexion->conexion->query($sql)) {
                  while ($consulta_VU = mysqli_fetch_array($consulta)) {
                          $arreglo[] = $consulta_VU;
                  }
                  return $arreglo;
                  $this->conexion->cerrar();
              }
          }    
       //REGISTRAR FASE ESCOLAR
         function Registrar_FaseEscolar($year,$faSesE, $inicioF, $finF){

             $sql = "INSERT INTO faseescolar(idyearE, fase_nombre, FechaInicial, FechaFinal, stdfase)VALUES ('$year', '$faSesE', '$inicioF','$finF','ACTIVO')"; 
               if ($consulta = $this->conexion->conexion->query($sql)) {
                  return 1;
                 }else{
                    return 0;
                     }
         }

          //Actualizar FASE ESCOLAR
         function Update_FaseEscolar($year,$faSesE, $inicioF, $finF){
           $sql = "INSERT INTO faseescolar(idyearE, fase_nombre, FechaInicial, FechaFinal, stdfase)VALUES ('$year', '$faSesE', '$inicioF','$finF','ACTIVO')"; 
               if ($consulta = $this->conexion->conexion->query($sql)) {
                  return 1;
                 }else{
                    return 0;
       }
         }
         function Borar_Anño_escolar($year){
          $sql=   "DELETE FROM faseescolar WHERE idyearE = '$year'";
          if ($consulta = $this->conexion->conexion->query($sql)) {
            return 1;

          }else{
            return 0;
          }
        }


function Quitar_Fase_Escolar($year){
$sql=   "DELETE FROM faseescolar WHERE idyearE = '$year'";
          if ($consulta = $this->conexion->conexion->query($sql)) {
            return 1;

        }else{
           return 0;
 }

}

function listar_configuracionFase(){
$sql = "SELECT id_year, yearScolar, stadoyear FROM yearscolar";
       $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_array($consulta)) {
           $arreglo["data"][]=$consulta_VU;
          }
      return $arreglo;
      $this->conexion->cerrar();
  }

}

function Extraer_Fase_DelYear($idyear){
$sql = "select fase_nombre, FechaInicial, FechaFinal,stdfase,id_year,fechainicio,fechafin FROM   faseescolar
      inner join  yearscolar on yearscolar.id_year= faseescolar.idyearE
        WHERE idyearE ='$idyear'";
       $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_array($consulta)) {
           $arreglo[]=$consulta_VU;
          }
      return $arreglo;
      $this->conexion->cerrar();
  }

}

function Estraer_fasesShow($idfase){
$sql = "SELECT FechaInicial, FechaFinal FROM faseescolar
where idyearE='$idfase'";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
               $arreglo[] = $consulta_VU;
            }
           return $arreglo;
          $this->conexion->cerrar();
      }
}

        function Verificar_Existencia($year){
             $sql = "SELECT idyearE FROM faseescolar where idyearE='$year'";
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