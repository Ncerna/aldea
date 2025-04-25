<script type="text/javascript" src="../js/curso.js?rev=<?php echo time();?>"></script>


<div class="col-md-4">
    <div class="box box-warning ">
        <div class="box-header titulosclass" id="Titulo_Center">
              <h3 class="box-title">REGISTRAR NUEVO CURSO</h3>
              <!-- /.box-tools -->
                <style type="text/css">
          #tabla_curso{
            border: 1px solid #d4f4f7;
            border-radius: 10px;
            background-color: #f5f7f7;
          }
        </style>
        </div>
            <!-- /.box-header -->
            <div class="box-body">
                

                <div class="col-lg-12">
                    <input type="text" name="" id="txt_id_curso" hidden>
                    <label for="">C&oacute;digo</label>
                    <input type="text" class="form-control" id="codigocur" placeholder="Ingrese codigo"><br>
                </div>
                <div class="col-lg-12">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" id="txt_nom_cur" placeholder="Ingrese nombre"><br>
                </div>
               
                <div class="col-lg-12">
                    <label for="">Semestral ♦ Electivo</label>

                     <select class="js-example-basic-single" name="state" id="cbm_sem" style="width:100%;">
                      
                          <option value="">---seleccione---</option>
                          <option value="SEMESTRAL">SEMESTRAL</option>
                          <option value="TRIMESTRAL">TRIMESTRAL</option>
                          <option value="BIMESTRAL">BIMESTRAL</option>
                          <option value="ELECTIVO">ELECTIVO</option>
                          <option value="ESTANDAR">ESTANDAR</option>
                          <option value="MENSUAL">MENSUAL</option>
                          <option value="ANUAL">ANUAL</option>
                          </select> <br><br>
                </div> 
                 <div class="col-lg-12">
                    <label for="">Abreviatura para el curso</label>
                    <input type="text" class="form-control" id="abbreviation" placeholder="Abreviatura del curso (MAT)"><br>
                </div>
                <div class="col-lg-12">
                    <label for="">COMPONENTES</label>
                     <select class="js-example-basic-single" name="state" id="components" style="width:100%;">
                          <option value="">---seleccione---</option>
                          <option value="1">FORMACIÓN GENERAL</option>
                          <option value="2">FORMACIÓN CIENT.TEC Y PROD.</option>
                          <option value="3">PRÁCTICA VOCACIONAL Y PROFESIONAL</option>
                          <option value="4">TECNICATURA</option>
                          </select> <br><br>
                </div> 
            </div>
             <div class="modal-footer">
                <button class="btn btn-primary btn-sm" onclick="Registrar_curso()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
                <button type="button" class="btn btn-default btn-sm" onclick="LimpiarRegistroCurso()"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
            <!-- /.box-body -->
    </div>
          <!-- /.box -->
</div>




<div class="col-md-8">
    <div class="box box-warning ">
        <div class="box-header titulosclass" id="Titulo_Center">
              <h3 class="box-title">BIENVENIDO CONTENIDO DEL CURSO</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
              <!-- /.box-tools -->
        </div>
            <!-- /.box-header -->
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
            <table id="tabla_curso" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Orden</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
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
            <!-- /.box-body -->
    </div>
          <!-- /.box -->
</div>



<script>
$(document).ready(function() {
  $("#refres_add").hide();
  
 
    $('.js-example-basic-single').select2();
   listar_curso();
   
    $("#modal_regist_curso").on('shown.bs.modal',function(){
        $("#txt_nom_cur").focus();  
    });


} );
</script>