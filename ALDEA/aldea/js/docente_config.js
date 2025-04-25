var table;
function listar_Docentes_Disponibles() {
    table = $("#tabla_Docentes").DataTable({
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
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/docente/controlador_Docentes_disponibles.php",
            type: 'POST'
        },
        "columns": [{
            "data": "id_docente" },
             {"data": "nombres"},
             {"data": "apellidos"},
             {"data": "nombreNivell",
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
           },

        {
            "defaultContent":"<button  type='button' class='agregar btn btn-default btn-sm'><em class='fa fa-plus-circle' title='Agregar Grados'></em></button>"+
            "&nbsp;&nbsp;<button  type='button' class='verGrados btn btn-default btn-sm'><i class='glyphicon glyphicon-eye-open' title='ver'></i></button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("tabla_Docentes_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
     $('#btn-place').html(table.buttons().container()); 
     table.column( 0 ).visible( false );
    
}
function filterGlobal() {
    $('#tabla_Docentes').DataTable().search($('#global_filter').val(), ).draw();
}

$('#tabla_Docentes').on('click', '.agregar', function() {
  var data = table.row($(this).parents('tr')).data();
  if (table.row(this).child.isShown()) {
    var data = table.row(this).data();
  } 
  $('#idDocentesselect').val(data.id_docente);
  $('#combo_grados').prop('disabled',false);
  $('#add_cursos_btn').prop('disabled',false);
  $("#nombrdocente").html(data.nombres+","+data.apellidos);
  $("#text_IdNivelDocente").val(data.idniveles);
  $("#table_grados_asignado").hide();
 $("#divcursocheckdocente").hide();


        $("#tbody_tabla_lista_grado").html(''); //limpiar tabla cada que se cambia de docente
        $("#tbody_tabla_cursosgrados").html(''); //limpiar tabla cada que se cambia de docente
         $('#combo_grados').val('').trigger('change');//reseteando selec de grados
         $("#modal_agregar_grados").show();
       })


$('#tabla_Docentes').on('click', '.verGrados', function() {
    var data = table.row($(this).parents('tr')).data();
    if (table.row(this).child.isShown()) {
        var data = table.row(this).data();
    } 
       var  datos=(data.nombres+","+data.apellidos);
        $("#text_IdDocente").val(data.id_docente);
       $("#modal_agregar_grados").hide();
        $("#nombre_docente").html(data.nombres+","+data.apellidos);
        $("#table_grados_asignado").show();

       listar_Grados_Docente(data.id_docente,datos);

        listar_Cursos_Docente(data.id_docente);
})


///gradoId, gradonombre,nombreNivell
function listar_Grados_Docente(iddocente,datos){
   var yearid  = $("#YearActualActivo").val();
    $.ajax({
        "url": "../controlador/docente/controlador_verGrado_Docente.php",
        type: 'POST',
        data: {
           iddocente: iddocente,yearid:yearid
        }
      }).done(function(Request) {

        var data = JSON.parse(Request);
       if (data.length!=0) {$("#table_avisomanua").hide(); Recorer_data_Resquest(data);
       }else{
          $("#table_avisomanua").show();
           var datos_add ="";
            datos_add +=  "<tr><td ></td><td >No hay Grados Asignados para "+datos+"  </td></tr>";  
         $("#tbody_tabla_addcursos").html(datos_add);
       } 
    })
}
//gradoId, gradonombre,nombreNivell,idseccion
//RECORER LOS Grados ESTRAIDOS
function Recorer_data_Resquest(data){
  var datos_add ="";
  
  data.forEach(valor => {
    datos_add +=  "<tr guardarId="+valor.gradoId+">";  
    datos_add += "<td class='mailbox-star'for='id'>" + valor.gradoId + "</td>";
    datos_add += "<td class='mailbox-star'>"+valor.gradonombre+"</td>";
    datos_add += "<td class='mailbox-star'>"+valor.nombreNivell+"</td>";
     datos_add += "<td class='mailbox-star'>"+valor.idseccion+"</td>";
    datos_add += "<td><button class='btn btn-default' onclick = 'QuitarGrados(this)' style='border-radius: 5px; font-size: 12px'><em class='fa fa-trash'></em></button></td>";
    datos_add += "</tr>";
  })
  $('#tbody_tabla_addcursos').html(datos_add);
}

//QUITAR Grados AÑADIDOS
function QuitarGrados(t) {
  var yearid  = $("#YearActualActivo").val();
  var td = t.parentNode;
  var tr = td.parentNode;
  var idocente = $("#text_IdDocente").val();
  var idgrado = $(tr).attr('guardarId');
  $.ajax({
    url: '../controlador/docente/controlador_Quitar_Grado.php',
    type: 'POST',
    data: {idgrado:idgrado,idocente:idocente,yearid:yearid}

  }).done(function(resp) {
    if (resp > 0) {
      listar_Grados_Docente(idocente,'Se Quitó');
      listar_Cursos_Docente(idocente);
    } else {
      Swal.fire("Mensaje De error", "No se pudo QUITAR!!"+resp, "error");
    }
  })
}


//idgrado(0), gradonombre(1),nivel_id(2),nombreNivell(3),turno_id(4),seccion(5)
// idgrado, gradonombre,nivel_id,nombreNivell,turno_id,seccion 

var temData;
 async function listar_combo_Grados(){
     var identi='';var nameCombo="--seleccione--";
        $.ajax({
            "url": "../controlador/docente/controlador_combo_grados.php",
            type: 'POST'
        }).done(function(resp) {
          
            var data = JSON.parse(resp);
            var cadena = "";
            if (data.length > 0) {
              temData=data;

                cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
                for (var i = 0; i < data.length; i++) {
                    cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + ",&nbsp;" + data[i][3] +  ",SECCION;" + data[i][5] +"</option>";
                }
                 $('#combo_grados').html(cadena);////lamndo en vista matricula
           
            } else {
                cadena += "<option value=''>NO HAY GRADOS</option>";
                $("#combo_grados").html(cadena);
            }
        })
}

//FILTRAR ID NIVELES DEL GRADO SELECCIONADO
function  Lista_Filtros_IdNiels_Grado(idgrado){

 let tenfilter = temData.filter(item => item.idgrado == idgrado);
      $("#txt_nivelIdGrado").val(tenfilter[0][2]);
      $("#txt_idturno").val(tenfilter[0][4]);
      $("#txt_idseccion").val(tenfilter[0][5]);


}

//AÑADIR TABLAS CON CURSOS EN LA TABLA SE SECCION DE CURSOS

  function Add_tr_table(){
    var HTML='';
     var idgrado =$("#combo_grados").val();
     var nombreGrado = $('#combo_grados option:selected').text();
     //validando seleccionado algun grado
     if(idgrado?.length==0){return;}

     //VALIDANDO NIVEL DEL DOCENTE CON EL NIVEL DEL GRADO SELECCIONADO
       var idniveldocent=  $("#text_IdNivelDocente").val();
       var idnivelgrado=  $("#txt_nivelIdGrado").val();
    //juntando seccion selecionado
       var idseccion =  $("#txt_idseccion").val();
      
       if(idniveldocent != idnivelgrado){
        createNotification('EL DOCENTE PERTENECE A OTRO NIVEL','warnig');
        return;
      }

     ExtraerCursosDelGrado(idgrado,idseccion);

    if (verificaridcurso(idgrado)) {createNotification('GRADO YA SELECCIONADO:','info'); return; }

    HTML +=  "<tr guardarId="+idgrado+">";  
    HTML += "<td class='mailbox-star' for='id'>" + idgrado + "</td>";
    HTML += "<td hidden >" + idnivelgrado + "</td>";
    HTML += "<td hidden >" + idseccion + "</td>";
    HTML += "<td class='mailbox-star'>" + nombreGrado + "</td>";
    HTML += "<td><button class='btn btn-secondary' onclick = 'remove(this)' style='border-radius: 5px; font-size: 12px'><em class='fa fa-trash'></em></button></td>";
    HTML += "</tr>";
    $('#tbody_tabla_lista_grado').append(HTML);
    
 }

 function Cancelar_registro(){

  $('#idDocentesselect').val('');
  $('#combo_grados').prop('disabled',true);
  $('#add_cursos_btn').prop('disabled',true);
  $("#nombrdocente").html('');
  $("#nombre_docente").html('');
  $("#tbody_tabla_lista_grado").html(''); 
  $('#txt_nivelIdGrado').val('');
  $("#text_IdNivelDocente").val('');
  $("#modal_agregar_grados").hide();
  $("#table_grados_asignado").show();
  $('#combo_grados').val('').trigger('change');
  selecionado=[];
  $("#divcursocheckdocente").hide();
  $("#divCursos").hide();
  $("#tbody_tabla_cursosgrados").html('');
  $("#tbody_tabla_addcursos").html('');

}


 //REMOVER CURSOS DE LA TABALA
function remove(t) {
    var td = t.parentNode;
    var tr = td.parentNode;
     var idcapturado = $(tr).attr('guardarId');
    var table = tr.parentNode;
    table.removeChild(tr);

    QuitarCursos(idcapturado);
}

//VERIFICAR SI YA SE LECCIONO LOS CURSOS AL LA TABLA
function verificaridcurso(idgrado) {
    let ident = document.querySelectorAll('#tbody_tabla_lista_grado td[for="id"]');
    return [].filter.call(ident, td => td.textContent == idgrado).length == 1;
}



//REGISTRA GRADOS A   DOCENTESNTES////

function Registrar_Docente_Grado(){
  var yearid  = $("#YearActualActivo").val();
  var iddocente=  $('#idDocentesselect').val();
  var idniveldocent=  $("#text_IdNivelDocente").val();

  ///GRADOS SELECCIONADOS
    var idgrados = new Array();
    $('#tbody_tabla_lista_grado tr').each(function() {
        idgrados.push($(this).find('td').eq(0).text());
    });
    //NIVELES SELECCIONADOS
    var idnivelgrado = new Array();
    $('#tbody_tabla_lista_grado tr').each(function() {
        idnivelgrado.push($(this).find('td').eq(1).text());
    });

   //SECCIONES SELECCIONADOS
   var seccionesid = new Array();
    $('#tbody_tabla_lista_grado tr').each(function() {
        seccionesid.push($(this).find('td').eq(2).text());
    });

    //CURSOS SELECCIONADOS
    var selecionado = [];
  $("#tbody_tabla_cursosgrados input[type='checkbox']:checked").each(function(index){
    rows=$(this).closest('tr');
    selecionado.push({ idgrado : rows.find('td:eq(1)').text(),
                       idseccion : rows.find('td:eq(2)').text(),
                       idcurso : rows.find('td:eq(3)').text()
    });
  })
  var data= JSON.stringify(selecionado);

     //VALIDACIONES
    if(idnivelgrado.length==0 ||idgrados.length==0 || idnivelgrado.length != idgrados.length ){
      return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
    }

     $('.loader').show();////prende
     $('#button_resgist').prop('disabled',true);

     $.ajax({
            "url": "../controlador/docente/controlador_docente_grados.php",
            type: 'POST',
            data:{yearid:yearid,iddocente:iddocente,idniveldocent:idniveldocent,
              idgrados:idgrados.toString(),idnivelgrado:idnivelgrado.toString(),seccionesid:seccionesid.toString(),data:data}
        }).done(function(Request) {
          XMLHttpRequestAsycn(Request);
           
        })

}

//PETICIONES Y MENSAJES SEVIDOR
function XMLHttpRequestAsycn(Request){
      if(Request>0){

        if (Request==100) {
           $('.loader').hide();////prende
            $('#button_resgist').prop('disabled',false);
            return Swal.fire("Mensaje De Advertencia", "El Registro Similar(Igual) a esto ya  Existe"  , "warning");
        }
        if (Request==1) {
              Cancelar_registro();
               $('.loader').hide();////prende
              $('#button_resgist').prop('disabled',false);

               Swal.fire({icon: 'success', title: 'Mensaje de Éxito !!', text: 'El Registro, se registró con éxito!!',showConfirmButton: false,timer: 1500 });
              
        } 
    }else{
        $('.loader').hide();////prende
        $('#button_resgist').prop('disabled',false);
       return Swal.fire("Mensaje De Error", "No se registro Registro Fallido!!"+Request+""  , "error"); 
    } 
}



function createNotification(message = null, type = null) {
    const notif = document.createElement('div')
    notif.classList.add('toast')
    notif.classList.add(type ? type : 'info')
    notif.innerText = message ? message : 'No se Reconoció el tipo de Mensaje '
    toasts.appendChild(notif)

    setTimeout(() => {
        notif.remove()
    }, 3000)
}



/////////////////////////////////////////////////////////////////////
//////////SECCION DE MOSTRAR CURSOS DE LOS GRSDOS ASIGNSDOS//////////
////////////////////////////////////////////////////////////////////



//LISTAR CURSOS DE LOS GRADOS ASIGNADOS
async function ExtraerCursosDelGrado(idgrado,idseccion){
    var yearid  = $("#YearActualActivo").val();
 $.ajax({
        "url": "../controlador/grados/controlador_verGrado_curso.php",
        type: 'POST',
        data: {idgrado: idgrado,yearid:yearid }
      }).done(function(Request) {
        var data = JSON.parse(Request);
       if (data.length!=0) {

         $("#divCursos").show();

          Recorer_cursos_delDocente(data,idgrado,idseccion);
      }else{
         console.log("NotData");
       } 
    })

}

//RECORER LOS CURSOS ESTRAIDOS
async function Recorer_cursos_delDocente(data,idgrado,idseccion){
  var html='';

         if (data.length !=0) {
        $.each(data, function(i,elemt) {
         html += "<tr id='elemt"+idgrado+"'>";

         html += "<td><input type='checkbox' class='classcuso"+i+"' checked></td>";
         html += "<td hidden>"+idgrado+"</td>";
         html += "<td hidden>"+idseccion+"</td>";
         html += "<td hidden>"+elemt.idcurso+"</td>";
         html += "<td>"+elemt.nonbrecurso+"</td>";
         html += "</tr>";
           });
        }else {html += "<tr><td>Not_Data</td></tr>";}

    $('#tbody_tabla_cursosgrados').append(html);
}

function All_select(e){
  if(e.checked){
   $("#tbody_tabla_cursosgrados tr ").each(function(i){
    $("input[class='classcuso"+i+"']").prop("checked", true);
  });
 }
 else{
   $("#tbody_tabla_cursosgrados tr ").each(function(i){
    $("input[class='classcuso"+i+"']").prop("checked", false);  
  });
 }   
}

function QuitarCursos(idcapturado){
$("#tbody_tabla_cursosgrados tr[id='elemt"+idcapturado+"']").remove();
}


async function listar_Cursos_Docente(id_docente){
  $("#tbody_tabla").html('');
var yearid  = $("#YearActualActivo").val();
 $.ajax({
        "url": "../controlador/docente/controlador_materia_Docentes.php",
        type: 'POST',
        data: {id_docente: id_docente,yearid:yearid}
      }).done(function(Request) {
        var datos = JSON.parse(Request);

        if (datos.length !=0) {
          $("#divcursocheckdocente").show();
           $("#tbody_tabla").html(datos);
        }else {
          $("#divcursocheckdocente").hide();
           $("#tbody_tabla").html('');
        } 
    })
}

function Actualizar_Cursos_Docente(){
var iddocente = $("#text_IdDocente").val();
var yearid  = $("#YearActualActivo").val();

 //CURSOS SELECCIONADOS
    var checkedCurso = [];
  $("#divcursocheckdocente #tbody_tabla input[type='checkbox']:checked").each(function(index){
    rows=$(this).closest('tr');
    checkedCurso.push({ idcurso : rows.find('td:eq(1)').text(),
                       idgrado : rows.find('td:eq(2)').text(),
                        iseccion : rows.find('td:eq(3)').text(),
                       
    });
  })
  var data= JSON.stringify(checkedCurso);

$.ajax({
        "url": "../controlador/docente/controlador_Actualizar_materia_Docentes.php",
        type: 'POST',
        data: {iddocente: iddocente,yearid:yearid,data:data}
      }).done(function(Request) {
        var datos = JSON.parse(Request);
       

        if (datos==1) {
           Swal.fire({icon: 'success', title: 'Mensaje de Éxito !!', text: 'El Registro, se registró con éxito!!',showConfirmButton: false,timer: 1500 });
        }
        if (datos=="") {
          Swal.fire({icon: 'question', title: 'Nada que hacer !!', text: 'No se realizo ningun cambio!!',showConfirmButton: false,timer: 1500 });
        }
        




    })




}

/*

async function Recorer_cursos_delDocente(data,idgrado){
  var html='';
  console.log(data);

         html += "<div class='col-md-3' id='divCursos"+idgrado+"'>";
         html += "<div class= 'box box-ping' >";
         html += "<div class='box-header' >";
         html += "<h5 class='box-title'>Cursos</h5>";
         html += "<div class='box-tools pull-right'>";
         html += "<button type='button' class='btn btn-box-tool'  onclick='Quitar("+idgrado+");' style='margin-top: -25px;'>";
         html += "<em  class='fa fa-close'></em></button>";
         html += "</div>";
         html += "</div>";
         html += "<table class='table table-condensed table-sm' >";
         html += "<thead style='background-color:#989d9c; color: white;'>";
         html += "<tr>";
         html += "<th style='width: 5px;'><input type='checkbox' onclick='All_select(this)' ></th>";
         html += "<th>Nombre</th>";
         html += "</tr>";
         html += "</thead>";
         html += "<tbody id='tbody_tabla_cursos"+idgrado+"'>";
         if (data.length !=0) {
          $.each(data, function(i,elemt) {
         html += "<tr >";
         html += "<td><input type='checkbox' class='classcuso"+i+"' /></td>";
         html += "<td hidden>"+elemt.idgrado+"</td>";
         html += "<td hidden>"+elemt.idcurso+"</td>";
         html += "<td>"+elemt.nonbrecurso+"</td>";
         html += "</tr>";
           });
        }else {html += "<tr><td>Not_Data</td></tr>";}

         html += "</tbody>";
         html += "</table>";

         html += "</div>";
         html += "</div>";

    $('#componentes_Cursos').append(html);
}

*/