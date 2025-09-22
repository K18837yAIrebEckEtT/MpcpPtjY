<?php
// 代码生成时间: 2025-09-22 08:26:58
class RandomNumberGenerator {

    /**
     * Generate a random number within a specified range
     *
     * @param int $min Minimum value of the range
     * @param int $max Maximum value of the range
     * @return int Random number within the specified range
     * @throws Exception If the range is invalid
     */
    public function generateRandomNumber($min, $max) {
        // Check if the range is valid
        if ($min > $max) {
            throw new Exception("Invalid range: Minimum value cannot be greater than maximum value.");
        }

        // Generate and return a random number within the specified range
        return rand($min, $max);
    }

}

// Example usage
try {
    $randomNumberGenerator = new RandomNumberGenerator();
    $min = 1;
    $max = 100;
    $randomNumber = $randomNumberGenerator->generateRandomNumber($min, $max);
    echo "Random number between $min and $max: $randomNumber";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}