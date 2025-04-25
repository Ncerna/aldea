



<script type="text/javascript" src="../js/asistencia.js?rev=<?php echo time();?>"></script>
<div class="col-md-12" id="DivAsistenciaCrud" >
  <div class="box box-warning ">
    <div class="box-header with-border">
      <h3 class="box-title" style="text-align: center;"><strong>Panel de Asistencias</strong></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-xs-4">
          <div class="alin_global">

            <button onclick="Resito_AsistenciaView();" class="btn btn-primary "  name="search" id="but_alin_global" class="btn btn-flat">
              <em class="fa fa-plus" style="color: white;"></em>
            </button>&nbsp;
            <button onclick="Editar_AsistenciaView();" class="btn btn-primary "  name="search" id="but_alin_global" class="btn btn-flat">
              <em class="fa fa-edit" style="color: white;"></em>
            </button>&nbsp;
            <button onclick="Eliminar_AsistenciaView();" class="btn btn-primary " name="search" id="but_alin_global" class="btn btn-flat">
              <em class="fa fa-trash" style="color: white;"></em>
            </button>
          </div>

        </div>
        <div class="col-xs-4">
        </div>
        <div class="col-xs-4">

        </div>
      </div>

    </div>
  </div>
</div>

<style type="text/css">
  #btn_bucar_data{
      border: none;border-radius: 5px;color: white;background-color: #05ccc4;
    }
     #edit_btn_bucar_data{
      border: none;border-radius: 5px;color: white;background-color: #05ccc4;
    }
     #elimi_btn_bucar_data{
      border: none;border-radius: 5px;color: white;background-color: #05ccc4;
    }
</style>

<div class="col-md-12" id="DinNuevoAsistencia" style="display: none;">
  <div class="box box-warning ">
    <div class = "box-header with-border titulosclass" id="Titulo_Center"  >
      <h5 class = "box-title" ><strong>Registro de asistencia</strong></h5>
       <div class="box-tools pull-right">
         <button type="button" class="btn btn-box-tool" data-widget="remove"  title="" data-original-title="Remove" onclick="Black_MenuAsis();">
         <em  class="fa fa-times"></em>
      </div>
    </div>
    <div class="box-body">
      <div class="row">
         <div class="col-xs-12">
        <div class="col-md-3">
          <label >Seleccione Grado</label>
           <select class="js-example-basic-single " name="state" id="cbm_grado" style="width:100%;" onchange="ShowSelected();"  >
              </select>
        </div>
        <div class="col-md-3" >
           <label>Nivel</label>
            <input type="text" name="" id="txt_nivelId" hidden>
              
              <input type="text" name="" class="form-control" id="txt_nivel_nivel" disabled>
              
        </div>
        <div class="col-md-3">
         <label>Sección</label>
          <input type="text" name="" class="form-control" id="text_seccion" disabled>
         </div>            
        
        <div class="col-md-3">
         <label>Fecha</label>
          <div class="alin_global">
          <input class="form-control form-control-sm" type="Date" id="FechaAsistencia">&nbsp;&nbsp;<button onclick="Listar_Alumno_Asistencia();" class="btn-sm"  id="btn_bucar_data"> <em class="fa fa-search" ></em></button>
        </div>
        </div>
       </div>
      </div>
      <br>
      <table class="table table-condensed">
        <thead style="background-color:#696c6c;color: white;">
          <tr>
            <th style="width: 10px">N°</th>
            <th >Alumno</th>
            <th >Información</th>
            <th  >
              <label  class='switch_checbok' style="display: block !important;">
               <input type='checkbox'  onclick="All_select(this)">
               <span class='siderasis round'></span>
             </label>
           </th>
         </tr>
       </thead>
       <tbody id="tbody_tabla_detall">
       </tbody>
     </table>
     <div class="modal-footer">
       <img class="loader" src="../login/vendor/abc.gif" style="width: 50px;height:50px;display: none;">&nbsp;
       <button class="btn btn-primary btn-sm" id="button_resgist" onclick="RegistrarAsistencia()"><em class="fa fa-check"><b>&nbsp;Registrar</b></em></button>
     </div>
   </div>
 </div>
</div>




<div class="col-md-12"  id="EditarDivAsistencia" style="display: none;">
 <div class="box box-warning ">
  <div class="box-header with-border titulosclass" id="Titulo_Center"  >
    <h5 class="box-title" style="text-align: center;"><strong>Editar Asistencia</strong></h5>
    <div class="box-tools pull-right">
         <button type="button" class="btn btn-box-tool" data-widget="remove"  title="" data-original-title="Remove" onclick="Black_MenuAsis();">
         <em  class="fa fa-times"></em>
      </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
   <div class="row">
         <div class="col-xs-12">
        <div class="col-md-3">
          <label >Seleccione Grado</label>
           <select class="js-example-basic-single " name="state" id="edit_cbm_grado" style="width:100%;" onchange="ShowSelected_Edit();"  >
              </select>
        </div>
        <div class="col-md-3" >
           <label>Nivel</label>
            <input type="text" name="" id="edit_txt_nivelId" hidden>
              
              <input type="text" name="" class="form-control" id="edit_txt_nivel_nivel" disabled>
              
        </div>
        <div class="col-md-3">
         <label>Sección</label>
          <input type="text" name="" class="form-control" id="edit_text_seccion" disabled>
         </div>            
        
        <div class="col-md-3">
         <label>Fecha</label>
          <div class="alin_global">
           <input class="form-control form-control-sm" type="Date" id="SeachFechaEdit" style="border-radius: 5px;"  >&nbsp;&nbsp;<button onclick="Listar_Asistencias_fecha();" class="btn-sm"  id="edit_btn_bucar_data"> <em class="fa fa-search" ></em></button>
        </div>
        </div>
       </div>
      </div>
      <br>
     <table class="table table-condensed">
      <thead style="background-color:#696c6c;color: white;" id="thead_asistencia">
        <tr>
          <th style="width: 10px">N°</th>
          <th >Alumno</th>
          <th >Información</th>
          <th style="vertical-align: sub;text-align: center;" >
            <label  class='switch_checbok' style="display: block !important;">
             <input type='checkbox'  onclick="Edit_All_select(this)" disabled  title="NO Editable">
             <span class='siderasis round'></span>
             </label>
          </th>
        </tr>
      </thead>
     <tbody id="tbody_tabla_EditAsis">
      </tbody>
    </table>
</div>
<div class="modal-footer">
   <img class="loader" src="../login/vendor/abc.gif" style="width: 50px;height:50px;display: none;">&nbsp;
 <button class="btn btn-primary btn-sm" id="edit_button_resgist" onclick="Update_Asistencia();"><i class="fa fa-check"><b>&nbsp;Actualizar</b></i></button>
</div>
</div>
</div>


<div class="col-md-12" id="ElimirarDivAsistencia" style="display: none;">
 <div class="box box-warning ">
  <div class="box-header with-border  titulosclass" id="Titulo_Center"  >
    <h5 class="box-title" style="text-align: center;"><strong>Eliminar Asistencia</strong></h5>
     <div class="box-tools pull-right">
         <button type="button" class="btn btn-box-tool" data-widget="remove"  title="" data-original-title="Remove" onclick="Black_MenuAsis();">
         <em  class="fa fa-times"></em>
      </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
<div class="row">
         <div class="col-xs-12">
        <div class="col-md-3">
          <label >Seleccione Grado</label>
           <select class="js-example-basic-single " name="state" id="elim_cbm_grado" style="width:100%;" onchange="ShowSelected_Elimi();"  >
              </select>
        </div>
        <div class="col-md-3" >
           <label>Nivel | sección</label>
            <input type="text"  id="elim_txt_nivelId" hidden >
              <input type="text"  id="elim_text_seccion"  hidden>

              <input type="text" name="" class="form-control" id="elim_txt_nivel_nivel_seccion" disabled>
              
        </div>
         
         <div class="col-md-3">
         <label>Fecha inicio</label>
          <input class="form-control form-control" type="Date" id="FechaInicio" style="border-radius: 5px;">
         </div>           
        
        <div class="col-md-3">
         <label>Fecha Fin</label>
          <div class="alin_global">
            <input class="form-control form-control" type="Date" id="FecahaFin" style="border-radius: 5px;">&nbsp;&nbsp;<button onclick="Estraer_Asistencia_Eliminar();" class="btn-sm"  id="elimi_btn_bucar_data"> <em class="fa fa-search" ></em></button>
        </div>
        </div>
       </div>
      </div>
      <br>




  <table class="table table-condensed">
    <thead style="background-color:#696c6c;color: white;">
      <tr>
         <th style="width: 10px">N°</th>
        <th>Alumno</th>
        <th>Fechas</th>
        <th>Indicador</th>
      </tr>
    </thead>
     <tbody id="tbody_tabla_Filtrados">
    </tbody>
  </table>


</div>
<div class="modal-footer">
   <img class="loader" src="../login/vendor/abc.gif" style="width: 50px;height:50px;display: none;">&nbsp;
 <button class="btn btn-danger btn-sm" id="elim_button_resgist" onclick="Elimirar_Asistencia();"><em class="fa fa-trash-o" aria-hidden="true"></em> Eliminar</button>

</div>
</div>
</div>


<script type="text/javascript">

  function All_select(e){
    if(e.checked){
           $("#tbody_tabla_detall .switch_checbok ").each(function(i){
            $("input[class='clas_chebo"+i+"']").prop("checked", true);
           });
    }
    else{
       $("#tbody_tabla_detall .switch_checbok ").each(function(i){
            $("input[class='clas_chebo"+i+"']").prop("checked", false);  
           });
    }   
  }

 


$(document).ready(function() {
  $("#refres_add").hide();
  $('.js-example-basic-single').select2();

} );


 /*async function ShowSelectedFecha(){
  var ing_fech = $("#SeachFechaEdit").val();
   if(ing_fech){
    Listar_Asistencias_fecha(ing_fech);
    }
  }
*/

</script>


