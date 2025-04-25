var editandoCategoryExit = false;
var tableCategoryExit;

function openModalCategoryExit() {
    editandoCategoryExit = false;
    $("#modal_categoryexit").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#tituloModal").text('Nueva Categoría de Salida');
    $('#modal_categoryexit').modal('show');
}

function Register_categoryexit() {
    var data = {
        id: $("#id").val(),
        categoryexit: $("#categoryexit").val().toUpperCase(),
        date_create: $("#date_create").val(),
      
    };
     if(!data.categoryexit.trim()) return;
    $.post(
        editandoCategoryExit ? '../controlador/exit/ControllerUpdateExit.php' : 
        '../controlador/exit/ControllerRegisterExit.php',
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
                tableCategoryExit.ajax.reload();
                $('#modal_categoryexit').modal('hide');
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
    $("#categoryexit").val('');
   // $("#date_create").val('');
   // $("#date_update").val('');
    editandoCategoryExit = false;
}

function List_categoryexit() {
      tableCategoryExit = $("#table_categoryexit").DataTable({
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
            "url": "../controlador/exit/ControllerGetCategoryExit.php",
            type: 'POST'
        },
        "columns": [
            { "data": null, "render": function (data, type, row, meta) { return meta.row + 1; } },
            { "data": "id" },
            { "data": "categoryexit" },
            { "data": "date_create" },
            { "data": "date_update" },
        {
        "defaultContent": "<button type='button' class='editar btn btn-primary btn-sm' ><i class='fa fa-edit' ></i>&nbsp Editar</button>"+
         "&nbsp;<button type='button' class='eliminar btn btn-danger btn-sm' ><i class='fa fa-trash' ></i>&nbsp Quitar</button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("table_categoryexit_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobalCategoryExit()
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

  tableCategoryExit.column(1).visible( false );
}

function filterGlobalCategoryExit() {
    $('#table_categoryexit').DataTable().search($('#global_filter').val()).draw();
}

$('#table_categoryexit').on('click', '.editar', function () {
    var data = tableCategoryExit.row(tableCategoryExit.row(this).child.isShown() ? this : $(this).parents('tr')).data();

    $.post('../controlador/exit/ControllerShowExit.php', { id: data.id })
        .done(function (resultado) {
            var response = JSON.parse(resultado);
            if (response.status) {
                showCategoryExit(response.data);
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

function showCategoryExit(data) {
    if (data && Object.keys(data).length > 0) {
        editandoCategoryExit = true;
        $("#id").val(data.id);
        $("#categoryexit").val(data.categoryexit);
        $("#date_create").val(data.date_create);
        $("#date_update").val(data.date_update);

        $("#modal_categoryexit").modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#tituloModal").text('Editando Categoría de Salida: ' + data.categoryexit);
        $('#modal_categoryexit').modal('show');
    } else {
        Swal.fire("Mensaje de error", "No se pudieron cargar los datos de la categoría de salida.", "error");
    }
}

$('#table_categoryexit').on('click', '.eliminar', function () {
    var data = tableCategoryExit.row(tableCategoryExit.row(this).child.isShown() ? this : $(this).parents('tr')).data();

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
            removeCategoryExit(data.id);
        }
    });
});

function removeCategoryExit(id) {
    $.post('../controlador/exit/ControllerRemoveExit.php', { id: id })
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
                tableCategoryExit.ajax.reload();
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
