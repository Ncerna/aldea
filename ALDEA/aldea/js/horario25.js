var temdata;
//IdJornas,gradoid,gradonombre,tunoid,turno_nombre,nivelGrado,nombreNivell,seccionjor,idAula,nombreaula
function listar_combo_Horas_Academicos() {
    var identi = '';
    var nameCombo = "--seleccione--";
    var yearid = $("#YearActualActivo").val();
    $.ajax({
        "url": "../controlador/horario/controlador_combo_jornadas.php",
        type: 'POST',
        data: {
            yearid: yearid
        }
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            temdata = data;
            cadena += "<option value='" + identi + "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'> " + data[i][2] + "| TURNO:" + data[i][4] + "| NIVEL:" + data[i][6] + "| SECC:" + data[i][7] + "| AULA:" + data[i][9] +"</option>";
            }
            $('#cbm_jornada').html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#cbm_jornada").html(cadena);
        }
    })
}
//IdJornas,gradoid,gradonombre,tunoid,turno_nombre,nivelGrado,nombreNivell,seccionjor
//FILTRAR TURNOS GRAGO NIVELES DEL COMBO JORNADAS
async function listar_liter_Grado_nivel_turno(id) {
    let filters = temdata.filter(item => item.IdJornas == id)
    $("#txt_gradoId").val(filters[0][1]);
    $("#txt_turnoId").val(filters[0][3]);
    $("#txt_nivelId").val(filters[0][5]);
    $("#txt_seccionId").val(filters[0][7]);
    $("#idAula").val(filters[0][8]);
    $("#txt_nivel_nivel").val(filters[0][2] + " | " + filters[0][6]);
    $("#text_seccion").val(filters[0][4] + " | " + filters[0][7]+ " | " + filters[0][9]);
}

function Consultar_Horarios_Generados() {
    $("#cbm_jornada").prop("disabled", true);

    var idjornada = $('#cbm_jornada').val();
    var idgrado = $('#txt_gradoId').val();
    var idnivel = $('#txt_nivelId').val();
    var seccion = $('#txt_seccionId').val();
    var turnoId = $('#txt_turnoId').val();
     var idaula = $('#idAula').val();
    var idhorario = 'NULL';
    var yearid = $("#YearActualActivo").val();
    var stado = 'NUEVO';

  
    $("#contenido_principal").load("jornadas/vista_creatd_horario25.php?idjornada=" + idjornada+ "&yearid=" + yearid + "&idgrado=" + idgrado +
         "&idnivel=" + idnivel+ "&seccion=" + seccion+ "&turnoId=" + turnoId+ "&idhorario=" + idhorario+ "&stado=" + stado+ "&idaula=" + idaula);
}

//abrir modal//
function AbrirModalRegistroHorario(){
 $("#contenido_principal").load("jornadas/view_crear_horario_clases.php");
}

/////////GESTION DE HORARIOS///////////
function funcion_array_creatd_horario() {
  
    var dragged;
    var copia;
    var idcurso;

    /* events fired on the draggable target */
    document.addEventListener("drag", function(event) {}, false);
    document.addEventListener("dragstart", function(event) {
        // store a ref. on the dragged elem
        dragged = event.target;
        // make it half transparent
        event.target.style.opacity = .10;
        idcurso = event.target.getAttribute("idcurso");
        copia = "<div> " + dragged.innerHTML + "<br ><a style='margin-left:4px;' href='javascript:void(0)'><span class='label' style='background-color:#05ccc4;'><em class=' fa fa-close'></em></span></a></div>";
        event.dataTransfer.setData('Text', copia);
    }, false);
    document.addEventListener("dragend", function(event) {
        // reset the transparency
        event.target.style.opacity = "";
    }, false);
    /* events fired on the drop targets */
    document.addEventListener("dragover", function(event) {
        // prevent default to allow drop
        event.preventDefault();
    }, false);
    document.addEventListener("dragenter", function(event) {
        // highlight potential drop target when the draggable element enters it
        if (event.target.className == "dropzone") {
            event.target.style.background = "#7c8786";
        }
    }, false);
    document.addEventListener("dragleave", function(event) {
        // reset background of potential drop target when the draggable element leaves it
        if (event.target.className == "dropzone") {
            event.target.style.background = "";
        }
    }, false);
    document.addEventListener("drop", function(event) {
        // prevent default action (open as link for some elements)

        var idgrado=$("#php_gradoId").val();
        var idturno=$("#php_turnoId").val();
        var idnivel=$("#php_nivelId").val();
        var idseccion=$("#php_seccionId").val();
        var idjornada=$("#php_jornadaId").val();
        var idyear=$("#php_yearId").val();
          var idaula=$("#php_idaula").val();

       // event.preventDefault();
        // move dragged elem to the selected drop target
        if (event.target.className == "dropzone") {
            event.target.style.background = "";
            event.target.innerHTML = event.dataTransfer.getData("Text");
            var hora = event.target.getAttribute("idhora");
            var dia = event.target.getAttribute("iddia");
            var idtd = event.target.getAttribute("id");
            var idhorario = event.target.getAttribute("idhorario");
            // var curso = idcurso;
            $("#" + idtd + " > div > a").click(function() {
                Quitar_Agregados_table(idtd);
            });

            Save_Horarios_Horas(idtd, hora, dia, idcurso,idgrado,idturno,idnivel,idseccion,idjornada,idyear,idaula);
            
            event.target.style.height = "auto";
        }
    }, true);
}

var selecionado=[];
function Save_Horarios_Horas(idtd, hora, dia, idcurso,idgrado,idturno,idnivel,idseccion,idjornada,idyear,idaula) { 

    const existeIdtd = selecionado.some(item => item.idtd === idtd);
// Si el idtd no existe, agregar el nuevo elemento
if (!existeIdtd) {
 selecionado.push({ idtd:idtd, hora:hora, dia:dia,idcurso:idcurso,idgrado:idgrado, idturno:idturno,
         idnivel:idnivel, idseccion:idseccion,idjornada:idjornada,idyear:idyear, idaula:idaula
    });
}
}

function Quitar_Agregados_table(idtd) {
    selecionado = selecionado.filter(item => item.idtd !== idtd);
    $("#" + idtd).empty();
     $("#" + idtd).css("height", "50px");
}

function sonIguales(obj1, obj2) {
  return JSON.stringify(obj1) === JSON.stringify(obj2);
}

function Registrar_horario_Clases(){

const valueunique = selecionado.filter((horario, index, self) => {
  return self.findIndex((h) => sonIguales(horario, h)) === index;
});

  var horarios= JSON.stringify(valueunique);
  if (horarios.length==0) {
    return Swal.fire("Mensaje De Advertencia", "Debes arrastrar los cursos a los cacilleros ", "warning");
}

 $('.loader').show();////prende
 $('#button_resgist').prop('disabled',true);
 $.ajax({
    type: "POST",
    url: "../controlador/horario/controlador_registra_horario.php",
    data: {horarios:horarios}
}).done(function(resp) {
    var data = JSON.parse(resp);
    if (data>0) {
        if (data==100) {

                 $('.loader').hide();////prende
                 $('#button_resgist').prop('disabled',false);
               $("#cbm_jornada").prop("disabled", true);
                 return Swal.fire("Mensaje De Advertencia", "Horario ya existe para el grado seleccionado !!", "warning");
             }
             if (data==1){
                 
                Swal.fire({icon: 'success', title: 'Mensaje de Éxito !!', text: 'El Registro, se registró con éxito!!',showConfirmButton: false,timer: 1500 });
                $("#contenido_principal").load("jornadas/vista_listar_horaio_clases25.php");
                $('.loader').hide();////prende
                $('#button_resgist').prop('disabled',false);
                selecionado = [];
            }if (data==500){
            $('.loader').hide();////prende
            $('#button_resgist').prop('disabled',false);
            return Swal.fire("Mensaje De Error", "No hay nada que registrar :"+resp, "error");
        }

    }else {
             $('.loader').hide();////prende
             $('#button_resgist').prop('disabled',false);
             return Swal.fire("Mensaje De Error", "No se registro debido al error de :"+resp, "error");
         }
         
     })
$("#cbm_jornada").prop("disabled", false);
}
function Regresar_listar_Horarios(){
    $("#contenido_principal").load("jornadas/vista_listar_horaio_clases25.php");
}