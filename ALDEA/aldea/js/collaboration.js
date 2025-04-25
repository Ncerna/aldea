var editandoEntry = false;
var tble_coll;
var params = { id:''};

function openModalCollaboration() {
    editandoEntry = false;
    $("#modal_collaboration").modal({
        backdrop: 'static',
        keyboard: false
    });
    $("#tituloModal").text('Nueva colaboración Monetario');
   // categoryEntrySelect();
    $('#modal_collaboration').modal('show');
}

function RegisterCollaboration() {
    var data = {
        id: params.id,
        namePeople: $("#name_people").val().toLowerCase(),
        lastName: $("#last_name_people").val().toLowerCase(),
        numbreCi: $("#numbre_ci_people").val(),
        description: $("#description").val().toLowerCase(),
        payment: $("#payment").val().toLowerCase(),
        amount: $("#amount").val(),
        dateoperation: $("#dateoperation").val(),
        category: $("#cmb_category").val() || '',
    };
    $.post('../controlador/collaboration/controllerPots.php', data)
        .done(function (resultado) {
            var response = JSON.parse(resultado);
            if (response.status) { Swal.fire({ position: 'top-end', icon: 'success', title: 'Éxito !!', text: response.msg, showConfirmButton: false, timer: 1500 });
                $('#modal_collaboration').modal('hide');
                 tble_coll.ajax.reload();
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
    $("#name_people").val('');
    $("#last_name_people").val('');
    $("#numbre_ci_people").val('');
    $("#identry").val('');
    $("#description").val('');
    $("#payment").val('');
    $("#amount").val('');
    params.id='';
   
}

function validateData(data) {
    if ( !data.namePeople.trim() || !data.payment.trim()  ||
         !data.amount.trim() || !data.lastName.trim() || !data.lastName.trim() 
    ) { return false;
    }
 return true;
}

function List_collaborations() {
     params = { start: $("#date_ini").val(), end: $("#date_final").val() }

     tble_coll = $("#tlb_coll").DataTable({
    "footerCallback": function (row, data, start, end, display) {
       var api = this.api();
       var intVal = function (i) { return typeof i === 'string' ? parseFloat(i.replace(/[\$,]/g, '')) : typeof i === 'number' ? i : 0; };
       var monTotal = api.column(5).data().reduce(function (a, b) { return intVal(a) + intVal(b);}, 0);
       $(api.column(0).footer()).html('Total :');
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
         buttons: [ {  extend: 'excelHtml5',  title: 'Reporte de colaboraciones', },
                    { extend: 'csvHtml5', title: 'Reporte de colaboraciones', },
                    {extend: 'pdfHtml5', title: 'Reporte de colaboraciones', },
                    {extend: 'print',  title: 'Reporte de colaboraciones', },
        ],
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "pageLength": 10,
        "destroy": true,
        
        "processing": true,
      "ajax": {
            "url": "../controlador/collaboration/ControllerGetCollaboration.php",
            type: 'GET',
            data:params
        },
        "columns": [
          { "data": null, "render": function (data, type, row, meta) { return meta.row + 1; } },
            { "data": "id" },
            {"data": null, "render": function (data, type, row) {return row.name_people + ' ' + row.last_name;}},
            { "data": "number_ci" },
           
            { "data": "payment" },
            { "data": "amount"},
            { "data": "created_at"},
            {"defaultContent":"<button type='button' class='editar btn btn-primary btn-sm' ><i class='fa fa-edit' ></i></button>"+ 
            "&nbsp;<button type='button' class='eliminar btn btn-default btn-sm'><i class='fa fa-trash' ></i></button>"}
    ],
        "language": idioma_espanol,
        select: true,

    });
     /*
     "<button type='button' class='editar btn btn-primary btn-sm' ><i class='fa fa-edit' ></i></button>&nbsp;<button type='button' class='eliminar btn btn-default btn-sm' ><i class='fa fa-trash' ></i></button>"
     */
     
    document.getElementById("tlb_coll_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
         filterGlobalEntry();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

  tble_coll.column(1).visible( false );
   $('#btn-place').html(tble_coll.buttons().container());
}

function filterGlobalEntry() {
    $('#tlb_coll').DataTable().search($('#global_filter').val()).draw();
}

$('#tlb_coll').on('click', '.editar', function () {
    var data = tble_coll.row(tble_coll.row(this).child.isShown() ? this : $(this).parents('tr')).data();
    
    $.get('../controlador/collaboration/ControllerGetCollaboration.php', { id: data.id })
        .done(function (resultado) {
            var response = JSON.parse(resultado);
            if (response.status) {
                let {data}= response;
                sowCollab(data[0]);
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

function sowCollab(data) {
    if (data && Object.keys(data).length > 0) {

        console.log(data);

        params.id=data.id;
        $("#name_people").val(data.name_people);
        $("#last_name_people").val(data.last_name);
        $("#numbre_ci_people").val(data.number_ci);
      
        $("#description").val(data.description);
        $("#payment").val(data.payment);
        $("#amount").val(data.amount);
        $("#dateoperation").val(data.created_at);
       
        //categoryEntrySelect(data.category_id);
        $("#modal_collaboration").modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#tituloModal").text('Editando Colaboracion: ' + data.name_people);
        $('#modal_collaboration').modal('show');
    } else {
        Swal.fire("Mensaje de error", "No se pudieron cargar los datos de la entrada.", "error");
    }
}

$('#tlb_coll').on('click', '.eliminar', function () {
    var data = tble_coll.row(tble_coll.row(this).child.isShown() ? this : $(this).parents('tr')).data();

    Swal.fire({
        title: '¿Está seguro de dar de baja?',
        text: "Una vez hecho esto no podrá recuperar la la colaboración.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#05ccc4',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí'
    }).then((result) => {
        if (result.value) {
            removeEntry(data.id);
        }
    });
});

function removeEntry(id) {
    $.post('../controlador/collaboration/ControllerRemovesCollaboration.php', { id: id })
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
                tble_coll.ajax.reload();
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
         cadena += "<option value='' selected>---seleccione---</option>";
              
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
