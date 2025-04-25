var editandoCategoryEntry = false;
var tableCategoryEntry;

function openModalCategoryEntry() {
    editandoCategoryEntry = false;
    $("#modal_categoryentry").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#tituloModal").text('Nueva Categoría de Entrada');
    $('#modal_categoryentry').modal('show');
}

function Register_categoryentry() {
    var data = {
        id: $("#id").val(),
        categoryentry: $("#categoryentry").val().toUpperCase(),
        date_create: $("#date_create").val(),
        
    };
    if(!data.categoryentry.trim()) return;
    $.post(
        editandoCategoryEntry ? '../controlador/entry/ControllerUpdateCategoryEntry.php' : 
        '../controlador/entry/ControllerRegisterCategoryEntry.php',
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
                tableCategoryEntry.ajax.reload();
                $('#modal_categoryentry').modal('hide');
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
    $("#id").val('');
    $("#categoryentry").val('');
    $("#date_create").val('');
   
    editandoCategoryEntry = false;
}

function List_categoryentry() {
     tableCategoryEntry = $("#table_categoryentry").DataTable({
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
        "processing": true,
      "ajax": {
            "url": "../controlador/entry/ControllerGetCategoryEntry.php",
            type: 'POST'
        },
        "columns": [
      { "data": null,"render": function (data, type, row, meta) {return meta.row + 1; }},
        { "data": "id"},
       { "data": "categoryentry" },
       { "data": "date_create" },
       { "data": "date_update" }, {
        "defaultContent": "<button type='button' class='editar btn btn-primary btn-sm' ><i class='fa fa-edit' ></i>&nbsp Editar</button>"+
         "&nbsp;<button type='button' class='eliminar btn btn-default btn-sm' ><i class='fa fa-trash' ></i>&nbsp Quitar</button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("table_categoryentry_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobalCategoryEntry();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

  tableCategoryEntry.column(1).visible( false );

}

function filterGlobalCategoryEntry() {
    $('#table_categoryentry').DataTable().search($('#global_filter').val()).draw();
}

$('#table_categoryentry').on('click', '.editar', function () {
    var data = tableCategoryEntry.row(tableCategoryEntry.row(this).child.isShown() ? this : $(this).parents('tr')).data();

    $.post('../controlador/entry/ControllerShowCategoryEntry.php', { id: data.id })
        .done(function (resultado) {
            var response = JSON.parse(resultado);
            if (response.status) {
                showCategoryEntry(response.data);
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

function showCategoryEntry(data) {
    if (data && Object.keys(data).length > 0) {
        editandoCategoryEntry = true;
        $("#id").val(data.id);
        $("#categoryentry").val(data.categoryentry);
        $("#date_create").val(data.date_create);
        $("#date_update").val(data.date_update);

        $("#modal_categoryentry").modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#tituloModal").text('Editando Categoría de Entrada: ' + data.categoryentry);
        $('#modal_categoryentry').modal('show');
    } else {
        Swal.fire("Mensaje de error", "No se pudieron cargar los datos de la categoría de entrada.", "error");
    }
}

$('#table_categoryentry').on('click', '.eliminar', function () {
    var data = tableCategoryEntry.row(tableCategoryEntry.row(this).child.isShown() ? this : $(this).parents('tr')).data();

    Swal.fire({
        title: '¿Está seguro de dar de baja?',
        text: 'Una vez hecho esto no podrá recuperar los datos.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#05ccc4',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí'
    }).then((result) => {
        if (result.value) {
            removeCategoryEntry(data.id);
        }
    });
});



function removeCategoryEntry(id) {
    $.post('../controlador/entry/ControllerRemoveCategoryEntry.php', { id: id })
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
                tableCategoryEntry.ajax.reload();
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
