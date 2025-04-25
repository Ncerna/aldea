<?php
require '../../plantilla/dompdf_php8/vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

try {
    // Crear un objeto de opciones para Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $options->set('isRemoteEnabled', true); // Habilitar la carga de imágenes remotas si es necesario
    
    ob_start();
    $data = file_get_contents('php://input');
    $request = json_decode($data, true);
    $school = $request['school'] ?? null; 
    $student = $request['student'] ?? null; // Usa null si no está presente
   
    ob_get_clean();

   
    ob_start();
    // Generar la URL del código QR
    require '../../plantilla/phpqrcode/qrlib.php';
    $text_qr = $student['student'] . " | " . $student['cedula'] . " | " . $student['degreName'] . " | " . $student['section'] . " | " . $student['currenYear'];
     $ruta_qr = "imageQr.png"; // Ruta donde se guardará la imagen del QR
     QRcode::png($text_qr, $ruta_qr, 'Q', 15, 0); // Genera y guarda el QR
     ob_get_clean();
    
    // Crear un objeto Dompdf con las opciones
    $dompdf = new Dompdf($options);

    // Establecer la zona horaria y obtener la fecha actual
    date_default_timezone_set('America/Caracas');

    // Configurar la localización a español
    setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain');
    
    // Obtener la fecha actual en formato español
    $fechaActual = strftime("%A, %d de %B de %Y");

     //$fechaActual = date('d \d\e F \d\e Y');

    // Cargar la imagen de cabecera y verificar la ruta
    $escudoImagen = "../../imagenes/image002-0001.png";
    if (!file_exists($escudoImagen)) {
        echo 'Error: La imagen de la cabecera no se encuentra en la ruta especificada.';
        exit();
    }
    $escudoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($escudoImagen));

    // Cargar la imagen pequeña y verificar la ruta
    $firmaImagen = "../../imagenes/sellodos.jpg"; // Reemplaza con la ruta de tu imagen pequeña
    if (!file_exists($firmaImagen)) {
        echo 'Error: La imagen de la firma no se encuentra en la ruta especificada.';
        exit();
    }
    $firmaBase64 = "data:image/png;base64," . base64_encode(file_get_contents($firmaImagen));

    // Cargar la imagen para el sello
    $selloImagen = "imageQr.png"; // Reemplaza con la ruta de tu imagen del sello
    if (!file_exists($selloImagen)) {
        echo 'Error: La imagen del sello no se encuentra en la ruta especificada.';
        exit();
    }
    $selloBase64 = "data:image/png;base64," . base64_encode(file_get_contents($selloImagen));

    // Capturar el contenido HTML
    ob_start();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <style>
            /* Estilos generales */
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }

            /* Estilo para la cabecera */
            .header {
                width: 100%;
                text-align: center;
            }

            .header img {
                width: 100%;
                height: auto;
            }

            /* Estilo para el pie de página */
            .footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
                padding: 10px;
                font-size: 13px;
                background-color: #f1f1f1; /* Color de fondo opcional */
            }

            /* Espacio para el contenido principal */
            .content {
                padding: 20px;
                text-align: center;
                min-height: 400px; /* Ajustar según la cantidad de contenido */
            }

            /* Estilo para el bloque de texto */
            .text-block {
                text-align: justify;
                margin: 20px; /* Márgenes laterales */
                padding: 10px;
                font-size: 16px; /* Aumenta el tamaño de la fuente */
                /* border: 1px solid #000; */ /* Eliminar o comentar el borde */
            }

            /* Estilo para el texto centrado */
            .centered-text {
                margin-top: 20px;
                text-align: center;
            }

            /* Estilo para la imagen pequeña */
            .small-image {
                margin: 10px 0;
                text-align: center;
            }

            /* Estilo para la firma y el sello */
            .signature-seal-container {
                margin-top: 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0 20px; /* Espacio alrededor del contenedor */
            }

            .signature {
                text-align: center;
            }

            .signature p {
                margin: 2px 0; /* Reducir el margen entre las líneas */
            }

           .seal {
                text-align: right; /* Alinear el contenido a la derecha */
                margin-right: 20px; /* Añadir margen derecho */
                margin-top: -50px; /* Ajustar el margen superior si es necesario */
            }

            .seal img {
                border: 1px solid #000; /* Marco alrededor de la imagen */
                max-width: 100px; /* Ajusta el tamaño máximo según sea necesario */
                max-height: 100px; /* Ajusta el tamaño máximo según sea necesario */
                width: auto; /* Mantiene la relación de aspecto */
                height: auto; /* Mantiene la relación de aspecto */
                margin-top: 5px; /* Espacio superior opcional */
                object-fit: contain; /* Asegura que la imagen se ajuste sin recortes */
            }


            
        </style>
    </head>
    <body>
        <!-- Cabecera con la imagen -->
        <div class="header">
            <img src="<?php echo $escudoBase64; ?>" alt="Cabecera">
        </div>


        <!-- Contenido principal -->
        <div class="content">
            <h2>CONSTANCIA DE ESTUDIO</h2>
            <div class="text-block">
                Quien suscribe, <strong><?php echo "Prof.".$school['directors'] ?? ""; ?></strong> , 
                Titular de la cédula de identidad <strong><?php echo "V.- ".$school['identity'] ?? ""; ?></strong>, 
                Directora (E) del instituto superior “LAS CATARATAS”, código Número: 007915820, 
                hace constar que el estudiante: <strong><?php echo $student['student'] ?? ""; ?>
            </strong> Titular de la cédula de identidad No  <strong><?php echo $student['cedula'] ?? ""; ?></strong>,
             cursa en este Plantel el <strong><?php echo $student['degreName'] ??  " ";  echo $student['section'] ?? "";  ?>
            </strong> de  <?php echo intval($student['id']) <= 3 ? "Educación Media General" : "Educación Media Técnica Profesional"; ?>
                 , durante el año escolar <strong><?php echo $student['currenYear'] ?? "" ?></strong>
                <br><br>
                Constancia que se expide a petición de parte interesada en Ciudad del Este , <strong><?php echo $fechaActual; ?></strong>.
            </div>

            <!-- Texto centrado "Atentamente" -->
            <div class="centered-text">
                <p>Atentamente,</p>
            </div>

            <!-- Contenedor de Firma y Sello -->
            <div class="signature-seal-container">
                <!-- Firma -->
                <div class="signature">
                    <div class="small-image">
                        <img src="<?php echo $firmaBase64; ?>" alt="Firma" width="150"> <!-- Ajusta el ancho según sea necesario -->
                    </div>
                    <p>________________________</p>
                    <p> <?php echo "Prof.".$school['directors'] ?? ""; ?></p>
                    <p><?php echo "C.I.V. ".$school['identity'] ?? ""; ?></p>
                    <p>Directora (E)</p>
                </div>
                
                <!-- Sello alineado a la derecha -->
                <div class="seal">
                    <p>SELLO DEL PLANTEL</p>
                    <img src="<?php echo $selloBase64; ?>" alt="Sello">
                </div>
                 <!-- Código QR -->
             
            </div>
        </div>

        <!-- Pie de página con texto -->
        <div class="footer">
            ------------------------------------------------------------------------------------------------------------------------------------------------------------<br><br>
            Urb. La Quebradita, Av. Morán, Parroquia El Paraiso, Detrás De Los Bomberos Municipio Libertador
            De Caracas, Distrito Capital. | +58 (0212) 448-29-63 | Etcluisrazetti167@Gmail.Com
        </div>
    </body>
    </html>
    <?php
    // Obtener el contenido de la salida
    $html = ob_get_clean();
    //echo $html;

    // Cargar el contenido en Dompdf
    $dompdf->loadHtml($html);

    // Configurar el tamaño del papel y las márgenes
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar el PDF
    $dompdf->render();

    // Enviar el PDF al cliente
    header('Content-Type: application/pdf');
    $dompdf->stream("constancia_estudiante.pdf", array('Attachment' => false));
    exit();
} catch (Exception $e) {
    echo 'Error al generar el PDF: ', $e->getMessage();
    exit();
}
?>
