
function registarAula(){
var idAula=$("#idAula").val();
var nombre=$('#aulaAula').val();
var piso=$('#piso').val();
var numero=$('#numero').val();
var aforro=$('#aforro').val();
var estado=$('#estado').val();

if (nombre.length ==0 || piso.length==0 ||  aforro.length==0 ||  estado.length==0) {
    return Swal.fire("Mensaje de Advertencia", "Llene espacio vacios", "warning");
}
$.ajax({
    "url": "../controlador/aula/controlador_registrar_aula.php",
        type: 'POST',
        data: {idAula:idAula, nombre:nombre, piso:piso, numero:numero,aforro:aforro,estado:estado
        }
}).done(function(Request) {
    XMLHttpRequestAsycn(Request);
 
    })
}

function linpiarregistroAula(){
	$('#idAula').val("");
	$('#aulaAula').val("");
	$('#piso').val("");
	$('#numero').val("");
    $('#aforro').val("");
    $('#estado').val("").trigger("change");

}

var tableAula;

function listar_Aulas() {
    tableAula = $("#tabla_aulas").DataTable({
        "ordering": false,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },
        "lengthMenu": [
            [8, 25, 50, 100, -1],
            [8, 25, 50, 100, "All"]
        ],
        "pageLength": 8,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/aula/controlador_listar_aula.php",
            type: 'POST'  
        },
        "columns": [{
            "data": "idaula"
        },
           {
            "data": "nombreaula"},
         {
            "data": "piso"},
         {
            "data": "numero" },
        {
            "data": "aforro" },
         {
            "data": "status",
            render: function(data, type, row) {
                if (data == 'LIBRE') {
                    return "<span class='label label-success'><i class ='fa fa-info-circle'></i>&nbsp;" + data + "</span>";
                } else {
                    return "<span class='label label-warning'>" + data + "</span>";
                }
            }
        }, {
            "defaultContent": "<button  type='button' class='editar btn btn-primary btn-sm'><i class=' fa fa-edit' title='ediat'></i></button>&nbsp;<button  type='button' class='eliminar btn btn-default btn-sm title='eliminar'><i class='fa fa-trash'></i></button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("tabla_aulas_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
  

}
function filterGlobal() {
    $('#tabla_aulas').DataTable().search($('#global_filter').val(), ).draw();
}

$('#tabla_aulas').on('click', '.editar', function() {
    var data = tableAula.row($(this).parents('tr')).data();
   
    if (tableAula.row(this).child.isShown()) {
        var data = tableAula.row(this).data();
    }
     $('#idAula').val(data.idaula);
     $('#aulaAula').val(data.nombreaula);
	$('#piso').val(data.piso);
	$('#numero').val(data.numero);
    $('#aforro').val(data.aforro);
  
    $('#estado').val(data.status).trigger("change");

  
})

$('#tabla_aulas').on('click', '.eliminar', function() {
    var data = tableAula.row($(this).parents('tr')).data();
   
    if (tableAula.row(this).child.isShown()) {
        var data = tableAula.row(this).data();
    }

      var idAula= data.idaula;
    $.ajax({
    "url": "../controlador/aula/controlador_eliminar_aula.php",
        type: 'POST',
        data: {
            idAula:idAula
        }
}).done(function(resp) {
        if (resp > 0) {
         tableAula.ajax.reload();
        } else {
            Swal.fire("Mensaje De Error", "no se pudo completr,ya esta ocupado poe un grado", "error");
        }
    })
   
  
})

function XMLHttpRequestAsycn(Request){
      if(Request>0){

        if (Request==100) {
            return Swal.fire("Mensaje De Advertencia", "El Registro Similar(Igual) a esto ya  Existe"  , "warning");
        }
        if (Request==1) {
              
             linpiarregistroAula();
             tableAula.ajax.reload();
            Swal.fire({ icon: 'success', title: 'Éxito !!', text: 'El Registro, se registro  de forma Éxitoso!! ',showConfirmButton: false, timer: 1700});  
                   
        }
         if (Request==404) {
            window.location = "NotFound";
        } 
    }else{
       return Swal.fire("Mensaje De Error", "No se registro, Registro Fallido!!"+Request+""  , "error"); 
    } 
}