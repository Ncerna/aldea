<?php
session_start();  
if (!empty($_SESSION['S_IDENTYTI'])) {
 $id_docente = $_SESSION['S_IDENTYTI'];
$yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
require '../../modelo/modelo_docente.php';
$MU = new Docente();
 $consulta=$MU->Listar_cursos_docente($id_docente,$yearid); 

  echo json_encode($consulta); 
}




     
?>