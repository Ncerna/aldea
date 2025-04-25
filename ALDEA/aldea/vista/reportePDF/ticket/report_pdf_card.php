<?php 
require '../../../plantilla/dompdf_php8/vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

try {
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);
    ob_start();

    $idstudent = htmlspecialchars($_GET["idalumno"], ENT_QUOTES, 'UTF-8');
    $id_year = htmlspecialchars($_GET["id_year"], ENT_QUOTES, 'UTF-8');
    $idgrado = htmlspecialchars($_GET["idgrado"], ENT_QUOTES, 'UTF-8');

    include_once '../../../modelo/modelo_notas.php';
    $MU  = new  Nota();

    $tiposevaluacion = $MU->Listar_Notas_Periodo($id_year);
    $alumnos = $MU->getReportcardByIdStudents($idgrado, $id_year, $idstudent);
    $resultado = $MU->showSchoolInformation();
    $schools = $resultado['data'];
    $school = $schools[0];
    $alumno = $alumnos[0];

    // Obtener la lista de cursos únicos
    $cursos = array_unique(array_column($alumnos, 'nonbrecurso'));

    // Inicializar un array para almacenar las notas por curso y bimestre
    $notas_por_curso_bimestre = [];

    // Agrupar las notas por curso y bimestre
    foreach ($alumnos as $alumno) {
        $curso = $alumno['nonbrecurso'];
        $bimestre = $alumno['ordentio'];
        $nota = $alumno['notaacum'];
        $susty = $alumno['susty'];

        // Verificar si el curso ya existe en el array, si no, inicializarlo
        if (!isset($notas_por_curso_bimestre[$curso])) {
            $notas_por_curso_bimestre[$curso] = [];
        }

        // Verificar si el bimestre ya existe en el array del curso, si no, inicializarlo
        if (!isset($notas_por_curso_bimestre[$curso][$bimestre])) {
            $notas_por_curso_bimestre[$curso][$bimestre] = [];
        }

        // Comparar la nota con susty y asignar la mayor como la nota a utilizar
        $nota_final = max($nota, $susty);

        // Agregar la nota al array correspondiente al curso y bimestre
        $notas_por_curso_bimestre[$curso][$bimestre][] = $nota_final;
    }

    $escudoImagen = "../../../imagenes/" . $school['escudoPais'];
    $escudoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($escudoImagen));
    $logoImagen = "../../../imagenes/" . $school['logoColegio'];
    $logoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($logoImagen));
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Plantilla básica para Bootstrap">
    <meta name="author" content="Parzibyte">
    <title>Document | print</title>
    <style type="text/css">
      .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
        border: 1px solid #0a0a0a !important;
        font-size:10px;
        padding: .10rem;
        text-align: center;


      }

      .container-fluid {
        position: relative;
        width: 700px;
        height: 200px;
        margin-top: -80px;
      }

      [class^="box-3"] {
        width: 150px;
        height: 60px;
        font-weight: bold;
        text-align: center;
      }

      [class^="box-4"] {
        width: 150px;
        height: 60px;
        font-weight: bold;
        text-align: center;
      }
      [class^="box-5"] {
        width: 400px;
        height: 50px;
        font-weight: bold;

        text-align: center;
      }


      .box-3 {
        position: absolute;
        bottom: 0;
        left: 0;
      }

      .box-4 {
        position: absolute;
        bottom: 0;
        right: 0;
      }

      .box-5 {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
      }
      .container {
            max-width: 800px; /* Ancho máximo del contenedor */
            margin: 20px auto; /* Margen exterior */
            text-align: center; /* Centrar contenido */
        }
        .table-container {
    display: inline-block; /* La tabla no ocupa todo el ancho */
}

table {
    border-collapse: collapse; /* Fusionar bordes de celdas */
    width: auto; /* Ancho automático según contenido */
    margin: 0 auto; /* Centrar tabla */
}

th, td {
    border: 1px solid #dddddd; /* Borde de celdas */
    padding: 8px; /* Espaciado interno */
    text-align: left; /* Alineación del texto */
}

th {
    background-color: #f2f2f2; /* Color de fondo del encabezado */
}

    </style>
</head>
<body>
<main role="main" class="container">
    <div class="container-fluid">

     <div class="box-3">
       <img src="<?php echo $escudoBase64 ?>" width="100">
     </div>
     <div class="box-4">
       <img src="<?php echo $logoBase64 ?>" width="100">
     </div>
     <div class="box-5">
      <h5>LIBRETA DE NOTAS -<?php echo date('Y')?></h5>
      
          <table border="1" class="table table-bordered">
            
                <tr>
                  <td>UGEL</th>
                    <td colspan="4"><?php echo $school['ugel']?? '' ?></td>
                  </tr>
                  <tr>
                    <td colspan="4">I.E</td>
                    <td ><?php echo $school['nameColegio']?? '' ?></td>
                  </tr>
                  <tr>
                    <td rowspan="2">NIVEL</td>
                    <td rowspan="2"><?php echo $alumno['nombreNivell'] ?></td>
                    <td style="background-color:#86888D;">GRADO</td>
                    <td colspan="2"><?php echo $alumno['gradonombre'] ?></td>
                  </tr>
                  <tr>
                    <td colspan="2">SECCION</td>
                    <td colspan="1"><?php echo $alumno['seccion'] ?></td>
                  </tr>
                  <tr>
                    <td colspan="4">CODIGO ESTUDIANTE</td>
                    <td ><?php echo $alumno['codigo'] ?></td>
                  </tr>
                  <tr>
                    <td colspan="4">APELLIDOS Y NOMBRES</td>
                    <td ><?php echo $alumno['apellidos'].','.$alumno['alumnonombre'] ?></td>
                  </tr>
            </table>

      </div>

    </div>

    <div class="row" class="container" style="margin-top: 50px;">
        <div class="col-12" style="text-align: center;justify-content: center;">
            <?php if (!empty($alumnos)) { ?>
                <div class="table-responsive" >
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
                                        <td><?= round($promedio_ponderado) ?></td>
                                    </tr>
                                    <?php $numero++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
</body>
</html>

<?php
    // Capturar el contenido del búfer de salida
    $html = ob_get_clean();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait'); // Configurar orientación vertical
    $dompdf->set_option('margin-top', 'auto');
    $dompdf->set_option('margin-bottom', 'auto');
    $dompdf->render();
    header('Content-Type: application/pdf');
    $dompdf->stream("Boleta de pago".".pdf", array('Attachment' => false));
    echo $dompdf->output();
    exit();
} catch (Exception $e) {
    echo 'Error al generar el PDF: ', $e->getMessage();
    exit();
}
?>
