var editando = false;
var table;


function listar_docentesRegistrados() {
    table = $("#tabla_docente").DataTable({
        "ordering": true,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
         "responsive": true,
         "dom":'Bfrtilp',
       
        buttons:[
            { extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i> ',
                titleAttr: 'Exportar a Excel'
            }, {extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i> ',
                titleAttr: 'Exportar a PDF'
            }],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/docente/controlador_docente_listar.php",
            type: 'POST'//id_docente, nombres, apellidos, dni, nombreNivell,telefono, tipo_docente
        },
        "columns": [
             {"data": "id_docente" },
             {"data": "nombres"},
             {"data": "apellidos"},
             {"data": "dni"},
             {"data": "nombreNivell"},
             {"data": "telefono"},
             {"data": "tipo_docente"},
        {
            "defaultContent":"<button  type='button' class='eliminar btn btn-default btn-sm'><em class='fa fa-close' title='eliminar'></em></button>"+
            "&nbsp<button type='button' class='editar btn btn-primary btn-sm'><em class='fa fa-edit' title='editar'></em></button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("tabla_docente_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
     $('#btn-place').html(table.buttons().container()); 
     table.column( 0 ).visible( false );
    
}

function filterGlobal() {
    $('#tabla_docente').DataTable().search($('#global_filter').val(), ).draw();
}
function Registro_Docentes(){
  let idDocente = $("#id_docente").val();
  let nombreDocente = $("#txt_nombre").val().toUpperCase();
  let apellidDocente = $("#txt_apellido").val().toUpperCase();
  let dniDocente = $("#txt_dni").val();
  let emailDocente = $("#txt_email").val();
  let telfDocente = $("#txt_telefo").val();
  let codigDocente = $("#txt_codigo").val();
  let nivelDocente = $("#cbm_nivel").val();
  let tipoDocente = $("#cbm_tipo").val();
    let matricula = $("#txt_matricula").val();
    let cargoMec = $("#txt_cargo_mec").val();
    let cargoInt = $("#txt_cargo_int").val();
    let claseCargo = $("#txt_clase_cargo").val();
    let turno = $("#txt_turno").val();
    let nivelMec = $("#txt_nivel_mec").val();
    let titulosObtenidos = $("#txt_titulos").val();
    let identificacionAldea = $("#txt_identificacion_aldea").val();
    let estadoCivil = $("#cbm_estado_civil").val();
    let lugarNacimiento = $("#txt_lugar_nacimiento").val();
    let cargoAldea = $("#txt_cargo_aldea").val();
    let nivelGrado = $("#txt_nivel_grado").val();
  let fechaIngreso = $("#fecha_ingreso").val();
  let nacionalidad = $("#nacionalidad").val();
  let antiguedad = $("#antiguedad").val();
  let antiguedadDocencia = $("#antiguedad_docencia").val();
  let renuncia = $("#renuncia").val().toUpperCase();
  let tipoContrato = $("#tipo_contrato").val();
  let observaciones = $("#obser").val().toUpperCase();


  if (
    nombreDocente.length==0 || apellidDocente.length==0 || dniDocente.length==0 || emailDocente.length==0 || 
    telfDocente.length==0 || codigDocente.length==0 || nivelDocente.length==0 || tipoDocente.length==0 ||
    fechaIngreso.length==0 || nacionalidad.length==0 || antiguedad.length==0 || antiguedadDocencia.length==0 ||
    renuncia.length==0 || tipoContrato.length==0
  ) {
    return Swal.fire("Mensaje De Advertencia", "Llene los campos vacíos que son requeridos para Registrar/Actualizar Docente", "warning");
  }

  let formData = new FormData();
  formData.append('idDocente', idDocente);
  formData.append('nombreDocente', nombreDocente);
  formData.append('apellidDocente', apellidDocente);
  formData.append('dniDocente', dniDocente);
  formData.append('emailDocente', emailDocente);
  formData.append('telfDocente', telfDocente);
  formData.append('codigDocente', codigDocente);
  formData.append('nivelDocente', nivelDocente);
  formData.append('tipoDocente', tipoDocente);
formData.append('matricula', matricula);
formData.append('cargoMec', cargoMec);
formData.append('cargoInt', cargoInt);
formData.append('claseCargo', claseCargo);
formData.append('turno', turno);
formData.append('nivelMec', nivelMec);
formData.append('titulosObtenidos', titulosObtenidos);
formData.append('identificacionAldea', identificacionAldea);
formData.append('estadoCivil', estadoCivil);
formData.append('lugarNacimiento', lugarNacimiento);
formData.append('cargoAldea', cargoAldea);
formData.append('nivelGrado', nivelGrado);
  formData.append('fechaIngreso', fechaIngreso);
  formData.append('nacionalidad', nacionalidad);
  formData.append('antiguedad', antiguedad);
  formData.append('antiguedadDocencia', antiguedadDocencia);
  formData.append('renuncia', renuncia);
  formData.append('tipoContrato', tipoContrato);
  formData.append('observaciones', observaciones);

  // Archivos
  formData.append('foto_docente', $('#foto_docente')[0].files[0]);
  formData.append('cv_docente', $('#cv_docente')[0].files[0]);
  formData.append('titulo_docente', $('#titulo_docente')[0].files[0]);
  formData.append('constancia_docente', $('#constancia_docente')[0].files[0]);
  formData.append('capacitaciones_docente', $('#capacitaciones_docente')[0].files[0]);

  $('.loader').show();
  $('#button_resgist').prop('disabled', true);

  $.ajax({
    url: editando === false 
      ? "../controlador/docente/controlador_registrar_docente.php" 
      : "../controlador/docente/controlador_Actualizar_Docente.php",
    type: 'POST',
    data: formData,
    contentType: false, // NECESARIO para FormData
    processData: false, // NECESARIO para FormData
    success: function(Request) {
      var data = JSON.parse(Request);
      XMLHttpRequestAsycn(Request); // tu función para manejar la respuesta
    }
  });
}

function canselar_Registro(){
$('#cont_dniem_error').removeClass('form-group has-error').addClass('form-group');
$('#cont_codigo_error').removeClass('form-group has-error').addClass('form-group');
 $('#cbm_nivel').val('').trigger('change');
  editando=false;

$("#id_docente").val('');
$("#txt_nombre").val('');
$("#txt_apellido").val('');
$("#txt_dni").val('');
$("#txt_email").val('');
$("#txt_telefo").val('');
$("#txt_codigo").val('');
 $('#cbm_tipo').val('').trigger('change');
$("#cbm_tipo").val('');

$("#regiterEdit").html(" ");
$("#div_tabla_docente").show();
$("#div_docenteRegitrer").hide();

$('.loader').hide();
 $('#button_resgist').prop('disabled',false);


}


function Abrir_Modal_Registro(){

$("#div_tabla_docente").hide();
Listar_Combo_nveles();
$("#regiterEdit").html("Regitro");
$("#div_docenteRegitrer").show();
}

async function Listar_Combo_nveles(generic = null){
    var identi='';var nameCombo="--seleccione--";
    $.ajax({
        "url": "../controlador/aula/controlador_combo_nivelesEdit.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {
                data[i][1]==generic ? 
                cadena += "<option value='" + data[i][0] + "' selected>" + data[i][1] +  "</option>":
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] +"</option>";
            }
            $("#cbm_nivel").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#cbm_nivel").html(cadena);
        }
    })
}


$('#tabla_docente').on('click', '.editar', function() {
  var data = table.row($(this).parents('tr')).data();
  if (table.row(this).child.isShown()) {
      var data = table.row(this).data();
      var idDocente=data.id_docente;
  }
  var idDocente=data.id_docente;

    editando=true;
    $("#div_tabla_docente").hide();
    $("#regiterEdit").html("Actualizar");
    $("#div_docenteRegitrer").show();
    Listar_Combo_nveles(data.nombreNivell);
   $("#cbm_tipo").val(data.tipo_docente).trigger("change");
   Datos_Show_Editar(idDocente);
});

function Datos_Show_Editar(idDocente){

	$.ajax({
		"url": "../controlador/docente/controlador_Datos_Edit.php",
		type: 'POST',
		data:{idDocente:idDocente}
	}).done(function(resp) {
		var data = JSON.parse(resp);
		if (data.length>0) {
        	$("#id_docente").val(data[0]['id_docente']);
        	$("#txt_nombre").val(data[0]['nombres']);
        	$("#txt_apellido").val(data[0]['apellidos']);
        	$("#txt_dni").val(data[0]['dni']);
        	$("#txt_email").val(data[0]['email']);
        	$("#txt_telefo").val(data[0]['telefono']);
        	$("#txt_codigo").val(data[0]['codigo']);
            //
               // Nuevos campos añadidos según tu vista HTML
              $("#txt_matricula").val(data[0]['matricula']);
              $("#txt_cargo_mec").val(data[0]['cargo_mec']);
              $("#txt_cargo_int").val(data[0]['cargo_int']);
              $("#txt_clase_cargo").val(data[0]['clase_cargo']);
              
              $("#txt_turno").val(data[0]['turno']);
              $("#txt_nivel_mec").val(data[0]['nivel_mec']);
              $("#txt_titulos").val(data[0]['titulos_obtenidos']);
              $("#txt_identificacion_aldea").val(data[0]['identificacion_aldea']);

              // Campo de estado civil (select)
              $("#cbm_estado_civil").val(data[0]['estado_civil']);

              $("#txt_lugar_nacimiento").val(data[0]['lugar_nacimiento']);
              $("#txt_cargo_aldea").val(data[0]['cargo_aldea']);
              $("#txt_nivel_grado").val(data[0]['nivel_grado']);
            // Nuevos campos
            $("#fecha_ingreso").val(data[0]['fecha_ingreso']);
            $("#nacionalidad").val(data[0]['nacionalidad']);
            $("#antiguedad").val(data[0]['antiguedad']);
            $("#antiguedad_docencia").val(data[0]['antiguedad_docencia']);
            $("#renuncia").val(data[0]['renuncia']);
            $("#tipo_contrato").val(data[0]['tipo_contrato']);
            $("#obser").val(data[0]['observaciones']);
            // Mostrar imagen actual
            if (data[0]['foto_docente']) {
              $("#preview_foto").attr("src", "../../archivos/docentes/" + data[0]['foto_docente']).show();
            } else {
              $("#preview_foto").hide();
            }

            // Mostrar enlaces PDF si existen
            $("#link_cv").html(data[0]['cv_docente'] ? `<a href="../../archivos/docentes/${data[0]['cv_docente']}" target="_blank">Ver CV</a>` : '');
            $("#link_titulo").html(data[0]['titulo_docente'] ? `<a href="../../archivos/docentes/${data[0]['titulo_docente']}" target="_blank">Ver Título</a>` : '');
            $("#link_constancia").html(data[0]['constancia_docente'] ? `<a href="../../archivos/docentes/${data[0]['constancia_docente']}" target="_blank">Ver Constancia</a>` : '');
            $("#link_capacitaciones").html(data[0]['capacitaciones_docente'] ? `<a href="../../archivos/docentes/${data[0]['capacitaciones_docente']}" target="_blank">Ver Capacitaciones</a>` : '');

        }else{
        	 return Swal.fire("Mensaje De Advertencia", "No Hay datos o no tienes privilegios para realizar la operacion"+data, "warning");
        }
        
    })
}

$('#tabla_docente').on('click', '.eliminar', function() {
  var data = table.row($(this).parents('tr')).data();
  if (table.row(this).child.isShown()) {
      var data = table.row(this).data();
      var idDocente=data.id_docente;
  }
  var idDocente=data.id_docente;

    Swal.fire({
        title: 'Esta seguro de Eliminar(dar Baja)?',

        text: "Una vez hecho esto el docente "+data.nombres +' '+data.apellidos+"  No podra acseder al sistema ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#05ccc4',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.value) {
          Baja_Docente(idDocente);
        }
    })
});

function Baja_Docente(idDocente){
$.ajax({
		"url": "../controlador/docente/controlador_Baja_Docente.php",
		type: 'POST',
		data:{idDocente:idDocente}
	}).done(function(resp) {
		if (resp>0) {
			table.ajax.reload();
            Swal.fire({icon: 'success',title: 'Acción Éxistoso !!',text: 'Se dio de baja al docente  corectamente!!',showConfirmButton: false,timer: 1500})
       

        	
        }else{
        	 return Swal.fire("Mensaje De new Error", "No Hay datos o no tienes privilegios para realizar la operacion"+data, "error");
        }
        
    })

}

function XMLHttpRequestAsycn(Request){
    console.log(Request); // para seguir viendo qué llega

    if (typeof Request === 'string') {
        Request = JSON.parse(Request);
    }

    if (Request.status === 'success') {
        $('.loader').hide();
        $('#button_resgist').prop('disabled', false);
        canselar_Registro();
        table.ajax.reload();
        Swal.fire({
            icon: 'success',
            title: 'Registro Éxitoso!!',
            text: Request.mensaje,
            showConfirmButton: false,
            timer: 1500
        });
    } else if (Request == 100) {
        $('.loader').hide();
        $('#button_resgist').prop('disabled', false);
        $('#cont_dniem_error').removeClass('form-group').addClass('form-group has-error');
        $('#cont_codigo_error').removeClass('form-group').addClass('form-group has-error');
        return Swal.fire("Mensaje De Advertencia", "El Registro ya existe. Los 3 campos deben ser diferentes para distinguir cada docente.", "warning");
    } else if (Request == 404 || Request.status == 404) {
        window.location = "NotFound";
    } else if (Request == 401 || Request.status == 401) {
        window.location = "NotFound";
    } else {
        $('.loader').hide();
        $('#button_resgist').prop('disabled', false);
        return Swal.fire("Mensaje De Error", "Registro Fallido!! " + (Request.mensaje || "Error desconocido"), "error");
    }
}
