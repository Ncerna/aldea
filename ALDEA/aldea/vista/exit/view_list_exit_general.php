<script type="text/javascript" src="../js/exits.js?rev=<?php echo time();?>"></script>

<div class="col-md-12" >
<div class="box box-warning ">
        <div class="box-body">
             <h4 class="box-title" ><strong>Bienvenido al panel de Egresos</strong></h4>
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
      .aler_petty{
       color: #f50808;
      }
  
    </style>
        <div class="box-body">
         <div class="row">
            <div class="col-md-1 pull-left"> 
                <button onclick="openModalExit();" class="btn btn-primary btn-sm" >
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
                     <button onclick="List_exit();" class="btn" type="submit"  id="but_alin_global" class="btn btn-flat">
                    <i class="fa fa-search" ></i>
                    </button>
                    </div>
                <br>
                    
                </div>
                 <div class="col-md-2 pull-right">
                 <input type="text" class="global_filter form-control " id="global_filter" placeholder="Ingresar dato a buscar" style=" width: 100%">
                </div>
        </div><br>
        <!-- Tabla para exit -->
    <table id="table_exit" class="display responsive nowrap table table-sm" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>N°</th>
            <th>Descripción</th>
             <th>Categoria</th>
              <th>Gast. Fijos</th>
            <th>Tipo Pago</th>
            <th>Monto($)</th>
            <th>Fecha</th>
            <th>Beneficiario</th>
            <th>Acción</th>
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

<!-- Modal para exit -->
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_exit" role="dialog">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="tituloModal"></h4>
            </div>
            <div class="modal-body">
                <input class="" id="idexit" type="text" hidden>
               <div class="col-md-4">
                <label for="">Seleccione caja(*)</label>
                 <input class="form-control" id="cmb_pettycash" type="text" readonly>  
                 <label id="tu_id_del_label"></label>  
                </div>
                <div class="col-md-4">
                <label for="">Saldo Disponible</label>
                <input class="form-control" id="available_balance" type="text" readonly>   
                </div>
                <div class="col-md-4">
                <label for="">Saldo Minimo</label>
                <input class="form-control" id="balance_minimo" type="text" readonly>   
                </div>

                 <div class="col-md-12">
                    <label for=""><strong>Descripción</strong></label>
                    <textarea class="form-control"  id="description" placeholder="Enter ..." style="border-radius: 5px"></textarea>
                </div>
                 <div class="col-md-6">
                    <label for=""><strong>Tipo de Pago</strong></label>
                    <input class="form-control" id="payment" type="text" placeholder="Efectivo">
                </div>
                 <div class="col-md-6">
                    <label for=""><strong>Monto(GUARANIES)</strong></label>
                    <input class="form-control" id="amount" type="number" placeholder="GUA/." oninput="handleChange(this)">
                     <p id="mount_label"></p> 
                </div>
                 <div class="col-md-6">
                    <label for=""><strong>Fecha de Operación</strong></label>
                    <input class="form-control" id="dateoperation" type="text"  value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label for=""><strong>Beneficiario</strong></label>
                    <input class="form-control" id="beneficiary" type="text" placeholder="Beneficiario">
                </div>


                <div class="col-md-6">
                <label for="">Seleccione Categoria</label>
                <select class="js-example-basic-single" name="state" id="cmb_category" style="width:100%;" onchange="handChangeValue(this)">
                </select><br><br>    
                </div>
                <div class="col-md-6" id="content_fixed_expenses">
                <label for="">Gastos fijos</label>
                <select class="js-example-basic-single" name="state" id="fixed_expenses" style="width:100%;" >
                </select><br><br>    
                </div>
                <div class="col-md-12">
                   
                   <br><br>
                </div>

                  <div class="col-md-12 modal-footer  pull-right">
                    <button class="btn btn-primary" onclick="Register_exit()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
                   
                </div>
                 
            </div>
            <div class="modal-footer">
               
            </div>
        </div>
        </div>
    </div>
</form>




<script>
$(document).ready(function() {
   $("#refres_add").hide();
   List_exit();
    $('.js-example-basic-single').select2();
} );

function handChangeValue(e) {
    fixedCostsSelect(e.value);
  }

function handleChange(e) {
    const value = e.value;
    let available_balance = parseFloat($("#available_balance").val());
    document.getElementById('mount_label').innerHTML = (value > available_balance) ? '<span class="aler_petty">Saldo insuficiente</span>' : '';
}

</script>