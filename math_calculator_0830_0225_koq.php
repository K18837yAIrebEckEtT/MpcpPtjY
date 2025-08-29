<?php
// 代码生成时间: 2025-08-30 02:25:37
// 文件名: math_calculator.php
// 功能描述：一个数学计算工具集，包含加、减、乘、除基础运算功能

class MathCalculator {

    /**
     * 加法运算
     * @param float $a 第一个加数
     * @param float $b 第二个加数
     * @return float 两数之和
     */
    public function add($a, $b) {
        return $a + $b;
    }

    /**
     * 减法运算
     * @param float $a 被减数
     * @param float $b 减数
     * @return float 两数之差
     */
    public function subtract($a, $b) {
        return $a - $b;
    }

    /**
     * 乘法运算
     * @param float $a 被乘数
     * @param float $b 乘数
     * @return float 两数之积
     */
    public function multiply($a, $b) {
        return $a * $b;
    }

    /**
     * 除法运算
     * @param float $a 被除数
     * @param float $b 除数
     * @return float|bool 两数之商，如果除数为零返回false
     */
    public function divide($a, $b) {
        if ($b == 0) {
            throw new InvalidArgumentException('除数不能为零');
        }
        return $a / $b;
    }

    /**
     * 指数运算
     * @param float $base 底数
     * @param float $exp 指数
     * @return float 幂运算结果
     */
    public function pow($base, $exp) {
        return $base ** $exp;
    }

    /**
     * 平方根运算
     * @param float $num 数字
     * @return float 平方根结果
     */
    public function sqrt($num) {
        if ($num < 0) {
            throw new InvalidArgumentException('负数没有实数平方根');
        }
        return sqrt($num);
    }

}

// 使用示例
try {
    $calculator = new MathCalculator();
    echo '5 + 3 = ' . $calculator->add(5, 3) . "\
";
    echo '10 - 2 = ' . $calculator->subtract(10, 2) . "\
";
    echo '4 * 3 = ' . $calculator->multiply(4, 3) . "\
";
    echo '8 / 2 = ' . $calculator->divide(8, 2) . "\
";
    echo '2^3 = ' . $calculator->pow(2, 3) . "\
";
    echo 'sqrt(9) = ' . $calculator->sqrt(9) . "\
";
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
