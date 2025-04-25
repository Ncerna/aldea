

<?php
    require '../../modelo/modelo_notas.php';
    $MU = new Nota();
    $gradoid = htmlspecialchars($_POST['gradoid'],ENT_QUOTES,'UTF-8');
     $idyear = isset($_POST['idyear']) ? htmlspecialchars($_POST['idyear'], ENT_QUOTES, 'UTF-8') : null;

    $consulta = $MU->Listar_combo_Cursos_grado($gradoid, $idyear);

    echo json_encode($consulta);
?>