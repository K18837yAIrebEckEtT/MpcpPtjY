<?php
// 代码生成时间: 2025-09-08 09:40:52
class MemoryUsageAnalyzer {

    /**
     * Constructor
     * Initializes the memory usage analyzer.
     */
    public function __construct() {
        // Initialize the memory usage analyzer
    }

    /**
     * Get the current memory usage
     *
     * @return float Returns the current memory usage in bytes.
     */
    public function getCurrentMemoryUsage() {
        $memoryUsage = memory_get_usage();
        // Check if memory_get_usage() returned a valid value
        if ($memoryUsage === false) {
            throw new Exception('Unable to retrieve current memory usage.');
        }
        return $memoryUsage;
    }

    /**
     * Get the peak memory usage
     *
     * @return float Returns the peak memory usage in bytes.
     */
    public function getPeakMemoryUsage() {
        $memoryPeakUsage = memory_get_peak_usage();
        // Check if memory_get_peak_usage() returned a valid value
        if ($memoryPeakUsage === false) {
            throw new Exception('Unable to retrieve peak memory usage.');
        }
        return $memoryPeakUsage;
    }

    /**
     * Convert memory usage to a human-readable format
     *
     * @param float $memoryUsage The memory usage in bytes.
     * @return string Returns the memory usage in a human-readable format.
     */
    public function convertMemoryUsageToHumanReadable($memoryUsage) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $bytes = $memoryUsage;
        $unit = 0;
        while ($bytes >= 1024) {
            $bytes /= 1024;
            $unit++;
        }
        return round($bytes, 2) . ' ' . $units[$unit];
    }

    /**
     * Analyze memory usage
     *
     * @return array Returns an associative array with the current and peak memory usage.
     */
    public function analyze() {
        try {
            $currentMemoryUsage = $this->getCurrentMemoryUsage();
            $peakMemoryUsage = $this->getPeakMemoryUsage();
            $currentMemoryUsageHumanReadable = $this->convertMemoryUsageToHumanReadable($currentMemoryUsage);
            $peakMemoryUsageHumanReadable = $this->convertMemoryUsageToHumanReadable($peakMemoryUsage);

            return array(
                'current_memory_usage' => $currentMemoryUsageHumanReadable,
                'peak_memory_usage' => $peakMemoryUsageHumanReadable
            );
        } catch (Exception $e) {
            // Handle exceptions and return an error message
            return array('error' => $e->getMessage());
        }
    }
}

// Usage example
$memoryAnalyzer = new MemoryUsageAnalyzer();
$memoryUsageAnalysis = $memoryAnalyzer->analyze();
print_r($memoryUsageAnalysis);
