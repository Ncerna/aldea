var editandoEntry = false;
var tableEntry;
var params = {};

function openModalEntry() {
    editandoEntry = false;
    $("#modal_entry").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#tituloModal").text('Nueva Ingreso Monetario');
    categoryEntrySelect();
    $('#modal_entry').modal('show');
}

function Register_entry() {
    var data = {
        identry: $("#identry").val(),
        description: $("#description").val().toLowerCase(),
        payment: $("#payment").val().toLowerCase(),
        amount: $("#amount").val(),
        dateoperation: $("#dateoperation").val(),
        category: $("#cmb_category").val(),
    };

     if(!validateData(data)) return Swal.fire("Mensaje de advertencia", "Llene todo los campos. ", "warning");

    $.post(
        editandoEntry ? '../controlador/entry/ControllerUpdateEntry.php' :
         '../controlador/entry/ControllerRegisterEntry.php',
        data
    )
        .done(function (resultado) {
            var response = JSON.parse(resultado);
            if (response.status) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Éxito !!',
                    text: response.msg,
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modal_entry').modal('hide');
                 tableEntry.ajax.reload();
                clean_input_values();
            } else {
                Swal.fire("Mensaje de error", response.msg, "error");
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 403) {
                Swal.fire("Mensaje de error", "No Autorizado.", "error");
            } else {
                Swal.fire("Mensaje de error", errorThrown, "error");
            }
        });
}

function clean_input_values() {
    $("#identry").val('');
    $("#description").val('');
    $("#payment").val('');
    $("#amount").val('');
    //$("#dateoperation").val('');
    editandoEntry = false;
}

function validateData(data) {
    if ( !data.description.trim() || !data.payment.trim()  ||
         !data.amount.trim() || !data.category.trim() 
    ) { return false;
    }
 return true;
}

function List_entry() {
     params = { start: $("#date_ini").val(), end: $("#date_final").val() }

     tableEntry = $("#table_entry").DataTable({
    "footerCallback": function (row, data, start, end, display) {
       var api = this.api();
       var intVal = function (i) { return typeof i === 'string' ? parseFloat(i.replace(/[\$,]/g, '')) : typeof i === 'number' ? i : 0; };
       var monTotal = api.column(5).data().reduce(function (a, b) { return intVal(a) + intVal(b);}, 0);
       $(api.column(0).footer()).html('Total de ingresos:');
        $(api.table().footer()).css('background-color', '#d6edf5');
       $(api.column(5).footer()).html(monTotal.toFixed(2)); // Formatear a dos decimales
       },
        "ordering": false,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },
        "responsive": true,
        dom: 'Bfrtilp',
         buttons: [
          {  extend: 'excelHtml5',
            title: 'REPORTE DE IGRESO GENERAL',
          },
          { extend: 'csvHtml5',
            title: 'REPORTE DE IGRESO GENERAL',
          },
          {extend: 'pdfHtml5',
            title: 'REPORTE DE IGRESO GENERAL',
          },
          {extend: 'print',
            title: 'REPORTE DE IGRESO GENERAL',
          },
        ],
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "pageLength": 10,
        "destroy": true,
        
        "processing": true,
      "ajax": {
            "url": "../controlador/entry/ControllerGetEntry.php",
            type: 'POST',
            data:params
        },
        "columns": [
          { "data": null, "render": function (data, type, row, meta) { return meta.row + 1; } },
            { "data": "identry" },
            { "data": "description" },
            { "data": "categoryentry"},
            { "data": "payment" },
            { "data": "amount" },
            { "data": "dateoperation" },
            { "data": "categoryentry",
             render: function(data, type, row) {
             return data == 'PENCION' || "MATRÍCULA"? "<button type='button' class='editar btn btn-primary btn-sm' ><i class='fa fa-edit' ></i></button>"+
             "&nbsp;<button type='button' class='eliminar btn btn-default btn-sm' ><i class='fa fa-trash' ></i></button>"
             :
             "<button type='button' class=' btn btn-default btn-sm' disabled><i class='fa fa-edit' ></i></button>"+
             "&nbsp;<button type='button' class=' btn btn-default btn-sm' disabled><i class='fa fa-trash' ></i></button>";
             }
              
             },
    ],
        "language": idioma_espanol,
        select: true,

    });
     /*
     "<button type='button' class='editar btn btn-primary btn-sm' ><i class='fa fa-edit' ></i></button>&nbsp;<button type='button' class='eliminar btn btn-default btn-sm' ><i class='fa fa-trash' ></i></button>"
     */
     
    document.getElementById("table_entry_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
         filterGlobalEntry();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

  tableEntry.column(1).visible( false );
   $('#btn-place').html(tableEntry.buttons().container());
}

function filterGlobalEntry() {
    $('#table_entry').DataTable().search($('#global_filter').val()).draw();
}

$('#table_entry').on('click', '.editar', function () {
    var data = tableEntry.row(tableEntry.row(this).child.isShown() ? this : $(this).parents('tr')).data();
    
    $.post('../controlador/entry/ControllerShowentry.php', { id: data.identry })
        .done(function (resultado) {
            var response = JSON.parse(resultado);
            if (response.status) {
                showEntry(response.data);
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 403) {
                Swal.fire("Mensaje de error", "No Autorizado.", "error");
            } else {
                Swal.fire("Mensaje de error", errorThrown, "error");
            }
        });
});

function showEntry(data) {
    if (data && Object.keys(data).length > 0) {
        editandoEntry = true;
        $("#identry").val(data.identry);
        $("#description").val(data.description);
        $("#payment").val(data.payment);
        $("#amount").val(data.amount);
        $("#dateoperation").val(data.dateoperation);
       
        categoryEntrySelect(data.category_id);
        $("#modal_entry").modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#tituloModal").text('Editando Entrada: ' + data.identry);
        $('#modal_entry').modal('show');
    } else {
        Swal.fire("Mensaje de error", "No se pudieron cargar los datos de la entrada.", "error");
    }
}

$('#table_entry').on('click', '.eliminar', function () {
    var data = tableEntry.row(tableEntry.row(this).child.isShown() ? this : $(this).parents('tr')).data();

    Swal.fire({
        title: '¿Está seguro de dar de baja?',
        text: "Una vez hecho esto no podrá recuperar la entrada.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#05ccc4',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí'
    }).then((result) => {
        if (result.value) {
            removeEntry(data.identry);
        }
    });
});

function removeEntry(identry) {
    $.post('../controlador/entry/ControllerRemoveEntry.php', { identry: identry })
        .done(function (resultado) {
            var response = JSON.parse(resultado);
            if (response.status) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Éxito !!',
                    text: response.msg,
                    showConfirmButton: false,
                    timer: 1500
                });
                tableEntry.ajax.reload();
            } else {
                Swal.fire("Mensaje de error", response.msg, "error");
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 403) {
                Swal.fire("Mensaje de error", "No Autorizado.", "error");
            } else {
                Swal.fire("Mensaje de error", errorThrown, "error");
            }
        });
}

function categoryEntrySelect(id) {
  $.post('../controlador/entry/ControllerGetCategoryEntry.php')
    .done(function (resultado) {
      var response = JSON.parse(resultado);
         let { data } = response;
         var cadena = "";
      if (data.length>0) {
          for (var i = 0; i < data.length; i++) {

            cadena += "<option value='" + data[i].id + "'" +
              (data[i].id == id ? " selected" : "") + ">" + data[i].categoryentry + "</option>";
          
        } 
      } else cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        $("#cmb_category").html(cadena);
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      if (jqXHR.status === 403) {
        Swal.fire("Mensaje de error", "No Autorizado.", "error");
      } else {
        Swal.fire("Mensaje de error", errorThrown, "error");
      }
    });
}


