<?php
// 代码生成时间: 2025-09-10 11:35:02
class ImageResizeBatchProcessor {

    /**
     * @var string 源图片文件夹路径
     */
    private $sourceDir;

    /**
     * @var string 目标图片文件夹路径
     */
    private $targetDir;

    /**
     * @var array 目标图片尺寸
     */
    private $targetSizes;

    public function __construct($sourceDir, $targetDir, $targetSizes) {
        $this->sourceDir = $sourceDir;
        $this->targetDir = $targetDir;
        $this->targetSizes = $targetSizes;
    }

    /**
     * 批量调整图片尺寸
     *
     * @return boolean
     */
    public function process() {
        if (!file_exists($this->sourceDir) || !is_dir($this->sourceDir)) {
            // 错误处理：源目录不存在
            throw new Exception("Source directory does not exist.");
        }

        if (!file_exists($this->targetDir)) {
            // 创建目标目录
            mkdir($this->targetDir, 0777, true);
        }

        // 遍历源目录中的所有图片文件
        $files = scandir($this->sourceDir);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                $this->resizeImage($file);
            }
        }

        return true;
    }

    /**
     * 调整单个图片尺寸
     *
     * @param string $filename
     */
    private function resizeImage($filename) {
        $sourcePath = $this->sourceDir . '/' . $filename;
        $info = getimagesize($sourcePath);

        foreach ($this->targetSizes as $size) {
            list($width, $height) = $size;
            $targetPath = $this->targetDir . '/' . pathinfo($filename, PATHINFO_FILENAME) . '-' . $width . 'x' . $height . '.' . pathinfo($filename, PATHINFO_EXTENSION);

            // 根据图片类型创建不同的图像资源
            $image = $this->createImageResource($sourcePath, $info[2]);
            $this->resize($image, $width, $height, $targetPath);
            imagedestroy($image);
        }
    }

    /**
     * 根据图片类型创建图像资源
     *
     * @param string $sourcePath
     * @param int $imageType
     * @return resource
     */
    private function createImageResource($sourcePath, $imageType) {
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                return imagecreatefromjpeg($sourcePath);
            case IMAGETYPE_PNG:
                return imagecreatefrompng($sourcePath);
            case IMAGETYPE_GIF:
                return imagecreatefromgif($sourcePath);
            default:
                throw new Exception("Unsupported image type.");
        }
    }

    /**
     * 调整图片尺寸
     *
     * @param resource $image
     * @param int $newWidth
     * @param int $newHeight
     * @param string $targetPath
     */
    private function resize($image, $newWidth, $newHeight, $targetPath) {
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($image), imagesy($image));

        // 保存调整后的图片
        switch (pathinfo($targetPath, PATHINFO_EXTENSION)) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($resizedImage, $targetPath, 100);
                break;
            case 'png':
                imagepng($resizedImage, $targetPath, 9);
                break;
            case 'gif':
                imagegif($resizedImage, $targetPath);
                break;
            default:
                throw new Exception("Unsupported image type.");
        }
    }
}

// 使用示例
try {
    $sourceDir = '/path/to/source/images';
    $targetDir = '/path/to/target/images';
    $targetSizes = [[800, 600], [400, 300]];
    $processor = new ImageResizeBatchProcessor($sourceDir, $targetDir, $targetSizes);
    $processor->process();
    echo 'Images resized successfully.';
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
