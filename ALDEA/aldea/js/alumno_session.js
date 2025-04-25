
var clas = ["bg-maroon", "bg-purple", "bg-navy", "bg-orange","bg-success"];

async function Listar_Tipo_Periodos() {
 var year  = $("#YearActualActivo").val();

 $.ajax({
  "url": "../controlador/alumnoSesion/tiposEvaluacionYear.php",
  type: 'POST',
  data:{year:year}
}).done(function(resp) {
 var data = JSON.parse(resp);
 if (data.auth) {

data= data.data;


 var html = '';
 if (data.length > 0) {
  $.each(data, function(i,elem) {

    html += "<div class='col-md-3'>";
    html += "<button style='border-radius: 5px' onclick='Listar_Notas_Alumno("+elem.ordenTipo_periodo+","+i+")' type='button' class='btn "+clas[i]+" btn-flat margin'>";

    html += "<em id='icon_loader"+i+"' class='fa fa-lightbulb-o'></em>&nbsp;&nbsp;"+elem.ordenTipo_periodo +"_° "+elem.tipo_nombre+"</button>";
    html += "</div>";
  });
}else{ html = ' <h5 class="box-title">PERIODO DE EVALUACIÓN NO ESTABLECIDO</h5>';}

$('#componente_bimestres').append(html);

 }else{
$('#componente_bimestres').append(data.data);

 }

 

})



}

function Listar_Notas_Alumno(idorden,i){
  var year  = $("#YearActualActivo").val();
  $("#icon_loader"+i).html("<em class='fa fa-spin fa-refresh'></em>");

 $.ajax({
  "url": "../controlador/alumnoSesion/controlador_listar_Notas_Alumnos.php",
  type: 'POST',
  data:{year:year,idorden:idorden}
}).done(function(resp) {



   $("#icon_loader"+i).html("");

 var data = JSON.parse(resp);

 $("#did_Notas_alumno").html(data.data);







})

}

///////////////////////////////////////////
////////////////////SECCION DE PAGOS//////////////
////////////////////////////////////////////

async function listar_Alumno_Pagos() {
var yearid  = $("#YearActualActivo").val();
$.ajax({
        "url": "../controlador/alumnoSesion/controlador_pagos_alumno.php",
        type: 'POST',
        data:{yearid:yearid}
        }).done(function(resp) {
          var datos = JSON.parse(resp);
        $("#table_pagos_alumno").html(datos);
    })
}

/*
function Imprimir_Boleta_De_Pago(){
var alumid = $("#idalumno").val();
var yearid  = $("#YearActualActivo").val();
 window.open("../vista/reportePDF/vista_imprimir_Boleta_pago.php?alumid=" + alumid+ "&yearid=" + yearid+
        "#zoom=75%","report","scrollbars=NO");
}
*/

function formatoFechas(fecha){
  var date =new Date(fecha+' 00:00:00');
   var options = { year: 'numeric', month: 'long', day: 'numeric',timeZone: 'America/Lima' };
  var fechaFort=(date.toLocaleDateString("es-ES", options));
  return fechaFort;
}


 function Verificar_Fechas_Pago_Alumnos(){
  var yearid  = $("#YearActualActivo").val();
$.ajax({
        "url": "../controlador/alumnoSesion/controlador_VerificarFechas.php",
        type: 'POST',
        data:{yearid:yearid}
        }).done(function(resp) {
     
        if (resp > 0) {
    
   
          // createNotification('verificado y actualizado la BD','success');
           return ;
            
        } else {

         //createNotification('NO SE ACTUALIZO LA BD', 'warning') ;
           return ;
        }
    })

}

async function listar_stado_Deuda_Alumno(){
  var yearid  = $("#YearActualActivo").val();
 $.ajax({
    url: '../controlador/alumnoSesion/controlador_estado_Deuda.php',
    type: 'POST',
    data: {
      yearid:yearid
    }
  }).done(function(resp) {
    var datos = JSON.parse(resp);//apellidos, alumnonombre,ultimoPagofecha,proximoPagoFecha,stado
  

if (datos.auth) {
   datos=datos.data;
   var html ="";
    if(datos.length>0){

      $("#nombreAlumno").html(datos[0]['apellidos']+' '+datos[0]['alumnonombre']);
      $("#fechadeutimopago").html(formatoFechas(datos[0]['ultimoPagofecha']));

      datos.forEach((valor,i) => {
        html +=  "<ul class='list-group list-group-unbordered'>";
         html +=  "<li class='list-group-item'>";
           html +=  "<b>&nbsp;<a>"+formatoFechas(valor.proximoPagoFecha)+"</a></b>"; 
            html +=  "<a class='pull-right'>";

            (valor.stado==='PAGADO')? html ="<span class='label label-success'>"+valor.stado+"</span>" : html ="<span class='label label-warning'>"+valor.stado+"</span>"; 

            html +=  "</a>";
         html +=  "</li>"; 
        html +=  "</ul>";
      })

    }else{

    }

    $('#lista_Pagos_realizados').append(html);
}else {

  $('#lista_Pagos_realizados').append(datos.data);
}

  })

}

///////////////////////////////////////////
////////////////////AULA DE CLASES//////////////
////////////////////////////////////////////

 function Listar_Aula_Clases_alumno(){
  var yearid  = $("#YearActualActivo").val();
$.ajax({
        "url": "../controlador/alumnoSesion/controlador_Aula_Clases_Alumno.php",
        type: 'POST',
        data:{yearid:yearid}
        }).done(function(resp) {
          var datos = JSON.parse(resp);
          $("#table_Aluas_alumnos").html(datos);
     
       
    })

}

//////////////////////////////////////
////////////CURSOS///////////////////
/////////////////////////////

function Listar_Cusos_Matriculados(){
  var yearid  = $("#YearActualActivo").val();
$.ajax({
        "url": "../controlador/alumnoSesion/controlador_listar_Cusos_Year.php",
        type: 'POST',
        data:{yearid:yearid}
        }).done(function(resp) {
          var datos = JSON.parse(resp);

          if (datos.auth) {

              $("#table_cursos_matriculados").html(datos.data);

          }else {

            $("#table_cursos_matriculados").html(datos.data); 
          }


        
     
       
    })
}