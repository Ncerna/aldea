	 <script type="text/javascript" src="../js/reportep.js?rev=<?php echo time();?>"></script>
	<div class="col-md-12" >
	  <div class="box box-warning ">
	    <div class="box-header with-border">
	      <h3 class="box-title" style="text-align: center;"><center><strong>Reporte de pagos.</strong></center></h3>
	    </div>

	    <!-- /.box-header -->
	    <div class="box-body">
	      <div class="box-body">
	        <div class="row">
	          <div class="col-xs-4">
	            <label for="">Fecha Inicio</label>
	            <input type="date" class="form-control" id="reportFechainicio" ><br>
	          </div>
	          <div class="col-xs-4">
	            <label for="">Fecha Final</label>
	             <div class="alin_global">
	            <input type="date" class="form-control" id="reportFechafin" >&nbsp;
	            <button onclick="Estraer_Pagos_Range();" class="btn" type="submit" name="search" id="but_alin_global" class="btn btn-flat">
	                <i class="fa fa-search" ></i>
	                </button>
	                </div>
	            <br>
	          </div>
	        <div class="col-md-4">
	            <div class="input-group">
	            	 <label for="">Búsqueda</label>
	                   <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar" >
	               </div>

	        </div>
	        </div>
	         <table id="tabla_reportep" class="display responsive nowrap" style="width:100%">
	                <thead>
	                    <tr>
	                        <th>N°</th>
	                        <th>Apellidos</th>
	                        <th>Nombres</th>
	                        <th>Descripcion</th>
	                        <th>Fecha pagados</th>
	                         <th>Monto</th>
	                      
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
	                    </tr>
	                </tfoot>
	            </table>
	       
	    </div>
	     <div class="modal-footer">
	         
	     </div>
	  </div>
	</div>
	</div>

	<script>

$(document).ready(function() {
   $("#refres_add").hide();

   

} );
</script>