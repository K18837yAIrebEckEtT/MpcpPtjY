<?php
// 代码生成时间: 2025-08-06 01:38:43
// URLValidator.php
// 该类用于验证URL链接的有效性

class URLValidator {
    // 验证URL的方法
    public function validateURL($url) {
        // 检查URL是否为空
        if (empty($url)) {
            throw new InvalidArgumentException('URL cannot be empty.');
        }

        // 使用filter_var函数和FILTER_VALIDATE_URL验证URL
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            // 如果URL无效，抛出异常
            throw new InvalidArgumentException('Invalid URL.');
        }

        // 检查URL是否可访问
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true); // 设置为不下载数据，仅检查HTTP头部
        curl_setopt($ch, CURLOPT_FAILONERROR, true); // 遇到错误时不输出，只返回错误码
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 返回结果不直接输出
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // 设置超时时间
        $result = curl_exec($ch); // 执行CURL会话
        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // 获取HTTP状态码
        curl_close($ch); // 关闭CURL会话

        // 如果状态码不是200，抛出异常
        if ($httpStatusCode != 200) {
            throw new InvalidArgumentException('URL is not accessible.');
        }

        // 如果一切检查通过，返回真
        return true;
    }
}
