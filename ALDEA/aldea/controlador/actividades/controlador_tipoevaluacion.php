
<?php
    require '../../modelo/modelo_actididades.php';
    $MU = new Actyvite();
    $idyear = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Listar_Combo_tipoevaluacion($idyear);
    
    echo json_encode($consulta);


?>