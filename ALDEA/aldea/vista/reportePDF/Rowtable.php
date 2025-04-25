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
  return  ((array_sum($total)/$numero)/$tipoEv);
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
          echo '<td align="center">&nbsp;&nbsp;&nbsp;&nbsp;'.$filtered[$i]['calificacions'].'</td>';

          
     }

   } else{
         for ($i=0; $i < $tipoEv; $i++) { 
          echo '<td align="center" >&nbsp;&nbsp;&nbsp;&nbsp;0</td>';
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
