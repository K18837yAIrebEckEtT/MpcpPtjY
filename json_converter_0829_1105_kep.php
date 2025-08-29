<?php
// 代码生成时间: 2025-08-29 11:05:45
class JsonConverter {

    /**
     * 将JSON字符串转换为PHP数组
     *
     * @param string $jsonString JSON字符串
     * @return array|false PHP数组或在错误时返回false
     */
    public function decodeJsonString($jsonString) {
        try {
            // 检查JSON字符串是否有效
            if (!is_string($jsonString) || !json_last_error() === JSON_ERROR_NONE) {
                throw new InvalidArgumentException('Invalid JSON string');
            }

            // 将JSON字符串解码为PHP数组
            return json_decode($jsonString, true);
        } catch (Exception $e) {
            // 错误处理
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * 将PHP数组转换为JSON字符串
     *
     * @param array $phpArray PHP数组
     * @param int $options JSON编码选项
     * @return string|false JSON字符串或在错误时返回false
     */
    public function encodePhpArray($phpArray, $options = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) {
        try {
            // 检查PHP数组是否有效
            if (!is_array($phpArray)) {
                throw new InvalidArgumentException('Invalid PHP array');
            }

            // 将PHP数组编码为JSON字符串
            return json_encode($phpArray, $options);
        } catch (Exception $e) {
            // 错误处理
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * 测试JSON数据格式转换器
     */
    public function test() {
        // 示例JSON字符串
        $jsonString = "{"name": "John", "age": 30}";

        // 将JSON字符串转换为PHP数组
        $phpArray = $this->decodeJsonString($jsonString);
        if ($phpArray !== false) {
            echo "Decoded PHP Array: 
";
            print_r($phpArray);
        } else {
            echo "Failed to decode JSON string";
        }

        // 将PHP数组转换为JSON字符串
        $jsonString = $this->encodePhpArray($phpArray);
        if ($jsonString !== false) {
            echo "Encoded JSON String: 
" . $jsonString;
        } else {
            echo "Failed to encode PHP array";
        }
    }
}

// 创建JSON数据格式转换器实例
$jsonConverter = new JsonConverter();

// 运行测试
$jsonConverter->test();