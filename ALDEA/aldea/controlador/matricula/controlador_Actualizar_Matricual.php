

<?php
    require '../../modelo/modelo_matricula.php';
    $MU = new Matricula();

    $idalumnoedit = htmlspecialchars($_POST['idalumnoedit'],ENT_QUOTES,'UTF-8');
    $alumno = htmlspecialchars($_POST['alumno'],ENT_QUOTES,'UTF-8');
    $pago = htmlspecialchars($_POST['pago'],ENT_QUOTES,'UTF-8');
    $year = htmlspecialchars($_POST['year'],ENT_QUOTES,'UTF-8');
    $grado = htmlspecialchars($_POST['grado'],ENT_QUOTES,'UTF-8');
     $nivel = htmlspecialchars($_POST['nivel'],ENT_QUOTES,'UTF-8');
    $codigomatricula = htmlspecialchars($_POST['codigomatricula'],ENT_QUOTES,'UTF-8');


     $fecha_actual = date('Y-m-d H:i:s');
    $fechmas = date('Y-m-d H:i:s',strtotime($fecha_actual."+ 1 month"));
   
   $consulta = $MU->Actualizar_New_Matricula($idAlum,$alumno,$pago,$year,$grado,$nivel,$codigomatricula,$fechmas);
    echo  $consulta;
?>