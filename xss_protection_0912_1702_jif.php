<?php
// 代码生成时间: 2025-09-12 17:02:25
class XssProtection {

    /**
     * Sanitize input data to prevent XSS attacks.
     *
     * @param mixed $input The input data to be sanitized.
     * @return mixed The sanitized input data.
     */
    public function sanitizeInput($input) {
        if (is_string($input)) {
            // Use PHP's htmlspecialchars function to convert special characters to HTML entities
            return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        } elseif (is_array($input)) {
            // Recursively sanitize array elements
            foreach ($input as $key => $value) {
                $input[$key] = $this->sanitizeInput($value);
            }
            return $input;
        } else {
            // Return the input as is if it's neither a string nor an array
            return $input;
        }
    }

    /**
     * Sanitize output data to prevent XSS attacks.
     *
     * @param mixed $output The output data to be sanitized.
     * @return mixed The sanitized output data.
     */
    public function sanitizeOutput($output) {
        if (is_string($output)) {
            // Use PHP's htmlspecialchars function to convert special characters to HTML entities
            return htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
        } elseif (is_array($output)) {
            // Recursively sanitize array elements
            foreach ($output as $key => $value) {
                $output[$key] = $this->sanitizeOutput($value);
            }
            return $output;
        } else {
            // Return the output as is if it's neither a string nor an array
            return $output;
        }
    }
}

// Example usage:
$xssProtection = new XssProtection();

// Sanitize user input
$userInput = "<script>alert('XSS')</script>";
$sanitizedInput = $xssProtection->sanitizeInput($userInput);
echo $sanitizedInput; // Output: &lt;script&gt;alert('XSS')&lt;/script&gt;

// Sanitize output data
$outputData = "<script>alert('XSS')</script>";
$sanitizedOutput = $xssProtection->sanitizeOutput($outputData);
echo $sanitizedOutput; // Output: &lt;script&gt;alert('XSS')&lt;/script&gt;