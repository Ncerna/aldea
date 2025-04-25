var editandoFixedCoste = false;
var tableFixedCoste;

function openModalFixedCoste() {
    editandoFixedCoste = false;
    $("#modal_fixedcoste").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#tituloModal").text('Nuevo Costo Fijo');
    $('#modal_fixedcoste').modal('show');
}

function Register_fixedcoste() {
    var data = {
        idfixed: $("#idfixed").val().toLowerCase(),
        name: $("#name").val(),
        date_create: $("#date_create").val()
    };
     if(!data.name.trim()) return;
    $.post(
        editandoFixedCoste ? '../controlador/fixedCost/ControllerFixedCosteUpdate.php' :
         '../controlador/fixedCost/ControllerFixedCosteRegister.php',
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
                tableFixedCoste.ajax.reload();
                $('#modal_fixedcoste').modal('hide');
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
    $("#idfixed").val('');
    $("#name").val('');
   //$("#date_create").val('');
    editandoFixedCoste = false;
}

function List_fixedcoste() {
   tableFixedCoste = $("#table_fixedcoste").DataTable({
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
            "url": "../controlador/fixedCost/ControllerFixedCosteGet.php",
            type: 'POST'
        },
        "columns": [
            { "data": null, "render": function (data, type, row, meta) { return meta.row + 1; } },
            { "data": "idfixed" },
            { "data": "name" },
            { "data": "date_create" },
            { "data": "date_update" },
             {
        "defaultContent": "<button type='button' class='editar btn btn-primary btn-sm' ><i class='fa fa-edit' ></i>&nbsp Editar</button>"+
         "&nbsp;<button type='button' class='eliminar btn btn-default btn-sm' ><i class='fa fa-trash' ></i>&nbsp Quitar</button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("table_fixedcoste_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
         filterGlobalFixedCoste();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

  tableFixedCoste.column(1).visible( false );

}

function filterGlobalFixedCoste() {
    $('#table_fixedcoste').DataTable().search($('#global_filter').val()).draw();
}

$('#table_fixedcoste').on('click', '.editar', function () {
    var data = tableFixedCoste.row(tableFixedCoste.row(this).child.isShown() ? this : $(this).parents('tr')).data();

    $.post('../controlador/fixedCost/ControllerFixedCosteShow.php', { id: data.idfixed })
        .done(function (resultado) {
            var response = JSON.parse(resultado);
            if (response.status) {
                showFixedCoste(response.data);
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

function showFixedCoste(data) {
   
        editandoFixedCoste = true;
        $("#idfixed").val(data.idfixed);
        $("#name").val(data.name);
        $("#date_create").val(data.date_create);
        $("#date_update").val(data.date_update);
        $("#modal_fixedcoste").modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#tituloModal").text('Editando Costo Fijo: ' + data.name);
        $('#modal_fixedcoste').modal('show');
    
}

$('#table_fixedcoste').on('click', '.eliminar', function () {
    var data = tableFixedCoste.row(tableFixedCoste.row(this).child.isShown() ? this : $(this).parents('tr')).data();

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
            removeFixedCoste(data.idfixed);
        }
    });
});

function removeFixedCoste(idfixed) {
    $.post('../controlador/fixedCost/ControllerFixedCosteRemove.php', { idfixed: idfixed })
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
                tableFixedCoste.ajax.reload();
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
