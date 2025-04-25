
<?php
    require '../../modelo/modelo_fasescolar.php';
    $MU = new Fasescolar();
    $year = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
     $consulta = $MU->Quitar_Fase_Escolar($year);
    echo json_encode($consulta);
   
?>