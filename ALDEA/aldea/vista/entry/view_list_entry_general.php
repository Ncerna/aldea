<script type="text/javascript" src="../js/entry.js?rev=<?php echo time();?>"></script>


<div class="col-md-12" >
<div class="box box-warning ">
        <div class="box-body">
             <h4 class="box-title" ><strong>Bienvenido al panel de Ingresos</strong></h4>
        </div>
    </div>
</div>

<div class="col-md-12" >
<div class="box box-warning ">
     <style type="text/css">
      #tableentry{
        border: 1px solid #d4f4f7;
        border-radius: 10px;
        background-color: #f5f7f7;
      }
  
    </style>
        <div class="box-body">
         <div class="row">

            <div class="col-md-1 pull-left"> 
                <button onclick="openModalEntry();" class="btn btn-primary btn-sm" >
                        <em class="glyphicon glyphicon-plus" ></em> Nuevo
                </button>
                </div>

                <div class="col-md-3 clasbtn_exportar">
                 <div class="input-group" id="btn-place"></div>
                </div>
                 <div class="col-md-3">
                   <input type="date" class="form-control" id="date_ini" ><br>  
                </div>
                 <div class="col-md-3">
                    <div class="alin_global">
                     <input type="date" class="form-control" id="date_final" >&nbsp;
                     <button onclick="List_entry();" class="btn" type="submit"  id="but_alin_global" class="btn btn-flat">
                    <i class="fa fa-search" ></i>
                    </button>
                    </div>
                <br>
                    
                </div>
                 <div class="col-md-2 pull-right">
                 <input type="text" class="global_filter form-control " id="global_filter" placeholder="Ingresar dato a buscar" style=" width: 100%">
                </div>
        </div><br>
        <!-- Tabla para entry -->
      <table id="table_entry" class="display responsive nowrap table table-sm" style="width:100%">
      <thead>
        <tr>
            <th>Id</th>
            <th>N°</th>
            <th>Descripción</th>
            <th>Categoria</th>
            <th>Forma de Pago</th>
            <th>Cantidad($)</th>
            <th>Fecha de Operación</th>
              <th></th>
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

<!-- Modal para entry -->
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_entry" role="dialog">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="tituloModal"></h4>
           
            </div>
            <div class="modal-body">
                <div class="col-md-6">
                    <label for=""><strong>Descripción</strong></label>
                    <input class="" id="identry" type="text" hidden>
                    <input class="form-control" id="description" type="text">
                </div>
                <div class="col-md-6">
                    <label for=""><strong>Forma de Pago</strong></label>
                    <input class="form-control" id="payment" type="text">
                </div>
                <div class="col-md-6">
                    <label for=""><strong>Cantidad Guaranies</strong></label>
                    <input class="form-control" id="amount" type="number">
                </div>
               
                <div class="col-md-6">
                   <label for="">Categoría</label>
                    <select class="js-example-basic-single" name="state" id="cmb_category" style="width:100%;" >
                    </select><br><br>
                </div>
                 <div class="col-md-6">
                    <label for=""><strong>Fecha de Operación</strong></label>
                    <input class="form-control" id="dateoperation" type="text" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
                 <div class="col-md-6">
                    <label for=""> </label>
                   <br><br>
                </div>
                 <div class="col-md-12">
                    <label for=""> </label>
                   <br><br>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="Register_entry()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>




<script>
$(document).ready(function() {
   $("#refres_add").hide();
   List_entry();
    $('.js-example-basic-single').select2();
} );
</script>