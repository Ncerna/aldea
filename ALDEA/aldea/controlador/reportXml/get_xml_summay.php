<?php

$year_id = intval($_POST['year_id']);
$id_degre = intval($_POST['id_degre']);
$section = $_POST['section'];
$name = $_POST['name'];

// Iniciar el buffer de salida
ob_start();

require '../../plantilla/excel/vendor/autoload.php';
require '../../modelo/modelo_grado.php';  // Aquí podría estar el problema
$grado = new Grado();  // Instancia de la clase Grado
// Limpiar el buffer de salida

ob_end_clean();

$components = [
    ["id" => 1, "name" => "FORMACIÓN GENERAL"],
    ["id" => 2, "name" => "FORMACIÓN CIENTÍFICA TECNOLÓGICA Y PRODUCTIVA"],
    ["id" => 3, "name" => "PRÁCTICA VOCACIONAL Y PROFESIONAL"],
];
 $months = [ '01' => 'Enero', '02' => 'Febrero',  '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo',
        '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre',
        '11' => 'Noviembre','12' => 'Diciembre',
    ];

$colegio= $grado->getSchoolInfo();
$courses= $grado->getCousesByIdGrado($id_degre, $year_id, $section );
$students = $grado->getStudentsWithCoursesAndGrades($id_degre, $year_id, $section );
$info = $grado->getCourseStatisticsFromStudents($students);
$docentes= $grado->getTeachersWithCoursesAndSignatures($id_degre, $year_id, $section );
$courseInfo = $grado->getCourseInfo($id_degre, $year_id, $section );
$countCoursByCompont = countCourses($components, $courses);


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

// Crear un nuevo objeto Spreadsheet
$spreadsheet = new Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();


function countCourses($components, $courses) {
    $cursosPorComponente = [];
    foreach ($courses as $course) {
        $componenteId = $course['id_compont'];
        if (!isset($cursosPorComponente[$componenteId])) {
            $cursosPorComponente[$componenteId] = 0;
        }
        $cursosPorComponente[$componenteId]++;
    }
    return $cursosPorComponente;
}
// Definir funciones globales para establecer valores y estilos
function setCellValue($worksheet, $cell, $value, $fonts = null) {
    $worksheet->setCellValue($cell, $value);
    if ($fonts) {
        // Obtener el estilo de la celda y luego aplicar el formato de fuente
        $worksheet->getStyle($cell)->getFont()->setBold(true);
    }else{
         $style = $worksheet->getStyle($cell)->getFont();
         $style->setSize(9);
    }
}

function mergeCells($worksheet, $range) {
    $worksheet->mergeCells($range);
}

function setColumnWidth($worksheet, $column, $width) {
    $worksheet->getColumnDimension($column)->setWidth($width);
}

function setRowHeight($worksheet, $row, $height) {
    $worksheet->getRowDimension($row)->setRowHeight($height);
}

function applyBorders($worksheet, $range) {
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];
    $worksheet->getStyle($range)->applyFromArray($styleArray);
}



// Establecer encabezados de las columnas

///encavezados
ob_start();

setCellValue($worksheet, 'E2', 'RESUMEN FINAL DEL RENDIMIENTO ESTUDIANTIL',true);
$worksheet->setCellValue('E3', 'Código del Formato: EMTP');
setCellValue($worksheet,'D4', 'I. Año Escolar:',true);
setCellValue($worksheet,'D5', 'Tipo de Evaluación: ',true);
setCellValue($worksheet,'F5', 'Mes y Año: ',true);

setCellValue($worksheet,'A6', 'II. Datos de la Institución Educativa:',true);
$worksheet->mergeCells('A7:B7');
$worksheet->setCellValue('A7', 'Código:');
$worksheet->mergeCells('A8:B8');
$worksheet->setCellValue('A8', 'Municipio:');
$worksheet->mergeCells('A9:B9');
$worksheet->setCellValue('A9', 'Directora:');
$worksheet->setCellValue('F7', 'Dirección: ');
$worksheet->setCellValue('F8', 'CDCEE: ');
$worksheet->setCellValue('D7', 'Denominación y Epónimo:');
$worksheet->setCellValue('J7', 'Teléfono:');
$worksheet->setCellValue('D8', 'Entidad Federal:');
//$worksheet->mergeCells('G9:H9');
$worksheet->setCellValue('G9', 'Cédula de Identidad: ');


$yearCurrent = date('Y');        // Año actual (Ej: 2024)
$yearNext = $yearCurrent + 1;    // Año siguiente (Ej: 2025)

// Asignar valores a las celdas
$worksheet->setCellValue('E4', $yearCurrent . '-' . $yearNext); // Año Escolar
$worksheet->setCellValue('E5', $colegio->type ?? '');           // Tipo de Evaluación
$worksheet->setCellValue('G5', date('F Y'));                    // Mes y Año actual
$worksheet->setCellValue('C7', $colegio->txt_code ?? '');       // Código
$worksheet->setCellValue('G7', $colegio->ubicacion ?? '');      // Dirección
$worksheet->setCellValue('G8', $colegio->txt_cdcee ?? '');

$worksheet->setCellValue('C8', $colegio->municipio ?? '');      // Municipio
$worksheet->setCellValue('C9', $colegio->directors ?? '');      // Directora

// Corregir el operador ternario y verificar si el valor es null
$worksheet->setCellValue('E7', ($colegio->denomination ?? '') ?: $colegio->nameColegio); // Denominación y Epónimo

$worksheet->setCellValue('E8', $colegio->federal ?? '');        // Entidad Federal
$worksheet->setCellValue('I9', $colegio->identity ?? '');       // Cédula de Identidad
$worksheet->setCellValue('K7', $colegio->telefColegio ?? '');


// Título y contenido principal

setCellValue($worksheet, 'A10', 'III. Identificación del Estudiante:',true);

mergeCells($worksheet, 'A10:J10');
mergeCells($worksheet, 'A11:J12');

setCellValue($worksheet, 'K10', 'IV. Resumen Final del Rendimiento:',true);
setCellValue($worksheet, 'K11', 'COMPONENTES',true);
mergeCells($worksheet, 'K11:R11');

// Encabezados de las columnas para los estudiantes
setCellValue($worksheet,'A13', 'N°',true);
setCellValue($worksheet,'B13', 'Cédula de Identidad',true);
setCellValue($worksheet,'C13', 'Apellidos',true);
setCellValue($worksheet,'D13', 'Nombres',true);
setCellValue($worksheet,'E13', 'Lugar de Nacimiento',true);
setCellValue($worksheet,'F13', 'EF',true);
setCellValue($worksheet,'G13', 'SEXO',true);
mergeCells($worksheet, 'H13:j13');
setCellValue($worksheet,'H13', 'FECHA DE NACIMIENTO',true);

setCellValue($worksheet, 'K12', 'ÁREAS DE FORMACIÓN',true);
ob_end_clean();
// Variables para controlar la columna inicial
$startColumn = 'K';
$componentColumn = $startColumn;
$columnOffset = 0;
ob_start();

// Asignar componentes dinámicamente
foreach ($components as $index => $component) {

    // Columna actual para el componente
    $componentStartColumn = chr(ord($startColumn) + $columnOffset);
    $componentEndColumn = chr(ord($componentStartColumn) + $countCoursByCompont[$component['id']] - 1);


    $componentColumn = chr(ord($startColumn) + $columnOffset);
    setCellValue($worksheet, $componentColumn . '13', $component['name'],true);

     // Fusionar las celdas para el componente
    mergeCells($worksheet, $componentStartColumn . '13:' . $componentEndColumn . '13');

    $componentCourses = array_filter($courses, function ($course) use ($component) {
        return $course['id_compont'] == $component['id'];
    });

    $idStartCell = $componentColumn . '14';
    $nameStartCell = $componentColumn . '15';

    $idColumnOffset = 0;
    foreach ($componentCourses as $course) {
        setCellValue($worksheet, chr(ord($componentColumn) + $idColumnOffset) . '14', $course['id'].'°');
        setCellValue($worksheet, chr(ord($componentColumn) + $idColumnOffset) . '15', $course['name']);
        $idColumnOffset++;
    }

    $columnOffset += max(count($componentCourses), 2);
}

mergeCells($worksheet, 'H13:J13');


// Configuración de dimensiones de columnas y filas
$columnWidths = [
    'A' => 5, 'B' => 10, 'C' => 20, 'D' => 20, 'E' => 12,
    'F' => 8, 'G' => 5, 'H' => 12, 'I' => 8, 'J' => 8,
    'K' => 8, 'L' => 8, 'M' => 8, 'N' => 8, 'P' => 8,
    'Q' => 8, 'R' => 8,
];

foreach ($columnWidths as $col => $width) {
    setColumnWidth($worksheet, $col, $width);
}



setCellValue($worksheet, 'H14', 'DIA');
setCellValue($worksheet, 'I14', 'MES');
setCellValue($worksheet, 'J14', 'AÑO');

// Aplicar bordes al rango
applyBorders($worksheet, 'A10:S21');

// Llenar los datos de los estudiantes
$rowStart = 16;
foreach ($students as $index => $student) {
    $worksheet->setCellValue('A' . $rowStart, $index + 1);
    $worksheet->setCellValue('B' . $rowStart, $student['cedula']);
    $worksheet->setCellValue('C' . $rowStart, $student['apellidos']);
    $worksheet->setCellValue('D' . $rowStart, $student['nombres']);
    $worksheet->setCellValue('E' . $rowStart, $student['lugarNac']);
    $worksheet->setCellValue('F' . $rowStart, $student['ef'] ?? '');
    $worksheet->setCellValue('G' . $rowStart, $student['sexo']);
     // Separar la fecha en año, mes y día
        $fechaParts = explode('-', $student['fechaNac']);
        $worksheet->setCellValue('H' . $rowStart, $fechaParts[2]); // Año
        $worksheet->setCellValue('I' . $rowStart, $months[$fechaParts[1]] ?? 'Mes no válido');
        $worksheet->setCellValue('J' . $rowStart, $fechaParts[0]); // Día

    // Llenar las notas del estudiante para cada curso
    $columnOffset = 0;
    foreach ($components as $component) {
        $componentCourses = array_filter($courses, function ($course) use ($component) {
            return $course['id_compont'] == $component['id'];
        });

        foreach ($componentCourses as $course) {
            $notaColumn = chr(ord($startColumn) + $columnOffset) . $rowStart;
            $nota = array_filter($student['notas'], function ($n) use ($course) {
                return $n['course_id'] == $course['id'];
            });

            $worksheet->setCellValue($notaColumn, $nota ? reset($nota)['nota'] : '');
            $columnOffset++;
        }
    }

    $rowStart++;
}

ob_end_clean();

// Mostrar los datos de "Inscritos" al pie de cada curso
$rowOffset = $rowStart ; // Fila inicial para los totales
//$worksheet->mergeCells('A17:H22');
// Configurar los títulos en la columna I
ob_start();

setCellValue($worksheet, 'I' . ($rowOffset + 1), 'Inscritos');
mergeCells($worksheet, 'I' . ($rowOffset + 1) . ':J' . ($rowOffset + 1)); // Fusionar celdas para "Inscritos"
setCellValue($worksheet, 'I' . ($rowOffset + 2), 'Inasistentes');
setCellValue($worksheet, 'I' . ($rowOffset + 3), 'Aprobados');
setCellValue($worksheet, 'I' . ($rowOffset + 4), 'No Aprobados');
setCellValue($worksheet, 'I' . ($rowOffset + 5), 'No Cursantes');


// Recorrer los datos de cada curso y asignar los totales correspondientes
foreach ($info as $courseData) {
    $courseId = $courseData['course_id'];
    $courseColumn = array_search($courseId, array_column($courses, 'id'));

    // Asegurarse de que se encontró el curso
    if ($courseColumn !== false) {
        $courseColumn = chr(ord($startColumn) + $courseColumn);

        // Asignar los valores correspondientes a cada curso
        setCellValue($worksheet, $courseColumn . ($rowOffset + 1), $courseData['Inscritos']);
        setCellValue($worksheet, $courseColumn . ($rowOffset + 2), $courseData['Inasistentes']);
        setCellValue($worksheet, $courseColumn . ($rowOffset + 3), $courseData['Aprobados']);
        setCellValue($worksheet, $courseColumn . ($rowOffset + 4), $courseData['No_Aprobados']);
        setCellValue($worksheet, $courseColumn . ($rowOffset + 5), $courseData['No_Cursantes']);
    }
}
$rowOffset =$rowOffset + 5;


ob_end_clean();

ob_start();

// Tabla de resumen de información
$componentColumn = chr(ord($startColumn) + $columnOffset);
// Aplicar bordes al rango
applyBorders($worksheet, 'A10:' . chr(ord($componentColumn) - 1) . $rowOffset);


///////////////////////////////////////////////////////////////////////////////////
                   //DOCENTE Y CURSOS
/////////////////////////////////////////////////////////////////////////

$startRow = $rowOffset + 2;
$worksheet->getColumnDimension('F')->setWidth(25); // Ancho ajustado para las celdas fusionadas


// Establecer encabezado
setCellValue($worksheet, "A{$startRow}", 'V. Profesores por Áreas:',true);
$worksheet->mergeCells("A{$startRow}:H{$startRow}"); // Fusionar encabezado

// Establecer encabezados principales
setCellValue($worksheet, "A" . ($startRow + 1), 'N°');
setCellValue($worksheet, "B" . ($startRow + 1), 'Áreas de Formación');
$worksheet->mergeCells("B" . ($startRow + 1) . ":C" . ($startRow + 1)); // Fusionar celdas para "Áreas de Formación"

// Subcolumnas de las áreas
setCellValue($worksheet, "B" . ($startRow + 2), 'Abrebiatura');
setCellValue($worksheet, "C" . ($startRow + 2), 'Cursos');

// Fusionar celdas para los encabezados que ocupan dos filas
$worksheet->mergeCells("D" . ($startRow + 1) . ":E" . ($startRow + 2)); // Apellidos y Nombres
$worksheet->mergeCells("F" . ($startRow + 1) . ":F" . ($startRow + 2)); // Cédula de Identidad
$worksheet->mergeCells("G" . ($startRow + 1) . ":H" . ($startRow + 2)); // Firma

// Establecer encabezados de los profesores
setCellValue($worksheet, "D" . ($startRow + 1), 'Apellidos y Nombres del Profesor');

setCellValue($worksheet, "F" . ($startRow + 1), 'Cédula de Identidad');
setCellValue($worksheet, "G" . ($startRow + 1), 'Firma');
$worksheet->mergeCells("G" . ($startRow + 1) . ":H" . ($startRow + 2)); // Firma ocupa G y H

// Habilitar ajuste de texto para los encabezados
$worksheet->getStyle("D" . ($startRow + 1) . ":H" . ($startRow + 2))->getAlignment()->setWrapText(true);

$conuntTem = $startRow + 3;
$counter = 0; // Inicializa el contador de filas

// Ciclo para insertar los datos de los docentes
foreach ($docentes as $docente) {
    $currentRow = $conuntTem + $counter;
    
    setCellValue($worksheet, 'A' . $currentRow, $docente['id']);
    setCellValue($worksheet, 'B' . $currentRow, $docente['abrebiatura']);
    setCellValue($worksheet, 'C' . $currentRow, $docente['curso']);
    
    // Fusionar las celdas para Apellidos y Nombres
    setCellValue($worksheet, 'D' . $currentRow, $docente['nombre'] . ' ' . $docente['apellidos']);
    $worksheet->mergeCells("D{$currentRow}:E{$currentRow}"); 
    
    // Colocar Cédula de Identidad y Firma
    setCellValue($worksheet, 'F' . $currentRow, $docente['cedula']);
    setCellValue($worksheet, 'G' . $currentRow, $docente['firma']);
    $worksheet->mergeCells("G{$currentRow}:H{$currentRow}"); // Firma ocupa G y H
    
    $counter++;
}

// Calcula la fila para las observaciones
$observacionesRow = $conuntTem + $counter + 1; // +1 para la fila de separación o espacio

// Aplicar estilo de borde a todas las celdas
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];
$worksheet->getStyle('A' . $startRow . ':H' . $observacionesRow)->applyFromArray($styleArray);

// Aplicar formato a la fila de observaciones
$worksheet->getStyle("D" . ($conuntTem + 1) . ":H" . ($conuntTem + 2))->getAlignment()->setWrapText(true);

// Configurar la fila de observaciones
$worksheet->setCellValue("A" . $observacionesRow, 'VII. Observaciones:');
$worksheet->mergeCells("A" . $observacionesRow . ":H" . $observacionesRow); // Combinar celdas del pie de página
$worksheet->getStyle("A" . $observacionesRow)->getFont()->setBold(true);

//////////////////////////////////////////////////////////////////////////////////
/////////////// DATOS DEL GRADO:///////////////////////////
/////////////////////////////////////////////////////////////
ob_end_clean();

$_startRow = $startRow;
$startColumn = 'J';
$endColumn = 'Q';


// Establecer el ancho de las columnas
$worksheet->getColumnDimension($startColumn)->setWidth(8);
$worksheet->getColumnDimension($endColumn)->setWidth(8);

// Fusionar celdas para los encabezados
$worksheet->mergeCells("{$startColumn}{$_startRow}:{$endColumn}{$_startRow}"); // Fila 3
$worksheet->mergeCells("{$startColumn}" . ($_startRow + 1) . ":{$endColumn}" . ($_startRow + 1)); // Fila 4
$worksheet->mergeCells("{$startColumn}" . ($_startRow + 2) . ":{$endColumn}" . ($_startRow + 2)); // Fila 5
$worksheet->mergeCells("{$startColumn}" . ($_startRow + 3) . ":{$endColumn}" . ($_startRow + 3)); // Fila 6
$worksheet->mergeCells("{$startColumn}" . ($_startRow + 4) . ":{$endColumn}" . ($_startRow + 4)); // Fila 7
$worksheet->mergeCells("{$startColumn}" . ($_startRow + 5) . ":{$endColumn}" . ($_startRow + 5)); // Fila 8
$worksheet->mergeCells("{$startColumn}" . ($_startRow + 6) . ":{$endColumn}" . ($_startRow + 6)); // Fila 9

$worksheet->mergeCells("{$startColumn}" . ($_startRow + 7) . ":M" . ($_startRow + 8)); // Filas 10 y 11 para sección 'CUARTO'
$worksheet->mergeCells("N" . ($_startRow + 7) . ":{$endColumn}" . ($_startRow + 8)); // Filas 10 y 11 para sección 'SECCIÓN'
// Agregar los datos





setCellValue($worksheet, "{$startColumn}{$_startRow}", 'VI. Identificación del Curso:',true);
setCellValue($worksheet, "{$startColumn}" . ($_startRow + 1), 'PLAN DE ESTUDIO:',true);
setCellValue($worksheet, "{$startColumn}" . ($_startRow + 2), 'ESPECIALIDAD:'.$courseInfo['specialization']);
setCellValue($worksheet, "{$startColumn}" . ($_startRow + 3), 'MENCIÓN:'.$courseInfo['major']);
setCellValue($worksheet, "{$startColumn}" . ($_startRow + 4), 'CÓDIGO:',true);
setCellValue($worksheet, "{$startColumn}" . ($_startRow + 5), $courseInfo['code']);
setCellValue($worksheet, "{$startColumn}" . ($_startRow + 6), 'AÑO CURSADO');

setCellValue($worksheet, "{$startColumn}" . ($_startRow + 7),'GRADO: '. $courseInfo['year']);
setCellValue($worksheet, "N" . ($_startRow + 7), 'SECCIÓN:'.$courseInfo['section']); // Ajustando el texto a la celda fusionada correctamente.
setCellValue($worksheet, "{$startColumn}" . ($_startRow + 9), 'Nº DE ESTUDIANTES POR SECCIÓN',true);
setCellValue($worksheet, "N" . ($_startRow + 9), 'Nº DE ESTUDIANTES EN ESTA PÁGINA',true); // Cambié para alinear con el merge anterior.
setCellValue($worksheet, "{$startColumn}" . ($_startRow + 10), $courseInfo['numStudentsPerSection']);
setCellValue($worksheet, "N" . ($_startRow + 10), $courseInfo['numStudentsOnPage']); // Alineado con la columna correcta.


// Determinar el rango de celdas para aplicar bordes
$highestRow = $worksheet->getHighestRow(); // Obtener la última fila con datos
$highestColumn = $worksheet->getHighestColumn(); // Obtener la última columna con datos

// Definir el estilo de alineación y bordes


// Aplicar el estilo a todas las celdas usadas en el rango específico
$worksheet->getStyle("J{$_startRow}:Q" . ($_startRow + 10))->applyFromArray($styleArray);




/////////////////////////////////////////////////////
////////// SELLO/////////////////////////////

$startRow = $observacionesRow + 2;

setCellValue($worksheet, 'A' . $startRow, 'VIII. Fecha de Remisión:',true);
$worksheet->mergeCells('A' . $startRow . ':C' . $startRow);

setCellValue($worksheet, 'E' . $startRow, 'IX. Fecha de Recepción:',true);
$worksheet->mergeCells('E' . $startRow . ':F' . $startRow);

// Subtítulos
setCellValue($worksheet, 'A' . ($startRow + 1), 'Director(a)');
$worksheet->mergeCells('A' . ($startRow + 1) . ':C' . ($startRow + 1));

setCellValue($worksheet, 'E' . ($startRow + 1), 'Funcionario(a) Receptor(a)');
$worksheet->mergeCells('E' . ($startRow + 1) . ':F' . ($startRow + 1));

// Etiquetas de campos
setCellValue($worksheet, 'A' . ($startRow + 2), 'Apellidos y Nombres');
$worksheet->mergeCells('A' . ($startRow + 2) . ':C' . ($startRow + 2));

setCellValue($worksheet, 'E' . ($startRow + 2), 'Apellidos y Nombres');
$worksheet->mergeCells('E' . ($startRow + 2) . ':F' . ($startRow + 2));

setCellValue($worksheet, 'A' . ($startRow + 4), 'Cédula de Identidad:');
$worksheet->mergeCells('A' . ($startRow + 4) . ':C' . ($startRow + 4));

setCellValue($worksheet, 'E' . ($startRow + 4), 'Cédula de Identidad:');
$worksheet->mergeCells('E' . ($startRow + 4) . ':F' . ($startRow + 4));

setCellValue($worksheet, 'A' . ($startRow + 6), 'Firma:');
$worksheet->mergeCells('A' . ($startRow + 6) . ':C' . ($startRow + 6));

setCellValue($worksheet, 'E' . ($startRow + 6), 'Firma:');
$worksheet->mergeCells('E' . ($startRow + 6) . ':F' . ($startRow + 6));

// Datos específicos debajo de cada etiqueta
setCellValue($worksheet, 'A' . ($startRow + 3), $colegio->directors ?? '');
$worksheet->mergeCells('A' . ($startRow + 3) . ':C' . ($startRow + 3));

setCellValue($worksheet, 'E' . ($startRow + 3), '');//funcionario
$worksheet->mergeCells('E' . ($startRow + 3) . ':F' . ($startRow + 3));

setCellValue($worksheet, 'A' . ($startRow + 5), $colegio->identity ?? '');
$worksheet->mergeCells('A' . ($startRow + 5) . ':C' . ($startRow + 5));

setCellValue($worksheet, 'E' . ($startRow + 5), '');//funcionario identiti
$worksheet->mergeCells('E' . ($startRow + 5) . ':F' . ($startRow + 5));

setCellValue($worksheet, 'A' . ($startRow + 7), '');
$worksheet->mergeCells('A' . ($startRow + 7) . ':C' . ($startRow + 7));

setCellValue($worksheet, 'E' . ($startRow + 7), '');
$worksheet->mergeCells('E' . ($startRow + 7) . ':F' . ($startRow + 7));

// Agregar sellos
setCellValue($worksheet, 'D' . ($startRow ), 'SELLO DE LA INSTITUCIÓN EDUCATIVA');
$worksheet->mergeCells('D' . ($startRow ) . ':D' . ($startRow + 7)); // Fusiona C y D para los sellos

setCellValue($worksheet, 'G' . ($startRow ), 'SELLO DEL CENTRO DE DESARROLLO DE LA CALIDAD EDUCATIVA ESTATAL');
$worksheet->mergeCells('G' . ($startRow ) . ':H' . ($startRow + 7)); // Fusiona G y H para los sellos

// Aplicar estilos
$worksheet->getStyle('A' . $startRow . ':H' . ($startRow + 7))->applyFromArray($styleArray);

// Insertar datos en las filas
// (Aquí deberías insertar datos dinámicos si los tienes)

// Guardar el archivo Excel en una ubicación temporal
$filename = 'RSF' . $name . '.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($filename);

// Configurar las cabeceras para descargar el archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Enviar el archivo al navegador
readfile($filename);

// Eliminar el archivo temporal después de enviarlo
unlink($filename);

exit;
?>
