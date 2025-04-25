
//COMBO CURSOS PARA AGREAGRA A GRADOS
function Combo_cursos() {
    $.ajax({
        "url": "../controlador/curso/controlador_curso_general.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
            $("#cbm_curso").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#cbm_curso").html(cadena);
        }
    })
}

//LISTAR GRADOS Y NIVELES
var table_grado;
function listar_config_gradosAll() {
    table_grado = $("#tabla_grados").DataTable({


        "ordering": true,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "pageLength": 10,
        "destroy": true,
       
        "processing": true,
        "ajax": {
            "url": "../controlador/grados/controlador_config_grados.php",
            type: 'POST'  
        },
        "columns": [
        { "data": "idgrado"},
        
         {"data": null, "render": function (data, type, row) {return row.gradonombre + ' sección: ' + row.seccion;}},
        { "data": "nombreNivell",
          render: function(data, type, row) {
            if (data == 'PRIMARIA') {
                return "<label class='label btn bg-navy btn-lg '>" + data + "</label>";
            }/*else {
                return "<label class='label btn bg-purple btn-lg '>" + data + "</label>";
            }*/
            if (data == 'SECUNDARIA') {
               return "<label class='label btn bg-purple btn-lg '>" + data + "</label>";
            }
            if (data == 'SUPERIOR') {
                return "<label class='label btn bg-olive btn-lg '>" + data + "</label>";
            }
            if (data == 'INICIAL') {
                return "<label class='label btn bg-maroon btn-lg '>" + data + "</label>";
            }
            }
         }, {
            "defaultContent": "<button  type='button' class='agregar btn btn-primary btn-sm'><i class=' glyphicon glyphicon-plus' title='agregar'></i></button>"+
            "&nbsp;&nbsp;<button  type='button' class='verCursos btn btn-default btn-sm'><i class='glyphicon glyphicon-eye-open' title='ver'></i></button>"
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

//AGREGAR CURSOS A GRADOS

$('#tabla_grados').on('click', '.agregar', function() {
    var data = table_grado.row($(this).parents('tr')).data();
   
    if (table_grado.row(this).child.isShown()) {
        var data = table_grado.row(this).data();
     $("#text_idgrado").val(data.idgrado);
      $("#nombrgrado").html(data.gradonombre);
      $("#text_idseccion").val(data.seccion);
    }
    $("#text_idgrado").val(data.idgrado);
     $("#nombrgrado").html(data.gradonombre);
     $("#text_idseccion").val(data.seccion);
    $("#table_cursos_asignado").hide();
    $("#modal_agregar_curso").show();   
})

//VER CURSOS DE LOS GRADOS
$('#tabla_grados').on('click', '.verCursos', function() {
    var data = table_grado.row($(this).parents('tr')).data();
   
    if (table_grado.row(this).child.isShown()) {
        var data = table_grado.row(this).data();
        var idgrado =data.idgrado;
        var nombre=data.gradonombre;
        $("#text_ver_idgrado").val(data.idgrado);
    }
     var idgrado =data.idgrado;
      var nombre=data.gradonombre;
    $("#text_ver_idgrado").val(data.idgrado);
      
    $("#modal_agregar_curso").hide();
    $("#error_avisomanual").hide();
    $('#modal_agregar_curso .box-body').find("#tbody_tabla_lista_curso").html("");
    $("#tbody_tabla_lista_curso").html("");
    $("#table_cursos_asignado").show();

  listar_Grado_Curso(idgrado,nombre);
});

//VERIFICAR SI YA SE LECCIONO LOS CURSOS AL LA TABLA
function verificaridcurso(idnuevo) {
    let ident = document.querySelectorAll('#tbody_tabla_lista_curso td[for="id"]');
    return [].filter.call(ident, td => td.textContent == idnuevo).length == 1;
}

//REMOVER CURSOS DE LA TABALA
function remove(t) {
    var td = t.parentNode;
    var tr = td.parentNode;
    var table = tr.parentNode;
    table.removeChild(tr);
    
}
//AÑADIR TABLAS CON CURSOS EN LA TABLA SE SECCION DE CURSOS

  function Add_tr_table(){
  	 var datos_add =""; $("#avisomanual").hide(); $("#error_avisomanual").hide();
  	 var idcurso =$("#cbm_curso").val();
  	 var nombcurso = $('#cbm_curso option:selected').text();
  	 if (verificaridcurso(idcurso)) {$("#error_avisomanual").show(); return; }
    datos_add +=  "<tr>";  
    datos_add += "<td class='mailbox-star' for='id'>" + idcurso + "</td>";
    datos_add += "<td class='mailbox-star'>" + nombcurso + "</td>";
    datos_add += "<td><button class='btn btn-secondary' onclick = 'remove(this)' style='border-radius: 5px; font-size: 12px'><em class='fa fa-trash'></em></button></td>";
    datos_add += "</tr>";
    $('#tbody_tabla_lista_curso').append(datos_add);
 }
//LIMPIAR REGISTRO/ CANCELAR
function Cancelar_registro(){
$("#modal_agregar_curso").hide();
$("#error_avisomanual").hide();
$('#modal_agregar_curso .box-body').find("#tbody_tabla_lista_curso").html("");
$("#tbody_tabla_lista_curso").html("");
$('#table_cursos_asignado .box-body').find("#tbody_tabla_addcursos").html("");
$("#tbody_tabla_addcursos").html("");
$("#table_cursos_asignado").show();
$('#cbm_curso').val(' ').trigger('change');

}

//REGISTRAR CURSOS A LOS GRADOS

function Registrar_Cursogrado(){
    var idgrado  = $("#text_idgrado").val();
    var yearid  = $("#YearActualActivo").val();
    var idseccion  = $("#text_idseccion").val();
    var cont = 0;
    var arregloidcurso = new Array();
    $('#tbody_tabla_lista_curso#tbody_tabla_lista_curso tr').each(function() {
        arregloidcurso.push($(this).find('td').eq(0).text());
        cont++;
    });
    if (cont == 0) {
        return;
    }
    $.ajax({
        url: '../controlador/grados/controlador_curso_grado.php',
        type: 'POST',
        data: {
            idgrado:idgrado,
            yearid:yearid,idseccion:idseccion,
            arregloidcurso: arregloidcurso.toString()
        }
    }).done(function(Request) {
    XMLHttpRequestAsycn(Request);
    }).fail(function (XMLHttpRequest, status, error) {
       
    });
}

//LISTAR CURSOS DE LOS GRADOS ASIGNADOS
function listar_Grado_Curso(idgrado,nombre){
    var yearid  = $("#YearActualActivo").val();
 $.ajax({
        "url": "../controlador/grados/controlador_verGrado_curso.php",
        type: 'POST',
        data: {
           idgrado: idgrado,yearid:yearid
        }
    }).done(function(Request) {

        var data = JSON.parse(Request);
       if (data.length!=0) {$("#table_avisomanua").hide(); Recorer_data_Resquest(data);
       }else{
          $("#table_avisomanua").show();
           var datos_add ="";
            datos_add +=  "<tr><td ></td><td >No hay Cursos Asignados para "+nombre+" grado </td></tr>";  
         $("#tbody_tabla_addcursos").html(datos_add);
       } 
    })

}

//RECORER LOS CURSOS ESTRAIDOS
function Recorer_data_Resquest(data){
  var datos_add ="";
  
        data.forEach(valor => {
                datos_add +=  "<tr guardarId="+valor.idcurso+">";  
                datos_add += "<td class='mailbox-star'for='id'>" + valor.idcurso + "</td>";
                datos_add += "<td class='mailbox-star'>"+valor.nonbrecurso+"</td>";
                 datos_add += "<td><button class='btn btn-default' onclick = 'QuitarCurso(this)' style='border-radius: 5px; font-size: 12px'><em class='fa fa-trash'></em></button></td>";
                datos_add += "</tr>";
        })
        $('#tbody_tabla_addcursos').html(datos_add);
}

//QUITAR CURSOS AÑADIDOS
function QuitarCurso(t) {

    var td = t.parentNode;
    var tr = td.parentNode;
    var grado = $("#text_ver_idgrado").val();
    var idcapturado = $(tr).attr('guardarId');

$.ajax({
        url: '../controlador/grados/controlador_Quitar_curso.php',
        type: 'POST',
        data: {
            idcapturado:idcapturado,grado:grado
        }
    }).done(function(resp) {
        if (resp > 0) {
            listar_Grado_Curso(grado,'Quitaste todo!!');
        } else {
            Swal.fire("Mensaje De Advertencia", "No se pudo QUITAR!!", "warning");
        }
    })
    
}

//PETICIONES Y MENSAJES SEVIDOR
function XMLHttpRequestAsycn(Request){
      if(Request>0){

        if (Request==100) {
            return Swal.fire("Mensaje De Advertencia", "El Registro Similar(Igual) a esto ya  Existe"  , "warning");
        }
        if (Request==1) {
               Cancelar_registro();
               $("#table_avisomanua").show();
             Swal.fire({icon: 'success', title: 'Mensaje de Éxito !!', text: 'El Registro, se registró con éxito!!',showConfirmButton: false,timer: 1500 });
        } 
    }else{
       return Swal.fire("Mensaje De Error", "No se registro Registro Fallido!!"+Request+""  , "error"); 
    } 
}