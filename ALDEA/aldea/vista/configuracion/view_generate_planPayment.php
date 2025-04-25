<script type="text/javascript" src="../js/payment.js?rev=<?php echo time();?>"></script>


<div class="col-md-12" >
<div class="box box-warning ">
        <div class="box-body">
             <h4 class="box-title" ><strong>Generar Cotas de pagos</strong></h4>
        </div>
    </div>
</div>

<div class="col-md-12" >
<div class="box box-warning ">
        <div class="box-body">
         <div class="row">

            <div class="col-md-4">
                 <label for="">tipos de cotas</label>
                 <select class="js-example-basic-single" name="state" id="enrollment" style="width:100%;">
                    <option value="true" selected>Pensiones y matrícula</option>
                    <option value="1" disabled>Pención</option>
                    <option value="2" disabled>Matrícula</option>
                        
                 </select><br><br>
                </div>
                 
                <div class="col-md-4 ">
                    <label for="">Año Escolar</label>
		           <select class="js-example-basic-single" name="state" id="yerar_id_cots" style="width:100%;" >
		           </select><br><br>
                </div>
                
                 <div class="col-md-4">
                     <label for="">N° de Cotas por estudiante</label>
                    <div class="alin_global">
                     <input type="number" class="form-control" id="number_couts"  value="5" >&nbsp;
                     <button onclick="fetchData(this);" class="btn" type="submit"  id="but_alin_global" class="btn btn-flat">
                    <i class="fa fa-search" ></i>
                    </button>
                    </div>
                <br>
                    
                </div>
                
      
        <!-- Tabla para entry -->
     
 </div>
        <!-- /.box-body -->
</div>
      <!-- /.box -->
</div>

<!-- Modal para entry -->

<script>
$(document).ready(function() {
   $("#refres_add").hide();
    $('.js-example-basic-single').select2();
    
   listar_combo_EscolarAsync();

   
} );



</script>