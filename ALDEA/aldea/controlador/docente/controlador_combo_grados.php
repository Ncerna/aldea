
<?php
    require '../../modelo/modelo_docente.php';
    $MU = new Docente();
    $consulta = $MU->listar_combo_Grados();

    echo json_encode($consulta);
   
?>