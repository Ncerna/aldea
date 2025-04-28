<?php
require_once __DIR__ . '/../../interfaces/IFileStrategy.php';
require_once __DIR__ . '/DirectoryStrategy.php';
class PdfFileStrategy implements IFileStrategy {
    private string $uploadDirectory;
    private DirectoryStrategy $directoryStrategy;

    public function __construct(string $uploadDirectory, DirectoryStrategy $directoryStrategy) {
        $this->uploadDirectory = $uploadDirectory;
        $this->directoryStrategy = $directoryStrategy;
    }

    public function handleFile(Attachment $attachment): void {
        if ($attachment->getFileType() !== 'application/pdf') {
            throw new Exception("El archivo no es un PDF");
        }
        if (!$this->directoryStrategy->createDirectory($this->uploadDirectory)) {
            throw new Exception("Error al crear el directorio");
        }
        $this->directoryStrategy->setPermissions($this->uploadDirectory);
        $filePath = $this->uploadDirectory . '/' . $attachment->getFileName();

        if (file_exists($filePath)) {
            if (!unlink($filePath))   throw new Exception("Error al eliminar el archivo existente");
            
        }
        if (!move_uploaded_file($attachment->getTempPath(), $filePath)) {
            throw new Exception("Error al mover el archivo");
        }
        $relativePath = 'store/pdf';
        $attachment->setFilePath($relativePath . '/' . $attachment->getFileName());
        $attachment->setFileType($attachment->getFileType());
    }
}
