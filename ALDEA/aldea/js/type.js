var params = {
  tipo_id: null,
};

var tlb_types;

function Register_type(btn) {
  var type = {
    id: params.tipo_id,
    name: $("#tipo_nombre").val().toUpperCase(),
    of_rank: $("#of_rank").val(),
    stado: $("#t_stado").val()
  };
  if(!of_rank) return Swal.fire("Mensaje de advertencia", " el rango  (de) es requerrido", "warning");
   
  $.post('../controlador/type/ControllertypePost.php', type)
    .done(function (result) {
      var type = JSON.parse(result);
      if (type.status) {
        Swal.fire({ position: 'top-end', icon: 'success', title: 'Éxito !!', text: type.msg, showConfirmButton: false, timer: 1500 });
        tlb_types.ajax.reload();
        clear_inputs();
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

function clear_inputs() {
  params.tipo_id = '';
  $("#tipo_nombre").val('');
  $("#of_rank").val('');
   $('#t_stado').val("").trigger("change");
 
}

$('#tlb_types').on('click', '.edit_type', function () {
  var type = tlb_types.row(tlb_types.row(this).child.isShown() ? this : $(this).parents('tr')).data();
     params.tipo_id = type.tipo_id;
     $("#tipo_nombre").val(type.tipo_nombre);
     $("#of_rank").val(type.of_rank);
     $("#t_stado").val(type.t_stado).trigger('change');
  
});





function getTypesEvaluation(params) {
   var params = {
   date_init: $("#date_ini").val() || null,
   date_end: $("#date_end").val() || null,
   search: $("#global_filter").val()
 
};

tlb_types = $('#tlb_types').DataTable({
    ...datatableConfig,
    "pageLength": 10,
    "destroy": true,
    "processing": true,
    "ajax": createAjaxConfig('#tlb_types', 'type', 'ControllerGetTypes.php','GET',params),
    "columns": [
     { "data": null, "render": function (data, type, row, meta) { return meta.row + 1; } },
    { "data": "tipo_id" },
    { "data": "tipo_nombre" },
    { "data": "t_stado" },
    { "data": "of_rank" },
    {
     "defaultContent": "<button  class='edit_type btn btn-primary btn-sm'><i class='fa fa-edit' title='editar'></i></button>"
    }

    ],
    "language": idioma_espanol,
    select: true
  });
  document.getElementById("tlb_types_filter").style.display = "none";
  $('input.global_filter').on('keyup click', function () {
    filterTypes();
  });

 tlb_types.column(1).visible(false);

}

function filterTypes() {
  $('#tlb_types').DataTable().search($('#global_filter').val()).draw();
}
