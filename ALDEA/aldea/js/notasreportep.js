



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


//FILTRAR NIVELES DEL COMBO GRADOS
 async function lista_combo_CodigoCurso(id){
   let desarrolladores = temturno.filter(item => item.idgrado == id)
      $("#txt_nivelId").val(desarrolladores[0][2]);
      $("#txt_nivel_nivel").val(desarrolladores[0][3]);
      $("#text_seccion").val(desarrolladores[0][4]);
} 


//LISTAR CURSOS PERTENECENTES AL GRAADO Y ALUMUNOS DE ESE GRADOS
   async function getCousesByIdDegre(idgrado) {
    var idyear  = $("#YearActualActivo").val();

    lista_combo_CodigoCurso(idgrado);
       var gradoid=idgrado;

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
                $("#rep_comb_curso").prop('disabled',false);

                   cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
                 for (var i = 0; i < data.length; i++) {
                
                      cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
               
                 }
                 $("#rep_comb_curso").html(cadena);

             } else {
               $("#cantidadcurso").html(data.length);
                 cadena += "<option value=''>NO HAY CURSOS</option>";
                 $("#rep_comb_curso").html(cadena);
             }
     

         })
     }

//EXTRAER TIPO DE PERIO 11,2°,3°4° DEL AÑO ACTIVO Y SUS FECHAS DE VENCIMIMENTO
//ALA TABLA PERIODOS DB

//ordenTipo_periodo,tipo_periodo,tipo_nombre,fech_inicio, fech_final//

//AQU ES PARA RESTINGIR LAS FECHA PARA LA EVALUACION
async function listar_Combo_tipos_report() {

   var identi='';var nameCombo="--seleccione--";
 var idyear  = $("#YearActualActivo").val();
if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}

    $.ajax({
        "url": "../controlador/notas/controlador_listar_perioEvaluacion.php",
        type: 'POST',
        data:{idyear:idyear}
    }).done(function(resp) {
     var data = JSON.parse(resp);
     var cadena = "";
        if (data.length > 0) {
              cadena += "<option value='" + identi+ "'>" + nameCombo + "</option>";
            for (var i = 0; i < data.length; i++) {
                 cadena += "<option value='" + data[i][0] + "'>" +""+(i+ Number(1))+"°_"+ data[i][2] + "</option>";

            }
            $("#cbm_tipoOrden").html(cadena);
            } else {
            cadena += "<option value=''>NO SE ENCONTRARON AÑOS ACADEMICOS ACTIVOS</option>";
            $("#cbm_tipoOrden").html(cadena);
        }
        $("#text_TipoEvaluacion").val((data[0][1]));
     })

}

function Consultar_Notas(){

//$('#btn_bucar_data').prop('disabled',true);
//$("#btn_bucar_data").html("<i class='fa fa-spin fa-refresh'></i>");

var idgrado =$("#rep_cbm_grado").val();
var idcurso =$("#rep_comb_curso").val();
var idsecion = $("#text_seccion").val();
 var idyear  = $("#YearActualActivo").val();

 if (idyear == null || idyear==0 || !idyear || idyear.length == 0) {console.log('NotData_Request');return;}
var tipoorden =$("#cbm_tipoOrden").val();
var tipoid =$("#text_TipoEvaluacion").val();
var idnivel = $("#txt_nivelId").val();

 if (idcurso?.length==0 || idgrado?.length==0 || idsecion?.length==0|| tipoorden?.length==0|| idnivel?.length==0 ) {
   return Swal.fire("MENSAJE DE ADVERTENCIA", "Debes seleccionar los prámetos para consilutar notas corectamente  !!", "warning");
  }

 $("#contenido_principal").load("notas/vista_reporte_notas.php?idgrado="+idgrado+"&idcurso="+idcurso+"&idsecion="
  +idsecion+"&tipoorden="+tipoorden+"&tipoid="+tipoid+"&idyear="+idyear+"&idnivel="+idnivel); 

// $("#contenido_principal").load("notas/vista_reporte_notas.php?idgrado="+idgrado+"&idcurso="+idcurso+"&idsecion="+idsecion+"&tipoOrden="+encodeURIComponent(tipoOrden)); 

//$('#btn_bucar_data').prop('disabled',false);
//$("#btn_bucar_data").html("<i class='fa fa-search'></i>");

}


async function ShowSelectedCursos(){
  var idgrado = $("#rep_cbm_grado").val();

   if(idgrado){
    getCousesByIdDegre(idgrado);
    }
  }

  function YearAcademicoActivo(){
var nonbreYearActual  = $("#tex_YearActual_").val();
$("#NombreayearActivo").val(nonbreYearActual);

}

