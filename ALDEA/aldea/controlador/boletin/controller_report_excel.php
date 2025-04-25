<?php
// Verificar si se han recibido datos de tabla HTML del cliente
if(isset($_POST['tablaHTML'])) {
    // Recibir los datos de tabla HTML del cliente
    $tablaHTML = $_POST['tablaHTML'];

    // Cabeceras para indicar que se va a descargar un archivo Excel
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=documento_exportado_" . date('Y-m-d_H-i-s') . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Imprimir los datos de la tabla HTML para descargar el archivo Excel
    echo $tablaHTML;
} else {
    // Si no se han recibido datos de tabla HTML del cliente, se muestra un mensaje de error
    echo "Error: No se han recibido datos de tabla HTML.";
}
?>
