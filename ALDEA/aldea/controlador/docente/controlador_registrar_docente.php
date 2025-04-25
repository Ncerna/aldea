<?php
require '../../modelo/modelo_docente.php';
$MU = new Docente();

// Validar datos
function validarDatos($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

$idDocente = validarDatos($_POST['idDocente']);
$nombreDocente = strtoupper(validarDatos($_POST['nombreDocente']));
$apellidDocente = strtoupper(validarDatos($_POST['apellidDocente']));
$dniDocente = validarDatos($_POST['dniDocente']);
$emailDocente = validarDatos($_POST['emailDocente']);
$telfDocente = validarDatos($_POST['telfDocente']);
$codigDocente = validarDatos($_POST['codigDocente']);
$nivelDocente = validarDatos($_POST['nivelDocente']);

$matricula = validarDatos($_POST['matricula']);
$cargoMec = validarDatos($_POST['cargoMec']);
$cargoInt = validarDatos($_POST['cargoInt']);
$claseCargo = validarDatos($_POST['claseCargo']);
$turno = validarDatos($_POST['turno']);
$nivelMec = validarDatos($_POST['nivelMec']);
$titulosObtenidos = validarDatos($_POST['titulosObtenidos']);
$identificacionAldea = validarDatos($_POST['identificacionAldea']);
$estadoCivil = validarDatos($_POST['estadoCivil']);
$lugarNacimiento = validarDatos($_POST['lugarNacimiento']);
$cargoAldea = validarDatos($_POST['cargoAldea']);
$nivelGrado = validarDatos($_POST['nivelGrado']);

$tipoDocente = validarDatos($_POST['tipoDocente']);
$fechaIngreso = validarDatos($_POST['fechaIngreso']);
$nacionalidad = validarDatos($_POST['nacionalidad']);
$antiguedad = validarDatos($_POST['antiguedad']);
$antiguedadDocencia = validarDatos($_POST['antiguedadDocencia']);
$renuncia = strtoupper(validarDatos($_POST['renuncia']));
$tipoContrato = validarDatos($_POST['tipoContrato']);
$observaciones = strtoupper(validarDatos($_POST['observaciones']));


// Ruta de destino para los archivos
date_default_timezone_set("America/Lima"); // Asegura la zona horaria
$carpeta = "../../archivos/docentes/";
if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
}

function guardarArchivoRenombrado($archivo, $tipo, $dni, $carpeta) {
    if ($archivo && $archivo['error'] === 0) {
        $ext = pathinfo($archivo['name'], PATHINFO_EXTENSION);
        $timestamp = date("Ymd_His");
        $nuevoNombre = "{$tipo}_{$dni}_{$timestamp}.{$ext}";
        $destino = $carpeta . $nuevoNombre;
        move_uploaded_file($archivo['tmp_name'], $destino);
        return $nuevoNombre;
    }
    return null;
}

// Guardamos cada archivo con nombre único
$nombreFoto = guardarArchivoRenombrado($_FILES['foto_docente'], "foto", $dniDocente, $carpeta);
$nombreCV = guardarArchivoRenombrado($_FILES['cv_docente'], "cv", $dniDocente, $carpeta);
$nombreTitulo = guardarArchivoRenombrado($_FILES['titulo_docente'], "titulo", $dniDocente, $carpeta);
$nombreConstancia = guardarArchivoRenombrado($_FILES['constancia_docente'], "constancia", $dniDocente, $carpeta);
$nombreCapacitaciones = guardarArchivoRenombrado($_FILES['capacitaciones_docente'], "capacitacion", $dniDocente, $carpeta);

// Verificar si el docente ya existe
$result = $MU->VerificarDocenteexiste($dniDocente, $emailDocente, $codigDocente);

if ($result == 0) {
    // Registrar docente
   $result = $MU->Registrar_Docente(
        $nombreDocente, $apellidDocente, $dniDocente, $emailDocente, $telfDocente,
        $codigDocente, $nivelDocente, $tipoDocente, $matricula, $cargoMec, $cargoInt, $claseCargo, $turno, $nivelMec, $titulosObtenidos, $identificacionAldea, $estadoCivil, $lugarNacimiento, $cargoAldea, $nivelGrado, $fechaIngreso, $nacionalidad, $antiguedad, $antiguedadDocencia, $renuncia, $tipoContrato, $observaciones,
        $nombreFoto, $nombreCV, $nombreTitulo, $nombreConstancia, $nombreCapacitaciones
    );
    // Devolver resultado
    echo json_encode(['status' => 'success', 'mensaje' => 'Docente registrado correctamente', 'data' => $result]);
} else {
    // Si el docente ya existe
    echo json_encode(['status' => 'error', 'mensaje' => 'El docente ya existe.']);
}
?>
