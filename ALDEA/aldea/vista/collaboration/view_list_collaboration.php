<script type="text/javascript" src="../js/collaboration.js?rev=<?php echo time();?>"></script>


<div class="col-md-12" >
<div class="box box-warning ">
        <div class="box-body">
             <h4 class="box-title" ><strong>Bienvenido al panel de colaboraciones</strong></h4>
        </div>
    </div>
</div>
<!--
<div class="col-md-12">
    <div class="row">
        <div class="col-md-4">
           <button onclick="openModalCollaboration();" class="btn btn-primary btn-sm" ><em class="glyphicon glyphicon-plus" ></em> Nuevo </button>
        </div>

        <div class="col-md-4">
		    <div class="row">
		        <div class="col-xs-4">
		            <input type="date" class="form-control" id="date_ini">
		        </div>
		        <div class="col-xs-4">
		            <input type="date" class="form-control" id="date_final">
		        </div>
		        <div class="col-xs-4">
		            <button onclick="List_entry();" class="btn btn-primary" type="submit" id="but_alin_global">
		                <i class="fa fa-search"></i>
		            </button>
		        </div>
		    </div>
		</div>
        <div class="col-md-4">
           <input type="text" class="global_filter form-control " id="global_filter" placeholder="Ingresar dato a buscar" style=" width: 100%"> 
        </div>
    </div>
</div>
--->

<div class="col-md-12" >
<div class="box box-warning ">
        <div class="box-body">
         <div class="row">

            <div class="col-md-1 pull-left" style=""> 
                <button onclick="openModalCollaboration();" class="btn btn-primary btn-sm" >
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
                     <button onclick="List_collaborations();" class="btn" type="submit"  id="but_alin_global" class="btn btn-flat">
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
      <table id="tlb_coll" class="display responsive nowrap table table-sm" style="width:100%">
      <thead>
        <tr>
            <th>Id</th>
            <th>N°</th>
          
            <th>Persona</th>
            <th>N° Ci</th>
            <th>Tipo pago</th>
            <th>Monto</th>
              <th>Fecha</th>
               <th>Accion</th>
                
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
    <div class="modal fade" id="modal_collaboration" role="dialog">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="tituloModal"></h4>
           
            </div>
            <div class="modal-body">
            	 <div class="col-md-6">
                    <label for=""><strong>Nombres</strong></label>
                   
                    <input class="form-control" id="name_people" type="text">
                </div>
                <div class="col-md-6">
                    <label for=""><strong>Apellidos</strong></label>
                    <input class="form-control" id="last_name_people" type="text">
                </div>
                 <div class="col-md-6">
                    <label for=""><strong>N° CI</strong></label>
                    <input class="form-control" id="numbre_ci_people" type="text">
                </div>
               
                <div class="col-md-6">
                    <label for=""><strong>Forma de Pago</strong></label>
                    <input class="form-control" id="payment" type="text">
                </div>
                <div class="col-md-6">
                    <label for=""><strong>Cantidad</strong></label>
                    <input class="form-control" id="amount" type="number">
                </div>
               
               
                 <div class="col-md-6">
                    <label for=""><strong>Descripción</strong></label>
                 
                    <input class="form-control" id="description" type="text">
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
                <button class="btn btn-primary" onclick="RegisterCollaboration()"><i class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>




<script>
$(document).ready(function() {
   $("#refres_add").hide();
   List_collaborations();
    $('.js-example-basic-single').select2();
} );
</script>