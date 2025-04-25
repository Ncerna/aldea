

function VerificarUsuario(){
  
    $("#pass_incorecto").hide();   
    var usuario = $("#txt_usuario").val();
    var contracena = $("#txt_contracena").val();
    let token = $("#tokenSHA256").val();
    if (usuario.length == 0 || contracena.length == 0 ) {
         $("#pass_incorecto").show();
         $("#mensajes_aviso").html('LLENE LOS CAMPOS VACIOS !!');
       return;
    }
      $('.loader').show();
         $("#input-login").val('Loading...');

      $.ajax({
        url:'../controlador/usuario/controlador_verificar_usuario.php',
        type:'POST',
        data:{
            usuario:usuario,
            contracena:contracena,
            token:token
        }
    }).done(function(request){  
    var data = JSON.parse(request);
        if (data.session) {
          location.reload();
        }
        else{
             $("#input-login").val('INGRESAR');
          $('.loader').hide(); 
          $("#pass_incorecto").show();
           $("#mensajes_aviso").html(data.mensaje); 
        }

       // XMLHttpRequestAsycn(data);
    })
}


var table;
function listar_usuario() {
    table = $("#tabla_usuario").DataTable({
        "ordering": true,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
         "responsive": true,
         "dom":'Bfrtilp',
       
       buttons: [
          {
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o"></i> ',
            titleAttr: 'Exportar a Excel',
            title: 'REPORTE DE USUARIOS'
          },
          {
            extend: 'pdfHtml5',
            text: '<i class="fa fa-file-pdf-o"></i> ',
            titleAttr: 'Exportar a PDF',
            title: 'REPORTE DE USUARIOS'
          }
        ],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/usuario/controlador_usuario_listar.php",
            type: 'POST'
        },
        "columns": [{
            "data": "usu_id" },
             {"data": "usu_usuario"},
             
             { "data": null, "render": function (data, type, row) { return row.usu_nombre + ' ' + row.usu_apellidos; } },
             {"data": "rol_nombre"},
             { data: "toke_loguin" },
             
            {
            "data": "usu_estatus",
            render: function(data, type, row) {
                return data == 'ACTIVO'? "<span class='label label-success'>" + data + "</span>":"<span class='label label-warning'>" + data + "</span>";}
              }, 
           {
            "data": "usu_estatus",
            render: function(data, type, row) {
                if (data == 'ACTIVO') {
                    return "<button  type='button' class='desactivar btn btn-default btn-sm'><i class='fa fa-eye-slash' title='desactivar'></i></button>";
                } else {
                    return "<button  type='button' class='activar btn btn-warning btn-sm' title='activar'><i class='fa fa-eye'></i></button>";
                }
            }
        }, 
        {
            "defaultContent":"<button  type='button' class='eliminar btn btn-default btn-sm'><em class='fa fa-close' title='eliminar'></em></button>"
        }],
        "language": idioma_espanol,
        select: true
    });
    document.getElementById("tabla_usuario_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function() {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
     $('#btn-place').html(table.buttons().container()); 
     table.column( 0 ).visible( false );
    
}
$('#tabla_usuario').on('click', '.activar', function() {
    var data = table.row($(this).parents('tr')).data();
    

    if (table.row(this).child.isShown()) {
        var data = table.row(this).data();
    }
    Swal.fire({
        title: 'Esta seguro de activar al usuario?',
        text: "Una vez hecho esto el usuario  tendra acceso al sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#05ccc4',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.value) {
            Modificar_Estatus(data.usu_id, 'ACTIVO');
        }
    }) 

})

$('#tabla_usuario').on('click', '.desactivar', function() {
    var data = table.row($(this).parents('tr')).data();
    // alert(data.usu_id);
    if (table.row(this).child.isShown()) {
        var data = table.row(this).data();
    }
    Swal.fire({
        title: 'Esta seguro de desactivar al usuario?',
        text: "Una vez hecho esto el usuario no tendra acceso al sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#05ccc4',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.value) {
            Modificar_Estatus(data.usu_id, 'INACTIVO');
        }
    })
})

 async function listar_combo_Alumnos(){
     var identi='';var nameCombo="--seleccione--";
        $.ajax({
            "url": "../controlador/matricula/controlador_combo_Alumnos.php",
            type: 'POST'
        }).done(function(resp) {
          
            var data = JSON.parse(resp);
            var cadena = "";
            if (data.length > 0) {

                cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
                for (var i = 0; i < data.length; i++) {
                    cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + ",&nbsp;" + data[i][2] + "</option>";
                }
                 $('#cbm_alumno').html(cadena);////lamndo en vista matricula
           
            } else {
                cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
                $("#cbm_alumno").html(cadena);
            }
        })
}

 async function listar_combo_Docentes(){
     var identi='';var nameCombo="--seleccione--";
        $.ajax({
            "url": "../controlador/usuario/controlador_combo_Docentes.php",
            type: 'POST'
        }).done(function(resp) {
          
            var data = JSON.parse(resp);
            var cadena = "";
            if (data.length > 0) {

                cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
                for (var i = 0; i < data.length; i++) {
                    cadena += "<option value='" + data[i]['id_docente'] + "'>" + data[i]['apellidos'] + ",&nbsp;" + data[i]['nombres'] + "</option>";
                }
                 $('#cbm_docente').html(cadena);////lamndo en vista matricula
           
            
            } else {
                cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
                $("#cbm_docente").html(cadena);
            }
        })
}


function AbrirModalRegistro() {
   $("#div_tabla_usuario").hide();
   $("#DivTableAlumno").show();
    $("#tutotiales_Id").hide();
   $("#cret_avisomanual").show();
   listar_combo_Docentes();
   listar_combo_Alumnos();
   listar_combo_rol();
}

function Limpiar_Registrar_Usuario(){
   $("#DivTableAlumno").hide();
    $("#div_tabla_usuario").show();
   $("#tutotiales_Id").hide();
   $("#cret_avisomanual").hide();

    $("#txt_apellido").val('');
    $("#txt_nombre").val('');
    $("#txt_dniUSU_golval").val('');
    $("#contra").val('');
    $("#txt_usuario").val('');

    $('#txt_apellido').prop('disabled',false);
    $('#cbm_rol').prop('disabled',false);
    $('#txt_nombre').prop('disabled',false);

     $('#cbm_alumno').prop('disabled',false);
     $('#cbm_docente').prop('disabled',false);
      $('#cbm_rol').val('').trigger('change');
      $('#cbm_alumno').val('').trigger('change');
      $('#cbm_docente').val('').trigger('change');


     $("#perfil_seleccionararchivo").val('');
    
     $("#perfil_mostrarimagen")[0].setAttribute('src', '');
     
}

function Estraer_Datos_Alumno(){

 var idalumno=$("#cbm_alumno").val();
 if (idalumno.length==0) {return;}
 $("#button_resgist").html("<i class='fa fa-spin fa-refresh'></i>");
  $.ajax({
        "url": "../controlador/usuario/controlador_Extraer_Alumno.php",
        type: 'POST',
        data: { idalumno:idalumno}
    }).done(function(resp) {
       var data = JSON.parse(resp);
       if (data.length>0) {
        $("#contra").val('');
         $('#txt_apellido').prop('disabled',true);
         $('#txt_nombre').prop('disabled',true);
         $('#cbm_rol').prop('disabled',true);
         $('#cbm_docente').prop('disabled',true);

         $("#txt_apellido").val(data[0]['apellidos']);
         $("#txt_nombre").val(data[0]['alumnonombre']);
         $("#txt_dniUSU_golval").val(data[0]['dni']);
         listar_combo_rol(data[0]['rolalumno']);

         $("#button_resgist").html("<i class='fa fa-check'></i>");
       } else {
        window.location='NotFound';
       }

    })
}

function Estraer_Datos_Docentes(){

 var iddocente=$("#cbm_docente").val();
 if (iddocente.length==0) {return;}
 $("#button_resgist").html("<i class='fa fa-spin fa-refresh'></i>");
  $.ajax({
        "url": "../controlador/usuario/controlador_Extraer_Docente.php",
        type: 'POST',
        data: { iddocente:iddocente}
    }).done(function(resp) {
       var data = JSON.parse(resp);
       if (data.length>0) {
        $("#contra").val('');
         $('#txt_apellido').prop('disabled',true);
         $('#txt_nombre').prop('disabled',true);
         $('#cbm_rol').prop('disabled',true);
         $('#cbm_alumno').prop('disabled',true);


         $("#txt_apellido").val(data[0]['apellidos']);
         $("#txt_nombre").val(data[0]['nombres']);
         $("#txt_dniUSU_golval").val(data[0]['dni']);
         listar_combo_rol(data[0]['rolDocente']);

         $("#button_resgist").html("<i class='fa fa-check'></i>");
       } else {
        window.location='NotFound';
       }

    })
}



function General_Contrasena_Alum(){
 var nomb = $("#txt_nombre").val();
 var dni = $("#txt_dniUSU_golval").val();
   dni= (dni.length >0) ? dni : '$@';
   if(nomb.length==0 || dni.length==0){
   return;
   }
  var mayuscula=nomb.toUpperCase();
  $("#contra").val(dni+'_'+mayuscula);

}

function Registrar_Usuario() {
    var f=new Date();
    var rolnombre = $("#cbm_rol option:selected").text();
    var docente = $("#cbm_docente").val();
    var alumno = $("#cbm_alumno").val();
    var otro = $("#cbm_otros").val();

    var nombre =$("#txt_nombre").val();
    var apellido =$("#txt_apellido").val().toUpperCase();;
    var usuario = $("#txt_usuario").val();
    var contra = $("#contra").val();
    var cbm_rol = $("#cbm_rol").val();
    

   
   var NameImg =apellido+'-'+rolnombre+'_'+f.getFullYear()+""+f.getSeconds()+"."+'jpg';
   var ImgPerfil = $("#perfil_seleccionararchivo")[0].files[0];

    if (nombre.length == 0 || apellido.length == 0 || usuario.length == 0 || contra.length == 0 || cbm_rol.length == 0) {
        return Swal.fire("Mensaje De Advertencia", "Llene los campos vacios", "warning");
    }

    var formData= new FormData();
    formData.append('rolnombre',rolnombre);
    formData.append('docente',docente);
    formData.append('alumno',alumno);
    formData.append('otro',otro);
    formData.append('nombre',nombre);
    formData.append('apellido',apellido);
    formData.append('usuario',usuario);
    formData.append('contra',contra);
    formData.append('cbm_rol',cbm_rol);
    formData.append('NameImg',NameImg);
    formData.append('ImgPerfil',ImgPerfil);
   
   
     $('#button_resgist').prop('disabled',true);
     $("#button_resgist").html("<i class='fa fa-spin fa-refresh'></i>");
    $.ajax({
    url: '../controlador/usuario/controlador_usuario_registro.php',
    type:'post',
    data:formData,
    contentType:false,
    processData:false,
    success: function(response){
      $("#button_resgist").html("<i class='fa fa-check'></i>");
          ResquestHttp(response,nombre,apellido);

    }
})
}

function ResquestHttp(resp,nombre,apellido){
 if (resp > 0) {

    if(resp==1){
    
      $('#button_resgist').prop('disabled',false);
    Swal.fire({ icon: 'success', title: 'Éxito !!', text: 'El Registro, se registro  de forma Éxitoso!! ',showConfirmButton: false, timer: 1700});  
    table.ajax.reload();
    Limpiar_Registrar_Usuario();
    }
    if(resp==100){
       
        $('#button_resgist').prop('disabled',false);
        return Swal.fire("Mensaje De Advertencia", "El Usuario "+apellido +', '+nombre+" ya esta registrado !!!"  , "warning");
    }
    if (resp==404) {
     
     $('#button_resgist').prop('disabled',false);
      window.location = "NotFound";
    } 
    if (resp==401) {
     window.location = "NotFound";} 
  
   } else {
     $('#button_resgist').prop('disabled',false);
    return Swal.fire("Mensaje De Error", "No se registro Registro Fallido!!"+resp+""  , "error"); 
 }
}


/////////////////////
$('#tabla_usuario').on('click', '.eliminar', function() {
  var data = table.row($(this).parents('tr')).data();
  //alert(data.usu_id);
  if (table.row(this).child.isShown()) {
      var data = table.row(this).data();
      var idusuario=data.usu_id;
  }
   var idusuario=data.usu_id;
      Swal.fire({
             title: 'Esta seguro de Eliminar al usuario?',
             text: "Una vez hecho esto el usuario no tendra acceso al sistema",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#05ccc4',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si'
         }).then((result) => {
             if (result.value) {
                 $.ajax({
                   "url": "../controlador/usuario/controlador_usuario_eliminar.php",
                   type: 'POST',
                   data: {
                       idusuario: idusuario
                   }
               }).done(function(resp) {
                   if (resp > 0) {
                        
                       table.ajax.reload();
                       Swal.fire({ icon: 'success', title: 'Éxito !!', text: 'La operación, se registro  de forma Éxitoso!! ',showConfirmButton: false, timer: 1700});  
                   }else{
                     Swal.fire({ icon: 'info', title: 'No se Completo !!', text: 'El usuario tiene la sesion Activa!! ',showConfirmButton: false, timer: 1700});  
                   }
               })
             }
    })
})

function Modificar_Estatus(idusuario, estatus) {
    var mensaje = "";
    if (estatus == 'INACTIVO') {
        mensaje = "desactivo";
    } else {
        mensaje = "activo";
    }
    $.ajax({
        "url": "../controlador/usuario/controlador_modificar_estatus_usuario.php",
        type: 'POST',
        data: {
            idusuario: idusuario,
            estatus: estatus
        }
    }).done(function(resp) {
        if (resp > 0) {
           
                table.ajax.reload();
            Swal.fire({ icon: 'success', title: 'Éxito !!', text: 'El Registro, se registro  de forma Éxitoso!! '+ mensaje ,showConfirmButton: false, timer: 1700});  
        }else{
           Swal.fire({ icon: 'info', title: 'No se Completo !!', text: 'El usuario tiene la sesion Activa!! ',showConfirmButton: false, timer: 1700});   
        }
    })
}



function filterGlobal() {
    $('#tabla_usuario').DataTable().search($('#global_filter').val(), ).draw();
}


async function listar_combo_rol(name_rol){
    var identi='';var nameCombo="--seleccione--";
    $.ajax({
           "url": "../controlador/usuario/controlador_combo_rol_listar.php",
           type: 'POST'
        }).done(function(resp) {
          var data = JSON.parse(resp);
          var cadena = "";
          if (data.length > 0) {
             cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {

                data[i][0]==name_rol ? 
                cadena += "<option value='" + data[i][0] + "' selected>" + data[i][1] + "</option>":
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }

            $("#cbm_rol").html(cadena);
          }else {
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#cbm_rol").html(cadena);
        }
    })
}

function XMLHttpRequestAsycn(request){


        $("#mensajes_aviso").html(request.mensaje);
        if (request.session) {
          location.reload();
        }

      
}


