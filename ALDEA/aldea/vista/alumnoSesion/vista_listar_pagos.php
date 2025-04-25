<script type="text/javascript" src="../js/alumno_session.js?rev=<?php echo time();?>"></script>

<style type="text/css">
      #Tabla_Pagos_Alumno{
        border: 1px solid #d4f4f7;
        border-radius: 10px;
        background-color: #f5f7f7;
      }
      .dt-buttons{
        margin-top: -50px !important;
      }
    </style>

<div class="col-md-4">
  <div class="box box-warning">
    <div class="box-body box-profile" style="border:none;">
      <img class="profile-user-img img-responsive img-circle" src="../imagenes/default.png" alt="User profile picture">
     
      <h5 class="profile-username text-center" id='nombreAlumno'></h5>
     
        <div class="alin_global">
      <p class="text-muted text-center">Último pago realizado:</p>&nbsp;&nbsp;<label id="fechadeutimopago"></label>
    </div>
      <p class="text-muted text-center">Próximo Pago a realizar?</p>
        <div id="lista_Pagos_realizados"></div>
    </div>

  </div>
</div>


<div class="col-md-8" id='modal_agregar_curso' >
  <div class="box box-warning ">
    <div class = "box-header with-border" id="Titulo_Center" >
      <h5 class="box-title"><strong>Lista de Pagos Realizados <?php echo date('Y'); ?> </strong></h5>
      
      
    </div>
  <div class="box-body">
    <br>
    <div id="table_pagos_alumno"></div>

</div>

</div>
</div>



<script>

$(document).ready(function() {
   $("#refres_add").hide();

  Verificar_Fechas_Pago_Alumnos();
  listar_Alumno_Pagos();
  listar_stado_Deuda_Alumno();

   

} );
</script>