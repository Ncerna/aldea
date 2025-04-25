
<?php
    require '../../modelo/modelo_matricula.php';
    $MU = new Matricula();
     $idgrado = htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Extrae_datos_Grados($idgrado);
    echo json_encode($consulta);
?>