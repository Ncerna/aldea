
<script type="text/javascript" src="../js/docentes.js?rev=<?php echo time();?>"></script>
<div class="col-md-12" id="div_tabla_docente">
    <div class="box box-warning ">
        <style type="text/css">
        #tabla_docente {
            border: 1px solid #d4f4f7;
            border-radius: 10px;
            background-color: #f5f7f7;
        }
        </style>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-4 clasbtn_exportar">
                    <div class="alin_global">
                        <div class="input-group" id="btn-place"></div>
                    </div>
                </div>
                <div class="col-xs-1">
                </div>
                <div class="col-xs-7 pull-right">
                    <div class="alin_global">
                        <input type="text" class="global_filter form-control " id="global_filter"
                            placeholder="Ingresar dato a buscar" style=" width: 100%">&nbsp;&nbsp;<button
                            onclick="Abrir_Modal_Registro();" class="btn-sm" id="but_alin_global">
                            <em class="glyphicon glyphicon-plus"></em>
                        </button>
                    </div>
                </div>
            </div><br>
            <table id="tabla_docente" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>DNI</th>
                        <th>Nivel</th>
                        <th>Telfono</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
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
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>


<div class="col-md-12" id="div_docenteRegitrer" style="display: none;" >
  <div class="box box-warning ">
    <div class = "box-header with-border titulosclass" id="Titulo_Center"  >
       <h5 class="box-title" style="text-align: center;"><strong><label id="regiterEdit"></label>  de Docentes</strong></h5>
       <div class="box-tools pull-right">
         <button type="button" class="btn btn-box-tool" data-widget="remove"  title="" data-original-title="Remove" onclick="canselar_Registro();">
         <em  class="fa fa-close"></em>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
     <div class="col-xs-12">
      <div class="row">
        <div class="col-md-3">
          <label >Nombres</label>
           <input type="text"  id="id_docente" hidden >
           <input type="text" name="" class="form-control" id="txt_nombre" onkeypress = "return (event.charCode > 64 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||
             (event. charCode > 31 && event.charCode < 33)" ><br>
        </div>
        <div class="col-md-3" >
           <label>Apellidos</label>
               <input type="text" name="" class="form-control" id="txt_apellido" onkeypress = "return (event.charCode > 64 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||
             (event. charCode > 31 && event.charCode < 33)" ><br>
        </div>
        <div id="cont_dniem_error"class="form-group">
        <div class="col-md-3">
         <label>CI-DNI-Docente</label>
           <input type="number" name="" class="form-control" id="txt_dni" ><br>
         </div>            
        <div class="col-md-3">
         <label>E-mail</label>
           <input type="email" name="" class="form-control" id="txt_email" onkeypress = "return (event.charCode > 63 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||(event. charCode >47 && event.charCode<58)||(event. charCode>44 && event. charCode<47)||(event. charCode==95)"><br>
        </div>
        </div>

       </div>
       <div class="row">
        <div class="col-md-3">
          <label >Teléfono</label>
           <input type="number"  id="id_colegio" hidden >

           <input type="text" name="" class="form-control" id="txt_telefo" ><br>
        </div>
        <div class="col-md-3" >
            <div id="cont_codigo_error"class="form-group">
           <label>Código</label>
              
               <input type="text" name="" class="form-control" id="txt_codigo" ><br>
           </div>
        </div>
        <div class="col-md-3">
         <label>Nivel(*)</label>
          <select class="js-example-basic-single" name="state" id="cbm_nivel" style="width:100%;">
                    </select><br><br>
         </div>            
        <div class="col-md-3">
         <label>Tipo-Docente</label>
           <select class="js-example-basic-single" name="state" id="cbm_tipo" style="width:100%;">
                      <option value="">--Seleccione--</option>
                        <option value="CONTRATADO">CONTRATADO</option>
                        <option value="NOMBRADO">NOMBRADO</option>
                         <option value="HORAS">HORAS</option>
                    </select><br><br>
        </div>
    </div>
    <div class="row">
            <div class="col-md-3">
                <label>Matrícula</label>
                <input type="text" class="form-control" id="txt_matricula"><br>
            </div>
            <div class="col-md-3">
                <label>Cargo MEC</label>
                <input type="text" class="form-control" id="txt_cargo_mec"><br>
            </div>
            <div class="col-md-3">
                <label>Cargo INT</label>
                <input type="text" class="form-control" id="txt_cargo_int"><br>
            </div>
            <div class="col-md-3">
                <label>Clase de Cargo</label>
                <input type="text" class="form-control" id="txt_clase_cargo"><br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label>Turno</label>
                <input type="text" class="form-control" id="txt_turno"><br>
            </div>
            <div class="col-md-3">
                <label>Nivel MEC</label>
                <input type="text" class="form-control" id="txt_nivel_mec"><br>
            </div>
            <div class="col-md-3">
                <label>Títulos Obtenidos</label>
                <input type="text" class="form-control" id="txt_titulos"><br>
            </div>
            <div class="col-md-3">
                <label>Identificación Aldea</label>
                <input type="text" class="form-control" id="txt_identificacion_aldea"><br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label>Estado Civil</label>
                <select class="form-control" id="cbm_estado_civil">
                    <option value="">--Seleccione--</option>
                    <option value="Soltero/a">Soltero/a</option>
                    <option value="Casado/a">Casado/a</option>
                    <option value="Viudo/a">Viudo/a</option>
                </select><br>
            </div>
            <div class="col-md-3">
                <label>Lugar de Nacimiento</label>
                <input type="text" class="form-control" id="txt_lugar_nacimiento"><br>
            </div>
             <div class="col-md-3">
                <label>Cargo Aldea</label>
                <input type="text" class="form-control" id="txt_cargo_aldea"><br>
            </div>
            <div class="col-md-3">
                <label>Nivel Grado</label>
                <input type="text" class="form-control" id="txt_nivel_grado"><br>
            </div>
        </div>
        </select><br><br>
        <div class="row">
          <div class="col-md-3">
            <label>Fecha de Ingreso</label>
            <input type="date" class="form-control" id="fecha_ingreso"><br>
          </div>
          
          <div class="col-md-3">
            <label>Nacionalidad</label>
            <input type="text" class="form-control" id="nacionalidad"><br>
          </div>
          <div class="col-md-3">
            <label>Antigüedad (años)</label>
            <input type="number" class="form-control" id="antiguedad" min="0"><br>
          </div>
          <div class="col-md-3">
            <label>Antigüedad en Docencia (años)</label>
            <input type="number" class="form-control" id="antiguedad_docencia" min="0"><br>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
              <label>Renuncia</label>
              <input type="text" class="form-control" id="renuncia" placeholder="Ej: SI o NO"><br>
            </div>
          <div class="col-md-3">
            <label>Tipo de Contrato</label>
            <select class="form-control" id="tipo_contrato">
              <option value="">--Seleccione--</option>
              <option value="INDETERMINADO">INDETERMINADO</option>
              <option value="A PLAZO FIJO">A PLAZO FIJO</option>
              <option value="LOCACIÓN DE SERVICIOS">HORAS</option>
            </select><br>
          </div>
          <div class="col-md-6">
            <label>Observaciones</label>
            <textarea class="form-control" id="obser" rows="3" placeholder="Observaciones adicionales..."></textarea><br>
          </div>
        </div>
        <div class="row">
         <div class="col-md-3">
            <label>Foto Carnet</label>
            <input type="file" class="form-control" id="foto_docente" accept="image/*"><br>
            <img id="preview_foto" src="" width="120" height="150" style="display:none;">
          </div>

          <div class="col-md-3">
            <label>Curriculum Vitae (PDF)</label>
            <input type="file" class="form-control" id="cv_docente" accept="application/pdf"><br>
            <div id="link_cv"></div>
          </div>

          <div class="col-md-3">
            <label>Título Profesional (PDF)</label>
            <input type="file" class="form-control" id="titulo_docente" accept="application/pdf"><br>
            <div id="link_titulo"></div>
          </div>

          <div class="col-md-3">
            <label>Constancia Laboral (PDF)</label>
            <input type="file" class="form-control" id="constancia_docente" accept="application/pdf"><br>
            <div id="link_constancia"></div>
          </div>

          <div class="col-md-3">
            <label>Capacitaciones (PDF)</label>
            <input type="file" class="form-control" id="capacitaciones_docente" accept="application/pdf"><br>
            <div id="link_capacitaciones"></div>
          </div>
        </div>

       </div>
      </div>
      <div class="modal-footer">
          <img class="loader" src="../login/vendor/abc.gif" style="width: 50px;height:50px;display: none;">
          <button class="btn btn-primary btn-sm"  id="button_resgist" onclick="Registro_Docentes();"><i class="fa fa-check"><b>&nbsp;Guardar</b></i></button>

          <button type="button" class="btn btn-default btn-sm" onclick="canselar_Registro()"><i class="fa fa-close"><b>&nbsp;Cancelar</b></i></button>
        </div>
    </div>
   
  </div>
</div>





<script>
$(document).ready(function() {
    $("#refres_add").hide();
    listar_docentesRegistrados();
    $('.js-example-basic-single').select2();
});
</script>