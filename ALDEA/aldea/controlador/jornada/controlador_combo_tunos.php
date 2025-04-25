
<?php
    require '../../modelo/modelo_jornadas.php';
    $MU = new JornasHoras();

     $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->listar_combo_Turnos($idyear);
    echo json_encode($consulta);
?>