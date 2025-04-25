 //COMBO DE AÑO ESCOLAR EN LA VISTA JORNADAS
 async function listar_combo_EscolarAsync() {
    var id = $("#YearActualActivo").val();
    var identi='';var nameCombo="--seleccione--";
    $.ajax({
        "url": "../controlador/fasescolar/configuracion_listarYear.php",
        type: 'POST'
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {

              cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {
                 
                cadena += "<option value='" + data[i][0] + "'" + (data[i][0] == id ? " selected" : "") + ">" + data[i][1] + "</option>";
            }
            $("#yerar_id").html(cadena);
             $("#yerar_id_cots").html(cadena);
        } else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#yerar_id").html(cadena);
             $("#yerar_id_cots").html(cadena);
        }
    })
}

async function fetchData(btn) {
    var enrollment  = $("#enrollment").val();
    var id_year  = $("#yerar_id_cots").val();
    var number  = $("#number_couts").val();
     $(btn).prop('disabled', true);
     $(btn).html('<i class="fa fa-spinner fa-spin"></i> Cargando...');
    
    try {
        const response = await fetch(`../controlador/feePayments/controllerGenerate.php?id_year=${id_year}&count=${number}&enrollment=${enrollment}`);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        if(data.status)  Swal.fire("Mensaje de Éxito", data.msg, "success");
        if(!data.status)  Swal.fire("Mensaje de Error", data.msg, "error");
    } catch (error) {
       Swal.fire("Mensaje de error", error.responseText, "error");
    }
   $(btn).html('<i class="fa fa-search"></i> Cargando...');
   $(btn).prop('disabled', false);
   $(btn).html('Generar');
}


function get_paymentPlan(payment) {
   
   var payment_plan = {
   start_date: $("#start_date").val() || null,
   end_date: $("#end_date").val() || null,
   year_id: $("#yerar_id").val() || $("#YearActualActivo").val(),
   search: $("#global_filter").val()
 
};
Object.assign(payment_plan, payment);


table_planStudents = $('#table_planStudents').DataTable({
    ...datatableConfig,
    "pageLength": 10,
    "destroy": true,
    "processing": true,
    "ajax": createAjaxConfig('#table_planStudents', 'feePayments', 'controllerGet.php','GET',payment_plan),
    "columns": [
     { "data": null, "render": function (data, type, row, meta) { return meta.row + 1; } },
    { "data": "student_id" },
    { "data": "alumnonombre" },
    { "data": "apellidos" },
    { "data": "gradonombre" },
    { "data": "yearScolar" },
    { "data": "turno_nombre" },
    { "data": "payment_date" },
    {
     "defaultContent": "<button  class='edit_payment btn btn-warning btn-sm'><i class='fa fa-search' title='acción'></i></button>"
    }

    ],
    "language": idioma_espanol,
    select: true
  });
 var tableFilter = document.getElementById("table_planStudents_filter");
  if (tableFilter !== null) {
    tableFilter.style.display = "none";
  }


  $('input.global_filter').on('keyup click', function () {
    filter_paymentesPlan();
  });

 table_planStudents.column(1).visible(false);
 $('#btn-place').html(table_planStudents.buttons().container()); 
}

function filter_paymentesPlan() {
  $('#table_planStudents').DataTable().search($('#global_filter').val()).draw();
}

var feePayment={}
$('#table_planStudents').on('click', '.edit_payment', function () {
  var data = table_planStudents.row(table_planStudents.row(this).child.isShown() ? this : $(this).parents('tr')).data();

     feePayment.student_id = data.student_id;
     feePayment.student= data.alumnonombre+' '+data.apellidos;
     feePayment.gradonombre=data.gradonombre;
     feePayment.turno_nombre=data.turno_nombre;
      feePayment.payment_date=data.payment_date;
    $("#mld_feetPayment").modal({
        backdrop: 'static',
        keyboard: false
    });
     $("#dates_student").text("PLAN DE PAGOS Est:  " + data.alumnonombre+' '+data.apellidos);
    $('#mld_feetPayment').modal('show');
  get_feePaymentByStudent({student_id:data.student_id});
});

///////////////////////////////////////////////////////////////////
var tlb_feeStudent;
function get_feePaymentByStudent(payment) {
   var payment_plan = {
   start_date: $("#date_final").val() || null,
   end_date: $("#date_final").val() || null,
   year_id: $("#yerar_id").val() || null,
   search: $("#global_filter").val(),
   status_payment: $("#status_payment").val() || null,
   paymentPlan_id: $("#paymentPlan_id").val() || null,
   student_id: feePayment.student_id,
 
};
Object.assign(payment_plan, payment);

tlb_feeStudent = $('#tlb_factionarie').DataTable({
    ...datatableConfig,
    "pageLength": 10,
    "destroy": true,
    "processing": true,
    "ajax": createAjaxConfig('#tlb_factionarie', 'feePayments', 'controllerGet.php','GET',payment_plan),
    "columns": [
     { "data": null, "render": function (data, type, row, meta) { return meta.row + 1; } },
    { "data": "student_id" },
    { "data": "name" },
    { "data": "amount" },
    {  "data": "status_payment",
        "render": function(data, type, row) {
            return data == 0 ? "<span class='label label-warning '>falta pagar</span>":"<span class='label label-success'>Pagado</span>";
        }
     },
    { "data": "yearScolar" },
   {
  "data": "next_date",
  "render": function(data, type, row) {
    if (type === 'display') {
      return `<input type="date" value="${data}" class="form-control" ${row.status_payment === 1 ? 'disabled' : ''}>`;
    } else {
      return data;
    }
  }
},
    { "data": "status_payment",
      render: function(data, type, row) {   
         return data === 0 ?  "<button  class='payment btn btn-primary btn-sm'><i class='fa fa-check-square' title='Pagar'></i></button>":"<button  class='print_pdf btn btn-secondary  btn-sm'><i class='fa fa-print' title='Imprimir'></i></button>";  
        }   
    } ],
     "createdRow": function (row, data, dataIndex) {
            if (data.status_payment == 0)  $(row).css('background-color', '#d1e7dd');
            if (data.status_payment == 1)  $(row).css('background-color', '#fbe8a2');
        },

    "language": idioma_espanol,
    select: true
  });
  document.getElementById("tlb_factionarie_filter").style.display = "none";
  $('input.global_filter_fee').on('keyup click', function () {
    filter_feeStudent();
  });
 tlb_feeStudent.column(1).visible(false);
}

function filter_feeStudent() {
  $('#tlb_factionarie').DataTable().search($('#global_filter_fee').val()).draw();
}

$('#tlb_factionarie').on('click', '.payment', function () {
  var row = tlb_feeStudent.row($(this).parents('tr'));
  var data = row.data();

  // Obtener el valor actualizado de la fecha
  var nextDateInput = row.node().querySelector('input[type="date"]');
  var nextDate = nextDateInput.value;
  console.log(nextDate)

  feePayment.amount = data.amount;
  feePayment.student_id = data.student_id;
  feePayment.id_fee = data.id_fee;
  feePayment.id_year = $("#yerar_id").val();
  feePayment.next_date = nextDate; // Usar el valor actualizado de la fecha

  if (!feePayment.id_year) return Swal.fire("Mensaje de error", "Debes seleccionar año académico.", "error");

  Swal.fire({
    title: 'Esta seguro de pagar la cota ?',
    text: " el montode pago es :" + data.amount + " por concepto de " + data.name + " con fecha de vencimiento " + nextDate, // Usar el valor actualizado de la fecha
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#05ccc4',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si'
  }).then((result) => {
    if (result.value) {
      feetPaymentStudent(this);
    }
  });
});


$('#tlb_factionarie').on('click', '.print_pdf', function () {
  var data = tlb_feeStudent.row(tlb_feeStudent.row(this).child.isShown() ? this : $(this).parents('tr')).data();
  feePayment.amount= data.amount;
  feePayment.next_date= data.next_date;
  feePayment.name=data.name;
  feePayment.yearScolar=data.yearScolar;
  feePayment.yearScolar=data.yearScolar;

  $.ajax({
    url: '../controlador/feePayments/print-recibet.php', // Cambia esto a la ruta de tu controlador
    method: 'POST',
    data: feePayment,
    xhrFields: {
      responseType: 'blob'
    },
    success: function(response) {
      var blob = new Blob([response], { type: 'application/pdf' });
      var url = window.URL.createObjectURL(blob);
      window.open(url, '_blank');
    },
    error: function(error) {
      console.error('Error al generar el PDF:', error);
      alert('Hubo un error al generar el PDF.');
    }
  });
     
});




async function feetPaymentStudent(btn) {
  try {
    const response = await $.post('../controlador/feePayments/controllerPayment.php', feePayment);
    const { status, msg } = JSON.parse(response);

    if (status) {
      Swal.fire({ position: 'top-end', icon: 'success', title: 'Éxito !!', text: msg, showConfirmButton: false, timer: 1500 });
      tlb_feeStudent.ajax.reload();
      
    } else {
      Swal.fire("Mensaje de error", msg, "error");
    }
  } catch (error) {
    
      Swal.fire("Mensaje de error", error.responseText, "error");
    
  }
}