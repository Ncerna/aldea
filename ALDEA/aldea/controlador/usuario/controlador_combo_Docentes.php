
<?php
    require '../../modelo/modelo_usuario.php';
    $MU = new Modelo_Usuario();
    $consulta = $MU->listar_combo_Docentes_Disponibles();
    echo json_encode($consulta);
?>