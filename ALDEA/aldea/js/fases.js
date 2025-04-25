
////////////////////////////////////////////
// MODULO FASES ESCOLAR
///////////////////////////////////editFase
//FASE SCOLAR

  var editFase=false;
  function AbrirModalRegistro_Fase(){
   $('#btn_registrar').prop('disabled',false);
    $('#fechainiregular').prop('disabled',false);
    $('#iniciofecrecupe').prop('disabled',false);
    $('#fechafinregular').prop('disabled',false);
    $('#finalfecrecupe').prop('disabled',false);
   $('#buttNew').hide();
  }

//LISTAR FASES DEL AÑO ESCOLAR

var fechasYear;
function Extraer_Fase_DelYear(){
var idyear  = $("#YearActualActivo").val();
var nonbreYearActual  = $("#tex_YearActual_").val();


if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}

  $("#nombryear").html(nonbreYearActual);//SUBIENDO EL NOMBRE A LA VISTA
  $("#NombreEnFrom").val(nonbreYearActual);//SUBIENDO EL NOMBRE A LA VISTA

$.ajax({
        "url": "../controlador/fasescolar/configuracion_extraerFases.php",
        type: 'POST',
        data:{idyear:idyear} 
    }).done(function(resp) {
        var data = JSON.parse(resp);
       
        if (data.length > 0) {
           fechasYear=data
          $("#buttEdit").show();
           $("#butt_quitar").show();
           $('#buttNew').prop('disabled',true);
           VerificarRangoDeFechaParaCrearFases(data[0]['id_year']);
          recorerresultado_data(data);
             
        } else {
           $("#buttEdit").hide();
           $("#butt_quitar").hide();
            $('#buttNew').prop('disabled',false);
             var datos_add ="";
            datos_add +=  "<tr><td ></td><td><label>NO HAY FASES PARA ESTE AÑO ESCOLAR</label></td></tr>";  
         $("#tbody_tabla_detall").html(datos_add);
        }
    })
}

//FILTRAR FECHAS DEL VETOR LAS FECHA DEL AÑO ESCOLAR
function VerificarRangoDeFechaParaCrearFases(id){
 let data = fechasYear.filter(item => item.id_year == id);
  let fechaInicio=data[0]['fechainicio'];
  let fecha_final=data[0]['fechafin'];
  $("#fechaInicioYear").val(fechaInicio);
$("#fechaFinalYear").val(fecha_final);
}



//RECORER SI EXISTE
function recorerresultado_data(data){ 
   var datos_add ="";
      data.forEach(valor => {
        datos_add +=  "<tr>";  
        datos_add += "<td >"+valor.fase_nombre+"</td>";
        datos_add += "<td >"+valor.FechaInicial+"</td>";
        datos_add += "<td >"+valor.FechaFinal+"</td>";
                  if(valor.stdfase=='ACTIVO'){
                     datos_add += "<td ><span class='label label-success'>"+valor.stdfase+"</span></td>";
                 }else{
                     datos_add += "<td ><span class='label label-default'>"+valor.stdfase+"</span></td>";
                 }
      
        datos_add += "</tr>";
       })
      $('#tbody_tabla_detall').html(datos_add);

}

//REGISTRAR FASE ESCOLAR
var fases=Array();
function Registrar_faseEscolar(){
  var inicios=Array();
  var finales=Array();

  $(".grupoFasesin input[type='date']").each(function() {
  if($(this).val()){
     inicios.push($(this).val());
   }
   });
    $(".faseGrupo_fil input[type='date']").each(function() {
     if($(this).val()){
     finales.push($(this).val());
   }
   });
    fases=['FASE REGULAR','FASE RECUPERACION'];
    var year  = $("#YearActualActivo").val();
    if (year == null || year==0 || !year || year.length == 0) { alert('Not Year Active');console.log('NotData_Request');return;}

    if(inicios.length==0 ||finales.length==0 ){
     return Swal.fire("Mensaje De Advertencia", "Es obligatorio Poner las Fechas Gracias!!", "warning");
    }

    if(inicios.length !=finales.length ||  inicios.length !=fases.length || fases.length!=finales.length){
       $('#cont_horas_error').removeClass('form-group').addClass('form-group has-error');
     return ;
    }


     $('#btn_registrar').prop('disabled',true);
      $('.loader').show();////prende
    $.ajax({
     url: editFase === false ? "../controlador/fasescolar/configuracion_registrarfase.php" : "../controlador/fasescolar/configuracion_updateFase.php",
        type: 'POST',
        data:{year:year,
            fases:fases.toString(),
            inicios:inicios.toString(),
            finales:finales.toString()
          }
      }).done(function(Request) {
        XMLHttpRequestAsycn(Request);
    })
}

 //QUITAR PERIO SI TODAVIA NO TIENE CALIFICACIONES

  function Quitar_periodo_Fase(){
    var idyear  = $("#YearActualActivo").val();
    $.ajax({
        "url": "../controlador/fasescolar/controlador_Quitat_fase.php",
        type: 'POST',
        data:{idyear:idyear}
    }).done(function(Request) {
      if (Request>0) {
          $('#buttNew').prop('disabled',false);
          $("#buttEdit").hide();
          $("#butt_quitar").hide();
           $("#nombryear").html('');
        XMLHttpRequestAsycn(Request);

      }else{

//AQUI EXPLICAR PORQUE NO SE PUEDE ELIMINAR


}
       
    })
  }

///FUNCIONES DE MENSAJE

  function XMLHttpRequestAsycn(Request){
  if (Request > 0) {
    if(Request==1){
      $('.loader').hide();////prende
        Swal.fire({ icon: 'success',title: 'Datos correctamente, Nuevo Fase Escolar', showConfirmButton: false,timer: 1500 });
       Extraer_Fase_DelYear();
        LimpiarRegistroFase();
        return;
    }
    if(Request==100){
       
        $('.loader').hide();////prend
      
      LimpiarRegistroFase();
        return Swal.fire("Mensaje De Advertencia", "El Registro Similar(Igual) a esto ya  Existe"  , "warning");
    }
    if (Request==404) {
     
    
     LimpiarRegistroFase();
      window.location = "NotFound";
      return;
    } 
    if (Request==401) {
     window.location = "NotFound"; 
     return;
   }  
   //////////////////////////////////////
   ///EXPLICAR POQUE YA NO SE PUEDE EDITAR

   //////////////////////////////////
   if (Request==504) {
        $('#cont_horas_error').removeClass('form-group has-error').addClass('form-group');
      LimpiarRegistroFase();
      return;

    } else {
     $('.loader').hide();////prende
   
    $('#cont_horas_error').removeClass('form-group has-error').addClass('form-group');
      LimpiarRegistroFase();
      return   Swal.fire("Mensaje De Error", "No se registro Registro Fallido!!"+Request+""  , "error"); 
 }
}
}


//limpiarModal

function LimpiarRegistroFase(){
 $("#idfase").val("");
 $("#cbm_year").val("");
 $("#fechainiregular").val("");
 $("#iniciofecrecupe").val("");
 $("#fechafinregular").val("");
 $("#finalfecrecupe").val("");
   $('#cont_horas_error').removeClass('form-group has-error').addClass('form-group');
  editFase= false;	
  $('#buttNew').show();
  $('#btn_registrar').prop('disabled',true);
  $('#fechainiregular').prop('disabled',true);
    $('#iniciofecrecupe').prop('disabled',true);
    $('#fechafinregular').prop('disabled',true);
    $('#finalfecrecupe').prop('disabled',true);
}


//FUNCION EDITAR FASE
function editar_Fase_Escolar(){
    var idyear  = $("#YearActualActivo").val();
    $.ajax({
     url: '../controlador/fasescolar/configuracion_fasesShow.php',
     type:'POST',
       data:{idyear:idyear}
     }).done(function(resp) {
     var data = JSON.parse(resp);
     var i=0
     if(data.length>0){
      $('#btn_registrar').prop('disabled',false);
      $('#fechainiregular').prop('disabled',false);
      $('#iniciofecrecupe').prop('disabled',false);
      $('#fechafinregular').prop('disabled',false);
      $('#finalfecrecupe').prop('disabled',false);
      $('#buttNew').hide();
       editFase=true;
   // $("#tabla_Yeart").hide();
       $("#fechainiregular").val(data[i]['FechaInicial']);
       $("#iniciofecrecupe").val(data[i+1]['FechaInicial']);
       $("#fechafinregular").val(data[i]['FechaFinal']);
       $("#finalfecrecupe").val(data[i+1]['FechaFinal']);
        }
        else{
      alert("NO HAY NADA PARA EDITAR");
     }
  });
}

