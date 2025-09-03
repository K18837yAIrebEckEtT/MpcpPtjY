<?php
// 代码生成时间: 2025-09-04 04:58:36
 * in a structured, maintainable, and extensible manner using PHP and CakePHP.
 */

// Load CakePHP's Autoloader
require 'vendor/autoload.php';

use Cake\Utility\Hash;

/**
 * Class SortAlgorithm
 *
 * Provides a set of methods to perform different sorting algorithms.
 */
class SortAlgorithm {
    /**
     * Performs bubble sort on an array
     *
     * @param array $array The array to sort
     * @return array The sorted array
     */
    public static function bubbleSort(array $array): array {
        for ($i = 0; $i < count($array); $i++) {
            for ($j = 0; $j < count($array) - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    // Swap elements if they are in the wrong order
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }
        return $array;
    }

    /**
     * Performs selection sort on an array
     *
     * @param array $array The array to sort
     * @return array The sorted array
     */
    public static function selectionSort(array $array): array {
        for ($i = 0; $i < count($array); $i++) {
            $minIndex = $i;
            for ($j = $i + 1; $j < count($array); $j++) {
                if ($array[$j] < $array[$minIndex]) {
                    $minIndex = $j;
                }
            }
            // Swap the found minimum element with the first element
            if ($minIndex != $i) {
                $temp = $array[$i];
                $array[$i] = $array[$minIndex];
                $array[$minIndex] = $temp;
            }
        }
        return $array;
    }

    /**
     * Performs insertion sort on an array
     *
     * @param array $array The array to sort
     * @return array The sorted array
     */
    public static function insertionSort(array $array): array {
        for ($i = 1; $i < count($array); $i++) {
            $key = $array[$i];
            $j = $i - 1;
            // Move elements of arr[0..i-1], that are greater than key, to one position ahead
            while ($j >= 0 && $array[$j] > $key) {
                $array[$j + 1] = $array[$j];
                $j = $j - 1;
            }
            $array[$j + 1] = $key;
        }
        return $array;
    }
}

/**
 * Example usage of sorting algorithms
 */
try {
    $unsortedArray = [64, 34, 25, 12, 22, 11, 90];
    $sortedArray = SortAlgorithm::bubbleSort($unsortedArray);
    echo "Sorted array using Bubble Sort: " . implode(", ", $sortedArray) . "\
";

    $unsortedArray = [64, 34, 25, 12, 22, 11, 90];
    $sortedArray = SortAlgorithm::selectionSort($unsortedArray);
    echo "Sorted array using Selection Sort: " . implode(", ", $sortedArray) . "\
";

    $unsortedArray = [64, 34, 25, 12, 22, 11, 90];
    $sortedArray = SortAlgorithm::insertionSort($unsortedArray);
    echo "Sorted array using Insertion Sort: " . implode(", ", $sortedArray) . "\
";
} catch (Exception $e) {
    // Handle any exceptions that may occur
    echo "An error occurred: " . $e->getMessage();
}