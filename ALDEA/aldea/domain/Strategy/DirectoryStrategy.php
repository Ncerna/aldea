<?php
class DirectoryStrategy {
    public function createDirectory(string $path): bool {
        if (!is_dir($path)) {
            return mkdir($path, 0777, true);
        }
        return true;
    }

    public function setPermissions(string $path): bool {
        return chmod($path, 0777);
    }
}