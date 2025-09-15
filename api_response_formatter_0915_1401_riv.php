<?php
// 代码生成时间: 2025-09-15 14:01:57
// ApiResponseFormatter.php
// 这个类是一个API响应格式化工具，用于帮助格式化和构建API响应。

class ApiResponseFormatter {
    // 构造函数
    public function __construct() {
        // 初始化任何必要的配置或设置
    }

    // 格式化API响应方法
    // @param mixed $data 要发送的数据
    // @param int $statusCode HTTP状态码
    // @param string $message 响应消息
    // @return array 格式化后的响应数组
    public function formatResponse($data, $statusCode, $message) {
        try {
            // 检查状态码是否有效
            if (!$this->isValidStatusCode($statusCode)) {
                throw new InvalidArgumentException('Invalid status code provided.');
            }

            // 构建响应数组
            $response = [
                'status' => 'success',
                'code' => $statusCode,
                'message' => $message,
                'data' => $data
            ];

            return $response;
        } catch (Exception $e) {
            // 处理异常并返回错误响应
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    // 格式化错误响应方法
    // @param string $errorMessage 错误消息
    // @param int $statusCode HTTP状态码
    // @return array 错误响应数组
    public function ErrorResponse($errorMessage, $statusCode) {
        return [
            'status' => 'error',
            'code' => $statusCode,
            'message' => $errorMessage,
            'data' => null
        ];
    }

    // 检查HTTP状态码是否有效
    // @param int $statusCode HTTP状态码
    // @return bool 状态码是否有效
    private function isValidStatusCode($statusCode) {
        // 这里可以添加更多的状态码验证逻辑
        return in_array($statusCode, [200, 400, 404, 500]);
    }
}

// 使用示例
// $formatter = new ApiResponseFormatter();
// $response = $formatter->formatResponse(['name' => 'John Doe'], 200, 'Data retrieved successfully');
// print_r($response);
