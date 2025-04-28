<?php
require_once __DIR__ . '/../domain/Strategy/ImageFileStrategy.php';
require_once __DIR__ . '/../domain/Strategy/PdfFileStrategy.php';
require_once __DIR__ . '/../domain/Strategy/DirectoryStrategy.php';
require_once __DIR__ . '/../utils/ApiResponse.php';
class AttachmentService {
    private AttachmentRepository $repository;
    private array $strategies;
    private string $baseDirectory;
    private DirectoryStrategy $directoryStrategy;

    public function __construct(AttachmentRepository $repository, DirectoryStrategy $directoryStrategy) {
        $this->repository = $repository;
        $this->directoryStrategy = $directoryStrategy;
        $this->baseDirectory = __DIR__ . '/../store';
        $this->strategies = [
            'application/pdf' => new PdfFileStrategy($this->baseDirectory . '/pdf', $directoryStrategy),
            'image/png' => new ImageFileStrategy($this->baseDirectory . '/img', $directoryStrategy),
            'image/jpeg' => new ImageFileStrategy($this->baseDirectory . '/jpg', $directoryStrategy),
        ];
    }

    public function save(Attachment $attachment): array {
        if (empty($attachment->getTempPath())) {
            throw new Exception("No se ha proporcionado una ruta temporal válida para el archivo.");
        }
        $fileType = $attachment->getFileType();
        if (isset($this->strategies[$fileType])) {
            $this->strategies[$fileType]->handleFile($attachment);
        } else {
            throw new Exception("Tipo de archivo no soportado");
        }
        return $this->repository->save($attachment);
    }
    
    public function getAttachmentsByMessageId($messageId): array {
     return $this->repository->getAttachmentsByMessageId($messageId);
    }
     public function getByMessageId(int $messageId): array {
    return $this->repository->getByMessageId($messageId);
    }

   public function deleteAttachmentById(int $attachmentId): array {
    try {
        $attachment = $this->repository->findById($attachmentId);
        if ($attachment) {
            $this->deleteFileFromServer($attachment->getFilePath());
            $this->repository->softDelete($attachmentId);
            return ApiResponse::successResult(1, ['Adjunto eliminado correctamente']);
        } else {
            return ApiResponse::errorResult("Attachment not found");
        }
    } catch (Exception $e) {
       
        throw new \RuntimeException("Error al eliminar adjunto", 0, $e);
    }
  }
public function updateFavoriteStatus(int $attachmentId, int $isFavorite): void {
    $attachment = $this->repository->findById($attachmentId);
    $attachment->setIsFavorite($isFavorite);
    $this->repository->save($attachment);
}

public function updateExistingAttachments(array $existingFiles): void {
    foreach ($existingFiles as $fileData) {
        $attachment = $this->repository->findById($fileData['id']);
        if (!$attachment) {
            throw new Exception("Attachment con ID {$fileData['id']} no encontrado");
        }
        if ($attachment->getIsFavorite() != $fileData['isFavorite']) {
            $attachment->setIsFavorite($fileData['isFavorite']);
        }
        if (isset($fileData['status']) && $fileData['status'] == 0) {
            $attachment->setStatus(0);
            $this->deleteFileFromServer( $attachment->getFilePath()) ;
        }
        $this->repository->save($attachment);
    }
}
public function ensureSingleFavorite(int $eventId): void {

    $attachment = $this->repository->findFirstActiveByEventId($eventId);
    if (!$attachment)    return;
    if ($attachment->getIsFavorite() == 1)   return;
    $attachment->setIsFavorite(1);
    $this->repository->save($attachment);
}


public function saveNewAttachments(int $eventId, array $files, array $newFilesMeta): void {
    // Verificamos que la estructura sea la esperada
    if (!isset($files['name']) || !is_array($files['name'])) {
        throw new Exception("Estructura de archivos inválida");
    }

    // Recorremos cada archivo usando índices
    foreach ($files['name'] as $index => $fileName) {
        // Validar que exista archivo temporal
        if (empty($files['tmp_name'][$index])) {
            continue; // Saltar si no hay archivo temporal
        }

        // Obtener metadata correspondiente o valor por defecto
        $meta = $newFilesMeta[$index] ?? ['isFavorite' => 0];

        $attachment = new Attachment();
        $attachment->setEventId($eventId);
        $attachment->setFileName($fileName);
        $attachment->setFileType($files['type'][$index]);
        $attachment->setIsFavorite($meta['isFavorite']);
        $attachment->setTempPath($files['tmp_name'][$index]);

        $this->save($attachment); // Guarda el archivo y registro en BD
    }
}
public function getAttachmentsByEventId(int $eventId): array {
    try {
        return $this->repository->getAttachmentsByEventId($eventId);
    } catch (Exception $e) {
        throw new Exception("Error al obtener los adjuntos del evento: " . $e->getMessage());
    }
    
}



private function deleteFileFromServer(string $path): void {
    try {
        $relativePath = ltrim($path, '/\\');
        $basePath = realpath(__DIR__ . '/../');
        $fullPath = $basePath . DIRECTORY_SEPARATOR . $relativePath;
        $fullPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $fullPath);
        if (file_exists($fullPath)) {
            if (!unlink($fullPath)) {
                error_log("⚠️ No se pudo eliminar el archivo: $fullPath");
            } else {
                 error_log("✅ Archivo eliminado: $fullPath");
            }
        } else {
            error_log("❌ Archivo no encontrado: $fullPath");
        }

    } catch (Throwable $e) {
        error_log("🛑 Error al intentar eliminar el archivo: " . $e->getMessage());
    }
}


}


