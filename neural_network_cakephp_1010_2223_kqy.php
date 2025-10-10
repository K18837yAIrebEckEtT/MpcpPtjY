<?php
// 代码生成时间: 2025-10-10 22:23:19
// CakePHP's autoloader
require 'vendor/autoload.php';

use Cake\Database\Type;
use Cake\Database\Schema\TableSchema;

// Define the NeuralNetwork class
class NeuralNetwork {

    /**
     * @var int Number of inputs in the neural network
     */
    private $inputs;

    /**
     * @var array Array of weights for the neural network
     */
    private $weights;

    /**
     * @var array Array of biases for the neural network
     */
    private $biases;

    /**
     * NeuralNetwork constructor.
     *
     * @param int $inputs Number of inputs
     * @param int $hiddenUnits Number of hidden units
     * @param int $outputs Number of outputs
     */
    public function __construct($inputs, $hiddenUnits, $outputs) {
        $this->inputs = $inputs;
        $this->weights = $this->initializeWeights($inputs, $hiddenUnits + $outputs);
        $this->biases = $this->initializeBiases($hiddenUnits + $outputs);
    }

    /**
     * Initialize weights with random values.
     *
     * @param int $size Size of the weights array
     * @return array
     */
    private function initializeWeights($size) {
        $weights = [];
        for ($i = 0; $i < $size; $i++) {
            $weights[$i] = rand(-1000, 1000) / 1000;
        }
        return $weights;
    }

    /**
     * Initialize biases with zeros.
     *
     * @param int $size Size of the biases array
     * @return array
     */
    private function initializeBiases($size) {
        return array_fill(0, $size, 0);
    }

    /**
     * Sigmoid function for activation.
     *
     * @param float $x Input value
     * @return float
     */
    private function sigmoid($x) {
        return 1 / (1 + exp(-$x));
    }

    /**
     * Train the neural network with backpropagation.
     *
     * @param array $inputs Training inputs
     * @param array $targets Training targets
     * @param float $learningRate Learning rate
     * @param int $iterations Number of iterations
     */
    public function train($inputs, $targets, $learningRate, $iterations) {
        for ($i = 0; $i < $iterations; $i++) {
            $output = $this->feedforward($inputs);
            $this->backpropagate($targets, $output, $learningRate);
        }
    }

    /**
     * Feedforward method for neural network.
     *
     * @param array $inputs Input values
     * @return array
     */
    private function feedforward($inputs) {
        $hiddenOutputs = [];
        foreach ($inputs as $input) {
            $output = 0;
            foreach ($this->weights as $weight) {
                $output += $weight * $input;
            }
            $output = $this->sigmoid($output + $this->biases[0]);
            $hiddenOutputs[] = $output;
        }
        return $hiddenOutputs;
    }

    /**
     * Backpropagation method for neural network.
     *
     * @param array $targets Targets
     * @param array $outputs Outputs
     * @param float $learningRate Learning rate
     */
    private function backpropagate($targets, $outputs, $learningRate) {
        // Calculate error
        $error = array_map(function ($target, $output) {
            return ($target - $output) * $this->sigmoidDerivative($output);
        }, $targets, $outputs);

        // Update weights and biases
        foreach ($error as $e) {
            $this->weights[0] -= $learningRate * $e;
            $this->biases[0] -= $learningRate * $e;
        }
    }

    /**
     * Derivative of the sigmoid function.
     *
     * @param float $x Input value
     * @return float
     */
    private function sigmoidDerivative($x) {
        return $x * (1 - $x);
    }

}

// Example usage
try {
    $nn = new NeuralNetwork(2, 3, 1); // 2 inputs, 3 hidden units, 1 output
    $inputs = [0.0, 0.0]; // XOR inputs
    $targets = [0.0];
    $nn->train($inputs, $targets, 0.1, 10000);
    echo "Output: " . $nn->feedforward($inputs)[0] . "\
";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
