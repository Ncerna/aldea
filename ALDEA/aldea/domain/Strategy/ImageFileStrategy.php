<?php
require_once __DIR__ . '/../../interfaces/IFileStrategy.php';
class ImageFileStrategy implements IFileStrategy {
    private string $uploadDirectory;
    private DirectoryStrategy $directoryStrategy;

    public function __construct(string $uploadDirectory, DirectoryStrategy $directoryStrategy) {
        $this->uploadDirectory = $uploadDirectory;
        $this->directoryStrategy = $directoryStrategy;
    }
    public function handleFile(Attachment $attachment): void {
        if (!in_array($attachment->getFileType(), ['image/png', 'image/jpeg'])) {
            throw new Exception("El archivo no es un tipo de imagen soportado");
        }

        if (!$this->directoryStrategy->createDirectory($this->uploadDirectory))
          throw new Exception("Error al crear el directorio");

        $this->directoryStrategy->setPermissions($this->uploadDirectory);
        $uniqueFileName = $this->generateUniqueFileName($attachment->getFileName());
        $filePath = $this->uploadDirectory . '/' . $uniqueFileName;

        if (!move_uploaded_file($attachment->getTempPath(), $filePath)) {
            throw new Exception("Error al mover el archivo");
        }

        $relativePath = 'store/img';
        $attachment->setFileName($uniqueFileName);
        $attachment->setFilePath($relativePath . '/' . $uniqueFileName);
        $attachment->setFileType($attachment->getFileType());
    }

    private function generateUniqueFileName(string $originalFileName): string {
        $uuid = uniqid('', true);
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        return $uuid . '.' . $extension;
    }
}


    

