

/*let criterios=[
    {
        "id": "1",
        "criterio_name": "Notas Finales"
    },
    {
        "id": "2",
        "criterio_name": "Actitudinal"
    },
    {
        "id": "3",
        "criterio_name": "Comprecion Lectora"
    }
];

let binmestre=[
    {
        "id": "1",
        "tipo": "1°"
    },
    {
        "id": "2",
        "tipo": "2°"
    },
    {
        "id": "3",
        "tipo": "3°"
    },
    {
        "id": "4",
        "tipo": "4°"
    }
];

let Notas=[
    {
        "id": "0",
        "Nota": "14"
    },
    {
        "id": "1",
        "Nota": "10"
    },
    {
        "id": "2",
        "Nota": "17"
    }
];



function function_name() {

var html = '';

html += "<table class='table table-condensed'>";
html += "<thead>";

html += "<tr>";
html += "<th style='width: 10px'>N°</th>";
html += "<th>Críterio de Evaluación</th>";
$.each(binmestre, function(i, bim) {
  html += "<th align='center' style='width: 75px'>"+bim.tipo+"</th>";});
html += "</tr>";

html += "</thead>";
html += "<tbody id='tbody_tabla_Notas'>";
   $.each(criterios, function(i, crit) { 
   html += "<tr id='key"+i+"' > "; 
   html += "<td>"+crit.id+"</td>";
   html += "<td><input type='text' class='form-control' id='text_crite_nota'  value='"+crit.criterio_name+"' disabled></td>";

    $.each(Notas, function(j,not) {
    html += "<td><input type='number' class='form-control'  id='text_Cal' value='"+not.Nota+"' ></td>";
     });

    html += "</tr>";
    });
html += "</tbody>";
html += "</table>";

$('#id_tableNotas').append(html);
	
}
*/