

<script type="text/javascript" src="../js/docente_horario.js?rev=<?php echo time();?>"></script>
 <style type="text/css">
          #tabla_horarios{
            border: 1px solid #d4f4f7;
            border-radius: 10px;
            background-color: #f5f7f7;
          }
        </style>
<div class="col-md-12" >
    <div class="box box-warning ">
        <div class = "box-header with-border" id="Titulo_Center" >
      <h5 class = "box-title"><strong>Horarios de Clase - <?php echo date('Y');?></strong></h5>
    </div>

        <div class="box-body">
          <div class="form-group">
            <div class="row">
            <div class="col-xs-4 clasbtn_exportar">
              <div class="input-group" id="btn-place"></div>
            </div>
           
              <div class="col-md-6 pull-right">
                <div class="alin_global">
                 <input type="text" class="global_filter form-control " id="global_filter" placeholder="Ingresar dato a buscar" style=" width: 100%">
                </div>
            </div>
            </div>
            </div>
            <table id="tabla_horarios" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>N°</th>
                       
                        <th>Grado</th>
                        <th>Turno</th>
                        <th>Nivel(Inic-Prim-Secun)</th>
                        <th>Sección</th>
                        <th>Aula</th>
                        <th></th>
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
                        <th></th>
                    </tr>
                </tfoot>
            </table>
      

        </div>
    </div>
</div>
<script type="text/javascript"> 
$(document).ready(function() {
   $("#refres_add").hide();
$('.js-example-basic-single').select2();
listar_Horarios_Disponibles();
} );

</script>
