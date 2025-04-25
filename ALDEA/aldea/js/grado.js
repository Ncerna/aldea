
//LISTAR COMBO DE AULAS PARA REGISTRAR GRADOS
function Listar_Combo_aulas(){
    var identi='';var nameCombo="--seleccione--";
    $.ajax({
        "url": "../controlador/aula/controlador_combo_aula.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "&nbsp;&nbsp; Aforro:" + data[i][2] +  "</option>";
            }
            $("#cbm_aula").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#cbm_aula").html(cadena);
        }
    })
}

async function Listar_Combo_aulas_edit(nombreaula){
    var identi='';var nameCombo="--seleccione--";
    $.ajax({
        "url": "../controlador/aula/controlador_combo_editaula.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {

                data[i][0]==nombreaula ? 
                cadena += "<option value='" + data[i][0] + "' selected>" + data[i][1] + "&nbsp;&nbsp; Aforro:" + data[i][2] +  "</option>":
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "&nbsp;&nbsp; Aforro:" + data[i][2] +  "</option>";
            }
            $("#cbm_aula").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#cbm_aula").html(cadena);
        }
    })
}

async function Listar_Combo_turnosEdit(generic){
    var identi='';var nameCombo="--seleccione--";
    $.ajax({
        "url": "../controlador/aula/controlador_combo_editTurnos.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {

                data[i][0]==generic ? 
                cadena += "<option value='" + data[i][0] + "' selected>" + data[i][1] +  "</option>":
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                
            }
            $("#cbm_turnos").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#cbm_turnos").html(cadena);
        }
    })
}
async function Listar_Combo_nvelesEdit(generic){
    var identi='';var nameCombo="--seleccione--";
    $.ajax({
        "url": "../controlador/aula/controlador_combo_nivelesEdit.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {
                data[i][0]==generic ? 
                cadena += "<option value='" + data[i][0] + "' selected>" + data[i][1] +  "</option>":
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] +"</option>";
            }
            $("#cbm_nivel").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#cbm_nivel").html(cadena);
        }
    })
}

//REGISTRARA GRADOS
var editando=false;
function Registrar_Grado(){
      var idGrado=$("#idGrado").val();
     var nomb=$("#txt_nom").val();
     var turno =$("#cbm_turnos").val();
     var nivel =$("#cbm_nivel").val();
     var seccion=$("#cbm_seccion").val();
  var yearid  = $("#YearActualActivo").val();
     var aula =$("#cbm_aula").val();
     var vact=$("#vacantes").val();

    if (nomb?.length == 0 || turno?.length == 0 || nivel?.length == 0 || seccion?.length == 0 || aula?.length == 0) {
        return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
     }
     $.ajax({
         url: editando === false ? "../controlador/grados/controlador_registrar_grado.php":"../controlador/grados/controlador_editar_grado.php",
        type: 'POST',
        data: {
            idGrado:idGrado, nomb:nomb, turno:turno,nivel:nivel, seccion:seccion,aula:aula, vact:vact,yearid:yearid 
        }
    }).done(function(Request) {
        XMLHttpRequestAsycn(Request);
    }).fail(function (XMLHttpRequest, status, error) {
       
    });
}


function XMLHttpRequestAsycn(Request){
      if(Request>0){

        if (Request==100) {
            return Swal.fire("Mensaje De Advertencia", "El Registro Similar(Igual) a esto ya  Existe"  , "warning");
        }
        if (Request==1) {
               Cancelar_Registro();
              Listar_Combo_aulas();

            Swal.fire({ icon: 'success', title: 'Éxito !!', text: 'El Registro, se registro  de forma Éxitoso!! ',showConfirmButton: false, timer: 1700});  
             table_grado.ajax.reload();

              
        } 
         if (Request==404) {
            window.location = "NotFound";
        }
    }else{
       return Swal.fire("Mensaje De Error", "No se registro Registro Fallido!!"+Request+""  , "error"); 
    } 
}



function Cancelar_Registro(){
$("#idGrado").val('');
$("#inputWarning").hide();
 $("#txt_nom").val('');
 $('#cbm_seccion').val('').trigger('change');
 $("#cbm_aula").val('');
$("#vacantes").val('');

 $('#cbm_turnos').val('').trigger('change');
 $('#cbm_nivel').val('').trigger('change');
 $('#cbm_aula').val('').trigger('change');
 editando=false;
}

var table_grado;
function listar_grados() {
    table_grado = $("#tabla_grados").DataTable({


        "ordering": false,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },
        "lengthMenu": [
            [5, 25, 50, 100, -1],
            [5, 25, 50, 100, "All"]
        ],
        "pageLength": 5,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/grados/controlador_listar_grados.php",
            type: 'POST'  
        },
        "columns": [{
            "data": "idgrado"
        }, { "data": "gradonombre" }, 
           { "data": "nombreNivell" },
           {"data": "seccion" },
           { "data": "nombreaula" },
           { "data": "turno_nombre" },
          {"data": "vacantes" },
           {
            "defaultContent": "<button type='button' class='edit btn btn-primary btn-sm'><en class=' fa fa-edit' title='edit'></en></button>&nbsp;<button  type='button' class='eliminar btn btn-default btn-sm' title='eliminar'><em class='fa fa-trash'></em></button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("tabla_grados_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
     table_grado.column( 0 ).visible( false );

}
function filterGlobal() {
    $('#tabla_grados').DataTable().search($('#global_filter').val(), ).draw();
}



$('#tabla_grados').on('click', '.edit', function() {
    var data = table_grado.row($(this).parents('tr')).data();
    
    if (table_grado.row(this).child.isShown()) {
        var data = table_grado.row(this).data();
        var idgrado=data.idgrado;
    }
    var idgrado=data.idgrado;
    editando=true;
  $("#inputWarning").hide();
  $("#idGrado").val(idgrado);
  $("#txt_nom").val(data.gradonombre);
  Listar_Combo_turnosEdit(data.turno_id);
  Listar_Combo_nvelesEdit(data.nivel_id);
  $("#cbm_seccion").val(data.seccion).trigger("change");
  Listar_Combo_aulas_edit(data.aula_id);
  $("#vacantes").val(data.vacantes);
})





$('#tabla_grados').on('click', '.eliminar', function() {
    var data = table_grado.row($(this).parents('tr')).data();
    
    if (table_grado.row(this).child.isShown()) {
        var data = table_grado.row(this).data();
    }
    Swal.fire({
        title: 'Esta seguro que Quieres Eliminar?',
        text: "Una vez hecho se eliminarán todas las comfiguraciones realizados. La aula relacionado al grado quedara 'OCUPADO' vaya y cambia a estado 'LIBRE' para volver asignar la aula a otros grados Gracias!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.value) {
            Eliminar_Grado(data.idgrado);
        }
    }) 

})



function Eliminar_Grado(idgrado) {
    
    $.ajax({
        "url": "../controlador/grados/controlador_eliminar_grado.php",
        type: 'POST',
        data: {
           idgrado: idgrado 
        }
    }).done(function(resp) {
        if (resp > 0) {
            
                table_grado.ajax.reload();
           

            Swal.fire({ icon: 'success', title: 'Éxito !!', text: 'El Registro, se registro  de forma Éxitoso!! ',showConfirmButton: false, timer: 1700});  
        }
        else{

        return Swal.fire("Mensaje De Advertencia", "Lo sentimos No se pudo eliminar,Elgrado esta Activo,El grado esta siendo usado en Alumnos,Pagos,Horarios,Docente,Cursos,Primero quita de estas opciones", "warning");
            
        }
    })
}


