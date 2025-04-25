<?php 
require '../../../plantilla/dompdf_php8/vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;
try {
  

$idstudent = htmlspecialchars($_GET["idalumno"],ENT_QUOTES,'UTF-8');
$id_year = htmlspecialchars($_GET["id_year"],ENT_QUOTES,'UTF-8');
$idgrado = htmlspecialchars($_GET["idgrado"],ENT_QUOTES,'UTF-8');

include_once '../../../modelo/modelo_notas.php';
  $MU  = new  Nota();

  $tiposevaluacion = $MU->Listar_Notas_Periodo($id_year);
  $alumnos = $MU->getReportcardByIdStudents($idgrado,$id_year,$idstudent);
  $resultado = $MU->showSchoolInformation();
  $schools = $resultado['data'];

  $school=$schools[0];
  $alumno=$alumnos[0];

// Obtener la lista de cursos únicos
$cursos = array_unique(array_column($alumnos, 'nonbrecurso'));

// Inicializar un array para almacenar las notas por curso y bimestre
$notas_por_curso_bimestre = [];

// Agrupar las notas por curso y bimestre
foreach ($alumnos as $alumno) {
    $curso = $alumno['nonbrecurso'];
    $bimestre = $alumno['ordentio'];
    $nota = $alumno['notaacum'];

     // Verificar si el curso ya existe en el array, si no, inicializarlo
     if (!isset($notas_por_curso_bimestre[$curso])) {
         $notas_por_curso_bimestre[$curso] = [];
     }

     // Verificar si el bimestre ya existe en el array del curso, si no, inicializarlo
     if (!isset($notas_por_curso_bimestre[$curso][$bimestre])) {
         $notas_por_curso_bimestre[$curso][$bimestre] = [];
     }

     // Agregar la nota al array correspondiente al curso y bimestre
     $notas_por_curso_bimestre[$curso][$bimestre][] = $nota;
  }
  
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);

    // Inicializar Dompdf
    $dompdf = new Dompdf($options);
    date_default_timezone_set('America/Lima');
    $fecha_actual = date('Y-m-d');
    ob_start();

 ?>


<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,
            shrink-to-fit=no">
        <meta name="description" content="plantilla básica para Bootstrap">
        <meta name="author" content="Parzibyte">
        <title>Document | print</title>
        <!-- Cargar el CSS de Boostrap-->
        <link
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">
    </head>
    <body>
        <main role="main" class="container">
            <div class="row">
                <div class="col-12">
                     <?php if(!empty($alumnos)) {?>

                    <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Cursos</th>
                                    <?php foreach ($tiposevaluacion as $val): ?>
                                        <th><?= $val['ordenTipo_periodo'].'°'.$val['tipo_nombre']; ?></th>
                                    <?php endforeach; ?>
                                    <th>Ponderado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $numero = 1; ?>
                                <?php foreach ($cursos as $curso): ?>
                                    <tr>
                                        <td><?= $numero ?></td>
                                        <td><?= $curso ?></td>
                                        <?php
                                        // Inicializar un array para almacenar las notas acumuladas por bimestre
                                        $total_notas_curso = [];

                                        // Obtener las notas acumuladas para cada bimestre
                                        foreach ($tiposevaluacion as $val) {
                                            $bimestre = $val['ordenTipo_periodo'];
                                            $notas_bimestre = isset($notas_por_curso_bimestre[$curso][$bimestre]) ? $notas_por_curso_bimestre[$curso][$bimestre] : [];
                                            $promedio_bimestre = count($notas_bimestre) > 0 ? array_sum($notas_bimestre) / count($notas_bimestre) : 0;
                                            $total_notas_curso[] = $promedio_bimestre;
                                            echo "<td>" . round($promedio_bimestre, 2) . "</td>";
                                        }

                                        // Calcular el promedio ponderado para el curso
                                        $promedio_ponderado = count($total_notas_curso) > 0 ? array_sum($total_notas_curso) / count($total_notas_curso) : 0;
                                        ?>
                                        <td><?= round($promedio_ponderado, 2) ?></td>
                                    </tr>
                                    <?php $numero++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php }?>
                </div>
            </div>
        </main>
    </body>
</html>

<?php 

    // Capturar el contenido del búfer de salida
    $html = ob_get_clean();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->set_option('margin-top', 'auto');
    $dompdf->set_option('margin-bottom', 'auto');
    $dompdf->render();
    header('Content-Type: application/pdf');

       $dompdf ->stream("Boleta de pago".".pdf" ,array('Attachment' => false ));
    echo $dompdf->output();
    exit();
} catch (Exception $e) {
    echo 'Error al generar el PDF: ', $e->getMessage();
    exit();
}

 ?>