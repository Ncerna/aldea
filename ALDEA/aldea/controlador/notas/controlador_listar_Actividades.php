<?php
    require '../../modelo/modelo_notas.php';
    $MU = new Nota();
    
      $idcurso = htmlspecialchars($_POST['idcurso'],ENT_QUOTES,'UTF-8');
       $tipoorden = htmlspecialchars($_POST['tipoorden'],ENT_QUOTES,'UTF-8');
        $tipoid = htmlspecialchars($_POST['tipoid'],ENT_QUOTES,'UTF-8');
         $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');

        //LISTANDO CARGA ACADEMICO POR CADAD TIPO BIMESTRE O TREM O SEMSTRE 

    $consulta = $MU->listar_CargaAcademicaPorCadaCursoPorTipo($idcurso,$tipoorden,$tipoid,$idyear);
    echo json_encode($consulta);
?>