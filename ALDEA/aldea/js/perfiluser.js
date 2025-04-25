


function Extraer_Datos_Perfil_user(){
    $.ajax({
        url:'../controlador/usuario/ControllerDatosUser.php',
        type:'POST' 
    }).done(function(resp) {
        var data = JSON.parse(resp);
        
        if (data.auth) {
          data=data.data;
            $("#fotoActual").val(data[0]['imagen']);
          $("#mostrarimagen").attr("src","../imagenes/usuarios/"+data[0]['imagen']);
          $("#datos_usuario").html(data[0]['usu_nombre']+','+data[0]['usu_apellidos']);
           $("#rolnombre_user").html(data[0]['rol_nombre']);
        }else{
          $("#mensaje_aviso_pasword").html(data.data);
        }
    })
      }


      function Modificar_Contrasena(){
        
         $("#butt_regist").html(" ");
        $("#butt_regist").html("Loading ...");
        $('#butt_regist').prop('disabled',true);

      	var f=new Date();
      	var contraActual=$("#txt_act_contra").val();
      	var fotoActual=$("#fotoActual").val();
      	var newcontra=$("#txt_cont_nuw").val();
      	var segundacontra=$("#repcontra_contra").val();
      	var NameImg ="USER_UPDATE"+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMinutes()+""+f.getSeconds()+"."+'jpg';
      	var bystImg = $("#seleccionararchivo")[0].files[0];


      	var formData= new FormData();
     
      	formData.append('bystImg',bystImg);
      	formData.append('NameImg',NameImg);
      	formData.append('contraActual',contraActual);
      	formData.append('newcontra',newcontra);
      	formData.append('segundacontra',segundacontra);
      	formData.append('fotoActual',fotoActual);
      	$.ajax({
      		url:'../controlador/usuario/ControllerModifiedContrasena.php',
      		type:'POST',
      		  data:formData,
                contentType:false,
                processData:false,
                 success: function(respuesta){
                 	var data =JSON.parse(respuesta);
                         if (data.data > 0) {
                         	 $("#butt_regist").html("Actualizado");
                          $('#butt_regist').prop('disabled',false);

                        Swal.fire({
                         title: 'Desea Cerrar sesión?',
                         text: "para Ingresar con la contraceña nueva",
                         icon: 'success',
                         showCancelButton: true,
                         confirmButtonColor: '#05ccc4',
                         cancelButtonColor: '#a8b3b2',
                         confirmButtonText: 'Si'
                             }).then((result) => {
                               if (result.value) {
                                // window.open('../controlador/usuario/controlador_cerrar_session.php');
                                 window.location = '../controlador/usuario/controlador_cerrar_session.php'

                              }
                               location.reload();
                           })                 
            
        } else {
           $("#butt_regist").html("Actualizar");
            $('#butt_regist').prop('disabled',false);
           $("#mensaje_aviso_pasword").html(data.data); 
        }

                }
            });
      }