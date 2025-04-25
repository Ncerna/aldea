  var degrees = [];

async function Listar_combo_gradosActivos() {
     var identi='';var nameCombo="--seleccione--";
    $.ajax({
        "url": "../controlador/notas/controlador_combo_grados.php",
        type: 'POST'
        }).done(function(resp) {
         var data = JSON.parse(resp);
           var cadena = "";
           if (data.length > 0) {
             degrees=data;
             cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
               for (var i = 0; i < data.length; i++) {
                
                    cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + ",&nbsp;" + data[i][3] +",SECCIÓN:" + data[i][4] + "</option>";
               }
               $("#cbm_grado_xmls").html(cadena);

           } else {
               cadena += "<option value=''>NO HAY GRADOS ACTIVOS</option>";
               $("#cbm_grado_xmls").html(cadena);
           }

    })
  }
  async function listar_combo_EscolarAsync() {
    var id = $("#YearActualActivo").val();
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
             $("#yerar_xml").html(cadena);
              $("#year_to_studente").html(cadena);
             
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#yerar_xml").html(cadena);
             $("#year_to_studente").html(cadena);
             
        }
    })
}

async function get_xmls2() {
    let year_id = $("#yerar_xml").val();
    let degre_id = $("#cbm_grado_xmls").val();

    // Verificación si alguno de los campos está vacío
    if (!year_id || !degre_id) {
        return Swal.fire("Mensaje de advertencia", "Llene todos los campos.", "warning");
    }

    // Filtrar el grado seleccionado
    let foundDegre = degrees.filter(degree => degree.idgrado === degre_id);
    if (foundDegre.length > 0) {
        let section = foundDegre[0].seccion;
        let name = foundDegre[0].gradonombre;
        let nameParts = name.split(" ");
        let grado = nameParts.length > 1 ? nameParts[0] : name; // Si hay más de una palabra, toma la primera parte; si no, usa el nombre completo

        // Generar los XMLs dinámicamente
        generateXmlsBydeegre(year_id, degre_id, section, grado);
    }
}

function generateXmlsBydeegre(year_id, degre_id, section, grado) {
    // Limpiar el contenido actual del contenedor
    $('#conteiner_xmls').empty();
    
    // Crear los dos divs dinámicamente
    var div1 = `
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <div class="image-container">
          <img src="../imagenes/xls.png" alt="Div 1" class="img-fluid">
          <div class="overlay_img" style="display: flex; justify-content: space-between;">
            <p style="margin-left: 5px; margin: 0 10px;">RSF${grado}</p>
            <button class="btn btn-primary" style="position: relative; right: 0;" onclick="get_xmls(this, '${year_id}', '${degre_id}', '${section}', 'summary','${grado}');">
            <i class="fa fa-fw fa-download"></i></button>
          </div>
        </div>
      </div>
    `;
    var div2 = `
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <div class="image-container">
          <img src="../imagenes/xls.png" alt="Div 2" class="img-fluid">
          <div class="overlay_img" style="display: flex; justify-content: space-between;">
            <p style="margin-left: 5px;  margin: 0 10px;">RES TIT</p>
            <button class="btn btn-primary" style="position: relative; right: 0;" onclick="get_xmls(this, '${year_id}', '${degre_id}', '${section}', 'register','${grado}');">
            <i class="fa fa-fw fa-download"></i></button>
          </div>
        </div>
      </div>
    `;

    // Añadir ambos divs al contenedor
    $('#conteiner_xmls').append(div1);
    $('#conteiner_xmls').append(div2);
}

async function get_xmls(btn, year_id, id_degre, section, action,name,id_studentd=null) {
     $(btn).prop('disabled', true);
     $(btn).html('<i class="fa fa-spinner fa-spin"></i>cargando...');

    try {
        let url = '';
        if (action === 'summary') {
            url = '../controlador/reportXml/get_xml_summay.php';
        } else if (action === 'register') {
            url = '../controlador/reportXml/get_xml_registers.php';
        } else if(action ==='calification'){

             url = '../controlador/reportXml/get_calification_by_student.php'; 
        }
       
        // Hacer la solicitud al servidor
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                'year_id': year_id,
                'id_degre': id_degre,
                'section': section,
                'name':name,
                'id_studentd':id_studentd
            })
        });

         // Verificar si la respuesta es exitosa
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
      // Obtener el nombre del archivo desde el encabezado Content-Disposition
          const disposition = response.headers.get('Content-Disposition');
          const filename = disposition
            ? disposition.split('filename=')[1].replace(/['"]/g, '') // Limpia las comillas
            : 'archivo.xlsx'; // Nombre por defecto

          // Crear un blob a partir de la respuesta
          const blob = await response.blob();
          const urlBlob = URL.createObjectURL(blob);

          // Crear un enlace temporal y simular un clic para iniciar la descarga
          const a = document.createElement('a');
          a.href = urlBlob;
          a.download = filename; // Establecer el nombre del archivo
          document.body.appendChild(a);
          a.click();
          document.body.removeChild(a); // Eliminar el enlace temporal

          // Limpiar el objeto URL después de la descarga
          URL.revokeObjectURL(urlBlob);


    } catch (error) {
        console.error(error);
    } finally {
       $(btn).html('<i class="fa fa-fw fa-download"></i>');
       $(btn).prop('disabled', false);
    }
}


 async function listar_combo_Alumnos(){
     var identi='';var nameCombo="--seleccione--";
      var idyear = $("#year_to_studente").val();
        $.ajax({
            "url": "../controlador/matricula/controlador_combo_Alumnos.php",
            type: 'POST',
            data: {idyear:idyear}
        }).done(function(resp) {
          
            var data = JSON.parse(resp);
            var cadena = "";
            if (data.length > 0) {

                cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
                for (var i = 0; i < data.length; i++) {
                    cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + ",&nbsp;" + data[i][2] + "</option>";
                }
                 $('#sudents_xml').html(cadena);////lamndo en vista matricula
           
            } else {
                cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
                $("#sudents_xml").html(cadena);
            }
        })
}

var student=null;
var school = null;
async function getStudentsXml(id_year){
   
    let id_studentd = $("#sudents_xml").val();
    let idyear = id_year == null ? $("#YearActualActivo").val() : id_year;

   if (id_year == null && id_studentd==null)  return Swal.fire("Mensaje de advertencia", "Seleccione un estudiante.", "warning");
   // if (!id_studentd)  return Swal.fire("Mensaje de advertencia", "Seleccione un estudiante.", "warning");
       var selectedText = $('#sudents_xml option:selected').text();
       $("#studentSelecXml").text(" de : " +selectedText);
         try {
                // Realizar la solicitud al controlador
                 let response = await fetch(`../controlador/reportXml/get_studentById.php?id_studentd=${id_studentd}&idyear=${idyear}`);
                // Verificar si la respuesta es exitosa
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                 let data = await response.json();
                 student = data.student;
                 school = data.school;
            } catch (error) {
                // Manejar errores
                Swal.fire("Error", "Ocurrió un error al obtener los datos del estudiante: " + error.message, "error");
            }

  
  // Limpiar el contenido actual del contenedor
    $('#students_by_conteiner_xmls').empty();
    
    // Crear los dos divs dinámicamente
    var div1_xml = `
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <div class="image-container">
          <img src="../imagenes/xls.png" alt="" class="img-fluid">
          <div class="overlay_img" style="display: flex; justify-content: space-between;">
            <p style="margin-left: 5px; margin: 0 10px;">CERT.CALI.EMTP</p>
            <button class="btn btn-primary"  style="position: relative; right: 0;" onclick="get_xmls(this, '', '', '', 'calification','','${id_studentd}');">
            <i class="fa fa-fw fa-download"></i></button>
          </div>
        </div>
      </div>
    `;
    var div2_pdf = `
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <div class="image-container">
          <img src="../imagenes/pdf.png" alt="" class="img-fluid">
          <div class="overlay_img" style="display: flex; justify-content: space-between;">
            <p style="margin-left: 5px;  margin: 0 10px;">CONS.INS</p>
            <button class="btn btn-primary" style="position: relative; right: 0;" onclick="get_pdf(this, '${id_studentd}',  'constnace');">
            <i class="fa fa-fw fa-download"></i></button>
          </div>
        </div>
      </div>
    `;

     var inscription = `
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
        <div class="image-container">
          <img src="../imagenes/pdf.png" alt="" class="img-fluid">
          <div class="overlay_img" style="display: flex; justify-content: space-between;">
            <p style="margin-left: 5px;  margin: 0 10px;">CONS.EST </p>
            <button class="btn btn-primary" style="position: relative; right: 0;" onclick="get_pdf(this, '${id_studentd}',  'incription');">
            <i class="fa fa-fw fa-download"></i></button>
          </div>
        </div>
      </div>
    `;

    // Añadir ambos divs al contenedor
    $('#students_by_conteiner_xmls').append(div1_xml);
    $('#students_by_conteiner_xmls').append(div2_pdf);
    $('#students_by_conteiner_xmls').append(inscription);

}

async function get_pdf(btn, id_studentd, action) {
  var idyear  = $("#YearActualActivo").val();
  $(btn).prop('disabled', true);
  $(btn).html('<i class="fa fa-spinner fa-spin"></i>cargando...');
  //if (student === null || school === null)  await getStudentsXml(); 
    
  try {
    // Validar si 'id_studentd' está presente
    if (!id_studentd)  throw new Error('ID del estudiante es obligatorio.');

    let endpoint = '';
    if (action === "constnace") {
      endpoint = '../controlador/reportXml/print_constnace.php';
    } else if (action === "incription") {
      endpoint = '../controlador/reportXml/print_inscription.php';
    } else {
      throw new Error('Acción no reconocida.');
    }

    
    // Realizar la solicitud fetch
    const response = await fetch(endpoint, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ student: student, school: school })
    });

    if (!response.ok) {
      throw new Error('Error al generar el PDF.');
    }

    const blob = await response.blob();
    const url = window.URL.createObjectURL(blob);
    window.open(url, '_blank');
  } catch (error) {
    // Capturar errores de la solicitud fetch
 
      Swal.fire("Mensaje de error", error.message, "error");
  } finally {
    // Restaurar el estado del botón independientemente del éxito o fracaso
    $(btn).html('<i class="fa fa-fw fa-download"></i>');
    $(btn).prop('disabled', false);
  }
}


function check_access() {
    var  id_year = $("#year_to_studente").val();
    var lock_access= $("#key_lock_input").val();
    $.get('../controlador/collaboration/controller_access_card.php', { key_access: lock_access,id_year:id_year })
        .done(function(resultado) {
            var response = JSON.parse(resultado);
            if (response.status) {
              getStudentsXml(id_year);
            } else {
                Swal.fire("Mensaje de error", response.msg, "error");
            }
        })
}

