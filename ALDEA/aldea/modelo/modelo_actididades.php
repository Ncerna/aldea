
<?php
class Actyvite{
    private $conexion;
    function __construct(){
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }

    function Listar_Combo_Cursos(){
      $sql = "SELECT idcurso, cursoCodigo, nonbrecurso,tipo FROM curso";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }
    
}

 function get_cousesAndDeegres($yearid= null){
      $sql = "SELECT idcurso, cursoCodigo, nonbrecurso,tipo,grado.gradonombre,grado.seccion FROM grado_curso
        inner join grado on grado.idgrado =grado_curso.grado_id
        inner join curso on curso.idcurso =grado_curso.curso_id where grado_curso.yearEscolar ='$yearid' ";
      $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }
    
}


//LISTAR AÑO ESCOLAR PARA REGISTRAR FASE ESCOLAR
          function Listar_YearEscolar(){
              $sql = "SELECT id_year, yearScolar FROM yearscolar where stadoyear='ACTIVO'";
              $arreglo = array();
              if ($consulta = $this->conexion->conexion->query($sql)) {
                  while ($consulta_VU = mysqli_fetch_array($consulta)) {
                          $arreglo[] = $consulta_VU;
                  }
                  return $arreglo;
                  $this->conexion->cerrar();
              }
          }  

//verificar si ya existe carga acdemimico similar
          //PREGUNTAR SI APLICARA ESTE CARGA ACADEMICO PARA TODO LOS BIMESTRES//


function Verificar_Actividad($idyear,$curso,$ordentipo){
    $sql = "SELECT yearId_act, curso_act,ordeperiodoTipo FROM activiti where yearId_act='$idyear' and curso_act='$curso' and ordeperiodoTipo='$ordentipo'";
    $arreglo = array();

    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        return count($arreglo);
        $this->conexion->cerrar();
    }
}

//REGISTRA CARGA ACDEMICO
function Registrar_Activite($idyear,$curso,$periotipoevaluacion,$ordentipo,$idsesion){
    $sql = "INSERT INTO activiti(yearId_act, curso_act, fechaCreatd,ordeperiodoTipo,tipo_evalu,User_sesion)
    VALUES ('$idyear','$curso',NOW(),'$ordentipo','$periotipoevaluacion','$idsesion')"; 
    if (mysqli_query($this->conexion->conexion, $sql)) {
        return  mysqli_insert_id($this->conexion->conexion);
    }
    else{
     return 0;
 }
}

function Activite_CursoPuntajes($idActivid, $activiti, $ponderado,$curso,$periotipoevaluacion,$ordentipo,$idyear,$idsesion){
    $sql = "INSERT INTO activ_curso(activ_Id, actividades, puntajes,cursoid, fechaCreatd,ordenTipoeva,evalu_tipo,User_sesscion,yearId)
    VALUES ('$idActivid','$activiti','$ponderado','$curso',NOW(),'$ordentipo','$periotipoevaluacion','$idsesion','$idyear')"; 
    if (mysqli_query($this->conexion->conexion, $sql)) {
        return  1;
    }
    else{
     return 0;
 }
}

function Actualizar_Actividedes($activiti, $ponderado,$curso,$ingresantes,$idsesion){
 $sql = "UPDATE activ_curso SET actividades = '$activiti',cursoid='$curso',puntajes='$ponderado',User_sesscion='$idsesion' WHERE actcur_id = '$ingresantes'";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
                
            }else{
                return 0;
            }

}

function Eliminar_Actividedes($quitados,$idActivid){
 $sql=   "DELETE  FROM activ_curso WHERE  actcur_id = '$quitados' and activ_Id='$idActivid' ";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      }else{
        return 0;
      }

}

function Extraer_Ides_BD($idActivid){

$sql=  "SELECT actcur_id FROM activ_curso where activ_Id='$idActivid'";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
            $arreglo[]=$consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }

}



function listar_cursosActividad($yearid ){
    $sql=  "select idactiviti,cursoCodigo,nonbrecurso,yearScolar,ordeperiodoTipo,tipo_nombre from activiti
    inner join  curso on curso.idcurso = activiti.curso_act
    inner join  tipoevaluacion on tipoevaluacion.tipo_id = activiti.tipo_evalu
    inner join  yearscolar on yearscolar.id_year = activiti.yearId_act where yearId_act='$yearid'";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
            $arreglo["data"][]=$consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }

}

function listar_cursos_poderados($idActivid){
    $sql=  "SELECT actividades,puntajes FROM activ_curso where activ_Id='$idActivid'";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
            $arreglo["data"][]=$consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }
}

function listar_puntajes_Edit($idActivid){
    $sql=  "SELECT actcur_id,actividades,puntajes FROM activ_curso where activ_Id='$idActivid'";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
            $arreglo[]=$consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }
}

function Actualizar_Activite($idActivid,$idyear,$curso,$periotipoevaluacion,$ordentipo){
     $sql = "UPDATE activiti SET yearId_act = '$idyear',curso_act='$curso',ordeperiodoTipo='$ordentipo',tipo_evalu='$periotipoevaluacion' WHERE idactiviti = '$idActivid'";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
                
            }else{
                return 0;
            }
}


/*

function Preparacion_Datos_table($idActivid){
   $sql=   "DELETE  FROM activ_curso WHERE  activ_Id = '$idActivid'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      }else{
        return 0;
      }
}
*/

function Listar_Combo_tipoevaluacion($idyear){
 $sql = "select ordenTipo_periodo,tipo_periodo, tipo_nombre from periodo 
  inner join  tipoevaluacion on tipoevaluacion.tipo_id = periodo.tipo_periodo
          where year_id='$idyear'";
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