<?php
$id_student = intval($_POST['id_studentd']);
// Iniciar el buffer de salida
ob_start();
require '../../plantilla/excel/vendor/autoload.php';
require '../../modelo/modelo_grado.php';  // Aquí podría estar el problema
$grado = new Grado();  // Instancia de la clase Grado
// Limpiar el buffer de salida
ob_end_clean();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
// Detectar la zona horaria predeterminada del servidor
date_default_timezone_set(date_default_timezone_get());
// Obtener la fecha actual
$dateCurrent = (new DateTime())->format('d-m-Y');
// Crear un nuevo documento de Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$studente = $grado->getStudentsWihtOrigins($id_student);
$origin= $grado->getProcedentsEstudentById($id_student);

function filterByYear($origin, $year) {
    // Filtrar el array por el año especificado
    $filtered = array_filter($origin, function($item) use ($year) {
        return $item['year'] == $year;
    });
    $firstMatch = reset($filtered);
    if ($firstMatch)  return strtoupper($firstMatch['denomination']);
    return "NOT INST"; // Retorna "NOT_FOUND" si no hay coincidencias
}

// DAtoS de los estudiantess
function unidades($numero) {
    return $numero >= 0 && $numero <= 20 
        ? [  0 => 'cero', 1 => 'uno', 2 => 'dos', 3 => 'tres',  4 => 'cuatro', 5 => 'cinco', 6 => 'seis', 
            7 => 'siete', 8 => 'ocho', 9 => 'nueve', 10 => 'diez', 11 => 'once', 12 => 'doce', 
            13 => 'trece', 14 => 'catorce', 15 => 'quince',  16 => 'dieciséis', 17 => 'diecisiete', 
            18 => 'dieciocho', 19 => 'diecinueve', 20 => 'veinte'
        ][$numero]
        : "Número fuera de rango";
}
$school= $grado->informationSchool();


// Título para las nuevas tablas
$sheet->getColumnDimension('K')->setWidth(1);  //

$sheet->mergeCells('H2:M2');
setCellValue($sheet,'H2', 'CERTIFICACIÓN DE CALIFICACIONES  EMTP',true); 
$sheet->mergeCells('E3:N3');
setCellValue($sheet,'E3', 'I. Plan de Estudio:  '.$studente->planeStudy,true);
$sheet->mergeCells('H4:M4');
setCellValue($sheet,'H4', ''.$studente->especiality,true);
$sheet->mergeCells('E5:N5');
setCellValue($sheet, 'E5', 'Fecha de Expedición:_____' . $dateCurrent . '____ Código: ____' . $studente->code, true);

setCellValue($sheet,'A6', 'II. Datos de la Institución Educativa o Centro de Desarrollo de la Calidad Educativa Estadal (CDCEE) que Emite la Certificación:',true);

/////////////////////
// Fila 7
$sheet->mergeCells('A7:D7');
setCellValue($sheet, 'A7', 'Código : '.$school->txt_code ?? '', true);

$sheet->mergeCells('E7:K7');
setCellValue($sheet, 'E7', 'Denominación y Epónimo: '.$school->denomination ?? '', true);

// Fila 8
$sheet->mergeCells('A8:D8');
setCellValue($sheet, 'A8', 'Dirección: '.$school->ubicacion ?? '', true);

$sheet->mergeCells('G8:I8');
setCellValue($sheet, 'G8', 'Teléfono: '.$school->telefColegio ?? '', true);

// Fila 9
$sheet->mergeCells('A9:D9');
setCellValue($sheet, 'A9', 'Municipio: '.$school->municipio ?? '', true);

$sheet->mergeCells('F9:H9');
setCellValue($sheet, 'F9', 'Entidad Federal: '.$school->federal ?? '', true);

$sheet->mergeCells('I9:K9');
setCellValue($sheet, 'I9', 'CDCEE: '.$school->emtp ?? '', true);

$sheet->getStyle("A10:U10")->getFont()->setBold(true);
setCellValue($sheet,'A10', 'III. Datos de Identificación del Estudiante:',true);


$sheet->mergeCells('A11:E11');
setCellValue($sheet, 'A11', 'Cédula de Identidad: '.$studente->cedula ?? '', true);

$sheet->mergeCells('F11:H11');
setCellValue($sheet, 'F11', 'Fecha  de Nacimiento : '.$studente->dateBriht ?? '', true);

$sheet->mergeCells('A12:E12');
setCellValue($sheet, 'A12', 'Apellidos:'.$studente->apellidos ?? '', true);

$sheet->mergeCells('G12:J12');
setCellValue($sheet, 'G12', 'Nombres :'.$studente->name ?? '', true);

$sheet->mergeCells('A13:E13');
setCellValue($sheet, 'A13', 'Lugar de Nacimiento: '.$studente->originBriht ?? '', true);

$sheet->mergeCells('F13:H13');
setCellValue($sheet, 'F13', 'País:'.$studente->country ?? '', true);

$sheet->mergeCells('I13:K13');
setCellValue($sheet, 'I13', 'Estado: '.$studente->province ?? '', true);

$sheet->mergeCells('L13:N13');
setCellValue($sheet, 'L13', 'Municipio: '.$studente->monicipliy ?? '', true);



$sheet->getStyle("A19:U19")->getFont()->setBold(true);
setCellValue($sheet,'A17', 'IV. Instituciones Educativas donde Cursó Estudios',true);

// Cabeceras para la primera tabla (de A a E)
$sheet->setCellValue('A19', 'N°');
$sheet->mergeCells('B19:E19');
$sheet->setCellValue('B19', 'Denominación y Epónimo de la Institución Educativa');
$sheet->mergeCells('F19:G19');
$sheet->setCellValue('F19', 'Localidad');
$sheet->mergeCells('H19:I19');
$sheet->setCellValue('H19', 'E.F');
$sheet->setCellValue('J19', 'Año');



// Cabeceras para la segunda tabla (de I a M)
$sheet->setCellValue('L19', 'N°');
$sheet->mergeCells('M19:P19');
$sheet->setCellValue('M19', 'Denominación y Epónimo de la Institución Educativa');
$sheet->mergeCells('Q19:R19');
$sheet->setCellValue('Q19', 'Localidad');
$sheet->mergeCells('S19:T19');
$sheet->setCellValue('S19', 'E.F');
$sheet->setCellValue('U19', 'Año');

$firstPart = array_slice($origin, 0, 3); // Primeros 3
$secondPart = array_slice($origin, 3); // Últimos 3

// Iterar sobre los datos
$row = 20; // La fila de inicio para los datos
foreach ($firstPart as $entry) {
    // Asignar los valores correspondientes a cada columna
    $sheet->setCellValue('A' . $row, $entry['id']); // ID
    $sheet->mergeCells('B' . $row . ':E' . $row); // Unir columnas para Denominación
    $sheet->setCellValue('B' . $row, $entry['denomination']); // Denominación
    $sheet->mergeCells('F' . $row . ':G' . $row); // Unir columnas para Localidad
    $sheet->setCellValue('F' . $row, $entry['locality']); // Localidad
    $sheet->mergeCells('H' . $row . ':I' . $row); // Unir columnas para E.F.
    $sheet->setCellValue('H' . $row, $entry['ef']); // Entidad Federal
    $sheet->setCellValue('J' . $row, $entry['year']); // Año

    $row++; // Mover a la siguiente fila
}

// Iterar sobre los datos para la segunda tabla
$row = 20; // Fila de inicio para los datos de la segunda tabla
foreach ($secondPart as $entry) {
    // Asignar los valores correspondientes a cada columna
    $sheet->setCellValue('L' . $row, $entry['id']); // ID
    $sheet->mergeCells('M' . $row . ':P' . $row); // Unir columnas para Denominación
    $sheet->setCellValue('M' . $row, $entry['denomination']); // Denominación
    $sheet->mergeCells('Q' . $row . ':R' . $row); // Unir columnas para Localidad
    $sheet->setCellValue('Q' . $row, $entry['locality']); // Localidad
    $sheet->mergeCells('S' . $row . ':T' . $row); // Unir columnas para E.F.
    $sheet->setCellValue('S' . $row, $entry['ef']); // Entidad Federal
    $sheet->setCellValue('U' . $row, $entry['year']); // Año

    $row++; // Mover a la siguiente fila
}

// Aplicar bordes a las celdas de ambas tablas
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

// Aplicar estilo a la primera tabla
$sheet->getStyle('A19:J'.$row-1)->applyFromArray($styleArray);
// Aplicar estilo a la segunda tabla
$sheet->getStyle('L19:U'.$row-1)->applyFromArray($styleArray);

/////////////////////////////////////////
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

$sheet->mergeCells('A'.$row.':G'.$row);
setCellValue($sheet, 'A'.$row, 'V. Plan de Estudio:',true);

$studentDegrees = $grado->getDegresCousedStudent($id_student);
$grades = $grado->getDegreesByStudent($id_student);


$halfway = ceil(count($grades) / 2);
$firstHalf = array_slice($grades, 0, $halfway);
//$secondHalf = $firstHalf;
$secondHalf = array_slice($grades, $halfway);

// Inicializar fila de inicio
// Título para la primera tabla
setCellValue($sheet,'F25', 'COMPONENTES ',true);
$sheet->getStyle('F25')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$row = 26;
// Iterar sobre cada grado
foreach ($firstHalf as $grade) {
    // Escribir el nombre del grado
    setCellValue($sheet,'A' . $row, $grade['name'],true);

    $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('A' . $row . ':J' . $row);
    $row++;
    // Iterar sobre cada componente
    foreach ($grade['components'] as $component) {
        // Escribir el nombre del componente
        $sheet->mergeCells('A' . $row . ':J' . $row);
        setCellValue($sheet, 'A'.$row, $component['name'],true);
        $sheet->getStyle('A' . $row . ':J' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $row++;
        
        // Crear cabeceras
        $sheet->mergeCells('A' . $row . ':C' . ($row + 1));
        $sheet->setCellValue('A' . $row, 'ÁREAS DE FORMACIÓN');
        $sheet->mergeCells('D' . $row . ':F' . $row);
        $sheet->setCellValue('D' . $row, 'CALIFICACIÓN');
        $sheet->setCellValue('D' . ($row + 1), 'N°');
        $sheet->setCellValue('E' . ($row + 1), 'LETRAS');
        $sheet->setCellValue('F' . ($row + 1), 'T-E');
        $sheet->mergeCells('G' . $row . ':J' . $row);
        $sheet->setCellValue('G' . $row, 'FECHA');
        $sheet->setCellValue('G' . ($row + 1), 'Mes');
        $sheet->setCellValue('H' . ($row + 1), 'Año');
        $sheet->setCellValue('I' . ($row + 1), 'INST. EDUC.');
        $sheet->getStyle('A' . $row . ':J' . ($row + 1))->applyFromArray($styleArray);
        $row += 2; // Avanzar dos filas más para empezar los cursos

        // Filtrar cursos que pertenecen al componente actual
        $filteredCourses = array_filter($grade['courses'], function($course) use ($component) {
            return $course['id_component'] == $component['id'];
        });

        // Iterar sobre cada curso y escribir en las filas correspondientes
        foreach ($filteredCourses as $item) {
            // Unir celdas para el área de formación
            $sheet->mergeCells('A' . $row . ':C' . $row);
            $sheet->setCellValue('A' . $row, $item['area']);
            // Llenar datos del curso
            $sheet->setCellValue('D' . $row, $item['number']);
            $sheet->setCellValue('E' . $row, unidades($item['te']));
            $sheet->setCellValue('F' . $row, $item['te']);
            $sheet->setCellValue('G' . $row, $item['month']);
            $sheet->setCellValue('H' . $row, $item['year']);
           // $sheet->setCellValue('I' . $row, $item['ins_edu']);
             $sheet->mergeCells('I' . $row . ':J' . $row);
             $sheet->setCellValue('I' . $row, filterByYear($origin, $item['year']));

              

            // Aplicar estilo a las filas de cursos
            $sheet->getStyle('A' . $row . ':J' . $row)->applyFromArray($styleArray);
            // Avanzar a la siguiente fila para el próximo curso
            $row++;
        }
        // Espacio entre componentes
       // $row += 1; // Espaciado de una fila antes de comenzar con el siguiente componente
    }
    // Espacio entre grados
    $row += 1; // Espaciado de una fila antes de comenzar con el siguiente grado
}
 


// Inicializar fila de inicio
setCellValue($sheet,'P25', 'COMPONENTES ',true);
$sheet->getStyle('P25')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$roeEnd = 26;
// Iterar sobre cada grado
foreach ($secondHalf as $grade) {
    // Escribir el nombre del grado en la columna 'L'
    setCellValue($sheet, 'L' . $roeEnd, $grade['name'], true);
    $sheet->getStyle('L' . $roeEnd)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('L' . $roeEnd . ':U' . $roeEnd);
    $roeEnd++;
    // Iterar sobre cada componente
    foreach ($grade['components'] as $component) {
        // Escribir el nombre del componente en la columna 'L'
        $sheet->mergeCells('L' . $roeEnd . ':U' . $roeEnd);
        setCellValue($sheet, 'L' . $roeEnd, $component['name'], true);
        $sheet->getStyle('L' . $roeEnd . ':U' . $roeEnd)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $roeEnd++;
        // Crear cabeceras desde la columna 'L'
        $sheet->mergeCells('L' . $roeEnd . ':N' . ($roeEnd + 1));
        $sheet->setCellValue('L' . $roeEnd, 'ÁREAS DE FORMACIÓN');
        $sheet->mergeCells('O' . $roeEnd . ':Q' . $roeEnd);
        $sheet->setCellValue('O' . $roeEnd, 'CALIFICACIÓN');
        $sheet->setCellValue('O' . ($roeEnd + 1), 'N°');
        $sheet->setCellValue('P' . ($roeEnd + 1), 'LETRAS');
        $sheet->setCellValue('Q' . ($roeEnd + 1), 'T-E');
        $sheet->mergeCells('R' . $roeEnd . ':U' . $roeEnd);
        $sheet->setCellValue('R' . $roeEnd, 'FECHA');
        $sheet->setCellValue('R' . ($roeEnd + 1), 'Mes');
        $sheet->setCellValue('S' . ($roeEnd + 1), 'Año');
        
        $sheet->setCellValue('T' . ($roeEnd + 1), 'INST. EDUC.');
        
        // $sheet->setCellValue('T' . $roeEnd, filterByYear($origin, $course['year']));

        $sheet->getStyle('L' . $roeEnd . ':U' . ($roeEnd + 1))->applyFromArray($styleArray);
        $roeEnd += 2; // Avanzar dos filas más para empezar los cursos
        // Filtrar cursos que pertenecen al componente actual
        $filteredCourses = array_filter($grade['courses'], function($course) use ($component) {
            return $course['id_component'] == $component['id'];
        });
        // Iterar sobre cada curso y escribir en las filas correspondientes
        foreach ($filteredCourses as $course) {
            // Unir celdas para el área de formación
            $sheet->mergeCells('L' . $roeEnd . ':N' . $roeEnd);
            $sheet->setCellValue('L' . $roeEnd, $course['area']);
            // Llenar datos del curso
            $sheet->setCellValue('O' . $roeEnd, $course['number']);
             $sheet->setCellValue('E' . $roeEnd, unidades($course['te']));
            $sheet->setCellValue('Q' . $roeEnd, $course['te']);
            $sheet->setCellValue('R' . $roeEnd, $course['month']);
            $sheet->setCellValue('S' . $roeEnd, $course['year']);
             $sheet->mergeCells('T' . $roeEnd . ':U' . $roeEnd);
           // $sheet->setCellValue('T' . $roeEnd, $course['ins_edu']);
             $sheet->setCellValue('T' . $roeEnd, filterByYear($origin, $course['year']));
            // Aplicar estilo a las filas de cursos
            $sheet->getStyle('L' . $roeEnd . ':U' . $roeEnd)->applyFromArray($styleArray);
            // Avanzar a la siguiente fila para el próximo curso
            $roeEnd++;
        }
        // Espacio entre componentes
        // $roeEnd += 1; // Espaciado de una fila antes de comenzar con el siguiente componente
    }
    // Espacio entre grados
    $roeEnd += 1; // Espaciado de una fila antes de comenzar con el siguiente grado
}

/////////////////////////////////////////////////////////

// Después de terminar con la iteración de grados y componentes
$startRow = $roeEnd+1; // Deja una fila de separación
// Título de la sección
setCellValue($sheet,'L' . $startRow, 'VII. Institución Educativa',true);
$sheet->mergeCells('L' . $startRow . ':P' . $startRow);
$sheet->getStyle('L' . $startRow . ':P' . $startRow)->getFont()->setBold(true);
// Director(a)
$sheet->setCellValue('L' . ($startRow + 1), 'Director(a)');
$sheet->mergeCells('L' . ($startRow + 1) . ':M' . ($startRow + 1));

$sheet->setCellValue('N' . ($startRow + 1), $school->directors ?? ''); // Este es el nombre del director(a)
$sheet->mergeCells('N' . ($startRow + 1) . ':P' . ($startRow + 1));
// Apellidos y Nombres
$sheet->setCellValue('L' . ($startRow + 2), 'Apellidos y Nombres:');
$sheet->mergeCells('L' . ($startRow + 2) . ':M' . ($startRow + 2));
$sheet->setCellValue('N' . ($startRow + 2), ''); // Nombre completo
$sheet->mergeCells('N' . ($startRow + 2) . ':P' . ($startRow + 2));
// Cédula de Identidad
$sheet->setCellValue('L' . ($startRow + 3), 'Cédula de Identidad:');
$sheet->mergeCells('L' . ($startRow + 3) . ':M' . ($startRow + 3));
$sheet->setCellValue('N' . ($startRow + 3), $school->identity ?? ''); // Cédula
$sheet->mergeCells('N' . ($startRow + 3) . ':P' . ($startRow + 3));
// Firma
$sheet->setCellValue('L' . ($startRow + 4), 'Firma:');
$sheet->mergeCells('L' . ($startRow + 4) . ':M' . ($startRow + 4));
$sheet->setCellValue('N' . ($startRow + 4), ''); // Espacio para la firma
$sheet->mergeCells('N' . ($startRow + 4) . ':P' . ($startRow + 4));
// Sello de la institución educativa
$sheet->setCellValue('Q' . $startRow, 'SELLO DE LA INSTITUCIÓN EDUCATIVA');
$sheet->mergeCells('Q' . $startRow . ':R' . ($startRow + 5));
// Para efectos de su validez nacional
$sheet->setCellValue('L' . ($startRow + 5), 'Para Efectos de su Validez Nacional');
$sheet->mergeCells('L' . ($startRow + 5) . ':P' . ($startRow + 5));
$sheet->getStyle('L' . ($startRow + 5) . ':P' . ($startRow + 5))->getFont()->setItalic(true);
// Aplicar estilos a las celdas si es necesario
$sheet->getStyle('L' . $startRow . ':R' . ($startRow + 5))->applyFromArray($styleArray);


$startRow= $startRow+8;
// Título de la nueva sección
setCellValue($sheet,'L' . $startRow, 'VIII. Centro de Desarrollo de la Calidad Educativa Estadal',  true);
$sheet->mergeCells('L' . $startRow . ':P' . $startRow);
$sheet->getStyle('L' . $startRow . ':P' . $startRow)->getFont()->setBold(true);
// Director(a)
$sheet->setCellValue('L' . ($startRow + 1), 'Director(a)');
$sheet->mergeCells('L' . ($startRow + 1) . ':M' . ($startRow + 1));
$sheet->setCellValue('N' . ($startRow + 1), $school->directors ?? ''); // Este es el nombre del director(a)
$sheet->mergeCells('N' . ($startRow + 1) . ':P' . ($startRow + 1));
// Apellidos y Nombres
$sheet->setCellValue('L' . ($startRow + 2), 'Apellidos y Nombres:');
$sheet->mergeCells('L' . ($startRow + 2) . ':M' . ($startRow + 2));
$sheet->setCellValue('N' . ($startRow + 2), ''); // Nombre completo
$sheet->mergeCells('N' . ($startRow + 2) . ':P' . ($startRow + 2));
// Cédula de Identidad
$sheet->setCellValue('L' . ($startRow + 3), 'Cédula de Identidad:');
$sheet->mergeCells('L' . ($startRow + 3) . ':M' . ($startRow + 3));
$sheet->setCellValue('N' . ($startRow + 3), $school->identity ?? ''); // Cédula
$sheet->mergeCells('N' . ($startRow + 3) . ':P' . ($startRow + 3));
// Firma
$sheet->setCellValue('L' . ($startRow + 4), 'Firma:');
$sheet->mergeCells('L' . ($startRow + 4) . ':M' . ($startRow + 4));
$sheet->setCellValue('N' . ($startRow + 4), ''); // Espacio para la firma
$sheet->mergeCells('N' . ($startRow + 4) . ':P' . ($startRow + 4));
// Sello de la institución educativa
$sheet->setCellValue('Q' . $startRow, 'SELLO DE LA INSTITUCIÓN EDUCATIVA');
$sheet->mergeCells('Q' . $startRow . ':R' . ($startRow + 5));
// Para efectos de su validez nacional
$sheet->setCellValue('L' . ($startRow + 5), 'Para Efectos de su Validez Nacional');
$sheet->mergeCells('L' . ($startRow + 5) . ':P' . ($startRow + 5));
$sheet->getStyle('L' . ($startRow + 5) . ':P' . ($startRow + 5))->getFont()->setItalic(true);
// Aplicar estilos a las celdas si es necesario
$sheet->getStyle('L' . $startRow . ':R' . ($startRow + 5))->applyFromArray($styleArray);



// Guardar el archivo Excel en una ubicación temporal
$filename = 'CERTIFICADO.CALI.xlsx';
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