<?php
// 代码生成时间: 2025-09-19 15:00:48
 * This tool provides functionality to calculate hash values for given input strings.
 *
 * @author Your Name
 * @version 1.0
 */

// Load CakePHP's Autoloader
require 'vendor/autoload.php';

use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Cake\Utility\Hash;

class HashCalculatorTool {

    private $algorithm;

    /**
     * Constructor
     *
     * @param string $algorithm The hashing algorithm to use.
     */
    public function __construct($algorithm = 'sha256') {
        $this->algorithm = $algorithm;
    }

    /**
     * Calculate hash
     *
     * @param string $input The string to be hashed.
     * @return string The calculated hash.
     * @throws Exception If the algorithm is not supported.
     */
    public function calculateHash($input) {
        if (!in_array($this->algorithm, hash_algos())) {
            throw new Exception('Unsupported hashing algorithm.');
        }

        return hash($this->algorithm, $input);
    }

    /**
     * Set hashing algorithm
     *
     * @param string $algorithm The hashing algorithm to use.
     * @return void
     */
    public function setAlgorithm($algorithm) {
        $this->algorithm = $algorithm;
    }

}

// Usage
try {
    $hashCalculator = new HashCalculatorTool();
    $inputString = "Hello, World!";
    $calculatedHash = $hashCalculator->calculateHash($inputString);
    echo "Input: $inputString
Hashed: $calculatedHash";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
