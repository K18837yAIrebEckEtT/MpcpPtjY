<?php
// 代码生成时间: 2025-08-05 02:42:56
// ImageResizer.php
// 这是一个使用PHP和CAKEPHP框架实现的图片尺寸批量调整器

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Imagick\Imagick;
use Imagine\Image\Metadata\ExifMetadataReader;
use Imagine\Exception\RuntimeException;

class ImageResizer {
    // 定义源目录和目标目录
    private $sourceDir;
    private $targetDir;
    private $resizeOptions;
    private $imagine;
    private $metadataReader;

    public function __construct($sourceDir, $targetDir, $resizeOptions) {
        $this->sourceDir = $sourceDir;
        $this->targetDir = $targetDir;
        $this->resizeOptions = $resizeOptions;
        $this->imagine = new Imagine();
        $this->metadataReader = new ExifMetadataReader();
    }

    // 调整图片尺寸
    public function resizeImages() {
        $folder = new Folder($this->sourceDir);
        $files = $folder->findRecursive('.*\.(jpg|jpeg|png|gif)$', true);

        foreach ($files as $file) {
            $file = new File($this->sourceDir . DS . $file);
            try {
                $image = $this->imagine->open($file->path);
                $metadata = $this->metadataReader->read($image->get('jpeg') ? $image->get('jpeg') : null);
                $image->resize(new Box($this->resizeOptions['width'], $this->resizeOptions['height']));
                $image->save($this->targetDir . DS . $file->name);
            } catch (RuntimeException $e) {
                // 错误处理
                error_log('Error resizing image: ' . $e->getMessage());
            }
        }
    }
}

// 使用示例
$sourceDir = '/path/to/source/directory';
$targetDir = '/path/to/target/directory';
$resizeOptions = ['width' => 800, 'height' => 600];
$imageResizer = new ImageResizer($sourceDir, $targetDir, $resizeOptions);
$imageResizer->resizeImages();