var tlb_keys;
var resulRequet_ = document.getElementById('result');
function List_keys_students() {
    tlb_keys = $("#students_keys").DataTable({
        "ordering": true,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },

        "responsive": true,
          "dom":'Bfrtilp',
       
       buttons: [
              {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> ',
                titleAttr: 'Exportar a Excel',
                title: 'REPORTE DE CLAVES DE ACCESO'
              },
              {
                extend: 'pdfHtml5',
                text: '<i class="fa fa-file-pdf-o"></i> ',
                titleAttr: 'Exportar a PDF',
                title: 'REPORTE DE CLAVES DE ACCESO'
              },
              {
                extend: 'csvHtml5', // Agregar botón para exportar a CSV
                text: '<i class="fa fa-files-o"></i> ',
                titleAttr: 'Exportar a CSV',
                title: 'REPORTE DE CLAVES DE ACCESO'
              }
            ],
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ] ,
        "pageLength": 10,
        "destroy": true,
        "processing": true,
        "ajax": {
            url: "../controlador/collaboration/ControllerGetStudents.php",
            type: 'POST'
        },

        "columns": [{
            "data": "idalumno"},
             {"data": null, "render": function (data, type, row) {return row.alumnonombre + ' ' + row.apellidos;}},
           {"data": "telefono"},
           {"data": "keys_text"},
           {"data": "created_at"},
           {
            "defaultContent": "<button  type='button' class='editar btn btn-primary btn-sm' title='Editar'><i class='fa fa-edit'></i></button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("students_keys_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {

        filterGlob_();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
    tlb_keys.column( 0 ).visible( false );
     $('#btn-place').html(tlb_keys.buttons().container()); 
   
}

function filterGlob_() {
    $('#students_keys').DataTable().search($('#global_filter').val()).draw();
}

$('#students_keys').on('click', '.editar', function () {
    var data = tlb_keys.row(tlb_keys.row(this).child.isShown() ? this : $(this).parents('tr')).data();
    
     $("#modal_generateKess").modal({
            backdrop: 'static',
            keyboard: false
        });
        params.id_student=data.idalumno;
        resulRequet_.innerText=data.keys_text;
        params.keys=data.keys_text;

        $("#tituloModal").text( data.keys_text==null ?  'Generando Key pra: ' + data.alumnonombre : 'Editando key de: ' + data.alumnonombre);
        $('#modal_generateKess').modal('show');
});


var lengthEl = document.getElementById('length')
var uppercaseEl = document.getElementById('uppercase')
var lowercaseEl = document.getElementById('lowercase')
var numbersEl = document.getElementById('numbers')
var symbolsEl = document.getElementById('symbols')
var generateEl = document.getElementById('generate')
var clipboardEl = document.getElementById('clipboard')
var params={keys:'',id_student:'' };

const randomFunc = {
    lower: getRandomLower,
    upper: getRandomUpper,
    number: getRandomNumber,
    symbol: getRandomSymbol
}

clipboardEl.addEventListener('click', () => {
    const textarea = document.createElement('textarea')
    const password = resulRequet_.innerText

    if(!password) { return }
    	params.keys=password;

    textarea.value = password
    document.body.appendChild(textarea)
    textarea.select()
    document.execCommand('copy')
    textarea.remove()
    
    Swal.fire({ toast: true, position: 'top-right', icon: 'success', title: 'Éxito',
      text:'Password copied to clipboard!' ,showConfirmButton: false,timer: 2000});
})

generateEl.addEventListener('click', () => {
    const length = +lengthEl.value
    const hasLower = lowercaseEl.checked
    const hasUpper = uppercaseEl.checked
    const hasNumber = numbersEl.checked
    const hasSymbol = symbolsEl.checked

    resulRequet_.innerText = generatePassword(hasLower, hasUpper, hasNumber, hasSymbol, length)
    params.keys=generatePassword(hasLower, hasUpper, hasNumber, hasSymbol, length);
})

function generatePassword(lower, upper, number, symbol, length) {
    let generatedPassword = ''
    const typesCount = lower + upper + number + symbol
    const typesArr = [{lower}, {upper}, {number}, {symbol}].filter(item => Object.values(item)[0])
    
    if(typesCount === 0) {
        return ''
    }

    for(let i = 0; i < length; i += typesCount) {
        typesArr.forEach(type => {
            const funcName = Object.keys(type)[0]
            generatedPassword += randomFunc[funcName]()
        })
    }

    const finalPassword = generatedPassword.slice(0, length)

    return finalPassword
}

function getRandomLower() {
    return String.fromCharCode(Math.floor(Math.random() * 26) + 97)
}

function getRandomUpper() {
    return String.fromCharCode(Math.floor(Math.random() * 26) + 65)
}

function getRandomNumber() {
    return String.fromCharCode(Math.floor(Math.random() * 10) + 48)
}

function getRandomSymbol() {
    const symbols = '!@#$%^&*(){}[]=<>/,.'
    return symbols[Math.floor(Math.random() * symbols.length)]
}

function RegisterKeys(){
 console.log(params)   
 $.post('../controlador/collaboration/controllerKeysPost.php', {key: params.keys,id:params.id_student})
        .done(function (resultado) {
            var response = JSON.parse(resultado);
            if (response.status) { Swal.fire({ position: 'top-end', icon: 'success', title: 'Éxito !!', text: response.msg, showConfirmButton: false, timer: 1500 });
                $('#modal_generateKess').modal('hide');
                 tlb_keys.ajax.reload();
                resulRequet_.innerText='';
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

async function refresh(btn) {
    $(btn).prop('disabled', true);
    $(btn).html('<i class="fa fa-spinner fa-spin"></i> cargando...');

    try {
        const response = await fetch('../controlador/collaboration/refresh.php', {
            method: 'GET', // Cambiamos a GET
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (response.status) { Swal.fire({ position: 'top-end', icon: 'success', title: 'Éxito !!', text: response.msg, showConfirmButton: false, timer: 1500 });
        tlb_keys.ajax.reload();
        } else {
           Swal.fire("Mensaje de error", response.msg, "error");
        }
    } catch (error) {
        Swal.fire("Mensaje de error",error.message, "error");
    } finally {
        $(btn).html('<i class="fa fa-refresh"></i>');
        $(btn).prop('disabled', false);
    }
}