<script type="text/javascript" src="../js/usuario.js?rev=<?php echo time();?>"></script>

 <div class='col-lg-12' style='border-color: #f5c6cb;' id="tutotiales_Id">
      <div id='user_avisomanual' class='alert  sm' role='alert' style='color: #0e0102; background-color: #acefe4;'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       Para crear un nuevo usuario pues dirigiste a las siguiente vista  solo da clik en. Gracias!!. &nbsp;<span class='label label-info'><em class="fa fa-plus"></em></span>&nbsp; Para activar o desactivar usuarios da clik en <span class='label label-defult'><em class="fa fa-eye"></em></span>
          
     </div>
   </div>

    <div class='col-lg-12' style='border-color: #f5c6cb; display: none' id='cret_avisomanual'>
      <div  class='alert  sm' role='alert' style='color: #0e0102; background-color: #acefe4;'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Para crear usuarios /perfiles seleccione el tipo de usuario que deseas crear luego presione en : <em class="fa fa-search" ></em>  para extraer su datos requerido pero..&nbsp; si deseas crear otro tipo de puedes ingresar los datos..&nbsp;Puedes genera la contraseña manual/automática  presione en:<em class="fa fa-lock"></em> Para registra usuario seleccione en <em class="fa fa-check"></em>..Para cancelar la operacion precione en <em class="fa fa-times"></em> Gracias por su atencion..!
          
     </div>
   </div>

<div class="col-md-12" id="DivTableAlumno" style="display: none;">
<div class="box box-warning ">
  <form autocomplete="false" id="from" onsubmit="return false"   action="#" enctype="multipart/form-data" onsubmit="return false">
    <div class="box-header with-border">
        <h3 class="box-title">Resgistro de nuevo usuario</h3>
        <div class="box-tools pull-right">

         <button type="button" class="btn btn-box-tool" data-widget="remove"  title="" data-original-title="Remove" onclick="Limpiar_Registrar_Usuario()">
         <em  class="fa fa-times"></em></button>&nbsp;
         <button type="button" class="btn btn-box-tool" data-widget="collapse" id="button_resgist" data-original-title="Collapse"  onclick="Registrar_Usuario()">
         <em class="fa fa-check"></em></button>

       

      </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
            <div class="col-md-4">
                <label for="">Docente</label>
                <div class="alin_global">
                <select class="js-example-basic-single" name="state" id="cbm_docente" style="width:100%;">
                   
                </select>&nbsp;&nbsp;<button onclick="Estraer_Datos_Docentes();" class="btn-sm"  id="but_alin_global" >
                        <em class="fa fa-search" ></em>
                    </button>
                </div>
            </div>
            <div class="col-md-4">
                <label for="">Alumnos</label>
                <div class="alin_global">
                <select class="js-example-basic-single" name="state" id="cbm_alumno" style="width:100%;">
                   
                </select>&nbsp;&nbsp;<button onclick="Estraer_Datos_Alumno();" class="btn-sm" id="but_alin_global" >
                        <em class="fa fa-search" ></em>
                    </button>
                </div>
              
            </div>
            <div class="col-md-3">
                <label for="">Otros Users</label>
                <div class="alin_global">
                <select class="js-example-basic-single" name="state" id="cbm_otros" style="width:100%;">
                    <option value="">NO SE ENCONTRARON REGISTROS</option>
                </select>&nbsp;&nbsp;<button onclick="Estraer_Datos_Otros();" class="btn-sm" id="but_alin_global" disabled>
                        <em class="fa fa-search" ></em>
                    </button>
                </div>
            
            </div>
            
        </div>
        <div class="col-xs-12">
            <div class="col-md-4">
             <label for="">Nombre</label>
             <input type="text" id="txt_dniUSU_golval" hidden="true"><br>
             <input type="text" class="form-control" id="txt_nombre" placeholder="Ingrese nombre" onkeypress = "return (event.charCode > 64 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||
             (event. charCode > 31 && event.charCode < 33)"><br>
            </div>

            
            <div class="col-md-4">
            <label for="">Apellidos</label>
                <input type="text" class="form-control" id="txt_apellido" placeholder="Ingrese nombre" onkeypress = "return (event.charCode > 64 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||
             (event. charCode > 31 && event.charCode < 33)"><br>
            </div>
            
            <div class="col-md-4">
             <label for="">Usuario (Login)</label>
                <input type="text" class="form-control" id="txt_usuario" placeholder="ejemplo:admin@.com/usuaroDEV125" onkeypress = "return (event.charCode > 63 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||(event. charCode >47 && event.charCode<58)||(event. charCode>44 && event. charCode<47)||(event. charCode==95)"><br>
            </div>
            </div>
       
          <div class="col-xs-12">
            <div class="col-md-4">
             <label for="">Contraseña generado</label>
              <div class="alin_global ">
                      <div class="input-group" style="width: 100%">
                      <input type="password" class="form-control" id="contra" onkeypress = "return (event.charCode > 63 &&   event.charCode < 91) ||
                       (event. charCode > 96 && event.charCode < 123)||(event. charCode >34 && event.charCode<39)||(event. charCode>47 && event. charCode<58)||(event. charCode==42)" >
                      <span class="input-group-btn">&nbsp;&nbsp;
                      <button onclick="mostrarPassword()" type="button" class="btn btn-secondary" ><em id="iconoeyes" class="fa fa-eye-slash"></em></button></span>
                       </div>
                        &nbsp;&nbsp;
                         <button onclick="General_Contrasena_Alum();" type="button" class="btn btn-secondary"><em class="fa fa-lock"></em></button>
                       </div>
                
            </div>
            <div class="col-md-4">
                <label for="">Rol</label>
                <select class="js-example-basic-single" name="state" id="cbm_rol" style="width:100%;">

                </select><br><br>
            </div>
            <div class="col-md-4">
              <label for="">Imagen (Foto Perfil)</label>
              <div class="widget-user-image">
                <img  class="img-circle"  alt="User Image" id="perfil_mostrarimagen" width="50px" height="50px" style="display: none">
              </div>
              <ul class="nav nav-stacked">
                <input type="file" class="form-control" id="perfil_seleccionararchivo" accept="image/x-png,image/gif,image/jpeg"  style="border-radius: 5px;"><br>
              </ul>
              <br>
            </div>

        </div>
         </div>
          
        </div>
      </form>
    </div>
</div>
<!-- /.box -->


<div class="col-md-12" id="div_tabla_usuario">
<div class="box box-warning ">
     <style type="text/css">
      #tabla_usuario{
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
                 <input type="text" class="global_filter form-control " id="global_filter" placeholder="Ingresar dato a buscar" style=" width: 100%">&nbsp;&nbsp;<button onclick="AbrirModalRegistro();" class="btn-sm" id="but_alin_global" >
                        <em class="glyphicon glyphicon-plus" ></em>
                    </button>
                </div>
            </div>
        </div><br>
        <table id="tabla_usuario" class="display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Usuario</th>
                    <th>Usuarios</th>
                    <th>Rol</th>
                    <th>acces</th>
                    <th>Estado</th>
                    <th>Act./Des.</th>
                    <th>Quitar</th>
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




<script>
$(document).ready(function() {
   $("#refres_add").hide();
    listar_usuario();
    $('.js-example-basic-single').select2();
} );

function mostrarPassword(){
    var cambio = document.getElementById("contra");
    if(cambio.type == "password"){
      cambio.type = "text";
      $('#iconoeyes').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    }else{
      cambio.type = "password";
      $('#iconoeyes').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
  }

    document.getElementById("perfil_seleccionararchivo").addEventListener("change", () => {
            $("#perfil_mostrarimagen").show();
            var archivoseleccionado = document.querySelector("#perfil_seleccionararchivo");
            var archivos = archivoseleccionado.files;
            var imagenPrevisualizacion = document.querySelector("#perfil_mostrarimagen");
            // Si no hay archivos salimos de la función y quitamos la imagen
            if (!archivos || !archivos.length) {
            imagenPrevisualizacion.src = "";
            return;
            }
            // Ahora tomamos el primer archivo, el cual vamos a previsualizar
            var primerArchivo = archivos[0];
            // Lo convertimos a un objeto de tipo objectURL
            var objectURL = URL.createObjectURL(primerArchivo);
            // Y a la fuente de la imagen le ponemos el objectURL
            imagenPrevisualizacion.src = objectURL;
        });
</script>
