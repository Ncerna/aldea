var editandoExit = false;
var tableExit;

function openModalExit() {
    editandoExit = false;
    $("#modal_exit").modal({
        backdrop: 'static',
        keyboard: false
    });
   clean_input_values();
    categoryExitSelect();
    categoryPettyCashSelect();
    $("#tituloModal").text('NUEVO EGRESO');
    $('#modal_exit').modal('show');
}


function Register_exit() {
    var data = {
        idexit: $("#idexit").val(),
        description: $("#description").val().toLowerCase(),
        payment: $("#payment").val().toLowerCase(),
        amount: $("#amount").val(),
        dateoperation: $("#dateoperation").val(),
        beneficiary: $("#beneficiary").val().toLowerCase(),
        cmb_category: $("#cmb_category").val(),
        fixed_expenses: $("#fixed_expenses").val()
    };
   
   if(!isValid()) return  Swal.fire("Mensaje de advertencia", "Saldo insuficiente.", "warning");
   if(!validateData(data)) return Swal.fire("Mensaje de advertencia", "Llene todo los campos. ", "warning");
   
    $.post(
        editandoExit ? '../controlador/exit/ControllerRolbackExitUpdate.php' :
         '../controlador/exit/ControllerRolbackExitRegister.php',
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
                tableExit.ajax.reload();
                  clean_input_values();
                $('#modal_exit').modal('hide');

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

function isValid() {
    let amount_into = parseFloat($("#amount").val());
    let available_balance = parseFloat($("#available_balance").val());

    if (!isNaN(available_balance)) {
        if (amount_into > available_balance) return false;
         else return true;
    } else  return false; 
}

function validateData(data) {
    if ( !data.description.trim() || !data.payment.trim()  ||
         !data.beneficiary.trim() || !data.cmb_category.trim() 
    ) {
       
        return false;
    }
   
    return true;
}



function clean_input_values() {
    $("#idexit").val('');
    $("#description").val('');
    $("#payment").val('');
    $("#amount").val('');
   document.getElementById('tu_id_del_label').innerHTML = '';
   document.getElementById('mount_label').innerHTML = '';
    $("#beneficiary").val('');
    $('#cmb_category').val(0).trigger('change');
   $('#fixed_expenses').val(0).trigger('change');
    editandoExit = false;
}

function List_exit() {
    
        params = { start: $("#date_ini").val(), end: $("#date_final").val() }

     tableExit = $("#table_exit").DataTable({
    "footerCallback": function (row, data, start, end, display) {
       var api = this.api();
       var intVal = function (i) { return typeof i === 'string' ? parseFloat(i.replace(/[\$,]/g, '')) : typeof i === 'number' ? i : 0; };
       var monTotal = api.column(6).data().reduce(function (a, b) { return intVal(a) + intVal(b);}, 0);
       $(api.column(0).footer()).html('Total de ingresos:');
        $(api.table().footer()).css('background-color', '#d6edf5');
       $(api.column(6).footer()).html(monTotal.toFixed(2)); // Formatear a dos decimales
       },
        "ordering": false,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },
        dom: 'Bfrtip',
        buttons: [
          {  extend: 'excelHtml5',
            title: 'REPORTE DE EGRESO GENERAL',
          },
          { extend: 'csvHtml5',
            title: 'REPORTE DE EGRESO GENERAL',
          },
          {extend: 'pdfHtml5',
            title: 'REPORTE DE EGRESO GENERAL',
          },
          {extend: 'print',
            title: 'REPORTE DE EGRESO GENERAL',
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
            "url": "../controlador/exit/ControllerGetExit.php",
            type: 'POST',
            data:params
        },
        "columns": [
            { "data": null, "render": function (data, type, row, meta) { return meta.row + 1; } },
            { "data": "idexit" },
            { "data": "description" },
            { "data": "categoryexit" },
            { "data": "fixedcoste_name" },
            { "data": "payment" },
            { "data": "amount" },
            { "data": "dateoperation" },
            { "data": "beneficiary" },
             {
        "defaultContent": "<button type='button' class='editar btn btn-primary btn-sm' ><i class='fa fa-edit' ></i></button>"+
         "&nbsp;<button type='button' class='eliminar btn btn-default btn-sm' ><i class='fa fa-trash' ></i></button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("table_exit_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobalExit();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

  tableExit.column(1).visible( false );
   $('#btn-place').html(tableExit.buttons().container());

}

function filterGlobalExit() {
    $('#table_exit').DataTable().search($('#global_filter').val()).draw();
}

$('#table_exit').on('click', '.editar', function () {
  var data = tableExit.row(tableExit.row(this).child.isShown() ? this : $(this).parents('tr')).data();

  $.post('../controlador/exit/ControllerRolbackShow.php', { id: data.idexit })
  .done(function (resultado) {
    var response = JSON.parse(resultado);
    if (response.status) {
      showExit(response.data);
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


function showExit(data) {

        editandoExit = true;
        $("#idexit").val(data.idexit);
        $("#description").val(data.description);
        $("#payment").val(data.payment);
        $("#amount").val(data.amount);
        $("#dateoperation").val(data.dateoperation);
        $("#beneficiary").val(data.beneficiary);
          categoryPettyCashSelect();
        categoryExitSelect(data.category_id);
        console.log(data.category_id+'_______________'+data.fixedcoste_id)
        fixedCostsSelect(data.category_id,data.fixedcoste_id);
        $("#modal_exit").modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#tituloModal").text('Editando Salida: ' + data.description);
        $('#modal_exit').modal('show');
}

$('#table_exit').on('click', '.eliminar', function () {
    var data = tableExit.row(tableExit.row(this).child.isShown() ? this : $(this).parents('tr')).data();

    Swal.fire({
        title: '¿Está seguro de dar de baja?',
        text: "Una vez hecho esto no podrá recuperar la salida.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#05ccc4',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí'
    }).then((result) => {
        if (result.value) {
            removeExit(data.idexit);
        }
    });
});

function removeExit(idexit) {
    $.post('../controlador/exit/ControllerRolbackRemoveExit.php', { idexit: idexit })
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
                tableExit.ajax.reload();
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

function categoryExitSelect(id)  {
  $.post('../controlador/exit/ControllerGetCategoryExit.php')
    .done(function (resultado) {
      var response = JSON.parse(resultado);
         let { data } = response;
         var cadena = "";
      if (data.length>0) {
          for (var i = 0; i < data.length; i++) {

            cadena += "<option value='" + data[i].id + "'" +
              (data[i].id == id ? " selected" : "") + ">" + data[i].categoryexit + "</option>";
          
        } 
      } else cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        $("#cmb_category").html(cadena);
        var selectElement = document.getElementById("cmb_category");
       // fixedCostsSelect(selectElement.value,'');
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      if (jqXHR.status === 403) {
        Swal.fire("Mensaje de error", "No Autorizado.", "error");
      } else {
        Swal.fire("Mensaje de error", errorThrown, "error");
      }
    });
}

//control id  gastos fijos
function fixedCostsSelect(id,fixed){

var fixedExpensesDiv = document.getElementById('content_fixed_expenses');
 if (id == 5) {
fixedExpensesDiv.style.display = 'block'; 

 $.post('../controlador/fixedCost/ControllerFixedCosteGet.php')
    .done(function (resultado) {
      var response = JSON.parse(resultado);
      console.log(response)
         let { data } = response;
         var cadena = "";
      if (data.length>0) {
          for (var i = 0; i < data.length; i++) {

            if(data[i].idfixed==fixed){
              cadena += "<option value='" + data[i].idfixed + "' selected>" + data[i].name + "</option>";
            }else{
              cadena += "<option value='" + data[i].idfixed + "'>" + data[i].name + "</option>";
            }
            
          
        } 
      } else cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        $("#fixed_expenses").html(cadena);
        
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      if (jqXHR.status === 403) {
        Swal.fire("Mensaje de error", "No Autorizado.", "error");
      } else {
        Swal.fire("Mensaje de error", errorThrown, "error");
      }
    });
}
else {fixedExpensesDiv.style.display = 'none'; $('#fixed_expenses').val('').trigger('change');}
}


function categoryPettyCashSelect(id) {
  $.post('../controlador/pettycash/ControllerGetPettyCash.php')
    .done(function (resultado) {
      var response = JSON.parse(resultado);
         let { data } = response;
         if(data[0].iscurrent==1){
            $("#cmb_pettycash").val(data[0].pettycashname); $("#available_balance").val(data[0].amountmax);
            $("#balance_minimo").val(data[0].amountmin);  
         }else document.getElementById('tu_id_del_label').innerHTML = '<span class="aler_petty">Caja cerrado</span>'; 
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      if (jqXHR.status === 403) {
        Swal.fire("Mensaje de error", "No Autorizado.", "error");
      } else {
        Swal.fire("Mensaje de error", errorThrown, "error");
      }
    });
}
