<script type="text/javascript" src="../js/criterio.js?rev=<?php echo time();?>"></script>


 <div class='col-lg-12' style='border-color: #f5c6cb;' id="tutotiales_Id" style="display: none;">
      <div id='avisomanual' class='alert  sm' role='alert' style='color: #0e0102; background-color: #acefe4;'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       ¡Agregar criterios para Libreta de Notas !
       Ingrese los parámetros necesarios:
       Luego Presione en:

       &nbsp;&nbsp;<span class='label label-warning'><i class='glyphicon glyphicon-plus '></i></span>     
     </div>
   </div>
    <style type="text/css">
    
    #btn_bucar_data{
      border: none;border-radius: 5px;color: white;background-color: #05ccc4;
    }
  </style>

<div class="col-md-12" id="DivCriterios">
  <div class="box box-warning ">
    
    <div class="box-header with-border" id="Titulo_Center">
      <h3 class="box-title">Bienvenido,Criterios para evaluación finales <?php echo date("Y"); ?></h3>
     
    </div>
   <!-- /.box-header -->
   <div class="box-body">
    <div class="row">
     <div class="col-xs-12">
      <div class="col-md-2">
       <label for="">Año Aced&eacute;mico </label>
       <select class="js-example-basic-single" name="state" id="bol_cbm_year" style="width:100%;"  onchange="SelectedConsultaLimitd();"  >
       </select><br><br>
     </div>
     <div class="col-md-3">
       <label for="">Grado</label>
       <input type="text" id="edit_txt_evaluacion" hidden ><br>
       <select class="js-example-basic-single" name="state" id="txt_evaluacion_grado" style="width:100%;" onchange="ShowSelectedCursos();" disabled>
       </select><br><br>
     </div>
      <div class="col-md-3">
       <label for="">Nivel (Prim/Secun)</label>
       <input type="text"  id="txt_nivelId" hidden>
       <input type="text" class="form-control" id="txt_nivel_nivel" placeholder="Ingrese nombre" disabled><br>
     </div>
     <div class="col-md-4">
       <input type="text" id="Idactyvite" hidden>
       <label for="">Cursos&nbsp;UNID:</label><label for="" id="cantidadcurso"></label>
        <div class="alin_global">
       <select class="js-example-basic-single" name="state" id="bol_cbm_curso" style="width:100%;"  disabled>
       </select>
       &nbsp;&nbsp;<button onclick="lista_Criterios_Curso();" class="btn-sm" id="but_alin_global" >
                        <em class="fa fa-search" ></em>
                    </button>
     </div>
     </div>
   
   </div>
   </div>
 </div>
</div>
</div>
<style type="text/css">
  .highlight {
  background-color: #e9e1d5;
   border-radius: 5px;

}

</style>

<div id="contenidoCriterios"></div>
<div id="toasts"></div>



<!--
<div class = "col-md-6">
  <div class = "box box-warning">
    <div class="box-header">
  <div class="row">
    <div class="col-xs-6">
       <h3 class="box-title">Condensed Full Width Table</h3>
      </div>
        <div class="col-xs-6">
          <div class="box-tools pull-right">
            <button class="btn btn-secondary btn-sm" onclick="Registrar_Criterios()" style="font-size: 9px"><en class="fa fa-check"></en></button>&nbsp; 
          <button type="button" onclick="Asistencias_Encontrados()" class="btn btn-secondary btn-sm" style="font-size: 9px"><em class="glyphicon glyphicon-plus"></em>
          </button>
      </div> 
      </div>
   </div>
</div>
<div class="box-body no-padding table-responsive">
<table class="table table-condensed">
<thead>
<tr>
<th style="width: 10px">N°</th>
<th>Críterio de Evaluación</th>
<th style="width: 40px">Quitar</th>
</tr>
</thead>
<tbody id="tbody_tabla_Conteen">
   <tr id='key' >  
   <td>1</td>
   <td><input type='text' class='form-control' id='text_criterio' value="Evaluación Actitudinal" spellcheck='true'></td>
    <td></td>
    </tr>
</tbody>
</table>
<br>
</div> 
  </div>
</div>
-->




<script type="text/javascript">
  $(document).ready(function() {
$("#refres_add").hide();


$('.js-example-basic-single').select2();
listar_combo_EscolarAsync() ;

} );

   async function SelectedConsultaLimitd(){
  var idyear = $("#bol_cbm_year").val();

   if(idyear){
    Consultar_Add_CriteriosLimited(idyear);
    }
  }

  async function ShowSelectedCursos(){
  var idgrado = $("#txt_evaluacion_grado").val();

   if(idgrado){
    $("#contenidoCriterios").html('');
    listar_Combo_Cursos(idgrado);
    }
  }


//No se esta usando
  async function ShowSelectedCiterio(e){

    var idcurso = e.options[e.selectedIndex].value;
    var nombrecurso = e.options[e.selectedIndex].text;

   if(idcurso){


    lista_Criterios_Curso(idcurso,nombrecurso);
    $("#tutotiales_Id").hide();
    }
  }



</script>