
var temData;
async function listar_combo_Grados() {
	var identi='';var nameCombo="--seleccione--";
    $.ajax({
        "url": "../controlador/matricula/controlador_combo0_grados0.php",
        type: 'POST'
    }).done(function(resp) {
          
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
           temData=data;
        	cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {

                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + ",&nbsp Nivel(" + data[i][2] +"),&nbsp; Turno(" + data[i][3] +
                "),&nbsp; Sección(" + data[i][4] +"),&nbsp; Aula(" + data[i][5] +")</option>";
            }
             $('#cbm_grado').html(cadena);////lamndo en vista matricula
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#cbm_grado").html(cadena);
        }
    })
}

//FILTRAR ID NIVELES DEL GRADO SELECCIONADO
function  Lista_Filtros_IdNiels_Grado(idgrado){
 let tenfilter = temData.filter(item => item.idgrado == idgrado);
          $("#id_aula").val(tenfilter[0]['aula_id']);
          $("#id_turno").val(tenfilter[0]['turno_id']);
          $("#id_nivels").val(tenfilter[0]['nivel_id']);
          $("#total_vacantes").val(tenfilter[0]['vacantes']);
           //GUI
         $("#gui_vacantes").html(tenfilter[0]['vacantes']);
          $("#txt_seccion").val(tenfilter[0]['seccion']);
          $("#txt_aula").val(tenfilter[0]['nombreaula']);
          $("#tex_turno").val(tenfilter[0]['turno_nombre']);
          $("#text_nivel").val(tenfilter[0]['nombreNivell']);
}



 async function listar_combo_Alumnos(){
    var identi='';var nameCombo="--seleccione--";
        $.ajax({
            "url": "../controlador/matricula/controlador_combo_Alumnos.php",
            type: 'POST'
        }).done(function(resp) {
          
            var data = JSON.parse(resp);
            var cadena = "";
            if (data.length > 0) {

                cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
                for (var i = 0; i < data.length; i++) {
                    cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + ",&nbsp;" + data[i][2] + "</option>";
                }
                 $('#cbm_alumnos').html(cadena);////lamndo en vista matricula
           
            } else {
                cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
                $("#cbm_alumnos").html(cadena);
            }
        })
}

function  Extrae_Datos_De_Grados(idgrado) {
    $.ajax({
        "url": "../controlador/matricula/controlador_Extraer_datos_grado.php",
        type: 'POST',
        data:{idgrado:idgrado }
    }).done(function(resp) {
        var data = JSON.parse(resp);
         $("#id_aula").val(data[0][0]);
         $("#id_turno").val(data[0][1]);
         $("#id_nivels").val(data[0][2]);
          $("#total_vacantes").val(data[0][3]);
           //GUI
         $("#gui_vacantes").html(data[0][3]);
          $("#txt_seccion").val(data[0][4]);
          $("#txt_aula").val(data[0][5]);
          $("#tex_turno").val(data[0][6]);
          $("#text_nivel").val(data[0][7]);
    })
}

var editando=false;

function Registar_Nuevo_Matricula(){
   var idAlum=$("#txt_IdAlumnoMatri").val();
   var alumno=$("#cbm_alumnos").val();
   var grado = $("#cbm_grado").val();
   var pago =$('#txt_montopago').val();
   var aula=  $("#id_aula").val();
   var turno=  $("#id_turno").val();
   var nivel =$("#id_nivels").val();
   var vacantes= $("#total_vacantes").val();
   //var penciones = $("#txt_penciones").val();
   var yearid  = $("#YearActualActivo").val();
   var cargo  = $("#cbm_penciones").val();
    var seccion  = $("#txt_seccion").val();

    /*alert(idAlum+'--'+alumno+'--'+grado+'--'+pago+'--'+aula+'--'+turno+
      '--'+nivel+'--'+vacantes+'--'+yearid+'--'+cargo+'--'+seccion);*/
        if (yearid.length==0) {
           return Swal.fire("Mensaje De Advertencia", "No hay año académico activo pra realizar las matriculas cotectamente!!!", "warning");
        }

       if (alumno.length==0||grado.length==0||nivel.length==0||pago.length==0||aula.length==0||turno.length==0) {
           return Swal.fire("Mensaje De Advertencia", "Llena Todos los espacios vacíos!! ", "warning");
        }
        if (vacantes==0) {
           return Swal.fire("Mensaje De Advertencia", "NO HAY VACANTES DISPONIBLES!! ", "warning");
        }
        /* if (cargo=='SI') { if(penciones.length==0){ return Swal.fire("Mensaje De Advertencia", "CUANTO PAGARÁ DE PENCIÓN", "warning"); } 
        }*/
       $('.loader').show();////prende
       $('#button_resgist').prop('disabled',true);
        $.ajax({
        "url": editando===false ? "../controlador/matricula/controlador_Matricular_Alumno.php":"../controlador/matricula/controlador_Actualizar_Matricual.php",
        type: 'POST',
        data:{idAlum:idAlum,alumno:alumno,grado:grado,pago:pago,aula:aula, turno:turno,
        nivel:nivel,vacantes:vacantes,yearid:yearid,/*penciones:penciones*/cargo:cargo,seccion:seccion}
    }).done(function(Request) {
       XMLHttpRequestAsycn(Request)  
    })
}


function XMLHttpRequestAsycn(Request){
      if(Request>0){

        if (Request==100) {
             $('.loader').hide();
             $('#button_resgist').prop('disabled',false);
            return Swal.fire("Mensaje De Advertencia", "El Alumno ya esta matriculado"  , "warning");
        }
        if (Request==1) {
              $('.loader').hide();
              $('#button_resgist').prop('disabled',false);
              limpiar_Registro_from();
              listar_combo_Grados() ;
               table_matricula.ajax.reload();

                Swal.fire({ icon: 'success', title: 'Éxito !!', text: 'El Registro, se registró con éxito!!',showConfirmButton: false, timer: 1500});
        }
        if (Request==404) {
              $('.loader').hide();
              $('#button_resgist').prop('disabled',false);

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




var table_matricula;
function listar_alumnos_Matriculados() {
  var yearid  = $("#YearActualActivo").val();
    table_matricula = $("#tabla_matricula").DataTable({
        "ordering": true,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },

        "responsive": true,
        dom: 'Bfrtilp',
         buttons:[{
                extend:    'copy',
                text:      '<i class="fa  fa-copy"></i> ',
                 title: 'REGISTRO DE ALUMNOS MATRÍCULADOS ',
                titleAttr: 'Exportar a copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i> ',
                 title: 'REGISTRO DE ALUMNOS MATRÍCULADOS ',
                titleAttr: 'Exportar a Excel'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i> ',
                 title: 'REGISTRO DE ALUMNOS MATRÍCULADOS ',
                titleAttr: 'Exportar a PDF'
            },
            {
                extend:    'print',
                text:      '<i class="fa fa-print"></i> ',
                 title: 'REGISTRO DE ALUMNOS MATRÍCULADOS ',
                titleAttr: 'Imprimir'
            },],
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ] ,
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            url: "../controlador/matricula/controlador_alumnos_Matriculados.php",
            type: 'POST',
            data:{yearid:yearid}
        },

        "columns": [{
            "data": "idalumno"},
           { "data": null, "render": function (data, type, row) { return row.apellidos + ' ' + row.alumnonombre; } },
           {"data": "dni"},
           {"data": "gradonombre"},
           { "data": "nombreNivell"},
           {"data": "seccion"},
           {"data": "nombreaula"},
           { "data": "turno_nombre"},
         {
            "defaultContent": "<button  type='button' class='eliminar btn btn-default btn-sm' title='Quitar de Matrículas'><em class='fa fa-close'></em></button>"+
            "&nbsp;<button type='button' class='imprimir btn btn-default btn-sm'  title='imprimir' ><i class='fa fa-print'></i></button>"
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
     $('#btn-place').html(table_matricula.buttons().container());

}

function filterGlobal() {
    $('#tabla_matricula').DataTable().search($('#global_filter').val(), ).draw();
}


function limpiar_Registro_from(){
    $("#txt_IdAlumnoMatri").val('');

    $('#cbm_alumnos').val('').trigger('change');
     $('#cbm_grado').val('').trigger('change');
  
   $('#txt_montopago').val('');
   $("#id_aula").val('');
   $("#id_turno").val('');
   $("#id_nivels").val('');
   $("#total_vacantes").val('');
   $("#txt_penciones").val('');
   
   $("#txt_seccion").val('');

   $("#gui_vacantes").html('');
   $("#txt_seccion").val('');
   $("#txt_aula").val('');
   $("#tex_turno").val('');
   $("#text_nivel").val('');

}

$('#tabla_matricula').on('click', '.eliminar', function() {
      var yearid  = $("#YearActualActivo").val();
      var data = table_matricula.row($(this).parents('tr')).data();
       if (table_matricula.row(this).child.isShown()) {
        var data = table_matricula.row(this).data();
        var idalumno=data.idalumno;
        var section = data.seccion;
       }
        var idalumno=data.idalumno;
        var section = data.seccion;
         Swal.fire({
             title: 'Esta seguro de Eliminar  La Matrícula?',
             text: "Una vez hecho esto el alumno No estara Matrículado en este año académico",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#05ccc4',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si'
         }).then((result) => {
        if (result.value) {
            $('.loader').show();////prende
            $.ajax({
              "url": "../controlador/matricula/controlador_retirar_Matricula.php",
              type: 'POST', 
              data: {idalumno:idalumno,yearid:yearid,section :section}
              }).done(function(Request) {
   
             XMLHttpRequestAsycn(Request);
   
         });

         }
       })
})


$('#tabla_matricula').on('click', '.imprimir', function() {
    var data = table_matricula.row($(this).parents('tr')).data();
    if (table_matricula.row(this).child.isShown()) {
        var data = table_matricula.row(this).data();
        var idalumno=data.idalumno;
    }
     var idalumno=data.idalumno;
    var yearid  = $("#YearActualActivo").val();

     window.open("../vista/reportePDF/vista_reporte_matricula.php?idalumno="+parseInt(idalumno)+ 
        "#zoom=75%","report","scrollbars=NO");

});



