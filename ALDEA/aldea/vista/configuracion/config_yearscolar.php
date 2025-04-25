<script type="text/javascript" src="../js/yearscolar.js?rev=<?php echo time();?>"></script>

  <div class='col-lg-12' style='border-color: #f5c6cb;' id="tutotiales_Id">
      <div id='avisomanual' class='alert  sm' role='alert' style='color: #0e0102; background-color: #acefe4;'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       Para crear un nuevo año académico seleccione en &nbsp; <i class='glyphicon glyphicon-plus '></i> &nbsp; se creara en forma “inactivo” solo debes tener un año académico Activo no se permite mas Gracias..!!
       &nbsp; Para ver Turnos da clik en <span class='label label-defult'><em class="fa fa-eye"></em></span>    
     </div>
   </div>

    <div class='col-lg-12' style='border-color: #f5c6cb;display: none; ' id="Cerat_avisomanual">
      <div id='' class='alert  sm' role='alert' style='color: #0e0102; background-color: #acefe4;'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       Para crear Año académico correctamente sigue este mensaje : llene las fecha en forma ascendente ..en seguida seleccione el año ..seleccione turno las que deseas tener en este año y ingresa horas(de forma ascendente) académicas para cada turno (ejemplo 08:00am - 13pm). ¡¡¡Las hora y turnos serán para jornadas laborales …Suerte!!!   
     </div>
   </div>

<div class="col-md-12" id="DivYearEscolar" style = "display:none"> 
  <div class="box box-warning ">
    <div class="box-header with-border" id="Titulo_Center">
      <h3 class="box-title">APERTURA DEL A&Ntilde;O ESCOLAR</h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
      <div class="box-body">
        
        <div class="row">
           <div class="col-xs-12">
           <div id="cont_error"class="form-group">
          <div class="col-md-4">
            <label for="">Fecha Inicio</label>
            <input type="text" id="id_yearscolar" hidden>
            <input type="date" class="form-control" id="YearFechainicio"  style="border-radius: 5px;" required min=<?php $hoy=date("Y-m-d"); echo $hoy;?> >
            <span class="help-block">Fechas debe estar en forma acendente!!</span>
            <br>
          </div>
          <div class="col-md-4">                                
            <label for="">Cierre de Matrícula</label>
            <input type="date" class="form-control" id="fechaMatri"  style="border-radius: 5px;">
            <span class="help-block">Fechas debe estar en forma acendente!!</span>
            <br>
          </div>
          <div class="col-md-4">
            <label for="">Fecha Final</label>
            <input type="date" class="form-control" id="YearFechafin"  style="border-radius: 5px;" >
            <span class="help-block">Fechas debe estar en forma acendente!!</span>
            <br>
          </div>
        </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12">
          <div class="col-md-4">
            <label for="">A&Ntilde;O ESCOLAR</label>
            <select class="js-example-basic-single" name="state" id="YearEscolar" style="width:100%;">
              <option value="">------seleccione------</option>
              <option value="2023">2023</option>
              <option value="2024">2024</option>
              <option value="2025">2025</option>
              <option value="2026">2026</option>
              <option value="2027">2027</option>
              <option value="2028">2028</option>
              <option value="2029">2029</option>
              <option value="2030">2030</option>
              <option value="2031">2031</option>
              <option value="2032">2032</option>
              <option value="2033">2033</option>
            </select><br><br>
          </div>

          <div class="col-md-4">
            <label for=""><strong>SELECIONES TURNOS</strong></label>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">+</small>
            </span> 
            <select class="js-example-basic-single" name="state" id="cbm_Turnos" style="width:100%;"  onchange="ShowSelected(this);">
            </select><br><br>
          </div>
          <div class="col-md-4">
            <label for="">Tipo Evaluación</label>
            <select class="js-example-basic-single" name="state" id="TipoEvaluacion" style="width:100%;">
              <option value="PERIODOS">PERIODOS</option>
              <option value="NOTAS FINALES">NOTAS FINALES</option>
            </select><br><br>
          </div>
          </div>
        </div>
         <div id="cont_horas_error"class="form-group">
        <div id="componeteTurnos"></div>
        </div>
        <div class="modal-footer">
          <img class="loader" src="../login/vendor/abc.gif" style="width: 50px;height:50px;display: none;">
          <button class="btn btn-primary btn-sm"  id="button_resgist" onclick="RegisUpdat_YearEscolar();"><i class="fa fa-check"><b>&nbsp;Guardar</b></i></button>

          <button type="button" class="btn btn-danger btn-sm" onclick="LimpiarRegistroYear()"><i class="fa fa-close"><b>&nbsp;Cancelar</b></i></button>
        </div>
      </div>
    </div>
  </div>
</div>

    <style type="text/css">
          #tabla_yearScolar{
            border: 1px solid #d4f4f7;
            border-radius: 10px;
            background-color: #f5f7f7;
          }
        </style>

<div class = "col-md-8" id="tablaYearEscolar" >
  <div class = "box box-warning">
    <div class = "box-header with-border" id="Titulo_Center" >
      <h3 class = "box-title" >LISTA DE A&Ntilde;OS ESCOLARES</h3>
    </div>  
    <div class="box-body">
         <div class="row">
            <div class="col-xs-4 clasbtn_exportar">
              <div class="input-group" id="btn-place"></div>
            </div>
            <div class="col-xs-2">
            </div>
            <div class="col-xs-8 pull-right">
                <div class="alin_global">
                 <input type="text" class="global_filter form-control " id="global_filter" placeholder="Ingresar dato a buscar" style="border-radius: 5px; width: 100%">&nbsp;&nbsp;<button onclick="AbrirModalRegistro();" class="btn-sm" id="but_alin_global" >
                        <em class="glyphicon glyphicon-plus" ></em>
                    </button>
                </div>
            </div>
        </div><br>
      <table id="tabla_yearScolar" class="display responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>N°</th>
            <th>F. Inicio</th>
            <th>F. Final</th>
            <th>CierreMatricula</th>
            <th>AñoEscolar</th>
            <th>Act/Des</th>
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
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<style type="text/css">
  #DivYearTurnos{
    border-radius: 5px;
  }
</style>

<div class="col-md-4" id="DivYearTurnos" > 
  <div class="box box-warning ">
    <div class="box-header with-border" id="Titulo_Center">
      <h3 class="box-title" >LOS TURNOS DEL A&Ntilde;O: <label id="nombryear"></label></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="form-group">
        <table id="yearScolar_turnos" class="display responsive nowrap" style="width:100%">
          <thead>
            <tr>
              <th>Turno</th>
              <th>Inicio</th>
              <th>Final</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
</div>

<!-- -->

<script>
  $(document).ready(function() {
    $("#refres_add").hide();
   Listar_YearEscolar();
   $('.js-example-basic-single').select2();

 } );

  function ShowSelected(e){
    var id = e.options[e.selectedIndex].value;
    var nombre = e.options[e.selectedIndex].text;
    if(nombre != '--seleccione--'){
      addDivdeTurnos(id,nombre);
    }
  }
</script>
