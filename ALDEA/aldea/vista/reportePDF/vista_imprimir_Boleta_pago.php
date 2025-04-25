<?php 
require '../../plantilla/dompdf_php8/vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;
try {
    // Crear un objeto de opciones para Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);

    // Inicializar Dompdf
    $dompdf = new Dompdf($options);

ob_start();


$alumid = htmlspecialchars($_GET["alumid"],ENT_QUOTES,'UTF-8');
$yearid = htmlspecialchars($_GET["yearid"],ENT_QUOTES,'UTF-8');

date_default_timezone_set('America/Lima');



$fecha_actual = date('Y-m-d');

 //SUMANDO FECHA UN DIA YA QUE EN PERU JS TOMA UN DIA MENOS
$nuevafecha = strtotime ( '+1 day' , strtotime ($fecha_actual) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

$nuevafecha = date ( 'Y-m-j');

$hoydia =date('Y-m-d');
              //FIN DE SUMA

require 'conexion_temporal.php';
//DATOS DEL ALUMNO

$alumno = $conn->prepare("select idalumno,apellidos,alumnonombre,codigo,Id_grado,gradonombre,nombreNivell,matricula.seccion,nombreaula,turno_nombre from matricula
  inner join  aula on aula.idaula = matricula.Id_aula
  inner join  turnos on turnos.turno_id = matricula.Id_turno
  inner join  niveles on niveles.idniveles = matricula.Id_nivls
  inner join  alumno on alumno.idalumno = matricula.Id_alumno
  inner join  grado on grado.idgrado = matricula.Id_grado 
  where Id_alumno ='$alumid' ");

$alumno->execute();
$alumno = $alumno->fetch();

//PAGOS rEALIZADOS
$pagos = $conn->prepare("select fechasPagados,motoPago,tipo from registopagos where alumno_id='$alumid' and year_id='$yearid' and dateoperation='$hoydia'  ");
$pagos->execute();
$pagos = $pagos->fetchAll();


 //Datos  INSTITUCION
  $colegio = $conn->prepare("SELECT idColegio, nameColegio,  emailColegio, ubicacion, logoColegio, escudoPais,  ugel FROM colegio");

    $colegio->execute();
    $colegio = $colegio->fetch();

 $escudoImagen = "../../imagenes/".$colegio['escudoPais'];
$escudoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($escudoImagen));
$logoImagen = "../../imagenes/".$colegio['logoColegio'];
$logoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($logoImagen));


$cont=1;
$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../../plantilla/dompdf_php8/boostra4/bootstrap.min.css" integrity="" crossorigin="anonymous">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">  
</head>

<body class="app sidebar-mini">
 <style>
  .custom-table {
    border-collapse: collapse;
    width: 100%;
  }
  .custom-table th, .custom-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
  }
  .custom-table thead {
    background-color: #05ccc4;
    color: #fff;
    font-weight: bold;
  }
</style>
  <div class="wrap">
  </div>

  <div class="wrap">
    <div class="container-fluid">

      <div class="row" style="display: flex;">
       <div class="col-xs-12" >
         <div class="col-xs-6" style="float:left;" >
           <img  src="<?php echo $escudoBase64 ?>" width="100">
         </div>
         <div class="col-xs-6" style="float: right;">
           <img src="<?php echo $logoBase64 ?>" width="100">
         </div>

       </div>
     </div>

     <div class="box-1">
      <p style="text-align: center;">Boleta de Pago -<?php echo date('Y')?></p>
      <br><br><br>
      
      <table border="1" class="table custom-table table-bordered table-sm" style="border: 1px solid #33e3c7;
      "> 
      <tr>
        <td>UGEL</th>
          <td colspan="4"><?php echo $colegio['ugel']?? '' ?></td>
        </tr>
        <tr>
          <td colspan="4">I.E</td>
          <td ><?php echo $colegio['nameColegio']?? '' ?></td>
        </tr>
        <tr>
          <td rowspan="2">NIVEL</td>
          <td rowspan="2"><?php echo $alumno['nombreNivell'] ?></td>
          <td >GRADO</td>
          <td colspan="2"><?php echo $alumno['gradonombre'] ?></td>
        </tr>
        <tr>
          <td colspan="2">SECCION</td>
          <td colspan="1"><?php echo $alumno['seccion'] ?></td>
        </tr>
        <tr>
          <td colspan="4">CODIGO ESTUDIANTE</td>
          <td ><?php echo $alumno['codigo'] ?></td>
        </tr>
        <tr>
          <td colspan="4">APELLIDOS Y NOMBRES</td>
          <td ><?php echo $alumno['apellidos'].','.$alumno['alumnonombre'] ?></td>
        </tr>
        <tr>
          <td rowspan="2">TURNO</td>
          <td rowspan="2"><?php echo $alumno['turno_nombre'] ?></td>
          <td >AULAS</td>
          <td colspan="2"><?php echo $alumno['nombreaula'] ?></td>
        </tr>
      </table>

<br>

      <table class="custom-table">
        <thead >
          <tr>
            <th>N°</th>
            <th>Descripción</th>
            <th>Fechas Pagados</th>
            <th>Monto Guaranies/.</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pagos  as $pago): $total += $pago['motoPago'];  ?>
            <tr>
              <td ><?php echo $cont;?></td>
              <td ><?php echo $pago['tipo'];?></td>
              <td ><?php echo $pago['fechasPagados'];?></td>
              <td ><?php echo $pago['motoPago'];?></td>
            </tr>  
            <?php $cont++; endforeach;?>
            <tr>
              <td ></td>
              <td ></td>
              <td >Total Pagado Guaranies/.</td>
              <td ><?php echo $total?></td>
            </tr> 
          </tbody>
        </table>
        <label>Fecha de Pago: <?php  echo date('Y-m-d h:i:s A'); ?></label>
      </div>
    </div>
    <br>
    <br>
    <div class="container" style=" ">

    </div>
  </div>
</body>
</html>
<?php 

    // Capturar el contenido del búfer de salida
    $html = ob_get_clean();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->set_option('margin-top', 'auto');
    $dompdf->set_option('margin-bottom', 'auto');
    $dompdf->render();
    header('Content-Type: application/pdf');

       $dompdf ->stream("Boleta de pago".".pdf" ,array('Attachment' => false ));
    echo $dompdf->output();
    exit();
} catch (Exception $e) {
    echo 'Error al generar el PDF: ', $e->getMessage();
    exit();
}

 ?>
