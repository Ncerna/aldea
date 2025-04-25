<?php
    class Aula{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }

   //muestra aulas en combo de registrar grado EATADO LIBRE      
function listar_combo_aulas(){

  $sql = "SELECT idaula, nombreaula,aforro FROM aula WHERE status='LIBRE'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }

}
function listar_combo_EditAulas(){
$sql = "SELECT idaula, nombreaula,aforro FROM aula";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }

}

function listar_combo_nivelesEdit(){
$sql = "SELECT  idniveles, nombreNivell FROM niveles";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }
}

function listar_combo_editTurnos(){
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
   
   function Registrar_Aula($nombre,$piso,$numero,$aforro,$estado){ 
     $sql = "INSERT INTO aula(nombreaula, piso, numero, aforro, status,dateCreat, dateUpdate) VALUES ('$nombre','$piso','$numero','$aforro','$estado',NOW(),NOW())";
            if ($consulta = $this->conexion->conexion->query($sql)) {
           return 1;    
            }else{
                return 0;
            }
         }  


   function Verificar_Existencia($nombre,$piso){ 
    $sql=  "select nombreaula, piso from aula where nombreaula='$nombre' and piso='$piso'";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
                }
                return count($arreglo);
                $this->conexion->cerrar();
            }
         }  


function listar_Aulas(){
    $sql=  "select idaula, nombreaula, piso, numero, aforro,status from aula ";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

 function Actualizar_Aula($idAula,$nombre,$piso,$numero,$aforro,$estado){
  
         $sql = "update aula set nombreaula = '$nombre',piso='$piso',numero='$numero',aforro='$aforro',status='$estado', dateUpdate= NOW() WHERE idaula= '$idAula'";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
                
            }else{
                return 0;
            }

 }

function Eliminar_aula($idAula){

 $sql=   "DELETE FROM aula WHERE idaula = '$idAula'";

      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
        
      }else{
        return 0;
      }

}



     }
?>