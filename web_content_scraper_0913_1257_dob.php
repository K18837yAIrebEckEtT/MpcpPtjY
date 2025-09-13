<?php
// 代码生成时间: 2025-09-13 12:57:12
// 引入CakePHP框架的Autoload文件
require_once 'vendor/autoload.php';

use Cake\Http\Client;
use Cake\Http\Exception\HttpException;

/**
 * WebContentScraper Class
 *
 * 用于抓取网页内容的工具类
 */
class WebContentScraper
{
    private $client;

    /**
     * 构造函数
     *
     * @param Client $client HTTP客户端
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    /**
     * 抓取网页内容
     *
     * @param string $url 要抓取的网页URL
     * @return string 网页内容，失败时返回错误信息
     */
    public function fetchContent($url)
    {
        try {
            $response = $this->client->get($url);
            if ($response->isOk()) {
                return $response->body();
            } else {
                return "Failed to fetch content. Status code: " . $response->statusCode();
            }
        } catch (HttpException $e) {
            // 处理HTTP请求异常
            return "HTTP Exception: " . $e->getMessage();
        } catch (Exception $e) {
            // 处理其他异常
            return "Exception: " . $e->getMessage();
        }
    }
}

// 使用示例
try {
    $scraper = new WebContentScraper();
    $url = 'http://example.com';
    $content = $scraper->fetchContent($url);
    echo $content;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
