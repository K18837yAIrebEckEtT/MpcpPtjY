<?php
// 代码生成时间: 2025-10-12 03:31:26
class JsonConverter {

    /**
     * 将JSON字符串转换为PHP数组
     *
     * @param string $json JSON字符串
     * @return array|false 返回转换后的PHP数组，或在失败时返回false
     */
    public function decodeToArray($json) {
        try {
            $data = json_decode($json, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('JSON解码失败: ' . json_last_error_msg());
            }
            return $data;
        } catch (Exception $e) {
            // 错误处理
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * 将JSON字符串转换为PHP对象
     *
     * @param string $json JSON字符串
     * @return object|false 返回转换后的PHP对象，或在失败时返回false
     */
    public function decodeToObject($json) {
        try {
            $data = json_decode($json);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('JSON解码失败: ' . json_last_error_msg());
            }
            return $data;
        } catch (Exception $e) {
            // 错误处理
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * 将PHP数组或对象转换为JSON字符串
     *
     * @param mixed $data PHP数组或对象
     * @return string|false 返回转换后的JSON字符串，或在失败时返回false
     */
    public function encode($data) {
        try {
            $json = json_encode($data);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('JSON编码失败: ' . json_last_error_msg());
            }
            return $json;
        } catch (Exception $e) {
            // 错误处理
            error_log($e->getMessage());
            return false;
        }
    }
}

// 示例用法
$converter = new JsonConverter();

// 将JSON字符串转换为PHP数组
$jsonArray = $converter->decodeToArray('{"name":"John", "age":30}');
if ($jsonArray !== false) {
    print_r($jsonArray);
} else {
    echo 'JSON解码失败';
}

// 将JSON字符串转换为PHP对象
$jsonObject = $converter->decodeToObject('{"name":"John", "age":30}');
if ($jsonObject !== false) {
    print_r($jsonObject);
} else {
    echo 'JSON解码失败';
}

// 将PHP数组转换为JSON字符串
$phpArrayToJson = $converter->encode(['name' => 'John', 'age' => 30]);
if ($phpArrayToJson !== false) {
    echo $phpArrayToJson;
} else {
    echo 'JSON编码失败';
}