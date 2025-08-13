<?php
// 代码生成时间: 2025-08-13 08:29:14
// DataAnalyzer.php
// 这是一个数据分析器类，用于处理和分析数据。

class DataAnalyzer {
    // 成员变量，用于存储数据
    private $data;

    // 构造函数，用于初始化数据分析器
    public function __construct($data) {
        // 检查传入的数据是否有效
        if (!is_array($data)) {
            throw new InvalidArgumentException('数据必须是数组类型');
        }

        // 初始化数据
        $this->data = $data;
    }

    // 获取数据的方法
    public function getData() {
        return $this->data;
    }

    // 设置数据的方法
    public function setData($data) {
        if (!is_array($data)) {
            throw new InvalidArgumentException('数据必须是数组类型');
        }

        $this->data = $data;
    }

    // 计算数据的平均值
    public function calculateMean() {
        if (empty($this->data)) {
            throw new InvalidArgumentException('数据不能为空');
        }

        $sum = array_sum($this->data);
        $count = count($this->data);

        return $sum / $count;
    }

    // 计算数据的标准差
    public function calculateStandardDeviation() {
        if (empty($this->data)) {
            throw new InvalidArgumentException('数据不能为空');
        }

        $mean = $this->calculateMean();
        $variance = 0;

        foreach ($this->data as $value) {
            $variance += pow($value - $mean, 2);
        }

        $variance /= count($this->data);

        return sqrt($variance);
    }

    // 输出数据的直方图
    public function generateHistogram() {
        if (empty($this->data)) {
            throw new InvalidArgumentException('数据不能为空');
        }

        $histogram = array_count_values($this->data);
        $maxCount = max($histogram);
        $maxBarLength = 20;

        $graph = '';

        foreach ($histogram as $value => $count) {
            $barLength = ($count / $maxCount) * $maxBarLength;
            $bar = str_repeat('*', (int)$barLength) . str_repeat(' ', $maxBarLength - (int)$barLength);
            $graph .= "" . $value . ": [$bar] ($count)" . "
";
        }

        return $graph;
    }
}
