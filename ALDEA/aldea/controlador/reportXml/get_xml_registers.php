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

ob_start();
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

// Crear un nuevo documento de Excel
$spreadsheet = new Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();

function setCellValue($worksheet, $cell, $value, $fonts = null) {
    $worksheet->setCellValue($cell, $value);
    if ($fonts) {
        // Obtener el estilo de la celda y luego aplicar el formato de fuente
        $worksheet->getStyle($cell)->getFont()->setBold(true);
    } else {
        $style = $worksheet->getStyle($cell)->getFont();
        $style->setSize(9);
    }
}

$estudiantes= $grado->getStudentsByDegrees($id_degre, $year_id, $section);
$degre = $grado->getGrades($id_degre, $section, $year_id);

/*$estudiantes = [
    [
        "cedula" => "12345678",
        "apellidos" => "González Pérez",
        "nombres" => "Juan Carlos",
        "lugarNacimiento" => "Caracas",
        "EF" => "Distrito Capital",
        "municipio" => "Libertador",
        "fechaNac" => "2005-06-15",
        "observacion" => "Estudiante destacado"
    ]

];*/
 $months = [ '01' => 'Enero', '02' => 'Febrero',  '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo',
        '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre',
        '11' => 'Noviembre','12' => 'Diciembre',
    ];

//$estudiantes= $grado->getStudentsByDegrees($id_degre, $year_id, $section);

ob_end_clean();

$colegio= $grado->getSchoolInfo();

$worksheet->mergeCells('E2:G2');
setCellValue($worksheet, 'E2', 'HOJA DE REGISTRO DE TÍTULO', true);

$worksheet->mergeCells('E3:G3');
setCellValue($worksheet, 'E3', 'Código del Formato: '.$colegio->emtp ?? '', true);

$worksheet->mergeCells('E4:G4');
setCellValue($worksheet, 'E4', 'I. Tipo de Registro: '.$colegio->title ?? '', true);

$worksheet->mergeCells('E5:G5'); // Corregido el rango
setCellValue($worksheet, 'E5', 'Mes y Año de Egreso: '.$colegio->egresyear ?? '', true);

$worksheet->mergeCells('E6:I6'); // Corregido el rango
setCellValue($worksheet, 'E6', 'Lugar y Fecha de Expedición: '.$colegio->expid ?? '', true);

$worksheet->mergeCells('A7:K7');
setCellValue($worksheet, 'A7', 'II. Datos de la Institución Educativa: ', true);
/////////////////////

$worksheet->mergeCells('A8:D8');
setCellValue($worksheet, 'A8', 'Código : '.$colegio->txt_code ?? '', true);

$worksheet->mergeCells('E8:K8');
setCellValue($worksheet, 'E8', 'Denominación y Epónimo:'.$colegio->denomination ?? '', true);

$worksheet->mergeCells('A9:D9');
setCellValue($worksheet, 'A9', 'Dirección: '.$colegio->ubicacion ?? '', true);

$worksheet->mergeCells('G9:I9');
setCellValue($worksheet, 'G9', 'Teléfono: '.$colegio->telefColegio ?? '', true);

$worksheet->mergeCells('A10:D10');
setCellValue($worksheet, 'A10', 'Municipio: '.$colegio->municipio ?? '', true);


$worksheet->mergeCells('F10:H10');
setCellValue($worksheet, 'F10', 'Entidad Federal: '.$colegio->federal ?? '', true);

$worksheet->mergeCells('I10:K10');
setCellValue($worksheet, 'I10', 'CDCEE: '.$colegio->emtp ?? '', true);

$worksheet->mergeCells('A11:K11');
setCellValue($worksheet, 'A11', 'III. Identificación de la Evaluación: ', true);

$worksheet->mergeCells('A12:B12');
setCellValue($worksheet, 'A12', 'Final: '.$colegio->finaly ?? '', true);

$worksheet->mergeCells('C12:E12');
setCellValue($worksheet, 'C12', 'Revisión: '.$colegio->reviw ?? '', true);

$worksheet->mergeCells('F12:I12');
setCellValue($worksheet, 'F12', 'Materia Pendiente: '.$colegio->coursePending ?? '', true);

$worksheet->mergeCells('J12:K12');
setCellValue($worksheet, 'J12', 'Otra: '.$colegio->oters ?? '', true);

$worksheet->mergeCells('A13:K13');
setCellValue($worksheet, 'A13', 'IV. Datos del Titulo que Registra: ', true);

$worksheet->mergeCells('A14:K14');
setCellValue($worksheet, 'A14', 'Nombre del Documento: '.$degre[0]['gradonombre']??'', true);
$worksheet->mergeCells('L14:M14');
setCellValue($worksheet, 'L14', 'Código: '.$degre[0]['degrecode']??'', true);

$worksheet->mergeCells('A15:K15');
setCellValue($worksheet, 'A15', 'V. Cantidad de Estudiantes a los cuales se le otorgó el Título ', true);


// Definir la variable de fila inicial
$fila = 16;

// Encabezados
$worksheet->mergeCells('A' . $fila . ':A' . ($fila + 1))
       ->setCellValue('A' . $fila, 'N°')
       ->mergeCells('B' . $fila . ':B' . ($fila + 1))
       ->setCellValue('B' . $fila, 'Serial del Título')
       ->mergeCells('C' . $fila . ':C' . ($fila + 1))
       ->setCellValue('C' . $fila, 'Cédula de Identidad')
       ->mergeCells('D' . $fila . ':F' . ($fila + 1)) // Fusionar columnas para Nombres y Apellidos
       ->setCellValue('D' . $fila, 'Nombres y Apellidos')

       ->mergeCells('G' . $fila . ':H' . $fila) // Fusionar columnas para Lugar de Nacimiento
       ->setCellValue('G' . $fila, 'Lugar de Nacimiento')

       ->mergeCells('I' . $fila . ':K' . $fila) // Fusionar columnas para Fecha de Nacimiento
       ->setCellValue('I' . $fila, 'Fecha de Nacimiento')

       ->mergeCells('L' . $fila . ':M' . ($fila + 1))
       ->setCellValue('L' . $fila, 'Observaciones');
// Sub-encabezados
$worksheet->setCellValue('G' . ($fila + 1), 'EF')
      ->setCellValue('H' . ($fila + 1), 'Municipio')
      ->setCellValue('I' . ($fila + 1), 'DIA')
      ->setCellValue('J' . ($fila + 1), 'MES')
      ->setCellValue('K' . ($fila + 1), 'AÑO');

// Insertar datos de los estudiantes
$startRow = $fila + 2; // Primera fila de datos
$cout=$startRow;
foreach ($estudiantes as $index => $estudiante) {
   $currentRow = $startRow + $index;
     $fechaParts = explode('-', $estudiante['fechaNac']);
     
    $worksheet->setCellValue('A' . $currentRow, $index + 1) // Número
              ->setCellValue('B' . $currentRow, '') // Serial del Título (vacío en este caso)
              ->setCellValue('C' . $currentRow, $estudiante['cedula'])
              ->mergeCells('D' . $currentRow . ':F' . ($currentRow))
              ->setCellValue('D' . $currentRow, $estudiante['nombres'] . ' ' . $estudiante['apellidos'])

              ->setCellValue('G' . $currentRow, $estudiante['EF'])
              ->setCellValue('H' . $currentRow, $estudiante['municipio'])
             
                ->setCellValue('I' . $currentRow, $fechaParts[2]) // Día
              ->setCellValue('J' . $currentRow, $months[$fechaParts[1]] ?? 'Mes no válido')
              ->setCellValue('K' . $currentRow, $fechaParts[0]) // Año

               ->mergeCells('L' . $currentRow . ':M' . $currentRow) //
              ->setCellValue('L' . $currentRow, $estudiante['observacion']);
              $cout++;
}

$worksheet->mergeCells('A'.$startRow + count($estudiantes).':M'.$startRow + count($estudiantes) );
// Configuración adicional después de los datos de estudiantes
$firstEmptyRow = $startRow + count($estudiantes) + 1;

$worksheet->mergeCells('A' . $firstEmptyRow . ':E' . $firstEmptyRow)
    ->setCellValue('A' . $firstEmptyRow, 'TOTAL DE TÍTULOS EMITIDOS:')
    ->setCellValue('F' . $firstEmptyRow, 'AÑO:')
    ->setCellValue('G' . $firstEmptyRow, $name.'°' ?? '°')
    ->setCellValue('J' . $firstEmptyRow, 'SECCIÓN:')
    ->mergeCells('K' . $firstEmptyRow . ':M' . $firstEmptyRow)
    ->setCellValue('K' . $firstEmptyRow, $section ?? '');



$worksheet->mergeCells('A' . ($firstEmptyRow + 1) . ':K' . ($firstEmptyRow + 1))
    ->setCellValue('A' . ($firstEmptyRow + 1), 'VI. Autoridades Educativas:')
    ->mergeCells('A' . ($firstEmptyRow + 2) . ':M' . ($firstEmptyRow + 2))
    ->setCellValue('A' . ($firstEmptyRow + 2), 'DIRECTOR(A) DE LA INSTITUCIÓN EDUCATIVA:')
    ->mergeCells('A' . ($firstEmptyRow + 3) . ':G' . ($firstEmptyRow + 3))
    ->setCellValue('A' . ($firstEmptyRow + 3), 'Apellidos y Nombres:'.$colegio->directors ?? '')
    ->setCellValue('H' . ($firstEmptyRow + 3), 'C.I.:' .$colegio->identity ?? '')
     ->mergeCells('J' . ($firstEmptyRow + 3) . ':M' . ($firstEmptyRow + 3))
    ->setCellValue('J' . ($firstEmptyRow + 3), 'Firma:')
    ->mergeCells('A' . ($firstEmptyRow + 4) . ':M' . ($firstEmptyRow + 4))
    ->setCellValue('A' . ($firstEmptyRow + 4), 'COORDINADOR(A) DE CONTROL DE ESTUDIOS:')
    ->mergeCells('A' . ($firstEmptyRow + 5) . ':G' . ($firstEmptyRow + 5))
    ->setCellValue('A' . ($firstEmptyRow + 5), 'Apellidos y Nombres:')
    ->setCellValue('H' . ($firstEmptyRow + 5), 'C.I.:')
    ->mergeCells('J' . ($firstEmptyRow + 5) . ':M' . ($firstEmptyRow + 5))
    ->setCellValue('J' . ($firstEmptyRow + 5), 'Firma:')
    ->mergeCells('A' . ($firstEmptyRow + 6) . ':M' . ($firstEmptyRow + 6))
    ->setCellValue('A' . ($firstEmptyRow + 6), 'FUNCIONARIO DESIGNADO POR EL MINISTERIO DEL PODER POPULAR PARA LA EDUCACIÓN:')
    ->mergeCells('A' . ($firstEmptyRow + 7) . ':G' . ($firstEmptyRow + 7))
    ->setCellValue('A' . ($firstEmptyRow + 7), 'Apellidos y Nombres:')
    ->setCellValue('H' . ($firstEmptyRow + 7), 'C.I.:')
     ->mergeCells('J' . ($firstEmptyRow + 7) . ':M' . ($firstEmptyRow + 7))
    ->setCellValue('J' . ($firstEmptyRow + 7), 'Firma:')
    ->mergeCells('A' . ($firstEmptyRow + 8) . ':M' . ($firstEmptyRow + 8))
    ->setCellValue('A' . ($firstEmptyRow + 8), 'VII. Observaciones:');

// Guardar el archivo
// Aplicar estilos a las celdas de la tabla
$borderStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'], // Color negro
        ],
    ],
];


$encabezadoRange = 'A' . $fila . ':M' . ($firstEmptyRow + 9);
$worksheet->getStyle($encabezadoRange)->applyFromArray($borderStyle);
// Aplicar estilo a la configuración adicional
$worksheet->getStyle('A' . $firstEmptyRow . ':M' . ($firstEmptyRow + 8))->applyFromArray($borderStyle);



// Variables iniciales
// Definición de variables
$observacionesRow = $firstEmptyRow+8; // Ajusta según la fila base que necesites
$startRow = $observacionesRow + 2;



// Configuración de celdas
setCellValue($worksheet, 'A' . $startRow, 'VIII. Fecha de Remisión:', true);
$worksheet->mergeCells('A' . $startRow . ':C' . $startRow);

setCellValue($worksheet, 'E' . $startRow, 'IX. Fecha de Recepción:', true);
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
setCellValue($worksheet, 'A' . ($startRow + 3),  $colegio->directors ?? '');
$worksheet->mergeCells('A' . ($startRow + 3) . ':C' . ($startRow + 3));

setCellValue($worksheet, 'E' . ($startRow + 3), ''); //funcionario
$worksheet->mergeCells('E' . ($startRow + 3) . ':F' . ($startRow + 3));

setCellValue($worksheet, 'A' . ($startRow + 5),  $colegio->identity ?? '');
$worksheet->mergeCells('A' . ($startRow + 5) . ':C' . ($startRow + 5));

setCellValue($worksheet, 'E' . ($startRow + 5), ''); //funcionario identidad
$worksheet->mergeCells('E' . ($startRow + 5) . ':F' . ($startRow + 5));

setCellValue($worksheet, 'A' . ($startRow + 7), '');
$worksheet->mergeCells('A' . ($startRow + 7) . ':C' . ($startRow + 7));

setCellValue($worksheet, 'E' . ($startRow + 7), '');
$worksheet->mergeCells('E' . ($startRow + 7) . ':F' . ($startRow + 7));

// Agregar sellos
setCellValue($worksheet, 'D' . ($startRow), 'SELLO DE LA INSTITUCIÓN EDUCATIVA');
$worksheet->mergeCells('D' . ($startRow) . ':D' . ($startRow + 7)); // Fusiona D para los sellos

setCellValue($worksheet, 'G' . ($startRow), 'SELLO DEL CENTRO DE DESARROLLO DE LA CALIDAD EDUCATIVA ESTATAL');
$worksheet->mergeCells('G' . ($startRow) . ':H' . ($startRow + 7)); // Fusiona G y H para los sellos

$worksheet->getStyle('A' . $observacionesRow . ':H' . ($observacionesRow + 9))->applyFromArray($borderStyle);




// Guardar el archivo Excel en una ubicación temporal
$filename = 'REGTIT' . $name . '.xlsx';
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