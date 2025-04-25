<script type="text/javascript" src="../js/notasreportep.js?rev=<?php echo time();?>"></script>
<div class="col-md-12" >
	<div class="box box-warning ">
		<div class = "box-header with-border" id="Titulo_Center" >
      <h3 class = "box-title">Reporte de notas académicas</h3>
    </div>
		<!-- /.box-header -->
		<div class="box-body">
       <style type="text/css">#btn_bucar_data{
      border: none;border-radius: 5px;color: white;background-color: #05ccc4;
    }</style>
     <div class="row">
       <div class="col-xs-12">
        <div class="col-md-4">
          <label for="">Grados</label>
          <select class="js-example-basic-single" name="state" id="rep_cbm_grado" style="width:100%; "onchange="ShowSelectedCursos();" >
            
          </select><br><br>
        </div>
        <div class="col-md-4">
          <label for="">Nivel</label>
       <input type="text" name="" id="txt_nivelId" hidden >
       <input type="text" name="" class="form-control" id="txt_nivel_nivel" disabled>
        </div>
        <div class="col-md-4">
           <label for="">Seccion</label>
          <input type="text" name="" class="form-control" id="text_seccion" disabled>
        </div>
      </div>
    </div>
    <div class="row">
       <div class="col-xs-12">
        <div class="col-md-4">
           <label for="">Tipo (Bim,Tri,Sem)</label>
           <input type="text" name="" id="text_TipoEvaluacion" hidden >
          <select class="js-example-basic-single" name="state" id="cbm_tipoOrden"style="width:100%;"  >
            </select><br><br>

        </div>
        <div class="col-md-4">
          <label for="">Cursos&nbsp;UNID:</label><label for="" id="cantidadcurso"></label>
          <select class="js-example-basic-single" name="state" id="rep_comb_curso" style="width:100%;" disabled>
          </select><br><br>
        </div>
        <div class="col-md-4">
           <label for="">Año Académico</label>
          <div class="alin_global">
            <input type="text" name="" class="form-control"  disabled id="NombreayearActivo">&nbsp;
           <button onclick="Consultar_Notas();" class="btn-sm" id="btn_bucar_data"> <em class="fa fa-search" ></em> </button>
         </div>

        </div>
      </div>
    </div>

		</div>
	</div>
</div>

<?php


$isTrue=false;
if (!empty($_GET['idgrado'])) {
include_once 'fuctionsnota.php';

}
?>
 <?php if($isTrue) {?>
  <div class="col-md-12" >
  	<div class="box box-warning ">
  		<!-- /.box-header -->
  		<div class="box-body">
  			<div class="row">
  				<div class="col-xs-6 clasbtn_exportar">
  					 <div class="input-group" id="btn-place" ></div>
  				</div>
  				<div class="col-xs-6">
  					<div class="input-group">
                <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar Nombre a buscar" autocomplete="false" style="border-radius: 5px;">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
             </div>
  				</div>
  			</div>
   

        <table class="table table-striped" id="tbl-reporNota"  style=" width: 100%">
          <thead>
              <tr>
                  <th>N°</th>
                  <th>Alumno</th>
                  <?php foreach ($activity as $val) { ?>
                     <th><?= $val['actividades']?></th>
                       <?php } ?>
                   <th>Ponderado</th>
               </tr>
           </thead>
          <tbody>

              <?php
                   $count = 1; $poderado=0;
                  foreach ($alumnos as $alun) {
                ?>
                       <tr>
                           <td><?= $count ?></td>
                           <td ><?= $alun['apellidos'].','.$alun['alumnonombre'] ?></td>

                             <?php  for ($i=0; $i <count($activity) ; $i++)  { $notasin=NotasAlum($i,$alun['idalumno'],$notas); ?>

                                <?php if($notasin> 10.5) { ?>

                               <td align='center'><label class=' form-control'  id='id_aprob'><?php echo $notasin; ?> </label></td>

                                 <?php  }else{ ?>
                                  <td align='center'><label class=' form-control'  id='id_desap'><?php echo $notasin; ?></label></td>
                                 <?php }?>


                               <?php } ?>
                                       
                              <?php $notaFinal=Ponderado();
                               $reund= round($notaFinal);
                               if($reund> 10.5) { ?>
                                
                               <td align='center'><label class=' form-control'  id='id_aprob'><?php echo $reund; ?> </label></td>

                                 <?php  }else{ ?>
                                  <td align='center'><label class=' form-control'  id='id_desap'><?php echo $reund; ?></label></td>
                                 <?php }?>
                         </tr>
                 <?php
                   $count++;  }
                 ?>
             </tbody>
         </table>
         
      </div>
  	</div>
  </div>

 <?php }?>
<script type="text/javascript">
$(document).ready(function() {
   $("#refres_add").hide();
	$('.js-example-basic-single').select2();

listar_Combo_Grados_report();
listar_Combo_tipos_report();
YearAcademicoActivo();
initializeDataTable();

} );


 function initializeDataTable() {
    var table = $("#tbl-reporNota").DataTable({
        "ordering": true,
        "bLengthChange": false,
        "searching": {
            "regex": false
        },
        "responsive": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });

    var filterElement = document.getElementById("tbl-reporNota_filter");
    if (filterElement != null) {
        filterElement.style.display = "none";
    }

    $('input.global_filter').on('keyup click', function() {
        filterGlobal();
    });

    $('#btn-place').html(table.buttons().container());
}
function filterGlobal() {
  $('#tbl-reporNota').DataTable().search($('#global_filter').val(), ).draw();
}


</script>