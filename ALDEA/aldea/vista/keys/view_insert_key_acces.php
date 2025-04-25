
 <div class="col-md-12">
<div class="box box-warning ">
      <div class="box-header with-border">
    <h3 class="box-title">Acceso a la boleta de notas</h3>
    </div>
 <div class="box-body">
       <style type="text/css">#btn_bucar_data{
      border: none;border-radius: 5px;color: white;background-color: #05ccc4;
    }</style>
     <div class="row">
       <div class="col-xs-12">
        <div class="col-md-6">
          <label for="">Año Aced&eacute;mico </label>
             <select class="js-example-basic-single" name="state" id="studens_year" style="width:100%;" >
                  </select><br><br>

        </div>
         <div class="col-md-6">
           <label for="">Llave de acceso</label>
           <div class="alin_global">
          <input type="text" name="message" id="lock_input" placeholder="Type Message ..." class="form-control" />&nbsp;
           <button onclick="lock_access();" class="btn-sm" id="btn_bucar_data"> <em class="fa  fa-lock" ></em> </button>
         </div>
        </div>
        
        </div>
       
      </div>
    </div>
    </div>

</div>

<!-- /.box -->


<script>

$(document).ready(function() {
  $("#refres_add").hide();
  $('.js-example-basic-single').select2();
   listar_combo_EscolarAsync();
  } );


function listar_combo_EscolarAsync() {
    var identi='';var nameCombo="--seleccione--";
    $.ajax({
        "url": "../controlador/actividades/configuracion_listarYear.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
              cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {
                
               cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
            $("#studens_year").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#studens_year").html(cadena);
        }
    })
}



function lock_access() {

    var lock_access = $("#lock_input").val();
    var id_year= $("#studens_year").val();
    $.get('../controlador/collaboration/controller_access_card.php', { key_access: lock_access,id_year:id_year })
        .done(function(resultado) {
            var response = JSON.parse(resultado);
            if (response.status) {
                
                 let {data} = response;
                  window.open("../vista/reportePDF/ticket/report_pdf_card.php?idalumno="+parseInt(data.Id_alumno)+"&id_year="+
                parseInt(data.year_id)+"&idgrado="+parseInt(data.Id_grado)+
                  "#zoom=95%","report","scrollbars=NO");
                
            } else {
                Swal.fire("Mensaje de error", response.msg, "error");
            }
            console.log(response)
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 403) {
                Swal.fire("Mensaje de error", "No Autorizado.", "error");
            } else {
                Swal.fire("Mensaje de error", errorThrown, "error");
            }
        });
}
</script>