<script type="text/javascript" src="../js/fases.js?rev=<?php echo time();?>"></script>

<div class='col-lg-12' style='border-color: #f5c6cb;' id="tutotiales_Id">
      <div id='avisomanual' class='alert  sm' role='alert' style='color: #0e0102; background-color: #acefe4;'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       Para configurar la fase de recuperación y la fase regular debes presionar en <em class="fa fa-fw fa-plus-circle"></em> y para editarlo en <em class='fa fa-edit'></em> pero las fecha deben estar en el rango de la fechas  (F. Inicio F. Final) del año escolar activo. Si no tomo en cuenta las fechas puedes editar luego de haber creado la fase  … Gracias por su Atención. 
          
     </div>
   </div>

<div class="col-md-6" >
<div class="box box-warning ">
	<div class = "box-header with-border titulosclass" id="Titulo_Center" >
		<h3 class="box-title" >Apertura de fase escolar</h3>
		<div class="grup_buttons">
			<button  id="buttNew" class="btn btn-warning btn-sm pull-right" onclick="AbrirModalRegistro_Fase()"  ><em class="fa fa-fw fa-plus-circle"></em></button>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-xs-12">
				<div class="col-md-12">
                     <div class="col-xs-4">
					<label>Año Escolar</label>
					<input type="text"  class="form-control" id="NombreEnFrom" disabled style="border-radius: 5px;"/><br>
					</div>
					 <div class="col-xs-4">
					 	<label>F. Inicio</label>
					 	<input type="date"  class="form-control" id="fechaInicioYear" disabled style="border-radius: 5px;"/><br>
					 	
					</div>
					 <div class="col-xs-4">
					 	<label>F. Final</label>
					 	<input type="date"  class="form-control" id="fechaFinalYear" disabled style="border-radius: 5px;"/><br>
					</div>
				</div>
			</div>
			<div class="col-xs-12">
				<div id="cont_horas_error"class="form-group">
					<div class="col-xs-4"><br>
					<label >Fase Regular</label><br><br><br>
					<label>Fase Recuperacón</label><br>
					</div>            
					<div class="col-xs-4">
						<label for="">Final</label>
						<div class="faseGrupo_fil">
							<input type="date" class="form-control" id="fechafinregular" disabled  style="border-radius: 5px;" ><br>
							<input type="date" class="form-control" id="finalfecrecupe"  disabled style="border-radius: 5px;" ><br>
						</div>
					</div>
					
					<div class="col-xs-4">
						<label for="">Inicio</label>
						<div class="grupoFasesin">
							<input type="text" id="idfase" hidden >
							<input type="date" class="form-control" id="fechainiregular"  disabled  style="border-radius: 5px;" ><br>
							<input type="date" class="form-control" id="iniciofecrecupe"  disabled  style="border-radius: 5px;" ><br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<img class="loader" src="../login/vendor/abc.gif" style="width: 50px;height:50px;display: none;">
		<button class="btn btn-primary" onclick="Registrar_faseEscolar()" id="btn_registrar" disabled><em class="fa fa-check"><b>&nbsp;Guardar</b></em></button> <button type="button" class="btn btn-danger" onclick="LimpiarRegistroFase()"><em class="fa fa-close"><b>&nbsp;Cancelar</b></em></button>
	</div>
</div>
</div>

<div class="col-md-6" >
	<div class="box box-warning ">
		<div class = "box-header with-border titulosclass" id="Titulo_Center" >
			<h3 class = "box-title">Fase escolar de : <p id="nombryear"></p></h3>
			<div class="grup_buttons">
				<button id="buttEdit"  style='font-size:13px;display: none;' type='button' class='btn btn-primary btn-sm' onclick="editar_Fase_Escolar()" ><em class='fa fa-edit' title='editar'></em></button>&nbsp;
				<button id="butt_quitar"  style='font-size:13px;display: none;'  type='button' class='btn btn-default btn-sm pull-right' onclick="Quitar_periodo_Fase();" style=""><em class='fa fa-trash' title='Eliminar'></em></button>

			</div>
		</div>
		<div class="box-body">
			<input type="text" name="" id="idyearPeriodo" hidden>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Fase</th>
							<th>F. Inicio</th>
							<th>F. Final</th>
							<th>stado</th>
						</tr>
					</thead>
					<tbody id="tbody_tabla_detall">
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>


<script type="text/javascript">

    $(document).ready(function() {
		$("#refres_add").hide();
      $('.js-example-basic-single').select2();
       Extraer_Fase_DelYear();

    } );

</script>