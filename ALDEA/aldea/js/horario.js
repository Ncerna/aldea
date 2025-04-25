

//abrir modal//
function AbrirModalRegistroHorario(){
 
// $("#contenido_principal").load("jornadas/view_crear_horario_clases.php");
 $("#contenido_principal").load("jornadas/vista_creatd_horario25.php");
}

/////////GESTION DE HORARIOS///////////
function crearHorarios() {
  
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
    
        var php_idHorario=$("#php_idHorario").val();
  
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
                Eliminar_Horas_add(idtd);
            });

            Save_Horarios_Horas(idtd, hora, dia, idcurso,idgrado,idturno,idnivel,idseccion,idjornada,idyear,php_idHorario,idaula);
            
            event.target.style.height = "auto";
        }
    }, true);
}
 
var registrados=[];

function Save_Horarios_Horas(idtd, hora, dia, idcurso,idgrado,idturno,idnivel,idseccion,idjornada,idyear,php_idHorario,idaula) {
    
   idaula = (idaula !== null) ? idaula : $("#php_idaula").val();

    var data = {idtd: idtd, hora: hora, dia: dia,idcurso: idcurso,idgrado:idgrado,
       idturno:idturno,idnivel:idnivel,idseccion:idseccion,idjornada:idjornada,
       idyear:idyear,php_idHorario:php_idHorario,idaula:idaula};

       
const existeIdtd = registrados.some(item => item.idtd === idtd);

if (!existeIdtd) {

console.log("............")
}else{
return;
}


 registrados.push(data);

var url = "../controlador/horario/controlador_Actualizar_horario.php";
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function(r) {
            var d = JSON.parse(r);
            $('#' + idtd).attr('idhorario', d['id']);
           if (d>0) {
             createNotification('Grnial Se agrego correctamente','success'); 
           }else{
             return Swal.fire("Mensaje De error", "No se pudo completar el registro!! "+r, "error");
           }
        }
    });
    

}

function Eliminar_Horas_add(idtd) {

     registrados = registrados.filter(item => item.idtd !== idtd);

       console.log(registrados);

    var data = {
        horario: $('#' + idtd).attr('idhorario')
    };
    var url = "../controlador/horario/controlador_eliminar_horario.php";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            idtd: idtd
        },
        success: function(r) {
            var d = JSON.parse(r);
            $("#" + idtd).empty();
            $("#" + idtd).css("height", "50px");
             createNotification('Quitado !!','success'); 
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            createNotification(errorThrown,'error');
             }
    });

    /*selecionado = selecionado.filter(item => item.idtd !== idtd);
    $("#" + idtd).empty();
     $("#" + idtd).css("height", "50px");*/
    

}




var table_horario;
function listar_Horarios_Disponibles() {
   var yearid = $("#YearActualActivo").val();

   table_horario = $("#tabla_horarios").DataTable({
    "ordering": false,
    "bLengthChange": false,
    "searching": {
        "regex": false
    },
    "lengthMenu": [
    [10, 25, 50, 100, -1],
    [10, 25, 50, 100, "All"]
    ],
    "pageLength": 10,
    "destroy": true,
    "async": false,
    "processing": true,
    "ajax": {
        "url": "../controlador/horario/controlador_listar_horario.php",
        type: 'POST',
        data:{yearid:yearid}
    },
    "columns": [{
        "data": "idhorario" },

        {"data": "gradonombre"},
        {"data": "turno_nombre"},
        {"data": "nombreNivell"},
        {"data": "seccionId"},
        {"data": "nombreaula"},
        {"data": "jornadId"},
        {
            "defaultContent": "<button  type='button' class='editHorario btn btn-primary btn-sm' title='Vista Previa'><em class='fa fa-edit'></em></button>"+
            "&nbsp;<button  type='button' class='imprimir btn btn-default btn-sm' title='Imprimir Horario'><em class='fa fa-print'></em></button>"+
            "&nbsp;<button  type='button' class='eliminar btn btn-default btn-sm' title='eliminar'><em class='fa fa-trash'></em></button>"
        }],
        "language": idioma_espanol,
        select: true,
    });
   document.getElementById("tabla_horarios_filter").style.display = "none";
   $('input.global_filter').on('keyup click', function() {
    filterGlobal();
});
   $('input.column_filter').on('keyup click', function() {
    filterColumn($(this).parents('tr').attr('data-column'));
});
   table_horario.column( 0 ).visible( false );
    //ESCONDIENDO ID DE LA JORNADA
    table_horario.column( 6 ).visible( false );
}

function filterGlobal() {
    $('#tabla_horarios').DataTable().search($('#global_filter').val(), ).draw();
}


$('#tabla_horarios').on('click', '.editHorario', function() {
    var data = table_horario.row($(this).parents('tr')).data();
    if (table_horario.row(this).child.isShown()) {
        var data = table_horario.row(this).data();
    }
    var idjornada = data.jornadId;
     var idgrado = data.gradoId;
     var idnivel = data.nivelId;
     var seccion = data.seccionId;
      var turnoId = data.turnoId;
       var idhorario = data.idhorario;
       var idaula = data.aula_id;
    var yearid = $("#YearActualActivo").val();


  
    $("#contenido_principal").load("jornadas/view_edit_horario_clases25.php?idjornada=" + idjornada+ "&yearid=" + yearid + "&idgrado=" + idgrado +
         "&idnivel=" + idnivel+ "&seccion=" + seccion+ "&turnoId=" + turnoId+ "&idhorario=" + idhorario+  "&idaula=" + idaula);
    
});




$('#tabla_horarios').on('click', '.imprimir', function() {
    var data = table_horario.row($(this).parents('tr')).data();
    if (table_horario.row(this).child.isShown()) {
        var data = table_horario.row(this).data();
        
         var idjornada = data.jornadId;
         var idhorario = data.idhorario;
    }
  
    var idjornada = data.jornadId;
    var idhorario = data.idhorario;

     window.open("../vista/jornadas/vista_imprimir_horario.php?idjornada=" + idjornada+
        "&idhorario=" + idhorario+ "&seccionId=" + data.seccionId+
        "#zoom=75%","report","scrollbars=NO");
  
});



$('#tabla_horarios').on('click', '.eliminar', function() {
    var data = table_horario.row($(this).parents('tr')).data();
    if (table_horario.row(this).child.isShown()) {
        var data = table_horario.row(this).data();
        var id = data.idhorario;
    }
    var id = data.idhorario;

    Swal.fire({
        title: 'Esta seguro de eliminar el horaio?',
        text: "Una vez hecho esto no podras recuperar el horario",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#05ccc4',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.value) {

           $.ajax({
            url: '../controlador/horario/controlador_delete_registro.php',
            type: 'POST',
            data: {
                id: id
            }
        }).done(function(resp) {
            if (resp > 0) {
            Swal.fire({ icon: 'success', title: 'Éxito !!', text: 'El Registro, se registro  de forma Éxitoso!! ',showConfirmButton: false, timer: 1700});  
             table_horario.ajax.reload();
         } else {
            Swal.fire("Mensaje De Error", "No se pudo Eliminar "+resp+"", "error");
        }
    });
    }
}) 

});





//https://www.stechies.com/uncaught-syntaxerror-unexpected-end-json-input/
function Regresar_listar_Horarios(){
   
    $("#contenido_principal").load("jornadas/vista_listar_horaio_clases25.php");
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
