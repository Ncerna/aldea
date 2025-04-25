
var counter = 0;
function addactivity(){
  var activity =$("#actividanombre").val().toUpperCase();
  var puntaje =$("#idprocentaje").val();
  if (activity.length ==0 || puntaje.length==0) {$('#cont_horas_error').removeClass('form-group').addClass('form-group has-error');return;}
  if(counter<=100 && (parseFloat(puntaje)+ parseFloat(counter)) <=100){
    var row_add ="";
    row_add += "<div class='col-xs-12' id='key'>";
    row_add += "<div class='col-xs-8'>";
    row_add += "<input type='text' class='form-control' id='idActividad' value= '0' style='display: none' >";
    row_add += " <input type='text' class='form-control' id='actividad' spellcheck='true' value= '"+activity+"' ><br>";
    row_add += "</div>";
    row_add += "<div class='col-xs-4'>";
    row_add += "<div class='alin_global'>";
    row_add += "<input type='text' class='form-control' id='puntajeid'  value='"+puntaje+' %'+"' disabled><br>";
     row_add += "&nbsp;<button class='btn btn-secondary btn-sm' id='removeRow' style='margin-top: 3px;border-radius: 5px;' ><em class='fa fa-close'></em></button><br> ";
    row_add += "</div>";
    row_add += "</div>";
    row_add += "</div>";

    $('#componeteActivity').append(row_add);
    limpiarInput();  
    calcular_poderado(puntaje);
  }else{ 
    return Swal.fire("Mensaje De Advertencia", "Los puntaje son hata (100%) si deseas agregar mas Actividades gestione bién los puntajes"  , "warning");
    }
}

//remover el div creado
$(document).on('click', '#removeRow', function () {
$(this).closest('#key').remove();
    recetear();
});


//limpiar input
function limpiarInput(){
    $("#actividanombre").val('');
    $("#idprocentaje").val(''); 
}

//calcular puntaje
function calcular_poderado(puntaje){
 counter=parseFloat(counter)+parseFloat(puntaje);
  $("#totaldepuntje").html(counter+'%');
}


//recetear aray de puntajess
var puntajessum=new Array();
function recetear(){
  puntajessum=[];
  $("#componeteActivity input[id='puntajeid']").each(function() {
   if($(this).val()){
     puntajessum.push($(this).val().slice(0, -1) );
   }
 });
  var total = puntajessum.reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
  counter= total;
  $("#totaldepuntje").html(total+'%');
}




 function Registrar_Actividad(){
 var actividades=new Array();
 var puntajes=new Array();
  var idActividaedes=new Array();

    var idyear =$("#cbm_year").val();
    var curso =$("#cbm_curso").val();
    var  idActivid =$("#Idactyvite").val();
    var  tipoevalu =$("#txt_evaluacion").val();//ES LA POSICION
     var  periotipoevaluacion =$("#text_TipoEvaluacion").val();//ES LA REAL TIPO EVALUACION
  //JUNTANDO ACTIVIDADES
    $("#componeteActivity input[id='actividad']").each(function() {
     if($(this).val()){
       actividades.push($(this).val());
     }
   });
//JUNTANDO PUNTAJES DE ACTIVIDADES
      $("#componeteActivity input[id='puntajeid']").each(function() {
       if($(this).val()){
         puntajes.push($(this).val().slice(0, -1) );
       }
     }); 

  //JUNTANDO ID DE ACTIVIDADES
      $("#componeteActivity input[id='idActividad']").each(function() {
     if($(this).val()){
       idActividaedes.push($(this).val());
     }
   });



    if(actividades.length !=puntajes.length || actividades.length==0 || puntajes.length==0 ||idyear.length==0|| curso.length==0 || tipoevalu.length==0){
     return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios! que son requeridos para su correcta configuración", "warning");
   }
   var Arayactividad=actividades;
   var Araypuntaje=puntajes;
   $('#button_resgist').prop('disabled',true);
    $('.loader').show();////prende
   $.ajax({
    url: editando === false ? "../controlador/actividades/controlador_registrar_actividad.php" : "../controlador/actividades/controlador_update_actividad.php",
    type: 'POST',
    data: {idActivid:idActivid,idyear:idyear,curso:curso,periotipoevaluacion:periotipoevaluacion,
     tipoevalu:tipoevalu,actividades:actividades.toString(),puntajes:puntajes.toString(),idActividaedes:idActividaedes.toString()
   }
     }).done(function(Request) {
       XMLHttpRequestAsycn(Request);
       });  
  }


  function XMLHttpRequestAsycn(Request){
   if (Request > 0) {

    if(Request==1){

      $('.loader').hide();////prende
      $('#button_resgist').prop('disabled',false);
     
        Swal.fire({ icon: 'success', title: 'Éxito !!', text: 'Registro Correcto,Se agregarón actividades para la evaluación de forma Éxitoso!! ',showConfirmButton: false, timer: 1700});
      table.ajax.reload();
      LimpiarFrom_Registrar();

    }
    if(Request==100){

        $('.loader').hide();////prend
        $('#button_resgist').prop('disabled',false);
        return Swal.fire("Mensaje De Advertencia", "Y a hay registro Similar(Igual) a esto párametos seleccionados ...sugerencia Puedes Editar si desear modificar ,Mientras no hay evaluacines Activas ", "warning");
      }
      if (Request==404) {

       $('#button_resgist').prop('disabled',false);
       window.location = "NotFound";
     } 
     if (Request==401) {
       window.location = "NotFound";
     } 

     ////eliminar
      $('.loader').hide();////prende
     $('#button_resgist').prop('disabled',false);
     /////

   } else {
     $('.loader').hide();////prende
     $('#button_resgist').prop('disabled',false);
     return Swal.fire("Mensaje De Error", "No se registro Registro Fallido!!"+Request+""  , "error"); 
   }
 }




//COMBO DE AÑO ESCOLAR EN LA VISTA JORNADAS
  function listar_combo_EscolarAsync(year) {
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
                
                if(data[i][1]==year){cadena += "<option value='" + data[i][0] + "' selected>" + data[i][1] + "</option>";
                  listar_combo_TipoevaluacionAsync(data[i][0]);
                 }
                else{ cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";}
               
            }
            $("#cbm_year").html(cadena);

        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#cbm_year").html(cadena);
        }
    })
}



 var temData;
//COMBO DE CURSOS EN LA VISTA JORNADAS
 async function listar_combo_CursosAsync(curso) {
  var yearid  = $("#YearActualActivo").val();
 
  if(!yearid) {
    Swal.fire({ toast: true, position: 'top-right', icon: 'warning', title: 'Advertencia',
    text:'Seleccione el año académico.' ,showConfirmButton: false,timer: 2000});
    return;
  }
    var identi='';var nameCombo="--seleccione--";
    $.ajax({
        "url": "../controlador/actividades/controllerGetDeegresAndCouses.php",
        type: 'POST',
        data:{yearid:yearid}

        }).done(function(resp) {
        var data = JSON.parse(resp);

        temData= data;
        var cadena = "";
        if (data.length > 0) {

              cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {

              if(data[i][1]==curso){
                 cadena += "<option value='" + data[i][0] + "' selected>" + data[i][2] + " CÓDIGO:"+ data[i][1] + "</option>";
                 lista_combo_CodigoCurso(data[i][0]);
              }else{
                cadena += "<option value='" + data[i][0] + "'>" + data[i][2] + " CÓDIGO:"+ data[i][1] + "</option>";
              }

            }
            $("#cbm_curso").html(cadena);
           
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#cbm_curso").html(cadena);
        }
    })
}

async function lista_combo_CodigoCurso(id){
   // idcurso, cursoCodigo, nonbrecurso,tipo,grado.gradonombre,grado.seccion
   let desarrolladores = temData.filter(item => item.idcurso == id)
      $("#codigocur").val(desarrolladores[0].gradonombre + ' sección:  ' +desarrolladores[0].seccion);
       $("#txt_cred").val(desarrolladores[0][3]);
}

var table;
function listar_Cursos_Actividades() {
  var yearid  = $("#YearActualActivo").val();
    table = $("#tablaactividades").DataTable({
        "ordering": false,
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
            "url": "../controlador/actividades/controlador_listar_cursoActividad.php",
            type: 'POST',
            data:{yearid:yearid} 
        },
        "columns": [{ "data": "idactiviti"},
         { "data": "cursoCodigo"},
         { "data": "nonbrecurso"},
         {"data": "yearScolar"},
         {"data": "ordeperiodoTipo",
         render: function(data, type, row) {
                return  `<b>${row.ordeperiodoTipo}`+'°_'+`</b> ${row.tipo_nombre}` ;}
              

          },
         {
            "defaultContent": "<button  type='button' class='EditEvaluacion btn btn-primary btn-sm'><em class='fa fa-edit' title='editar'></em></button>"+
            "&nbsp;<button  type='button' class='verActividad btn btn-default btn-sm'><em class='fa fa-eye-slash' title='Ver Actividades'></em></button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("tablaactividades_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
    table.column( 0 ).visible( false );
 
}
function filterGlobal() {
    $('#tablaactividades').DataTable().search($('#global_filter').val(), ).draw();
}

var editando=false;
async function AbrirFrom_Registrar(){
    editando=false;
   $("#div_activiti_cursotable").hide();
   $("#div_ponderado_table").hide();
   listar_combo_EscolarAsync();
   listar_combo_CursosAsync();
   //listar_combo_TipoevaluacionAsync();
   $("#DivActividades").show();
}

async function LimpiarFrom_Registrar(){
    editando=false;
    counter = 0;
    $("#txt_evaluacion").val('');
    $("#cbm_year").val('');
     $('#cbm_year').prop('disabled', false);
      $('#txt_evaluacion').prop('disabled', true);
   // $('select option[value="0"]').attr("selected", true);
    $("#cbm_curso").val('');
    $("#Idactyvite").val('');
    $("#actividanombre").val('');
    $("#txt_cred").val('');
     $("#text_TipoEvaluacion").val('');
    $("#codigocur").val('');
    $("#idprocentaje").val('');
    temData=[];puntajessum=[];
    $("#totaldepuntje").html('');
    $("#componeteActivity").html('');
    $("#DivActividades").hide();
    $("#div_activiti_cursotable").show();
     $("#div_ponderado_table").show();
 
    $('#txt_evaluacion').val(0).trigger('change');

    $('#button_resgist').prop('disabled',false);
    $('.loader').hide();////prende
   }

//VER ACTIVIDADES DEL CURSO

$('#tablaactividades').on('click', '.EditEvaluacion', function() {
   editando=true;
   var data = table.row($(this).parents('tr')).data();
   if (table.row(this).child.isShown()) {
      var data = table.row(this).data();
      var id=data.idactiviti;
   }
    //actividades=[];puntajes=[];temData=[];puntajessum=[];
     var id=data.idactiviti;
     $("#div_activiti_cursotable").hide();
     $("#div_ponderado_table").hide();
     $('#cbm_year').prop('disabled', true);
     $("#Idactyvite").val(data.idactiviti== 0? data.idactiviti:id);
     $("#DivActividades").show();
     $("#edit_txt_evaluacion").val(data.ordeperiodoTipo);
     listar_combo_CursosAsync(data.cursoCodigo);
     listar_combo_EscolarAsync(data.yearScolar);
     Editar_Ponderado_Curso(id);

     //listar_combo_TipoevaluacionAsync();
});


 async function Editar_Ponderado_Curso(id) {
   var idActivid=id;
    $.ajax({
        "url": "../controlador/actividades/controlador_list_ponderacionesEdit.php",
        type: 'POST',
        data:{idActivid:idActivid}
    }).done(function(resp) {
      var data = JSON.parse(resp);
   
      if (data[0]==null || data==0) {
      } else {
        var row_add = '';
             $.each(data, function(i, item) {
                          
             row_add += "<div class='col-xs-12' id='key'>";
             row_add += "<div class='col-xs-8'>";
             row_add += "<input type='text' id='idActividad' value= '"+item.actcur_id+"'  style='display: none' >";
             row_add += "<input type='text' class='form-control' id='actividad' value= '"+item.actividades+"' ><br>";
             row_add += "</div>";
             row_add += "<div class='col-xs-4'>";
             row_add += "<div class='alin_global'>";
             row_add += "<input type='text' class='form-control' id='puntajeid'  value='"+item.puntajes+' %'+"'  disabled><br>";
             row_add += "&nbsp;<button class='btn btn-secondary btn-sm' id='removeRow' style='margin-top: 3px;border-radius: 5px;' ><em class='fa fa-close'></em></button><br> ";
             row_add += "</div>";
             row_add += "</div>";
             row_add += "</div>";
             calcular_poderado(item.puntajes);
              });
             $('#componeteActivity').append(row_add);
             limpiarInput();  
        } 
    })
}


//VER ACTIVIDADES DEL CURSO
$('#tablaactividades').on('click', '.verActividad', function() {
  var data = table.row($(this).parents('tr')).data();
  if (table.row(this).child.isShown()) {
      var data = table.row(this).data();
      var id=data.idactiviti;
  }

    var id=data.idactiviti;
    Listar_ActividadeCurso(id);
});

async function Listar_ActividadeCurso(id){
  $("#div_ponderado_table").show();
  var idActivid=id;
 var tablepoberado = $("#criterioEva_tabla").DataTable({
          "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            var monTotal = api
                .column( 1 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
      $( api.column( 0 ).footer() ).html('Ponderado Acumulado');
            $( api.column( 1 ).footer() ).html(monTotal+'(%)');
            
        },
        "ordering": false,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/actividades/controlador_Activi_Ponderado.php",
            type: 'POST' ,
            data:{idActivid:idActivid}
        },
        "columns": [
         { "data": "actividades"},
         { "data": "puntajes"}
         ],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("criterioEva_tabla_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
       
    });
}

//ESTE METODO ESTA PRECENTANDO EN EL SELECT
//LAS POSICIONES DEL TIPO EVALUACION YA QUE
//EL TIPO DE PERIODO ES LAS MISMAS  ENTOCES SE LE AGREGO POSICIONES 
//PAR DISTINGIRLO
//[ { "ordenTipo_periodo": "1", "tipo_periodo": "2", "tipo_nombre": "PERIODO BIMESTRAL"}]

async function listar_combo_TipoevaluacionAsync(year){
 var identi='';var nameCombo="--seleccione--";
  var yearid= year;
   var tipo= $("#edit_txt_evaluacion").val();
 $.ajax({
        "url": "../controlador/actividades/controlador_tipoevaluacion.php",
        type: 'POST',
        data:{yearid:yearid}
    }).done(function(resp) {
        var data = JSON.parse(resp);

        var cadena = "";
        if (data.length > 0) {
              cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";

            for (var i = 0; i < data.length; i++) {
              data[i][0] ==tipo ?
              cadena += "<option value='" + data[i][0] + "'selected >"+ ""+(i+ Number(1))+"°_" + data[i][2] + "</option>":
              cadena += "<option value='" + data[i][0] + "'>" + ""+(i+ Number(1))+"°_" + data[i][2] + "</option>";
               
            }
            $("#txt_evaluacion").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#txt_evaluacion").html(cadena);
        }
           $("#text_TipoEvaluacion").val((data[0][1]));
    })
    
}

