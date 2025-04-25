
<script type="text/javascript" src="../js/matricula.js?rev=<?php echo time();?>"></script>
<!--
 <div class='col-lg-12' style='border-color: #f5c6cb;' id="tutotiales_Id">
      <div id='avisomanual' class='alert  sm' role='alert' style='color: #0e0102; background-color: #acefe4;'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       Para realizar las matrículas de forma correcta seleccione el alumno y el grado, de forma automática se mostrarán los demás parámetros requeridos. Para cambiar otros parámetros cambia de grado según los establecido en el modulo grados. Gracias!!. &nbsp;&nbsp;<span class='label label-warning'><i class="fa fa-check"></i></span> 
          
     </div>
   </div>

    <div class='col-lg-12' style='border-color: #f5c6cb;' id="tutotiales_Id">
      <div id='avisomanual' class='alert  sm' role='alert' style='color: ##721c24; background-color: #f8d7da;'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       Ya no esta disponible las matriculas para el año académico <strong>activo </strong>.…llego a la fecha Final lo cual se estableció al crear el año académico Gracias!!.
          
     </div>
   </div>
-->
 

<div class="col-md-12" id="DivTableAlumno">
	<div class="box box-warning ">
		<div class="box-header with-border">
			<h3 class="box-title">ALUMNOS MATRICULADOS</h3>
			<div class=" titulosclass">

		<div class="grup_buttons" style="margin-top: -25px;">
				<img class="loader" src="../login/vendor/abc.gif" style="width: 50px;height:50px; display: none">

            <button class="btn btn-primary btn-sm " id="button_resgist" onclick="Registar_Nuevo_Matricula()"><em class="fa fa-check"><b>&nbsp;Registrar</b></em></button>&nbsp;<button class="btn btn-default btn-sm pull-right"onclick="limpiar_Registro_from()"><em class="fa fa-close"><b>&nbsp;Cancelar</b></em></button>&nbsp;

		</div>
	</div>
		</div>
		<div class="box-body">
			<div class="row">
				<input type="text"  id="txt_IdAlumnoMatri" hidden>

				<div class="col-xs-12">
				<div class="col-md-3">
					<label  for="">Seleccione Alumno</label>
					<select class="js-example-basic-single" name="state" id="cbm_alumnos" style="width:100%;" >
						</select><br>
				</div>
				<div class="col-md-3">
                  <label for="">Grado </label><label>(Vacantes diponibles:<strong id="gui_vacantes"></strong>)</label>
                  <select class="js-example-basic-single" name="state" id="cbm_grado" style="width:100%;" onchange="ShowSelectedDetalles(this);" >
                  </select><br>
				</div>
				<div class="col-md-3">
                <label for="">Nivel</label>
                   <input type="text" id="id_nivels" name="" hidden>
                   <input type="text" id="total_vacantes" name="" hidden>
                  <input type="text" class="form-control" id="text_nivel" disabled >
				</div>
				<div class="col-md-3">
                <label for="">Aula</label>
                <input type="text" id="id_aula" name="" hidden>
                 <input type="text" class="form-control" id="txt_aula" disabled >
                 
				</div>
			</div>
			<div class="col-xs-12">
				<div class="col-md-3">
                <label for="">Turno</label>
                <input type="text" id="id_turno" name="" hidden>
                  <input type="text" class="form-control" id="tex_turno" disabled>

				</div>
				<div class="col-md-3">
                <label for="">Pago Único de Mátricula</label>
                <input type="number" class="form-control" id="txt_montopago" placeholder="Guaranies/. 000"><br>
				</div>
				<div class="col-md-3">
                <label for="">Sección</label>
                <input type="text" class="form-control" id="txt_seccion" disabled >
                  
				</div>
				<div class="col-md-3">
                <label for="">Realizara Pagos Mensuales ?</label>
                  <select class="js-example-basic-single" name="state" id="cbm_penciones" style="width:100%;">
                        <option value="NO">NO</option>
                        <option value="SI">SI</option>
                    </select><br><br>
                  
				</div>
            </div>
            	<!--<div class="col-xs-12" id="div_pago_pension" style="display: none;">
				<div class="col-md-3">
				</div>
				<div class="col-md-3">
				</div>
				<div class="col-md-3">
				</div>
				<div class="col-md-3">
                <label for="">Monto a pagar Mensual</label>
                   <input type="number" class="form-control" id="txt_penciones" placeholder="Ingresa monto a pagar">
				</div>
            </div>-->

			</div>
		</div>
	</div>
	<!-- /.box -->
</div>



<div class="col-md-12" >
	<div class="box box-warning ">
		<style type="text/css">
			#tabla_matricula{
				border: 1px solid #d4f4f7;
				border-radius: 10px;
				background-color: #f5f7f7;
			}
		</style>
		<div class="box-body">
			<div class="row">
				<div class="col-xs-4 clasbtn_exportar">
					<div class="input-group" id="btn-place"></div>
				</div>
				
				<div class="col-xs-4">
					<h5 class="box-title">ALUMNOS MATRICULADOS</h5>
				</div>
				<div class="col-xs-4">
					<div class="input-group pull-right ">
						<input type="text" class="global_filter form-control pull-right " id="global_filter" placeholder="Ingresar dato a buscar" style="border-radius: 5px; width: 100%">
					</div>
				</div>


			</div><br>

			<table id="tabla_matricula" class="display responsive nowrap" style="width:100%">
				<thead>
					<tr>
						<th>Nº</th>
						<th>Estudinte</th>
						<th>Cédula</th>
						<th>Grado</th>
						<th>Nivel</th>
						<th>Sección</th>
						<th>Aula</th>
						<th>Turnos</th>
						<th>Acci&oacute;n</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- /.box -->
</div>


<script>
	$(document).ready(function() {
		 $("#refres_add").hide();
	$('.js-example-basic-single').select2();

	listar_alumnos_Matriculados();
	listar_combo_Alumnos();
	listar_combo_Grados();
} );


function ShowSelectedDetalles(e){
var idgrado = e.options[e.selectedIndex].value;
  if(idgrado){
//Extrae_Datos_De_Grados(idgrado);
Lista_Filtros_IdNiels_Grado(idgrado);
   }
}

function ShowSelectePagosPencion(e){
var idgrado = e.options[e.selectedIndex].value;
  if(idgrado=='SI'){
     $("#div_pago_pension").show();
   }else{
    $("#div_pago_pension").hide();
   }
}

</script>