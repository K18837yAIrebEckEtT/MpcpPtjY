<?php
// 代码生成时间: 2025-08-21 23:58:33
require 'vendor/autoload.php';

use Cake\Http\Client;
use Cake\Http\Exception\HttpException;
use Cake\Http\Exception\ConnectionException;

class WebContentScraper {

    /**
     * Fetches the content of a webpage.
     *
     * @param string $url The URL of the webpage to scrape.
     * @return string The content of the webpage or an error message.
     */
    public function fetchWebContent(string $url): string {
        try {
            $client = new Client();
            $response = $client->get($url);
            if (!$response->isOk()) {
                throw new Exception('Failed to retrieve content: HTTP error');
            }
            return $response->body();
        } catch (HttpException \$e) {
            return 'HTTP Exception: ' . \$e->getMessage();
        } catch (ConnectionException \$e) {
            return 'Connection Exception: ' . \$e->getMessage();
        } catch (Exception \$e) {
            return 'General Exception: ' . \$e->getMessage();
        }
    }
}

// Example usage:
\$scraper = new WebContentScraper();
\$url = 'http://example.com';
\$content = \$scraper->fetchWebContent(\$url);
echo \$content;
