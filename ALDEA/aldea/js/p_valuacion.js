
////////////////////////////////////////////
//MODULO FASE DE EVALUACION//////cbm_year
///////////////////////////////////

//LISTAR PERIODOS DE EVALUACION DEL AÑO ESCOLAR

function verSusPeriodosDeEvaluacion(){
var yearid  = $("#YearActualActivo").val();

if (yearid == null || yearid==0 || !yearid || yearid.length == 0) {console.log('NotData_Request');return;}
var nonbreYearActual  = $("#tex_YearActual_").val();

  $("#yaernombreEv").html(nonbreYearActual);//SUBIENDO EL NOMBRE A LA VISTA
  $("#NombreEnFrom").val(nonbreYearActual);//SUBIENDO EL NOMBRE A LA VISTA

 $.ajax({
        "url": "../controlador/periodo/controlador_listar_periodosEv.php",
        type: 'POST',
        data:{yearid:yearid} 
    }).done(function(resp) {
        var data = JSON.parse(resp);
        if (data.length > 0) {
          $('#buttNew').prop('disabled',true);
          $("#buttEdit").show();
           $("#butt_quitar").show();
          recorerresultado_data(data);
             
        } else {
           $("#buttEdit").hide();
            $("#butt_quitar").hide();
            $('#buttNew').prop('disabled',false);
             var datos_add ="";
            datos_add +=  "<tr><td ></td><td><label>NO HAY PERIODOS DE EVALUACION</label></td></tr>";  
         $("#tbody_tabla_detall").html(datos_add);
        }
    })
}
//ABILITAR FROMULARIOS
async function Abilitar_Form_registro(){

 $('#periodovaluacion').prop('disabled',false);
 $('#btn_registra').prop('disabled',false);
  $('#buttNew').hide();
  listar_combo_tipos_Evaluacion();

}

//RECORER PERIODOS DE EVALUACION DEL ANO ACTUAL ENCONTRADO
function recorerresultado_data(data){ 
   var datos_add ="";
   let cont=1;
      data.forEach(valor => {

        datos_add +=  "<tr>";  
        datos_add += "<td >"+""+cont+"_° "+valor.tipo_nombre+"</td>";
        datos_add += "<td >"+valor.fech_inicio+"</td>";
        datos_add += "<td >"+valor.fech_final+"</td>";
        datos_add += "</tr>";
        cont ++;
       })
      $('#tbody_tabla_detall').html(datos_add);

}


  var editperiodo=false;
 //REGISTRAR PERIODEO DE EVALUACION
  function Registrar_pEvaluacion(){
       var finicioPeriodo = new Array();
       var ffinPeriodo = new Array();
      var yearescolar  = $("#YearActualActivo").val();

       if (yearescolar == null || yearescolar==0 || !yearescolar || yearescolar.length == 0) { alert('Not Year Active');console.log('NotData_Request');return;}

      $("#id_Componente_Dates input[id='fechaInicioPeriodo']").each(function() {
         if($(this).val()){
         finicioPeriodo.push($(this).val());
          }
      });
      $("#id_Componente_Dates input[id='fechaFinPeriodo']").each(function() {
         if($(this).val()){
         ffinPeriodo.push($(this).val());
          }
      });

       if(ffinPeriodo.length==0 ||finicioPeriodo.length==0){
         return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
      }
      if(finicioPeriodo.length !=ffinPeriodo.length || tipoEvaluacioIds.length !=ffinPeriodo.length || tipoEvaluacioIds.length !=finicioPeriodo.length ){

       $('#cont_horas_error').removeClass('form-group').addClass('form-group has-error');
        return;
      }


  $('#btn_registra').prop('disabled',true);
      $('.loader').show();////prende

       $.ajax({
        url: editperiodo === false ? "../controlador/periodo/controlador_periodoRegistro.php":"../controlador/periodo/controlador_UpdatePeriodo.php",
        type: 'POST',
        data:{
              yearescolar:yearescolar,tipoEvaluacioIds:tipoEvaluacioIds.toString(),
            finicioPeriodo:finicioPeriodo.toString(),ffinPeriodo:ffinPeriodo.toString(),tipoPosiciones:tipoPosiciones.toString()
          }
       }).done(function(Request) {
        XMLHttpRequestAsycn(Request);
    })
    }


 async function listar_combo_tipos_Evaluacion(tipo) {
    var identi=0;var nameCombo="--seleccione--";
    $.ajax({
        "url": "../controlador/periodo/controlador_combo_tipoEva.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
              cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";

            for (var i = 0; i < data.length; i++) {
                data[i]['tipo_id']==tipo ? 
                cadena += "<option value='" + data[i]['tipo_id'] + "' selected>" + data[i]['tipo_nombre'] + "</option>":
                cadena += "<option value='" + data[i]['tipo_id'] + "'>" + data[i]['tipo_nombre'] + "</option>";

            }
            $("#periodovaluacion").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#periodovaluacion").html(cadena);
        }
    })
}

  function LimpiarRegistroperiodo(){
    tipoPosiciones=[];
    tipoPosiciones=[];

   editperiodo=false;
    $("#DivFromPeriodoevalu").hide();
    $("#perioEvaluacion").show();
     $('#id_Componente_Dates').html(''); 
      $('#cont_horas_error').removeClass('form-group has-error').addClass('form-group');
    $('#periodovaluacion').val(0).trigger('change');
    $('#periodocbm_year').prop('disabled',false);
     $('#periodovaluacion').prop('disabled',true);
    $('#btn_registra').prop('disabled',true);
    $('#buttNew').show();
}

//EDITAR PERIO DE EVALUACION
 function Editar_periodo_Eval(){
    var idyear  = $("#YearActualActivo").val();

if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}

   var recupNombre= $("#NombreEnFrom").val();
    $.ajax({
        "url": "../controlador/periodo/controlador_edit_periodos_eval.php",
        type: 'POST',
        data:{idyear:idyear}
    }).done(function(resp) {
      var data = JSON.parse(resp);
      if (data[0]==null || data==0) {

        alert("PRIMERO DEVES REGISTRAR PARA EDITAR !!");
      } else { Recoriendo_Datos_Editar(data); }
    })

  }

  //QUITAR PERIO SI TODAVIA NO TIENE CALIFICACIONES

  function Quitar_periodo_Eval(){
    var idyear  = $("#YearActualActivo").val();

if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}
    $.ajax({
        "url": "../controlador/periodo/controlador_Quitat_evaluacion.php",
        type: 'POST',
        data:{idyear:idyear}
    }).done(function(resp) {
      if (resp>0) {
         if (resp==504) {

           return Swal.fire("Mensaje De Advertencia", "No se Pudo completar la operación..Explicación:Este Periodo de evaluación ya tiene Actividades Registrados para este año escolar activo para su configuracion espere que culmine este año escolar ..Gracias por su atención"  , "warning");
           }
      }else{alert();}
       
    })
  }

///FUNCIONES DE MENSAJE

  function XMLHttpRequestAsycn(Request){
  if (Request > 0) {


    if(Request==1){
    
      $('.loader').hide();////prende
       $('#btn_registra').prop('disabled',false);
            Swal.fire({
                    icon: 'success',
                    title: 'Datos correctamente, Perio de Evaluacion',
                    showConfirmButton: false,
                    timer: 1500
                  });
      verSusPeriodosDeEvaluacion();
        LimpiarRegistroperiodo();
    }
    if(Request==100){
       
        $('.loader').hide();////prend
       $('#btn_registra').prop('disabled',false);
       $('#cont_horas_error').removeClass('form-group has-error').addClass('form-group');
        return Swal.fire("Mensaje De Advertencia", "El Registro Similar(Igual) a esto ya  Existe"  , "warning");
    }
    if (Request==404) {
     
     $('#btn_registra').prop('disabled',false);
     $('#cont_horas_error').removeClass('form-group has-error').addClass('form-group');
      window.location = "NotFound";
    } 
    if (Request==401) {
     window.location = "NotFound";
   } 
     
  
   } else {
     $('.loader').hide();////prende
    $('#btn_registra').prop('disabled',false);
    $('#cont_horas_error').removeClass('form-group has-error').addClass('form-group');
     return Swal.fire("Mensaje De Error", "No se registro Registro Fallido!!"+Request+""  , "error"); 
 }
}



  /////////////////////////////////
    ///RECORIENDO COMPONENTES
  ////////////////////////
  //Vector de Posiciones
  var tipoPosiciones = new Array();
  ///////////////////////
  var tipoEvaluacioIds = new Array();
  function Componentes(id,nombre){
   tipoPosiciones=[];
   tipoEvaluacioIds = [];
   var html ="";
   for (let j = 0; j < id; j++) { 
     tipoEvaluacioIds.push(id);
     tipoPosiciones.push((j+1));

               html += " <div class='col-xs-12' id='key'>";
               html += "<div class='col-xs-4'>";
               html += "<label>"+""+(j+1)+"_° " +nombre+"</label>"; 
               html += "</div>";
               html += "<div class='col-xs-4'>";
               html += "<input type='date' class='form-control' id='fechaInicioPeriodo' ><br>"; 
               html += "</div>";
               html += "<div class='col-xs-4'>";
               html += "<input type='date' class='form-control' id='fechaFinPeriodo' ><br>";
               html += "</div>";
               html += "</div>";
      $('#id_Componente_Dates').html(html);
    }
}

function  Recoriendo_Datos_Editar(data) {
  var recupNombre= $("#NombreEnFrom").val();
        $("#NombreEnFrom").val(recupNombre);
        $('#periodovaluacion').prop('disabled',true);
        $('#periodocbm_year').prop('disabled',true);
        $('#btn_registra').prop('disabled',false);
         editperiodo=true;
        var html = '';
             $.each(data, function(i, item) {
               html += " <div class='col-xs-12' id='key'>";
               html += "<div class='col-xs-4'>";
               tipoEvaluacioIds.push(item.tipo_periodo);
               tipoPosiciones.push((i+Number(1)));

               html += "<label>"+""+(i+Number(1))+"_° " +item.tipo_nombre+"</label>"; 
               html += "</div>";
               html += "<div class='col-xs-4'>";
               html += "<input type='date' class='form-control' id='fechaInicioPeriodo' value='"+item.fech_inicio+"'><br>"; 
               html += "</div>";
               html += "<div class='col-xs-4'>";

               html += "<input type='date' class='form-control' id='fechaFinPeriodo' value='"+item.fech_final+"'><br>";

               html += "</div>";

               html += "</div>";});
             $('#id_Componente_Dates').html(html);
}