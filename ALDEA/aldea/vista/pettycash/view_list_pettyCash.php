<script type="text/javascript" src="../js/pettycash.js?rev=<?php echo time();?>"></script>
<div class="col-md-12" >
<div class="box box-warning ">
     <style type="text/css">
      #pettyCash{
        border: 1px solid #d4f4f7;
        border-radius: 10px;
        background-color: #f5f7f7;
      }
    </style>
        <div class="box-body">
        <div class="row">
            <div class="col-xs-6 clasbtn_exportar">
                <button onclick="openModalPettyCash() ;" class="btn btn-primary btn-sm">
                        <em class="glyphicon glyphicon-plus" ></em>&nbsp Nuevo
                    </button>
                <h4 class="box-title"style="margin-top: -25px;margin-left: 70px;" ><strong>Bienvenidos al Contenido de caja chica </strong></h4>
            </div>
           
            <div class="col-xs-6 pull-right">
                <div class="alin_global">
                 <input type="text" class="global_filter form-control " id="global_filter" placeholder="Ingresar dato a buscar" style=" width: 100%">
                </div>
            </div>
        </div><br>
        <!-- Tabla para pettycash -->
<table id="table_pettycash" class="display responsive nowrap table table-sm" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>N°</th>
            <th>Nombre</th>
            <th>Monto Máximo</th>
            <th>Monto Mínimo</th>
            <th>[CLOSING || OPEN]</th>
            <th>Estado</th>
            <th>Fech. Create</th>
            <th>Fech. Actualización</th>
            <th>Options</th>
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
            <th></th>
        </tr>
    </tfoot>
</table>
        </div>
        <!-- /.box-body -->
</div>
      <!-- /.box -->
</div>


<!-- Modal para pettycash -->
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_pettycash" role="dialog">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="tituloModal"></h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <label for=""><strong>Nombre de Caja chica</strong></label>
                    <input class="" id="idpetty" type="text" hidden>
                    <input class="form-control" id="pettycashname" type="text">
                </div>
                <div class="col-lg-12">
                    <label for=""><strong>Monto Máximo</strong></label>
                    <input class="form-control" id="amountmax" type="number">
                </div>
                <div class="col-lg-12">
                    <label for=""><strong>Monto Mínimo</strong></label>
                    <input class="form-control" id="amountmin" type="number">
                </div>
                <div class="col-lg-12">
                    <label for=""><strong>[CLOSING || OPEN]</strong></label>
                    <br>
                    <label>
                        <input type="radio" name="iscurrent" value="1"> Sí
                    </label>
                    <label>
                        <input type="radio" name="iscurrent" value="0"> No
                    </label>
                </div>
               
                <div class="col-lg-12">
                    <label for=""><strong>Fecha de Creación</strong></label>
                    <input class="form-control" id="date_create" type="text" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
               
                <div class="col-lg-12">
                    <label for=""> </label>
                    <br><br>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="Register_pettycash()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>



<script>
$(document).ready(function() {
   $("#refres_add").hide();
   List_pettycash();
    $('.js-example-basic-single').select2();
} );
</script>