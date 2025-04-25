<script type="text/javascript" src="../js/boletas.js?rev=<?php echo time();?>"></script>


<div class="col-md-12" >
  <div class="box box-warning ">
   <div class="box-header with-border" id="Titulo_Center">
    <h3 class="box-title"><strong>Boletas de notas</strong></h3>

  </div>
  <style type="text/css">
    #tabla_matricula{
      border: 1px solid #d4f4f7;
      border-radius: 10px;
      background-color: #f5f7f7;
    }
    #btn_bucar_data{
      border: none;border-radius: 5px;color: white;background-color: #05ccc4;
    }
  </style>

  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-xs-4 ">
      </div>
      <div class="col-xs-2 "> 
      </div>
      <div class="col-xs-6 pull-right" >
       <div class="input-group">
        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar">
        <span class="input-group-addon"><em class="fa fa-search"></em></span>
      </div>
    </div>

  </div><br>

  <table id="tlb_students" class="display responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <th>Nº Registro</th>
        <th>Apellidos</th>
        <th>Nombres</th>
        <th>Grado</th>
        <th>Nivel</th>
        <th>Sección</th>
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
     </tr>
   </tfoot>
 </table>
</div>
</div>
<!-- /.box -->
</div>




<script>
  $(document).ready(function() {
    $("#refres_add").hide();
    getStudents();
  });
</script>
