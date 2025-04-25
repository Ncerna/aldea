
 
 //funcion para verificar si hay notas calificaciones 
 async function Consultar_Add_CriteriosLimited(idyear) {
    $.ajax({
        "url": "../controlador/criterio/controlador_Consult_Limit.php",
        type: 'POST',
        data:{idyear:idyear}
    }).done(function(resultado) {
     var data = JSON.parse(resultado);
       if (data>0) {

        ///se supone que ya no se podria agregrar
         $('#txt_evaluacion_grado').prop('disabled',false);
         lista_Combo_Grados();

      $("#tutotiales_Id").hide();

       $("#Limited_super").show();
        $('#txt_evaluacion_grado').prop('disabled',false);
      return;
       }
       else{
        
        lista_Combo_Grados();
       }
    })
}




 async function listar_combo_EscolarAsync() {
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
                 cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
            $("#bol_cbm_year").html(cadena);

        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#bol_cbm_year").html(cadena);
        }
    })
}


//LISTAR GRADOS Y SUS NIVELES
//idgrado, gradonombre,nivel_id,nombreNivell

var temturno;
 function lista_Combo_Grados() {
   $('#txt_evaluacion_grado').prop('disabled',false);

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
                
                     cadena += "<option value='" + data[i][0] + "'>" + data[i][1] +"&nbsp;, NIVEL:"+ data[i][3] + "</option>";

               }
               $("#txt_evaluacion_grado").html(cadena);

           } else {
               cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
               $("#txt_evaluacion_grado").html(cadena);
           }

    })
  }

//FILTRAR NIVELES DEL COMBO GRADOS
//Metodo local
async function lista_combo_CodigoCurso(id){
   let desarrolladores = temturno.filter(item => item.idgrado == id)
      $("#txt_nivelId").val(desarrolladores[0][2]);
      $("#txt_nivel_nivel").val(desarrolladores[0][3]);
}


  //LISTAR CURSOS PERTENECENTES AL GRAADO Y ALUMUNOS DE ESE GRADOS
   async function listar_Combo_Cursos(idgrado) {

    lista_combo_CodigoCurso(idgrado);


       var gradoid=idgrado;
          var identi='';var nameCombo="--seleccione--";
         $.ajax({
             "url": "../controlador/notas/controlador_combo_curso.php",
             type: 'POST',
             data:{gradoid:gradoid}
         }).done(function(resp) {
           var data = JSON.parse(resp);
             var cadena = "";
             if (data.length > 0) {
                $("#cantidadcurso").html(data.length);
                $('#bol_cbm_curso').prop('disabled',false);
                   cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
                 for (var i = 0; i < data.length; i++) {
                
                      cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
               
                 }
                 $("#bol_cbm_curso").html(cadena);

             } else {
               $("#cantidadcurso").html(data.length);
                 cadena += "<option value=''>NO HAY CURSOS PARA EL GRADO</option>";
                 $("#bol_cbm_curso").html(cadena);
             }

         })
     }



   function Add_tr_table(codigo){
        var datos_add ="";
       // data.forEach(valor => {
                datos_add +=  "<tr id='key"+codigo+"' >";  
                datos_add += "<td>✔</td>";
                datos_add += "<td hidden> <input type='text' id='id_criterio"+codigo+"' value='0'> </td>";
                datos_add += "<td><input type='text' class='form-control' id='text_criterio"+codigo+"' placeholder='ejemplo:Evaluacion Actitudinal' spellcheck='true'></td>";
                datos_add += "<td><button class='btn btn-secondary' onclick = 'remove(this)' style='border-radius: 5px; font-size: 9px'><em class='fa fa-trash'></em></button></td>";
                datos_add += "</tr>";
       // })
        $('#tbody_tabla_Curso'+codigo).append(datos_add);
    }

function remove(t) {
    var td = t.parentNode;
    var tr = td.parentNode;
    var table = tr.parentNode;
  
    table.removeChild(tr); 
}

function QuitarDiv(elemnt){

  const element = document.getElementById("criterio_"+elemnt+"");
  element.remove();

  for (var i = 0; i < cursosenshow.length; i++) {
  if (cursosenshow[i] === ""+elemnt+"") {
    cursosenshow.splice(i, 1);
    i--; // para evitar saltarse el siguiente elemento después del eliminado
  }
}
}


var cursosenshow=new Array();
function lista_Criterios_Curso(){

 var selectElement = document.getElementById('bol_cbm_curso');
var id_curso = selectElement.value;
var nombre_curso = selectElement.options[selectElement.selectedIndex].text;

////////////Validadcion de vistas//////////
  if (!cursosenshow.includes(id_curso)) {
    cursosenshow.push(id_curso);
  }else {
 
     var contenidoCriterios = document.getElementById("contenidoCriterios");
      var elementos = contenidoCriterios.querySelectorAll("*");

      for (var i = 0; i < elementos.length; i++) {
        elementos[i].classList.remove("highlight");
       }

     /*var div = document.getElementById("criterio_"+id_curso);
     console.log(div);
     div.scrollIntoView({ behavior: "smooth" });
     div.classList.add("highlight");*/
       var div = document.getElementById("criterio_" + id_curso);
        console.log("Selected course ID:", id_curso); // Debugging line

        if (div) { // Check if the div exists
            div.scrollIntoView({ behavior: "smooth" });
            div.classList.add("highlight");
        } else {
            console.error("Element with ID 'criterio_" + id_curso + "' not found."); // Error handling
        }
     return;

  }
//////fin de validadcion de vistas////

    var idyear =$("#bol_cbm_year").val();
    var  idgrado =$("#txt_evaluacion_grado").val();
    var idcurso =$("#bol_cbm_curso").val();
    var idnivel =$("#txt_nivelId").val();

 $("#but_alin_global").html("<em class='fa fa-spin fa-refresh'></em>");

    $.ajax({
        "url": "../controlador/criterio/controlador_listar_criterios.php",
        type: 'POST',
        data:{idyear:idyear,idgrado:idgrado,idcurso:idcurso,idnivel:idnivel}
    }).done(function(resultado) {
     var data = JSON.parse(resultado);
       if (data!=null){

         $("#but_alin_global").html("<em class='fa fa-search'></em>");
        recorrerListado_Criterios(data,id_curso,nombre_curso);
       }else{
         $("#but_alin_global").html("<em class='fa fa-search'></em>");
       }
    })
}


function recorrerListado_Criterios(data,id_curso,nombre_curso){
  var  codigo  = id_curso;
  var etiquta=  id_curso;



 var datos_add ="";
 datos_add +=  "<div class = 'col-md-6' id='criterio_"+etiquta+"' >";
 datos_add +=  "<div class = 'box box-warning'>";
 datos_add +=  "<div class='box-header'>";

 datos_add +=  "<div class='row'>";
 datos_add +=  "<div class='col-xs-6'>";
 
  datos_add += "<p class='text-center'>"+nombre_curso+"</p>";
 datos_add +=  "</div>";

 datos_add +=  "<div class='col-xs-6'>";
 datos_add +=  "<div class='box-tools pull-right'>";

 datos_add +=  "<button class='btn btn-primary btn-sm' id='but_register"+codigo+"' onclick='Registrar_Criterios("+codigo+")' style='font-size: 9px' ><em class='fa fa-save'></em></button>&nbsp;"; 
 datos_add +=  "<button type='button' onclick='Add_tr_table("+codigo+")' class='btn btn-warning btn-sm' style='font-size: 9px'><em class='glyphicon glyphicon-plus'></em>";
 datos_add +=  "</button>";
 datos_add +="&nbsp;<button type='button' onclick='QuitarDiv("+etiquta+")' class='btn btn-secondary btn-sm' style='font-size: 9px'><em class='fa fa-close'></em> </button>";
 datos_add +=  "</div>";
 datos_add +=  "</div>";

 datos_add +=  "</div>";
 datos_add +=  "</div>";
 datos_add +=  "<div class='box-body no-padding table-responsive'>";
 datos_add +=  "<table class='table table-condensed'>";
 datos_add +=  "<thead>";
 datos_add +=  "<tr>";
 datos_add +=  "<th style='width: 10px'>N°</th>";
 datos_add +=  "<th>Críterio de Evaluación</th>";
 datos_add +=  "<th style='width: 40px'>Quitar</th>";
 datos_add +=  "</tr>";
 datos_add +=  "</thead>";
 datos_add +=  "<tbody id='tbody_tabla_Curso"+codigo+"'>";

 if(data.length>0){
  data.forEach((valor,i) => {
    datos_add +=  "<tr id='key"+codigo+"'>";  
    datos_add +=  "<td>"+(i+Number(1))+"</td>";
     datos_add +=  "<td hidden><input type='text' id='id_criterio"+codigo+"' value='"+valor.idboletNota+"'></td>";
    datos_add +=  "<td><input type='text' class='form-control' id='text_criterio"+codigo+"' value='"+valor.criteriosEvaluacion+"' spellcheck='true'></td>";
    datos_add += "<td><button class='btn btn-secondary' onclick = 'remove(this)' style='border-radius: 5px; font-size: 9px'><em class='fa fa-trash'></em></button></td>";
    datos_add +=  "<td></td>";
    datos_add +=  "</tr>";
  })
}else{
         /* datos_add +=  "<tr id='key"+codigo+"'>";  
          datos_add +=  "<td>1</td>";
          datos_add +=  "<td><input type='text' class='form-control' id='text_criterio"+codigo+"' value='Notas Finales' spellcheck='true'></td>";
          datos_add += "<td><button class='btn btn-secondary' onclick = 'remove(this)' style='border-radius: 5px; font-size: 9px'><em class='fa fa-trash'></em></button></td>";
          datos_add +=  "<td></td>";
          datos_add +=  "</tr>";*/
        }

        datos_add +=  "</tbody>";
        datos_add +=  "</table>";
        datos_add +=  "<br>";
        datos_add +=  "</div>"; 
        datos_add +=  "</div>";
        datos_add +=  "</div>";
        $('#contenidoCriterios').append(datos_add);
      }



 function Registrar_Criterios(codigo){
var criterios=new Array();
var idcriterios=new Array();
   
    var idcriterio =$("#Idactyvite").val();
    var idyear =$("#bol_cbm_year").val();
    var  idgrado =$("#txt_evaluacion_grado").val();
     var idnivel  =$("#txt_nivelId").val();
    var idcurso =codigo;
  
    $("#contenidoCriterios #tbody_tabla_Curso"+codigo+" input[id='text_criterio"+codigo+"']").each(function() {
     if($(this).val()){
       criterios.push($(this).val());
     }
   });

      $("#contenidoCriterios #tbody_tabla_Curso"+codigo+" input[id='id_criterio"+codigo+"']").each(function() {
     if($(this).val()){
       idcriterios.push($(this).val());
     }
   });

 if( criterios.length==0 ||idyear.length==0|| idcurso.length==0 || idgrado.length==0){
     return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios! que son requeridos para su correcta configuración", "warning");
   }

  $("#but_register"+codigo).html("<em class='fa fa-spin fa-refresh'></em>");
  
   $.ajax({
    url: "../controlador/criterio/controlador_registrar_Criterio.php",
    type: 'POST',
    data: {
     idcriterio:idcriterio,idyear:idyear, idgrado:idgrado, idcurso:idcurso,
      criterios:criterios.toString(),idnivel:idnivel,idcriterios:idcriterios.toString()
   }
     }).done(function(Request) {
        XMLHttpRequestAsycn(Request,codigo);
     
     })

  }

  function Limpiar_Form_Registro(){

  $("#txt_nivelId").val('');
  $("#txt_nivel_nivel").val('');

}


  function XMLHttpRequestAsycn(Request,codigo){
  if (Request > 0) {

    if(Request==1){
      $("#but_register"+codigo).html("<em class='fa fa-check'></em>");
      createNotification('Registro Éxitoso !!','success');
      return;
    }
    if(Request==100){
         $("#but_register"+codigo).html("<em class='fa fa-check'></em>");
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
      $("#but_register"+codigo).html("<em class='fa fa-check'></em>");

     createNotification('No se pudo registrar, Registro fallido!!'+Request,'error');
     
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




