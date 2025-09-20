<?php
// 代码生成时间: 2025-09-20 16:03:11
// ApiResponseFormatter.php
// 这个类用于格式化API响应

class ApiResponseFormatter {

    private $data;
    private $errors;
    private $status;
    private $message;

    // 构造函数，初始化响应数据
    public function __construct($data = null, $errors = [], $status = 200, $message = 'Success') {
        $this->data = $data;
        $this->errors = $errors;
        $this->status = $status;
        $this->message = $message;
    }

    // 设置响应数据
    public function setData($data) {
        $this->data = $data;
    }

    // 设置错误信息
    public function setErrors($errors) {
        $this->errors = $errors;
    }

    // 设置响应状态码
    public function setStatus($status) {
        $this->status = $status;
    }

    // 设置响应消息
    public function setMessage($message) {
        $this->message = $message;
    }

    // 格式化响应数据
    public function format() {
        $response = [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
            'errors' => $this->errors
        ];

        // 检查是否有错误
        if (!empty($this->errors)) {
            $this->status = 400;
            $this->message = 'Validation errors';
        }

        // 返回JSON响应
        return json_encode($response);
    }

    // 响应数据输出（HTTP响应）
    public function sendResponse() {
        header('Content-Type: application/json');
        http_response_code($this->status);
        echo $this->format();
    }
}
