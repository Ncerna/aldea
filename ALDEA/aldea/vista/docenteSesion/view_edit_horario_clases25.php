
<script type="text/javascript" src="../js/?rev=<?php echo time();?>"></script>
<div class="col-md-12" >
	<div class="box box-warning " >
     
		<div class = "box-header with-border" id="Titulo_Center" >
      <h3 class = "box-title">Vista de  Horario de Clases -<?php echo date('Y'); ?></h3>
       <div class="box-tools pull-left">
       <a href="#"  onclick="Regresar_listar_Horarios();" style="margin-top: -15px;">&nbsp;<em class="fa fa-chevron-circle-left fa-2x" aria-hidden="true" style="color: #05ccc4"></em></a>
      </div>
    </div>

	</div>
</div>

<?php

if (!empty(($_GET['idjornada']))) {
$idjornada = htmlspecialchars($_GET['idjornada'],ENT_QUOTES,'UTF-8');
$yearid = htmlspecialchars($_GET['yearid'],ENT_QUOTES,'UTF-8');
$idgrado = htmlspecialchars($_GET['idgrado'],ENT_QUOTES,'UTF-8');
$idnivel = htmlspecialchars($_GET['idnivel'],ENT_QUOTES,'UTF-8');
$seccion = htmlspecialchars($_GET['seccion'],ENT_QUOTES,'UTF-8');
$turnoId = htmlspecialchars($_GET['turnoId'],ENT_QUOTES,'UTF-8');


include_once '../../modelo/modelo_horario.php';
$horario  = new  Horario();

session_start();

if (!empty($_SESSION['S_IDENTYTI'])) {

  $iddocente = $_SESSION['S_IDENTYTI'];

  $cursos = $horario->listar_Cursos_De_Docentes_Horario($iddocente,$idgrado,$yearid);
  $horas  =  $horario->Listar_Horas_Jornadas($idjornada,$yearid,$idgrado,$idnivel,$seccion,$turnoId);

function Curso_Asignado($cursos,$id){
$filtered = array_values(array_filter($cursos, function($value) use ($id) {

    return $value['idCursos'] == $id;
  }));
return $filtered ;
}

  
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

 <?php } ?>


<script type="text/javascript"> 

function Regresar_listar_Horarios(){
   
    $("#contenido_principal").load("docenteSesion/vista_listar_horaio_clases25.php");
}


</script>