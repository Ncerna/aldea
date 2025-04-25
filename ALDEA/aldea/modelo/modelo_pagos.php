<?php
    class Pagos{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }

         

         /* function Extraer_contracena($usu_id){
               $sql = "SELECT usu_id,usu_contrasena FROM usuarios WHERE usu_id='$usu_id'";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                   
                        $arreglo[] = $consulta_VU;
                    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }*/


function listar_combo_niveles(){
  $sql = "SELECT idgrado, gradonombre FROM grado";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }
}

/*

function SemestreActual(){
 $sql = "SELECT idsemestres, semestresnombre FROM semestres";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
      }
}


function Cambiar_semetre($idesemtnew,$nombsemtnew,$semtA){
 $sql = "UPDATE semestres SET idsemestres='$idesemtnew',semestresnombre = '$nombsemtnew' WHERE idsemestres = '$semtA'";

            if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
                
            }else{
                return 0;
            }
}

*/

function listar_alumnos_Pagos($yearid){
 $sql=  "select idalumno, apellidos, alumnonombre,aplicargo,ultimoPagofecha,proximoPagoFecha,stado from stadopenciones
 inner join  alumno on alumno.idalumno = stadopenciones.entidad where yeayid='$yearid'";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
  while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

    $arreglo["data"][]=$consulta_VU;

  }
  return $arreglo;
  $this->conexion->cerrar();
}

}




 function Registrar_Pago($apellp,$idalimnoPagado,$pago,$fechaR){

     $sql="insert into registropago (alumnonombre,pago_Idaluml, montopago,description, fechasPagados, fechaUpdate) values ('$apellp','$idalimnoPagado','$pago','MATRICULA','$fechaR', '$fechaR')";

         if ($consulta = $this->conexion->conexion->query($sql)) {
             return 1;
                
               }else{
                return 0;
              }

         }



 function Actualizar_Tabla_Estados($idalum,$dateMayor, $fechaProximoPago,$yearid,$FechaActual){

   $sql = "UPDATE stadopenciones SET ultimoPagofecha ='$dateMayor' ,proximoPagoFecha = '$fechaProximoPago'
        where entidad ='$idalum'";
          if ($consulta = $this->conexion->conexion->query($sql)) {
             return 1;
                
               }else{
                return 0;
              }

    }

function ExtraerAlumnosQueRealizanPagos($yearid){
$sql=  "select idstadop, entidad, ultimoPagofecha, proximoPagoFecha from stadopenciones
where yeayid ='$yearid'";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
  while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
    $arreglo[]=$consulta_VU;
  }
  return $arreglo;
  $this->conexion->cerrar();
}

}


function ActualizarEstadoPago($idalumno, $yearid,$stado){

 $sql = "UPDATE stadopenciones SET stado ='$stado' where entidad ='$idalumno' and yeayid='$yearid' ";
          if ($consulta = $this->conexion->conexion->query($sql)) {
             return 1;
                
               }else{
                return 0;
              }

}




  function Pagos_mensuales_Alumnos($idalum,$pagovect,$nuevafecha,$yearid){
   $sql="insert into registopagos (alumno_id, tipo, year_id, motoPago, stadoPago, fechasPagados,  dateoperation) 
   values ('$idalum','PENCION','$yearid','$pagovect','PAGADO','$nuevafecha',  NOW())";

   if ($consulta = $this->conexion->conexion->query($sql)) {
     return 1;

   }else{
    return 0;
  }


}

function listar_meses_pagados($nombAlum){

   $sql  = "select fechasPagados,motoPago from registopagos
      where alumno_id='$nombAlum' ";     
            $arreglo = array();
                if ($consulta = $this->conexion->conexion->query($sql)) {
                 while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                         $arreglo[]=$consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();

               }
       }


function Modificar_Estatus_Alumno($idusuario,$estatus){
     $sql = "UPDATE alumno SET stadoalumno = '$estatus' WHERE idalumno = '$idusuario'";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
      
    }else{
      return 0;
    }
      }



      function Imprimir_Comprobante_matricula($idealumno){

        $sql="select idalumno, apellidop, apellidom, alumno.alumnonombre, fnacimiento, dni , telefono, codigo ,
        grado, sexo, stadoalumno , fechaRegisto , alumno.fechaUpdate , direccion, stadoPago,  rolalumno  from alumno 
        where idalumno ='9'";

        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
          while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

            $arreglo[]=$consulta_VU;

          }
          return $arreglo;
          $this->conexion->cerrar();
        }

      }


      function listar_Reportes_PorFechas($finicio = null, $fFinal = null) {
        // Construir la consulta base
        $sql = "SELECT idalumno, apellidos, alumnonombre, tipo, fechasPagados, motoPago 
                FROM registopagos
                INNER JOIN alumno ON alumno.idalumno = registopagos.alumno_id";
        
        // Añadir condición de fechas solo si ambas están presentes
        if ($finicio && $fFinal) {
            $sql .= " WHERE dateoperation BETWEEN '$finicio' AND '$fFinal'";
        }
    
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo["data"][] = $consulta_VU;
            }
            $this->conexion->cerrar();
            return $arreglo;
        }
    
        return null; // Devolver null o un array vacío si la consulta falla
    }
    

//////////////////////////////////////////
//LISTAR NETAMENTE PAGOS ALUMNOS////////
/////////////////////////////////////////

function Pagos_Realizados_Alumno_Year($yearid,$alumnoid){
 $sql=  "SELECT tipo,fechasPagados,stadoPago,dateoperation,motoPago FROM registopagos where alumno_id='$alumnoid' and year_id='$yearid'";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
  while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

    $arreglo[]=$consulta_VU;

  }
  return $arreglo;
  $this->conexion->cerrar();
}

}

function Estado_Deudas_Alumno($yearid,$alumnoid){
  $sql=  "select  apellidos, alumnonombre,ultimoPagofecha,proximoPagoFecha,stado from stadopenciones
 inner join  alumno on alumno.idalumno = stadopenciones.entidad where yeayid='$yearid' and entidad='$alumnoid'";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
  while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

    $arreglo[]=$consulta_VU;

  }
  return $arreglo;
  $this->conexion->cerrar();
}
}

function Extraer_Estado_Pago_Alumno($yearid,$idalumno){
$sql=  "select idstadop, entidad, ultimoPagofecha, proximoPagoFecha from stadopenciones
where yeayid ='$yearid' and entidad='$idalumno' ";
 $arreglo = array();
 if ($consulta = $this->conexion->conexion->query($sql)) {
  while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

    $arreglo[]=$consulta_VU;

  }
  return $arreglo;
  $this->conexion->cerrar();
}

}

/////////////////////////////////////////////////////

   

     }
?>