<?php
    class Curso{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }

        

function combo_cursos_libre(){

 $sql = "SELECT idcurso, nonbrecurso FROM curso WHERE statuscurso='LIBRE'";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }

}

function Eliminar_Curso($idcurso){

    $sql=   "DELETE FROM curso WHERE idcurso = '$idcurso'";
    
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      }else{
        return 0;
      }
}
function Listar_Curso(){
 $sql=  "SELECT idcurso, cursoCodigo, nonbrecurso,abbreviation, components,  tipo FROM curso";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo["data"][]=$consulta_VU;

                }
                return $arreglo;
                $this->conexion->cerrar();
            }

}
function CodigoExiste($codigocur) {
    $sql = "SELECT COUNT(*) as count FROM curso WHERE cursoCodigo = '$codigocur'";
    $resultado = $this->conexion->conexion->query($sql);
    
    if ($resultado) {
        $fila = $resultado->fetch_assoc();
        return $fila['count'] > 0;
    } else {
        return false;
    }
}

function nameExiste($nombre) {
    $sql = "SELECT COUNT(*) as count FROM curso WHERE nonbrecurso = '$nombre'";
    $resultado = $this->conexion->conexion->query($sql);
    
    if ($resultado) {
        $fila = $resultado->fetch_assoc();
        return $fila['count'] > 0;
    } else {
        return false;
    }
}

function Registrar_Curso($codigocur,$nombre,$tipo,$abbreviation, $components){
    if ($this->CodigoExiste($codigocur)) {
        return throw new Exception("Error Código del curso ya existe", 1);
    }
     if ($this->nameExiste($nombre)) {
        return throw new Exception("Error Nombre del curso ya existe", 1);
        // El código del curso ya existe
    }
  
 $sql = "insert into curso(cursoCodigo, nonbrecurso,abbreviation, components, fechaRegistro,fechaActualizacion, tipo) 
                 values ('$codigocur','$nombre','$abbreviation', '$components' ,NOW(),NOW(),'$tipo')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
             return 1;
               }else{
                return 0;
              }

}



function Update_Curso($idcurso,$codigcurso,$nombre,$tipo,$abbreviation, $components){
$sql = "update curso set cursoCodigo = '$codigcurso',nonbrecurso='$nombre',abbreviation='$abbreviation', components='$components' ,fechaActualizacion = NOW(),tipo='$tipo' WHERE idcurso= '$idcurso'";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
                
            }else{
                return 0;
            }



}


    }
?>
