<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Configuración inicial del ancho global
$sheet->getColumnDimension('A')->setWidth(50); // Ancho global para la columna A

// Primera tabla
$sheet->setCellValue('A1', 'Tabla 1 - Columna 1');
$sheet->setCellValue('A2', 'Columna 2');
$sheet->setCellValue('A3', 'Fila 1');
$sheet->setCellValue('A4', 'Fila 1');

// Aplicar bordes para separar la primera tabla
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'],
        ],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
];
$sheet->getStyle('A1:A4')->applyFromArray($styleArray);

// Espacio entre tablas
$sheet->setCellValue('A6', 'Tabla 2 - Columna 1');
$sheet->setCellValue('A7', 'Columna 2');
$sheet->setCellValue('A8', 'Fila 1');
$sheet->setCellValue('A9', 'Fila 1');

// Cambiar el ancho global (para toda la columna A)
$sheet->getColumnDimension('A')->setWidth(30); // Ancho global para la columna A

// Aplicar bordes para separar la segunda tabla
$sheet->getStyle('A6:A9')->applyFromArray($styleArray);

// Espacio entre tablas
$sheet->setCellValue('A12', 'Tabla 3 - Columna 1');
$sheet->setCellValue('A13', 'Columna 2');
$sheet->setCellValue('A14', 'Fila 1');
$sheet->setCellValue('A15', 'Fila 1');
$sheet->setCellValue('A16', 'Fila 2');
$sheet->setCellValue('A17', 'Fila 2');
$sheet->setCellValue('A18', 'Fila 3');
$sheet->setCellValue('A19', 'Fila 3');

// Cambiar el ancho global (para toda la columna A)
$sheet->getColumnDimension('A')->setWidth(80); // Ancho global para la columna A

// Aplicar bordes para separar la tercera tabla
$sheet->getStyle('A12:A19')->applyFromArray($styleArray);

// Guardar el archivo en formato Excel
$writer = new Xlsx($spreadsheet);
$writer->save('tablas_diferentes_ancho_simulado.xlsx');

echo "El archivo Excel ha sido creado exitosamente.";
?>
