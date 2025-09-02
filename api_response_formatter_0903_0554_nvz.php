<?php
// 代码生成时间: 2025-09-03 05:54:19
// ApiResponseFormatter.php

class ApiResponseFormatter {
    private static $instance = null;
# 优化算法效率

    // 私有构造函数以防止直接实例化
    private function __construct() {}

    // 单例模式获取实例
    public static function getInstance() {
# 优化算法效率
        if (self::$instance === null) {
# 增强安全性
            self::$instance = new self();
        }
        return self::$instance;
    }

    // 格式化API响应
    public function formatResponse($data, $status = 'success', $code = 200) {
        // 检查数据是否有效
        if (!is_array($data)) {
            throw new InvalidArgumentException('Data must be an array.');
# 优化算法效率
        }

        // 构建响应体
        $response = [
# 优化算法效率
            'status' => $status,
            'code' => $code,
            'data' => $data
        ];

        // 返回格式化后的响应
        return json_encode($response);
    }

    // 错误处理函数
    public function formatError($message, $code = 400) {
        $response = [
            'status' => 'error',
            'code' => $code,
            'message' => $message
# NOTE: 重要实现细节
        ];
# 优化算法效率

        // 返回错误响应
        return json_encode($response);
    }
# 扩展功能模块
}
