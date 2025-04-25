
<script type="text/javascript" src="../js/notas.js?rev=<?php echo time();?>"></script>
<div class="col-md-12" id="DivSelectEnFases"  >
  <div class="box box-warning ">
    <div class = "box-header with-border" id="Titulo_Center" >
      <h3 class = "box-title">Registro de notas académicas</h3>
    </div>
    <div class="box-body">
     <style type="text/css">#btn_bucar_data{
      border: none;border-radius: 5px;color: white;background-color: #05ccc4;
    }</style>
    <div class="row">
     <div class="col-xs-12">
      <div class="col-md-4">
        <label for="">Grados</label>
        <select class="js-example-basic-single" name="state" id="cbm_grado" style="width:100%;" onchange="ShowSelectedCursos();"  >
        </select><br><br>
      </div>
      <div class="col-md-4">
       <label for="">Nivel</label>
       <input type="text" name="" id="txt_nivelId" hidden>
       <input type="text" name="" class="form-control" id="txt_nivel_nivel" disabled>
     </div>
     <div class="col-md-4">
      <label for=""><strong>Seccion</strong></label>
      <input type="text" name="" class="form-control" id="text_seccion" disabled>
    </div>
  </div>
</div>
<div class="row">
 <div class="col-xs-12" >
  <div class="col-xs-4">

    <label for="">Tipo (Bim,Tri,Sem)</label>
    <input type="text" name="" id="text_TipoEvaluacion" hidden>
    <select class="js-example-basic-single" name="state" id="cbm_tipoOrden"style="width:100%;">

      
    </select><br><br>
  </div>
  <div class="col-xs-4">
   <label for="">Curso&nbsp;:UNID:</label><label for="" id="cantidadcurso" ></label>
   <select class="js-example-basic-single" name="state" id="cbm_curso" style="width:100%;"  >
   </select><br><br>
 </div>
 <div class="col-xs-4 pull-righ" >
   <label for="">Año Académico</label>
   <div class="alin_global">
     <input type="text" name="" class="form-control"  disabled id="NombreayearActivo">&nbsp;
     <button onclick="EtraerDatosSegunLosParametrosEstablecidos();" class="btn-sm" id="btn_bucar_data"> <em class="fa fa-search" ></em> </button>
   </div>

 </div>
</div>
</div>
</div>
</div>
</div>

<style type="text/css">
  

#messaje_info {
   position: absolute;
    background-color: #0c0c0c;
    padding: 5px;
    z-index: 1;
    color: white;
    border-radius: 5px;
}
</style>

<div class="col-md-12" id="DivSelectEnFases"  >
  <div class="box box-warning ">
    <div class = "box-header with-border titulosclass" id="Titulo_Center"  >
       <h3 class="box-title" id="title_name_course"></h3> <p id="messaje_info" style="display: none;">Esta nota remplaza al ponderado</p>
      
     <button  id="buttNew" class="btn btn-warning" onclick="Nuevo_registro()"  style=' display: none;'><em class="fa fa-fw fa-plus-circle" title="Generar Notas"></em></button>
   </div>
   <div class="box-body">
    <div id="toasts"></div>
    <div class="col-md-12 table-responsive" ><br>
     <div id="table_notas"></div>

  

  </div>
  <div class="modal-footer">
    <img class="loader" src="../login/vendor/abc.gif" style="width: 40px;height:40px;display: none;">&nbsp;
    <button id="button_resgist"  class="btn btn-primary btn-sm" onclick="Guardar_Registro_Notas()"  disabled><em id="em_button_icon" class="fa fa-check"><b>&nbsp;Guardar</b></em></button> <button id="cancel_button" onclick="Limpiar_cancelar_registro()" type="button" class="btn btn-danger btn-sm"  disabled><em class="fa fa-close"><b>&nbsp;Cancelar</b></em></button>
  </div>
</div>
</div>
</div>


             


<script type="text/javascript">

  $(document).ready(function() {
     $("#refres_add").hide();
    $('.js-example-basic-single').select2();

    YearAcademicoActivo();
 
     Listar_combo_gradosActivos();
     ListarComboDePeriodoDeEvaluacionYearActivoYFechas();
    

  } );

  async function ShowSelectedCursos(){
  var idgrado = $("#cbm_grado").val();

   if(idgrado){
    getCousesByIdDegre(idgrado);
    }
  }

function YearAcademicoActivo(){

var nonbreYearActual  = $("#tex_YearActual_").val();
$("#NombreayearActivo").val(nonbreYearActual);

}


</script>

