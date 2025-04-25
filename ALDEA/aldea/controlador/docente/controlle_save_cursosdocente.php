
<?php
require '../../modelo/modelo_docente.php';
$MU = new Docente();


$selecionado = htmlspecialchars($_POST['data'],ENT_QUOTES,'UTF-8');
$data=(isset($_POST['data']))? json_decode($_POST['data'],true): array("error"=>"no se pudo completar el registro");


foreach ($data as $value) {

		echo $value['nombrecurso'];
		echo "</br>";
		
	}


//if (isset($selecionado)) {
	
	//echo "hola".$selecionado[9]['nombrecurso'];

//print_r($selecionado);

	//print_r($selecionado);
	//foreach ($selecionado as $value) {

		//echo $value['idgrado'];
		
	//}
//}else{
//print_r($selecionado);	
//
 
  

       ?>