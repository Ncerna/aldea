
 <?php


function get_include_contents($criterio,$numero,$notas,$tipoEv,$long) {
        $total = array();
	      $cont=1; 

            foreach ($criterio as  $value) {

               if($cont==1){
               echo '<td>'.  $value["criteriosEvaluacion"] .'</td>';
               echo ComponenteTD_Notas($notas,$tipoEv,$value["idboletNota"]);

               $sum=sumar_todo_notas_Criterio($notas,$tipoEv,$value["curso_id"],$total,$numero);

               //echo '<td rowspan="'.($numero +1).'" style="text-align: center" >'.count($notas).'</td>';
               echo '<td rowspan="'.($numero +1).'" align="center" ><strong>&nbsp;&nbsp;'.$sum.'</strong> </td>';
               echo '<td rowspan="'.($numero +1).'" align="center" ></td>';
               echo '</tr>';
               }else{
                
               echo ' <tr>';
               echo '<td>&nbsp;'.  $value["criteriosEvaluacion"] .'</td>';
               echo ComponenteTD_Notas($notas,$tipoEv,$value["idboletNota"]);

               echo '</tr>';

               }

              if($cont==$numero){

               echo ' <tr>';
               echo '<td ><strong>Ponderado Acumulado</strong></td>';
               echo componenteSinAcumulados($tipoEv);
                // echo componenteSinAcumulados($long);

              /* echo '<td ></td>';
               echo '<td ></td>';
               echo '<td >1</td>';
               echo '<td >c</td>';*/

               echo ' </tr>';

              }
            
               $cont++;

  }

}


function  sumar_todo_notas_Criterio($notas,$tipoEv,$idcurso,$total,$numero){

  foreach ($notas as  $value) {
   if ($value['id_curso']==$idcurso) {
     $total[]=$value['calificacions'];

   }
  }

  // Asignar valores numéricos a las letras
$valores = array('A' => 4, 'B' => 3, 'C' => 2, 'AD' => 5);

// Calcular el promedio de los valores numéricos
$suma = 0;$contador = 0;
foreach ($total as $valor) {
  if (isset($valores[$valor])) {
    $suma += $valores[$valor];
   $contador++;
  }
}

// Verificar si el contador es mayor que cero antes de realizar la división
if ($contador > 0) {
  $promedio = $suma / $contador;
} else {
  $promedio = 0;
}

// Convertir el valor numérico de vuelta a la letra correspondiente
if ($promedio >= $valores['AD']) {
  $letra = 'AD';
} elseif ($promedio >= 3.5) {
  $letra = 'A';
} elseif ($promedio >= 2.5) {
  $letra = 'B';
} elseif ($promedio >= 1.5) {
  $letra = 'C';
} else {
  $letra = '';
}

  return  !empty($letra) ? $letra : '';

}




//9SELECCIONAR NOTAS DEL CRITERIO ID
 function ComponenteTD_Notas($notas,$tipoEv,$idCrite)
  {  

     //FILTRANDO SOLO PERTENECIENTES AL LAS NOTAS DEL CRITERIO
     $filtered = array_values(array_filter($notas, function($value) use ($idCrite) {
        return $value["id_Criterio"] == $idCrite;
    }));

     //RECORRIENDO LAS NOTAS DEL CRITERIO FILTRADO
         

   if(count($filtered)>0){
    
         for ($i=0; $i < $tipoEv; $i++) { 


          //echo '<td >'.$filtered[$i]['calificacions'].':'.$i.'</td>';
        echo '<td align="center">&nbsp;&nbsp;&nbsp;&nbsp;'.(isset($filtered[$i]['calificacions']) ? $filtered[$i]['calificacions'] : ' ').'</td>';

          
     }

   } else{
         for ($i=0; $i < $tipoEv; $i++) { 
          echo '<td align="center" >&nbsp;&nbsp;&nbsp;&nbsp;</td>';
         }
   }


}




function componenteSinAcumulados($long){
  if ($long==4) {
   echo '<td ></td>';
   echo '<td ></td>';
   echo '<td ></td>';
   echo '<td ></td>';
 }
 if ($long==3) {
   echo '<td ></td>';
   echo '<td ></td>';
   echo '<td ></td>';
 }
 if ($long==2) {
   echo '<td ></td>';
   echo '<td ></td>';
 }
 if ($long==1) {
  echo '<td ></td>';
}

}
?>
