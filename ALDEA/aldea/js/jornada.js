function addDivdeHoras(){
  var hInicio =$("#iniciohora").val();
  var hFin =$("#horafinid").val();
 
  if( (limiteFecha(hFin)==true) && (comparafecha(hInicio,hFin)==true) && (VerrificarHorasFinal(hFin)==false)){
  var row_add ="";
             row_add += " <div class='col-xs-12' id='key'>";
             row_add += "<div class='col-xs-6'>";
             row_add += " <input type='time' class='form-control' disabled id='horaInicio' value= '"+hInicio+"' ><br>";
             row_add += "</div>";
             row_add += "<div class='col-xs-6'>";
             row_add += "<div class='alin_global'>";
             row_add += "<input type='time' class='form-control' disabled id='finalHora'  value='"+hFin+"' ><br>";
             row_add += "&nbsp;&nbsp;<button class='btn btn-secondary btn-sm' id='removeRow' ><em class='fa fa-close'></em></button><br> ";
             row_add += "</div>";
             row_add += "</div>";
         
             row_add += "</div>";

          $('#componeteHoras').append(row_add);
          $("#horafinid").val(''); 
  }else{return;}
          
}

function comparafecha(inicio,final){
 let hinicio = new Date();
 hinicio.setHours(inicio.split(":")[0]);
  hinicio.setMinutes(inicio.split(":")[1]);
  let bDinicio = new Date(hinicio);

  let filah = new Date();
  filah.setHours(final.split(":")[0]);
  filah.setMinutes(final.split(":")[1]);
 let bDfinal = new Date(filah);

  if(bDinicio.getHours()<bDfinal.getHours()){
   return true;  
  }
  if(bDinicio.getHours()==bDfinal.getHours()){
  if(bDinicio.getMinutes()<bDfinal.getMinutes()){

      return true;
     }
     alert('La hora deben ser Mayor a :!'+ inicio);
  }else{
       return Swal.fire("Mensaje De Advertencia", "Las horas debe estar entre "+inicio +" y "+ final+"", "warning");
    }
}

 function limiteFecha(hFin){
   var fechlimit =$("#finalfornada").val();

   if(fechlimit.length>0){
   let finigres = new Date();
   finigres.setHours(hFin.split(":")[0]);
   finigres.setMinutes(hFin.split(":")[1]);
   let bDingref = new Date(finigres);

   let fLiite = new Date();
   fLiite.setHours(fechlimit.split(":")[0]);
   fLiite.setMinutes(fechlimit.split(":")[1]);
   let bDLimite = new Date(fLiite);

   if(bDingref.getHours()<bDLimite.getHours()){
     return true;
   }
   if(bDingref.getHours()==bDLimite.getHours()){
     if(bDingref.getMinutes()<=bDLimite.getMinutes()){
        return true;
       }
        alert('La hora deben ser menor a : !'+fechlimit);
   }else{return Swal.fire("Mensaje De Advertencia", "Las horas debe estar menor a: "+fechlimit+"", "warning");}

   }
}

var harrayInicio =new Array();
var hfinalarray =new Array();
 var  ftem ;

function VerrificarHorasFinal(hFin){
  if(hfinalarray!=null){
     ftem = hfinalarray.filter((item) => item ==hFin);
      if(ftem.length <=0){
         hfinalarray.push(hFin);
        $("#iniciohora").val(hfinalarray.pop()).trigger("change");
         return false;
      }else{
       return true;
     }
 }
}

$(document).on('click', '#removeRow', function () {
$(this).closest('#key').remove();
receteraArrays();
});
function receteraArrays(){
  harrayInicio=[]; hfinalarray=[];
   $("#componeteHoras input[id='horaInicio']").each(function() {
         if($(this).val()){
           harrayInicio.push($(this).val());
         }
    });
   // alert(harrayInicio.shift());
   $("#componeteHoras input[id='finalHora']").each(function() {
         if($(this).val()){
           hfinalarray.push($(this).val());
         } 
    });
   var hInicio =$("#iniciofornada").val();
   const last = hfinalarray[hfinalarray.length - 1];
   $("#iniciohora").val(last !=null ? last:hInicio);
 
}

 //COMBO DE AÑO ESCOLAR EN LA VISTA JORNADAS
 async function listar_combo_EscolarAsync(year,turnActual) {
    var identi='';var nameCombo="--seleccione--";
    $.ajax({
        "url": "../controlador/fasescolar/configuracion_listarYear.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {

              cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {
                 data[i][1]==year ? 
                cadena += "<option value='" + data[i][0] + "' selected>" + data[i][1] + "</option>":
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
            $("#cbm_year").html(cadena);
            var idyear=$("#cbm_year").val();
            Lista_combo_Turnos(idyear,turnActual);

        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#cbm_year").html(cadena);
        }
    })
}

//LISTAR TURNOS DEL AÑO ESCOLAR EN LA VISTA JORNADAS
var dataTem;
async function Lista_combo_Turnos(idyear,turnActual){
  var identi='';var nameCombo="--seleccione--";
  if(idyear==0 || idyear ==''){return;}
    $.ajax({
        "url": "../controlador/jornada/controlador_combo_tunos.php",
        type: 'POST',
        data: {idyear:idyear}
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
          
          editando==true? $('#combo_turnos').prop('disabled',true): $('#combo_turnos').prop('disabled',false);
         
          dataTem = data;
            cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
          
            for (var i = 0; i < data.length; i++) {

              data[i]['turno_nombre']==turnActual ? 
                cadena += "<option value='" + data[i]['turno_id'] + "' selected>" + data[i]['turno_nombre'] + "</option>":
                cadena += "<option value='" + data[i]['turno_id'] + "'>" + data[i]['turno_nombre'] + "</option>";
              }
             $("#combo_turnos").html(cadena);

        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#combo_turnos").html(cadena);
        }
    })
}

//TRAENDO HORAS DEL TURNO QUE SELECCIONA EL SUSUARIO
 async function Extraer_Horas_combo_Turnos(id){
   linpiarJornadas();
       let data = dataTem.filter(item => item.turno_id == id);
        let temhor=data[0]['inicioHora'];
       var log_hora = temhor.length==8 ? temhor.slice(0, -3):temhor;
       $("#iniciofornada").val(log_hora);
       $("#finalfornada").val(data[0]['finHora']);
       $('#iniciohora').val(log_hora);
}

var temturno;
//idgrado, gradonombre,nivel_id,nombreNivell,seccion,aula_id,nombreaula
async function listar_combo_nivelesAsync(gradoid) {
  var identi='';var nameCombo="--seleccione--";

    $.ajax({
        "url": "../controlador/jornada/controlador_combo_grados.php",
        type: 'POST'
    }).done(function(resp) {
          
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
       temturno=data;
          
          cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {

               if(data[i][0]==gradoid){
                 cadena += "<option value='" + data[i][0] + "' selected>" + data[i][1] +"&nbsp;, NIVEL:"+ data[i][3] +"&nbsp;, SECC:"+ data[i][4] +"&nbsp;,AULA:"+ data[i][6] +"</option>";
                 Turnos_Del_GradoSelecionado(data[i][0]);
               }else{
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] +"&nbsp;, NIVEL:"+ data[i][3] +"&nbsp;, SECC:"+ data[i][4] +"&nbsp;, AULA:"+ data[i][6] + "</option>";
               }  
            }
             $('#cbm_niveles').html(cadena);////lamndo en vista matricul
           
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#cbm_niveles").html(cadena);
        }
    })
}

function Turnos_Del_GradoSelecionado(idgrado){
  let data = temturno.filter(item => item.idgrado == idgrado);
  let idnivel=data[0]['nivel_id'];
  let nombreNivel=data[0]['nombreNivell'];
  let seccion=data[0]['seccion'];
  let aula=data[0]['nombreaula'];

  $("#id_GradosNivel").val(idnivel);
  $("#txt_NombreNivelGrado").val(nombreNivel+" | "+seccion+"  | "+aula);
  $("#txt_seccion").val(seccion);
  $("#idaula_text").val(data[0]['aula_id']);
}



async function linpiarJornadas(){

  $('#componeteHoras').html("");
   $("#componeteHoras input[id='horaInicio']").each(function() {
       $("#horaInicio").val("");
    });
   $("#componeteHoras input[id='finalHora']").each(function() {
       $("#finalHora").val("");
    });
}

var editando=false;
async function CancelarJornadas(){
  harrayInicio=[]; hfinalarray=[];
  $('#componeteHoras').html("");
  $("#DivFromJornadas").hide();
  editando=false;
  dataTem="";
  $("#text_idjornada").val("");
  

  $('#cbm_niveles').val(0).trigger('change');
  $('#combo_turnos').val(0).trigger('change');
   
   $("#id_GradosNivel").val("");
  $("#txt_NombreNivelGrado").val("");
  $("#iniciofornada").val("");
  $("#finalfornada").val("");
  $("#iniciohora").val("");

   $("#horaInicio").val("");
   $('#combo_turnos').prop('disabled',true);
   $('#cbm_year').prop('disabled',false);

   $("#finalHora").val("");

  $("#tablajornadas_Div").show();
}

//lista de grados en combo select  Y NIVELES



function From_registro_horas(){
   $("#tablajornadas_Div").hide();
    listar_combo_EscolarAsync();
    listar_combo_nivelesAsync();
    $("#DivFromJornadas").show();
}


//REGISTRAR JORNADAS
function Registrar_Fornadas(){
 harrayInicio=[];hfinalarray=[];
 var idejorna=$("#text_idjornada").val();
 var idyear =$("#cbm_year").val();
 var turno =$("#combo_turnos").val();
 var nivelacade =$("#cbm_niveles").val();
 var inicioacde =$("#iniciofornada").val();
 var fialacde =$("#finalfornada").val();
 var id_GradosNivel =$("#id_GradosNivel").val();
  var seccion =$("#txt_seccion").val();
  var idaula =$("#idaula_text").val();

 $("#componeteHoras input[id='horaInicio']").each(function() {
   if($(this).val()){
     harrayInicio.push($(this).val());
   } 
 });
 $("#componeteHoras input[id='finalHora']").each(function() {
   if($(this).val()){
     hfinalarray.push($(this).val());
   }
 });

   var inicios = harrayInicio.toString(); //
   var finales = hfinalarray.toString(); //

   if(inicioacde.length==0 || fialacde.length==0 ||turno.length==0 ||nivelacade.length==0 || idyear.length==0){
     return Swal.fire("Mensaje De Advertencia", "Llene los campos vacíos son Requerido para la correcta configuración!", "warning");
   }

   if(inicios.length !=finales.length || inicios.length==0 ||finales.length==0){
    return Swal.fire("Mensaje De Advertencia", "Por lo menos divide las hora en dos dimensiones para registro sea Éxitoso", "warning");
  }
  $('#btn_registra').prop('disabled',true);
      $('.loader').show();////prende

      $.ajax({
        url: editando === false ? "../controlador/jornada/controlador_registrar_jornadas.php":"../controlador/jornada/controlador_Update_jornada.php",
        type: 'POST',
        data: {
          idejorna:idejorna, idyear:idyear, turno:turno,nivelacade:nivelacade,inicioacde:inicioacde,
          fialacde:fialacde, inicios:inicios,finales:finales, id_GradosNivel:id_GradosNivel,seccion:seccion,idaula:idaula
        }
      }).done(function(Request) {
       XMLHttpRequestAsycn(Request);
     })
    }

  function XMLHttpRequestAsycn(Request){
  if (Request > 0) {

    if(Request==1){
    
      $('.loader').hide();////prende
       $('#btn_registra').prop('disabled',false);
       $("#tablajornadas_Div").show();
      $("#DivFromJornadas").hide();
      CancelarJornadas();
        
        tablejorada.ajax.reload();
        Swal.fire({ icon: 'success', title: 'Éxito !!', text: 'El Registro, se registro  de forma Éxitoso!! ',showConfirmButton: false, timer: 1700});  
    }
    if(Request==100){
       
        $('.loader').hide();////prend
       $('#btn_registra').prop('disabled',false);
      
        return Swal.fire("Mensaje De Advertencia", "Las horas Académicos Para los parametros Seleccionados ya  Existe!!, si deseas modificarlo puedes editarlo"  , "warning");
    }
    if (Request==404) {
     
     $('#btn_registra').prop('disabled',false);
   
      window.location = "NotFound";
    } 
    if (Request==401) {
     window.location = "NotFound";
   }if (Request==504) {
         //////////////////////////////////////
   ///EXPLICAR POQUE YA NO SE PUEDE EDITAR
  alert(504);
   //////////////////////////////////
      return;

    } if (Request==0) {
       $('.loader').hide();////prende
      $('#btn_registra').prop('disabled',false);
    
     return Swal.fire("Mensaje De Error", "No se registro Registro Fallido!!"+Request+""  , "error");

    } 
  
   } else {
     $('.loader').hide();////prende
    $('#btn_registra').prop('disabled',false);
    
     return Swal.fire("Mensaje De Error", "No se registro Registro Fallido!!"+Request+""  , "error"); 
 }
}


//LISTAR JORNADAS HORARIOS AÑO ESCOLAR

var tablejorada;
function listar_jornadas_Horas() {
  var yearid = $("#YearActualActivo").val();
 // if (yearid == null || yearid==0 || !yearid || yearid.length == 0) {console.log('NotData_Request');return;}
    tablejorada = $("#tabla_jornadas").DataTable({
        "ordering": false,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },
        "responsive": true,
         "dom":'Bfrtilp',
       
        buttons:[{
                extend:    'copy',
                text:      '<i class="fa  fa-copy"></i> ',
                titleAttr: 'Exportar a copy'
            },
            { extend:    'print',
                text:      '<i class="fa fa-print"></i> ',
                titleAttr: 'Imprimir'
            },],

        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/jornada/controlador_listar_jornadas.php",
            type: 'POST',
            data:{yearid:yearid}  
        },
        "columns": [
           { "data": "IdJornas"},
           { "data": "yearScolar" }, 
           { "data": "turno_nombre" }, 
           {"data": "gradonombre"},
           {"data": "nombreNivell"},
           {"data": "seccionjor"},
           {"data": "Horainicio"},
           {"data": "horafinal"},
           {
            "defaultContent": "<button  type='button' class='editJornad btn btn-primary btn-sm'><i class='fa fa-edit' title='editar'></i></button>"+
            "&nbsp;<button type='button' class='verHoras btn btn-default btn-sm'><em class='fa fa-eye-slash' title='Ver Horas'></em></button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("tabla_jornadas_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
     tablejorada.column( 0 ).visible( false );
$('#btn-place').html(tablejorada.buttons().container()); 

}

function filterGlobal() {
    $('#tabla_jornadas').DataTable().search($('#global_filter').val(), ).draw();
}

$('#tabla_jornadas').on('click', '.editJornad', function() {
    var data = tablejorada.row($(this).parents('tr')).data();
     editando=true;
    if (tablejorada.row(this).child.isShown()) {
        var data = tablejorada.row(this).data();
        var idjornada=data.IdJornas;
    }
       var idjornada=data.IdJornas;
        $("#tablajornadas_Div").hide();
        listar_combo_EscolarAsync(data.yearScolar,data.turno_nombre);
        listar_combo_nivelesAsync(data.gradoid);
        $("#DivFromJornadas").show();
         $("#text_idjornada").val(data.IdJornas);
         $("#iniciofornada").val(data.Horainicio);
         $("#finalfornada").val(data.horafinal);
         $('#cbm_year').prop('disabled',true);
          $('#combo_turnos').prop('disabled',true);
        
         Extraer_Jornadas_turno(idjornada);
})

async function Extraer_Jornadas_turno(idjornada){
   
    $.ajax({
        "url": "../controlador/jornada/controlador_Extraer_Horas.php",
        type: 'POST',
        data:{idjornada:idjornada}
    }).done(function(resp) {
      var data = JSON.parse(resp);
      if (data[0]==null || data==0) {
        var hInicio =$("#iniciofornada").val();
       
       var corectoh=hInicio.length==8 ? hInicio.slice(0, -3):hInicio;

        $("#iniciohora").val(corectoh);
      } else {
         
        var html = '';
             $.each(data, function(i, item) {

             html += " <div class='col-xs-12' id='key'>";
             html += "<div class='col-xs-6'>";
             html += " <input type='time' class='form-control' disabled  id='horaInicio' value= '"+item.Hora_inicio+"'><br>";
             html += "</div>";
             html += "<div class='col-xs-6'>";
             html += "<div class='alin_global'>";
             html += "<input type='time' class='form-control'  disabled id='finalHora'  value='"+item.hora_final+"'><br>";
             html += "&nbsp;&nbsp;<button class='btn btn-secondary btn-sm' id='removeRow' ><em class='fa fa-close'></em></button><br> ";
             html += "</div>";
             html += "</div>";
             html += "</div>";

              });
             $('#componeteHoras').append(html);
             var hInicio =$("#iniciofornada").val();
             const last = data[data.length - 1];
            var longhora = last.hora_final !=null ? last.hora_final:hInicio;
             $("#iniciohora").val(longhora.length==8 ? longhora.slice(0, -3):longhora);
        } 
    })

}


//FUNCION PARA vER HORARIO QUE NO ESTA EN OPERACION
$('#tabla_jornadas').on('click', '.verHoras', function() {
    var data = tablejorada.row($(this).parents('tr')).data();
    if (tablejorada.row(this).child.isShown()) {
        var data = tablejorada.row(this).data();
        var idjornada=data.IdJornas;
         var idjornada=data.IdJornas;
        }
        var idjornada=data.IdJornas;
        $("#jornada_turnos").html(data.turno_nombre);
        $("#grado_jornada").html(data.gradonombre);
         $("#nivel_jornada").html(data.nombreNivell);
         abrir_modal_horas(idjornada);
})

function abrir_modal_horas(idjornada){
   $("#HorasJornada_modal_View").modal({
        backdrop: 'static',
        keyboard: false
    })
     $(".modal-header").css("background-color", "#05ccc4");
    $(".modal-header").css("color", "white");
    $("#usuario_modal_registro").modal('show'); 

     $.ajax({
        "url": "../controlador/jornada/controlador_Extraer_Horas.php",
        type: 'POST',
        data:{idjornada:idjornada}
        }).done(function(resp) {
        var data = JSON.parse(resp);
         if (data[0]==null || data==0) {
          $('#tbody_tabla_detall').html('<br><center> NO TIENES HORA AGREGADAS !!</center>');
         } else {
         var datos_add ="";
          data.forEach(valor => {
          datos_add +=  "<tr>";  
          datos_add += "<td align='center'>"+valor.Hora_inicio+"</td>";
           datos_add += "<td align='center'>"+valor.hora_final+"</td>";
           datos_add += "</tr>";
          })
          $('#tbody_tabla_detall').html(datos_add);
       
      }
    })
}

