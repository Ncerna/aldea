
<?php
    require '../../modelo/modelo_matricula.php';
    $MU = new Matricula();
    date_default_timezone_set('America/Lima');

    $idAlum = htmlspecialchars($_POST['idAlum'],ENT_QUOTES,'UTF-8');
    $id_alumn = htmlspecialchars($_POST['alumno'],ENT_QUOTES,'UTF-8');
    $grado = htmlspecialchars($_POST['grado'],ENT_QUOTES,'UTF-8');
    $pago = htmlspecialchars($_POST['pago'],ENT_QUOTES,'UTF-8');
    $aula = htmlspecialchars($_POST['aula'],ENT_QUOTES,'UTF-8');
    $turno = htmlspecialchars($_POST['turno'],ENT_QUOTES,'UTF-8');
    $nivel = htmlspecialchars($_POST['nivel'],ENT_QUOTES,'UTF-8');
    $vacantes = htmlspecialchars($_POST['vacantes'],ENT_QUOTES,'UTF-8');
    $yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
    //$penciones = htmlspecialchars($_POST['penciones'],ENT_QUOTES,'UTF-8');
    $cargo = htmlspecialchars($_POST['cargo'],ENT_QUOTES,'UTF-8');
     $seccion = htmlspecialchars($_POST['seccion'],ENT_QUOTES,'UTF-8');

    $fecha_actual = date('Y-m-d H:i:s');
    $fechmas = date('Y-m-d H:i:s',strtotime($fecha_actual."+ 1 month"));

    $Exist=$MU->alumnoMatriculado($id_alumn,  $grado, $yearid);
    if($Exist==0){
          $consulta = $MU->Registrar_New_Matricula($id_alumn,$grado,$pago,$aula,$turno,$nivel,$yearid,$cargo,$seccion);

           if($cargo=='SI'){
            $consulta = $MU->Registrar_Pagos_de_Penciones($id_alumn,$pago,$yearid,$fecha_actual,$fechmas);

            $consulta = $MU->Registrar_Pagos_stado_de_pagos($id_alumn,$yearid,$fecha_actual,$fechmas,$cargo);
            }
              $newVacante=$vacantes-1;
            $consulta = $MU->Quitar_vacantes_Grados($grado, $newVacante,$yearid);

    echo  $consulta;
}else{
    echo 100;
}

  
?>