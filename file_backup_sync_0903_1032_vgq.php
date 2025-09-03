<?php
// 代码生成时间: 2025-09-03 10:32:54
// 引入CakePHP框架基础文件
require_once 'vendor/autoload.php';

use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Core\Error;
use Cake\Log\Log;

class FileBackupSync {

    /**
     * 备份文件到指定目录
     *
     * @param string $sourcePath 源文件路径
     * @param string $destinationPath 目标备份目录
     * @return bool
     */
    public function backupFile($sourcePath, $destinationPath) {
        if (!file_exists($sourcePath)) {
            Log::error("Source file not found: {$sourcePath}");
            return false;
        }

        $backupPath = $destinationPath . '/' . basename($sourcePath);

        if (!copy($sourcePath, $backupPath)) {
            Log::error("Failed to backup file: {$backupPath}");
            return false;
        }

        Log::write('info', "File backed up successfully: {$backupPath}");
        return true;
    }

    /**
     * 同步文件到指定目录
     *
     * @param string $sourcePath 源目录路径
     * @param string $destinationPath 目标目录路径
     * @return bool
     */
    public function syncFiles($sourcePath, $destinationPath) {
        if (!is_dir($sourcePath) || !is_dir($destinationPath)) {
            Log::error("Source or destination path is not a directory");
            return false;
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($sourcePath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            $targetPath = $destinationPath . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
            if ($item->isDir()) {
                if (!file_exists($targetPath) && !mkdir($targetPath, 0777, true)) {
                    Log::error("Failed to create directory: {$targetPath}");
                    return false;
                }
            } else {
                if (!copy($item, $targetPath)) {
                    Log::error("Failed to sync file: {$targetPath}");
                    return false;
                }
            }
        }

        Log::write('info', "Files synced successfully");
        return true;
    }
}

// 使用示例
$fileBackupSync = new FileBackupSync();

// 备份单个文件
$sourceFile = 'path/to/source/file.txt';
$backupDir = 'path/to/backup/directory';
$fileBackupSync->backupFile($sourceFile, $backupDir);

// 同步目录
$sourceDir = 'path/to/source/directory';
$destinationDir = 'path/to/destination/directory';
$fileBackupSync->syncFiles($sourceDir, $destinationDir);
