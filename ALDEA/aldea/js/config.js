
function createAjaxConfig(tableName, route, controller,metod,param=null) {
  console.log(route+"--"+controller+'--'+metod)
    return {
        "url": `../controlador/${route}/${controller}`,
        "type": metod,
        "data": param,

        "success": function (response) {
          console.log(response.data)
            if (response.status) {
              $(tableName).DataTable().clear().rows.add(response.data).draw();
            } else {
              Swal.fire("Mensaje de error", response.msg, "error");
            }
             $(tableName+"_processing").css("display", "none");
        },
        "error": function (jqXHR, textStatus, errorThrown) {
          if (jqXHR.status === 403) {
            Swal.fire("Mensaje de error", jqXHR.responseJSON.msg, "error");
             } else {
             Swal.fire("Mensaje de error", errorThrown, "error");
            }
        
            $(tableName+"_processing").css("display", "none");
            $(tableName).DataTable().clear().draw();
           
        }
    };
}


var datatableConfig = {
    "ordering": true,
    "bLengthChange": false,
    "scrollCollapse": true,
    "searching": {
        "regex": true
    },
    "lengthMenu": [
        [10, 20, 50, 100, -1],
        [10, 20, 50, 100, "All"]
    ],
};

function ButtonsTipyStatus(buttonText, buttonClass) {
    return `<button type='button' class='${buttonText} btn ${buttonClass} btn-sm'><i class='fa fa-eye-slash' aria-hidden='true'></i></button>`;
}

function renderEstatus(data, type, row, columnName) {
    if (row.hasOwnProperty(columnName)) {
        var status = row[columnName].toString();
        if (status == "Activo" || status == 1) {
            return "<span class='badge  badge-primary'>Activo</span>";
        } else if (status == "Inactivo" || status == 0) {
            return "<span class='badge badge-secondary'>Inactivo</span>";
        }
    }
    return ""; // Si la columna no existe o el valor no coincide con "Activo", "Inactivo", "1" o "0", devolvemos un string vacío
}



function Buttondefault(){
    return "<button type='button' class='editar btn btn-info btn-sm' title='editar'><i class='fa fa-edit' ></i></button>"+
    "&nbsp;<button  type='button' class='desactivar btn btn-warning btn-sm' title='desactivar'><i class='fa fa-eye-slash'></i></button>"+
    "&nbsp;<button  type='button' class='activar btn btn-success btn-sm' title='activar'><i class='fa fa-eye'></i></button>"+
    "&nbsp;<button  type='button' class='eliminar btn btn-secondary btn-sm' title='eliminar'><i class='fa fa-trash'></i></button>";
}


function ButtondefaultCustomer(){
    return "<button type='button' class='editar btn btn-info btn-sm' title='editar'><i class='fa fa-edit' ></i> Editar</button>"+
     "&nbsp;<button type='button' class='show btn btn-secondary btn-sm'><i class='fa fa-cog' ></i>ver</button>"+
    "&nbsp;<button  type='button' class='eliminar btn btn-secondary btn-sm' title='eliminar'><i class='fa fa-trash'></i> Remover</button>";
}


   



   var exportButtons = [
    {
        extend:  'pdfHtml5',
        text: '<i class="fa fa-file-pdf-o"></i> PDF',
        title: 'REPORTE DE DOCENTES',
        className: 'btn btn-danger',
        style:'background-color:red'
      },{
      extend:    'print',
      text:      '<i class="fa fa-print"></i> Print',
      title: 'REPORTE DE DOCENTES',
      titleAttr: 'Imprimir',
      className: 'btn btn-info'
      },

       {
      extend:    'excel',
      text:      '<i class="fa fa-file-text-o"></i> Exel ',
      title: 'RREPORTE DE DOCENTES',
      titleAttr: 'Excel',
      className: 'btn btn-info'
      },{
      extend:    'csvHtml5',
      text:      '<i class="fa  fa-file-excel-o"></i> Csv',
      title: 'REPORTE DE DOCENTES',
      titleAttr: 'cvs',
      className: 'btn btn-info'
      }
];




