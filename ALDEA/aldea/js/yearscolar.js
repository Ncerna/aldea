//AÑO ESCOLAR
var editando=false;
function AbrirModalRegistro(){
  $("#tablaYearEscolar").hide();
  $("#DivYearTurnos").hide();
   $("#tutotiales_Id").hide();
   $("#Cerat_avisomanual").show();
  $("#DivYearEscolar").show();

   editando=false;
  listar_combo_Turnos();
}
  //LISTAR TURNOS PARA REGISTRAR AÑO ESCOLAR
function listar_combo_Turnos() {
  var identi='';var nameCombo="--seleccione--";
    $.ajax({
        "url": "../controlador/configuracion/configuracion_listarTurno.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
          cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
            $("#cbm_Turnos").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#cbm_Turnos").html(cadena);
        }
    })
}
function addDivdeTurnos(id,nombre){
 var row_add ="";
                row_add += "<div class='row' id='key'>";
                 row_add += "<div class='col-xs-3'>";
                 row_add += " <input type='text' id='idturnos' value='"+id+"' hidden><br>";
                 row_add += " <label class='form-control' style='border-radius: 5px;' >"+id+"_"+nombre+"</label>";
                 row_add += "</div>";

                 row_add += "<div class='col-xs-3'>";
                  row_add += " <label >Hora Inicio</label>";
                row_add += "<input type='time' class='form-control' id='horaInicio' style='border-radius: 5px; background-color: #e7e7e7;' ><br>";
                row_add += "</div>";

                row_add += "<div class='col-xs-3'>";
                row_add += " <label >Hora Final</label>";
                 row_add += "<input type='time' class='form-control' id='finalHora' style='border-radius: 5px; background-color: #e7e7e7;' ><br>";
                row_add += "</div>";
                row_add += "<div class='col-xs-3'>";
                 row_add += "<button class='btn btn-secondary' id='removeRow' style='margin-top: 25px;border-radius: 5px;' ><em class='fa fa-close'></em></button><br> ";
                 row_add += "</div>";

                row_add += "</div>";
        $('#componeteTurnos').append(row_add);
}
//remover el div creado
$(document).on('click', '#removeRow', function () {
  $('#cont_horas_error').removeClass('form-group has-error').addClass('form-group');
$(this).closest('#key').remove();
});         

 //REGISTRAR AÑO ESCOLAR
 

function RegisUpdat_YearEscolar(){

 var inicioHora = new Array();
 var finHora = new Array();
 var turnos = new Array();

  var idyear = $("#id_yearscolar").val();
  var fechainicio = $("#YearFechainicio").val();
  var fechafin = $("#YearFechafin").val();
  var cierrematricula = $("#fechaMatri").val();
  var tipoevaluacion = $("#TipoEvaluacion").val();
  var yearScolar = $("#YearEscolar").val();
  
  $("#componeteTurnos input[id='idturnos']").each(function() {
  if($(this).val()){
     turnos.push($(this).val());
  }
});
$("#componeteTurnos input[id='horaInicio']").each(function() {
  if($(this).val()){
     inicioHora.push($(this).val());
  }
});
$("#componeteTurnos input[id='finalHora']").each(function() {
  if($(this).val()){
     finHora.push($(this).val());
  }
});

   var fini =new Date(fechafin);
   var ini  =new Date(fechainicio);
   var matri =new Date(cierrematricula);

   if(ini > fini || matri> fini ||  matri< ini){
    $('#cont_error').removeClass('form-group').addClass('form-group has-error');
    return;
   }

   if (fechainicio.length == 0 || fechafin.length == 0 || cierrematricula.length == 0 || tipoevaluacion.length == 0 || yearScolar.length == 0) {
    return Swal.fire("Mensaje De Advertencia", "Llene los campos vacíos que son requeridos", "warning");
   }

  if (turnos.length!=finHora.length || turnos.length!=inicioHora.length) {
  $('#cont_error').removeClass('form-group has-error').addClass('form-group');
  $('#cont_horas_error').removeClass('form-group').addClass('form-group has-error');
     return;
  }

 if (finHora.length==0 || inicioHora.length == 0 || turnos.length == 0 ) {
  $('#cont_error').removeClass('form-group has-error').addClass('form-group');
  $('#cont_horas_error').removeClass('form-group has-error').addClass('form-group');
  return Swal.fire("Mensaje De Advertencia", "Es importante seleccionar como minimo 1 turno; selecione en (+)", "warning");
 }

 $('.loader').show();////prende
 $('#button_resgist').prop('disabled',true);
$.ajax({  
  url: editando === false ? "../controlador/configuracion/configuracion_registroYear.php" : "../controlador/configuracion/configuracion_updateYear.php",
  type: 'POST',
  data: {
      idyear:idyear,fechainicio: fechainicio, fechafin: fechafin,cierrematricula: cierrematricula,
      tipoevaluacion: tipoevaluacion, inicioHora:  inicioHora.toString(),finHora:finHora.toString(),
       turnos:turnos.toString(), yearScolar: yearScolar
  }
}).done(function(Request) {
    XMLHttpRequestAsycn(Request);
});
}

function LimpiarRegistroYear(){
  $("#Cerat_avisomanual").hide();
    $("#tutotiales_Id").hide();
  $("#DivYearEscolar").hide();
  $("#tablaYearEscolar").show();
  $("#DivYearTurnos").show();
  $("#id_yearscolar").val(" ");
  $("#YearFechainicio").val(" ");
  $("#YearFechafin").val(" ");
  $("#fechaMatri").val(" ");
  $('#componeteTurnos').html("");
  $('#cont_error').removeClass('form-group has-error').addClass('form-group');
  $('#cont_horas_error').removeClass('form-group has-error').addClass('form-group');
  $('.loader').hide();////prende
  $('#button_resgist').prop('disabled',false);

}
var tabla;
function Listar_YearEscolar(){
  table = $("#tabla_yearScolar").DataTable({
    "ordering": false,
    "bLengthChange": false,
    "searching": {
        "regex": false
    },
    "responsive": true,
    "dom":'Bfrtilp',
       
        buttons:[
            { extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i> ',
                titleAttr: 'Exportar a Excel'
            }, {extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i> ',
                titleAttr: 'Exportar a PDF'
            }],
    
    "pageLength": 10,
    "destroy": true,
    "async": false,
    "processing": true,
    "ajax": {
      url:  "../controlador/configuracion/configuracion_listarYear.php",
        type: 'POST'
    },
      "columns": [{
            "data": "id_year"},
             { "data": "fechainicio" },
             { "data": "fechafin"},
             {"data": "cierramatricula"},
             {"data": "yearScolar" },
             
         {"data": "stadoyear",
          render: function(data, type, row) {
             return data == 'ACTIVO'?

              "<button type='button' class='Desactivar  btn btn-warning btn-sm' title='DESACTIVAR'><em class='fa fa-toggle-on' ></em></button>&nbsp;"+
              "<button type='button' class='editar btn btn-primary btn-sm'><em class='fa fa-edit' title='editar'></em></button>&nbsp;"+
              "<button type='button' class='verturno btn btn-default btn-sm'><em class='fa fa-eye-slash' title='Ver tuno'></em></button>"

              ///desactivado
              :"<button type='button' class='Activar btn btn-default btn-sm' title='ACTIVAR'><em class='fa  fa-toggle-off'></em></button>&nbsp;"+
               "<button type='button' class='editar btn btn-primary btn-sm'><em class='fa fa-edit' title='editar'></em></button>&nbsp"+
                "<button type='button' class='verturno btn btn-default btn-sm'><em class='fa fa-eye-slash' title='Ver tuno'></em></button>";}
        }],
      "language": idioma_espanol,
      select: true
  }); 
  document.getElementById("tabla_yearScolar_filter").style.display = "none";
  $('input.global_filter').on('keyup click', function() {
      filterGlobal();
  });
   table.column( 0 ).visible( false );
  $('#btn-place').html(table.buttons().container()); 
}

function filterGlobal() {
  $('#tabla_yearScolar').DataTable().search($('#global_filter').val(), ).draw();
}


//EDITAR TURNOS DE AÑO ESCOLAR
$('#tabla_yearScolar').on('click', '.editar', function() {
  var data = table.row($(this).parents('tr')).data();
  if (table.row(this).child.isShown()) {
      var data = table.row(this).data();
  }
    editando=true;
   $("#tablaYearEscolar").hide();
   $("#DivYearTurnos").hide();//ESCONDIENDO DIV DE TURNOS VER
   listar_combo_Turnos();
   $("#DivYearEscolar").show();
   $("#id_yearscolar").val(data.id_year);
   $("#YearFechainicio").val(data.fechainicio);
   $("#YearFechafin").val(data.fechafin);
   $("#fechaMatri").val(data.cierramatricula).trigger("change");
   $("#YearEscolar").val(data.yearScolar).trigger("change");

   turnosShow_Editar(data.id_year);
});

//EXTAER TURNOS DEL AÑO ESCOLAR
function turnosShow_Editar(id){
  var  idyear=id;
$.ajax({
 url: '../controlador/configuracion/configuracion_TurnoShow.php',
 type:'POST',
   data:{idyear:idyear}
 }).done(function(resp) {
  var datos = JSON.parse(resp);
  if (datos[0]==null || datos==0) {

  } else {
    var html = '';
    $.each(datos, function(i, item) {
      html += "<div class='row' id='key'>";
      html += "<div class='col-xs-3'>";
      html += " <input type='text' id='idturnos' value='"+item.idturno+"'hidden ><br>";
      html += " <label class='form-control' style='border-radius: 5px;' >"+item.turno_nombre+"</label>";
      html += "</div>";
      html += "<div class='col-xs-3'>";
      html += " <label >Hora Inicio</label>";
      html += "<input type='time' class='form-control' id='horaInicio' value='"+item.inicioHora+"' style='border-radius: 5px; background-color: #e7e7e7;' ><br>";
      html += "</div>";
      html += "<div class='col-xs-3'>";
      html += " <label >Hora Final</label>";
      html += "<input type='time' class='form-control' id='finalHora' value='"+item.finHora+"' style='border-radius: 5px; background-color: #e7e7e7;' ><br>";
      html += "</div>";
      html += "<div class='col-xs-3'>";
      html += "<button class='btn btn-secondary' id='removeRow' style='margin-top: 25px;border-radius: 5px;' ><em class='fa fa-close'></em></button><br> ";
      html += "</div>";
      html += "</div>";
            });
        $("#componeteTurnos").append(html);
        
       }
  })

}

//VER TURNOS DEL GRADO
$('#tabla_yearScolar').on('click', '.verturno', function() {
  var data = table.row($(this).parents('tr')).data();
  
  if (table.row(this).child.isShown()) {
      var data = table.row(this).data();

  }
  $("#nombryear").html(data.yearScolar);//SUBIENDO NOMBRE DEl AÑO A LA VISTA
  listar_Turnos(data.id_year);
})

var turnostab
function listar_Turnos(idyear) {
    turnostab = $("#yearScolar_turnos").DataTable({
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
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/configuracion/configuracion_TurnoYear.php",
            type: 'POST',
            data:{idyear:idyear}
        },
        "columns": [{
            "data": "turno_nombre" },
             {"data": "inicioHora" },
              {"data": "finHora"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("yearScolar_turnos_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
       
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
}


//VER TURNOS DEL GRADO
$('#tabla_yearScolar').on('click', '.Activar', function() {
  var data = table.row($(this).parents('tr')).data();
  
  if (table.row(this).child.isShown()) {
      var data = table.row(this).data();
      var idyear=data.id_year;
      var fechafin = data.fechafin;
       var yearScolar = data.yearScolar;
     }
    //if(data.stadoyear=='ACTIVO'){ return}

    var idyear=data.id_year;
    var fechafin = data.fechafin;
    var stado='ACTIVO';
    var yearScolar = data.yearScolar;

     Swal.fire({
        title: 'Esta seguro de ACTIVAR  el año acedémico?',
        text: "Una vez hecho esto No podras deactivar Hasta completar la fecha ("+fechafin+")",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#05ccc4',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.value) {
          Modificar_Estatus_Year_Activar(idyear,stado,yearScolar);
        }
    })
    
  })


//VER TURNOS DEL GRADO
$('#tabla_yearScolar').on('click', '.Desactivar', function() {
  var data = table.row($(this).parents('tr')).data();
  
  if (table.row(this).child.isShown()) {
      var data = table.row(this).data();
      var idyear=data.id_year;
      var fechafin = data.fechafin;
       var yearScolar = data.yearScolar;
     }
    var idyear=data.id_year;
    var fechafin = data.fechafin;
     var yearScolar = data.yearScolar;
    var stad='INACTIVO';
    Swal.fire({
        title: 'Esta seguro de INACTIVAR  el año acedémico?',
        text: "Una vez hecho esto No podras activar Hasta completar la fecha ("+fechafin+")",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#05ccc4',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.value) {
         Modificar_Estatus_Year_Desactivar(idyear,stad,yearScolar);
        }
    })

 
  })


function Modificar_Estatus_Year_Activar(idyear,stad,yearScolar) {
    $.ajax({
        "url": "../controlador/configuracion/controlador_modificar_estatus_Year.php",
        type: 'POST',
        data: {idyear: idyear,stad:stad
        }
    }).done(function(resp) {
        if (resp==1) {
              $("#YearActualActivo").val(idyear);
              $("#nombreYearactivo").html(yearScolar);
              $("#tex_YearActual_").val(yearScolar);
              table.ajax.reload();
             Swal.fire({ icon: 'success', title: 'Se Activo el Año', text: 'Se activo el año escolar  con éxito!!',showConfirmButton: false, timer: 1500});
             
        }else{
          return Swal.fire("Mensaje De Advertencia", "Ya tienes un año adémico Activado Espere que cumpla el plazo para cambiar"+resp+""  , "warning");
        }

    })
}

function Modificar_Estatus_Year_Desactivar(idyear,stad,yearScolar) {
    $.ajax({
        "url": "../controlador/configuracion/controlador_modificar_estatus_Year.php",
        type: 'POST',
        data: {idyear: idyear,stad:stad
        }
    }).done(function(resp) {
        if (resp==1) {
              $("#YearActualActivo").val('');
              $("#nombreYearactivo").html('');
              $("#tex_YearActual_").val('');
            table.ajax.reload();
            listar_combo_AnioActiveWiev();
            Swal.fire({ icon: 'success', title: 'Se INACTIVO el Año escolar', text: 'Se  INACTIVO el año escolar  con éxito!!',showConfirmButton: false, timer: 1500});
            
        }else{
          return Swal.fire("Mensaje De Advertencia", "Ya tienes un año adémico Activado Espere que cumpla el plazo para cambiar"+resp+""  , "warning");
        }

    })
}


//COMBO DE AÑO ESCOLAR
    function listar_combo_AnioActiveWiev() {
     $("#nombreYearactivo").html("<i class='fa fa-spin fa-refresh'></i>");
     $.ajax({
      "url": "../controlador/configuracion/configuracion_extrae_AnioActivo.php",
      type: 'POST'
    }).done(function(resp) {
      var data = JSON.parse(resp);
      if(data.length>0){
        $("#YearActualActivo").val(data[0]['id_year']);
        $("#nombreYearactivo").html(data[0]['yearScolar']);
        $("#tex_YearActual_").val(data[0]['yearScolar']);
      }
      else{
        var html = '';
        html += "<div class='' style='border-color: #f5c6cb; ' >";
        html += "<div  class='alert  sm' role='alert' style='color: #721c24; background-color: #f8d7da;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
        html += "No se encontró ninguan año academico Aperturado ";
        html += "<strong> ! ACTIVO </strong> para este año !!";
        html += " </div>";
        html += "</div>";

        $("#Notificaciones_year").html(html);

      }  

    })
  }


function XMLHttpRequestAsycn(Request){
 if (Request > 0) {

    if(Request==1){
    
      $('.loader').hide();////prende
       $('#button_resgist').prop('disabled',false);
     Swal.fire({ icon: 'success', title: 'Nuevo Año Escolar', text: 'El Registro, se registró con éxito!!',showConfirmButton: false, timer: 1500});
        table.ajax.reload();
        LimpiarRegistroYear();
    }
    if(Request==100){
       
        $('.loader').hide();////prend
       $('#button_resgist').prop('disabled',false);
        return Swal.fire("Mensaje De Advertencia", "El Registro Similar(Igual) a esto ya  Existe"  , "warning");
    }
    if (Request==404) {
     
     $('#button_resgist').prop('disabled',false);
      window.location = "NotFound";
    } 
    if (Request==401) {
     window.location = "NotFound";} 
  
   } else {
     $('.loader').hide();////prende
      $('#button_resgist').prop('disabled',false);
       return Swal.fire("Mensaje De Error", "No se registro Registro Fallido!!"+Request+""  , "error"); 
 }
}
