

<?php
    require '../../modelo/modelo_criterio.php';
    $MU = new Criterio();

    $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Consulta_limitd_CriteriosAdd($idyear);
    echo json_encode($consulta);
?>
