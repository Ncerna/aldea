<script type="text/javascript" src="../js/coursesPending.js?rev=<?php echo time();?>"></script>

<div class='col-lg-12' style='border-color: #f5c6cb;' >
    <div id='avisomanual' class='alert sm' role='alert' style='color: #0e0102; background-color: #acefe4;'>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Aquí se listan los alumnos con notas menores a <strong> 10.5 </strong> durante todo el año académico.
    </div>
</div>

 <div class="col-xs-12">
	 <div class="box box-warning ">
	    <div class="box-header with-border">
		 <div class="row">
				  <div class="col-md-3 pull-left">
				    <select class="js-example-basic-single" id="pending_yerarId" style="width:100%;" onchange="onYearChange()">
				    </select>
				</div>
				<div class="col-md-3">
				    <select class="js-example-basic-single" id="pendingStudents" style="width:100%;" onchange="onStudentChange()">
				    </select>
				</div>
				<div class="col-md-3">
				    <select class="js-example-basic-single" id="pendinCouseId" style="width:100%;" >
				    </select>
				</div>


                 <div class="col-md-3">
                    <div class="alin_global">
                     <input type="text" name="table_search" id="searchInput" class="form-control pull-right" placeholder="Search">&nbsp;
                     <button onclick="get_studenteNotaPending(this);" class="btn" style="background-color: #05ccc4; color: #fff;border-radius: 5px;"  class="btn btn-flat">
                    <i class="fa fa-search" ></i>
                    </button>
                    </div>
                </div>   
        </div>
	  </div>

	     <div class="box-body table-responsive no-padding" id="tableContainer">
			</div>
			 <div class="modal-footer">
			 	 <button class="btn btn-secondary" onclick="saveNotas(this)">Guardar Notas</button>
	         
	     </div>
		</div>
	</div>



	<script>

$(document).ready(function() {
   $("#refres_add").hide();
  $('.js-example-basic-single').select2();
   listar_combo_EscolarAsync();
   getTypes({},null);
 

} );

$('#searchInput').on('keyup', function() {
        const filter = $(this).val().toLowerCase(); // Obtener el valor del campo de búsqueda
        $('.table tbody tr').filter(function() {
            // Mostrar u ocultar filas según si contienen el término de búsqueda
            $(this).toggle($(this).text().toLowerCase().indexOf(filter) > -1);
        });
    });


async function onYearChange() {
    var idyear = $('#pending_yerarId').val();
    // Aquí puedes agregar la lógica para manejar el cambio de año
    // Por ejemplo, llamar a la función para listar estudiantes
    await listar_combo_Alumnos(null, idyear); // Cambia 'null' por el id_alumno si es necesario
}

async function onStudentChange() {
    var id_alumno = $('#pendingStudents').val();
    await fiterStudentsById(id_alumno);
}



</script>