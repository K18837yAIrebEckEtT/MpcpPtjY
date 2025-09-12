<?php
// 代码生成时间: 2025-09-13 06:30:50
class DataBackupRestore {
    /**
     * 备份数据库
     *
     * @param string $dbConfig 数据库配置
     * @param string $backupFile 备份文件路径
     * @return bool
     */
    public function backupDatabase($dbConfig, $backupFile) {
        try {
            // 连接数据库
            $connection = new PDO("mysql:host=" . $dbConfig['host'] . ";dbname=" . $dbConfig['dbname'], $dbConfig['username'], $dbConfig['password']);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 创建备份文件
            $dump = 'mysqldump ' .
                    '--user=' . escapeshellarg($dbConfig['username']) . ' ' .
                    '--password=' . escapeshellarg($dbConfig['password']) . ' ' .
                    '--host=' . escapeshellarg($dbConfig['host']) . ' ' .
                    escapeshellarg($dbConfig['dbname']) . ' > ' . escapeshellarg($backupFile);

            // 执行备份
            exec($dump);

            return true;
        } catch (Exception $e) {
            // 错误处理
            error_log("Backup error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * 恢复数据库
     *
     * @param string $dbConfig 数据库配置
     * @param string $backupFile 备份文件路径
     * @return bool
     */
    public function restoreDatabase($dbConfig, $backupFile) {
        try {
            // 连接数据库
            $connection = new PDO("mysql:host=" . $dbConfig['host'] . ";dbname=" . $dbConfig['dbname'], $dbConfig['username'], $dbConfig['password']);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 恢复备份文件
            $restore = 'mysql -u ' . escapeshellarg($dbConfig['username']) . ' ' .
                      '-p' . escapeshellarg($dbConfig['password']) . ' ' .
                      '-h ' . escapeshellarg($dbConfig['host']) . ' ' .
                      escapeshellarg($dbConfig['dbname']) . ' < ' . escapeshellarg($backupFile);

            // 执行恢复
            exec($restore);

            return true;
        } catch (Exception $e) {
            // 错误处理
            error_log("Restore error: " . $e->getMessage());
            return false;
        }
    }
}
