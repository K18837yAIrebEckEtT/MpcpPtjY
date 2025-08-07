<?php
// 代码生成时间: 2025-08-07 13:18:50
class SystemPerformanceMonitor {

    /**
     * Get CPU usage
     *
     * @return float CPU usage percentage
     */
    public function getCpuUsage() {
        $cpuLoad = sys_getloadavg();
        $cpuUsage = $cpuLoad[0] / (PHP_OS_FAMILY === 'Windows' ? 100 : 1);
        return $cpuUsage;
    }

    /**
     * Get memory usage
     *
     * @return array Memory usage details
     */
    public function getMemoryUsage() {
        return memory_get_usage(true);
    }

    /**
     * Get disk usage
     *
     * @return array Disk usage details
     */
    public function getDiskUsage() {
        $totalSpace = disk_total_space('/');
        $freeSpace = disk_free_space('/');
        $usedSpace = $totalSpace - $freeSpace;
        return [
            'total' => $totalSpace,
            'used' => $usedSpace,
            'free' => $freeSpace,
            'percent' => round(($usedSpace / $totalSpace) * 100, 2)
        ];
    }

    /**
     * Display system performance
     *
     * @return void
     */
    public function displayPerformance() {
        try {
            $cpuUsage = $this->getCpuUsage();
            $memoryUsage = $this->getMemoryUsage();
            $diskUsage = $this->getDiskUsage();

            echo "CPU Usage: " . $cpuUsage . "%
";
            echo "Memory Usage: " . $memoryUsage . " bytes
";
            echo "Disk Usage: ";
            echo "Total: " . $diskUsage['total'] . " bytes
";
            echo "Used: " . $diskUsage['used'] . " bytes
";
            echo "Free: " . $diskUsage['free'] . " bytes
";
            echo "Percent Used: " . $diskUsage['percent'] . "%
";

        } catch (Exception $e) {
            // Handle any exceptions that may occur
            echo "Error: " . $e->getMessage();
        }
    }
}

// Usage example
$monitor = new SystemPerformanceMonitor();
$monitor->displayPerformance();