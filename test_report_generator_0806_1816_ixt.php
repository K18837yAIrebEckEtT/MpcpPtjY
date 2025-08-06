<?php
// 代码生成时间: 2025-08-06 18:16:36
// TestReportGenerator.php
// 测试报告生成器类

use Cake\View\Helper\HtmlHelper;
use Cake\View\Helper\TextHelper;
use Cake\I18n\Time;

class TestReportGenerator {
    private $html;
    private $text;
    private $date;
    
    // 构造函数
    public function __construct() {
        $this->html = new HtmlHelper();
        $this->text = new TextHelper();
        $this->date = new Time();
    }
    
    // 生成测试报告HTML
    public function generateReportHtml($data) {
        try {
            // 验证数据
            if (empty($data)) {
                throw new Exception('No data provided for report generation.');
            }
            
            // 开始HTML报告
            $html = '<h1>Test Report</h1>';
            $html .= '<p>Date: ' . $this->date->format('Y-m-d H:i:s') . '</p>';
            $html .= '<table border="1">';
            $html .= '<tr><th>ID</th><th>Name</th><th>Result</th></tr>';
            
            foreach ($data as $test) {
                $html .= '<tr>';
                $html .= '<td>' . $this->html->escape($test['id']) . '</td>';
                $html .= '<td>' . $this->html->escape($test['name']) . '</td>';
                $html .= '<td>' . $this->html->escape($test['result']) . '</td>';
                $html .= '</tr>';
            }
            
            $html .= '</table>';
            
            return $html;
        } catch (Exception $e) {
            // 错误处理
            return $this->html->error('Failed to generate report: ' . $e->getMessage());
        }
    }
    
    // 生成测试报告文本
    public function generateReportText($data) {
        try {
            // 验证数据
            if (empty($data)) {
                throw new Exception('No data provided for report generation.');
            }
            
            $text = 'Test Report' . PHP_EOL;
            $text .= 'Date: ' . $this->date->format('Y-m-d H:i:s') . PHP_EOL;
            $text .= 'ID | Name | Result' . PHP_EOL;
            $text .= '--- | --- | ---' . PHP_EOL;
            
            foreach ($data as $test) {
                $text .= $this->text->wrap($test['id'], 5) . ' | ' . 
                    $this->text->wrap($test['name'], 20) . ' | ' . 
                    $this->text->wrap($test['result'], 10) . PHP_EOL;
            }
            
            return $text;
        } catch (Exception $e) {
            // 错误处理
            return 'Failed to generate report: ' . $e->getMessage();
        }
    }
}
