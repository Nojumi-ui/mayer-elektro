<?php
/**
 * FileHandler Klasse
 * Verwaltet Datei-Uploads, Validierung und sichere Speicherung
 */

class FileHandler {
    private $validator;
    
    public function __construct() {
        $this->validator = new Validator();
    }
    
    public function validateFiles($files) {
        $errors = [];
        $totalSize = 0;
        $fileCount = 0;
        
        foreach ($files as $fieldName => $file) {
            if (is_array($file['name'])) {
                // Multiple files in one field
                for ($i = 0; $i < count($file['name']); $i++) {
                    $singleFile = [
                        'name' => $file['name'][$i],
                        'type' => $file['type'][$i],
                        'tmp_name' => $file['tmp_name'][$i],
                        'error' => $file['error'][$i],
                        'size' => $file['size'][$i]
                    ];
                    
                    if ($singleFile['error'] === UPLOAD_ERR_NO_FILE) {
                        continue; // Skip empty files
                    }
                    
                    $fileErrors = $this->validator->validateFile($singleFile);
                    if (!empty($fileErrors)) {
                        $errors[] = "Datei {$fieldName}[{$i}] ({$singleFile['name']}): " . implode(', ', $fileErrors);
                    }
                    
                    $totalSize += $singleFile['size'];
                    $fileCount++;
                }
            } else {
                // Single file
                if ($file['error'] === UPLOAD_ERR_NO_FILE) {
                    continue; // Skip empty files
                }
                
                $fileErrors = $this->validator->validateFile($file);
                if (!empty($fileErrors)) {
                    $errors[] = "Datei {$fieldName} ({$file['name']}): " . implode(', ', $fileErrors);
                }
                
                $totalSize += $file['size'];
                $fileCount++;
            }
        }
        
        // Gesamtdateigröße prüfen
        if ($totalSize > MAX_TOTAL_SIZE) {
            $maxTotalMB = round(MAX_TOTAL_SIZE / 1024 / 1024, 2);
            $totalMB = round($totalSize / 1024 / 1024, 2);
            $errors[] = "Gesamtdateigröße überschreitet das Limit: {$totalMB}MB von {$maxTotalMB}MB";
        }
        
        // Anzahl Dateien prüfen
        if ($fileCount > MAX_FILES) {
            $errors[] = "Zu viele Dateien: {$fileCount} von maximal " . MAX_FILES;
        }
        
        return [
            'success' => empty($errors),
            'errors' => $errors,
            'total_size' => $totalSize,
            'file_count' => $fileCount
        ];
    }
    
    public function processFiles($files, $requestId) {
        $processedFiles = [];
        $totalSize = 0;
        
        foreach ($files as $fieldName => $file) {
            if (is_array($file['name'])) {
                // Multiple files in one field
                for ($i = 0; $i < count($file['name']); $i++) {
                    $singleFile = [
                        'name' => $file['name'][$i],
                        'type' => $file['type'][$i],
                        'tmp_name' => $file['tmp_name'][$i],
                        'error' => $file['error'][$i],
                        'size' => $file['size'][$i]
                    ];
                    
                    if ($singleFile['error'] === UPLOAD_ERR_NO_FILE) {
                        continue;
                    }
                    
                    $processed = $this->processSingleFile($singleFile, $fieldName . '_' . $i, $requestId);
                    if ($processed) {
                        $processedFiles[] = $processed;
                        $totalSize += $singleFile['size'];
                    }
                }
            } else {
                // Single file
                if ($file['error'] === UPLOAD_ERR_NO_FILE) {
                    continue;
                }
                
                $processed = $this->processSingleFile($file, $fieldName, $requestId);
                if ($processed) {
                    $processedFiles[] = $processed;
                    $totalSize += $file['size'];
                }
            }
        }
        
        return [
            'success' => !empty($processedFiles),
            'files' => $processedFiles,
            'total_size' => $totalSize,
            'message' => empty($processedFiles) ? 'Keine Dateien verarbeitet' : 'Dateien erfolgreich verarbeitet'
        ];
    }
    
    private function processSingleFile($file, $fieldName, $requestId) {
        // Sicheren Dateinamen generieren
        $secureFilename = $this->generateSecureFilename($file['name'], $requestId);
        $targetPath = UPLOAD_DIR . '/' . $secureFilename;
        
        // Datei verschieben
        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            error_log("Fehler beim Verschieben der Datei: {$file['name']} nach {$targetPath}");
            return null;
        }
        
        // Dateiberechtigungen setzen
        chmod($targetPath, 0644);
        
        return [
            'field_name' => $fieldName,
            'original_name' => $file['name'],
            'secure_filename' => $secureFilename,
            'path' => $targetPath,
            'size' => $file['size'],
            'mime_type' => $file['type'],
            'uploaded_at' => date('Y-m-d H:i:s')
        ];
    }
    
    private function generateSecureFilename($originalName, $requestId) {
        $timestamp = time();
        $randomString = bin2hex(random_bytes(4));
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $baseName = pathinfo($originalName, PATHINFO_FILENAME);
        
        // Dateiname bereinigen
        $baseName = preg_replace('/[^a-zA-Z0-9\-_]/', '_', $baseName);
        $baseName = substr($baseName, 0, 50);
        
        return "{$timestamp}-{$randomString}-{$requestId}-{$baseName}.{$extension}";
    }
    
    public function cleanupFiles($files) {
        foreach ($files as $fieldName => $file) {
            if (is_array($file['tmp_name'])) {
                // Multiple files
                foreach ($file['tmp_name'] as $tmpName) {
                    if (file_exists($tmpName)) {
                        unlink($tmpName);
                    }
                }
            } else {
                // Single file
                if (file_exists($file['tmp_name'])) {
                    unlink($file['tmp_name']);
                }
            }
        }
    }
    
    public function cleanupProcessedFiles($processedFiles) {
        foreach ($processedFiles as $file) {
            if (file_exists($file['path'])) {
                unlink($file['path']);
                error_log("Datei gelöscht: {$file['path']}");
            }
        }
    }
    
    public function getFileInfo($filePath) {
        if (!file_exists($filePath)) {
            return null;
        }
        
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $filePath);
        finfo_close($finfo);
        
        return [
            'path' => $filePath,
            'size' => filesize($filePath),
            'mime_type' => $mimeType,
            'modified' => filemtime($filePath),
            'readable' => is_readable($filePath)
        ];
    }
    
    public function deleteFile($filePath) {
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }
    
    public function cleanupOldFiles($maxAge = 86400) {
        // Dateien älter als $maxAge Sekunden löschen (default: 24 Stunden)
        $deleted = 0;
        $pattern = UPLOAD_DIR . '/*';
        
        foreach (glob($pattern) as $file) {
            if (is_file($file) && (time() - filemtime($file)) > $maxAge) {
                if (unlink($file)) {
                    $deleted++;
                    error_log("Alte Datei gelöscht: {$file}");
                }
            }
        }
        
        return $deleted;
    }
    
    public function getUploadStats() {
        $files = glob(UPLOAD_DIR . '/*');
        $totalSize = 0;
        $fileCount = 0;
        
        foreach ($files as $file) {
            if (is_file($file)) {
                $totalSize += filesize($file);
                $fileCount++;
            }
        }
        
        return [
            'file_count' => $fileCount,
            'total_size' => $totalSize,
            'total_size_mb' => round($totalSize / 1024 / 1024, 2),
            'upload_dir' => UPLOAD_DIR,
            'max_file_size' => MAX_FILE_SIZE,
            'max_total_size' => MAX_TOTAL_SIZE,
            'max_files' => MAX_FILES
        ];
    }
}