<script type="text/javascript" src="../js/colegio.js?rev=<?php echo time();?>"></script>

<div class="col-md-12"  >
  <div class="box box-warning ">
 <form autocomplete="false" id="from" onsubmit="return false"   action="#" enctype="multipart/form-data" onsubmit="return false">
    <div class = "box-header with-border titulosclass" id="Titulo_Center"  >
       <h5 class="box-title" style="text-align: center;"><strong>INSTITUCIÓN EDUCATIVO</strong></h5>
       <div class="box-tools pull-right">
         <button type="button" class="btn btn-primary btn-sm"   title="" data-original-title="Remove" onclick="RegistrarDatosInstitucion();">
         <em  class="fa fa-check"></em>&nbsp;Guardar</button>
      </div>
    </div>
    <!-- /.box-header -->
    
    <div class="box-body">
      <div class="row">
         <div class="col-xs-12">
        <div class="col-md-3">
          <label >Nombres</label>
           <input type="text"  id="id_colegio" hidden >

           <input type="text" name="" class="form-control" id="txt_nombre" onkeypress = "return (event.charCode > 64 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||
             (event. charCode > 31 && event.charCode < 33)" ><br>
        </div>
        <div class="col-md-3" >
           <label>Ubicación</label>
              
               <input type="text" name="" class="form-control" id="txt_ubicacion" ><br>
        </div>
        <div class="col-md-3">
         <label>E-Mail</label>
           <input type="email" name="" class="form-control" id="txt_email" onkeypress = "return (event.charCode > 63 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||(event. charCode >47 && event.charCode<58)||(event. charCode>44 && event. charCode<47)||(event. charCode==95)" ><br>
         </div>            
        
        <div class="col-md-3">
         <label>Telefóno</label>
          
           <input type="number" name="" class="form-control" id="txt_telefono" ><br>
      
        </div>
       </div>
      </div>

      <div class="row">
               <div class="col-xs-12">

                <div class="col-md-4" >
                 <label>Logo</label>
                 <div class="widget-user-image">
                  <img   alt="User Image" id="logo_mostrarimagen" width="70px" height="70px">
                </div>
                <ul class="nav nav-stacked">
                  <input type="text"  id="fotoActual_logo" hidden >
                  <input type="file" class="form-control" id="logo_seleccionararchivo" accept="image/x-png,image/gif,image/jpeg"  style="border-radius: 5px;"><br>
                </ul>
              </div>
              <div class="col-md-4">
               <label>Escudo del País</label>
               <div class="widget-user-image">
                <img   alt="User Image" id="pais_mostrarimagen" width="70px" height="70px">
              </div>
              <ul class="nav nav-stacked">
                <input type="text"  id="fotoActual_pais"  hidden>
                <input type="file" class="form-control" id="pais_seleccionararchivo" accept="image/x-png,image/gif,image/jpeg"  style="border-radius: 5px;"><br>

              </ul>
            </div>            
            <div class="col-md-4">
             <label>Bandera</label>

             <div class="widget-user-image">
              <img   alt="User Image" id="baner_mostrarimagen" width="180px" height="50px">
            </div>
            <ul class="nav nav-stacked">
              <input type="text"  id="fotoActual_baner" hidden >
              <input type="file" class="form-control" id="banner_seleccionararchivo" accept="image/x-png,image/gif,image/jpeg"  style="border-radius: 5px;"><br>
            </ul>

          </div>
        </div>
    </div>


      <div class="row">
          <div class="col-xs-12">
              <div class="col-md-4">
                  <label>INSTITUCION(Unidad de Gestión Educativa Local)</label>
                  <input type="text" name="" class="form-control" id="txt_ugel" ><br>
              </div>
              <div class="col-md-4">
                  <label>Municipio</label>
                  <input type="text" name="" class="form-control" id="txt_municipio"><br>
              </div>
              <div class="col-md-4">
                  <label>BARRIO</label>
                  <input type="text" name="" class="form-control" id="txt_ep"><br>
              </div>            
          </div>
      </div>

      <div class="row">
          <div class="col-xs-12">
              <div class="col-md-4">
                  <label>MATRICULA DE LA INSTITUCION</label>
                  <input type="text" name="" class="form-control" id="txt_code"><br>
              </div>
              <div class="col-md-4">
                  <label>DEPARTAMENTO</label>
                  <input type="text" name="" class="form-control" id="txt_federal"><br>
              </div>
              <div class="col-md-4">
                  <label>Cdcee</label>
                  <input type="text" name="" class="form-control" id="txt_cdcee"><br>
              </div>            
          </div>
      </div>
      <div class="row">
          <div class="col-xs-12">
              <div class="col-md-4">
                  <label>Denominación y Epónimo</label>
                  <input type="text" name="" class="form-control" id="txt_denomination"><br>
              </div>
              <div class="col-md-4">
                  <label>CI DEL DIRECTOR</label>
                  <input type="text" name="" class="form-control" id="txt_identity"><br>
              </div>
              <div class="col-md-4">
                  <label>DIRECTOR/A DE LA INSTITUCION </label>
                  <input type="text" name="" class="form-control" id="txt_directors"><br>
              </div>            
          </div>
      </div>
     
    </div>
 </form>
   
  </div>
</div>


<script type="text/javascript">


$(document).ready(function() {
   $("#refres_add").hide();
   MostrarDatosActualesCole();
} );


  document.getElementById("banner_seleccionararchivo").addEventListener("change", () => {
         
            var archivoseleccionado = document.querySelector("#banner_seleccionararchivo");

 
            var archivos = archivoseleccionado.files;
            var imagenPrevisualizacion = document.querySelector("#baner_mostrarimagen");
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

    document.getElementById("pais_seleccionararchivo").addEventListener("change", () => {
            
            var archivoseleccionado = document.querySelector("#pais_seleccionararchivo");
            var archivos = archivoseleccionado.files;
            var imagenPrevisualizacion = document.querySelector("#pais_mostrarimagen");
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
      document.getElementById("logo_seleccionararchivo").addEventListener("change", () => {
            
            var archivoseleccionado = document.querySelector("#logo_seleccionararchivo");
            var archivos = archivoseleccionado.files;
            var imagenPrevisualizacion = document.querySelector("#logo_mostrarimagen");
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



