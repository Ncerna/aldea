<?php
// Incluya la biblioteca PHPExcel
require_once 'PHPExcel.php';

// Cree un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establezca las propiedades del libro de trabajo
$objPHPExcel->getProperties()->setCreator("Nombre del creador")
                             ->setLastModifiedBy("Nombre del último modificador")
                             ->setTitle("Título del libro de trabajo")
                             ->setSubject("Asunto del libro de trabajo")
                             ->setDescription("Descripción del libro de trabajo")
                             ->setKeywords("Palabras clave")
                             ->setCategory("Categoría");

// Establezca el estilo de la fuente por defecto
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);

// Establezca el ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);

// Establezca el título de la hoja
$objPHPExcel->getActiveSheet()->setTitle('Plan de Estudios');

// Agregue las filas de encabezado
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'IV. Instituciones Educativas donde Cursó Estudios');
$objPHPExcel->getActiveSheet()->setCellValue('A2', 'N°');
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'Denominación y Epónimo de la Institución Educativa');
$objPHPExcel->getActiveSheet()->setCellValue('C2', 'Localidad');
$objPHPExcel->getActiveSheet()->setCellValue('D2', 'E.F.');
$objPHPExcel->getActiveSheet()->setCellValue('E2', 'N°');
$objPHPExcel->getActiveSheet()->setCellValue('F2', 'Denominación y Epónimo de la Institución Educativa');
$objPHPExcel->getActiveSheet()->setCellValue('G2', 'Localidad');
$objPHPExcel->getActiveSheet()->setCellValue('H2', 'E.F.');
$objPHPExcel->getActiveSheet()->setCellValue('A3', '1');
$objPHPExcel->getActiveSheet()->setCellValue('A4', '2');
$objPHPExcel->getActiveSheet()->setCellValue('A5', 'V. Plan de Estudio:');
$objPHPExcel->getActiveSheet()->setCellValue('A6', 'COMPONENTES');
$objPHPExcel->getActiveSheet()->setCellValue('A7', 'FORMACIÓN GENERAL');
$objPHPExcel->getActiveSheet()->setCellValue('A8', 'PRIMER AÑO');
$objPHPExcel->getActiveSheet()->setCellValue('A9', 'ÁREAS DE FORMACIÓN');
$objPHPExcel->getActiveSheet()->setCellValue('B9', 'CALIFICACIÓN');
$objPHPExcel->getActiveSheet()->setCellValue('C9', 'FECHA');
$objPHPExcel->getActiveSheet()->setCellValue('B10', 'N°');
$objPHPExcel->getActiveSheet()->setCellValue('C10', 'LETRAS');
$objPHPExcel->getActiveSheet()->setCellValue('D10', 'T-E');
$objPHPExcel->getActiveSheet()->setCellValue('E10', 'Mes');
$objPHPExcel->getActiveSheet()->setCellValue('F10', 'Año');
$objPHPExcel->getActiveSheet()->setCellValue('A11', 'Lengua y Literatura');
$objPHPExcel->getActiveSheet()->setCellValue('A12', 'Matemática');
$objPHPExcel->getActiveSheet()->setCellValue('A13', 'Idiomas');
$objPHPExcel->getActiveSheet()->setCellValue('A14', 'Educación Física');
$objPHPExcel->getActiveSheet()->setCellValue('A15', 'Biología, Ambiente y Tecnología');
$objPHPExcel->getActiveSheet()->setCellValue('A16', 'Geografía, Historia y Soberanía Nacional');
$objPHPExcel->getActiveSheet()->setCellValue('E5', '3');
$objPHPExcel->getActiveSheet()->setCellValue('E6', '4');
$objPHPExcel->getActiveSheet()->setCellValue('E7', '5');
$objPHPExcel->getActiveSheet()->setCellValue('E8', 'TERCER AÑO');
$objPHPExcel->getActiveSheet()->setCellValue('E9', 'ÁREAS DE FORMACIÓN');
$objPHPExcel->getActiveSheet()->setCellValue('F9', 'CALIFICACIÓN');
$objPHPExcel->getActiveSheet()->setCellValue('G9', 'FECHA');
$objPHPExcel->getActiveSheet()->setCellValue('F10', 'N°');
$objPHPExcel->getActiveSheet()->setCellValue('G10', 'LETRAS');
$objPHPExcel->getActiveSheet()->setCellValue('H10', 'T-E');
$objPHPExcel->getActiveSheet()->setCellValue('I10', 'Mes');
$objPHPExcel->getActiveSheet()->setCellValue('J10', 'Año');
$objPHPExcel->getActiveSheet()->setCellValue('E11', 'Lengua y Literatura');
$objPHPExcel->getActiveSheet()->setCellValue('E12', 'Matemática');
$objPHPExcel->getActiveSheet()->setCellValue('E13', 'Idiomas');
$objPHPExcel->getActiveSheet()->setCellValue('E14', 'Educación Física');
$objPHPExcel->getActiveSheet()->setCellValue('E15', 'Biología, Ambiente y Tecnología');
$objPHPExcel->getActiveSheet()->setCellValue('E16', 'Geografía, Historia y Soberanía Nacional');

// Establezca el estilo de las celdas de encabezado
$objPHPExcel->getActiveSheet()->getStyle('A1:H2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A5:H5')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A8:H8')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A9:H9')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E8:H8')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E9:H9')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A5:H5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A8:H8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A9:H9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('E8:H8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('E9:H9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Establezca el borde de las celdas de encabezado
$objPHPExcel->getActiveSheet()->getStyle('A1:H2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('A5:H5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('A8:H8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('A9:H9')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('E8:H8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('E9:H9')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

// Guarde el archivo Excel
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('plan_de_estudios.xlsx');

// Muestra un mensaje de éxito
echo "El archivo Excel se ha creado correctamente.";
?>


