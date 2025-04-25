
var table_matricula;
function listar_alumnos_Boleta_Notas() {
   var idyear  = $("#YearActualActivo").val();
    table_matricula = $("#tabla_matricula").DataTable({
        "ordering": true,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },

        "responsive": true,
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ] ,
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            url: "../controlador/docenteSesion/controlador_alumnos_listar.php",
            type: 'POST',
            data:{idyear:idyear}
        },

        "columns": [{
            "data": "idalumno"},
           { "data": "apellidos"},
           {"data": "alumnonombre"},
           {"data": "gradonombre"},
           {"data": "nombreNivell"},
           {"data": "seccion"},
         {
            "defaultContent": "<button  type='button' class='agregar btn btn-warning btn-sm'><i class=' glyphicon glyphicon-plus' title='agregar'></i></button>"+
            "&nbsp;<button  type='button' class='verformato btn btn-primary btn-sm'><em class='fa  fa-print' title='Imprimir '></em></button>"+
            "&nbsp;<button type='button' class='imprimir btn btn-default btn-sm'  title='imprimir' ><em class='fa  fa-file-pdf-o'></em></button>"
            
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("tabla_matricula_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {

        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
     table_matricula.column( 0 ).visible( false );
   

}

function filterGlobal() {
    $('#tabla_matricula').DataTable().search($('#global_filter').val(), ).draw();
}

$('#tabla_matricula').on('click', '.agregar', function() {
    var data = table_matricula.row($(this).parents('tr')).data();
    if (table_matricula.row(this).child.isShown()) {
        var data = table_matricula.row(this).data();
    }
        
     $("#DivTableAlumno").hide(); 
     $("#Div_boletaNotas").show();
    // $("#dinamic_table").show();
    $("#id_Alumno").val(data.idalumno);
    $("#nom_Alumno").val(data.apellidos+','+data.alumnonombre);
      lista_Combo_Grados_Boleta(data.Id_grado);
      YearAcademicoActivo();
      listar_tipoevaluacion();

});


//LISTAR GRADOS Y SUS NIVELES
//idgrado, gradonombre,nivel_id,nombreNivell
///gradoId, gradonombre,nivel_id,nombreNivell,idseccion /// esto se esta utilizando

var temturno;
 function lista_Combo_Grados_Boleta(idgrado) {
 	var yearid  = $("#YearActualActivo").val();
     var identi='';var nameCombo="--seleccione--";
    $.ajax({
        "url": "../controlador/docenteSesion/controlador_verGrado_Docente.php",
        type: 'POST',
        data:{yearid:yearid}
        }).done(function(resp) {
         var data = JSON.parse(resp);var cadena = "";
           if (data.data.length > 0) {
            data=data.data;
            temturno=data;
            cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";

               for (var i = 0; i < data.length; i++) {

                if(data[i]['gradoId']==idgrado){
                   cadena += "<option value='" + data[i]['gradoId'] + "'selected>" + data[i]['gradonombre'] +"&nbsp;, NIVEL:"+ data[i]['nombreNivell'] + "</option>";
                     listar_Combo_Cursos(data[i]['gradoId']);
                }else{
                     cadena += "<option value='" + data[i]['gradoId'] + "'>" + data[i]['gradonombre'] +"&nbsp;, NIVEL:"+ data[i]['nombreNivell'] + "</option>";
                }

               }
               $("#txt_evaluacion_grado").html(cadena);

           } else {
               cadena += "<option value=''>NO SE ENCONTRARON GRADOS</option>";
               $("#txt_evaluacion_grado").html(cadena);
           }

    })
  }

  //FILTRAR NIVELES DEL COMBO GRADOS

async function lista_combo_CodigoCurso(id){
   let desarrolladores = temturno.filter(item => item.gradoId == id)
      $("#txt_nivelId").val(desarrolladores[0]['nivel_id']);
      $("#txt_nivel_nivel").val(desarrolladores[0]['nombreNivell']);
}

 //LISTAR CURSOS PERTENECENTES AL GRAADO Y ALUMUNOS DE ESE GRADOS
   async function listar_Combo_Cursos(idgrado) {
   	var yearid  = $("#YearActualActivo").val();
    lista_combo_CodigoCurso(idgrado);
       var gradoid=idgrado;
          var identi='';var nameCombo="--seleccione--";
         $.ajax({
             "url": "../controlador/docenteSesion/controlador_Docente_Materia.php",
             type: 'POST',
             data:{gradoid:gradoid,yearid:yearid}
         }).done(function(resp) {
           var data = JSON.parse(resp);
             var cadena = "";
             if (data.length > 0) {
                $("#cantidadcurso").html(data.length);
               
                   cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
                 for (var i = 0; i < data.length; i++) {
                
                      cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
               
                 }
                 $("#cbm_curso").html(cadena);

             } else {
               $("#cantidadcurso").html(data.length);
                 cadena += "<option value=''>NO HAY CURSOS PARA EL GRADO</option>";
                 $("#cbm_curso").html(cadena);
             }

         })
     }

function YearAcademicoActivo(){
var nonbreYearActual  = $("#tex_YearActual_").val();
$("#NombreayearActivo").val(nonbreYearActual);
}


                  ////////////////////////////////////

                        ////APARTADO DE NOTAS//////
                  /////////////////////////////////////

var criterios;
var tiposEva;
var notasCriterio;
 function listar_Criterios_Curso(idcurso,idgrado){
  var id_year  = $("#YearActualActivo").val();
  var idcurso=idcurso;
  if(idgrado?.length==0|| idcurso?.length==0) {alert('NO HAY GRADO NI CURSO!!');return;}
    $.ajax({
        "url": "../controlador/boletin/controlador_listar_criteriosCurso.php",
        type: 'POST',
        data:{idcurso:idcurso,id_year:id_year,idgrado:idgrado}
    }).done(function(resp) {

     criterios = JSON.parse(resp);
     if(criterios.length>0) {
       $('#but_alin_global').prop('disabled',false);
     
     }else{createNotification('Seleccione otro curso','info');return; }
    })
   
}

//ordenTipo_periodo,tipo_periodo, tipo_nombre
 function listar_tipoevaluacion(){
   var id_year  = $("#YearActualActivo").val();
  
    $.ajax({
        "url": "../controlador/boletin/controlador_listar_tipoEvaluacion.php",
        type: 'POST',
        data:{id_year:id_year}
    }).done(function(resp) {

     tiposEva = JSON.parse(resp);
     if(tiposEva.length>0) {
      $("#tipo_evaluacion").val(tiposEva[0][1]);
    
     }else{ }
    })
   
}


 function notas(j,id){
 let resul = notasCriterio.filter(item => item.id_Criterio == id);
return resul[j]?.calificacions ? resul[j].calificacions:0;
}


function Extraer_Notas_Curso_Year(){

  notasCriterio='';
  var idAlumno = $("#id_Alumno").val();
  var idcurso = $("#cbm_curso").val();
  var nombrecurso  = $('#cbm_curso option:selected').text();
  var id_year  = $("#YearActualActivo").val();
$("#btn_bucar_data").html("<em class='fa fa-spin fa-refresh'></em>");
   $.ajax({
        "url": "../controlador/boletin/controlador_Extrae_NotasCriterios.php",
        type: 'POST',
        data:{idAlumno:idAlumno,
          idcurso:idcurso,
          id_year:id_year}
    }).done(function(resp) {
     notasCriterio = JSON.parse(resp);
       $("#btn_bucar_data").html("<em class='fa fa-search'></em>");


     Extraer_Registros(idcurso,idAlumno,nombrecurso);
    })
}

function QuitarDiv(elemnt,idcurso){
 const element = document.getElementById(""+elemnt+"");
  element.remove();
for (var i = 0; i < cursosenshow.length; i++) {
  if (cursosenshow[i] === ""+idcurso+"") {
    cursosenshow.splice(i, 1);
    i--; // para evitar saltarse el siguiente elemento después del eliminado
  }
}
}


var cursosenshow=new Array();

function  Extraer_Registros(idcurso,idAlumno,nombrecurso){
  var kp_codigo =idcurso+idAlumno;
   var idnuevo=idAlumno+idcurso;

////////////Validadcion de vistas//////////
  if (!cursosenshow.includes(idcurso)) {
    cursosenshow.push(idcurso);
  }else {
 
     var contenidoCriteriosNotas = document.getElementById("contenidoCriteriosNotas");
      var elementosHijos = contenidoCriteriosNotas.querySelectorAll("*");

      for (var i = 0; i < elementosHijos.length; i++) {
        elementosHijos[i].classList.remove("highlight");
       }

     var div = document.getElementById(idnuevo);
     div.scrollIntoView({ behavior: "smooth" });
     div.classList.add("highlight");
     return;

  }
//////fin de validadcion de vistas////




  var html = '';
  html += "<div class = 'col-md-6' id='"+idnuevo+"'>";
  html += "<div class = 'box box-warning'>";
  html += "<div class='box-header'>";
  html += "<div class='row'>";
  html += "<div class='col-xs-6'>";
  html += "<p class='text-center'>"+nombrecurso+"</p>";
  html += "</div>";
  html += "<div class='col-xs-6'>";
  html += "<div class='box-tools pull-right'>";
  html += "<button class='btn btn-warning btn-sm' id='but_register"+kp_codigo+"' onclick='Registrar_Criterios_Notas("+kp_codigo+","+idcurso+")'";
  html += " style='font-size: 9px'><em class='fa fa-edit'></em></button>";
  html +="&nbsp;<button type='button' onclick='QuitarDiv("+idnuevo+","+idcurso+")' class='btn btn-secondary btn-sm' style='font-size: 9px'><em class='fa fa-close'></em> </button>";
  html += "</div>"; 
  html += "</div>";
  html += "</div>";
  html += "</div>";
  html += "<div class='box-body no-padding table-responsive'>";

  html += "<table class='table table-condensed'>";
  html += "<thead>";

  html += "<tr>";
  html += "<th style='width: 10px'>N°</th>";
  html += "<th>Críterio de Evaluación</th>";
  $.each(tiposEva, function(i, bim) {
    html += "<th align='center' style='width: 75px'>"+bim.ordenTipo_periodo+"°"+"</th>";});
  html += "</tr>";

  html += "</thead>";
  html += "<tbody id='tbody_tabla_Notas"+kp_codigo+"'>";

  $.each(criterios, function(i, crit) { 

   html += "<tr class='text_idCriterio"+kp_codigo+"' id='key"+i+"' > "; 
   html += "<td hidden>"+crit.idboletNota+"</td>";
    html += "<td >"+Number(i+1)+"</td>";//se agrego este td 
   html += "<td><input type='text' class='form-control' id='text_criterios'   value='"+crit.criteriosEvaluacion+"' disabled></td>";

   $.each(tiposEva, function(j,not) {
    html += "<td><input type='number' class='form-control'  id='text_Cal"+kp_codigo+"' value='"+notas(j,crit.idboletNota)+"' ></td>";
  });

   html += "</tr>";
 });

  html += "</tbody>";
  html += "</table>";

  html += "<br>";
  html += "</div>"; 
  html += "</div>";
  html += "</div>";

  $('#contenidoCriteriosNotas').append(html);

}



function Registrar_Criterios_Notas(kp_codigo,idcurso){

  var idAlumno = $("#id_Alumno").val();
  var idnivel = $("#txt_nivelId").val();
  var gradoid = $("#txt_evaluacion_grado").val();
  var tipo = $("#tipo_evaluacion").val();
  var idcurso = idcurso;

  var id_year  = $("#YearActualActivo").val();
  var citerios=new Array();
  var calificaciones=new Array();
  var td_calificaciones=new Array();
  var long=tiposEva.length;


  $("#tbody_tabla_Notas"+kp_codigo+" .text_idCriterio"+kp_codigo).each(function(j, item) {
    citerios.push($(this).find('td').eq(0).text());
    for (var i = 0; i <tiposEva.length; i++) {
     td_calificaciones.push($(this).find("td input[id='text_Cal"+kp_codigo+"']").eq(i).val());
   }
   calificaciones.push(td_calificaciones);td_calificaciones=[];
 })

  if (id_year?.length == 0 || calificaciones?.length == 0 || idcurso?.length == 0 || citerios?.length == 0) {
    return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
  }
  $("#but_register"+kp_codigo).html("<em class='fa fa-spin fa-refresh'></em>");

  $.ajax({
    url: "../controlador/docenteSesion/controlador_Registro_Notas_Criterios.php",
    type: 'POST',
    data:{ idAlumno:idAlumno, idcurso:idcurso,gradoid:gradoid,idnivel:idnivel, tipo:tipo, id_year:id_year,
     long:long, citerios:citerios.toString(), calificaciones:calificaciones.toString()
   }
 }).done(function(Request) {
  XMLHttpRequestAsycn(Request,kp_codigo);

})

}

function Black_MenuAsis(){

$('#id_tableNotas').html('');
$('#Div_boletaNotas').hide();
$('#DivTableAlumno').show();
cursosenshow = [];

 criterios='';
vtiposEva='';
 notasCriterio='';
 $('#dinamic_table').hide();
 
  $('#btn_bucar_data').prop('disabled',false);

  $("#contenidoCriteriosNotas").html('');

}


  function XMLHttpRequestAsycn(Request,kp_codigo){
  if (Request > 0) {

    if(Request==1){
      $("#but_register"+kp_codigo).html("<em class='fa fa-check'></em>");
      createNotification('Registro Éxitoso !!','success');
      return;
    }
    if(Request==100){
         $("#but_register"+kp_codigo).html("<em class='fa fa-check'></em>");
         createNotification('Registro similar ya Existe!!','info');
    }
    if (Request==404) {
     
    
    } 
    if (Request==401) {
     window.location = "NotFound";

   }if (Request==504) {

      createNotification('Ya Existe Calificaciones ya no se puede modificar!!','warning');
   } 
     
  
   } else {
      $("#but_register"+kp_codigo).html("<em class='fa fa-check'></em>");

     createNotification('No se pudo registrar, Registro fallido!!','error');
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


///imprimi alumno boleta notas/

$('#tabla_matricula').on('click', '.imprimir', function() {
    var data = table_matricula.row($(this).parents('tr')).data();
    if (table_matricula.row(this).child.isShown()) {
        var data = table_matricula.row(this).data();
        var idalumno=data.idalumno;
          var id_year  = $("#YearActualActivo").val();
          var idgrado=data.Id_grado;
    }
     var idalumno=data.idalumno;
     var idgrado=data.Id_grado;
       var id_year  = $("#YearActualActivo").val();

     window.open("../vista/reportePDF/vista_report_libreta.php?idalumno="+parseInt(idalumno)+"&id_year="+
      parseInt(id_year)+"&idgrado="+parseInt(idgrado)+
        "#zoom=95%","report","scrollbars=NO");

});

$('#tabla_matricula').on('click', '.verformato', function() {
    var data = table_matricula.row($(this).parents('tr')).data();
    if (table_matricula.row(this).child.isShown()) {
        var data = table_matricula.row(this).data();
        var idalumno=data.idalumno;
        var idgrado=data.Id_grado;
          var id_year  = $("#YearActualActivo").val();
    }
     var idalumno=data.idalumno;
     var idgrado=data.Id_grado;
       var id_year  = $("#YearActualActivo").val();

     window.open("../vista/reportePDF/vista_reporte_html.php?idalumno="+parseInt(idalumno)+"&id_year="+
      parseInt(id_year)+"&idgrado="+parseInt(idgrado)+
        "#zoom=90%","report","scrollbars=NO");

});