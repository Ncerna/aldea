<?php
session_start();
if (!empty($_SESSION['S_ROL'])) {
    

  $iddocente = $_SESSION['S_IDUSUARIO'];

    require '../../modelo/modelo_notas.php';
    $MU = new Nota();


      date_default_timezone_set('America/Lima');
    $cursoid = htmlspecialchars($_POST['cursoid'],ENT_QUOTES,'UTF-8');
     $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
     $tipoorden = htmlspecialchars($_POST['tipoorden'],ENT_QUOTES,'UTF-8');
    $tipoid = htmlspecialchars($_POST['tipoid'],ENT_QUOTES,'UTF-8');
     $idnivel = htmlspecialchars($_POST['idnivel'],ENT_QUOTES,'UTF-8');
    $idgrado = htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');
    $idsecion = htmlspecialchars($_POST['idsecion'],ENT_QUOTES,'UTF-8');
    //$idtipo = htmlspecialchars($_POST['idtipo'],ENT_QUOTES,'UTF-8');
   
     $alumnos = htmlspecialchars($_POST['idalumnos'],ENT_QUOTES,'UTF-8');
     $actividads = htmlspecialchars($_POST['idactividad'],ENT_QUOTES,'UTF-8');
     $notas = htmlspecialchars($_POST['notas'],ENT_QUOTES,'UTF-8');
     $ponderados = htmlspecialchars($_POST['ponderados'],ENT_QUOTES,'UTF-8');
     $idNotas = htmlspecialchars($_POST['idNotas'],ENT_QUOTES,'UTF-8');
     $sustis = htmlspecialchars($_POST['sustis'],ENT_QUOTES,'UTF-8');


     $contador=0;
     $alumnos=explode(",", $alumnos);
     $actividad = explode(",",$actividads);
     $nota = explode(",", $notas);
     $promedio = explode(",", $ponderados);
     $idNota = explode(",", $idNotas);
     $_susti = explode(",", $sustis);

     //VERIFICAR SI YA VENCIO EL PLAZO

     /*$limitfec = $MU->VerrificarFechaEvaluacion($idyear);
      //RECORRE LA FECHAS PARA COMPARAR
      foreach ( $limitfec as $value) { 
      //COMPARAMOS LA ORDEN
        if ($value['ordenTipo_periodo']==$tipoorden ) {
          //COMPARENT DATE EQUALS AN INGRESENT BY EXISTNS
            $FechaActual=date('Y-m-d');
          if ($value['fech_final'] <= $FechaActual) {
            echo 500;
            return 'SEC_ERROR_UNKNOWN_ISSUER';
          }
        
        }
     }*/
     //FIN DE VERIFICACION

     $result = $MU->getIdNotas($cursoid,$idgrado,$idsecion,$tipoorden,$tipoid,$idyear,$idnivel);
     function aplicarFiltro($result, $idNota) {
      // Aplicar filtro si se proporciona un idNota
      if ($idNota !== null) {
          $result = array_filter($result, function ($nota) use ($idNota) {
              return $nota == $idNota;
          });
      }
      return $result; 
  }


    for ($i=0; $i <count($alumnos) ; $i++) { 
      if ($alumnos[$i] !='') {
            //PARA HACER REPORTE DE NOTAS POR BIMESTRES.

          $consilta= $MU->Editando_Nuevo($alumnos[$i],$cursoid,$idgrado,$tipoorden,$tipoid,$idyear,$idnivel,$idsecion);
           $promedio_redondeado = round($promedio[$i]);
           if ($consilta>0) {
               $MU->Actualizar_Ponderaciones($alumnos[$i],$cursoid,$promedio_redondeado,$idgrado,$tipoorden,$tipoid,$idyear,$idnivel,$idsecion,$iddocente,$_susti[$i]);
           }else{
            $MU->GuardarPonderadoNostadAlum($alumnos[$i],$cursoid,$promedio_redondeado,$idgrado,$tipoorden,$tipoid,$idyear,$idnivel,$idsecion,$iddocente,$_susti[$i]);
           }
           
           //fin de ponderaciones

           for ($j = 0; $j < count($actividad); $j++) {
            if ($actividad[$j] != '') {
                if (aplicarFiltro($result, $idNota[$j])) {
                    $se = "OK"; // Hacer algo si el idNota ya existe

                    $id = $idNota[$j];
                    $consulta = $MU->Actualizar_Nota_Alumno($id, $nota[$j]);
                } else {
                    // Llamada a la función para registrar notas si el idNota no existe
                    $consulta = $MU->Registrar_Notas_Alumno($alumnos[$i], $actividad[$j], $nota[$j], $cursoid, $idgrado, $idsecion, $tipoorden, $tipoid, $idyear, $idnivel, $iddocente);
                }
                $contador++;
                }
            }
            
              // Slicing de los arrays después de completar el bucle
              $nota = array_slice($nota, $contador);
              $idNota = array_slice($idNota, $contador);
              $contador = 0;

      }
    
 }
 echo isset($consulta )? $consulta :"OK";
}

 ?>