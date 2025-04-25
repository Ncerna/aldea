

<!--<div class='col-lg-12' style='border-color: #efc4ac; ' >
      <div id='' class='alert  sm' role='alert' style='color: #0b4e52; background-color: #efc4ac;'><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <strong>En esta sesión se están trabajando diversos componentes que contribuirán al desarrollo y éxito de nuestro proyecto. Agradecemos su participación activa y compromiso. ¡Juntos lograremos grandes resultados!</strong>  
     </div>
   </div>-->

<style type="text/css">
 .image-container {
  position: relative;

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
      <h3 class="box-title"><strong>Reportes generales</strong> </h3>
    </div>
    <div class="box-body">
     

      <div class="row">
          <div class="col-md-4 ">
           <select class="js-example-basic-single" name="state" id="yerar_xml" style="width:100%;" >
           </select><br><br>
          </div>
           <div class="col-md-4">
             <select class="js-example-basic-single" name="state" id="cbm_grado_xmls" style="width:100%;" >
           </select><br><br> 
          </div>
           <div class="col-md-4">
             <div class="alin_global">
               <button onclick="get_xmls2({});" class="btn" type="submit"  id="but_alin_global" class="btn btn-flat">
              <i class="fa fa-search" ></i>
              </button>
              </div>
          </div>
        </div>
     
      <div class="row" id="conteiner_xmls">
        <!-- En pantallas grandes se muestran 6 columnas, en pantallas pequeñas 3 columnas -->
        
        <!-- Añade más columnas aquí si es necesario -->
      </div>
    </div>
  </div>
</div>





<div class="col-md-12">
  <div class="box box-warning">
    <div class="box-header titulosclass" id="Titulo_Center">
      <h3 class="box-title"><strong>Reportes individual</strong> <label id="studentSelecXml"></label> </h3>
    </div>
    <div class="box-body">

      <div class="row">
          <div class="col-md-4 ">
           <select class="js-example-basic-single" name="state" id="sudents_xml" style="width:100%;" >
           </select><br><br>
          </div>
           <div class="col-md-4">
              
          </div>
           <div class="col-md-4">
             <div class="alin_global">
               <button onclick="getStudentsXml();" class="btn" type="submit"  id="but_alin_global" class="btn btn-flat">
              <i class="fa fa-search" ></i>
              </button>
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
     Listar_combo_gradosActivos() ;
     listar_combo_EscolarAsync();
     listar_combo_Alumnos();
    
} );
</script>