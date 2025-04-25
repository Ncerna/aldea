<script type="text/javascript" src="../js/payment.js?rev=<?php echo time();?>"></script>


<div class="col-md-12" >
<div class="box box-warning ">
        <div class="box-body">
             <h4 class="box-title" ><strong>Bienvenido al panel de pagos.</strong></h4>
        </div>
    </div>
</div>




<div class="col-md-12" >
<div class="box box-warning ">
        <div class="box-body">
         <div class="row">

            <div class="col-md-1 box-tools pull-left">
                
			      
			      <div  id="export-btn"></div>
			   
                
                </div>

                <div class="col-md-3 ">
		           <select class="js-example-basic-single" name="state" id="yerar_id" style="width:100%;" >
		           </select><br><br>
                 
                </div>
                 <div class="col-md-3">
                   <input type="date" class="form-control" id="start_date" ><br>  
                </div>
                 <div class="col-md-3">
                    <div class="alin_global">
                     <input type="date" class="form-control" id="end_date" >&nbsp;
                     <button onclick="get_paymentPlan({});" class="btn" type="submit"  id="but_alin_global" class="btn btn-flat">
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
      <table id="table_planStudents" class="display responsive nowrap table table-sm" style="width:100%">
      <thead>
        <tr>
            <th>N°</th>
            <th></th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Grado</th>
            <th>Año A.</th>
             <th>Turno</th>
            <th>F. Generado</th>
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
  <div class="modal fade" id="mld_feetPayment" role="dialog">
    <div class="modal-dialog modal-lg">
	 <div class="modal-content">
	 	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             
				<h4 class="box-title" id="dates_student"></h4>
          </div>
		
		<div class="modal-body">
			    <div class="row">
			        <div class="col-md-3">
			            <select class="js-example-basic-single" name="state" id="status_payment" style="width:100%;">
                        <option value="">--selecione estado--</option>
                        <option value="">Todos</option>
                        <option value="1">Pagados</option>
                        <option value="0">Falta pagar</option>
                        <option value="2">Anulados</option>
                       </select><br><br>
			        </div>
			        <div class="col-md-3">
			            <select class="js-example-basic-single" name="state" id="paymentPlan_id" style="width:100%;">
                        <option value="">--selecione --</option>
                        <option value="">Todos</option>
                        <option value="1">Pención</option>
                        <option value="2">Matrícula</option>
                        
                       </select><br><br>
			        </div>
			        <div class="col-md-3">
			            <div class="alin_global">
			                <input type="date" class="form-control" id="date_final">
			                &nbsp;
			                <button onclick="get_feePaymentByStudent({});" class="btn" type="submit" id="but_alin_global" class="btn btn-flat">
			                    <i class="fa fa-search"></i>
			                </button>
			            </div>
			            <br>
			        </div>
			        <div class="col-md-3">
			            <input type="text" class="global_filter_fee form-control" id="global_filter_fee" placeholder="Ingresar dato a buscar" style="width: 100%">
			        </div>
			    </div>
			    
			
			<table id="tlb_factionarie" class="display responsive  table-sm table table-condensed" style="width:100%">
		      <thead>
		        <tr>
		            <th style="width: 10px">N°</th>
		            <th></th>
		            <th style="width: 20px">Tipos de pago</th>
		            <th>Monto </th>
		            <th>Estado</th>
		            <th>Año A.</th>
		            <th>Fech. de pago</th>
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
		<div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			
	   </div>
	</div>

</div>
  </div>
</form>




<script>
$(document).ready(function() {
   $("#refres_add").hide();
    $('.js-example-basic-single').select2();
    get_paymentPlan({});
    listar_combo_EscolarAsync();

   
} );



</script>