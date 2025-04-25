
function ModalReport() {
    $("#reporte_pago").modal({
        backdrop: 'static',
        keyboard: false
    })
      $(".modal-header").css("background-color", "#05ccc4");
    $(".modal-header").css("color", "white");
    $("#reporte_pago").modal('show');
}


var table_pagos;
function listar_Alumno_Pagos() {
var yearid  = $("#YearActualActivo").val();
    table_pagos = $("#Tabla_Pagos_Alumno").DataTable({
        "ordering": true,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },"responsive": true,
    "dom":'Bfrtilp',
       
        buttons:[
            { extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i> ',
                titleAttr: 'Exportar a Excel'
            }, {extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i> ',
                titleAttr: 'Exportar a PDF'
            }],
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ] ,
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            url: "../controlador/pagos/controlador_alumnos_listar.php",
            type: 'POST',
            data:{yearid:yearid}
        },

        "columns": [{
            "data": "idalumno" },
        { "data": "apellidos" },
        {"data": "alumnonombre" },
        { "data": "aplicargo"},
        { "data": "ultimoPagofecha"},
        { "data": "proximoPagoFecha"},
        { "data": "stado",
        render: function(data, type, row) {
                return data == 'PAGADO'? "<span class='label label-success'>" + data + "</span>":"<span class='label label-warning'>" + data + "</span>";}
              
      },

          {
            "defaultContent": "<button  type='button' class='pagar btn btn-primary btn-sm'><i class='fa fa-money' title='pagar'></i></button>"+
            "&nbsp;<button  type='button' class='reporte btn btn-default btn-sm' title='reporte'><i class='fa fa-eye'></i></button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("Tabla_Pagos_Alumno_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
    table_pagos.column( 0 ).visible( false );
    $('#btn-place').html(table_pagos.buttons().container()); 

}
function filterGlobal() {
    $('#Tabla_Pagos_Alumno').DataTable().search($('#global_filter').val(), ).draw();
}


$('#Tabla_Pagos_Alumno').on('click', '.reporte', function() {
    var data = table_pagos.row($(this).parents('tr')).data();
   
    if (table_pagos.row(this).child.isShown()) {
        var data = table_pagos.row(this).data();
    }

   listar_Reportepago_masPagos_realizados(data.idalumno);
    });




$('#Tabla_Pagos_Alumno').on('click', '.pagar', function() {
  var data = table_pagos.row($(this).parents('tr')).data();

  if (table_pagos.row(this).child.isShown()) {
    var data = table_pagos.row(this).data();
    $("#idalumno").val(data.idalumno);
    $("#nombreAlumno").html(data.apellidos+","+data.alumnonombre);
  }

  $("#idalumno").val(data.idalumno);
  $("#nombreAlumno").html(data.apellidos+","+data.alumnonombre);


  var fecha = new Date(data.ultimoPagofecha+' 00:00:00');
  var options = { year: 'numeric', month: 'long', day: 'numeric' };

  var fecha_ultimo_Pago = fecha.toLocaleDateString("es-ES", options)
  $("#fechadeutimopago").html(fecha_ultimo_Pago);
  $("#pagoulitorealizado").val(data.ultimoPagofecha);

  $("#tabalistadepagospenciones").hide()  
   $("#modalPagosPenciones").show();

   listar_Reportepago(data.idalumno); 


});


///////////////////////


var total = 0;
var cambioYear=false;
function Agregar_tabla_Pagos(){
$("#avisomanual").hide();
//entrada de pago

  var precio = $("#txt_pago").val()
     
     ///FECHA QUE PAGO ALUMNO///
   var fechpagado = $("#pagoulitorealizado").val();
   var f=new Date(fechpagado);

     
  var dia = f.getDate() ;
  var mes = parseInt(f.getMonth()) + 1 ;
  var YearF = f.getFullYear();

    ///FECHA A PAGAR//////
  var mesSelect= $("#cbm_mes").val();
  if(mesSelect.length==""){
    return;
  }


  var fnew=new Date();
   fnew.setDate(dia) ;
  var mesSel = parseInt(fnew.setMonth(mesSelect -1)); 
   fnew.setFullYear(YearF);
  
  var fechaSelec = new Date((fnew));
  //FECHA SELECCIONADO CON FORMATO DE DATE PARA BD
  var fechaSelecnormal = new Date(fnew);
    var event = new Date(fechaSelecnormal);
    var date = JSON.stringify(event)
    var fechaSelecnormal  = date.slice(1,11);
    //LA FECHA ES UN DIA MENOS POR ESO SUMAMOS 1 EN PERU//
  

/////////////////ALTEARCION DE FECHAS/////////////////////////////////*/
var MesUtimoPago =parseInt(f.getMonth()) + 1 ;

if(MesUtimoPago==12){
  fechaSelec =new Date(fechaSelec.setFullYear(fechaSelec.getFullYear()+1));
  //SUMANDO UNO AL AÑO para BD
  var fechaparaBD= new Date(fnew);
  var event = new Date(fechaparaBD.setFullYear(fechaparaBD.getFullYear()+1));
  var date = JSON.stringify(event)
  fechaSelecnormal  = date.slice(1,11);
  //LA FECHA ES UN DIA MENOS POR ESO SUMAMOS 1 EN PERU//

}

if(cambioYear==true){
  //SUMANDO UNO AL AÑO para UI
  fechaSelec =new Date(fechaSelec.setFullYear(fechaSelec.getFullYear()+1));
  //SUMANDO UNO AL AÑO para BD
  var fechaparaBD= new Date(fnew);
  var event = new Date(fechaparaBD.setFullYear(fechaparaBD.getFullYear()+1));
  var date = JSON.stringify(event)
  fechaSelecnormal  = date.slice(1,11);
  //LA FECHA ES UN DIA MENOS POR ESO SUMAMOS 1 EN PERU//

}

/*|||| SI MES ES IGUAL A 12 ALTERAMOS EL AÑO EN UNO MAS||||||*/
var MesSeleclrDiciembre =parseInt(fechaSelec.getMonth()) + 1 ;

//////YA QUE LA FECHA ERA IN DIA MENOS LE ALTERE SUAMNDO UN DIA MAD ///
fechaSelec.setDate((fechaSelec.getDate()+1));
/////////////
//VARIABLES GLOBALES FECHA OOPTIONAS
  var options = { year: 'numeric', month: 'long', day: 'numeric' };
   var selectFecha=(fechaSelec.toLocaleDateString("es-ES", options));
//////

///COMPARA FECHA//////////////
   if ((fechaSelec<f)){
           createNotification("FECHA : " +selectFecha+ " !!YA ESTA PAGADO ", "info");
          return;
      }else{


        if (fechaSelec.getMonth()==f.getMonth()&& fechaSelec.getFullYear()==f.getFullYear()) {

           createNotification("LOS PAGOS SE ACEPTAN PASADO 1 MES DE LA  FECHA ("+fechpagado+") .... ", "info");
           
            return;

            }

               if (verificarid(mesSelect)) {

                createNotification("EL MES "+selectFecha+" YA ESTA SELECCIONADO PARA SU PAGO", "info");
                   return;
              }

              if(precio.length ==0 ){ createNotification("INGRSE MONTO", "error");return;}
                    var datos_add = "<tr>";
                    datos_add += "<td for='id'>" + mesSelect + "</td>";
                    datos_add += "<td > <strong>" + selectFecha.toUpperCase() + "</strong></td>";
                    datos_add += "<td hidden >" + fechaSelecnormal  + "</td>";
                    fechaSelecnormal=null;
                    datos_add += "<td >" + precio + "</td>";
              
                     datos_add += "<td><button class='btn btn-secondary btn-sm' onclick = 'remove(this)' ><em class='fa fa-close'></em></button><br> </td>";
                    datos_add += "</tr>";
                    calcularTotal(precio);

                    $("#tbody_tabla_detall").append(datos_add);
           
           if(MesSeleclrDiciembre==12 ){
               cambioYear =true;
              
            }
                 
         }
}


function verificarid(mesSelect) {

    let ident = document.querySelectorAll('#tbody_tabla_detall td[for="id"]');
    return [].filter.call(ident, td => td.textContent == mesSelect).length == 1;
}
var uno=0;
function remove(t) {
    var td = t.parentNode;
    var tr = td.parentNode;
    var table = tr.parentNode;
    table.removeChild(tr);
    RestarTotal();
 uno++;
   cambioYear=false;   
}

var element=0;
function calcularTotal(precio){
    element = (Number(element)+Number(precio));
    $("#total").html(element);

        
}

var total=0;
var toralres=0;
function RestarTotal(){
  $('#tbody_tabla_detall tr').each(function() {
      total = ($(this).find('td').eq(3).text());
      toralres=(Number(toralres)+Number(total));
    })
 $("#total").html(toralres);
 element=toralres;
   toralres=0;
}


function Registrar_Pago_Alumno(){
    var alumid = $("#idalumno").val();
    var yearid  = $("#YearActualActivo").val();
    var fechprueva = $("#pagoulitorealizado").val();

    var cont = 0;
    var arrayFEcha = new Array();
    $('#tbody_tabla_detall#tbody_tabla_detall tr').each(function() {
        arrayFEcha.push($(this).find('td').eq(2).text());
        // $(this).val()?  ponderados.push($(this).val()):ponderados.push('0');
        cont++;
    })
    var cant = 0;
    var arrayPrecio = new Array();
    $('#tbody_tabla_detall#tbody_tabla_detall tr').each(function() {
        arrayPrecio.push($(this).find('td').eq(3).text());
        cant++;
    });

    ////////////SACAR LA FECHA MAYOR /////////////////////
     
  var mayorDate= new Date(arrayFEcha[0]);
  var menorDate= new Date(arrayFEcha[0]);

for (var i = 0; i<arrayFEcha.length; i++){
  var arrDate= new Date(arrayFEcha[i]);
  if(arrDate > mayorDate){
    mayorDate=arrDate
  }
  if(arrDate < menorDate){
    menorDate=arrDate
    }
  }

    ///Combertir FEchaformato Mysql////
    var fechcomp = new Date(mayorDate);
    var datejson = JSON.stringify(fechcomp)
    var fechmay = datejson.slice(1,11);

    ///////////////////////////
    var arrayF = arrayFEcha.toString();
    var arrayP = arrayPrecio.toString(); 

    if (arrayF.length == 0 || arrayP.length==0 ) {
       createNotification("debes seleccionar  1 men por lo menos", "error");
        return;
    }
    
   $('.loader').show();////prende
   $('#btn_registra').prop('disabled',false);

   $.ajax({
        url : '../controlador/pagos/controlador_pagos_alumnos.php',
        type :'POST',
        data :{ alumid:alumid, yearid:yearid, arrayF:arrayF, arrayP:arrayP, fechmay:fechmay}

         }).done(function(Request){

         XMLHttpRequestAsycn(Request);
    })
}





function XMLHttpRequestAsycn(Request){
  if(Request>0){

    if (Request==100) {
     $('.loader').hide();
     $('#btn_registra').prop('disabled',false);
     return Swal.fire("Mensaje De Advertencia", "El Registro Similar(Igual) a esto ya  Existe"  , "warning");
   }
   if (Request==1) {

             $('.loader').hide();
             $('#btn_registra').prop('disabled',false);
              $('#btn_registra').hide();

            // limpiar_Modal_registro();
             // table_pagos.ajax.reload();

          Swal.fire({ icon: 'success', title: 'Éxito !!', text: 'Los Pagos se registraron con Exito!!!',showConfirmButton: false, timer: 1500});
              $('#btn_imprimir_boleta').show();

            }
            if (Request==404) {
              $('.loader').hide();
              $('#btn_registra').prop('disabled',false);

              window.location = "NotFound";

            } 
            if (Request==401) {
              window.location = "NotFound";
            } 
          }else{
            $('.loader').hide();
            return Swal.fire("Mensaje De Error", "No se registro Registro Fallido!!"+Request+""  , "error"); 
          } 
        }

function Imprimir_Boleta_De_Pago(){
var alumid = $("#idalumno").val();
var yearid  = $("#YearActualActivo").val();
 window.open("../vista/reportePDF/vista_imprimir_Boleta_pago.php?alumid=" + alumid+ "&yearid=" + yearid+
        "#zoom=75%","report","scrollbars=NO");
}

function limpiar_Modal_registro(){
 $("#modalPagosPenciones").hide();
 $("#tabalistadepagospenciones").show();
 $('#cbm_mes').val('').trigger('change');
 $('#tbody_tabla_detall').html('');
 $('#total').html('');
 $('#txt_pago').val('');
 
 $('.loader').hide();
 $('#btn_imprimir_boleta').hide();
 $('#btn_registra').show();
}


function listar_Reportepago(id) { 
  $.ajax({
    url: '../controlador/pagos/controlador_meses_pagados.php',
    type: 'POST',
    data: {
      id:id
    }
  }).done(function(resp) {
    var datos = JSON.parse(resp).reverse();
    var html ="";
     $('#lista_Pagos_realizados').html('');
    if(datos.length>0){
      datos.forEach((valor,i) => {
        html +=  "<ul class='list-group list-group-unbordered'>";
         html +=  "<li class='list-group-item'>";
           html +=  "<b>"+Number(1+i)+").&nbsp;<a>"+formatoFechas(valor.fechasPagados)+"</a></b> <a class='pull-right'>"+valor.motoPago+"</a>";
         html +=  "</li>"; 
        html +=  "</ul>";
      })

    }else{
    }
$('#lista_Pagos_realizados').append(html);
  }) 

}

function formatoFechas(fecha){
  var date =new Date(fecha+' 00:00:00');
   var options = { year: 'numeric', month: 'long', day: 'numeric',timeZone: 'America/Lima' };
  var fechaFort=(date.toLocaleDateString("es-ES", options));
  return fechaFort;
}


function listar_Reportepago_masPagos_realizados(id) { 
  var idalumno=$("#idalumno").val();

  var id= (id>0) ? id:idalumno

  ModalReport();
    $.ajax({
        url: '../controlador/pagos/controlador_meses_pagados.php',
        type: 'POST',
        data: {
            id:id
        }
    }).done(function(resp) {
       
        var datos = JSON.parse(resp);
        var cont=1;
         
        let template = '';
        datos.forEach(tarea => {
            template += `
                   <tr>
                   <td>${cont}</td>
                   <td>${formatoFechas(tarea.fechasPagados)}</td>
                    <td> ${"Guaraníes/.  " + tarea.motoPago + " mil"} </td>

                   </tr>
                 `
                 cont++;
        });
        $('#tabla_meses_pagado').html(template);
    }) 
    $('#tabla_meses_pagado').html('<br> <center> REALIZA TU PRIMER PAGO !!</center>');
}



function VerificarFechasDePagosAlumnos(){
  var yearid  = $("#YearActualActivo").val();
$.ajax({
        "url": "../controlador/pagos/controlador_VerificarFechas.php",
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
