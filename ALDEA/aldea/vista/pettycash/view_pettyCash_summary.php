<script type="text/javascript" src="../js/pettycash.js?rev=<?php echo time();?>"></script>
<div class="col-md-12" >
  <div class="box box-warning ">
    <div class="box-body">
     <div id="componenteGrados">
     <div class="col-md-3">
        <div class="info-box bg-green" style="border-radius: 6px"><span class="info-box-icon" style="width: 70px;border-radius: 6px">
          <em class="fa fa-arrow-circle-down">
            
          </em></span>
          <div class="info-box-content">
            <div class="" style="margin-top: 10px"><h5 class="">
              <strong>INGRESOS !!</strong></h5>
              <h5 class="" >total de ingreso</h5>
            </div>
              <div> <a  class="small-box-footer" style="color: #f7f5f3;cursor: pointer;font-size: 25px">
                <strong id="total_entry">Gua./. 0.00</strong> </a>
              </div> 
            </div> 
          </div> 
        </div>
        <div class="col-md-3">
        <div class="info-box bg-purple" style="border-radius: 6px"><span class="info-box-icon" style="width: 70px;border-radius: 6px">
          <em class="fa fa-arrow-circle-up ">
            
          </em></span>
          <div class="info-box-content">
            <div class="" style="margin-top: 10px"><h5 class="">
              <strong>EGRESOS</strong></h5>
              <h5 class="" >total de egresos</h5>
            </div>
              <div> <a  class="small-box-footer" style="color: #f7f5f3;cursor: pointer;font-size: 25px"><strong id="total_exit">Gua./. 0.00</strong> </a>
              </div> 
            </div> 
          </div> 
        </div>

        <div class="col-md-3">
        <div class="info-box bg-orange" style="border-radius: 6px"><span class="info-box-icon" style="width: 70px;border-radius: 6px">
          <em class="fa fa-dollar ">
          </em></span>
          <div class="info-box-content">
            <div class="" style="margin-top: 10px"><h5 class="">
              <strong>UTILIDAD</strong></h5>
              <h5 class="" >resumen general</h5>
            </div>
              <div> <a  class="small-box-footer" onclick="Summary_exit_entry()" style="color: #f7f5f3;cursor: pointer;font-size: 25px"><strong id="total_summary">Gua./. 0.00</strong> </a>
              </div> 
            </div> 
          </div> 
        </div>
         <div class="col-md-3">
        <div class="info-box bg-navy" style="border-radius: 6px"><span class="info-box-icon" style="width: 70px;border-radius: 6px">
          <em class="fa fa-money">
            
          </em></span>
          <div class="info-box-content">
            <div class="" style="margin-top: 10px"><h5 class="">
              <strong>CAJA CHICA</strong></h5>
              <h5 class="" >saldo disponible</h5>
            </div>
              <div> <a  class="small-box-footer" style="color: #f39c12;cursor: pointer;font-size: 25px"><strong id="pettycash_summary">Gua/. 0.00</strong> </a>
              </div> 
            </div> 
          </div> 
        </div>

        </div>
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
<div class="box-header">
<h3 class="box-title"><strong>Resumen general de los ingresos y egresos  del año- <?php echo date('Y'); ?></strong></h3>
</div>
   <div class="row">
    <div class="col-md-3 clasbtn_exportar">
     <div class="input-group" id="btn-place"></div>
   </div>
   <div class="col-md-3">
     <input type="date" class="form-control" id="date_ini" ><br>  
   </div>
   <div class="col-md-3">
    <div class="alin_global">
     <input type="date" class="form-control" id="date_final" >&nbsp;
     <button onclick="List_pettycash_summary();" class="btn" type="submit"  id="but_alin_global" class="btn btn-flat">
      <i class="fa fa-search" ></i>
    </button>
  </div>
  <br>

</div>
<div class="col-md-3 pull-right">
 <input type="text" class="global_filter form-control " id="global_filter" placeholder="Ingresar dato a buscar" style=" width: 100%">
</div>
</div><br>
<!-- Tabla para exit -->
<table id="pattycash_summary" class="display responsive nowrap table table-sm" style="width:100%">
  <thead>
    <tr>
      <th>N°</th>
      <th>Categorias</th>
      <th>Subcategoria</th>
      <th>Monto (S/.)</th>
      <th>Tipo</th>
      <th>Fecha</th>
     
      
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
<!-- /.box-body -->
</div>
<!-- /.box -->
</div>

<!-- Modal para exit -->




<script>
  $(document).ready(function() {
   $("#refres_add").hide();
   List_pettycash_summary();
   summary_entry();
   Summary_exit();
   Summary_Pettycash();
   $('.js-example-basic-single').select2();

 } );


</script>