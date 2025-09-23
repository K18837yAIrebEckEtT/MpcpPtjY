<?php
// 代码生成时间: 2025-09-24 00:52:30
class MathTool {

    /**
     * Add two numbers
     *
     * @param float $a
     * @param float $b
     * @return float
     * @throws InvalidArgumentException
     */
    public function add($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new InvalidArgumentException('Both parameters must be numbers.');
        }

        return $a + $b;
    }

    /**
     * Subtract one number from another
     *
     * @param float $a
     * @param float $b
     * @return float
     * @throws InvalidArgumentException
     */
    public function subtract($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new InvalidArgumentException('Both parameters must be numbers.');
        }

        return $a - $b;
    }

    /**
     * Multiply two numbers
     *
     * @param float $a
     * @param float $b
     * @return float
     * @throws InvalidArgumentException
     */
    public function multiply($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new InvalidArgumentException('Both parameters must be numbers.');
        }

        return $a * $b;
    }

    /**
     * Divide one number by another
     *
     * @param float $a
     * @param float $b
     * @return float
     * @throws InvalidArgumentException
     */
    public function divide($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new InvalidArgumentException('Both parameters must be numbers.');
        }

        if ($b == 0) {
            throw new InvalidArgumentException('Cannot divide by zero.');
        }

        return $a / $b;
    }

    /**
     * Calculate the power of a number
     *
     * @param float $base
     * @param float $exponent
     * @return float
     * @throws InvalidArgumentException
     */
    public function power($base, $exponent) {
        if (!is_numeric($base) || !is_numeric($exponent)) {
            throw new InvalidArgumentException('Both parameters must be numbers.');
        }

        return pow($base, $exponent);
    }

    /**
     * Calculate the square root of a number
     *
     * @param float $number
     * @return float
     * @throws InvalidArgumentException
     */
    public function squareRoot($number) {
        if (!is_numeric($number)) {
            throw new InvalidArgumentException('Parameter must be a number.');
        }

        if ($number < 0) {
            throw new InvalidArgumentException('Cannot calculate the square root of a negative number.');
        }

        return sqrt($number);
    }
}
