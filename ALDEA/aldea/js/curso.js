
var editando = false;
function Registrar_curso(){

try{

var idcurso=$('#txt_id_curso').val();    
var codigocur=$('#codigocur').val();
var nombre =$('#txt_nom_cur').val().toUpperCase();
var tipo =$('#cbm_sem').val();
var abbreviation =$('#abbreviation').val().toUpperCase();
var components =$('#components').val();
if (codigocur.length ==0 || nombre.length==0 ||  tipo.length==0) {
    return Swal.fire("Mensaje de Advertencia", "Llene espacio vacios", "warning");
}

$.ajax({
     url: editando === false ? "../controlador/curso/controlador_registrar_curso.php":"../controlador/curso/controlador_curso_Actualizar.php",
        type: 'POST',
        data: {
            idcurso:idcurso,
            codigocur:codigocur,
            nombre:nombre,
            tipo:tipo,
            abbreviation:abbreviation,
            components:components
        }
}).done(function(Request) {
       XMLHttpRequestAsycn(Request);
    })

}catch(error){
     return Swal.fire("Mensaje de error", "el Nombre: " +nombre+ " del cusao ya existe  registrado.", "error");
}

    

}



function LimpiarRegistroCurso(){
$('#codigocur').val("");   
$('#txt_nom_cur').val("");
$('#txt_cred').val("");
$('#cbm_sem').val("").trigger("change");
$('#abbreviation').val("");
$('#components').val("").trigger("change");;

editando=false;

}



var table_curso;

function listar_curso() {
    table_curso = $("#tabla_curso").DataTable({
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
            "url": "../controlador/curso/controlador_listar_curso.php",
            type: 'POST'  
        },
        "columns": [{
            "data": "idcurso"
        }, {
            "data": "cursoCodigo"
        }, {
            "data": "nonbrecurso"
        }, {
            "data": "tipo"
           
        },
         {
           "defaultContent": "<button type='button' class='editar btn btn-primary btn-sm'><em class='fa fa-edit' title='editar'></em></button>&nbsp;<button type='button' class='eliminar btn btn-default btn-sm'><em class='fa fa-trash' title='Eliminar'></em></button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("tabla_curso_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
 
}
function filterGlobal() {
    $('#tabla_curso').DataTable().search($('#global_filter').val(), ).draw();
}

$('#tabla_curso').on('click', '.editar', function() {
    var data = table_curso.row($(this).parents('tr')).data();
    if (table_curso.row(this).child.isShown()) {
        var data = table_curso.row(this).data();
        var idcursoedit=data.idcurso;
    }
    var idcursoedit=data.idcurso;
    editando=true;

      $("#txt_id_curso").val(idcursoedit);
      $('#codigocur').val(data.cursoCodigo);
      $('#txt_nom_cur').val(data.nonbrecurso);
     
      $('#cbm_sem').val(data.tipo).trigger("change");
      $('#abbreviation').val(data?.abbreviation ?? '');
      $('#components').val(data?.components ?? '').trigger("change");
})


$('#tabla_curso').on('click', '.eliminar', function() {
    var data = table_curso.row($(this).parents('tr')).data();

    if (table_curso.row(this).child.isShown()) {
        var data = table_curso.row(this).data();
        var idecurso=data.idcurso;
    }
     var idecurso=data.idcurso;
    $.ajax({
        "url": "../controlador/curso/controlador_curso_eliminar.php",
        type: 'POST',
        data: {
            idecurso : idecurso
        }
    }).done(function(resp) {
        if (resp > 0) {
           
                table_curso.ajax.reload();
           
            Swal.fire({ icon: 'success', title: 'Éxito !!', text: 'El Registro, se registro  de forma Éxitoso!! ',showConfirmButton: false, timer: 1700});  
        }else{
            return Swal.fire("Mensaje De Advertencia", "ups !,no se pudo eliminar, curso esta asignado a , grado , horario o docente", "warning");

        }
    })
})

function XMLHttpRequestAsycn(Request){
      if(Request>0){

        if (Request==100) {
            return Swal.fire("Mensaje De Advertencia", "El Registro Similar(Igual) a esto ya  Existe"  , "warning");
        }
        if (Request==1) {
              $("#modal_regist_curso").modal('hide');
                LimpiarRegistroCurso();
            
                table_curso.ajax.reload();
           

            Swal.fire({ icon: 'success', title: 'Éxito !!', text: 'El Registro, se registro  de forma Éxitoso!! ',showConfirmButton: false, timer: 1700});   
                   
        }
         if (Request==404) {
            window.location = "NotFound";
        } 
    }else{
       return Swal.fire("Mensaje De Error", "No se registro Registro Fallido!!"+Request+""  , "error"); 
    } 
}