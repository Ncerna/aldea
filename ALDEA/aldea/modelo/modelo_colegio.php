
<?php
    class Colegio{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }

function RegistrarDatosColegio($NamelogoImg,$NamepaisImg,$NamebannImg,$colegioNombre,$colegioUbic,$colegioEmail,$ColegioTelefono,$ugel,$municipio,$txt_ep,$txt_code,$federal,$txt_cdcee,$denomination,$identity,$directors){
    
	 $sql = "insert into colegio (nameColegio, telefColegio, emailColegio, ubicacion, logoColegio, escudoPais, bannerColegio, ugel,municipio,txt_ep,txt_code,federal,txt_cdcee,denomination,identity,directors,dateCreate)  values ('$colegioNombre','$ColegioTelefono','$colegioEmail','$colegioUbic','$NamelogoImg','$NamepaisImg','$NamebannImg','$ugel','$municipio','$txt_ep','$txt_code','$federal','$txt_cdcee','$denomination','$identity','$directors',NOW())";
            if ($consulta = $this->conexion->conexion->query($sql)) {
           return 1;    
            }else{
                return 0;
            }
         }  


function ActualizarDatosColegio($NamelogoImg,$NamepaisImg,$NamebannImg,$colegioNombre,$colegioUbic,$colegioEmail,$ColegioTelefono,$idcolegio,$ugel,$municipio,$txt_ep,$txt_code,$federal,$txt_cdcee,$denomination,$identity,$directors){

 $sql = "update colegio set nameColegio='$colegioNombre', telefColegio='$ColegioTelefono', emailColegio='$colegioEmail', ubicacion='$colegioUbic', logoColegio='$NamelogoImg', escudoPais='$NamepaisImg', bannerColegio='$NamebannImg',ugel='$ugel',

   municipio='$municipio',txt_ep='$txt_ep',txt_code='$txt_code',federal='$federal',txt_cdcee='$txt_cdcee',denomination='$denomination',identity='$identity',directors='$directors', dateUpdate=NOW() where idColegio='$idcolegio'";
           if ($consulta = $this->conexion->conexion->query($sql)) {      
              return 1;
              
            }else{
              return 0;
            }
    

}


function ObtenerDatosColegio($idcolegio) {
        $sql = "SELECT * FROM colegio WHERE idColegio = ?";
        $stmt = $this->conexion->conexion->prepare($sql);
        $stmt->bind_param("i", $idcolegio);

        if ($stmt->execute()) {
            $result = $stmt->get_result(); // Obtener el resultado de la consulta
            //$exit = $result->fetch_assoc();
            return $result->fetch_assoc();
        } else {
            return array('status' => false, 'auth' => true, 'msg' => 'Salida no encontrada', 'data' => '');
        }
    }


function EliminarDatosColegio($idcolegio){
 $sql=   "DELETE FROM colegio WHERE idColegio = '$idcolegio'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
        
      }else{
        return 0;
      }

}


function ExtraerDatosActualesColegio(){
 
 $sql = "SELECT idColegio,nameColegio, telefColegio, emailColegio, ubicacion, logoColegio, escudoPais, bannerColegio ,ugel,

 municipio,txt_ep,txt_code,federal,txt_cdcee,denomination,identity,directors

  FROM colegio ";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }

}

function ConsultarImagenesExistentes($idcolegio){
 $sql = "SELECT  logoColegio, escudoPais, bannerColegio FROM colegio where idColegio='$idcolegio' ";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }


}



     }
?>