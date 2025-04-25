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
        "url": "../controlador/docenteSesion/controlador_listar_horario.php",
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
            "defaultContent": "<button  type='button' class='verhorarios btn btn-primary btn-sm' title='Vista Previa'><em class='fa fa-eye-slash' ></em></button>"+
            "&nbsp;<button  type='button' class='imprimir btn btn-default btn-sm' title='Imprimir Horario'><em class='fa fa-print'></em></button>"
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


$('#tabla_horarios').on('click', '.verhorarios', function() {
    var data = table_horario.row($(this).parents('tr')).data();
    if (table_horario.row(this).child.isShown()) {
        var data = table_horario.row(this).data();
    }
    var idjornada = data.jornadId;
     var idgrado = data.gradoId;
     var idnivel = data.nivelId;
     var seccion = data.seccionId;
      var turnoId = data.turnoId;

    var yearid = $("#YearActualActivo").val();


  
    $("#contenido_principal").load("docenteSesion/view_edit_horario_clases25.php?idjornada=" + idjornada+ "&yearid=" + yearid + "&idgrado=" + idgrado +
         "&idnivel=" + idnivel+ "&seccion=" + seccion+ "&turnoId=" + turnoId);
    
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
     var yearid = $("#YearActualActivo").val();

     window.open("../vista/docenteSesion/vista_imprimir_horario.php?idjornada=" + idjornada+
        "&idhorario=" + idhorario+ "&seccionId=" + data.seccionId+"&gradoId=" + data.gradoId+ "&yearid=" + yearid+ 
        "#zoom=75%","report","scrollbars=NO");
  
});
