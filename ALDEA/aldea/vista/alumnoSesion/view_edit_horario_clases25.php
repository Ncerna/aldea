<div class="col-md-12" >
	<div class="box box-warning " >
     
		<div class = "box-header with-border" id="Titulo_Center" >
      <h3 class = "box-title"><strong>Vista de  Horario de Clases -<?php echo date('Y'); ?></strong></h3>
      <div class="box-tools pull-right">
         <button type="button" class="btn btn-sm" data-widget="collapse"   onclick="Imprimir_Horario()" style="    margin-top: -20px">
         <em class="fa fa-print"></em>&nbsp;&nbsp;<strong>Imprimir</strong></button>
      </div>
    </div>

	</div>
</div>

<?php

session_start();

if (!empty($_SESSION['S_IDENTYTI'])) {

$alumnoid = $_SESSION['S_IDENTYTI'];
  include_once '../../modelo/modelo_horario.php';
  $horario  = new  Horario();

//RECUPERAMOS YEAR ACTIVO
 $year = $horario->Extraer_Year_Activo(); 
  $yearid= $year[0]['id_year'];



  //RECUPERAR EL GRADO DEL ALUMNO////
  //Id_grado,Id_turno,Id_nivls,seccion 
  $idgrado= $horario->Grado_Alumno_Matriculado_Horario($yearid,$alumnoid);

  
    //EXTRAER HORAS DE JORNADAS SEGUN EL GRADO///
  if (!empty($idgrado)) {
  $horas= $horario->Listar_Horas_Horario_Alumno($yearid,$idgrado[0]['Id_grado'],$idgrado[0]['seccion'],$idgrado[0]['Id_turno']);
  }else{
    echo "<div class='col-lg-12' style='border-color: #f5c6cb;'>
    <div  class='alert  sm' role='alert' style='color: #721c24; background-color: #f8d7da;'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><strong> No se encontro horario definido .</strong> </div>
    </div>";
  }

}
?>

<?php if (isset($horas)) {?>

<div class="col-md-12" >
  <div class="box box-warning ">
    <div class="box-body">

     <div class="row">
       <div class="col-xs-12">
        
          <div class="box-body no-padding  table-responsive">
          <table class="table table-bordered table-sm">
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

                    $datoscursos = $horario->Mostrar_Cursos_Horario_Alumno($c, $hora['HorJor_id'],$idgrado[0]['seccion'],$idgrado[0]['Id_grado']);
                    
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

 <?php } ?>

 <script type="text/javascript">
  $(document).ready(function() {
   $("#refres_add").hide();
} );
   
   function Imprimir_Horario(){
     var yearid  = $("#YearActualActivo").val();

     window.open("../vista/alumnoSesion/vista_imprimir_horario.php?yearid=" + yearid+
        
        "#zoom=75%","report","scrollbars=NO");
   }
 </script>