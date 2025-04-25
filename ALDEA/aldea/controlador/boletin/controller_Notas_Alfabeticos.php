

<?php
     require '../../modelo/modelo_boletaNota.php';
    $MU = new Boletin_Notas();


    $idAlumno = htmlspecialchars($_POST['idAlumno'],ENT_QUOTES,'UTF-8');
    $idcurso = htmlspecialchars($_POST['idcurso'],ENT_QUOTES,'UTF-8');
    $id_year = htmlspecialchars($_POST['id_year'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Extraer_Notas_Alfabeticos($idAlumno,$idcurso,$id_year);
    echo json_encode($consulta);

 ?>