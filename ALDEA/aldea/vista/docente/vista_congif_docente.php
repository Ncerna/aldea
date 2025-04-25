
<script type="text/javascript" src="../js/docente_config.js?rev=<?php echo time();?>"></script>

  <div class='col-lg-12' style='border-color: #f5c6cb;' id="tutotiales_Id">
      <div id='avisomanual' class='alert  sm' role='alert' style='color: #0e0102; background-color: #acefe4;'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      Asignar grados a los docentes para diferentes niveles 1.) seleccione el docente en&nbsp; <em class="glyphicon glyphicon-plus "></em> &nbsp; 2.) seleccione grados y agrega a la tabla en &nbsp; + &nbsp;
          
     </div>
   </div>

 <style type="text/css">
          #tabla_grados{border: 1px solid #d4f4f7;border-radius: 10px; background-color: #f5f7f7;
          }
          #add_cursos_btn{ margin-top: 20px;width: auto;
          }
           
        </style>



<div class="col-md-6">
  <div class="box box-warning ">
    <div class="box-header titulosclass" id="Titulo_Center">
      <h3 class="box-title">Asisgnar Grados A Docentes</h3>
    </div>
    <div class="box-body">
      <div class="form-group pull-right">
        <div class="col-lg-10 pull-right">
          <div class="input-group pull-right">
            <input type="text" class="global_filter form-control input-sm pull-right" id="global_filter" style="border-radius: 5px;" >
          </div>
        </div>
      </div>
      <br><br>
      <table id="tabla_Docentes" class="display responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>N°</th>
            <th>Apellidos</th>
            <th>Nombres</th>
            <th>Nivel</th>
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
         </tr>
       </tfoot>
     </table>
   </div>
 </div>
</div>

<div class="col-md-6" id='modal_agregar_grados' style="display: none;" >
  <div class="box box-warning ">
    <div class="box-header titulosclass" id="Titulo_Center">
     <h5 class="box-title"> Docente</h5><span class="direct-chat-name" id="nombrdocente"></span>
     <div class="box-tools pull-right">
      <button type="button" onclick="Cancelar_registro();" class="btn btn-box-tool" data-widget="collapse"><em class="fa fa-times"></em>
      </button>
    </div>
  </div>
  <div class="box-body">
   <div class="col-lg-12">
   
    <div class="row">
      <div class="col-xs-10">
        <label for="">Grado</label>
        <div class="alin_global">
          <select class="js-example-basic-single" name="state" id="combo_grados" style="width:100%;" disabled  onchange="ShowSelected();">
          </select><br><br>
        </div>
      </div>
      <div class="col-xs-2">
       <button class="btn  btn-warning btn-sm" id="add_cursos_btn" onclick="Add_tr_table()" disabled><em class="glyphicon glyphicon-plus "></em></button>

       <br>
     </div>
   </div>
   <input type="text" name="" id="idDocentesselect" hidden>
   <input type="" name="" id="text_IdNivelDocente" hidden >
   <input type="" name="" id="txt_nivelIdGrado" hidden>

   <input type="" name="" id="txt_idturno" hidden>
   <input type="" name="" id="txt_idseccion" hidden>

   <div class="table-responsive">
     <table   style="width:100%" class="table table-ms">
      <thead class=" thead-drak" style="color: #721c24; background-color: #9fa5a4;">
        <th>Orden</th>
        <th>Nombre</th>
        <th>Quitar</th>
      </thead>
      <tbody id="tbody_tabla_lista_grado">   
      </tbody>
    </table>
    <div id="toasts"></div>

  </div>
</div>
<div class="col-lg-12" id="divCursos" style="display: none;">
 <div class= "box box-ping" style="border-top-color: #eda7b2; border-radius: 7px;">
  <div class="box-header" >
    <h5 class="box-title">Cursos</h5>
    <div class="box-tools pull-right">
     </div>
   </div>
     <table class="table table-condensed table-sm" >
       <thead style="background-color:#989d9c; color: white;">
        <tr>
          <th style="width: 5px; "><input type="checkbox" onclick="All_select(this)" checked></th>
          <th>Nombre</th>
        </tr>
      </thead>
      <tbody id="tbody_tabla_cursosgrados">
    </tbody>
   </table>
   </br>
 </div>
</div>
</div>

<div class="modal-footer">
   <img class="loader" src="../login/vendor/abc.gif" style="width: 50px;height:50px;display: none;">&nbsp;
  <button class="btn btn-primary btn-sm " id="button_resgist" onclick="Registrar_Docente_Grado()"><em class="fa fa-check"><b>&nbsp;Registrar</b></em></button>

</div>
</div>
</div>

<div class="col-md-6" id="table_grados_asignado" >
  <div class="box box-warning ">
    <div class="box-header titulosclass" id="Titulo_Center">
     <h5 class="box-title"> Grados Asignados</h5>
     <span class="direct-chat-name" id="nombre_docente"></span>
     <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="box-body">
    <div class="col-lg-12">
      <input type="text" name="" id="text_IdDocente" hidden>
      <div class="col-lg-12" style='border-color: #f5c6cb;'>
       <div id="table_avisomanua" class="alert  sm" role="alert" style="color: #0e0102; background-color: #acefe4;"><button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        !Para ver grados asignados a cada Docente seleccione en:
        &nbsp;&nbsp;<span class='label label-defautl'><em class="glyphicon glyphicon-eye-open"></em></span>    
      </div>
    </div>

    <table   style="width:100%" class="table table-ms table-responsive">
      <thead class=" thead-drak" style="color: #721c24; background-color: #9fa5a4;">
        <th>Orden</th>
        <th>Grado</th>
        <th>Nivel</th>
        <th>seccion</th>
        <th>Quitar</th>
      </thead>
      <tbody id="tbody_tabla_addcursos">   
      </tbody>
    </table>

  </div>
  <div class="col-lg-12" id="divcursocheckdocente" style="display: none" >
    <div class= "box box-ping" style="border-top-color: #eda7b2; border-radius: 7px;">
      <div class="box-header" >
        <h5 class="box-title">Cursos</h5>
        <div class="box-tools pull-right">
        </div>
      </div>
      <table class="table table-condensed table-sm" >
        <thead style="background-color:#989d9c; color: white;">
          <tr>
            <th style="width: 5px; "><input type="checkbox" disabled ></th>
            <th>Nombre</th>
          </tr>
        </thead>

        <tbody id="tbody_tabla">

        </tbody>
      </table>
    <button class="btn btn-primary btn-sm pull-right" onclick="Actualizar_Cursos_Docente()">Actualizar</button>
  </div>
</div>

</div>
</div>
</div>








<script>
$(document).ready(function() {
  $("#refres_add").hide();
    $('.js-example-basic-single').select2();

   listar_Docentes_Disponibles();
   listar_combo_Grados();

} );

 async function ShowSelected(){
  var idgrado = $("#combo_grados").val();

    if(idgrado){
     Lista_Filtros_IdNiels_Grado(idgrado);
    
    }
  }


</script>

