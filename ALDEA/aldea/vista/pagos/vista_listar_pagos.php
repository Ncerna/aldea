

<script type="text/javascript" src="../js/pago.js?rev=<?php echo time();?>"></script>

<div class='col-lg-12' style='border-color: #f5c6cb;' id="tutotiales_Id">
  <div id='avisomanual' class='alert  sm' role='alert' style='color: #0e0102; background-color: #acefe4;'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
   Todos los cambios realizados solo tendrán efecto en el año académico <strong>activo </strong>. Si se cambia de año académico de nuevo volverás  a configurar los grados y cursos. Gracias!!

 </div>
</div>

<style type="text/css">
      #Tabla_Pagos_Alumno{
        border: 1px solid #d4f4f7;
        border-radius: 10px;
        background-color: #f5f7f7;
      }
      
    </style>


<div class="col-md-12" id="tabalistadepagospenciones">
  <div class="box box-warning ">
   <div class="box-body">
    <div class="row">
       <div class="col-xs-12">
        <div class="col-xs-4 clasbtn_exportar">
          <div class="input-group" id="btn-place" ></div>
        </div>
        
        <div class="col-xs-4">
          <h5 class="box-title">Pagos de Penciones de Alumnos Matriculados </h5>
        </div>
        <div class="col-xs-4">
           
            <input type="text" class="global_filter form-control pull-right " id="global_filter" placeholder="Ingresar dato a buscar" style="border-radius: 5px; width: 100%">
         
        </div>
      </div>


      </div><br>

    <table id="Tabla_Pagos_Alumno" class="display responsive nowrap" style="width:100%">
      <thead>
        <tr>
          <th>Ident</th>
          <th>Apellidos</th>
          <th>Nombres</th>
          <th>Pago de Pensi&oacute;n</th>
          <th>Fecha Pagado</th>
          <th>Fecha de Proximo Pago</th>
          <th>Estado de Pago</th>
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
  <!-- /.box -->
</div>
</div>

<style type="text/css">
  .anyClass {
  height:190px;
  overflow-y: scroll;
}
</style>
<div id="modalPagosPenciones" style="display: none">

<div class="col-md-4">
  <div class="box box-warning">
    <div class="box-body box-profile" style="border:none;">
      <img class="profile-user-img img-responsive img-circle" src="../imagenes/default.png" alt="User profile picture">
      <input type="text" name="" id="idalumno" hidden>
      <h5 class="profile-username text-center" id='nombreAlumno'></h5>
      <input type="date" id="pagoulitorealizado" hidden>
        <div class="alin_global">
      <p class="text-muted text-center">Último pago realizado:</p>&nbsp;&nbsp;<label id="fechadeutimopago"></label>
    </div>
      <p class="text-muted text-center">Pagos Realizados</p>
       <div class="box-body anyClass" >
        <div id="lista_Pagos_realizados"></div>
     
      <a onclick="listar_Reportepago_masPagos_realizados()" class="btn btn-primary btn-block"><b>Ver más</b></a>
     </div>
     <br>
    </div>

  </div>
</div>


<div class="col-md-8" id='modal_agregar_curso' >
  <div class="box box-warning ">
    <div class="box-header titulosclass" id="Titulo_Center">
     <h3 class="box-title">Realizar nuevo Pago</h3>
  </div>
  <div class="box-body">
   <div class="col-lg-12">
    
    <div class="col-lg-12" style='border-color: #f5c6cb;'>
      <div id="avisomanual" class="alert  sm" role="alert" style="color: #0e0102; background-color: #acefe4;"><button  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        !SELECCIONE LOS MESES PARA REALIZAR EL PAGO!
        el mes seleccionado debe ser pasado 30 dias del ultimo pago realizado:
        &nbsp;&nbsp;<label class='label label-success'><i class="glyphicon glyphicon-plus "></i></label>    
      </div>

   </div>


   <div class="row">
    <div class="col-xs-12">
      <div class="col-xs-8">
        <label for=""><strong>Seleccione Meses *</strong></label>
      
        <select  class="js-example-basic-single" name="state" id="cbm_mes" style="width:100%;">
          <option value="">----seleccione un men pra realizar el pago----</option>
          <option  value="1">MES DE ENERO</option>
          <option value="2">MES DE FEBRERO</option>
          <option value="3">MES DE MARZO</option>
          <option value="4">MES DE ABRIL</option>
          <option value="5">MES DE MAYO</option>
          <option value="6">MES DE JUNIO</option>
          <option value="7">MES DE JULIO</option>
          <option value="8">MES DE AGOSTO</option>
          <option value="9">MES DE SETIEMBRE</option>
          <option value="10">MES DE OCTUBRE</option>
          <option value="11">MES DE NOVIEMBRE</option>
          <option value="12">MES DE DICIEMBRE</option>
        </select><br><br>
      </div>
      <div class="col-xs-4">
        <label for="">Monto</label>
      <div class="alin_global">
        <input type="number" class="form-control" id="txt_pago" placeholder="Guaranies/. 0 mil" >
        &nbsp;&nbsp;<button onclick="Agregar_tabla_Pagos();" class="btn-sm" id="but_alin_global" > <em class="glyphicon glyphicon-plus" ></em> </button> 
      </div>
      </div>
    </div>
 </div>
 
   <table   style="width:100%" class="table table-ms table-condensed">
    <thead class=" thead-drak" style="color: #721c24; background-color: #9fa5a4;">
      <th>Nro</th>
      <th>Fechas</th>
      <th>Monto</th>
      <th>Quitar</th>
    </thead>
    <tbody id="tbody_tabla_detall">   
    </tbody>
    <tr>
      <td> total a pagar</td>
      <td colspan=2 id=""></td>
      <td colspan=2 id="total"></td>
    </tr>
  </table>


<div id="toasts"></div>
</div>
</div>

<div class="modal-footer">
  <img class="loader" src="../login/vendor/abc.gif" style="width: 50px;height:50px;display: none;">&nbsp;
 
<button type="button" id="btn_imprimir_boleta" onclick="Imprimir_Boleta_De_Pago()" class="btn bg-navy margin btn-sm" style="display: none;" ><strong>¿Deseas Imprimir Boleta de Pago?</strong> <em class="fa fa-print" ></em></button>&nbsp;
<button class="btn btn-primary btn-sm " id="btn_registra" onclick="Registrar_Pago_Alumno()"><em class="fa fa-check"><b>&nbsp;Registrar</b></em></button>&nbsp;<button class="btn btn-default btn-sm "onclick="limpiar_Modal_registro()"><em class="fa fa-close"><b>&nbsp;Cancelar</b></em></button>&nbsp;
</div>
</div>
</div>

</div>


<form autocomplete="false" onsubmit="return false">
  <div class="modal fade" id="reporte_pago" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>PAGOS REALIZADOS</b></h4>
        </div>
        <div class="modal-body">
            <input type="text" name="reportidalumno" id="idalumno" hidden>
              <!-- Widget: user widget style 1 -->

                 <div class="col-lg-12">
                       <div class="box box-widget widget-user-2">
                         <div class="widget-user-header bg-widget">
                            <div class="widget-user-image">
                             <img class="img-circle" src="../imagenes/default.png" alt="User Avatar">
                          </div>
                         <h3 class="widget-user-username" id="reportnombreAlumno">&nbsp;<b></b></h3>
                        <h5 class="widget-user-desc" id="reportgradoAlumno"></h5>
                       </div>
                   </div>
               </div>
               
               <div class="col-lg-12"><br>
               
                     <table id="tabla_meses_pagado "style="width: 100%" class="table table-condensed">
                          <thead class=" thead-drak" bgcolor="black" style="color: #ffffff">
                               <tr>
                                   <td>Numero</td>
                                    <td>Fech pagados</td>
                                    <td>Monto</td>
                                </tr>
                              </thead>
                           <tbody id="tabla_meses_pagado">   
                          </tbody>
                         </table>
                        
                    
           </div>
        </div>
             <div class="modal-footer">
                <label for="">&nbsp;</label><br>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
      </div>
      
    </div>
  </div>
</form>


<script>

$(document).ready(function() {
   $("#refres_add").hide();
    $('.js-example-basic-single').select2();
   VerificarFechasDePagosAlumnos();
   listar_Alumno_Pagos();
   

} );
</script>