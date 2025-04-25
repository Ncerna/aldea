
/*
async function getCousesPending(btn) {
    $(btn).prop('disabled', true);
    $(btn).html('<i class="fa fa-spinner fa-spin"></i> cargando...');

    let alumnoId =$("#alumnoId").val() || 1;
    let cursoId =$("#cursoId").val() || 1;
    let gradoId =$("#gradoId").val() || 1;
    let yearId =$("#yearId").val() || 1;

    // Construir los parámetros de la URL
    const queryParams = new URLSearchParams({
        alumnoId: alumnoId || '', 
        cursoId: cursoId || '',
        gradoId: gradoId || '',
        yearId: yearId
    }).toString();

    try {
        const response = await fetch(`../controlador/notas/getCouses_pendings.php?${queryParams}`, {
            method: 'GET'
        });

        // Manejo de la respuesta
        const data = await response.json();
        if (data.status) {
            // Procesar datos si la respuesta es exitosa
            console.log('Success:', data);
        } else {
            // Manejo de error en la respuesta
            Swal.fire("Mensaje de error", data.msg, "error");
        }
        
    } catch (error) {
        Swal.fire("Mensaje de error", error.message, "error");
    } finally {
        $(btn).html('<i class="fa fa-refresh"></i>');
        $(btn).prop('disabled', false);
    }
}
*/

var tiposevaluacion = [];
//var alumnos = [];
var notas_por_alumno = {};

async function getTypes(btn, idyear) {
var id_year = idyear != null ? idyear :   $("#YearActualActivo").val();  

    $(btn).prop('disabled', true);
    $(btn).html('<i class="fa fa-spinner fa-spin"></i> cargando...');

    // Construir los parámetros de la URL
    const queryParams = new URLSearchParams({
        idyear: id_year || ''
    }).toString();

    try {
        const response = await fetch(`../controlador/type/get_by_yearId.php?${queryParams}`, {
            method: 'GET'
        });

        // Manejo de la respuesta
        const data = await response.json();
       // if (data.status) {
            // Procesar datos si la respuesta es exitosa
            tiposevaluacion = data; 
            
            
        //} else {
            // Manejo de error en la respuesta
           // Swal.fire("Mensaje de error", data.msg, "error");
       // }
        
    } catch (error) {
        Swal.fire("Mensaje de error", error.message, "error");
    } finally {
        $(btn).html('<i class="fa fa-refresh"></i>');
        $(btn).prop('disabled', false);
    }
}



async function get_studenteNotaPending(btn) {

var selectedStudentText = $('#pendingStudents option:selected').text();
var selectedCourseText = $('#pendinCouseId option:selected').text();

let idyear = $('#pending_yerarId').val();
let id_student = $('#pendingStudents').val();
if (!id_student) return Swal.fire("Mensaje de advertencia", "Seleccionar estudiante", "warning");
let id_couse = $('#pendinCouseId').val();
const found = students.filter(function(student) { return student.Id_alumno == id_student });
if (!idyear) return Swal.fire("Mensaje de advertencia", "Seleccionar año", "warning");
if (!id_couse) return Swal.fire("Mensaje de advertencia", "Seleccionar curso", "warning");
let idnivel = found[0].Id_nivls;
let section = found[0].seccion;
let gradoId = found[0].Id_grado;

if (!idnivel) return Swal.fire("Mensaje de advertencia", "Seleccionar nivel", "warning");
if (!section) return Swal.fire("Mensaje de advertencia", "Seleccionar sección", "warning");
if (!gradoId) return Swal.fire("Mensaje de advertencia", "Seleccionar grado", "warning");
$(btn).prop('disabled', true);
$(btn).html('<i class="fa fa-spinner fa-spin"></i> cargando...');
$('#tableContainer').empty();
const queryParams = new URLSearchParams({ 
    idyear: idyear,
    id_student: id_student,
    id_couse: id_couse,
    idnivel: idnivel,
    section: section,
    gradoId: gradoId
}).toString();

try {
    const response = await fetch(`../controlador/notas/getCouses_pendings.php?${queryParams}`, {
        method: 'GET'
    });
    const data = await response.json();

    if (data.status) {
    
      if (data.data.length > 0) {  groupNotasPorAlumno(data.data);
    } else {

        $('#tableContainer').text(` El alumno ${selectedStudentText} ya está aprobado en el curso ${selectedCourseText} .`);//.show();
    }


    } else {
        Swal.fire("Mensaje de error", data.msg, "error");
    }
        
    } catch (error) {
        Swal.fire("Mensaje de error", error.message, "error");
    } finally {
        $(btn).html('<i class="fa fa-search"></i>');
        $(btn).prop('disabled', false);
    }
}

function groupNotasPorAlumno(alumnos) {
    try {
        for (const alumno of alumnos) {
            const alumno_id = alumno.alumno_id;
            if (!notas_por_alumno[alumno_id]) {
                notas_por_alumno[alumno_id] = [];
            }
            notas_por_alumno[alumno_id].push(alumno);
        }
        buildTable(); // Construir la tabla después de agrupar las notas
    } catch (error) {
        console.error('Error agrupando notas por alumno:', error);
        Swal.fire("Mensaje de error", "Ocurrió un error al agrupar las notas por alumno.", "error");
    }
}
function buildTable() {
    let tableHtml = `
    <table class="table table-hover" id="tbl-reporNota">
    <thead>
        <tr>
            <th style="font-size: 14px;" >N°</th>
            <th style="font-size: 14px;" >Alumnos</th>
            <th style="font-size: 14px;" >Grado</th>
            <th style="font-size: 14px;" >Curso</th>`;
            for (const val of tiposevaluacion) {
                tableHtml += `<th style="font-size: 14px;" >${val.ordenTipo_periodo}°_${val.tipo_nombre}</th>`;
            }
            tableHtml += `<th style="font-size: 14px;" >Promedio</th>
            </tr>
            </thead>
            <tbody >`;

            for (const alumno_id in notas_por_alumno) {
                const notas_alumno = notas_por_alumno[alumno_id];
                const alumno = notas_alumno[0];
                let total_notas = 0;
                let validNotasCount = 0; // Contador de notas válidas

                tableHtml += `<tr>
                    <td align='center' style="font-size: 12px;">${alumno.alumno_id}</td>
                    <td align='center' style="font-size: 12px;">${alumno.apellidos} ${alumno.alumnonombre}</td>
                    <td align='center' style="font-size: 12px;">${alumno.gradonombre}</td>
                    <td align='center' style="font-size: 12px;">${alumno.nonbrecurso}</td>`;

                    for (const val of tiposevaluacion) {
                           let nota = 0;
                           let idpond='';
                            for (const nota_alumno of notas_alumno) {
                             
                                if (nota_alumno.ordentio == val.ordenTipo_periodo) {

                                    nota = nota_alumno.notaacum; 
                                    idpond= nota_alumno.idpond;
                                    break;
                                }
                            }

                        total_notas += Number(nota); // Asegurarse de sumar como número
                                
                         tableHtml += `
                         <td align='center'>
                         <input type="text"  value= '${idpond}' hidden />
                            <input class="form-control input-sm"  type='number' value='${nota =="0.00" ? '' : nota}' onkeyup='updateAverage(this, ${tiposevaluacion.length})' />
                         </td>`;
                            
                             validNotasCount++;
                        }

                       const promedio = (validNotasCount > 0) ? (total_notas / validNotasCount).toFixed(2) : 0;
                      let promedioColor=(Number(promedio) > 10.5) ? "blue" : "red";
                  tableHtml += `<td align='center'><label class='form-control' style='color: ${promedioColor};'>${promedio}</label></td></tr>`;
       }

    tableHtml += `</tbody></table>`;
    $('#tableContainer').html(tableHtml);
}


function updateAverage(input, totalEvaluaciones) {
    const row = $(input).closest('tr');
    let total = 0, count = 0;

    row.find('input[type="number"]').each(function() {
        const value = parseFloat($(this).val()) || 0;
        total += value;
        count++;
    });

    const promedio = (count > 0) ? (total / count).toFixed(2) : 0;
     let promedioColor = (Number(promedio) > 10.5) ? "blue" : "red";
    row.find('label').text(promedio).css('color', promedioColor);
}


function saveNotas(btn) {
    const notasByStudents = [];
    // Recorrer cada fila de la tabla
    $('#tbl-reporNota tbody tr').each(function() {
        const alumnoId = $(this).find('td').eq(0).text(); // Obtener el ID del alumno
        const notasPorAlumno = { alumno_id: alumnoId, notas: [] }; // Cambiado a un array para incluir objetos

        // Recorrer cada celda de notas
        $(this).find('td:gt(3)').each(function(index) { // 'td:gt(3)' para ignorar las primeras 4 celdas
            const nota = $(this).find('input[type="number"]').val(); // Obtener el valor del input de nota
            const idpond = $(this).find('input[type="text"]').val(); // Obtener el valor del input oculto de idpond

            // Comprobar si el índice es válido
            if (index < tiposevaluacion.length) {
                const ordentio = tiposevaluacion[index].ordenTipo_periodo; // Obtener el tipo de evaluación
                // Guardar la nota como un objeto que incluye tipoEvaluacion, valorNota y idpond
                notasPorAlumno.notas.push({
                    ordentio: ordentio, // Agregar tipo de evaluación
                    nota: nota, // Agregar el valor de la nota
                    idpond: idpond // Agregar el idpond
                });
            }
        });

        notasByStudents.push(notasPorAlumno);
    });

    $(btn).prop('disabled', true);
   $(btn).html('<i class="fa fa-spinner fa-spin"></i> Guardando...');


  $.ajax({
    url: '../controlador/notas/change_notes_pendings.php',
    type: 'POST',
    data: JSON.stringify(notasByStudents),
    contentType: 'application/json',
    success: function(response) {
        const request = JSON.parse(response); // Parse the JSON response
        if (request.status) {
            $('#tableContainer').empty();
            notas_por_alumno = {};
             Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Éxito !!',
                    text: request.msg,
                    showConfirmButton: false,
                    timer: 1500
                });

          
        } else {
            
             Swal.fire("Mensaje de error", request.msg, "error");
        }
    },
    error: function(xhr, status, error) {
     
        Swal.fire("Mensaje de error", error, "error");
    }
});
 $(btn).prop('disabled', false);
  $(btn).html('Guardar Notas');
 //$(btn).html('<i class="fa fa fa-save"></i>');
}







 async function listar_combo_EscolarAsync(id) {
    //var id = $("#YearActualActivo").val();
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
                 
                cadena += "<option value='" + data[i][0] + "'" + (data[i][0] == id ? " selected" : "") + ">" + data[i][1] + "</option>";
            }
             $("#pending_yerarId").html(cadena);
             
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#pending_yerarId").html(cadena);
             
        }
    })
}

var students;
async function listar_combo_Alumnos(id_alumno, idyear) {
    var identi = '';
    var nameCombo = "--seleccione--";
    const response = await fetch(`../controlador/matricula/get_studentsBy_yerarId.php?idyear=${idyear}`);
    const data = await response.json();
    students = data;
    var cadena = "<option value='" + identi + "'>" + nameCombo + "</option>";
    if (data.length > 0) {
        for (var i = 0; i < data.length; i++) {
            var selected = (data[i]['Id_alumno'] == id_alumno) ? " selected" : "";
            cadena += "<option value='" + data[i]['Id_alumno'] + "'" + selected + ">" + data[i]['alumnonombre'] + ",&nbsp;" + data[i]['apellidos'] + "</option>";
        }
    } else {
        cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
    }
    $('#pendingStudents').html(cadena);
}


async function list_Corses_By_DegreId(id_degre, idyear) {
    var identi = '';
    var nameCombo = "--seleccione--";
    const response = await fetch("../controlador/notas/controlador_combo_curso.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `idyear=${idyear}&gradoid=${id_degre}`
    });
    const data = await response.json();
    var cadena = "<option value='" + identi + "'>" + nameCombo + "</option>";
    if (data.length > 0) {
        for (var i = 0; i < data.length; i++) {
            cadena += "<option value='" + data[i]['curso_id'] + "'>" + data[i][1] + " </option>";
        }
    } else {
        cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
    }
    $('#pendinCouseId').html(cadena);
}

async function fiterStudentsById(id_alumno) {
    var idyear = $('#pending_yerarId').val();
    // Filtrar la lista de estudiantes
    const filteredStudents = students.filter(function(student) {
        return student.Id_alumno == id_alumno;
    });

    if (filteredStudents.length > 0) {
        let id_degre = filteredStudents[0].Id_grado;
        await list_Corses_By_DegreId(id_degre, idyear);
    } else {
        // Manejo del caso donde no se encontró el estudiante
        console.log("No se encontró el estudiante con el Id: " + id_alumno);
    }
}