

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

if (!empty(($_GET['idhorario']) && ($_GET['idjornada']))) {

	$idjornada = htmlspecialchars($_GET['idjornada'],ENT_QUOTES,'UTF-8');
    $idhorario = htmlspecialchars($_GET['idhorario'],ENT_QUOTES,'UTF-8');
      $seccion = htmlspecialchars($_GET['seccionId'],ENT_QUOTES,'UTF-8');


	include_once '../../modelo/modelo_horario.php';
	$horario  = new  Horario();
  $data  =  $horario->Imprimir_horario_clases25($idhorario);
	$horas  =  $horario-> ListarHoras($idjornada); 

  $colegio=  $horario->Datos_colegio_horario_imprimir();


   $escudoImagen = "../../imagenes/".$colegio[0]['escudoPais'];
$escudoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($escudoImagen));

$logoImagen = "../../imagenes/".$colegio[0]['logoColegio'];
$logoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($logoImagen));
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>View Horarios pdf</title>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
</head>
<body>
	<style>
  .custom-table {
 
    border-collapse: collapse;
    margin-bottom: 20px;
  }

  .custom-table th, .custom-table td {
    border: 1px solid #ddd;
    text-align: center;
  }

  

  .custom-table th {
    font-weight: bold;
  }

  .custom-table-responsive {
    overflow-x: auto;
  }

  .dropzone {
   
    margin: 0;
    padding: 0;
 
    box-sizing: border-box;
  }
</style>
<div class="col-md-12" >
  <div class="box box-warning ">

    
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
      <h3   style="text-align: center;" class = "box-title">HORAIO DE CLASES -<?php  echo date('Y'); ?> </h3>
      <p  style="text-align: center;" ><?php  echo $colegio[0]['nameColegio'];?></p>
   
      
   
    <div class="box-body">
    	<br>
    	 <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; background-color: #fff; color: #333;">
  <thead>
    <tr style="background-color: #05ccc4; color: #fff; text-align: center; font-weight: bold;">
      <th style="padding: 10px; border: 1px solid #ddd;">GRADO</th>
      <th style="padding: 10px; border: 1px solid #ddd;">NIVEL</th>
      <th style="padding: 10px; border: 1px solid #ddd;">TURNO</th>
      <th style="padding: 10px; border: 1px solid #ddd;">SECCIÓN</th>
      <th style="padding: 10px; border: 1px solid #ddd;">AULA</th>
    </tr>
    <tr style="text-align: center;">
      <th style="padding: 10px; border: 1px solid #ddd;"><?php echo $data[0]['gradonombre']; ?></th>
      <th style="padding: 10px; border: 1px solid #ddd;"><?php echo $data[0]['nombreNivell']; ?></th>
      <th style="padding: 10px; border: 1px solid #ddd;"><?php echo $data[0]['turno_nombre']; ?></th>
      <th style="padding: 10px; border: 1px solid #ddd;"><?php echo $data[0]['seccionId']; ?></th>
      <th style="padding: 10px; border: 1px solid #ddd;"><?php echo $data[0]['nombreaula']; ?></th>
    </tr>
  </thead>
</table>
</div>

     <div class="row">
       <div class="col-xs-12">
        <div class="box-body no-padding  table-responsive">

           <table class="custom-table">
            <thead>
              <tr>
                <th>hora</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miercoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
              </tr>

              <?php foreach ($horas as $hora) { ?>
                <tr>
                  <td><?php echo $hora['Hora_inicio'] . ' - ' . $hora['hora_final']; ?></td>
                  <?php
                  for ($c = 1; $c <= 5; $c++) {

                    $datoscursos = $horario->mostratarHorario($c, $hora['HorJor_id'],$seccion);
                    
                    if (count($datoscursos)> 0) {
                      foreach ($datoscursos as $value) {
                        ?>
                        <td id="td<?php echo $hora['HorJor_id'] . $c; ?>" class="dropzone" idhora="<?php echo $hora['HorJor_id']; ?>" iddia="<?php echo $c ?>" idhorario="<?php echo $value['idtd'] ?>">&nbsp;<?php echo $value['nonbrecurso'] ?></td>
                        <?php
                      }
                    } else {
                      ?>
                      <td id="td<?php echo $hora['HorJor_id'] . $c; ?>" class="dropzone" idhora="<?php echo $hora['HorJor_id']; ?>" iddia="<?php echo $c ?>" idhorario=""></td>
                      <?php
                    }
                  }
                  ?>
                </tr>
              <?php } ?>

            </thead>
          </table>

        </div>

      </div>
    </div>
  </div>
</div>
</div>


</body>
</html>

 <?php 

    // Capturar el contenido del búfer de salida
    $html = ob_get_clean();

    // Cargar el HTML en Dompdf
    $dompdf->loadHtml($html);

    // Establecer el tamaño del papel y la orientación (horizontal)

    $dompdf->setPaper('A4', 'landscape');

    // Establecer márgenes para centrar verticalmente
    $dompdf->set_option('margin-top', 'auto');
    $dompdf->set_option('margin-bottom', 'auto');

    // Renderizar el PDF
    $dompdf->render();

    // Establecer el encabezado para indicar que es un archivo PDF
    header('Content-Type: application/pdf');

       $dompdf ->stream("Horario."."pdf" ,array('Attachment' => false ));
    // Enviar el archivo PDF al navegador
    echo $dompdf->output();

    // Terminar la ejecución del script para evitar la adición de cualquier contenido adicional
    exit();
} catch (Exception $e) {
    echo 'Error al generar el PDF: ', $e->getMessage();
    exit();
}

 ?>