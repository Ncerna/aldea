
<script type="text/javascript" src="../js/grado.js?rev=<?php echo time();?>"></script>
<div class="col-md-4">
    <div class="box box-warning ">
        <div class="box-header titulosclass" id="Titulo_Center">
              <h3 class="box-title">REGISTRAR NUEVO GRADO</h3>
        </div>
            <div class="box-body">
                 <div class="col-lg-12">
                    <label for="">Nombre del Grado</label>
                    <input type="text" id="idGrado" hidden>
                    <input type="text" class="form-control" id="txt_nom" placeholder="ejemplo: PRIMER GRADO 1"
                           onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  // números 0-9
                                        (event.charCode >= 65 && event.charCode <= 90) ||  // letras mayúsculas
                                        (event.charCode >= 97 && event.charCode <= 122) || // letras minúsculas
                                        event.charCode === 32"> <!-- espacio -->
                    <br>
                </div>
                <div class="col-lg-12">
                    <label for="">Turno disponibles Año activo</label>
                    <select class="js-example-basic-single" name="state" id="cbm_turnos" style="width:100%;">
                      <option value="">--Seleccione--</option>
                        <option value="1">MAÑANA</option>
                        <option value="2">NOCHE</option>
                         <option value="3">TARDE</option>
                        <option value="4">INTEGRAL 1</option>
                        <option value="5">INTEGRAL 2</option>
                    </select><br><br>
                </div>
               
                <div class="col-lg-12">
                    <label for="">Nivel Académico</label>
                    <select class="js-example-basic-single" name="state" id="cbm_nivel" style="width:100%;" >
                       <option value="">--Seleccione--</option>
                       <option value="4">INICIAL</option>
                        <option value="1">PRIMARIA</option>
                         <option value="2">SECUNDARIA</option>
                        <option value="3">SUPERIOR</option>
                         <option value="5">CAPACITACIÓN</option>
                            <option value="6">SEMINARIOS</option>
                            <option value="7">TALLER</option>
                  </select><br><br>
                </div>
              
                <div class="col-lg-12">
                    <label for="">Sección</label>
                     <select class="js-example-basic-single" name="state" id="cbm_seccion" style="width:100%;">
                        <option value=" ">---Seleccione--</option>
                         <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select><br><br>
               
                </div> 
                 <div class="col-lg-12">
                    <label for="">Aulas Disponibles</label>
                    <select class="js-example-basic-single" name="state" id="cbm_aula" style="width:100%;" onchange="ShowSelectedAluas(this);">
                  </select><br><br>
              </div>
              <div class="col-lg-12">
                    <label for="">Vacantes Disponibles</label>
                   <input type="number" class="form-control" id="vacantes" disabled>
                <label class="control-label" id="inputWarning" style="display: none">Divide en 2 secciones si tienes más vacantes </label>
                </div>
            </div>
              <div class="modal-footer">
                <button class="btn btn-primary btn-sm" onclick="Registrar_Grado()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
                <button type="button" class="btn btn-default btn-sm" onclick="Cancelar_Registro()"   data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
    </div>
</div>

       <style type="text/css">
          #tabla_grados{
            border: 1px solid #d4f4f7;
            border-radius: 10px;
            background-color: #f5f7f7;
          }
        </style>

<div class="col-md-8">
    <div class="box box-warning ">
        <div class="box-header titulosclass" id="Titulo_Center">
              <h3 class="box-title">LISTA DE GRADOS DISPONIBLES</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
            <div class="box-body">
             <div class="form-group">
            <div class="row">
            <div class="col-xs-4 clasbtn_exportar">
              <div class="input-group" id="btn-place"></div>
            </div>
           
              <div class="col-md-6 pull-right">
                <div class="alin_global">
                 <input type="text" class="global_filter form-control " id="global_filter" placeholder="Ingresar dato a buscar" style=" width: 100%">
                </div>
            </div>
            </div>
            </div>
             <table id="tabla_grados" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Grado</th>
                        <th>Nivel</th>
                        <th>Seccion</th>
                        <th>Aula</th>
                        <th>Turno</th>
                        <th>Vacantes</th>
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
                    </tr>
                </tfoot>
            </table>
            </div>
    </div>
</div>



<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
 $("#refres_add").hide();
    listar_grados() ;
    Listar_Combo_aulas();
   
} );

 async function ShowSelectedAluas(e){
  var idaula = e.options[e.selectedIndex].value;
    var contenido = e.options[e.selectedIndex].text;
   if(idaula){
    var regex = /(\d+)/g;
    $("#vacantes").val(contenido.match(regex));
    $("#inputWarning").show();

    }
  }
</script>

