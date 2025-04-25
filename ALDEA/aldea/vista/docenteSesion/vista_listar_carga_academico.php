
<script type="text/javascript" src="../js/docente_session.js?rev=<?php echo time();?>"></script>
<div class = "col-md-7" id="div_activiti_cursotable" >
  <div class = "box box-warning">
    <div class = "box-header with-border" id="Titulo_Center" >
      <h5 class = "box-title"><strong>Lista de cursos con Cargas Académicos - <?php echo date('Y');?></strong></h5>
    </div>  
    <div class="box-body">
    
        <div class="row">
            <div class="col-xs-2 clasbtn_exportar">
                <div class="input-group" id="btn-place"></div>
            </div>
            <div class="col-xs-2">
            </div>
            <div class="col-xs-8 ">
                <div class="alin_global">
                 <input type="text" class="global_filter form-control " id="global_filter" placeholder="Ingresar dato a buscar" style="border-radius: 5px; width: 100%">&nbsp;&nbsp;<button class="btn btn-primary pull-right"  onclick="AbrirFrom_Registrar();"><i class="glyphicon glyphicon-plus"></i></button>
                </div>
            </div>
        </div><br>

      <table id="tablaactividades" class="display responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>N°</th>
            <th>Código</th>
            <th>Cursos</th>
            <th>Tipo Evaluaci&oacute;n</th>
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


<div class = "col-md-5" id="div_ponderado_table" >
  <div class = "box box-warning">
    <div class = "box-header with-border" id="Titulo_Center" >
      <h5 class = "box-title"><strong>Criterios ha evaluar en cada curso - <?php echo date('Y');?></strong></h5>
    </div>  
    <div class="box-body">

      <table id="criterioEva_tabla" class="display responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>Críterios</th>
            <th>Puntajes(%)</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
            <th></th>

          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>


<div class="col-md-12" id="DivActividades" style="display: none">
  <div class="box box-warning ">
    <div class="box-header with-border">
      <h3 class="box-title" style="text-align: center;"><center><strong>Actividades para la evaluación - <?php echo date('Y');?></strong></center></h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
      <div class="box-body">
        <div class="row">
         <div class="col-xs-12">
          <div class="col-md-3">
            <label for="">Año Aced&eacute;mico </label>
             <select class="js-example-basic-single" name="state" id="cbm_year" style="width:100%;"  onchange="ShowperiodoSelected();" >
                  </select><br><br>
          </div>
          <div class="col-md-3">
            <label for="">Curso</label>
            <input type="text" id="Idactyvite" hidden><br>

             <select class="js-example-basic-single" name="state" id="cbm_curso" style="width:100%;" onchange="ShowSelected();" >
                  </select><br><br>
          </div>
          <div class="col-md-3">
             <label for="">Grado - Curso</label>
             <input type="text" class="form-control" id="codigocur"  style="border-radius: 5px;" placeholder="Ingrese codigo" disabled><br>
          </div>
          <div class="col-md-3">
             <label for="">Tipo (NF/BIME/TRIM/SEM/LAZO)</label>
             <input type="text" id="text_TipoEvaluacion" hidden  >
             <input type="text" id="edit_txt_evaluacion" hidden >
              <select class="js-example-basic-single" name="state" id="txt_evaluacion" style="width:100%;" disabled>
                  </select><br><br>
          </div>
         </div>
           </div>
        </div>
       
         <div class="row">
          <div class="col-xs-12">
          <div class="col-xs-8">
             <label for="">Actividad</label>
             <input type="text" class="form-control " id="actividanombre"  placeholder="Ingrese Actividades" spellcheck='true'><br>
          </div>
          <div class="col-xs-4">
            <label for="">Puntaje(%)</label>
             <div class="alin_global" style="width: 100%">
            <input type="number" class="form-control" id="idprocentaje"  placeholder="Ingrese puntajes" >
                 &nbsp;<button onclick="addactivity();" id="but_alin_global" class="btn-sm"  >
                 <em class="glyphicon glyphicon-plus" ></em>
              </button>
             </div>
          </div>
          </div>
           </div>
      <div class="row">
      <div id="componeteActivity"></div>

      <div class="row">
        <div class="col-xs-12">
          <div class="col-xs-8">
          </div>
          <div class="col-xs-4">
            <label class="form-control"  id="totaldepuntje" style="border-radius: 5px;background-color: #e7e7e7;"></label><br>
          </div>
         
        </div>
        </div>

     <div class="modal-footer">
      <img class="loader" src="../login/vendor/abc.gif" style="width: 50px;height:50px;display: none;">
          <button class="btn btn-primary" id="button_resgist" onclick="Registrar_Actividad()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button> <button type="button" class="btn btn-danger" onclick="LimpiarFrom_Registrar()"><i class="fa fa-close"><b>&nbsp;Cancelar</b></i></button>
     </div>
  </div>
</div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
$('.js-example-basic-single').select2();
$("#refres_add").hide();

listar_Cursos_Actividades();
} );

  async function ShowSelected(){
  var id = $("#cbm_curso").val();

    if(id != 0 || id !=null){
     lista_combo_CodigoCurso(id);
    
    }
  }
  
  async function ShowperiodoSelected(){
  var id = $("#cbm_year").val();

    if(id != 0 || id !=null){
     $('#txt_evaluacion').prop('disabled', false);
     listar_combo_TipoevaluacionAsync(id);
    }
  }

   


</script>