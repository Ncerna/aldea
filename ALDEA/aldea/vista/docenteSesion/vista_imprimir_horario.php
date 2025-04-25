


<?php 
ob_start();

if (!empty(($_GET['idhorario']) && ($_GET['idjornada']))) {

	$idjornada = htmlspecialchars($_GET['idjornada'],ENT_QUOTES,'UTF-8');
	$idhorario = htmlspecialchars($_GET['idhorario'],ENT_QUOTES,'UTF-8');
	$seccion = htmlspecialchars($_GET['seccionId'],ENT_QUOTES,'UTF-8');
	$idgrado = htmlspecialchars($_GET['gradoId'],ENT_QUOTES,'UTF-8');
	$yearid = htmlspecialchars($_GET['yearid'],ENT_QUOTES,'UTF-8');


	include_once '../../modelo/modelo_horario.php';
	$horario  = new  Horario();
	$data  =  $horario->Imprimir_horario_clases25($idhorario);
	$horas  =  $horario-> ListarHoras($idjornada);

	session_start();

	if (!empty($_SESSION['S_IDENTYTI'])) {

		$iddocente = $_SESSION['S_IDENTYTI'];

		$cursos = $horario->listar_Cursos_De_Docentes_Horario($iddocente,$idgrado,$yearid);

		
	}

	function Curso_Asignado($cursos,$id){
			$filtered = array_values(array_filter($cursos, function($value) use ($id) {

				return $value['idCursos'] == $id;
			}));
			return $filtered ;
		} 
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>View Horarios pdf</title>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../../plantilla/Dompdf/boostra4/bootstrap.min.css" integrity="" crossorigin="anonymous">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
</head>
<body>
	
<div class="col-md-12" >
  <div class="box box-warning ">
    <div class = "box-header with-border" id="Titulo_Center" >
      <h3 class = "box-title">HORAIO DE CLASES -<?php  echo date('y'); ?> </h3>
    </div>
    <div class="box-body">
    	
    	<table class="table table-bordered">
    		<thead>
    			<tr style=" background-color: #05ccc4;color: #fff;text-align: center;">
    				<th>GRADO </th>
    				<th>NIVEL </th>
    				<th>TURNO </th>
    				<th>SECCIÓN </th>
                    <th>AULA </th>
    			</tr>
    			<tr style="text-align: center;">
    				<th><?php  echo $data[0]['gradonombre']; ?></th>
    				<th><?php  echo $data[0]['nombreNivell']; ?></th>
    				<th><?php  echo $data[0]['turno_nombre']; ?></th>
    				<th><?php  echo $data[0]['seccionId'] ; ?></th>
            <th><?php  echo $data[0]['nombreaula'] ; ?></th>
    			</tr>
    		</thead>
    	</table>
</div>

     <div class="row">
       <div class="col-xs-12">
        <div class="box-body no-padding  table-responsive">

          <table class="table table-bordered">
            <thead>
              <tr >
                <th>hora</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miercoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
              </tr>

              <?php foreach ($horas as $hora) { ?>
                <tr >
                  <td><?php echo $hora['Hora_inicio'] . ' - ' . $hora['hora_final']; ?></td>
                  <?php
                  for ($c = 1; $c <= 5; $c++) {

                    $datoscursos = $horario->Mostrar_Cursos_De_Grados_Docente($c, $hora['HorJor_id'],$seccion);
                    
                    if (count($datoscursos)> 0) {

                      foreach ($datoscursos as $value) {

                   
                        
                       if (Curso_Asignado($cursos,$value['idcurso'])) {
                        ?>
                        <td id="td<?php echo $hora['HorJor_id'] . $c; ?>" class="dropzone" idhora="<?php echo $hora['HorJor_id']; ?>" iddia="<?php echo $c ?>" idhorario="<?php echo $value['idtd'] ?>"><?php echo $value['nonbrecurso'] ?></td>
                        <?php
                       }else{
                          ?>
                         <td id="td<?php echo $hora['HorJor_id'] . $c; ?>" class="dropzone" idhora="<?php echo $hora['HorJor_id']; ?>" iddia="<?php echo $c ?>" idhorario=""></td>

                       <?php }
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
$html=ob_get_clean();
//echo $html;


require_once '../../plantilla/dompdf_php8/autoload.inc.php';
Use Dompdf\Dompdf;
$dompdf=new Dompdf();

$options = $dompdf->getOptions();
$dompdf = new Dompdf(array('enable_remote' => true));
$dompdf->setOptions($options);

$dompdf ->loadHtml($html);
$dompdf ->setPaper('letter');

//$dompdf ->setPaper('A4','landscape');

$dompdf ->render();

$dompdf ->stream("Repotre_.pdf" ,array('Attachment' => false ));

 ?>