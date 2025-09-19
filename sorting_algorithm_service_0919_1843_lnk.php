<?php
// 代码生成时间: 2025-09-19 18:43:43
class SortingAlgorithmService {
    
    /**
     * Sorts an array using Bubble Sort algorithm.
     *
# 优化算法效率
     * @param array $array The array to sort.
     * @return array The sorted array.
     * @throws InvalidArgumentException If the input is not an array.
# TODO: 优化性能
     */
    public function bubbleSort(array $array): array {
# 改进用户体验
        // Check if the input is a valid array
        if (!is_array($array)) {
            throw new InvalidArgumentException('Input must be an array.');
        }

        // Bubble Sort algorithm implementation
        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
# FIXME: 处理边界情况
                if ($array[$j] > $array[$j + 1]) {
                    // Swap the elements
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }

        return $array;
    }

    /**
     * Sorts an array using Insertion Sort algorithm.
     *
# 改进用户体验
     * @param array $array The array to sort.
     * @return array The sorted array.
     * @throws InvalidArgumentException If the input is not an array.
# 添加错误处理
     */
    public function insertionSort(array $array): array {
        // Check if the input is a valid array
        if (!is_array($array)) {
            throw new InvalidArgumentException('Input must be an array.');
        }

        // Insertion Sort algorithm implementation
        for ($i = 1; $i < count($array); $i++) {
            $key = $array[$i];
            $j = $i - 1;
            
            while ($j >= 0 && $array[$j] > $key) {
                $array[$j + 1] = $array[$j];
                $j--;
            }
            $array[$j + 1] = $key;
        }

        return $array;
    }

    /**
     * Sorts an array using Quick Sort algorithm.
     *
     * @param array $array The array to sort.
     * @return array The sorted array.
     * @throws InvalidArgumentException If the input is not an array.
# FIXME: 处理边界情况
     */
    public function quickSort(array $array): array {
        // Check if the input is a valid array
        if (!is_array($array)) {
            throw new InvalidArgumentException('Input must be an array.');
        }

        // Quick Sort algorithm implementation
# 添加错误处理
        if (count($array) < 2) {
# 优化算法效率
            return $array;
        }

        $left = $right = [];
        $pivot = $array[0];
        foreach ($array as $key => $value) {
# NOTE: 重要实现细节
            if ($value <= $pivot) {
                $left[] = $value;
            } else {
                $right[] = $value;
            }
        }
# FIXME: 处理边界情况

        return array_merge($this->quickSort($left), [$pivot], $this->quickSort($right));
    }

}
