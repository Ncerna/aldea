
//listar Alumnos
var alumnos;
var actividades;
var jsonNota;

//LISTAR ALUMNOS MATRICULADOS EN SECCIONN GRADO Y AÑO ACTIVO


async function getAlumnosBys(idgrado, idnivel, idyear, idsecion){
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "../controlador/notas/controlador_listar_alumnos.php",
            type: 'POST',
            data: { idgrado: idgrado, idnivel: idnivel, idyear: idyear, idsecion: idsecion }
        }).done(function (resp) {
            const alumnos = JSON.parse(resp);
            if (alumnos.length === 0) {
                
                Swal.fire({ toast: true, position: 'top-right', icon: 'warning', title: 'Advertencia',
      text: "NO SE ENCONTRO NINGUN ALUMNO MATRICULADO EN EL GRADO, NIVEL, SECCIÓN Y AÑO ESPECIFICADO" ,showConfirmButton: false,timer: 2000});
            } else {
                resolve(alumnos);
            }
        });
    });
};



///LISTAR CRITERIOS DEL CURSO

async function listar_Actividades_curso(cursoid, tipoorden, tipoid, idyear){
    return new Promise((resolve, reject) => {
        var idcurso = cursoid;
        $.ajax({
            url: "../controlador/notas/controlador_listar_Actividades.php",
            type: 'POST',
            data: { idcurso: idcurso, tipoorden: tipoorden, tipoid: tipoid, idyear: idyear }
        }).done(function (resp) {
            const actividades = JSON.parse(resp);
            if (actividades.length === 0) {
                $("#buttNew").hide();
                $('#btn_bucar_data').prop('disabled', false);
                $("#btn_bucar_data").html("<i class='fa fa-search'></i>");

                $("#cbm_grado").prop('disabled', false);
                $("#cbm_tipoOrden").prop('disabled', false);
                $("#cbm_curso").prop('disabled', false);

               Swal.fire({ toast: true, position: 'top-right', icon: 'warning', title: 'Advertencia',
      text: "El curso seleccionado no tiene cargas académicas para el tipo de evaluación seleccionado. No hay nada que evaluar." ,showConfirmButton: false,timer: 2000});
            } else {
                resolve(actividades);
            }
        });
    });
}


//idgrado, gradonombre,nivel_id,nombreNivell,seccion
///gradoId, gradonombre,nivel_id,nombreNivell,idseccion
var temturno;
async function Listar_combo_grados_Docentes() {
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

           } else {
               cadena += "<option value=''>NO HAY GRADOS ACTIVOS</option>";
               $("#cbm_grado").html(cadena);
           }

    })
  }

//FILTRAR NIVELES DEL COMBO GRADOS
 async function lista_combo_CodigoCurso(id){
   let desarrolladores = temturno.filter(item => item.gradoId == id)
      $("#txt_nivelId").val(desarrolladores[0]['nivel_id']);
      $("#txt_nivel_nivel").val(desarrolladores[0]['nombreNivell']);
      $("#text_seccion").val(desarrolladores[0]['idseccion']);
} 

//EXTRAER TIPO DE PERIO 11,2°,3°4° DEL AÑO ACTIVO Y SUS FECHAS DE VENCIMIMENTO
//ALA TABLA PERIODOS DB

//ordenTipo_periodo,tipo_periodo,tipo_nombre,fech_inicio, fech_final//

//AQU ES PARA RESTINGIR LAS FECHA PARA LA EVALUACION

async function ListarComboDePeriodoDeEvaluacionYearActivoYFechas(){
   var identi='';var nameCombo="--seleccione--";
 var idyear  = $("#YearActualActivo").val();

if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}

    $.ajax({
        "url": "../controlador/notas/controlador_listar_perioEvaluacion.php",
        type: 'POST',
        data:{idyear:idyear}
    }).done(function(resp) {
     var data = JSON.parse(resp);
     var cadena = "";
        if (data.length > 0) {
              cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
              for (var i = 0; i < data.length; i++) {

              //VALIDANDO FECHAS FORMATE

              var event = new Date(data[i][4]);
              var date = JSON.stringify(event)
              var fechExiste  = date.slice(1,11);

              var date=new Date ();
              var event = new Date(date);
              var date = JSON.stringify(event)
              var fechActual = date.slice(1,11);

              //COMPARANDO LAS FECHAS
             if (fechExiste <= fechActual ) {
                 cadena += "<option value='" + data[i][0] + "'  disabled>" +""+(i+ Number(1))+"°_"+ data[i][2] + "</option>";
              }else{
                 cadena += "<option value='" + data[i][0] + "'>" +""+(i+ Number(1))+"°_"+ data[i][2] + "</option>";
              }

            }
            $("#cbm_tipoOrden").html(cadena);
            } else {
            cadena += "<option value=''>NO SE ENCONTRARON AÑOS ACADEMICOS ACTIVOS</option>";
            $("#cbm_tipoOrden").html(cadena);
        }
        $("#text_TipoEvaluacion").val((data[0][1]));
     })
}





//LISTAR ALUMNOS GRADOS CURSOS BIMESTRE
async function EtraerDatosSegunLosParametrosEstablecidos(){
$('#title_name_course').text("");
   var cursoid = $("#cbm_curso").val();
   var idgrado = $("#cbm_grado").val();
   var idsecion = $("#text_seccion").val();
   var idyear  = $("#YearActualActivo").val();
   
if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}
   var tipoorden = $("#cbm_tipoOrden").val();
   var tipoid = $("#text_TipoEvaluacion").val();
   var idnivel = $("#txt_nivelId").val();

  if (cursoid?.length==0 || idgrado?.length==0 || idsecion?.length==0|| tipoorden?.length==0|| idnivel?.length==0 ) {
   return Swal.fire("Mensaje de advertencia", " Debes seleccionar los parametros para generar notas o mostrar notas !!", "warning");
  }
try {
     // listar_Alumnos(idgrado,idnivel,idyear,idsecion);
     // listar_Actividades_curso(cursoid,tipoorden,tipoid,idyear);
      alumnos = await getAlumnosBys(idgrado, idnivel, idyear, idsecion);
      actividades = await listar_Actividades_curso(cursoid, tipoorden, tipoid, idyear);

      $('#btn_bucar_data').prop('disabled',true);
      $("#btn_bucar_data").html("<i class='fa fa-spin fa-refresh'></i>");

    $.ajax({
        "url": "../controlador/notas/controlador_listar_Notas_Alumnos.php",
        type: 'POST',
        data:{tipoorden:tipoorden,tipoid:tipoid, cursoid:cursoid,idgrado:idgrado, idsecion:idsecion,idnivel:idnivel,idyear:idyear }
    }).done(function(resp) {
     jsonNota = JSON.parse(resp);
     jsonNota = jsonNota.filter(item => item.ordentio == tipoorden);
     
     if (jsonNota.length==0) {
      $("#buttNew").show();
      $('#btn_bucar_data').prop('disabled',false);
      $("#btn_bucar_data").html("<i class='fa fa-search'></i>");
      
      $("#table_notas").html('');
      $('#cbm_grado').prop('disabled',true);
       $("#cbm_tipoOrden").prop('disabled',true);
       $("#cbm_curso").prop('disabled',true);
       
     }else{
       $("#table_notas").html('');
       Listar_notas_Alumnos(); 

       $("#buttNew").hide();
       $('#btn_bucar_data').prop('disabled',false);
       $("#btn_bucar_data").html("<i class='fa fa-search'></i>");

       $('#cbm_grado').prop('disabled',true);
       $("#cbm_tipoOrden").prop('disabled',true);
       $("#cbm_curso").prop('disabled',true);

       $("#cancel_button").prop('disabled',false);
       $("#button_resgist").prop('disabled',false);}
    
    })
    } catch (error) {
        console.error(error);
    }
}


function idNotas(i,idalum){
 let resul = jsonNota.filter(item => item.idalumno == idalum);
    if (resul[i] != null) {
        return resul[i].idnotas;
    } else {
        return '';
    }
}

var notasTem=new Array();
 function notas(j,id){
   let resul = jsonNota.filter(item => item.idalumno == id);

    resul[j]?.nota_alum ?  notasTem.push(resul[j].nota_alum):notasTem.push('0.00');
   //notasTem.push(resul[j].nota_alum);
   return resul[j]!=null ? resul[j].nota_alum:0.00;  
} 

 function promedio(){
var acumuado = 0;
var puntajeTem=new Array();

for (var i = 0; i < actividades?.length; i++) {
  puntajeTem.push(actividades[i].puntajes);
 }

for (var i = 0; i < actividades?.length; i++) {
   acumuado+=Number((notasTem[i]*puntajeTem[i])/100);
 }
notasTem=[];
 return acumuado==null ? 0:acumuado;
    
}  



function Listar_notas_Alumnos(){

if(actividades=='undefined'){

}

if(actividades=='' || actividades?.length==0 || actividades==null){
   EtraerDatosSegunLosParametrosEstablecidos();

}

   var html = '';
   html += "<table id='tabla_detall 'style='width: 100%' class='table'>";
       html += " <thead class=' thead-drak'>";
             html += "<tr id='trheader'>";
               html += "<th hidden>N°</th>";
               html += "<th>ALUMNO</th>";

               //SECCION ACTIVIDADES!!/
               $.each(actividades, function(i, acti) {
                
               html += "<th hidden><input type='text' id='activityid' value='"+acti.actcur_id+"'></th>";
               html += "<th>"+acti.actividades+"&nbsp;("+acti.puntajes+"%)"+"</th>";});
               //---FINAL---//
               html += "<th>PONDERADO</th>";
             html += "<tr>";
       html += "<thead> ";
       html += "<tbody id='tbody_tabla_detall'>";
            $.each(alumnos, function(i, alum) {  
            html += "<tr class='trcontext' id='tr_id"+i+"'>";
                   html += "<td hidden>"+alum.idalumno+"</td>";
                   html += "<td >"+alum.apellidos+","+alum.alumnonombre+"</td>";
                   //SECCION NOTAS!!
                   $.each(actividades, function(j, nota) { 

                    html += "<td align='center'>";
                    html += "<input type='number'  onkeyup='onclickhandler("+i+")' ";
                    html += "class=' form-control ' id='text_nota' value='"+notas(j,alum.idalumno)+"' >";
                    html += "<input id='idNotas' value='" + idNotas(j, alum.idalumno) + "' hidden >";
                    html += "</td>";
                   })
                    //---FINAL--//
                   html += "<td ><input type='number' name='acumulados' class='form-control' id='acumulado"+i+"' disabled value='"+promedio()+"'></td>";  
            html += "</tr>";
                 });
       html += " </tbody>";
   html += " </table>";

   $('#table_notas').append(html);
 }

 function Guardar_Registro_Notas(){
   var idactividad = new Array();
   var idalumnos = new Array();
   var notas = new Array();
   var td_notas = new Array();
   var ponderados = new Array();
   ///
   var id_notastd = new Array();
   var idNotas = new Array();////


   var idyear  = $("#YearActualActivo").val();
if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}
   
   var cursoid = $("#cbm_curso").val();
   var idgrado = $("#cbm_grado").val();
   var idsecion = $("#text_seccion").val();
   var tipoorden = $("#cbm_tipoOrden").val();
   var tipoid = $("#text_TipoEvaluacion").val();
   var idnivel = $("#txt_nivelId").val();

   if(tipoorden.length==0||  cursoid.length==0||  idgrado.length==0|| idsecion.length==0|| idnivel.length==0 || tipoid.length==0 ){
     return Swal.fire("MENSAJE DE ADVERTENCIA", "ES NECESARIO SELECCIONAR CURSO ,GRADO,NIVEL,SECCIÓN Y TIPO (NF/BIM/TRIM/SEM) QUE SON REQUERRIDOS PARA LA CORECTA CONFIGURACION", "warning");
   }

   $('#table_notas #trheader  ').each(function(j, item) {
     for (var i = 0; i <actividades.length; i++) {
       idactividad.push($(this).find('input[id="activityid"]').eq(i).val());
     }
   })
   $('#table_notas .trcontext ').each(function(j, item) {
    idalumnos.push($(this).find('td').eq(0).text());
    for (var i = 0; i <actividades.length; i++) {
     td_notas.push($(this).find('input[id="text_nota"]').eq(i).val());
   }
   notas.push(td_notas);td_notas=[];
 })

   $("#table_notas .trcontext td input[name='acumulados'] ").each(function(j, item) {
     $(this).val()?  ponderados.push($(this).val()):ponderados.push('0');
   })
   
   if(idactividad.length==0 || notas.length==0){

    createNotification('NO HAY NOTAS PARA REGISTRAR', 'warning');
    $("#button_resgist").prop('disabled',true);

    return;
   }

   $('#table_notas .trcontext ').each(function(j, item) {
    for (var i = 0; i <actividades.length; i++) {
     id_notastd.push($(this).find('input[id="idNotas"]').eq(i).val());
     
    }
    idNotas.push(id_notastd);id_notastd=[];
 })


   $('#button_resgist').prop('disabled',true);
   $('.loader').show();

   $.ajax({
    url: "../controlador/docenteSesion/controlador_Registro_Notas_Alumnos.php",
    type: 'POST',
    data:{ cursoid:cursoid,idyear:idyear,tipoorden:tipoorden,tipoid:tipoid,idnivel:idnivel,idgrado:idgrado,
     idsecion:idsecion, idalumnos:idalumnos.toString(), idactividad:idactividad.toString(),notas:notas.toString(),
     ponderados:ponderados.toString(),idNotas:idNotas.toString()
   }
 }).done(function(Request) {



  XMLHttpRequestAsycn(Request);

})
$('#title_name_course').text("");
}


function XMLHttpRequestAsycn(Request){
   if (Request > 0) {

    if(Request==1){
      $('#button_resgist').prop('disabled',false);
       Swal.fire({icon: 'success', title: 'Éxito !!', text:'Se registro corectamente las notas para los parametros especificados !!', showConfirmButton: false,timer: 1500 });
         Limpiar_modal();

    }
    if(Request==100){

        $('.loader').hide();
        $('#button_resgist').prop('disabled',false);
        return Swal.fire("Mensaje De Advertencia", "El Registro Similar(Igual) a esto ya  Existe...sugerencia Puedes Editar si desear modificar ,Mientras no hay evaluacines Activas ", "warning");
      }
      if (Request==404) {
        $('#button_resgist').prop('disabled',false);
         $('.loader').hide();

       window.location = "NotFound";
     } 
     if (Request==401) {
      $('#button_resgist').prop('disabled',false);
       $('.loader').hide();
       window.location = "NotFound";
     }
     if (Request==500) {
      $('#button_resgist').prop('disabled',false);
       $('.loader').hide();
       window.location = "NotFound/error500.php";
     }  

   } else {

     $('#button_resgist').prop('disabled',false);
   $('.loader').hide();
     
     return Swal.fire("Mensaje De Error", "No se registro Registro Fallido!!"+Request+""  , "error"); 
   }
 }




function onclickhandler(i) {
 var values=new Array();
 var procentajes=new Array();
 var acumuado = 0;

  $("#tr_id"+i+" td input[id='text_nota'] ").each(function (t, item) {
  $(this).val()?  values.push($(this).val()):values.push('0');
    procentajes.push(actividades[t].puntajes);
   });

 for (var k = 0; k < procentajes.length; k++) {
 acumuado+=Number((values[k]*procentajes[k])/100);
 }
  $("#acumulado"+i).val(acumuado==0 ? 0.00:acumuado);

}




//LISTAR CURSOS PERTENECENTES AL GRAADO Y ALUMUNOS DE ESE GRADOS
  async function listar_Combo_Cursos_grado_Docente(idgrado) {
       var gradoid=idgrado;
        var yearid  = $("#YearActualActivo").val();

       //FILTRAR NIVEL Y SECCION DEL GRDO SEGUN LO SELECCIONADO
       lista_combo_CodigoCurso(gradoid);
      // listar_Alumnos(gradoid);

          var identi='';var nameCombo="--seleccione--";
         $.ajax({
             "url": "../controlador/docenteSesion/controlador_Materia_DeGrados_Docente.php",
             type: 'POST',
             data:{yearid:yearid,gradoid:gradoid}
         }).done(function(resp) {
           var data = JSON.parse(resp);
             var cadena = "";
             if (data.length > 0) {
                $("#cantidadcurso").html(data.length);

                   cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
                 for (var i = 0; i < data.length; i++) {
                
                      cadena += "<option value='" + data[i]['idCursos'] + "'>" + data[i]['nonbrecurso'] + "</option>";
               
                 }
                 $("#cbm_curso").html(cadena);

             } else {
               $("#cantidadcurso").html(data.length);
                 cadena += "<option value=''>GRADO SIN CURSOS ESTABLECIDO</option>";
                 $("#cbm_curso").html(cadena);
             }
     

         })
     }



  function Nuevo_registro(){
   $("#buttNew").hide();
   $('#cbm_curso').prop('disabled',true);
   $('#cbm_tipoOrden').prop('disabled',true);
 var selectedOptionName = $('#cbm_curso').find('option:selected').text();
        $('#title_name_course').text("Curso:" +selectedOptionName);

   $("#cancel_button").prop('disabled',false);
   $("#button_resgist").prop('disabled',false);
    Listar_notas_Alumnos();
 
  }

  function Limpiar_cancelar_registro(){
   Swal.fire({
    title: 'Esta seguro de cancelar la operación?',
    text: "Una vez hecho esto se borraran todo lo que escribiste",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#05ccc4',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si'
  }).then((result) => {
    if (result.value) {
      
     $('#cbm_grado').val('').trigger('change');
     $('#cbm_tipoOrden').val('').trigger('change');
     $('#cbm_curso').val('').trigger('change');
     
     alumnos=[];actividades=[]; jsonNota=[];

     $("#table_notas").html('');
     $('#cbm_grado').prop('disabled',false);
     $("#cbm_tipoOrden").prop('disabled',false);
     $("#cbm_curso").prop('disabled',false);
     $('.loader').hide();
     $("#txt_nivelId").val('');
     $("#txt_nivel_nivel").val('');
     $("#text_seccion").val('');

     $("#buttNew").hide();
     $("#cancel_button").prop('disabled',false);
     $("#button_resgist").prop('disabled',false);
   }
 })
}


  function Limpiar_modal(){

   $('#cbm_grado').val('').trigger('change');
   $('#cbm_tipoOrden').val('').trigger('change');
   $('#cbm_curso').val('').trigger('change');

   $('#cbm_grado').prop('disabled',false);
   $("#cbm_tipoOrden").prop('disabled',false);
   $("#cbm_curso").prop('disabled',false);

     alumnos=[];actividades=[]; jsonNota=[];
     $("#table_notas").html('');
    $('.loader').hide();

     $("#buttNew").hide();

     $("#cancel_button").prop('disabled',true);
     $("#button_resgist").prop('disabled',true);


    $("#txt_nivelId").val('');
    $("#txt_nivel_nivel").val('');
    $("#text_seccion").val('');
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

////////////////////////////////////////////////////
/////SECCION DE REPORTE DE NOTA ////////////////////
////////////////////////////////////////////////////

async function ShowSelectedCursos_docente(){
  var idgrado = $("#rep_cbm_grado").val();

   if(idgrado){
    listar_Combo_Cursos_grado_report(idgrado);
    }
  }


  var temturno;
 function listar_Combo_Grados_report_docente() {
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
               $("#rep_cbm_grado").html(cadena);

           } else {
               cadena += "<option value=''>NO HAY GRADOS ACTIVOS</option>";
               $("#rep_cbm_grado").html(cadena);
           }

    })
  }

  //LISTAR CURSOS PERTENECENTES AL GRAADO Y ALUMUNOS DE ESE GRADOS
   async function listar_Combo_Cursos_grado_report(idgrado) {

      var gradoid=idgrado;
        var yearid  = $("#YearActualActivo").val();
       //FILTRAR NIVEL Y SECCION DEL GRDO SEGUN LO SELECCIONADO
      lista_combo_CodigoCurso(gradoid);
          var identi='';var nameCombo="--seleccione--";
         $.ajax({
             "url": "../controlador/docenteSesion/controlador_Materia_DeGrados_Docente.php",
             type: 'POST',
             data:{yearid:yearid,gradoid:gradoid}
         }).done(function(resp) {
           var data = JSON.parse(resp);
             var cadena = "";
             if (data.length > 0) {
                $("#cantidadcurso").html(data.length);
                $("#rep_comb_curso").prop('disabled',false);

                   cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
                 for (var i = 0; i < data.length; i++) {
                
                      cadena += "<option value='" + data[i]['idCursos'] + "'>" + data[i]['nonbrecurso'] + "</option>";
               
                 }
                 $("#rep_comb_curso").html(cadena);

             } else {
               $("#cantidadcurso").html(data.length);
                 cadena += "<option value=''>NO HAY CURSOS</option>";
                 $("#rep_comb_curso").html(cadena);
             }
     

         })
     }

async function listar_Combo_tipos_report_docente() {

   var identi='';var nameCombo="--seleccione--";
 var idyear  = $("#YearActualActivo").val();
if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}

    $.ajax({
        "url": "../controlador/notas/controlador_listar_perioEvaluacion.php",
        type: 'POST',
        data:{idyear:idyear}
    }).done(function(resp) {
     var data = JSON.parse(resp);
     var cadena = "";
        if (data.length > 0) {
              cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {
                 cadena += "<option value='" + data[i][0] + "'>" +""+(i+ Number(1))+"°_"+ data[i][2] + "</option>";

            }
            $("#cbm_tipoOrden").html(cadena);
            } else {
            cadena += "<option value=''>NO SE ENCONTRARON AÑOS ACADEMICOS ACTIVOS</option>";
            $("#cbm_tipoOrden").html(cadena);
        }
        $("#text_TipoEvaluacion").val((data[0][1]));
     })

}     

function YearAcademicoActivo(){

var nonbreYearActual  = $("#tex_YearActual_").val();
$("#NombreayearActivo").val(nonbreYearActual);

}



function Consultar_Notas(){

var idgrado =$("#rep_cbm_grado").val();
var idcurso =$("#rep_comb_curso").val();
var idsecion = $("#text_seccion").val();
 var idyear  = $("#YearActualActivo").val();

 if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}
var tipoorden =$("#cbm_tipoOrden").val();
var tipoid =$("#text_TipoEvaluacion").val();
var idnivel = $("#txt_nivelId").val();

 if (idcurso?.length==0 || idgrado?.length==0 || idsecion?.length==0|| tipoorden?.length==0|| idnivel?.length==0 ) {
   return Swal.fire("MENSAJE DE ADVERTENCIA", "Debes seleccionar los prámetos para consilutar notas corectamente  !!", "warning");
  }

 $("#contenido_principal").load("docenteSesion/vista_notas_report_docente.php?idgrado="+idgrado+"&idcurso="+idcurso+"&idsecion="
  +idsecion+"&tipoorden="+tipoorden+"&tipoid="+tipoid+"&idyear="+idyear+"&idnivel="+idnivel); 


}


//////////////////////////////////////////////////////////////////
///SECCION DE REPORTE DE NOTAS POR BIEMESTRES///////////////////
/////////////////////////////////////////////////////////////////


function    getCousesByIdDegree(idgrado){
 var gradoid=idgrado;
       var idyear  = $("#YearActualActivo").val();

       //FILTRAR NIVEL Y SECCION DEL GRDO SEGUN LO SELECCIONADO
   
      // listar_Alumnos(gradoid);

          var identi='';var nameCombo="--seleccione--";
         $.ajax({
             "url": "../controlador/notas/controlador_combo_curso.php",
             type: 'POST',
             data:{gradoid:gradoid,idyear:idyear}
         }).done(function(resp) {
           var data = JSON.parse(resp);
             var cadena = "";
             if (data.length > 0) {
                $("#cantidadcurso").html(data.length);

                   cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
                 for (var i = 0; i < data.length; i++) {
                
                      cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
               
                 }
                 $("#couses_degree_").html(cadena);

             } else {
               
                 cadena += "<option value=''>GRADO SIN CURSOS ESTABLECIDO</option>";
                 $("#couses_degree_").html(cadena);
             }
     

         })

}


async function ShowSelectedCursos(){
  var idgrado = $("#rep_cbm_grado").val();

  if(idgrado){
    //listar_Combo_Cursos_grado_report(idgrado);
     getCousesByIdDegree(idgrado);
    lista_combo_datos_grado_Docente(idgrado);
  }
}

//FILTRAR NIVELES DEL COMBO GRADOS
async function lista_combo_datos_grado_Docente(id){
  let filter = temturno.filter(item => item.gradoId == id)
  $("#txt_nivelId").val(filter[0]['nivel_id']);
  $("#txt_nivel_nivel").val(filter[0]['nombreNivell']);
  $("#text_seccion").val(filter[0]['idseccion']);

}

function Consultar_Parametros_Docente(){

var idgrado =$("#rep_cbm_grado").val();
var idcurso =$("#couses_degree_").val();
var idsecion = $("#text_seccion").val();
 var idyear  = $("#YearActualActivo").val();
 var idnivel = $("#txt_nivelId").val();
 var nombreNivel = $("#txt_nivel_nivel").val();


 if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}



 if ( idgrado?.length==0 || idsecion?.length==0||  idnivel?.length==0 ) {
   return Swal.fire("MENSAJE DE ADVERTENCIA", "Debes seleccionar los prámetos para consilutar notas corectamente  !!", "warning");
  }

 $("#contenido_principal").load("docenteSesion/vista_notas_periodo_docente.php?idgrado="+idgrado+"&idcurso="+idcurso+"&idsecion="
  +idsecion+"&idyear="+idyear+"&idnivel="+idnivel+"&nombreNivel="+nombreNivel); 

}