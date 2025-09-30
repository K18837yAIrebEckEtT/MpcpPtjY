<?php
// 代码生成时间: 2025-09-30 19:17:07
class CdnContentDelivery {
    /**
     * @var array $cdnUrls 存储CDN资源的URL列表
     */
    private $cdnUrls = [];

    /**
     * 构造函数，初始化CDN资源URL列表
     *
     * @param array $cdnUrls CDN资源URL列表
     */
    public function __construct($cdnUrls = []) {
        $this->cdnUrls = $cdnUrls;
    }

    /**
     * 获取CDN资源
     *
     * @param string $resourcePath 资源路径
     * @return mixed 获取到的资源内容，或者在失败时返回false
     */
    public function getCdnResource($resourcePath) {
        try {
            foreach ($this->cdnUrls as $url) {
                $fullUrl = $url . $resourcePath;
                $response = $this->fetchResource($fullUrl);

                if ($response !== false) {
                    return $response;
                }
            }

            // 如果所有CDN资源都失败，则抛出异常
            throw new Exception("Unable to fetch resource from CDN.");

        } catch (Exception $e) {
            // 错误处理
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * 从给定的URL获取资源
     *
     * @param string $url 资源的完整URL
     * @return mixed 获取到的资源内容，或者在失败时返回false
     */
    private function fetchResource($url) {
        // 使用cURL或其他HTTP客户端获取资源
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            error_log("cURL error: " . $error);
            return false;
        } else {
            return $response;
        }
    }

    /**
     * 添加CDN资源URL到列表
     *
     * @param string $url CDN资源的URL
     */
    public function addCdnUrl($url) {
        $this->cdnUrls[] = $url;
    }

    /**
     * 获取CDN资源URL列表
     *
     * @return array CDN资源URL列表
     */
    public function getCdnUrls() {
        return $this->cdnUrls;
    }
}
