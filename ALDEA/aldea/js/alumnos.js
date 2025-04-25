function AbrirModalMatricula(){
  
   $("#DivTableAlumno").hide();
    $("#DivMatricula").show();
    createProvenanceRows(data = [])

}

//DATOS ALUMNO
 var editando=false;
async function registrar_Alunos(){                
        var student = {
        idalumnoedit: $("#id_alumnoEdit").val(),
        apellp: $("#txt_apellidos").val(),
        nomb: $("#txt_alunombre").val(),
        fechaN: $("#txt_fech").val(),
        dni: $("#txt_dni").val(),
        telf: $("#txt_tel").val(),
        direccion: $("#direccion").val(),
        codi: $("#txt_codig").val(),
        sex: $("#cbm_sexo").val(),
        nom_pade: $("#txt_nomb_padre").val(),
        apell_pade: $("#txt_apelli_padre").val(),
        dni_pade: $("#txt_dni_padre").val(),
        nom_madre: $("#txt_nombre_madre").val(),
        apell_madre: $("#txt_tapel_madre").val(),
        dni_madre: $("#txt_dni_madre").val(),
        nom_cole: $("#tex_coleg_nombre").val(),
        nom_direc: $("#tex_coleg_direcion").val(),
        cole_codig: $("#tex_codig_cole").val(),

        mail: $("#txt_mail").val(),
        country: $("#txt_country").val(),
        age: $("#txt_age").val(),
        province: $("#txt_province").val(),
        municipality: $("#txt_municipality").val(),
        others: $("#txt_others").val(),

        planeStudy: $("#planeStudy").val(),
        especiality: $("#especiality").val(),
        telf_padre: $("#txt_telefono_padre").val(),
        direc_padre: $("#txt_direccion_padre").val(),  // Aquí recoges la dirección del padre
        email_padre: $("#txt_email_padre").val(),
         // Añadir los datos de las personas autorizadas
        autorizado1_nombre: $("#autorizado1_nombre").val(),
        autorizado1_apellido: $("#autorizado1_apellido").val(),
        autorizado1_parentesco: $("#autorizado1_parentesco").val(),
        autorizado2_nombre: $("#autorizado2_nombre").val(),
        autorizado2_apellido: $("#autorizado2_apellido").val(),
        autorizado2_parentesco: $("#autorizado2_parentesco").val(),
        procedente: []

    };
        $('#provenanceTable tbody tr').each(function() {
            const $row = $(this);
            const rowData = {
                id: $row.find('.provId').val() ? $row.find('.provId').val() : null, 
                nombre: $row.find('.provName').val(),
                localidad: $row.find('.provLocation').val(),
                ep_data: $row.find('.ep_data').val(),
                yeard: $row.find('.provYear').val()
            };
            student.procedente.push(rowData); 
        });

         // Validaciones
        if (student.apellp.length === 0) {
            return Swal.fire("Mensaje De Advertencia", "Ingresa los apellidos del alumno", "warning");
        } else if (student.nomb.length === 0) {
            return Swal.fire("Mensaje De Advertencia", "Ingresa el nombre del alumno", "warning");
        } else if (student.fechaN.length === 0) {
            return Swal.fire("Mensaje De Advertencia", "Ingresa la fecha de nacimiento del alumno", "warning");
        } else if (student.telf.length === 0) {
            return Swal.fire("Mensaje De Advertencia", "Ingresa el teléfono del alumno", "warning");
        } else if (student.codi.length === 0) {
            return Swal.fire("Mensaje De Advertencia", "Ingresa el código del alumno", "warning");
        } else if (student.direccion.length === 0) {
            return Swal.fire("Mensaje De Advertencia", "Ingresa la dirección del alumno", "warning");
        } else if (student.dni.length === 0) {
            return Swal.fire("Mensaje De Advertencia", "Ingresa el DNI del alumno", "warning");
        } else {}


        $('.loader').show();////prende
       $('#button_resgist').prop('disabled',true);
         const url = editando ? "../controlador/alumno/controlador_Actualizar_Alumno.php" : "../controlador/alumno/controlador_registrar_Alumno.php";
        try {
       
        const response = await $.ajax({
            type: "POST",
            url: url,
            data: JSON.stringify({ student: student }),
            dataType: "json",
            headers: {
                'Content-Type': 'application/json',
            }
        });
        console.log("response"+ response)
        if (response) {
           XMLHttpRequestAsycn(response)
        } else {
            Swal.fire("Mensaje de error!", response?.message, "error");
        }
    } catch (error) {
        Swal.fire("Mensaje de error al registrar", error.message, "error");
    }

}


var table_matricula;
function listar_alumnos() {
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
                 title: 'REGISTRO DE ALUMNOS REGISTRADOS ',
                titleAttr: 'Exportar a copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i> ',
                 title: 'REGISTRO DE ALUMNOS REGISTRADOS ',
                titleAttr: 'Exportar a Excel'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i> ',
                 title: 'REGISTRO DE ALUMNOS REGISTRADOS ',
                titleAttr: 'Exportar a PDF'
            },
            {
                extend:    'print',
                text:      '<i class="fa fa-print"></i> ',
                 title: 'REGISTRO DE ALUMNOS REGISTRADOS ',
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
            url: "../controlador/alumno/controlador_alumnos_listar.php",
            type: 'POST'
        },

        "columns": [{
            "data": "idalumno"},
           { "data": "apellidos"},
           {"data": "alumnonombre"},
           {"data": "dni"},
           {"data": "telefono"},
           {"data": "codigo"},
           { "data": "sexo",
            render: function(data, type, row) {
              return  data == 'M'?  "<em class='fa fa-male'></em>":"<em class='fa fa-female'></em>"; }
            }, 
            {
            "data": "stadoalumno",
            render: function(data, type, row) {
              return  data == 'ACTIVO' ? "<span class='label label-success'>" + data + "</span>":
              "<span class='label label-warning'>" + data + "</span>";
            }
        }, {
            "defaultContent": "<button  type='button' class='editar btn btn-primary btn-sm' title='Editar'><i class='fa fa-edit'></i></button>&nbsp;<button  type='button' class='eliminar btn btn-default btn-sm' title='eliminar'><em class='fa fa-trash'></em></button>"
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


function LimpiarModalMatricula(){
    $("#id_alumnoEdit").val('');
   $("#txt_apellidos").val('');
    $("#txt_alunombre").val('');
   $("#txt_fech").val('');
    $("#txt_dni").val('');
    $("#txt_tel").val('');
    $("#txt_codig").val('');
    $("#cbm_sexo").val('');
   $("#txtfecharegistro").val('');
    $("#direccion").val('');
    //DATOS PADRES
     $("#txt_nomb_padre ").val('');
     $("#txt_apelli_padre").val('');
     $("#txt_dni_padre ").val('');
     $("#txt_telefono_padre ").val('');
     $("#txt_direccion_padre ").val('');
     $("#txt_email_padre ").val('');
      $("#txt_nombre_madre ").val('');
      $("#txt_tapel_madre ").val('');
      $("#txt_dni_madre ").val('');
     //DATOS ESCOLARES

     $("#tex_coleg_nombre").val('');
     $("#tex_coleg_direcion").val('');
     $("#tex_codig_cole").val('');
     $("#autorizado1_nombre").val('');
     $("#autorizado1_apellido").val('');
     $("#autorizado1_parentesco").val('');
     $("#autorizado2_nombre").val('');
     $("#autorizado2_apellido").val('');
     $("#autorizado2_parentesco").val('');
     editando=false;
       $('.loader').hide();
    $('#button_resgist').prop('disabled',false);
     $("#DivTableAlumno").show();
    $("#DivMatricula").hide();


    $("#txt_mail").val('');
    $("#txt_country").val('');
    $("#txt_age").val('');
    $("#txt_province").val('');
     $("#txt_municipality").val('');
     $("#txt_others").val('');

      $("#planeStudy").val('');
     $("#especiality").val('');
   
}

$('#tabla_matricula').on('click', '.editar', function() {
      editando=true;
    var data = table_matricula.row($(this).parents('tr')).data();
    if (table_matricula.row(this).child.isShown()) {
        var data = table_matricula.row(this).data();
        var idalumno=data.idalumno;
    }
     var idalumno=data.idalumno;
    $.ajax({
        "url": "../controlador/alumno/controlador_extraer_alumno.php",
        type: 'POST', 
        data: {idalumno:idalumno}
    }).done(function(resp) {
    var data = JSON.parse(resp);
   
    if (data) { 
       $("#DivTableAlumno").hide();
        $("#DivMatricula").show();
         
        Mostrar_Datos_Alumnos(data);
    } else {

        console.log("no se a encontrado datos")

    }
   
    });
})
   

$('#tabla_matricula').on('click', '.eliminar', function() {
    var data = table_matricula.row($(this).parents('tr')).data();
    if (table_matricula.row(this).child.isShown()) {
        var data = table_matricula.row(this).data();
        var id= data.idalumno;
    }
    var id= data.idalumno;
     Swal.fire({
        title: 'Esta seguro de Eliminar al Alumno?',
        text: "Una vez hecho esto el alumno No  tendra acceso al sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.value) {
           Dar_DeBaja_Alumno(id);
        }
    }) 
})



function Dar_DeBaja_Alumno(id){
   $.ajax({
    "url": "../controlador/alumno/controlador_darDaja_aulumno.php",
        type: 'POST',
        data: {
            id:id
        }
       }).done(function(resp) {
        if (resp > 0) {
            Swal.fire("Mensaje De Confirmacion", "La operación se realizo con Éxito!!", "success").then((value) => {
                   table_matricula.ajax.reload();
                });  
        } else {
            Swal.fire("Mensaje De Error", "La operación no se pudo Completar", "error");
        }
    })
}



function XMLHttpRequestAsycn(Request){
      if(Request>0){

        if (Request==100) {
             $('.loader').hide();
             $('#button_resgist').prop('disabled',false);
            return Swal.fire("Mensaje De Advertencia", "El Registro Similar(Igual) a esto ya  Existe"  , "warning");
        }
        if (Request==1) {
              $('.loader').hide();
              $('#button_resgist').prop('disabled',false);
              LimpiarModalMatricula();
              $("#DivMatricula").hide();
              $("#DivTableAlumno").show();
   
           
               table_matricula.ajax.reload();
          
            Swal.fire({ icon: 'success', title: 'Éxito !!', text: 'El Registro, se registro  de forma Éxitoso!! ',showConfirmButton: false, timer: 1700});  
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
          $('#button_resgist').prop('disabled',false);
       return Swal.fire("Mensaje De Error", "No se registro Registro Fallido!!"+Request+""  , "error"); 
    } 
}

function Mostrar_Datos_Alumnos(data){
   $("#id_alumnoEdit").val(data[0]['idalumno']);
   $("#txt_apellidos").val(data[0]['apellidos']);
    $("#txt_alunombre").val(data[0]['alumnonombre']);
    $("#txt_dni").val(data[0]['dni']);
    $("#txt_tel").val(data[0]['telefono']);
    $("#txt_codig").val(data[0]['codigo']);
    $("#cbm_sexo").val(data[0]['sexo']).trigger("change");
     $("#txt_fech").val(data[0]['fnacimiento']);
    $("#direccion").val(data[0]['direccion']);
    //DATOS PADRES
     $("#txt_nomb_padre ").val(data[0]['paderNombre']);
     $("#txt_apelli_padre").val(data[0]['PadreApellidos']);
     $("#txt_dni_padre ").val(data[0]['padreDni']);
    $("#txt_telefono_padre ").val(data[0]['telf_padre']);
    $("#txt_direccion_padre ").val(data[0]['direc_padre']);
    $("#txt_email_padre ").val(data[0]['email_padre']);
      $("#txt_nombre_madre ").val(data[0]['madreNombres']);
      $("#txt_tapel_madre ").val(data[0]['madreApellidos']);
      $("#txt_dni_madre ").val(data[0]['madreDni']);
      $("#txt_dni_madre ").val(data[0]['madreDni']);
     //DATOS ESCOLARES

     $("#tex_coleg_nombre ").val(data[0]['cole_procedente']);
     $("#tex_coleg_direcion ").val(data[0]['coleUbicacion']);
     $("#tex_codig_cole ").val(data[0]['coleCodigo']);

     $("#autorizado1_nombre ").val(data[0]['nombre_autorizado1']);
     $("#autorizado1_apellido ").val(data[0]['apellido_autorizado1']);
     $("#autorizado1_parentesco ").val(data[0]['parentesco_autorizado1']);
     $("#autorizado2_nombre ").val(data[0]['nombre_autorizado2']);
     $("#autorizado2_apellido ").val(data[0]['apellido_autorizado2']);
     $("#autorizado2_parentesco ").val(data[0]['parentesco_autorizado2']);

    $("#txt_mail").val(data[0]['mail']);
    $("#txt_country").val(data[0]['country']);
    $("#txt_age").val(data[0]['age']);
    $("#txt_province").val(data[0]['province']);
     $("#txt_municipality").val(data[0]['municipality']);
     $("#txt_others").val(data[0]['others']);

     $("#planeStudy").val(data[0]['planeStudy']);
     $("#especiality").val(data[0]['especiality']);

    const data1 = data['procedente'];
   createProvenanceRows(data1);
     
}



function createProvenanceRows(data = []) {
    const $tableBody = $('#provenanceTable tbody').empty(); 

    // Generar un rango de años (por ejemplo, de 2020 a 2024)
    const currentYear = new Date().getFullYear();
    const startYear = 2020; // Cambia esto según tus necesidades
    const endYear = currentYear + 5; // Por ejemplo, hasta 2024

    for (let i = 1; i <= 6; i++) {
        const item = data[i - 1] || {}; 
        const $row = $('<tr>').append(
            `<td>${i}</td>
             <td hidden><input type="text" class="provId form-control" value="${item.id || ''}"></td>
             <td><input type="text" class="provName form-control" value="${item.procedente || ''}" ></td>
             <td><input type="text" class="provLocation form-control" value="${item.localitation || ''}" ></td>
             <td><input type="text" class="ep_data form-control" value="${item.ep_data || ''}" ></td>
             <td>
                <select class="provYear form-control">
                    ${generateYearOptions(startYear, endYear, item.year)}
                </select>
             </td>
            `
        );
        $row.append('</tr>'); // Asegúrate de cerrar la fila
        $tableBody.append($row); // Agregar la fila al cuerpo de la tabla
    }
}

// Función para generar las opciones de años
function generateYearOptions(startYear, endYear, selectedYear) {
    let options = '<option value="">Seleccione un año</option>'; // Opción vacía por defecto
    for (let year = startYear; year <= endYear; year++) {
        const isSelected = year == selectedYear ? 'selected' : '';
        options += `<option value="${year}" ${isSelected}>${year}</option>`;
    }
    return options;
}


/*
function createProvenanceRows(data = []) {
    const $tableBody = $('#provenanceTable tbody').empty(); 
    for (let i = 1; i <= 6; i++) {
        const item = data[i - 1] || {}; 
        const $row = $('<tr>').append(
            `<td>${i}</td>
             <td hidden><input type="text" class="provId form-control" value="${item.id || ''}"></td>

             <td><input type="text" class="provName form-control" value="${item.procedente || ''}" ></td>
             <td><input type="text" class="provLocation form-control" value="${item.localitation || ''}" ></td>
             <td><input type="text" class="ep_data form-control" value="${item.ep_data || ''}" ></td>
             <td><input type="text" class="provYear form-control" value="${item.year || ''}" ></td>
            `
        );
        $row.append('</tr>'); // Asegúrate de cerrar la fila
        $tableBody.append($row); // Agregar la fila al cuerpo de la tabla
    }
}*/

