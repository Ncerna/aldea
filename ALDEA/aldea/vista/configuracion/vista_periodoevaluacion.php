
<script type="text/javascript" src="../js/p_valuacion.js?rev=<?php echo time();?>"></script>
  <div class='col-lg-12' style='border-color: #f5c6cb;' id="tutotiales_Id">
      <div id='avisomanual' class='alert  sm' role='alert' style='color: #0e0102; background-color: #acefe4;'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       ....solo no podras editar ni elimibnar cuando no hay calificaciones por medio..    
     </div>
   </div>


<div class="col-md-6" >
<div class="box box-warning ">
    <div class = "box-header with-border titulosclass" id="Titulo_Center" >
		<h3 class="box-title" >Apertura de periodos de evaluación</h3>
		<div class="grup_buttons">
			<button  id="buttNew" class="btn btn-warning btn-sm pull-right" onclick="Abilitar_Form_registro()"  ><em class="fa fa-fw fa-plus-circle"></em></button>
		</div>
	</div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
            <div class="col-md-6">
              <label for="">Año Escolar</label>
			 <input type="text"  class="form-control" id="NombreEnFrom" disabled style="border-radius: 5px;"/><br>
            </div>
            <div class="col-md-6">
              <label for="">Seleccione Tipo</label>
				<select class="js-example-basic-single" onchange="selecPeriodo()" name="state" id="periodovaluacion" disabled style="width:100%;" >
				</select><br><br>
            </div>
         </div>

        <div class="col-xs-12">
            
            <div class="col-xs-4">
              <p>PERIODOS</p>
            </div>            
            <div class="col-xs-4">
            <p>FECHA INICIO</p>      
            </div>
            
            <div class="col-xs-4">
            <p>FECHA FIN</p>    
            </div>
            </div>
          
         </div>
         <div class="row">
         	<div id="cont_horas_error"class="form-group">
         	<div id="id_Componente_Dates"></div>
         	 </div>
         </div>
        </div>
        <div class="modal-footer">
			<img class="loader" src="../login/vendor/abc.gif" style="width: 50px;height:50px;display: none;">
		<button class="btn btn-primary btn-sm" onclick="Registrar_pEvaluacion()" id="btn_registra" disabled><em class="fa fa-check"><b>&nbsp;Registrar</b></em></button> <button type="button" class="btn btn-danger btn-sm" onclick="LimpiarRegistroperiodo()" ><em class="fa fa-close"><b>&nbsp;Cance</b></em></button>
	</div>
    </div>
</div>

<div class="col-md-6" >
<div class="box box-warning ">
    <div class = "box-header with-border titulosclass" id="Titulo_Center" >
		<h5 class="box-title" >Periodos de evaluación<p id="yaernombreEv"></p></h5>
		<div class="grup_buttons">
			&nbsp;&nbsp;<button id="buttEdit"   type='button' class='btn btn-primary btn-sm' onclick="Editar_periodo_Eval();" style=""><em class='fa fa-edit' title='editar'></em></button>&nbsp;
				<button id="butt_quitar"   type='button' class='btn btn-default btn-sm pull-right' onclick="Quitar_periodo_Eval();" style=""><em class='fa fa-trash' title='Eliminar'></em></button>
		</div>
	</div>
    <div class="box-body">
					<input type="text" name="" id="idyearPeriodo" hidden>
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Tipo Evaluación</th>
									<th>F. Inicio</th>
									<th>F. Final</th>
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
        verSusPeriodosDeEvaluacion();
	} );

	function selecPeriodo(){
        var id = $("#periodovaluacion").val();
		var nombre = $("#periodovaluacion option:selected").text();
		Componentes(id,nombre);
	}


</script>