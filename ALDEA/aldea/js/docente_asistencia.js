

//idgrado, gradonombre,nivel_id,nombreNivell,seccion
///gradoId, gradonombre,nivel_id,nombreNivell,idseccion
var temturno;
async function Listar_combo_gradosAsistencia() {
  var yearid  = $("#YearActualActivo").val();
 var identi='';var nameCombo="--seleccione--";
 $.ajax({
  "url": "../controlador/docenteSesion/controlador_verGrado_Docente.php",
  type: 'POST',
  data:{yearid:yearid}
}).done(function(resp) {
 var data = JSON.parse(resp);
 var cadena = "";
 if (data.data.length > 0) {
  data=data.data;
   temturno=data;
   cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
   for (var i = 0; i < data.length; i++) {
    
    cadena += "<option value='" + data[i]['gradoId'] + "'>" + data[i]['gradonombre'] + ",&nbsp;" + data[i]['nombreNivell'] +",SECCIÓN:" + data[i]['idseccion'] + "</option>";
  }
  $("#cbm_grado").html(cadena);
  $("#edit_cbm_grado").html(cadena);
  $("#elim_cbm_grado").html(cadena);

} else {
 cadena += "<option value=''>NO HAY GRADOS ACTIVOS</option>";
 $("#cbm_grado").html(cadena);
 $("#edit_cbm_grado").html(cadena);
 $("#elim_cbm_grado").html(cadena);
}

})
}

//FILTRAR NIVELES DEL COMBO GRADOS
async function lista_combo_filtrados(id){
 let desarrolladores = temturno.filter(item => item.gradoId == id)
 $("#txt_nivelId").val(desarrolladores[0]['nivel_id']);
 $("#txt_nivel_nivel").val(desarrolladores[0]['nombreNivell']);
 $("#text_seccion").val(desarrolladores[0]['idseccion']);  

 


} 

async function ShowSelected(){
  var idgrado = $("#cbm_grado").val();
  if(idgrado){
    lista_combo_filtrados(idgrado);
  }
}

//FILTRAR NIVELES DEL COMBO GRADOS
async function lista_combo_filtrados_edit(id){
 let desarrolladores = temturno.filter(item => item.gradoId == id)
 $("#edit_txt_nivelId").val(desarrolladores[0]['nivel_id']);
 $("#edit_txt_nivel_nivel").val(desarrolladores[0]['nombreNivell']);
 $("#edit_text_seccion").val(desarrolladores[0]['idseccion']);  
} 


async function ShowSelected_Edit(){
  var idgrado = $("#edit_cbm_grado").val();
  if(idgrado){
    lista_combo_filtrados_edit(idgrado);
  }
}

async function ShowSelected_Elimi(){
  var idgrado = $("#elim_cbm_grado").val();
  if(idgrado){
    lista_combo_filtrados_Elimiar(idgrado);
  }
}

//FILTRAR NIVELES DEL COMBO GRADOS
async function lista_combo_filtrados_Elimiar(id){
 let desarrolladores = temturno.filter(item => item.gradoId == id)
 $("#elim_txt_nivelId").val(desarrolladores[0]['nivel_id']);
 $("#elim_text_seccion").val(desarrolladores[0]['idseccion']);  

 $("#elim_txt_nivel_nivel_seccion").val(desarrolladores[0]['nombreNivell']+' | '+desarrolladores[0]['idseccion']);
} 


/////////////////////////////////////////////////////////////////////////FUNCION DE ASISTENCIAS/////
////FECHA 12/12/2021////////////

 ////Funcione adidicionales////

 function Black_MenuAsis(){
  $("#DivAsistenciaCrud").show();
  $("#DinNuevoAsistencia").hide();
  $("#EditarDivAsistencia").hide();
  $("#ElimirarDivAsistencia").hide();
  
  $("#tbody_tabla_EditAsis").html("");


  $("#FecahaFin").val('');
  $("#FechaInicio").val('');
  $("#SeachFechaEdit").val("");
  $("#FechaAsistencia").val('');

  $("#txt_nivel_nivel").val('');
  $("#text_seccion").val('');
  $("#edit_txt_nivelId").val('');
  $("#edit_text_seccion").val('');
  $('#cbm_grado').val('').trigger('change');
  $('#elim_cbm_grado').val('').trigger('change');
  $('#edit_cbm_grado').val('').trigger('change');

  $('#edit_button_resgist').prop('disabled',false);

  $('#button_resgist').prop('disabled',false);
  $('#elim_button_resgist').prop('disabled',false);
  $("#elim_txt_nivel_nivel_seccion").val('');
  $("#edit_txt_nivel_nivel").val('');
 $('.loader').hide();////prende

 $("#tbody_tabla_Filtrados").html("");
 $("#tbody_tabla_detall").html("");
 $("#Reportes_asistencia").html("");

}

function Resito_AsistenciaView(){
  $("#DivAsistenciaCrud").hide();
  $("#DinNuevoAsistencia").show();
  Listar_combo_gradosAsistencia();

}

function Editar_AsistenciaView(){
  $("#DivAsistenciaCrud").hide();
  $("#EditarDivAsistencia").show();
  Listar_combo_gradosAsistencia();


}

function Eliminar_AsistenciaView(){
  $("#DivAsistenciaCrud").hide();
  $("#EditarDivAsistencia").hide();
  $("#ElimirarDivAsistencia").show();

  Listar_combo_gradosAsistencia();


}

function Reporte_AsistenciaView(){
  $("#DivAsistenciaCrud").hide();
  $("#EditarDivAsistencia").hide();
  $("#ElimirarDivAsistencia").hide();

}


///LISTAR ASISTENCIA///////////
function Listar_Alumno_Asistencia() {

 var idgrado=$("#cbm_grado ").val();
 var idnivel=$("#txt_nivelId ").val();
 var idsecion=$("#text_seccion ").val();
 var idyear  = $("#YearActualActivo").val();

 if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}
 if ( idgrado?.length==0 || idsecion?.length==0||  idnivel?.length==0 ) {
  return Swal.fire("MENSAJE DE ADVERTENCIA", "Debes seleccionar los prámetos para listar alumnos matriculados  !!", "warning");
}
$("#btn_bucar_data").html("<em class='fa fa-spin fa-refresh'></em>");
$('#btn_bucar_data').prop('disabled',true);

$.ajax({
 url:'../controlador/asistencia/listar_asistencias.php',
 type:'POST',
 data:{idgrado:idgrado,idnivel:idnivel,idsecion:idsecion,idyear:idyear}
}).done(function(resultado){
  var data = JSON.parse(resultado);

  
  if (data.length!=0 ) {
    $("#btn_bucar_data").html("<em class='fa fa-search'></em>");
    $('#btn_bucar_data').prop('disabled',false);
    recorerresultado_Asistencias(data);

  }
  else{
    $("#btn_bucar_data").html("<em class='fa fa-search'></em>");
    $('#btn_bucar_data').prop('disabled',false);
    var datos_add ="";
    datos_add +=  "<tr><td ></td><td ></td><td >No se encontó Ningun Alumno Matriculado para los parametros ingresados!</td><tr>";  
    $("#tbody_tabla_detall").html(datos_add);
  }

});

} 

//listar alumnos de la fecha para editar
function Listar_Asistencias_fecha(){

  var idgrado=$("#edit_cbm_grado ").val();
  var idnivel=$("#edit_txt_nivelId ").val();
  var idsecion=$("#edit_text_seccion ").val();
  var idyear  = $("#YearActualActivo").val();

  var fechaEntrada =$("#SeachFechaEdit").val();

  if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}
  if ( idgrado?.length==0 || idsecion?.length==0||  idnivel?.length==0 ) {
    return Swal.fire("MENSAJE DE ADVERTENCIA", "Debes seleccionar los prámetos para listar alumnos matriculados  !!", "warning");
  }

  if (fechaEntrada.length==0) {
    return Swal.fire("Mensaje de advertencia", "Ingrese la fecha que deseas editar !!", "warning");
  }
  $("#edit_btn_bucar_data").html("<em class='fa fa-spin fa-refresh'></em>");
  $('#edit_btn_bucar_data').prop('disabled',true);
  
  $.ajax({
    url:'../controlador/asistencia/Editar_Asistencia.php',
    type:'POST',
    data:{fechaEntrada:fechaEntrada,idgrado:idgrado,idnivel:idnivel,idsecion:idsecion,idyear:idyear}
  }).done(function(resultado){
   var data = JSON.parse(resultado);
   

   if (data?.length!=0 ) { 

     $("#edit_btn_bucar_data").html("<em class='fa fa-search'></em>");
     $('#edit_btn_bucar_data').prop('disabled',false);
    
     Asistencias_Encontrados(data);
   }else{
    $("#edit_btn_bucar_data").html("<em class='fa fa-search'></em>");
    $('#edit_btn_bucar_data').prop('disabled',false);
    var datos_add ="";
    datos_add +=  "<tr><td ></td><td ></td><td >No hay asistencia registrado para la fecha ingresado!</td><tr>";  
    $("#tbody_tabla_EditAsis").html(datos_add);
  }
});

}

///////////////////Filtrar Asistencas

function Estraer_Asistencia_Eliminar(){
  
  var idgrado  = $("#elim_cbm_grado").val();
  var idnivel  = $("#elim_txt_nivelId").val();
  var idsecion  = $("#elim_text_seccion").val();
  var idyear  = $("#YearActualActivo").val();



  var fechainicio=$("#FechaInicio").val();
  var fechafin=$("#FecahaFin").val();

  if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}

  if ( idgrado?.length==0 || idsecion?.length==0||  idnivel?.length==0 ) {
    return Swal.fire("MENSAJE DE ADVERTENCIA", "Debes seleccionar los prámetos para listar Asistencias  !!", "warning");
  }
  if (fechainicio.length==0 || fechafin.length==0) {
    return Swal.fire("Mensaje de advertencia", "Ingrese la fecha que deseas Visualizar !!", "warning");
  }

  $("#elimi_btn_bucar_data").html("<em class='fa fa-spin fa-refresh'></em>");
  $('#elimi_btn_bucar_data').prop('disabled',true);
  


  $.ajax({
    url:'../controlador/asistencia/filtrar_asistencias.php',
    type:'POST',
    data:{fechainicio:fechainicio,fechafin:fechafin,idgrado:idgrado,idnivel:idnivel,idsecion:idsecion,idyear:idyear}
  }).done(function(resultado){
    var data = JSON.parse(resultado);
    if (data?.length!=0) {
     Recorer_Filtros_Asistencia(data);

     $("#elimi_btn_bucar_data").html("<em class='fa fa-search'></em>");
     $('#elimi_btn_bucar_data').prop('disabled',true);
   }
   else{
    $("#FechaInicio").val('');
    $("#FecahaFin").val('');
    $("#elimi_btn_bucar_data").html("<em class='fa fa-search'></em>");
    $('#elimi_btn_bucar_data').prop('disabled',true);
    var datos_add ="";
    datos_add +=  "<tr><td ></td><td ></td><td >No hay asistencia registrado para la fecha ingresado!</td><tr>";  
    $("#tbody_tabla_Filtrados").html(datos_add);
  }
})
}



function Update_Asistencia(){

  var fechaAsisten =$("#SeachFechaEdit").val();
  var vectorId=new Array();
  var vectorSelect=new Array();

  $('#tbody_tabla_EditAsis tr').each(function() {
   vectorId.push($(this).find('td').eq(0).text());
 });
  $(".switch_checbok input[id='edit_comboAsistencia']").each(function(index){
   if (this.checked) {
    vectorSelect.push(1+',');
  }else{
    vectorSelect.push(0+',');
  }
});


  if(fechaAsisten.length == 0){
   return Swal.fire("Mensaje De Advertencia", "Ingrese fecha de las asistencias", "warning");
 }
console.log(vectorId);
 if(vectorId.length == 0){
   return Swal.fire("Mensaje De Advertencia", "No hay Alumnos para registrar", "warning");
 }

 $('#edit_button_resgist').prop('disabled',true);
 $('.loader').show();////prende

 var vectorIdpersonas = vectorId.toString();
 var vectorEstado = vectorSelect.toString();

 $.ajax({
  url:'../controlador/asistencia/Update_asistencia.php',
  type:'POST',
  data:{vectorIdpersonas:vectorIdpersonas,vectorEstado:vectorEstado,fechaAsisten:fechaAsisten}
}).done(function(resultado){

  var data = JSON.parse(resultado);

  if (data.data==1) {
   $('#edit_button_resgist').prop('disabled',false);
       $('.loader').hide();////prende

       $("#EditarDivAsistencia").hide();
       $("#DivAsistenciaCrud").show();
       Black_MenuAsis();
       Swal.fire({icon: 'success', title: 'Mensaje de Éxito !!', text:''+data.msg, showConfirmButton: false,timer: 1500 });
     }else{
       $('#edit_button_resgist').prop('disabled',false);
        $('.loader').hide();////prende
        return Swal.fire("Mensaje De Error", ""+data.msg, "error");
      }

    });

}


function Elimirar_Asistencia(){
  var fechainicio=$("#FechaInicio").val();
  var fechafin=$("#FecahaFin").val();

  var idgrado  = $("#elim_cbm_grado").val();
  var idnivel  = $("#elim_txt_nivelId").val();
  var idsecion  = $("#elim_text_seccion").val();
  var idyear  = $("#YearActualActivo").val();

  if(fechainicio.length==0 || fechafin.length==0){
    return Swal.fire("Mensaje De Advertencia", "Ingresa el Rango de Fechas", "warning");
  }

  Swal.fire({
    title: 'Esta seguro de eliminar al las asistencias?',
    text: "Una vez hecho esto el no se podran recuperar los registros",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#05ccc4',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si'
  }).then((result) => {
    if (result.value) {

     $('#elim_button_resgist').prop('disabled',true);
 $('.loader').show();////prende  

 $.ajax({
  url:'../controlador/asistencia/Eliminar_asistencias.php',
  type:'POST',
  data:{fechainicio:fechainicio,fechafin:fechafin,idgrado:idgrado,idnivel:idnivel,idsecion:idsecion,idyear:idyear}
}).done(function(resultado){
  $("#FechaInicio").val('');
  $("#FecahaFin").val('');
  var data = JSON.parse(resultado);
  if (data!=null) {

    $("#tbody_tabla_Filtrados").html("");
    Swal.fire({icon: 'success', title: 'Mensaje de Éxito !!', text: 'Datos correctamente, Las Asistencias Se eliminó Corectamente',showConfirmButton: false,timer: 1500 });
    Black_MenuAsis();

    $('#elim_button_resgist').prop('disabled',false);
 $('.loader').hide();////prende  
}
else{
  $('#elim_button_resgist').prop('disabled',false);
 $('.loader').hide();////prende  
 return Swal.fire("Mensaje De Advertencia", "No se pudo Eliminar  las asistencias"+resultado, "error");
}
})
}
}) 
  

}


////rEGISTRAR ASISTENCIA//////////
function RegistrarAsistencia(){
  var idgrado=$("#cbm_grado ").val();
  var idnivel=$("#txt_nivelId ").val();
  var idsecion=$("#text_seccion ").val();
  var idyear  = $("#YearActualActivo").val();

  var fechaAsisten =$("#FechaAsistencia").val();
  var vectorId=new Array();
  var vectorSelect=new Array();

  $('#tbody_tabla_detall tr').each(function() {
   vectorId.push($(this).find('td').eq(0).text());
 });

  $(".switch_checbok input[id='new_comboAsistencia']").each(function(index){
   if (this.checked) {
    vectorSelect.push(1+',');
  }else{
    vectorSelect.push(0+',');
  }

});

  var vectorIdpersonas = vectorId.toString();
  var vectorEstado = vectorSelect.toString();

  if(fechaAsisten.length == 0){
   return Swal.fire("Mensaje De Advertencia", "Ingrese fecha de las asistencias", "warning");
 }

 if(vectorIdpersonas.length == 0){
   return Swal.fire("Mensaje De Advertencia", "No hay Alumnos para registrar", "warning");
 }

 $('#button_resgist').prop('disabled',true);
 $('.loader').show();////prende
 $.ajax({
  url:'../controlador/asistencia/registrar_asistencia.php',
  type:'POST',
  data:{vectorIdpersonas:vectorIdpersonas,vectorEstado:vectorEstado,fechaAsisten:fechaAsisten,
    idgrado:idgrado,idnivel:idnivel,idsecion:idsecion,idyear:idyear}
  }).done(function(resultado){
    var data = JSON.parse(resultado);
    if(data.status) {
     if (data.data==1) {
       $('#button_resgist').prop('disabled',false);
                $('.loader').hide();////prende
                $("#DinNuevoAsistencia").hide();
                $("#FechaAsistencia").val('')
                $("#DivAsistenciaCrud").show();
                Black_MenuAsis();
                Swal.fire({icon: 'success', title: 'Mensaje de Éxito !!', text:''+data.msg, showConfirmButton: false,timer: 1500 });
              } else {
                $('#button_resgist').prop('disabled',false);
                $('.loader').hide();////prende
                return Swal.fire("Mensaje De Advertencia", ""+data.msg, "warning");
              }

            }else{
              $('#button_resgist').prop('disabled',false);
                $('.loader').hide();////prende
                return Swal.fire("Mensaje De error", "No se pudo registrar las asistencias"+data.msg, "error");
              }
            });
}

///Recoriendo la liata de asistencias///

function recorerresultado_Asistencias(data){ 
 var datos_add ="";let n=0; let cout=1;
 
 data.forEach(valor => {
  datos_add +=  "<tr>";  
  datos_add += "<td hidden>"+valor.idalumno+"</td>";
   datos_add += "<td >"+cout+"</td>";
  datos_add += "<td >"+valor.apellidos+','+valor.alumnonombre+"</td>";
  datos_add += "<td >"+valor.gradonombre+' | '+valor.nombreNivell+' | '+valor.seccion+"</td>";
  datos_add+="<td style='text-align: center'>";
  datos_add+="<label class='switch_checbok' style='display: block !important;'>";
  datos_add+="<input type='checkbox' id='new_comboAsistencia' class='clas_chebo"+n+"'>";
  datos_add+="<span class='siderasis round'></span>";
  datos_add+="</label>";
  datos_add+="</td>";
  datos_add += "<tr>";
  n++;cout++;
})
 $('#tbody_tabla_detall').html(datos_add);

}


////EDTAR ASIStencia////////////////

function Asistencias_Encontrados(data){
 var datos_add ="";
 let cout=1;
 data.forEach(valor => {
   datos_add +=  "<tr>";  
   datos_add += "<td hidden>"+valor.idalumno+"</td>";
   datos_add += "<td >"+cout+"</td>";
   datos_add += "<td >"+valor.apellidos+','+valor.alumnonombre+"</td>";
   datos_add += "<td >"+valor.gradonombre+' | '+valor.nombreNivell+' | '+valor.idseccion+"</td>";
   datos_add+="<td><label class='switch_checbok' style='display: block !important;'>";
   valor.Est_Asis==1 ? datos_add+="<input type='checkbox' id='edit_comboAsistencia' checked>":
   datos_add+="<input type='checkbox' id='edit_comboAsistencia'>";

   datos_add+="<span class='siderasis round'></span>";
   datos_add+="</label>";
   datos_add+="</td>";
   datos_add += "<tr>";
   cout++;
 })
 $('#tbody_tabla_EditAsis').html(datos_add);
}


/////////////Filtrar Asistencias//////

function  Recorer_Filtros_Asistencia(data){
  var numerador=1;
  var datos_add ="";
  data.forEach(valor => {
    datos_add +=  "<tr>";  
    datos_add += "<td >"+numerador+"</td>";
    datos_add += "<td >"+valor.apellidos+' '+valor.alumnonombre+"</td>";
    datos_add += "<td >"+valor.Fechas+"</td>";
    datos_add+="<td><label class='switch_checbok'>";

    valor.Est_Asis==1 ? datos_add+="<span class='label label-success'>Asistió</span>":
    datos_add+="<span class='label label-warning'>Falto</span>";
    datos_add+="</td>";
    datos_add += "<tr>";
    numerador++;
  })
  $('#tbody_tabla_Filtrados').html(datos_add);

}







///FIN DE FUNCIONES DE ASISTENCIAS////


function Estraer_Lista_Range_Alum(){

  var finicio= $("#reportFechainicio").val();
  var fFinal= $("#reportFechafin").val();
  if(finicio.length == 0 || fFinal.length==0){
    return;
  }

  var talb_filAlum = $("#table_alumno").DataTable({
   "ordering": true,
   "bLengthChange": false,
   "searching": {
    "regex": false
  },

  "responsive": true,
  dom: 'Bfrtilp',
  buttons:[ 
  {
    extend:    'pdfHtml5',
    text: '<i class="fa fa-file-pdf-o"></i>',
    title: 'REPORTE DE ASISTENCIA',
    className: 'btn btn-danger',
    style:'background-color:red'

    
  },{
    "extend":    'print',
    "text":      '<i class="fa fa-print"></i>',
    title: 'REPORTE DE ASISTENCIA',
    "titleAttr": 'Imprimir',
    "className": 'btn btn-info'
  },

  {
    "extend":    'excel',
    "text":      '<i class="fa fa-file-text-o"></i>',
    title: 'RREPORTE DE ASISTENCIA',
    "titleAttr": 'Excel',
    "className": 'btn btn-info'
  },{
    "extend":    'csvHtml5',
    "text":      '<i class="fa  fa-file-excel-o"></i>',
    title: 'REPORTE DE ASISTENCIA',
    "titleAttr": 'cvs',
    "className": 'btn btn-info'
  } 
  
  ],
  
  "lengthMenu": [
  [10, 25, 50, 100, -1],
  [10, 25, 50, 100, "All"]
  ],
  "pageLength": 10,
  "destroy": true,
  "async": false,
  "processing": true,
  "ajax": {
    "url": "../controlador/asistencia/reporte_lista_rango_fechas.php",
    type: 'POST',
    data:{finicio:finicio,fFinal:fFinal}  
  },
  "columns": [{
    "data": "idalumno"
  }, {
    "data": "apellidos"
  }, {
    "data": "alumnonombre"
  }, {
    "data": "Fechas"
  }, {
    "data": "stadoalumno"
  },{
    "data": "Est_Asis",
    render: function(data, type, row) {
      if (data == '1') {
       return "<span class='label label-success'>Asistió</span>";
     } else {
      return "<span class='label label-warning'>Falto</span>";
    }
  }
  
}],
"language": idioma_espanol,
select: true
});
  document.getElementById("table_alumno_filter").style.display = "none";
  $('input.global_filter').on('keyup click', function() {
    filterGlobal();
  });
  $('input.column_filter').on('keyup click', function() {
    filterColumn($(this).parents('tr').attr('data-column'));
  });
  
}
function filterGlobal() {
  $('#table_alumno').DataTable().search($('#global_filter').val(), ).draw();
}