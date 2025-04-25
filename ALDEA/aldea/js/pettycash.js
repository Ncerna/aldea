var editando_PettyCash = false;
var tablePettyCash;

function openModalPettyCash() {
    editando_PettyCash = false;
    $("#modal_pettycash").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#tituloModal").text('Nuevo Caja Chica');
    $('#modal_pettycash').modal('show');
}

function Register_pettycash() {
    var data = {
        idpetty: $("#idpetty").val(),
        pettycashname: $("#pettycashname").val().toLowerCase(),
        amountmax: $("#amountmax").val(),
        amountmin: $("#amountmin").val(),
        iscurrent: $("input[name='iscurrent']:checked").val(),
        date_create: $("#date_create").val(),
       
    };
    $.post(
        editando_PettyCash ? '../controlador/pettycash/ControllerUpdatePettyCash.php' :
         '../controlador/pettycash/ControllerRegisterPettyCash.php',
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
                tablePettyCash.ajax.reload();
                $('#modal_pettycash').modal('hide');
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
    $("#idpetty").val('');
    $("#pettycashname").val('');
    $("#amountmax").val('');
    $("#amountmin").val('');
    $("input[name='iscurrent']").prop("checked", false);
    $("#status").val('');
    editando_PettyCash = false;
}

function List_pettycash() {
 tablePettyCash = $("#table_pettycash").DataTable({
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
            "url": "../controlador/pettycash/ControllerGetPettyCash.php",
            type: 'POST'
        },
        "columns": [
            { "data": null, "render": function (data, type, row, meta) { return meta.row + 1; } },
            { "data": "idpetty" },
            { "data": "pettycashname" },
            { "data": "amountmax" },
            { "data": "amountmin" },
            {
                "data": "iscurrent",
                "render": function (data, type, row) { return data==0 ? "Closing" : "Open"; }
            },

            { "data": "status" },
            { "data": "date_create" },
            { "data": "date_update" },
            {
        "defaultContent": "<button type='button' class='editar btn btn-primary btn-sm' ><i class='fa fa-edit' ></i>&nbsp Editar</button>"+
         "&nbsp;<button type='button' class='eliminar btn btn-default btn-sm' disabled><i class='fa fa-trash' ></i>&nbsp Quitar</button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("table_pettycash_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
         filterGlobalPettyCash() 
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

  tablePettyCash.column(1).visible( false );

}

function filterGlobalPettyCash() {
    $('#table_pettycash').DataTable().search($('#global_filter').val()).draw();
}


$('#table_pettycash').on('click', '.editar', function () {
    var data = tablePettyCash.row(tablePettyCash.row(this).child.isShown() ? this : $(this).parents('tr')).data();

    $.post('../controlador/pettycash/ControllerShowPettyCash.php', { id: data.idpetty })
        .done(function (resultado) {
            var response = JSON.parse(resultado);
            if (response.status) {
                showPettyCash(response.data);
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


function showPettyCash(data) {
    
        editando_PettyCash = true;
        $("#idpetty").val(data.idpetty);
        $("#pettycashname").val(data.pettycashname);
        $("#amountmax").val(data.amountmax);
        $("#amountmin").val(data.amountmin);
        $("input[name='iscurrent'][value='" + data.iscurrent + "']").prop("checked", true);
        $("#status").val(data.status);
        $("#date_create").val(data.date_create);
        $("#date_update").val(data.date_update);

        $("#modal_pettycash").modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#tituloModal").text('Editando Caja Chica: ' + data.pettycashname);
        $('#modal_pettycash').modal('show');
    
}


$('#table_pettycash').on('click', '.eliminar', function () {
    var data = tablePettyCash.row(tablePettyCash.row(this).child.isShown() ? this : $(this).parents('tr')).data();

    Swal.fire({
        title: '¿Está seguro de dar de baja?',
        text: 'Una vez hecho esto no podrá recuperar los datos.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0720b7',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí'
    }).then((result) => {
        if (result.value) {
            removePettyCash(data.idpetty);
        }
    });
});

function removePettyCash(idpetty) {
    $.post('../controlador/pettycash/ControllerRmovePettyCash.php', { idpetty: idpetty })
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
            tablePettyCash.ajax.reload();
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


//RESUMEN DE REPORTES////
var table_summary;
function List_pettycash_summary() {

    var params = { start: $("#date_ini").val(), end: $("#date_final").val() };
    table_summary = $("#pattycash_summary").DataTable({
        "ordering": true,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },
        dom: 'Bfrtip',
        buttons: [
          {  extend: 'excelHtml5',
            title: 'RESUMEN GENERAL DE MOVIMIENTOS',
          },
          { extend: 'csvHtml5',
             title: 'RESUMEN GENERAL DE MOVIMIENTOS',
          },
          {extend: 'pdfHtml5',
            title: 'RESUMEN GENERAL DE MOVIMIENTOS',
          },
          {extend: 'print',
            title: 'RESUMEN GENERAL DE MOVIMIENTOS',
          },
        ],
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
      "ajax": {
            "url": "../controlador/pettycash/ControllerGetPetty_summary.php",
            type: 'POST',
            data:params
        },
        "columns": [
            { "data": null, "render": function (data, type, row, meta) { return meta.row + 1; } },
            { "data": "categorias" },
            { "data": "name" },
            { "data": "amount" },
            { "data": "tipo",
            render: function(data, type, row) {
            if (data == 'Ingreso') {
                return "<label class='label btn bg-green btn-lg'><i class='fa fa-arrow-circle-down'></i>&nbsp;" + data + "</label>";
            } else {
                return "<label class='label btn bg-purple btn-lg'><i class='fa  fa-arrow-circle-up'></i>&nbsp;" + data + "</label>";
            }
            }

            },
            { "data": "dateoperation" }
           ],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("pattycash_summary_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
         filterGlobalPettyCashresumen() 
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
   $('#btn-place').html(table_summary.buttons().container());
}

function filterGlobalPettyCashresumen() {
    $('#pattycash_summary').DataTable().search($('#global_filter').val()).draw();
}




async function summary_entry() {
    try {
        const respuesta = await fetch('../controlador/pettycash/ControllerGetsummaryEntry.php');
        const resultado = await respuesta.json();

        if (resultado.data && resultado.data.length > 0) {
            const datos = resultado.data;
             const sumaAmount = datos.reduce((total, item) => total + parseFloat(item.amount), 0);
             $("#total_entry").html("GUA./"+sumaAmount.toFixed(2));
             Summary_exit_entry_all(sumaAmount,'0x25');
        } else {
            console.error('La respuesta no contiene datos válidos.');
        }
        // Aquí puedes trabajar con los datos obtenidos
    } catch (error) {
        console.error('Error en la petición:', error);
    }
}

async function Summary_exit() {
    try {
        const respuesta = await fetch('../controlador/pettycash/ControllerGetSummaryExit.php');
         const resultado = await respuesta.json();
        if (resultado.data && resultado.data.length > 0) {
            const datos = resultado.data;
             const sumaAmount = datos.reduce((total, item) => total + parseFloat(item.amount), 0);
              $("#total_exit").html("GUA./"+sumaAmount.toFixed(2));
             Summary_exit_entry_all(sumaAmount,'0mx258');
        } else {
            console.log('La respuesta no contiene datos válidos.');
        }
    } catch (error) {
        console.error('Error en la petición:', error);
    }
}

async function Summary_Pettycash() {
    try {
        const respuesta = await fetch('../controlador/pettycash/ControllerGetPettyCashSummary.php');
         const resultado = await respuesta.json();
        if (resultado.data && resultado.data.length > 0) {
            const datos = resultado.data;
             const sumaAmount = datos.reduce((total, item) => total + parseFloat(item.amountmax), 0);
              $("#pettycash_summary").html("GUA./"+sumaAmount.toFixed(2));
        } else {
            console.error('La respuesta no contiene datos válidos.');
        }
    } catch (error) {
        console.error('Error en la petición:', error);
    }
}

let count_count = 0, value1 = 0, value2 = 0;
async function Summary_exit_entry_all(numero) {
    const value = parseFloat(numero);
    count_count === 0 ? (value1 = value, count_count++) : (value2 = value, count_count--);
    let total_utilida= value1 - value2;
    const absoluteValue = total_utilida < 0 ? -total_utilida : total_utilida;
    $("#total_summary").html(`GUA/.${absoluteValue.toFixed(2)}`);
}

