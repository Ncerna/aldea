<?php
require '../../modelo/modelo_docente.php';
$MU = new Docente();

// Validar datos
function validarDatos($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// === DATOS PERSONALES ORDENADOS ===
$idDocente           = validarDatos($_POST['idDocente']);
$nombreDocente       = strtoupper(validarDatos($_POST['nombreDocente']));
$apellidDocente      = strtoupper(validarDatos($_POST['apellidDocente']));
$dniDocente          = validarDatos($_POST['dniDocente']);
$emailDocente        = validarDatos($_POST['emailDocente']);
$telfDocente         = validarDatos($_POST['telfDocente']);
$codigDocente        = validarDatos($_POST['codigDocente']);
$nivelDocente        = validarDatos($_POST['nivelDocente']);

$matricula           = validarDatos($_POST['matricula']);
$cargoMec            = validarDatos($_POST['cargoMec']);
$cargoInt            = validarDatos($_POST['cargoInt']);
$claseCargo          = validarDatos($_POST['claseCargo']);
$turno               = validarDatos($_POST['turno']);
$nivelMec            = validarDatos($_POST['nivelMec']);
$titulosObtenidos    = validarDatos($_POST['titulosObtenidos']);
$identificacionAldea = validarDatos($_POST['identificacionAldea']);
$estadoCivil         = validarDatos($_POST['estadoCivil']);
$lugarNacimiento     = validarDatos($_POST['lugarNacimiento']);
$cargoAldea          = validarDatos($_POST['cargoAldea']);
$nivelGrado          = validarDatos($_POST['nivelGrado']);

$tipoDocente         = validarDatos($_POST['tipoDocente']);
$fechaIngreso        = validarDatos($_POST['fechaIngreso']);
$nacionalidad        = validarDatos($_POST['nacionalidad']);
$antiguedad          = validarDatos($_POST['antiguedad']);
$antiguedadDocencia  = validarDatos($_POST['antiguedadDocencia']);
$renuncia            = strtoupper(validarDatos($_POST['renuncia']));
$tipoContrato        = validarDatos($_POST['tipoContrato']);
$observaciones       = strtoupper(validarDatos($_POST['observaciones']));

// === ARCHIVOS (se conservan si no se suben nuevos) ===
$nombreFoto           = validarDatos($_POST['nombreFoto'] ?? '');
$nombreCV             = validarDatos($_POST['nombreCV'] ?? '');
$nombreTitulo         = validarDatos($_POST['nombreTitulo'] ?? '');
$nombreConstancia     = validarDatos($_POST['nombreConstancia'] ?? '');
$nombreCapacitaciones = validarDatos($_POST['nombreCapacitaciones'] ?? '');

// === ARCHIVOS NUEVOS SI EXISTEN ===
date_default_timezone_set("America/Lima");
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

// Procesar archivos subidos
$fotoNueva           = guardarArchivoRenombrado($_FILES['foto_docente'] ?? null, "foto", $dniDocente, $carpeta);
$cvNuevo             = guardarArchivoRenombrado($_FILES['cv_docente'] ?? null, "cv", $dniDocente, $carpeta);
$tituloNuevo         = guardarArchivoRenombrado($_FILES['titulo_docente'] ?? null, "titulo", $dniDocente, $carpeta);
$constanciaNueva     = guardarArchivoRenombrado($_FILES['constancia_docente'] ?? null, "constancia", $dniDocente, $carpeta);
$capacitacionesNueva = guardarArchivoRenombrado($_FILES['capacitaciones_docente'] ?? null, "capacitacion", $dniDocente, $carpeta);

// Conservar nombres anteriores si no hay nuevos archivos
$nombreFoto           = $fotoNueva ?: $nombreFoto;
$nombreCV             = $cvNuevo ?: $nombreCV;
$nombreTitulo         = $tituloNuevo ?: $nombreTitulo;
$nombreConstancia     = $constanciaNueva ?: $nombreConstancia;
$nombreCapacitaciones = $capacitacionesNueva ?: $nombreCapacitaciones;

// === LLAMADA A MÉTODO DEL MODELO ===
$result = $MU->Actualizar_Docente(
    $nombreDocente, $apellidDocente, $dniDocente, $emailDocente, $telfDocente,
    $codigDocente, $nivelDocente,
    $matricula, $cargoMec, $cargoInt, $claseCargo, $turno, $nivelMec,
    $titulosObtenidos, $identificacionAldea, $estadoCivil, $lugarNacimiento,
    $cargoAldea, $nivelGrado,
    $tipoDocente, $fechaIngreso, $nacionalidad, $antiguedad, $antiguedadDocencia,
    $renuncia, $tipoContrato, $observaciones,
    $nombreFoto, $nombreCV, $nombreTitulo, $nombreConstancia, $nombreCapacitaciones,
    $idDocente
);

// === RESPUESTA JSON ===
if ($result) {
    echo json_encode(['status' => 'success', 'mensaje' => 'Docente actualizado correctamente', 'data' => $result]);
} else {
    echo json_encode(['status' => 'error', 'mensaje' => 'No se pudo actualizar el docente.']);
}
?>
