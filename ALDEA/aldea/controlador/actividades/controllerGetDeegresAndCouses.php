<?php
    require '../../modelo/modelo_actididades.php';
    $yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
    
    $MU = new Actyvite();
    $consulta = $MU->get_cousesAndDeegres($yearid);
    echo json_encode($consulta);


?>