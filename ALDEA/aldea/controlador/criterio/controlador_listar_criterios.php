


<?php
    require '../../modelo/modelo_criterio.php';
    $MU = new Criterio();

    $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
    $idgrado=htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');
    $idcurso=htmlspecialchars($_POST['idcurso'],ENT_QUOTES,'UTF-8');
    $idnivel=htmlspecialchars($_POST['idnivel'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->listar_Criterios_Grado($idyear,$idgrado,$idcurso,$idnivel);
    echo json_encode($consulta);
?>

    
    
     


