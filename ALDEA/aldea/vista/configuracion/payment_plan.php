<script type="text/javascript" src="../js/payment_plan.js?rev=<?php echo time();?>"></script>

<div class="col-md-4">
    <div class="box box-warning">
        <div class="box-header with-border">
              <h3 class="box-title" id="html_title"></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
              <!-- /.box-tools -->
        </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="form-group">
                <input type="text"  id="idAula" hidden>
                 <div class="col-lg-12">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" id="type_name" placeholder="Ingrese nombre"><br>
                </div>
                 <div class="col-lg-12">
                    <label for="">Monto</label>
                    <input type="number" class="form-control" id="type_amount" placeholder="Ingrese Monto"><br>
                </div>
                 <div class="col-lg-12">
                    <label for="">Fecha</label>
                    <input type="datetime-local" class="form-control" id="type_date" placeholder="Ingrese fecha" readonly><br>
                </div>
               
                 <div class="col-lg-12">
                    <label for="">Estado</label>
                    <select class="js-example-basic-single" name="state" id="type_stado" style="width:100%;">
                        <option value="">--selecione estado--</option>
                        <option value="1">ACTIVO</option>
                        <option value="0">INACTIVO</option>
                    </select><br><br>
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-sm" onclick="Register_paymentPlan(this)"><i class="fa fa-check"><b>&nbsp;Actualizar</b></i></button>
                <button type="button" class="btn btn-default btn-sm" onclick="clear_paymentPlan()"><i class="fa fa-close"><b>&nbsp;Cancelar</b></i></button>
            </div>
            </div>
            
            </div>
            <!-- /.box-body -->
    </div>
          <!-- /.box -->
</div>

<div class="col-md-8">
    <div class="box box-warning ">
        <div class="box-header titulosclass" id="Titulo_Center">
            <h3 class="box-title">TIPOS DE FRACCIONAMIENTO DE PAGOS</h3>
            <div class="box-tools pull-right">
                <div class="dropdown">
                   <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"><i class="fa fa-gear"></i></a>
                    <ul class="dropdown-menu pull-right">
                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="getTypePaymentsPlan({status: 0})" >Desactivos</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="getTypePaymentsPlan({status: 1})" >Activos</a></li>
                    </ul>
                </div>
                
            </div>
              <!-- /.box-tools -->
        </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="form-group">
                <div class="col-lg-10">
                    <div class="input-group pull-right">
                        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>

            

             <br><br>
            <table id="tlb_paymentesPlan" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th></th>
                         <th>Código</th>
                        <th>Nombre</th>
                        <th>Monto</th>
                        <th>Fecha</th>
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
     getTypePaymentsPlan({});
    
  

} );
</script>