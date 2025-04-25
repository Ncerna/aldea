<?php
require '../../plantilla/dompdf_php8/vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

try {
    // Crear un objeto de opciones para Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

    // Crear un objeto de opciones para Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

    require '../../modelo/modelo_colegio.php';
      $coles = new Colegio();
     $resul= $coles->ExtraerDatosActualesColegio();
      $cole= $resul[0];

      $escudoImagen = "../../imagenes/".$cole['escudoPais'];
    $escudoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($escudoImagen));
    $logoImagen = "../../imagenes/".$cole['logoColegio'];
    $logoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($logoImagen));


    $amount = $_POST['amount'];
    $student_id = $_POST['student_id'];
    $next_date = $_POST['next_date'];
    $name = $_POST['name'];
    $student = $_POST['student'];
    $yearScolar = $_POST['yearScolar'];
    $gradonombre = $_POST['gradonombre'];
    $turno_nombre = $_POST['turno_nombre'];
     $payment_date = $_POST['payment_date'];

     // Obtener la hora y la fecha actuales
     date_default_timezone_set('America/Lima');
    $dateCurrent = new DateTime('now');
    $date = $dateCurrent->format('Y-m-d h:i:s A');



    // Iniciar la captura de salida
    ob_start();

    // Generar el contenido del PDF
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
 <style>


.entity-client-info p {
    margin-bottom: 10px;
    line-height: 1.4;
      margin: 0;
}
    /* Estilos generales */
 table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            margin:0;font-size:80%;border-top: 1.5px dashed #000; margin-top: 5px;margin-bottom: 5px;
        }
th{background-color: #f2f2f2;}
        

        td {
            vertical-align: middle;
        }

        /* Estilos de la fuente */
        strong {
            font-weight: bold;
        }
 
  </style>

<body class="app sidebar-mini">
<style>
    /* Estilos generales */
  
  </style>
  <div class="wrap">
    <!--Updated on 10/8/2016; fixed center alignment percentage-->
  </div>

  <div class="wrap">
    <!--Updated on 10/8/2016; fixed center alignment percentage-->
    <div class="container-fluid">
   

      <div class="row" style="display: flex;">
       <div class="col-xs-12" >
         <div class="col-xs-6" style="float:left;" >
             <img  src="<?php echo $escudoBase64?? ''  ?>" width="100">
           </div>
                <div class="col-xs-6" style="float: right;">
                <img src="<?php echo $logoBase64?? '' ?>" width="100">
            </div>
          </div>
       </div>


     <div class="box-1">
      <h3 style="text-align: center;">Boleta de pago -<?php echo date('Y')?></h3>
    
      </div>
      <br><br>
    </div>

     <div class="row" style="display: flex;">
      <div class="entity-client-info">
       <div class="col-xs-12" >
         <div class="col-xs-6" style="float:left;" >
        <div class="entity-info">
        
        <p style="font-size: 13px;">Ugel: <?php echo $cole['ugel']?? '' ?></p>
        <p style="font-size: 13px;">Nombre:<?php echo $cole['nameColegio']?? '' ?></p>
        <p style="font-size: 13px;">Dirección: <?php echo $cole['ubicacion']?? '' ?></p>
        <p style="font-size: 13px;">Teléfono: <?php echo $cole['telefColegio']?? '' ?></p>
        
       </div>
            
      </div>
      <div class="col-xs-6" style="float: right;">
       <div class="client-info">
        
        <p style="font-size: 13px;">Nombre: <?php echo  $student; ?></p>
        <p style="font-size: 13px;">Grado: <?php echo  $gradonombre; ?></p>
        <p style="font-size: 13px;">Turno: <?php echo  $turno_nombre; ?></p>
        <p style="font-size: 13px;">Año acdémico: <?php echo  $yearScolar; ?></p>
      </div>
      </div>

      </div>
    </div>

  </div>

</div>
<br><br><br><br> 
  <table class="products-table">
      <thead>
        <tr>
          <th>N°</th>
          <th>Concepto</th>
          <th>Fe. Operación</th>
          <th>Momto</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
           <td><?php echo  $name; ?></td>
           <td><?php echo  $payment_date; ?></td>
          <td><?php echo  $amount; ?></td>
          <td><?php echo  $amount; ?></td>
        </tr>
        <tr>
                <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                <td><strong> <?php echo  $amount; ?></strong></td>
            </tr>
      </tbody>
    </table> 
      <label style="font-size: 8px;"><?php  echo  $date; ?></label> <p style="font-size:70%;text-align: right;">Gracias por tu preferencia!. </p>
</body>

</html>



    <?php

    // Obtener el contenido de la salida
    $html = ob_get_clean();

    // Cargar el contenido en Dompdf
    $dompdf->loadHtml($html);

    // Configurar el tamaño del papel y las margenes
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Enviar el PDF al cliente
    header('Content-Type: application/pdf');
    $dompdf->stream("boletas.pdf", array('Attachment' => false));
    exit();
} catch (Exception $e) {
    echo 'Error al generar el PDF: ', $e->getMessage();
    exit();
}
?>