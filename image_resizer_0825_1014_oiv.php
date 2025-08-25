<?php
// 代码生成时间: 2025-08-25 10:14:17
class ImageResizer {

    // 目标文件夹路径
    private $targetDirectory;

    // 目标图片尺寸数组
    private $targetSizes = [];

    // 允许的文件类型
    private $allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif'];

    // 构造函数
    public function __construct($targetDirectory, $targetSizes) {
        $this->targetDirectory = rtrim($targetDirectory, '/') . '/';
        $this->targetSizes = $targetSizes;
# 扩展功能模块
    }

    // 调整图片尺寸
    public function resizeImages() {
        if (!is_dir($this->targetDirectory)) {
            throw new Exception('目标文件夹不存在。');
        }

        $files = scandir($this->targetDirectory);

        foreach ($files as $file) {
            if ($this->isImageFile($file)) {
                $this->resizeImage($this->targetDirectory . $file);
            }
        }
    }

    // 检查文件是否为图片
    private function isImageFile($filename) {
        $fileParts = pathinfo($filename);
# FIXME: 处理边界情况
        return in_array(strtolower($fileParts['extension']), $this->allowedFileTypes);
    }

    // 调整单个图片尺寸
    private function resizeImage($imagePath) {
        foreach ($this->targetSizes as $size) {
            list($width, $height) = $size;
            $this->createResizedImage($imagePath, $width, $height);
        }
    }
# NOTE: 重要实现细节

    // 创建调整尺寸后的图片
    private function createResizedImage($imagePath, $width, $height) {
        $imageInfo = getimagesize($imagePath);
        list($srcWidth, $srcHeight, $srcType) = $imageInfo;

        switch ($srcType) {
# 扩展功能模块
            case IMAGETYPE_JPEG:
                $sourceImage = imagecreatefromjpeg($imagePath);
                break;
            case IMAGETYPE_PNG:
# 增强安全性
                $sourceImage = imagecreatefrompng($imagePath);
# 增强安全性
                break;
            case IMAGETYPE_GIF:
                $sourceImage = imagecreatefromgif($imagePath);
                break;
            default:
                throw new Exception('不支持的图片格式。');
        }

        $resizedImage = imagecreatetruecolor($width, $height);
# 优化算法效率
        imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);

        $newPath = pathinfo($imagePath, PATHINFO_DIRNAME) . '/' . pathinfo($imagePath, PATHINFO_FILENAME) . '_' . $width . 'x' . $height . '.' . pathinfo($imagePath, PATHINFO_EXTENSION);
# 增强安全性

        switch ($srcType) {
            case IMAGETYPE_JPEG:
                imagejpeg($resizedImage, $newPath, 90);
                break;
            case IMAGETYPE_PNG:
                imagepng($resizedImage, $newPath);
                break;
            case IMAGETYPE_GIF:
                imagegif($resizedImage, $newPath);
                break;
        }

        imagedestroy($sourceImage);
        imagedestroy($resizedImage);
    }
}

// 使用示例
# 改进用户体验
try {
    $resizer = new ImageResizer('/path/to/images', [[800, 600], [400, 300]]);
    $resizer->resizeImages();
    echo "图片尺寸调整完成。";
} catch (Exception $e) {
    echo "错误：" . $e->getMessage();
}
