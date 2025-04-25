<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;

// Crear una nueva hoja de cálculo
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


// Título para las nuevas tablas
// Título para las nuevas tablas
$sheet->setCellValue('A17', 'IV. Instituciones Educativas donde Cursó Estudios');

// Primera tabla (dejando dos filas de espacio)
$sheet->setCellValue('A19', 'Denominación y Epónimo de la Institución Educativa'); // Cabecera de la columna Denominación y Epónimo de la Institución Educativa
$sheet->setCellValue('B19', 'Localidad'); // Cabecera de la columna Localidad
$sheet->setCellValue('C19', 'E.F'); // Cabecera de la columna E.F
$sheet->setCellValue('D19', 'Año'); // Cabecera de la columna Año

// Llenar datos en la primera tabla
$sheet->setCellValue('A20', 'Colegio Nacional ABC');
$sheet->setCellValue('B20', 'Ciudad X');
$sheet->setCellValue('C20', '15');
$sheet->setCellValue('D20', '2018');

$sheet->setCellValue('A21', 'Instituto Educativo DEF');
$sheet->setCellValue('B21', 'Ciudad Y');
$sheet->setCellValue('C21', '14');
$sheet->setCellValue('D21', '2019');

$sheet->setCellValue('A22', 'Escuela Primaria GHI');
$sheet->setCellValue('B22', 'Ciudad Z');
$sheet->setCellValue('C22', '13');
$sheet->setCellValue('D22', '2020');

// Segunda tabla (comenzando desde la columna I)
$sheet->setCellValue('I19', 'Denominación y Epónimo de la Institución Educativa'); // Cabecera de la columna Denominación y Epónimo de la Institución Educativa
$sheet->setCellValue('J19', 'Localidad'); // Cabecera de la columna Localidad
$sheet->setCellValue('K19', 'E.F'); // Cabecera de la columna E.F
$sheet->setCellValue('L19', 'Año'); // Cabecera de la columna Año

// Llenar datos en la segunda tabla
$sheet->setCellValue('I20', 'Colegio Nacional JKL');
$sheet->setCellValue('J20', 'Ciudad A');
$sheet->setCellValue('K20', '18');
$sheet->setCellValue('L20', '2021');

$sheet->setCellValue('I21', 'Instituto Educativo MNO');
$sheet->setCellValue('J21', 'Ciudad B');
$sheet->setCellValue('K21', '17');
$sheet->setCellValue('L21', '2022');

$sheet->setCellValue('I22', 'Escuela Primaria PQR');
$sheet->setCellValue('J22', 'Ciudad C');
$sheet->setCellValue('K22', '16');
$sheet->setCellValue('L22', '2023');








$sheet->setCellValue('B24', 'COMPONENTES' . PHP_EOL . 'FORMACIÓN GENERAL');
$sheet->mergeCells('A24:G24');
// Título para la primera tabla
$sheet->setCellValue('A25', 'PRIMER AÑO');

// Encabezados de la primera tabla
$sheet->setCellValue('A26', 'ÁREAS DE FORMACIÓN');
$sheet->setCellValue('B26', 'CALIFICACIÓN');
$sheet->mergeCells('B26:D26'); // Unir celdas para "CALIFICACIÓN"
$sheet->setCellValue('B27', 'N°');
$sheet->setCellValue('C27', 'LETRAS');
$sheet->setCellValue('D27', 'T-E');
$sheet->setCellValue('E26', 'FECHA');
$sheet->mergeCells('E26:G26'); // Unir celdas para "FECHA"
$sheet->setCellValue('E27', 'Mes');
$sheet->setCellValue('F27', 'Año');
$sheet->setCellValue('G27', 'INST. EDUC.');

// Filas de la primera tabla
$sheet->setCellValue('A28', 'Lengua y Literatura');
$sheet->setCellValue('A29', 'Matemática');
$sheet->setCellValue('A30', 'Idiomas');
$sheet->setCellValue('A31', 'Educación Física');
$sheet->setCellValue('A32', 'Biología, Ambiente y Tecnología');
$sheet->setCellValue('A33', 'Geografía, Historia y Soberanía Nacional');

// Llenar datos en la primera tabla
$sheet->setCellValue('B28', '1');
$sheet->setCellValue('C28', 'A');
$sheet->setCellValue('D28', '15');
$sheet->setCellValue('E28', 'Junio');
$sheet->setCellValue('F28', '2024');
$sheet->setCellValue('G28', 'INST. ABC');

$sheet->setCellValue('B29', '2');
$sheet->setCellValue('C29', 'B');
$sheet->setCellValue('D29', '18');
$sheet->setCellValue('E29', 'Julio');
$sheet->setCellValue('F29', '2024');
$sheet->setCellValue('G29', 'INST. DEF');

$sheet->setCellValue('B30', '3');
$sheet->setCellValue('C30', 'C');
$sheet->setCellValue('D30', '12');
$sheet->setCellValue('E30', 'Agosto');
$sheet->setCellValue('F30', '2024');
$sheet->setCellValue('G30', 'INST. GHI');

$sheet->setCellValue('B31', '4');
$sheet->setCellValue('C31', 'D');
$sheet->setCellValue('D31', '20');
$sheet->setCellValue('E31', 'Septiembre');
$sheet->setCellValue('F31', '2024');
$sheet->setCellValue('G31', 'INST. JKL');

$sheet->setCellValue('B32', '5');
$sheet->setCellValue('C32', 'E');
$sheet->setCellValue('D32', '10');
$sheet->setCellValue('E32', 'Octubre');
$sheet->setCellValue('F32', '2024');
$sheet->setCellValue('G32', 'INST. MNO');

$sheet->setCellValue('B33', '6');
$sheet->setCellValue('C33', 'F');
$sheet->setCellValue('D33', '5');
$sheet->setCellValue('E33', 'Noviembre');
$sheet->setCellValue('F33', '2024');
$sheet->setCellValue('G33', 'INST. PQR');

$sheet->setCellValue('A34', 'FORMACIÓN CIENTÍFICA TECNOLÓGICA Y PRODUCTIVA'); // Cambia la fila según sea necesario
$sheet->mergeCells('A34:G34');



/////////////////////////////////////
// Título para la segunda tabla
$sheet->setCellValue('A36', 'SEGUNDO AÑO');

// Encabezados de la segunda tabla
$sheet->setCellValue('A37', 'ÁREAS DE FORMACIÓN');
$sheet->setCellValue('B37', 'CALIFICACIÓN');
$sheet->mergeCells('B37:D37'); // Unir celdas para "CALIFICACIÓN"
$sheet->setCellValue('B38', 'N°');
$sheet->setCellValue('C38', 'LETRAS');
$sheet->setCellValue('D38', 'T-E');
$sheet->setCellValue('E37', 'FECHA');
$sheet->mergeCells('E37:G37'); // Unir celdas para "FECHA"
$sheet->setCellValue('E38', 'Mes');
$sheet->setCellValue('F38', 'Año');
$sheet->setCellValue('G38', 'INST. EDUC.');

// Filas de la segunda tabla
$sheet->setCellValue('A39', 'Lengua y Literatura');
$sheet->setCellValue('A40', 'Matemática');
$sheet->setCellValue('A41', 'Idiomas');
$sheet->setCellValue('A42', 'Educación Física');
$sheet->setCellValue('A43', 'Biología, Ambiente y Tecnología');
$sheet->setCellValue('A44', 'Geografía, Historia y Soberanía Nacional');

// Llenar datos en la segunda tabla
$sheet->setCellValue('B39', '1');
$sheet->setCellValue('C39', 'A');
$sheet->setCellValue('D39', '16');
$sheet->setCellValue('E39', 'Enero');
$sheet->setCellValue('F39', '2025');
$sheet->setCellValue('G39', 'INST. ABC');

$sheet->setCellValue('B40', '2');
$sheet->setCellValue('C40', 'B');
$sheet->setCellValue('D40', '17');
$sheet->setCellValue('E40', 'Febrero');
$sheet->setCellValue('F40', '2025');
$sheet->setCellValue('G40', 'INST. DEF');

$sheet->setCellValue('B41', '3');
$sheet->setCellValue('C41', 'C');
$sheet->setCellValue('D41', '14');
$sheet->setCellValue('E41', 'Marzo');
$sheet->setCellValue('F41', '2025');
$sheet->setCellValue('G41', 'INST. GHI');

$sheet->setCellValue('B42', '4');
$sheet->setCellValue('C42', 'D');
$sheet->setCellValue('D42', '19');
$sheet->setCellValue('E42', 'Abril');
$sheet->setCellValue('F42', '2025');
$sheet->setCellValue('G42', 'INST. JKL');

$sheet->setCellValue('B43', '5');
$sheet->setCellValue('C43', 'E');
$sheet->setCellValue('D43', '11');
$sheet->setCellValue('E43', 'Mayo');
$sheet->setCellValue('F43', '2025');
$sheet->setCellValue('G43', 'INST. MNO');

$sheet->setCellValue('B44', '6');
$sheet->setCellValue('C44', 'F');
$sheet->setCellValue('D44', '6');
$sheet->setCellValue('E44', 'Junio');
$sheet->setCellValue('F44', '2025');
$sheet->setCellValue('G44', 'INST. PQR');

// Título para la formación científica tecnológica y productiva del segundo año
$sheet->setCellValue('A46', 'FORMACIÓN CIENTÍFICA TECNOLÓGICA Y PRODUCTIVA');
$sheet->mergeCells('A46:G46');

// Dejar una fila de separación
$sheet->setCellValue('A47', 'TERCER AÑO');

// Encabezados de la tercera tabla
$sheet->setCellValue('A48', 'ÁREAS DE FORMACIÓN');
$sheet->setCellValue('B48', 'CALIFICACIÓN');
$sheet->mergeCells('B48:D48'); // Unir celdas para "CALIFICACIÓN"
$sheet->setCellValue('B49', 'N°');
$sheet->setCellValue('C49', 'LETRAS');
$sheet->setCellValue('D49', 'T-E');
$sheet->setCellValue('E48', 'FECHA');
$sheet->mergeCells('E48:G48'); // Unir celdas para "FECHA"
$sheet->setCellValue('E49', 'Mes');
$sheet->setCellValue('F49', 'Año');
$sheet->setCellValue('G49', 'INST. EDUC.');

// Filas de la tercera tabla
$sheet->setCellValue('A50', 'Lengua y Literatura');
$sheet->setCellValue('A51', 'Matemática');
$sheet->setCellValue('A52', 'Idiomas');
$sheet->setCellValue('A53', 'Educación Física');
$sheet->setCellValue('A54', 'Biología, Ambiente y Tecnología');
$sheet->setCellValue('A55', 'Geografía, Historia y Soberanía Nacional');

// Llenar datos en la tercera tabla
$sheet->setCellValue('B50', '1');
$sheet->setCellValue('C50', 'A');
$sheet->setCellValue('D50', '17');
$sheet->setCellValue('E50', 'Enero');
$sheet->setCellValue('F50', '2026');
$sheet->setCellValue('G50', 'INST. ABC');

$sheet->setCellValue('B51', '2');
$sheet->setCellValue('C51', 'B');
$sheet->setCellValue('D51', '18');
$sheet->setCellValue('E51', 'Febrero');
$sheet->setCellValue('F51', '2026');
$sheet->setCellValue('G51', 'INST. DEF');

$sheet->setCellValue('B52', '3');
$sheet->setCellValue('C52', 'C');
$sheet->setCellValue('D52', '15');
$sheet->setCellValue('E52', 'Marzo');
$sheet->setCellValue('F52', '2026');
$sheet->setCellValue('G52', 'INST. GHI');

$sheet->setCellValue('B53', '4');
$sheet->setCellValue('C53', 'D');
$sheet->setCellValue('D53', '20');
$sheet->setCellValue('E53', 'Abril');
$sheet->setCellValue('F53', '2026');
$sheet->setCellValue('G53', 'INST. JKL');

$sheet->setCellValue('B54', '5');
$sheet->setCellValue('C54', 'E');
$sheet->setCellValue('D54', '12');
$sheet->setCellValue('E54', 'Mayo');
$sheet->setCellValue('F54', '2026');
$sheet->setCellValue('G54', 'INST. MNO');

$sheet->setCellValue('B55', '6');
$sheet->setCellValue('C55', 'F');
$sheet->setCellValue('D55', '7');
$sheet->setCellValue('E55', 'Junio');
$sheet->setCellValue('F55', '2026');
$sheet->setCellValue('G55', 'INST. PQR');

// Título para la formación científica tecnológica y productiva del tercer año
$sheet->setCellValue('A57', 'FORMACIÓN CIENTÍFICA TECNOLÓGICA Y PRODUCTIVA');
$sheet->mergeCells('A57:G57');

/////////////////////////////


// Título para la segunda tabla (separado por un espacio en blanco)
$sheet->setCellValue('I25', 'TERCER AÑO');

// Encabezados de la segunda tabla
$sheet->setCellValue('I26', 'ÁREAS DE FORMACIÓN');
$sheet->setCellValue('J26', 'CALIFICACIÓN');
$sheet->mergeCells('J26:L26'); // Unir celdas para "CALIFICACIÓN"
$sheet->setCellValue('J27', 'N°');
$sheet->setCellValue('K27', 'LETRAS');
$sheet->setCellValue('L27', 'T-E');
$sheet->setCellValue('M26', 'FECHA');
$sheet->mergeCells('M26:O26'); // Unir celdas para "FECHA"
$sheet->setCellValue('M27', 'Mes');
$sheet->setCellValue('N27', 'Año');
$sheet->setCellValue('O27', 'INST. EDUC.');

// Filas de la segunda tabla
$sheet->setCellValue('I28', 'Lengua y Literatura');
$sheet->setCellValue('I29', 'Matemática');
$sheet->setCellValue('I30', 'Idiomas');
$sheet->setCellValue('I31', 'Educación Física');
$sheet->setCellValue('I32', 'Biología, Ambiente y Tecnología');
$sheet->setCellValue('I33', 'Geografía, Historia y Soberanía Nacional');

// Llenar datos en la segunda tabla
$sheet->setCellValue('J28', '7');
$sheet->setCellValue('K28', 'G');
$sheet->setCellValue('L28', '8');
$sheet->setCellValue('M28', 'Diciembre');
$sheet->setCellValue('N28', '2024');
$sheet->setCellValue('O28', 'INST. STU');

$sheet->setCellValue('J29', '8');
$sheet->setCellValue('K29', 'H');
$sheet->setCellValue('L29', '13');
$sheet->setCellValue('M29', 'Enero');
$sheet->setCellValue('N29', '2025');
$sheet->setCellValue('O29', 'INST. VWX');

$sheet->setCellValue('J30', '9');
$sheet->setCellValue('K30', 'I');
$sheet->setCellValue('L30', '6');
$sheet->setCellValue('M30', 'Febrero');
$sheet->setCellValue('N30', '2025');
$sheet->setCellValue('O30', 'INST. YZA');

$sheet->setCellValue('J31', '10');
$sheet->setCellValue('K31', 'J');
$sheet->setCellValue('L31', '19');
$sheet->setCellValue('M31', 'Marzo');
$sheet->setCellValue('N31', '2025');
$sheet->setCellValue('O31', 'INST. BCD');

$sheet->setCellValue('J32', '11');
$sheet->setCellValue('K32', 'K');
$sheet->setCellValue('L32', '4');
$sheet->setCellValue('M32', 'Abril');
$sheet->setCellValue('N32', '2025');
$sheet->setCellValue('O32', 'INST. EFG');

$sheet->setCellValue('J33', '12');
$sheet->setCellValue('K33', 'L');
$sheet->setCellValue('L33', '17');
$sheet->setCellValue('M33', 'Mayo');
$sheet->setCellValue('N33', '2025');
$sheet->setCellValue('O33', 'INST. HIJ');


$sheet->setCellValue('I36', 'CUARTO GRADO');

// Encabezados de la tercera tabla
$sheet->setCellValue('I37', 'ÁREAS DE FORMACIÓN');
$sheet->setCellValue('J37', 'CALIFICACIÓN');
$sheet->mergeCells('J37:L37'); // Unir celdas para "CALIFICACIÓN"
$sheet->setCellValue('J38', 'N°');
$sheet->setCellValue('K38', 'LETRAS');
$sheet->setCellValue('L38', 'T-E');
$sheet->setCellValue('M37', 'FECHA');
$sheet->mergeCells('M37:O37'); // Unir celdas para "FECHA"
$sheet->setCellValue('M38', 'Mes');
$sheet->setCellValue('N38', 'Año');
$sheet->setCellValue('O38', 'INST. EDUC.');

// Filas de la tercera tabla
$sheet->setCellValue('I39', 'Lengua y Literatura');
$sheet->setCellValue('I40', 'Matemática');
$sheet->setCellValue('I41', 'Idiomas');
$sheet->setCellValue('I42', 'Educación Física');
$sheet->setCellValue('I43', 'Biología, Ambiente y Tecnología');
$sheet->setCellValue('I44', 'Geografía, Historia y Soberanía Nacional');

// Llenar datos en la tercera tabla
$sheet->setCellValue('J39', '1');
$sheet->setCellValue('K39', 'A');
$sheet->setCellValue('L39', '15');
$sheet->setCellValue('M39', 'Junio');
$sheet->setCellValue('N39', '2025');
$sheet->setCellValue('O39', 'INST. ABC');

$sheet->setCellValue('J40', '2');
$sheet->setCellValue('K40', 'B');
$sheet->setCellValue('L40', '18');
$sheet->setCellValue('M40', 'Julio');
$sheet->setCellValue('N40', '2025');
$sheet->setCellValue('O40', 'INST. DEF');

$sheet->setCellValue('J41', '3');
$sheet->setCellValue('K41', 'C');
$sheet->setCellValue('L41', '12');
$sheet->setCellValue('M41', 'Agosto');
$sheet->setCellValue('N41', '2025');
$sheet->setCellValue('O41', 'INST. GHI');

$sheet->setCellValue('J42', '4');
$sheet->setCellValue('K42', 'D');
$sheet->setCellValue('L42', '14');
$sheet->setCellValue('M42', 'Septiembre');
$sheet->setCellValue('N42', '2025');
$sheet->setCellValue('O42', 'INST. JKL');

$sheet->setCellValue('J43', '5');
$sheet->setCellValue('K43', 'E');
$sheet->setCellValue('L43', '16');
$sheet->setCellValue('M43', 'Octubre');
$sheet->setCellValue('N43', '2025');
$sheet->setCellValue('O43', 'INST. MNO');

$sheet->setCellValue('J44', '6');
$sheet->setCellValue('K44', 'F');
$sheet->setCellValue('L44', '19');
$sheet->setCellValue('M44', 'Noviembre');
$sheet->setCellValue('N44', '2025');
$sheet->setCellValue('O44', 'INST. PQR');


// Título para la nueva tabla
$sheet->setCellValue('I47', 'QUINTO GRADO');

// Encabezados de la nueva tabla
$sheet->setCellValue('I48', 'ÁREAS DE FORMACIÓN');
$sheet->setCellValue('J48', 'CALIFICACIÓN');
$sheet->mergeCells('J48:L48'); // Unir celdas para "CALIFICACIÓN"
$sheet->setCellValue('J49', 'N°');
$sheet->setCellValue('K49', 'LETRAS');
$sheet->setCellValue('L49', 'T-E');
$sheet->setCellValue('M48', 'FECHA');
$sheet->mergeCells('M48:O48'); // Unir celdas para "FECHA"
$sheet->setCellValue('M49', 'Mes');
$sheet->setCellValue('N49', 'Año');
$sheet->setCellValue('O49', 'INST. EDUC.');

// Filas de la nueva tabla
$sheet->setCellValue('I50', 'Lengua y Literatura');
$sheet->setCellValue('I51', 'Matemática');
$sheet->setCellValue('I52', 'Idiomas');
$sheet->setCellValue('I53', 'Educación Física');
$sheet->setCellValue('I54', 'Biología, Ambiente y Tecnología');
$sheet->setCellValue('I55', 'Geografía, Historia y Soberanía Nacional');

// Llenar datos en la nueva tabla
$sheet->setCellValue('J50', '1');
$sheet->setCellValue('K50', 'A');
$sheet->setCellValue('L50', '20');
$sheet->setCellValue('M50', 'Noviembre');
$sheet->setCellValue('N50', '2025');
$sheet->setCellValue('O50', 'INST. LMN');

$sheet->setCellValue('J51', '2');
$sheet->setCellValue('K51', 'B');
$sheet->setCellValue('L51', '14');
$sheet->setCellValue('M51', 'Diciembre');
$sheet->setCellValue('N51', '2025');
$sheet->setCellValue('O51', 'INST. OPQ');

$sheet->setCellValue('J52', '3');
$sheet->setCellValue('K52', 'C');
$sheet->setCellValue('L52', '12');
$sheet->setCellValue('M52', 'Enero');
$sheet->setCellValue('N52', '2026');
$sheet->setCellValue('O52', 'INST. RST');

$sheet->setCellValue('J53', '4');
$sheet->setCellValue('K53', 'D');
$sheet->setCellValue('L53', '16');
$sheet->setCellValue('M53', 'Febrero');
$sheet->setCellValue('N53', '2026');
$sheet->setCellValue('O53', 'INST. UVW');

$sheet->setCellValue('J54', '5');
$sheet->setCellValue('K54', 'E');
$sheet->setCellValue('L54', '18');
$sheet->setCellValue('M54', 'Marzo');
$sheet->setCellValue('N54', '2026');
$sheet->setCellValue('O54', 'INST. XYZ');

$sheet->setCellValue('J55', '6');
$sheet->setCellValue('K55', 'F');
$sheet->setCellValue('L55', '21');
$sheet->setCellValue('M55', 'Abril');
$sheet->setCellValue('N55', '2026');
$sheet->setCellValue('O55', 'INST. ABC');

// Datos de la tabla Institución Educativa (inicia en la fila 58)
// Título de la sección
$sheet->setCellValue('I58', 'VII. Institución Educativa');
$sheet->mergeCells('I58:M58');
$sheet->getStyle('I58:M58')->getFont()->setBold(true);

// Director(a)
$sheet->setCellValue('I59', 'Director(a)');
$sheet->mergeCells('I59:J59');
$sheet->setCellValue('K59', 'Juan Pérez'); // Este es el nombre del director(a)
$sheet->mergeCells('K59:M59');

// Apellidos y Nombres
$sheet->setCellValue('I60', 'Apellidos y Nombres:');
$sheet->mergeCells('I60:J60');
$sheet->setCellValue('K60', 'Juan Pérez García'); // Nombre completo
$sheet->mergeCells('K60:M60');

// Cédula de Identidad
$sheet->setCellValue('I61', 'Cédula de Identidad:');
$sheet->mergeCells('I61:J61');
$sheet->setCellValue('K61', '123456789'); // Cédula
$sheet->mergeCells('K61:M61');

// Firma
$sheet->setCellValue('I62', 'Firma:');
$sheet->mergeCells('I62:J62');
$sheet->setCellValue('K62', '☯'); // Espacio para la firma
$sheet->mergeCells('K62:M62');

// Sello de la institución educativa
$sheet->setCellValue('N58', 'SELLO DE LA INSTITUCIÓN EDUCATIVA');
$sheet->mergeCells('N58:O63');

// Para efectos de su validez nacional
$sheet->setCellValue('I63', 'Para Efectos de su Validez Nacional');
$sheet->mergeCells('I63:M63');
$sheet->getStyle('I63:M63')->getFont()->setItalic(true);


// Aplicar estilos a las celdas






// Aplicar bordes a las celdas de ambas tablas
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

// Aplicar estilo a la primera tabla
$sheet->getStyle('A19:D22')->applyFromArray($styleArray);

// Aplicar estilo a la segunda tabla
$sheet->getStyle('I19:L22')->applyFromArray($styleArray);

// Ajustar el tamaño de las columnas de la primera tabla
foreach (range('A', 'D') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(false);
}

// Ajustar el tamaño de las columnas de la segunda tabla
foreach (range('I', 'L') as $columnID) { // Cambiado de H a I
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}




//fin tabal cabecera

// Primera tabla
$sheet->getStyle('A26:G33')->applyFromArray($styleArray);

// Segunda tabla
$sheet->getStyle('I26:O33')->applyFromArray($styleArray);

// Ajustar el ancho de las columnas para que se adapte al contenido
foreach (range('A', 'G') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}
foreach (range('I', 'O') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

/////////////////////////////////
$sheet->getStyle('A37:G44')->applyFromArray($styleArray);
$sheet->getStyle('A48:G55')->applyFromArray($styleArray);

// Segunda tabla
//$sheet->getStyle('I26:O33')->applyFromArray($styleArray);
/////////////////////////////
$sheet->getStyle('I37:O44')->applyFromArray($styleArray);

$sheet->getStyle('I48:O55')->applyFromArray($styleArray);

$sheet->getStyle('I58:O63')->applyFromArray($styleArray);



// Guardar el archivo Excel
$writer = new Xlsx($spreadsheet);
$writer->save('plan_de_estudio_dos_tablas_con_datos.xlsx');

echo "El archivo Excel con datos ha sido creado exitosamente.";



