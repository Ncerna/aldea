<script type="text/javascript" src="../js/perfiluser.js?rev=<?php echo time();?>"></script>

 

<div class="col-md-3 pull-right"  >
	<div class="box box-warning " >
		<div class="box-body">
			<form autocomplete="false" onsubmit="return false"  method="POST" action="#" enctype="multipart/form-data" onsubmit="return false" >
				<div class="box-body box-profile">
					<img class="profile-user-img img-responsive img-circle" src="../imagenes/usuarios/images.png" alt="User profile picture"  id="mostrarimagen">
					<h5 class="profile-username text-center" id="datos_usuario"></h5>
					<p class="text-muted text-center"><strong id="rolnombre_user"></strong></p>
					<div  id="mensaje_aviso_pasword"></div>
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<strong>Imagen Perfil</strong>
							<ul class="nav nav-stacked">
								<input type="text"  id="fotoActual" hidden>
								<input type="file" class="form-control" id="seleccionararchivo" accept="image/x-png,image/gif,image/jpeg"  style="border-radius: 5px;">
							</ul>
						</li>
						<li class="list-group-item">
							<strong>Contrase&ntilde;a Actual</strong>
							<input type="password" class="form-control" id="txt_act_contra" placeholder="Ingrese contrase&ntilde;a Actual"  required onkeypress = "return (event.charCode > 63 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||(event. charCode >34 && event.charCode<39)||(event. charCode>47 && event. charCode<58)||(event. charCode==42)">
						</li>
						<li class="list-group-item">
							<strong>Contrase&ntilde;a Nueva(*)</strong> 
							<input type="password" class="form-control" id="txt_cont_nuw" placeholder="Ingrese contrase&ntilde;a Nueva"  required onkeypress = "return (event.charCode > 63 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||(event. charCode >34 && event.charCode<39)||(event. charCode>47 && event. charCode<58)||(event. charCode==42)">
						</li>
						<li class="list-group-item">
							<strong>Repita la Contrase&ntilde;a Nueva(*)</strong> 
							<input type="password" class="form-control" id="repcontra_contra" placeholder="Repita contrase&ntilde;a Repetida"  required onkeypress = "return (event.charCode > 63 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||(event. charCode >34 && event.charCode<39)||(event. charCode>47 && event. charCode<58)||(event. charCode==42)">
						</li>
					</ul>
					<a href="#" onclick="Modificar_Contrasena()" id="butt_regist" class="btn btn-primary btn-block" ><strong>Actualizar</strong></a>
				</div>

			</form>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
   
   Extraer_Datos_Perfil_user();
   $("#refres_add").hide();
    
} );
	


document.getElementById("seleccionararchivo").addEventListener("change", () => {
             $("#idfoto").show();
            var archivoseleccionado = document.querySelector("#seleccionararchivo");
            var archivos = archivoseleccionado.files;
            var imagenPrevisualizacion = document.querySelector("#mostrarimagen");
            // Si no hay archivos salimos de la función y quitamos la imagen
            if (!archivos || !archivos.length) {
            imagenPrevisualizacion.src = "";
            return;
            }
            // Ahora tomamos el primer archivo, el cual vamos a previsualizar
            var primerArchivo = archivos[0];
            // Lo convertimos a un objeto de tipo objectURL
            var objectURL = URL.createObjectURL(primerArchivo);
            // Y a la fuente de la imagen le ponemos el objectURL
            imagenPrevisualizacion.src = objectURL;
        });
</script>