<script type="text/javascript" src="../js/docente_session.js?rev=<?php echo time();?>"></script>
<div class="col-md-12">
  <div class="box box-warning ">
    <div class="box-header with-border">
      <h3 class="box-title">Grados Asignados - <?php echo date('Y');?></h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">

     <div class="col-md-12"> 

      <div id="componenteGrados"></div>

    </div>
    <!-- /.box-body -->

  </div>
  <!-- /.box -->
</div>
</div>

<div class="col-md-12" id="contetablecurso" style="display: none;">
  <div class="box box-warning ">
    <div class="box-body">
     <div class="col-md-12">

       <div id="materiasGradoComponente"></div>


</div>
<!-- /.box-body -->

</div>
<!-- /.box -->
</div>
</div>


<script>
$(document).ready(function() {
    $("#refres_add").hide();
listar_Grados_Docente();
    $('.js-example-basic-single').select2();
});
</script>


  