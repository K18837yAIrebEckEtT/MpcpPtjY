<?php
// 代码生成时间: 2025-10-01 19:55:09
class DataCompressionTool {

    /**
     * 压缩数据
     *
     * @param string $data 需要压缩的数据
     * @param string $algorithm 压缩算法（例如 'gzip' 或 'zlib'）
     * @return string|null 压缩后的数据，或者在失败时返回null
     */
    public function compress($data, $algorithm = 'gzip') {
        if (!extension_loaded('zlib')) {
            throw new Exception('Zlib extension is not loaded.');
        }

        switch ($algorithm) {
            case 'gzip':
                return gzencode($data);
            case 'zlib':
                return zlib_encode($data, ZLIB_ENCODING_DEFLATE);
            default:
                throw new InvalidArgumentException('Unsupported compression algorithm.');
        }
    }

    /**
     * 解压数据
     *
     * @param string $data 需要解压的数据
     * @param string $algorithm 压缩算法（例如 'gzip' 或 'zlib'）
     * @return string 原始数据，或者在失败时返回空字符串
     */
    public function decompress($data, $algorithm = 'gzip') {
        if (!extension_loaded('zlib')) {
            throw new Exception('Zlib extension is not loaded.');
        }

        switch ($algorithm) {
            case 'gzip':
                return gzdecode($data);
            case 'zlib':
                $result = zlib_decode($data, ZLIB_ENCODING_DEFLATE);
                if ($result === false) {
                    throw new Exception('Decompression failed.');
                }
                return $result;
            default:
                throw new InvalidArgumentException('Unsupported compression algorithm.');
        }
    }
}

// 使用示例
try {
    $tool = new DataCompressionTool();

    // 压缩数据
    $originalData = 'Hello, World!';
    $compressedData = $tool->compress($originalData);
    echo "Compressed: " . strlen($compressedData) . " bytes
";

    // 解压数据
    $decompressedData = $tool->decompress($compressedData);
    echo "Decompressed: $decompressedData
";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "
";
}
