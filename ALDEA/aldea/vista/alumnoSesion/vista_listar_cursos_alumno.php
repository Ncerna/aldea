<script type="text/javascript" src="../js/alumno_session.js?rev=<?php echo time();?>"></script>
<div class="col-md-12" id='modal_agregar_curso' >
  <div class="box box-warning ">
    <div class = "box-header with-border" id="Titulo_Center" >
      <h5 class="box-title"><strong>Cursos Matriculado y Docentes a Cargo - <?php echo date('Y'); ?> </strong></h5>
      
      
    </div>
  <div class="box-body">
    <br>
    <div id="table_cursos_matriculados"></div>

</div>

</div>
</div>

 <script type="text/javascript">
$(document).ready(function() {
   $("#refres_add").hide();
Listar_Cusos_Matriculados();
} );
    

    </script>