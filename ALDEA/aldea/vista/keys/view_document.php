
<style type="text/css">
 .image-container {
  position: relative;
  overflow: hidden;
  height: 200px; /* Ajusta la altura según sea necesario */
}

.image-container img {
  width: 100%;
  height: 100%;
  object-fit: cover; /* Asegura que la imagen cubra todo el div */
}

.overlay_img {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    /* height: 40%; */
    background-color: rgb(66 64 59 / 70%);
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    text-align: center;
</style>

<script type="text/javascript" src="../js/report_xml.js?rev=<?php echo time();?>"></script>

<div class="col-md-12">
  <div class="box box-warning">
    <div class="box-header titulosclass" id="Titulo_Center">
      <h3 class="box-title"><strong>Reportes individual</strong> </h3>
    </div>
    <div class="box-body">

      <div class="row">
          
           <div class="col-md-6">
           	 <select class="js-example-basic-single" name="state" id="year_to_studente" style="width:100%;" >
           </select><br><br>
          </div>
         
           <div class="col-md-6">
         
	           <div class="alin_global">
	          <input type="text" name="message" id="key_lock_input"  class="form-control" placeholder="Llave de acceso" />&nbsp;
	           <button onclick="check_access();" class="btn-sm" id="btn_bucar_data"> <em class="fa  fa-lock" ></em> </button>
	         </div>
          </div>
        </div>
     
      <div class="row" id="students_by_conteiner_xmls">
        <!-- En pantallas grandes se muestran 6 columnas, en pantallas pequeñas 3 columnas -->
        
        <!-- Añade más columnas aquí si es necesario -->
      </div>
     
    </div>
  </div>
</div>




<script>
$(document).ready(function() {
    $("#refres_add").hide();
    $('.js-example-basic-single').select2();
    
     listar_combo_EscolarAsync();
     
    
} );
</script>