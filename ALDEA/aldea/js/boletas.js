
var tlb_students;
function getStudents() {
   var idyear  = $("#YearActualActivo").val();
    tlb_students = $("#tlb_students").DataTable({
        "ordering": true,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },

        "responsive": true,
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ] ,
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            url: "../controlador/boletin/controlador_alumnos_listar.php",
            type: 'POST',
            data:{idyear:idyear}
                },
        "columns": [
           {"data": "idalumno"},
           { "data": "apellidos"},
           {"data": "alumnonombre"},
           {"data": "gradonombre"},
           {"data": "nombreNivell"},
           {"data": "seccion"},
           {
              "data": null,
              "defaultContent": "<button  class='imprimir btn btn-sm' ><em class='fa fa-file-pdf-o' style='color: red;'></em></button>"
           }
        ],
        "language": idioma_espanol,
        select: true
    });
        document.getElementById("tlb_students_filter").style.display = "none";
        $('input.global_filter').on('keyup click', function() {

            filterGlobal();
        });
        $('input.column_filter').on('keyup click', function() {
            filterColumn($(this).parents('tr').attr('data-column'));
        });
         tlb_students.column( 0 ).visible( false );
   

}

function filterGlobal() {
    $('#tlb_students').DataTable().search($('#global_filter').val(), ).draw();
}



$('#tlb_students').on('click', '.imprimir', function() {
    var data = tlb_students.row(tlb_students.row(this).child.isShown() ? this :
    $(this).parents('tr')).data();
      var idalumno=data.idalumno;
        var id_year  = $("#YearActualActivo").val();
        var idgrado=data.Id_grado;

         window.open("../vista/reportePDF/ticket/report_pdf_card.php?idalumno="+parseInt(idalumno)+"&id_year="+
      parseInt(id_year)+"&idgrado="+parseInt(idgrado)+
        "#zoom=95%","report","scrollbars=NO");
   
    
   
})