<?php
require '../../modelo/modelo_colegio.php';
$cole = new Colegio();

$Response=$cole->ExtraerDatosActualesColegio();
echo json_encode($Response);


?>