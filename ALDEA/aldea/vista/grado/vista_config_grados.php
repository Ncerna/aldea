
<script type="text/javascript" src="../js/grado_config.js?rev=<?php echo time();?>"></script>

  <div class='col-lg-12' style='border-color: #f5c6cb;' id="tutotiales_Id">
      <div id='avisomanual' class='alert  sm' role='alert' style='color: #0e0102; background-color: #acefe4;'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       Todos los cambios realizados solo tendrán efecto en el año académico <strong>activo </strong>. Si se cambia de año académico de nuevo volverás  a configurar los grados y cursos. Gracias!!
          
     </div>
   </div>

 <style type="text/css">
          #tabla_grados{
            border: 1px solid #d4f4f7;
            border-radius: 10px;
            background-color: #f5f7f7;
          }
          #add_cursos_btn{
                margin-top: 20px;
               width: auto;
          }
        </style>
<div class="col-md-6">
    <div class="box box-warning ">
        <div class="box-header titulosclass" id="Titulo_Center">
              <h3 class="box-title">LISTA DE GRADOS DISPONIBLES</h3>
        </div>
            <div class="box-body">
            <div class="form-group pull-right">
                <div class="col-lg-10 pull-right">
                    <div class="input-group pull-right">
                        <input type="text" class="global_filter form-control pull-right" id="global_filter" placeholder="Ingresar dato a buscar" style="border-radius: 5px;">
                    </div>
                </div>
            </div>
            <br><br>
             <table id="tabla_grados" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Grado</th>
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
                    </tr>
                </tfoot>
            </table>
            </div>
    </div>
</div>
<div class="col-md-6" id='modal_agregar_curso' style="display: none;">
    <div class="box box-warning ">
        <div class="box-header titulosclass" id="Titulo_Center">
               <h3 class="box-title">A&ntilde;dir  Cursos - Grado(<label class="box-title" id="nombrgrado"></label>)</h3>
            <div class="box-tools pull-right">
                <button type="button" onclick="Cancelar_registro();" class="btn btn-box-tool" data-widget="collapse"><em class="fa fa-times"></em>
                </button>
            </div>
        </div>
            <div class="box-body">
               <div class="col-lg-12">
                    <input type="text" name="" id="text_idgrado" hidden>
                    <input type="text" name="" id="text_idseccion" hidden>
                       <div class="col-lg-12" style='border-color: #f5c6cb;'>
                          <div id="avisomanual" class="alert  sm" role="alert" style="color: #0e0102; background-color: #acefe4;"><button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                               Estás visualizando cursos que aún no están asignados a un grado. ¡Selecciona un curso! A continuación, presiona en:
                                &nbsp;&nbsp;<span class='label label-warning'><i class="glyphicon glyphicon-plus "></i></span>    
                          </div>
                          <div id="error_avisomanual" class="alert  sm" role="alert" style="color: #721c24; background-color: #f8d7da; display: none">
                             Ya esta seccionado El curso!!
                                 
                        </div>

                       </div>
                     <div class="row">
                        <div class="col-xs-10">
                          <label for="">Cursos</label>
                          <div class="alin_global">
                          <select class="js-example-basic-single" name="state" id="cbm_curso" style="width:100%;">
                            </select><br><br>
                          </div>
                        </div>
                        <div class="col-xs-2">
                         <button class="btn  btn-warning btn-sm" id="add_cursos_btn" onclick="Add_tr_table()"><em class="glyphicon glyphicon-plus "></em></button>
                        
                          <br>
                        </div>
                      </div>
                     
                     <table   style="width:100%" class="table table-condensed table-sm">
                        <thead class=" thead-drak" style="color: #721c24; background-color: #9fa5a4;">
                          <th>Orden</th>
                           <th>Nombre</th>
                           <th>Quitar</th>
                            </thead>
                           <tbody id="tbody_tabla_lista_curso">   
                          </tbody>
                         </table>

                 
            </div>
           </div>
           
           <div class="modal-footer">
                <button class="btn btn-primary btn-sm " onclick="Registrar_Cursogrado()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
              
            </div>
    </div>
</div>






<div class="col-md-6" id="table_cursos_asignado" >
    <div class="box box-warning ">
        <div class="box-header titulosclass" id="Titulo_Center">
              <h3 class="box-title">CURSOS ASIGNADOS</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
            <div class="box-body">
             <div class="col-lg-12">
              <input type="text" name="" id="text_ver_idgrado" hidden>
             <div class="col-lg-12" style='border-color: #f5c6cb;'>
               <div id="table_avisomanua" class="alert  sm" role="alert" style="color: #0e0102; background-color: #acefe4;"><button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  !Para ver cursos asignados a cada grado seleccione en:
                  &nbsp;&nbsp;<span class='label label-defautl'><em class="glyphicon glyphicon-eye-open"></em></span>    
               </div>
            </div>
           
                     <table   style="width:100%" class="table table-ms table-responsive">
                        <thead class=" thead-drak" style="color: #721c24; background-color: #9fa5a4;">
                          <th>Orden</th>
                           <th>Nombre</th>
                           <th>Quitar</th>
                            </thead>
                           <tbody id="tbody_tabla_addcursos">   
                          </tbody>
                         </table>

            </div>
           </div>
    </div>
</div>




<script>
$(document).ready(function() {
  $("#refres_add").hide();
    $('.js-example-basic-single').select2();

listar_config_gradosAll();
     Combo_cursos();  

   // listar_grados() ;
    $("#modal_registro_docente").on('shown.bs.modal',function(){
        $("#txt_usu").focus();  
    })

} );
</script>

