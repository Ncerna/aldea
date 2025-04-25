

 <?php
/*

function get_include_contents($criterio,$numero,$notas,$tipoEv) {

	      $cont=1; 

            foreach ($criterio as  $value) {

               if($cont==1){
               echo '<td>'.  $value["criteriosEvaluacion"] .'</td>';
               echo ComponenteTD_Notas($notas,$tipoEv,$value["idboletNota"]);
               //echo '<td rowspan="'.($numero +1).'" style="text-align: center" >'.count($notas).'</td>';
                echo '<td rowspan="'.($numero +1).'" style="text-align: center" > </td>';
               echo '<td rowspan="'.($numero +1).'" style="text-align: center" >SI</td>';
               echo '</tr>';
               }else{
                
               echo ' <tr>';
               echo '<td>'.  $value["criteriosEvaluacion"] .'</td>';
               echo ComponenteTD_Notas($notas,$tipoEv,$value["idboletNota"]);
               echo '</tr>';

               }

              if($cont==$numero){

               
               echo ' <tr>';
               echo '<td><strong>Ponderado Acumulado</strong></td>';
               echo '<td ></td>';
               echo '<td ></td>';
               echo '<td ></td>';
               echo '<td ></td>';
               echo ' </tr>';

              }
            
               $cont++;
  }

}

//SELECCIONAR NOTAS DEL CRITERIO ID
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
          echo '<td >'.$filtered[$i]['calificacions'].'</td>';

          
	   }

   } else{
   	     for ($i=0; $i < $tipoEv; $i++) { 
		      echo '<td >0</td>';
	       }
   }

}


/*
 function PonderadosAcumulado($notas,$tipoEv,$idCrite)
{
  $posicion=0; $numeros=array();

     //FILTRANDO SOLO PERTENECIENTES AL LAS NOTAS DEL CRITERIO
     $filtered = array_values(array_filter($notas, function($value) use ($idCrite) {
        return $value["id_Criterio"] == $idCrite;
    }));
  
     $resultado = array_merge($filtered);

     if(count($filtered)>0){

      foreach ($filtered as $key => $value) {


         echo '---->'.$value[0]['calificacions'];


         array_push($numeros, $sum);
       $posicion++;
        # code...
      }
     

      

     }


       foreach ($numeros as $value) {
    echo '---->'.$value;
}

}
*/



/*
function get_include_contents($criterio) {
            foreach ($criterio as  $value) {
               echo '<td>'.'$value["criteriosEvaluacion"]'.'</td>';
               echo '<td >A</td>';
               echo '<td >A</td>';
               echo '<td >A</td>';
               echo '<td >A</td>';
               echo '<td rowspan="3" style="text-align: center" >9</td>';
               echo '<td rowspan="3" style="text-align: center" >SI</td>';
               echo '</tr>';
  }

}
*/
/*
function get_include_contents($criterio) {
            foreach ($criterio as  $value) {
               echo '<td> HHH </td>';
               echo '<td >A</td>';
               echo '<td >A</td>';
               echo '<td >A</td>';
               echo '<td >A</td>';
               echo '<td rowspan="3" style="text-align: center" >9</td>';
               echo '<td rowspan="3" style="text-align: center" >SI</td>';
               echo '</tr>';
  }
*/

?>
<!--

<tbody>
              
               <?php foreach ($cursos as $curso):?>
               
                <tr>
                <td rowspan="<?php count($criterio) ?>" style="width: 10px;text-align: center"><?php echo $curso['nonbrecurso'] ?></td>
                  <?php  foreach ($criterio as $key => $value) { ?>
                <td><?php print_r($value['criteriosEvaluacion']); ?></td>
                 
                  <?php for ($i=0; $i <count($tipoEv) ; $i++) {  ?>
                
                <td ><?php print_r($i); ?></td>

                <?php }?>
                <td rowspan="<?php count($criterio) ?>" style="text-align: center" >9</td>
                <td rowspan="<?php count($criterio) ?>" style="text-align: center" >SI</td>
                 <?php }?>
              </tr>

                <?php endforeach;?>
             
             <tr>
               <td><strong>Ponderado Acumulado</strong></td>
               <td >15</td>
               <td >14</td>
               <td >10</td>
               <td >19</td>

             </tr>
            
         </tbody>
-->