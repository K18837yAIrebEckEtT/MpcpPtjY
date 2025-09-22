<?php
// 代码生成时间: 2025-09-22 15:25:03
// 文件备份和同步工具
// 使用 CakePHP 框架实现

// 引入 CakePHP 核心类
use Cake\Core\Configure;
use Cake\Utility\Folder;
use Cake\Utility\Hash;
use Cake\Network\Exception\InternalErrorException;
use Cake\Log\Log;
use Cake\Console\Shell;

class FileBackupSyncShell extends Shell {

    public function initialize() {
        // 初始化配置
        parent::initialize();
    }

    public function main() {
        // 显示欢迎信息
        $this->out('文件备份和同步工具启动...');

        // 获取用户输入的源目录和目标目录
        $sourceDir = $this->in('请输入源目录: ');
        $targetDir = $this->in('请输入目标目录: ');

        // 检查目录存在性
        if (!is_dir($sourceDir)) {
            $this->err('源目录不存在。');
            return $this->error();
        }

        if (!is_dir($targetDir)) {
            $this->err('目标目录不存在。');
            return $this->error();
        }

        try {
            // 执行备份和同步操作
            $this->backupAndSync($sourceDir, $targetDir);

            // 显示成功信息
            $this->out('文件备份和同步完成。');

        } catch (Exception $e) {
            // 处理异常
            $this->err('发生错误: ' . $e->getMessage());
            return $this->error();
        }
    }

    private function backupAndSync($sourceDir, $targetDir) {
        // 获取源目录文件列表
        $files = new Folder($sourceDir);
        $sourceFiles = $files->read(true, true);

        // 创建目标目录
        if (!is_dir($targetDir)) {
            new Folder($targetDir, true);
        }

        // 遍历源目录文件并进行备份和同步
        foreach ($sourceFiles[0] as $file) {
            $sourceFilePath = $sourceDir . DS . $file;
            $targetFilePath = $targetDir . DS . $file;

            // 检查文件是否存在
            if (!file_exists($targetFilePath)) {
                // 复制文件到目标目录
                copy($sourceFilePath, $targetFilePath);
                $this->out('文件 ' . $file . ' 已同步到目标目录。');
            } else {
                // 比较文件大小和修改时间
                $sourceSize = filesize($sourceFilePath);
                $sourceMtime = filemtime($sourceFilePath);
                $targetSize = filesize($targetFilePath);
                $targetMtime = filemtime($targetFilePath);

                if ($sourceSize != $targetSize || $sourceMtime > $targetMtime) {
                    // 复制文件到目标目录
                    copy($sourceFilePath, $targetFilePath);
                    $this->out('文件 ' . $file . ' 已更新并同步到目标目录。');
                } else {
                    $this->out('文件 ' . $file . ' 无需更新。');
                }
            }
        }
    }

    public function getOptionParser() {
        // 获取命令行参数
        $parser = parent::getOptionParser();
        $parser->setDescription('文件备份和同步工具');

        return $parser;
    }
}
