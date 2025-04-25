<script type="text/javascript" src="../js/jornada.js?rev=<?php echo time();?>"></script>

 <div class='col-lg-12' style='border-color: #f5c6cb;' id="tutotiales_Id">
      <div id='avisomanual' class='alert  sm' role='alert' style='color: #0e0102; background-color: #acefe4;'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Para crear horas laborales seleccione el año académico activo en seguida se listaran turnos del año académico configurado…seleccione un turno,( Primero registre un turno luego vuelve por el otro.. ) las horas automáticamente se mostraran ya que se han  configura al crear el año académico ..en seguida ingrese hora entre el inicio y final y presione en el botón  <em class="glyphicon glyphicon-plus" ></em> para agregar a la lista…por ultimo seleccione el grado y nivel…Gracias por su atención.
     </div>
   </div>

<div class="col-md-12"  id="tablajornadas_Div" >
    <div class="box box-warning ">
        <div class="box-header titulosclass" id="Titulo_Center">
              <h5 class="box-title"><strong>Lista de Horas Académicos</strong></h5>

         
              <!-- /.box-tools -->
        </div>
        <style type="text/css">
          #tabla_jornadas{
            border: 1px solid #d4f4f7;
            border-radius: 10px;
            background-color: #f5f7f7;
          }
        </style>

            <!-- /.box-header -->
            <div class="box-body">
            <div class="form-group">

            <div class="row">

            <div class="col-xs-4 clasbtn_exportar">
              <div class="input-group" id="btn-place"></div>
            </div>


            <div class="col-xs-6">
              <div class="input-group">
                        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar" style="border-radius: 5px;">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    </div>
            </div>
            <div class="col-xs-2 but_New" >
               <button class="btn btn-primary" style="width:100%" onclick="From_registro_horas()"><em class="glyphicon glyphicon-plus"></em></button>
            </div>
            </div>

            </div>
            

            <table id="tabla_jornadas" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Año Escolar</th>
                        <th>Turnos</th>
                        <th>Gado</th>
                        <th>Nivel</th>
                        <th>Sección</th>
                        <th>Hora Inicio</th>
                        <th>Hora Final</th>
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
            <!-- /.box-body -->
    </div>
          <!-- /.box -->
</div>



<div class="col-md-12" id="DivFromJornadas" style="display: none;">
  <div class="box box-warning ">
    <div class="box-header with-border">
      <h5 class="box-title"><strong>Crear Jornadas(Horas Académicos)</strong></h5>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-xs-12">
          <div class="col-md-3">
           <input type="tex" id="text_idjornada" hidden>
           <label for="">Año Acedémico </label>
           <select class="js-example-basic-single" name="state" id="cbm_year" style="width:100%;" onchange="ShowSelected_Anio();">
           </select><br><br>
         </div>
         <div class="col-md-3">
          <label for="">Jornada || Tunos</label>
          <select class="js-example-basic-single" name="state" id="combo_turnos" style="width:100%;"  disabled onchange="Selected_Horas_Turno();">
          </select><br><br>

        </div>
        <div class="col-md-3">
         <label for="">Hora de Inicio Jornada</label>
         <input type="time" class="form-control" id="iniciofornada" placeholder="" style="border-radius: 5px;" disabled><br>
       </div>
       <div class="col-md-3">
        <label for="">Hora Final Jornada</label>
        <input type="time" class="form-control" id="finalfornada" style="border-radius: 5px;"placeholder=" Ingrese Hora"  disabled><br>
      </div>

    </div>
    <div class="col-xs-12">
     <div class="col-md-3">
      <label for="">Hora de Inicio </label>
      <input type="time" class="form-control" id="iniciohora"  style="border-radius: 5px;" disabled>
    </div>

    <div class="col-md-3">
      <label for="">Hora de Finalizacion</label>
      <div class="alin_global">
        <input type="time" class="form-control" id="horafinid" >
        &nbsp;&nbsp;<button onclick="addDivdeHoras();" class="btn-sm" id="but_alin_global" >
          <em class="glyphicon glyphicon-plus" ></em>
        </button>
      </div>
    </div>
    <div class="col-md-3">
     <label for="">Seleccione Grado</label>
     <select class="js-example-basic-single" name="state" id="cbm_niveles" style="width:100%;" onchange="Selected_Turnos_Grado();">
     </select><br><br>
   </div>
   <div class="col-md-3">
    <label for="">Nivel || Sección || Aula</label>
    <input type="text"  id="id_GradosNivel" hidden >
    <input type="text"  id="txt_seccion" hidden>
    <input type="text"  id="idaula_text" hidden>
    <input type="text" class="form-control" id="txt_NombreNivelGrado"  disabled><br>

  </div>
</div>
<hr>
<ol class="carousel-indicators">

</ol>
<div id="componeteHoras"> </div>

</div>

</div>
<div class="modal-footer">
  <img class="loader" src="../login/vendor/abc.gif" style="width: 50px;height:50px;display: none;">
  <button class="btn btn-primary btn-sm"  id="btn_registra" onclick="Registrar_Fornadas();"><i class="fa fa-check"><b>&nbsp;Guardar</b></i></button>

  <button type="button" class="btn btn-danger btn-sm" onclick="CancelarJornadas()"><i class="fa fa-close"><b>&nbsp;Cancelar</b></i></button>
</div>
</div>
</div>


<form autocomplete="false" onsubmit="return false"  onsubmit="return false">
  <div class="modal fade" id="HorasJornada_modal_View" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b><i class="fa fa-edit"></i>Horas Configurados</b></h4>
        </div>
        <div class="box-body">
          <div class="box-body no-padding">
            <table class="table table-condensed">
              <tbody>
                <tr>
                  <th >Turno</th>
                  <th>Grado</th>
                  <th>Nivel</th>
                </tr>
                <tr>
                  <td><p id="jornada_turnos"></p></td>
                  <td><p id="grado_jornada"></p></td>
                  <td><p id="nivel_jornada"></p></td>
                </tr>
              </tbody></table>
            </div>
              <table class="table table-condensed">
                <thead>
                  <tr>
                    <th align='center'>Hora de Inicio</th>
                    <th align='center'>Hora de Culminación</th>
                  </tr>
                </thead>
                <tbody id="tbody_tabla_detall">
                </tbody>
              </table>
          </div>
          <div class="modal-footer">
            <label for="">&nbsp;</label><br>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
          </div>
        </div>
      </div>
    </div>
  </form>




<script type="text/javascript"> 


$(document).ready(function() {
   $("#refres_add").hide();
$('.js-example-basic-single').select2();
listar_jornadas_Horas();
} );

   iniciofornada.onblur = function() {
  if (iniciofornada.value != '') { 
    $("#iniciohora").val(iniciofornada.value);
  }
};
function ShowSelected_Anio(){
   var id = $("#cbm_year").val();
   // var id = e.options[e.selectedIndex].value;
    if(id){
      Lista_combo_Turnos(id);
    }
  }

 function Selected_Horas_Turno(){
var idturno = $("#combo_turnos").val();
// var idturno = e.options[e.selectedIndex].value;
    if(idturno){
      Extraer_Horas_combo_Turnos(idturno);
    }
}

function Selected_Turnos_Grado(){
  var idgrado = $("#cbm_niveles").val();
// var idturno = e.options[e.selectedIndex].value;
    if(idgrado){
      Turnos_Del_GradoSelecionado(idgrado);
    }
}


</script>
