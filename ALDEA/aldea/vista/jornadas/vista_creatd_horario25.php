
<script type="text/javascript" src="../js/horario25.js?rev=<?php echo time();?>"></script>
<div class="col-md-12" >
	<div class="box box-warning ">
     
		<div class = "box-header with-border" id="Titulo_Center" >
      <h3 class = "box-title">Generar horaio de clases-<?php echo date('Y'); ?></h3>
       <div class="box-tools pull-left">
       <a href="#"  onclick="Regresar_listar_Horarios();" style="margin-top: -15px;">&nbsp;<em class="fa fa-chevron-circle-left fa-2x" aria-hidden="true" style="color: #05ccc4"></em></a>
      </div>
    </div>
   
		<div class="box-body">
       <style type="text/css">#btn_bucar_data{
      border: none;border-radius: 5px;color: white;background-color: #05ccc4;
    }</style>
     <div class="row">
       <div class="col-xs-12">
        <div class="col-md-4">
          <label for="">Horas Acedémicas</label>
          <select class="js-example-basic-single" name="state" id="cbm_jornada" style="width:100%;" onchange="ShowSelected();" >
            
          </select><br><br>
        </div>
        <div class="col-md-4">
          <label for="">Grado |-| Nivel</label>
           <input type="text" name="" id="txt_gradoId" hidden >
       <input type="text" name="" id="txt_turnoId" hidden >
       <input type="text" name="" id="txt_nivelId" hidden >
        <input type="text" name="" id="idAula" hidden >

       <input type="text" name="" class="form-control" id="txt_nivel_nivel" disabled>
        </div>
        <div class="col-md-4">
           <label for="">Turno |-| Sección |-| Aula</label>
           <div class="alin_global">
             <input type="text" name="" id="txt_seccionId" hidden>
          <input type="text" name="" class="form-control" id="text_seccion" disabled>&nbsp;
           <button onclick="Consultar_Horarios_Generados();" class="btn-sm" id="btn_bucar_data"> <em class="fa fa-search" ></em> </button>
         </div>
        </div>
      </div>
    </div>

		</div>
	</div>
</div>

<?php

if (!empty(($_GET['idjornada']))) {
include 'fuctions.php';
}
?>
<!--SUBIENDO A LA VISTA LOS PARAMETROS PARA REGISTRAR HORAOD-->
<input type="text" name="" id="php_gradoId" value="<?php echo $idgrado ?>"  hidden>
<input type="text" name="" id="php_turnoId" value="<?php echo $turnoId ?>"  hidden>
<input type="text" name="" id="php_nivelId" value="<?php echo $idnivel ?>"  hidden>
<input type="text" name="" id="php_seccionId" value="<?php echo $seccion?>"  hidden>
<input type="text" name="" id="php_jornadaId" value="<?php echo $idjornada ?>"  hidden>
<input type="text" name="" id="php_yearId" value="<?php echo $yearid ?>" hidden >
<input type="text" name="" id="php_idHorario" value="<?php echo $idhorario ?> " hidden >
<input type="text" name="" id="php_idaula" value="<?php echo $idaula ?>"  hidden>



<?php if (isset($cursos)) {?>

<div class="col-md-12" >
  <div class="box box-warning ">
    <div class="box-body">

     <div class="row">
       <div class="col-xs-12">
        <div class="col-xs-3">
          <label for=""><strong>Cursos</strong></label>
          <?php
          foreach ($cursos as $curso){
            ?>
            <div  class="external-event  ui-draggable ui-draggable-handle" style="background: #05ccc4; color: #ffff;" idcurso="<?php echo $curso['idcurso'] ?>" draggable="true" ondragstart="event.dataTransfer.setData('text/plain',null)" style="margin-bottom: 5px;padding: 5px;border-radius:4px;position: relative;"><?php echo $curso['nonbrecurso']; ?>
              
            </div>
          <?php } ?> 
        </div>
       

        <div class="col-xs-9">
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

                    $datoscursos = $horario->mostratarHorario($c, $hora['HorJor_id'],$seccion);
                    
                     if (!count($a) > 0) { 
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
        <div id="toasts"></div>
      
      </div>
    </div>
  </div>
<div class="modal-footer">
          <img class="loader" src="../login/vendor/abc.gif" style="width: 50px;height:50px;display: none;">
          <button class="btn btn-primary btn-sm"  id="button_resgist" onclick="Registrar_horario_Clases();"><em class="fa fa-check"><b>&nbsp;Guardar</b></em></button>

          
        </div>
</div>
</div>
</div>

 <?php } ?>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript"> 

$(document).ready(function() {
   $("#refres_add").hide();
$('.js-example-basic-single').select2();

listar_combo_Horas_Academicos();


} );

funcion_array_creatd_horario();

  async function ShowSelected(){
  var idjornada = $("#cbm_jornada").val();

   if(idjornada){
    listar_liter_Grado_nivel_turno(idjornada);
    }
  }


</script>