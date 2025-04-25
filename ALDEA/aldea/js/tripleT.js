var temturno;
function getDegreesAndCouses() {
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

async function lista_combo_CodigoCurso(id){
	let desarrolladores = temturno.filter(item => item.idgrado == id)
	$("#txt_nivelId").val(desarrolladores[0][2]);
	$("#txt_nivel_nivel").val(desarrolladores[0][3]);
	$("#text_seccion").val(desarrolladores[0][4]);
} 

async function SelectedCursos(){
	var idgrado = $("#rep_cbm_grado").val();

	if(idgrado){
		//listar_Combo_Cursos_grado_report(idgrado);
		lista_combo_CodigoCurso(idgrado);
	}
}

var filter={};
function getNotesCurrente(){

var idgrado =$("#rep_cbm_grado").val();
//var idcurso =$("#rep_comb_curso").val();
var idsecion = $("#text_seccion").val();
 var idyear  = $("#YearActualActivo").val();
 var idnivel = $("#txt_nivelId").val();
 var nombreNivel = $("#txt_nivel_nivel").val();
 var nameDegre = $("#rep_cbm_grado option:selected").text();

 if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}

 if ( idgrado?.length==0 || idsecion?.length==0||  idnivel?.length==0 ) {
   return Swal.fire("MENSAJE DE ADVERTENCIA", "Debes seleccionar los prámetos para consilutar notas corectamente  !!", "warning");
  }


   $("#contenido_principal").load("notas/vista_notas_tripleT.php?idgrado="+idgrado+/*"&idcurso="+idcurso+*/"&idsecion="
 +idsecion+"&idyear="+idyear+"&idnivel="+idnivel+"&nombreNivel="+nombreNivel + "&nameDegre=" + encodeURIComponent(nameDegre)); 

}

function printExcel(btn){
	var tablaHTML = document.getElementById('tlb_export_excel').outerHTML;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../controlador/boletin/controller_report_excel.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            var blob = new Blob([xhr.responseText], { type: 'application/vnd.ms-excel' });
            var url = window.URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'REPORTE_NOTAS_3T.xls';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        } else {
            console.error('Error al generar el archivo Excel.');
        }
    };
    xhr.send('tablaHTML=' + encodeURIComponent(tablaHTML));
}