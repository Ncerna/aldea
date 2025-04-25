

var payment_plan = {
  tipo_id: null,
};

var tlb_paymentesPlan;

function Register_paymentPlan(btn) {
  var formData = {
    id: payment_plan.tipo_id,
    typeName: $("#type_name").val().toUpperCase(),
    typeAmount: $("#type_amount").val(),
    typeDate: $("#type_date").val(),
    typeStado: $("#type_stado").val()
    
  };
   
  $.post('../controlador/paymenPlan/ControllerPost.php', formData)
    .done(function (result) {
      var type = JSON.parse(result);
      if (type.status) {
        Swal.fire({ position: 'top-end', icon: 'success', title: 'Éxito !!', text: type.msg, showConfirmButton: false, timer: 1500 });
        tlb_paymentesPlan.ajax.reload();
        clear_paymentPlan();
      } else {
        Swal.fire("Mensaje de error", type.msg, "error");
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

function clear_paymentPlan() {
  payment_plan.tipo_id = '';
  $("#type_name").val('');
  $("#type_amount").val('');
  $("#type_date").val('');
  $('#type_stado').val("").trigger("change");
  $("#html_title").text(" NUEVO REGISTRO");
 
}

$('#tlb_paymentesPlan').on('click', '.edit_payment', function () {
  var type = tlb_paymentesPlan.row(tlb_paymentesPlan.row(this).child.isShown() ? this : $(this).parents('tr')).data();

     payment_plan.tipo_id = type.tipo_id;
     $("#type_name").val(type.name);
     $("#type_amount").val(type.amount);
     $("#type_date").val(type.created_at);
     $("#type_stado").val(type.status).trigger('change');
      $("#html_title").text("EDITANDO REGISTRO ");
  
});



function getTypePaymentsPlan(payment) {
   $("#html_title").text(" NUEVO REGISTRO");
   var payment_plan = {
   date_init: $("#date_ini").val() || null,
   date_end: $("#date_end").val() || null,
   search: $("#global_filter").val()
 
};
Object.assign(payment_plan, payment);

tlb_paymentesPlan = $('#tlb_paymentesPlan').DataTable({
    ...datatableConfig,
    "pageLength": 10,
    "destroy": true,
    "processing": true,
    "ajax": createAjaxConfig('#tlb_paymentesPlan', 'paymenPlan', 'ControllerGet.php','GET',payment_plan),
    "columns": [
     { "data": null, "render": function (data, type, row, meta) { return meta.row + 1; } },
    { "data": "tipo_id" },
    { "data": "name" },
    { "data": "code" },
    { "data": "amount" },
    { "data": "created_at" },
    { "data": "status" },
    {
     "defaultContent": "<button  class='edit_payment btn btn-primary btn-sm'><i class='fa fa-edit' title='editar'></i></button>"
    }

    ],
    "language": idioma_espanol,
    select: true
  });
  document.getElementById("tlb_paymentesPlan_filter").style.display = "none";
  $('input.global_filter').on('keyup click', function () {
    filter_paymentesPlan();
  });

 tlb_paymentesPlan.column(1).visible(false);

}

function filter_paymentesPlan() {
  $('#tlb_paymentesPlan').DataTable().search($('#global_filter').val()).draw();
}
