
<script type="text/javascript" src="../js/docente_criterio.js?rev=<?php echo time();?>"></script>

<div class="col-md-12" id="DivTableAlumno">
  <div class="box box-warning ">
   <div class="box-header with-border" id="Titulo_Center">
    <h5 class="box-title"><strong>Críterios para Libretas de Notas  Numéricos (0-20)</strong></h5>

  </div>
  <style type="text/css">
    #tabla_matricula{
      border: 1px solid #d4f4f7;
      border-radius: 10px;
      background-color: #f5f7f7;
    }
    #btn_bucar_data{
      border: none;border-radius: 5px;color: white;background-color: #05ccc4;
    }
  </style>

  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-xs-4 ">
      </div>
      <div class="col-xs-2 "> 
      </div>
      <div class="col-xs-6 pull-right" >
       <div class="input-group">
        <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar">
        <span class="input-group-addon"><em class="fa fa-search"></em></span>
      </div>
    </div>

  </div><br>

  <table id="tabla_matricula" class="display responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <th>Nº Registro</th>
        <th>Apellidos</th>
        <th>Nombres</th>
        <th>Grado</th>
        <th>Nivel</th>
        <th>Sección</th>
        <th>Acci&oacute;n</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
     </tr>
   </tfoot>
 </table>
</div>
</div>
<!-- /.box -->
</div>



<div class="col-md-12" id="Div_boletaNotas" style="display: none">
  <div class="box box-warning ">
    <div class="box-header with-border">
      <div class="col-xs-2">
        <a  onclick="Black_MenuAsis();">&nbsp;<i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true" style="color: #05ccc4"></i></a>
      </div>
      <h3 class="box-title" style="text-align: center;"><strong>Calificaciones finales Numéricos (0-20)</strong></h3>
    </div>
    <!-- /.box-header -->
    
    <div class="box-body">
      <div class="row">
       <div class="col-xs-12">
        <div class="col-md-4">
          <label for=""><strong>Alumno (*)</strong></label>
          <input type="text" class="form-control" id="id_Alumno" style="display: none;">
          <input type="text" class="form-control" id="nom_Alumno" disabled>
        </div>
        <div class="col-md-4">
          <label for="">Grado (*)</label>
          
          <select class="js-example-basic-single" name="state" id="txt_evaluacion_grado" style="width:100%;" disabled >
          </select><br><br>

        </div>
        <div class="col-md-4">
          <label for="">Nivel (Prim/Secun) (*)</label>
          <input type="text"  id="txt_nivelId" hidden >
          <input type="text" class="form-control" id="txt_nivel_nivel" placeholder="Ingrese nombre" disabled><br>
          
        </div>
      </div>
    </div>

    <div class="row">
     <div class="col-xs-12">
      <div class="col-md-4">

       <label for="">Cursos&nbsp;UNID:</label><label for="" id="cantidadcurso"></label>
       <select class="js-example-basic-single" name="state" id="cbm_curso" style="width:100%;" onchange="ShowCriteriosselectd();">
       </select><br><br>
     </div>
     <div class="col-md-4">
       <label for="">Año academico (*)</label>
       <div class="alin_global">
         <input type="text"  id="tipo_evaluacion" hidden>
         <input type="text" class="form-control" id="NombreayearActivo"  disabled>
         &nbsp;
         <button onclick="Extraer_Notas_Curso_Year();" class="btn btn-primary"  id="btn_bucar_data" class="btn btn-flat" >
          <em class="fa fa-search" ></em>
        </button>
      </div>
      
    </div>
    <div class="col-md-4">
     
    </div>
    
  </div>
</div>


</div>
</div>
</div>
<style type="text/css">
  .highlight {
  background-color: #e9e1d5;
   border-radius: 5px;

}

</style>

<div id="contenidoCriteriosNotas"></div>
<div id="toasts"></div>


<script>

  $(document).ready(function() {
    $("#refres_add").hide();
   listar_alumnos_Boleta_Notas();
   $('.js-example-basic-single').select2();

 } );

  function ShowCriteriosselectd(){
    var idcurso = $("#cbm_curso").val();
    var idgrado = $("#txt_evaluacion_grado").val();

    if(idcurso && idgrado){
     listar_Criterios_Curso(idcurso,idgrado);
   }

 }

</script>