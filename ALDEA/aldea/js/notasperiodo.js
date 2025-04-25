


//idgrado, gradonombre,nivel_id,nombreNivell,seccion
var temturno;
function listar_Combo_Grados_report() {
	var identi='';var nameCombo="--seleccione--";
	$.ajax({
		"url": "../controlador/notas/controlador_combo_grados.php",
		type: 'POST'
	}).done(function(resp) {
		var data = JSON.parse(resp);
		var cadena = "";
		if (data.length > 0) {
			temturno=data;
			cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
			for (var i = 0; i < data.length; i++) {

				cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + ",&nbsp;" + data[i][3] +",SECCIÓN:" + data[i][4] + "</option>";
			}
			$("#rep_cbm_grado").html(cadena);

		} else {
			cadena += "<option value=''>NO HAY GRADOS ACTIVOS</option>";
			$("#rep_cbm_grado").html(cadena);
		}

	})
}

function 	getCousesByIdDegree(idgrado){
 var gradoid=idgrado;
       var idyear  = $("#YearActualActivo").val();

       //FILTRAR NIVEL Y SECCION DEL GRDO SEGUN LO SELECCIONADO
       lista_combo_CodigoCurso(gradoid);
      // listar_Alumnos(gradoid);

          var identi='';var nameCombo="--seleccione--";
         $.ajax({
             "url": "../controlador/notas/controlador_combo_curso.php",
             type: 'POST',
             data:{gradoid:gradoid,idyear:idyear}
         }).done(function(resp) {
           var data = JSON.parse(resp);
             var cadena = "";
             if (data.length > 0) {
                $("#cantidadcurso").html(data.length);

                   cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
                 for (var i = 0; i < data.length; i++) {
                
                      cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
               
                 }
                 $("#couses_degree").html(cadena);

             } else {
               
                 cadena += "<option value=''>GRADO SIN CURSOS ESTABLECIDO</option>";
                 $("#couses_degree").html(cadena);
             }
     

         })
 lista_combo_CodigoCurso(idgrado);
}


//FILTRAR NIVELES DEL COMBO GRADOS
async function lista_combo_CodigoCurso(id){
	let desarrolladores = temturno.filter(item => item.idgrado == id)

	$("#txt_nivelId").val(desarrolladores[0][2]);
	$("#txt_nivel_nivel").val(desarrolladores[0][3]);
	$("#text_seccion").val(desarrolladores[0][4]);
} 


//NO SE ESTA USANDO EN NINGUNA PARETE
async function listar_Alumnos_Notas_periodo() {


	var idyear  = $("#YearActualActivo").val();
	if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}

	$.ajax({
		"url": "../controlador/notas/controlador_Notas_Listar_Periodo.php",
		type: 'POST',
		data:{idyear:idyear}
	}).done(function(request) {
		var datos = JSON.parse(request);

		console.log(datos);
		$("#tabla_notas_periodo").html(datos);



	})
}


function Consultar_Parametros(){

var idgrado =$("#rep_cbm_grado").val();
var idcurso =$("#couses_degree").val();
var idsecion = $("#text_seccion").val();
 var idyear  = $("#YearActualActivo").val();
 var idnivel = $("#txt_nivelId").val();
 var nombreNivel = $("#txt_nivel_nivel").val();


 if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}



 if ( idgrado?.length==0 || idsecion?.length==0||  idnivel?.length==0 ) {
   return Swal.fire("MENSAJE DE ADVERTENCIA", "Debes seleccionar los prámetos para consilutar notas corectamente  !!", "warning");
  }

  $("#contenido_principal").load("notas/vista_notas_periodos.php?idgrado="+idgrado+"&idcurso="+idcurso+"&idsecion="
  +idsecion+"&idyear="+idyear+"&idnivel="+idnivel+"&nombreNivel="+nombreNivel); 

}


async function ShowSelectedCursos(){
	var idgrado = $("#rep_cbm_grado").val();

	if(idgrado){
		getCousesByIdDegree(idgrado);
		
	}
}







