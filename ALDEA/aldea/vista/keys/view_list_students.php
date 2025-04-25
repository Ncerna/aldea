<script type="text/javascript" src="../js/keys.js?rev=<?php echo time();?>"></script>
  <div class="col-md-12">
<div class="box box-warning ">
  <div class="box-body">
  
    <div class="row">
        <div class="col-xs-4 clasbtn_exportar">
               <div class="alin_global">
                <div class="input-group" id="btn-place"></div>
              </div>
            </div>

        <div class="col-xs-1 ">
       </div>
         <div class="col-xs-7 pull-right">
                <div class="alin_global">
                 <input type="text" class="global_filter form-control " id="global_filter" placeholder="Ingresar dato a buscar" style=" width: 100%">&nbsp;&nbsp;<button class="btn btn-primary"   onclick="refresh(this);" ><i class="fa fa-refresh"></i> </button>
                </div>
            </div>
    </div>
  <table id="students_keys" class="display responsive nowrap" style="width:100%">
    <thead>
      <tr>

        <th>Nº</th>
        <th>Alumno</th>
        <th>Teléfono</th>
        <th>Llave de acceso</th>
        <th>Fec. creacion</th>
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
      </tr>
    </tfoot>
  </table>
</div>
</div>
<!-- /.box -->
</div>
<style type="text/css">
  .result-container {
    background-color: rgba(0, 0, 0, 0.4);
    display: flex;
    justify-content: flex-start;
    align-items: center;
    position: relative;
    font-size: 18px;
    letter-spacing: 1px;
    padding: 12px 10px;
    height: 50px;
    width: 20%;
}
</style>


<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_generateKess" role="dialog">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="tituloModal"></h4>
           
            </div>
            <div class="modal-body">
             <div class="alin_global">
                   
                     <span class="form-control" id="result"></span>&nbsp;
                   <button class="btn" id="clipboard">
                    <i class="fa fa-clipboard"></i>
                  </button>
                  </div>
           
                <div class="settings" style="padding: 1rem;">
                  <div class="setting">
                    <input class="form-control form-control-sm" type="number" id="length" min="4" max="20" value="10">
                  </div>
                  <div class="setting">
                    <label>Letras mayúculas</label>
                    <input type="checkbox" id="uppercase" checked>
                  </div>
                  <div class="setting">
                    <label>Letras Minúculas</label>
                    <input type="checkbox" id="lowercase" checked>
                  </div>
                  <div class="setting">
                    <label>Incluir números</label>
                    <input type="checkbox" id="numbers" checked>
                  </div>
                  <div class="setting">
                    <label>Include simbolos</label>
                    <input type="checkbox" id="symbols" checked>
                  </div>
                </div>

            <button class="btn btn-large" id="generate">
              Generar clave
            </button>

               
                
                 
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="RegisterKeys()"><i class="fa fa-check"><b>&nbsp;Guardar</b></i></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
        </div>
    </div>
</form>




<script>

$(document).ready(function() {
  $("#refres_add").hide();
  List_keys_students();

  

  } );
</script>