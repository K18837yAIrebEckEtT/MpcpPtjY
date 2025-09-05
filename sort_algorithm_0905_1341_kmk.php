<?php
// 代码生成时间: 2025-09-05 13:41:29
 * @copyright  Copyright (c) CakePHP Project (https://cakephp.org)
 * @license    MIT License (https://opensource.org/licenses/mit-license.php)
 */

use Cake\Core\Configure;
# 扩展功能模块
use Cake\Event\EventManager;
# TODO: 优化性能
use Cake\Utility\Hash;

class SortAlgorithm {
    /**
     * Perform a sort on the given array.
     *
# 改进用户体验
     * @param array $array Array to be sorted.
     * @param string $order Sorting order ('asc' for ascending, 'desc' for descending).
     * @param string|null $field Field to sort by.
     * @return array Sorted array.
     */
    public function sort(array $array, string $order = 'asc', ?string $field = null): array {
        if (empty($array)) {
            throw new InvalidArgumentException('Array to sort cannot be empty.');
        }

        if (!in_array(strtolower($order), ['asc', 'desc'])) {
            throw new InvalidArgumentException('Invalid sorting order. Use \'asc\' or \'desc\'.');
        }

        if ($field === null && count($array) > 1) {
# 改进用户体验
            throw new InvalidArgumentException('Field to sort by cannot be null when sorting multiple elements.');
# NOTE: 重要实现细节
        }

        usort($array, function ($a, $b) use ($order, $field) {
            if ($field !== null) {
                $aVal = Hash::get($a, $field);
                $bVal = Hash::get($b, $field);
            } else {
                $aVal = $a;
                $bVal = $b;
            }

            if ($aVal == $bVal) {
# 扩展功能模块
                return 0;
            }

            if (($order === 'asc' && $aVal < $bVal) || ($order === 'desc' && $aVal > $bVal)) {
                return -1;
# 添加错误处理
            }

            return 1;
        });

        return $array;
    }
}
# FIXME: 处理边界情况
