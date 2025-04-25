
<script type="text/javascript" src="../js/alumnos.js?rev=<?php echo time();?>"></script>
<div class="col-md-12" id="DivTableAlumno">
<div class="box box-warning ">
  <div class="box-header with-border">
    <h3 class="box-title">ALUMNOS REGISTRADOS</h3>

    <!-- /.box-tools -->
  </div>
  <style type="text/css">
    #tabla_matricula{
      border: 1px solid #d4f4f7;
      border-radius: 10px;
      background-color: #f5f7f7;
    }
  </style>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-xs-4 clasbtn_exportar">
        <div class="input-group" id="btn-place"></div>
      </div>
      <div class="col-xs-6 ">
       <div class="input-group">
        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar">
        <span class="input-group-addon"><em class="fa fa-search"></em></span>
      </div>
    </div>
    <div class="col-xs-2 pull-right" >
      <button class="btn btn-primary" style="width:100%" onclick="AbrirModalMatricula()"><em class="glyphicon glyphicon-plus"></em></button>
    </div>

  </div><br>

  <table id="tabla_matricula" class="display responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <th>Nº</th>
        <th>Apellidos</th>
        <th>Nombres</th>
        <th>Dni/CI</th>
        <th>Teléfono</th>
        <th>c&oacute;digo</th>
        <th>Sexo</th>
        <th>Estado</th>
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
</div>
<!-- /.box -->
</div>


<div class="col-md-12" id="DivMatricula" style="display: none;">
<div class="box box-warning ">
  <div class = "box-header with-border titulosclass" id="Titulo_Center"  >
   <h3 class="box-title">BIENVENIDO AL CONTENIDO DE MATRICULAS</h3>
 </div>
 <div class="box-body">
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class=""><a style="color:black" href="#" data-toggle="tab" aria-expanded="false"></a></li>
      <li class="active"><a style="color:black" href="#Alumnos" data-toggle="tab" aria-expanded="false">ALUMNOS</a></li>
      <li class=""><a style="color:black" href="#Apoderados" data-toggle="tab" aria-expanded="false">APODERADOS</a></li>
      <li class=""><a style="color:black" href="#Procedente" data-toggle="tab" aria-expanded="true">PROCEDENTE</a></li>
      <li class=""><a style="color:black" href="#padres_autorizados" data-toggle="tab" aria-expanded="true">AUTORIZADOS</a>
      </li>

      
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="Alumnos">
        <div class="row">
          <div class="col-xs-4">
            <label for="">Apellidos Paterno</label>
            <input type="text" id="id_alumnoEdit" hidden>
               <input type="text" class="form-control" id="txt_apellidos" placeholder="Ingrese Apellidos" value=""onkeypress = "return (event.charCode > 64 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||
             (event. charCode > 31 && event.charCode < 33)"><br>
          </div>
          <div class="col-xs-4">
            <label for="">Nombres</label>
            <input type="text" class="form-control" id="txt_alunombre" placeholder="Ingrese Nombres" value=""onkeypress = "return (event.charCode > 64 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||
             (event. charCode > 31 && event.charCode < 33)"><br>
          </div>
          <div class="col-xs-4">
            <label for="">Fecha de Nacimiento</label>
             <input type="date" class="form-control" id="txt_fech" onchange="onchangeDate(this)" ><br>
          </div>

        </div>
        <div class="row">
          <div class="col-xs-4">
            <label for="">N° Ci</label>
            <input type="number" class="form-control" id="txt_dni" placeholder="Ingrese Dni" ><br>
          </div>

             <div class="col-xs-4">
            <label for="">Tel&eacute;fono</label>
            <input type="number" class="form-control" id="txt_tel" placeholder="Ingres Teléfono" ><br>
          </div>

            <div class="col-xs-4">
            <label for="">Direcci&oacute;n</label>
            <input type="text" class="form-control" id="direccion" placeholder="Ingrese Drección" ><br>
          </div>
        </div>
          <div class="row">
          <div class="col-xs-4">
           <label for="">C&oacute;digo</label>
           <input type="number" class="form-control" id="txt_codig" placeholder="Ingrese Código" ><br>
         </div>
          <div class="col-xs-4">
            <label for="">Sexo</label>
            <select class="js-example-basic-single" name="state" id="cbm_sexo"  style="width:100%;">
          <option value="M">MASCULINO</option>
          <option value="F">FEMENINO</option>
        </select><br><br>
      </div>
         <div class="col-xs-4">
          <label>Fecha Registro</label>
          <div class=" input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" id="txtfecharegistro_alum" name="txtfecharegistro_alum" 
            readonly style="color: rgb(25,25,51); background-color: rgb(255,255,255); text-align:center;font-weight: bold;"}
             class="form-control"><br>
          </div><br>
        </div>
      </div>
      <div class="row">
      <div class="col-xs-4">
        <label for="txt_mail">Correo</label>
        <input type="text" class="form-control" id="txt_mail" placeholder="Ingrese correo" ><br>
      </div>
      <div class="col-xs-4">
        <label for="txt_country">Nacionalidad</label>
        <input type="text" class="form-control" id="txt_country" placeholder="Ingrese país" ><br>
      </div>
      <div class="col-xs-4">
        <label for="txt_age">Edad</label>
        <input type="number" class="form-control" id="txt_age" placeholder="Ingrese edad" ><br>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-4">
        <label for="txt_province">Departamento</label>
        <input type="text" class="form-control" id="txt_province" placeholder="Ingrese provincia" ><br>
      </div>
      <div class="col-xs-4">
        <label for="txt_municipality">Municipio</label>
        <input type="text" class="form-control" id="txt_municipality" placeholder="Ingrese municipio" ><br>
      </div>
      <div class="col-xs-4">
        <label for="txt_others">Lugar de nacimiento</label>
        <input type="text" class="form-control" id="txt_others" placeholder="Ingrese otros" ><br>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-4">
        <label for="planeStudy">Tipo de Sangre </label>
        <input type="text" class="form-control" id="planeStudy" placeholder="Ingrese Plan de estudio" ><br>
      </div>
      <div class="col-xs-4">
        <label for="especiality">Año de ingreso a la Institucion</label>
        <input type="text" class="form-control" id="especiality" placeholder="Ingrese Especialidad" ><br>
      </div>
      <div class="col-xs-4">
       
      </div>
    </div>


      <div class="row">
     
              <table id="provenanceTable" class="table table-striped">
                  <thead>
                      <tr>
                          <th >N°</th>
                          <th >Denominación y Epónimo de la Institución Educativa</th>
                          <th>Localidad</th>
                          <th>E.F</th>
                          <th>Año</th>
                      </tr>
                  </thead>
                  <tbody>
                      <!-- Las filas se crearán dinámicamente -->
                  </tbody>
              </table>
      </div>


  </div>

  <div class="tab-pane" id="Apoderados">

    <label for="">Datos de (Papá)</label>
    <hr>
    <div class="row">
      <div class="col-xs-4">
        <label for="">Nombres del padre</label>
        <input type="text" class="form-control" id="txt_nomb_padre" placeholder="Ingrese nombre"onkeypress = "return (event.charCode > 64 &&   event.charCode < 91) ||
          (event. charCode > 96 && event.charCode < 123)||
          (event. charCode > 31 && event.charCode < 33)" ><br>
      </div>
      <div class="col-xs-4">

        <label for="">Apellidos del Pradre</label>
        <input type="text" class="form-control" id="txt_apelli_padre" placeholder="Ingrese apellidos" onkeypress = "return (event.charCode > 64 &&   event.charCode < 91) ||
          (event. charCode > 96 && event.charCode < 123)||
          (event. charCode > 31 && event.charCode < 33)"><br>
      </div>
      <div class="col-xs-4">
        <label for="">N°  Ci del Padre</label>
        <input type="number" class="form-control" id="txt_dni_padre" placeholder="Ingrese CI" ><br>
      </div>
      <div class="col-xs-4">
        <label for="">N° De Telefono</label>
        <input type="number" class="form-control" id="txt_telefono_padre" placeholder="Ingrese no de telefono" ><br>
      </div>
     <div class="col-xs-4">
        <label for="txt_direccion_padre">Dirección/Profesion</label>
        <input type="text" class="form-control" id="txt_direccion_padre" placeholder="Ingrese dirección"><br>
    </div>
     <div class="col-xs-4">
        <label for="">CORREO ELECTRONICO</label>
        <input type="text" class="form-control" id="txt_email_padre" placeholder="Ingrese su Email"><br>
    </div>


    </div>
    <label for="">Datos de  (Mamá)</label>
    <hr>
    <div class="row">
      <div class="col-xs-4">

        <label for="">Nombres de la Madre</label>
        <input type="text" class="form-control" id="txt_nombre_madre" placeholder="Ingrese Nombre" onkeypress = "return (event.charCode > 64 &&   event.charCode < 91) ||
           (event. charCode > 96 && event.charCode < 123)||
           (event. charCode > 31 && event.charCode < 33)"><br>
      </div>

      <div class="col-xs-4">

        <label for="">Apellidos de la Madre</label>
        <input type="text" class="form-control" id="txt_tapel_madre" placeholder="Ingrese Apellidos" onkeypress = "return (event.charCode > 64 &&   event.charCode < 91) ||
           (event. charCode > 96 && event.charCode < 123)||
           (event. charCode > 31 && event.charCode < 33)"><br>
      </div>

      <div class="col-xs-4">
       <label for="">N° Ci de la Madre</label>
       <input type="number" class="form-control" id="txt_dni_madre" placeholder="Ingrese Dni"><br>
     </div> 
   </div>
 </div>

 <div class="tab-pane" id="Procedente">
   <label for="">Datos de la institución procedente</label>
   <hr>
   <div class="row">
    <div class="col-xs-4">
     <label for="">Nombre del Colegio </label>
     <input type="text" class="form-control" id="tex_coleg_nombre" placeholder="COLEGIO" onkeypress = "return (event.charCode > 64 &&   event.charCode < 91) ||
           (event. charCode > 96 && event.charCode < 123)||
           (event. charCode > 31 && event.charCode < 33)"><br>
   </div> 

   <div class="col-xs-4">
     <label for="">Ubicaci&oacute;n geogr&aacute;fica</label>
     <input type="text" class="form-control" id="tex_coleg_direcion" placeholder="UBICACIÓN" value=""><br>
   </div> 

   <div class="col-xs-4">
     <label for="">c&oacute;digo colegio recidente</label>
     <input type="number" class="form-control" id="tex_codig_cole" placeholder="CÓDIGO" ><br>
   </div> 
 </div>
</div>
<!-- Contenido de la pestaña -->
<div class="tab-pane" id="padres_autorizados">
  <label><strong>PERSONAS AUTORIZADAS</strong></label>
  <hr>
  <div class="row">
    <!-- Persona Autorizada 1 -->
      <div class="col-md-12 mt-4">
      <h6><strong>Persona Autorizada 1</strong></h6>
    </div>
    <div class="col-md-4">
      <label for="autorizado1_nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="autorizado1_nombre" placeholder="Ingrese su nombre">
    </div>
    <div class="col-md-4">
      <label for="autorizado1_apellido" class="form-label">Apellido</label>
      <input type="text" class="form-control" id="autorizado1_apellido" placeholder="Ingrese su apellido">
    </div>
    <div class="col-md-4">
      <label for="autorizado1_parentesco" class="form-label">Parentesco</label>
      <input type="text" class="form-control" id="autorizado1_parentesco" placeholder="Ingrese su parentesco">
    </div>

    <!-- Persona Autorizada 2 -->
    <div class="col-md-12 mt-4">
      <h6><strong>Persona Autorizada 2</strong></h6>
    </div>
    <div class="col-md-4">
      <label for="autorizado2_nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="autorizado2_nombre" placeholder="Ingrese su nombre">
    </div>
    <div class="col-md-4">
      <label for="autorizado2_apellido" class="form-label">Apellido</label>
      <input type="text" class="form-control" id="autorizado2_apellido" placeholder="Ingrese su apellido">
    </div>
    <div class="col-md-4">
      <label for="autorizado2_parentesco" class="form-label">Parentesco</label>
      <input type="text" class="form-control" id="autorizado2_parentesco" placeholder="Ingrese su parentesco">
    </div>
  </div> <!-- cierre de .row -->
</div>
<div class="tab-pane" id="institucion">
   
</div>

</div>

</div>

<div class="modal-footer">
  
   <img class="loader" src="../login/vendor/abc.gif" style="width: 50px;height:50px; display: none">
<button id="button_resgist"  class="btn btn-primary" onclick="registrar_Alunos();" style='font-size:13px; ' ><em class="fa fa-check"><b>&nbsp;Guardar</b></em></button> <button id="cancel_button" onclick="LimpiarModalMatricula()" type="button" class="btn btn-danger" ><em class="fa fa-close"><b>&nbsp;Cancelar</b></em></button>
</div>
</div>
</div>
</div>


<script>

$(document).ready(function() {
  $("#refres_add").hide();
	listar_alumnos();

  var f = new Date();
  txtfecharegistro_alum.value= f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate()+ " " 
  + f.getHours()  + ":" + f.getMinutes()  + ":" + f.getSeconds();

  $('.js-example-basic-single').select2();
    //listar_alumnos();

  } );

function onchangeDate(input) {
    var fechaNacimiento = new Date($(input).val());
    if (isNaN(fechaNacimiento.getTime())) return; 
    var hoy = new Date();
    var edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    var mes = hoy.getMonth() - fechaNacimiento.getMonth();
    if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
        edad--;
    }
    $('#txt_age').val(edad > 0 ? edad : 0); 
}
</script>