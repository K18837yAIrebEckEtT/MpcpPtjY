<?php
// 代码生成时间: 2025-08-12 02:34:46
class TestDataGenerator {

    /**
     * Generate a random string of specified length.
     *
     * @param int $length The length of the string to generate.
     *
     * @return string
     */
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    /**
     * Generate a random integer within a specified range.
     *
     * @param int $min The minimum value.
     * @param int $max The maximum value.
     *
     * @return int
     */
    public function generateRandomInteger($min = 1, $max = 100) {
        return rand($min, $max);
    }

    /**
     * Generate a random boolean value.
     *
     * @return bool
     */
    public function generateRandomBoolean() {
        return rand(0, 1) === 1;
    }

    /**
     * Generate a random float number.
     *
     * @param float|int $min The minimum value of the float.
     * @param float|int $max The maximum value of the float.
     * @param int $precision The number of decimal digits.
     *
     * @return float
     */
    public function generateRandomFloat($min = 0.0, $max = 1.0, $precision = 1) {
        return round($min + ($max - $min) * mt_rand() / mt_getrandmax(), $precision);
    }

    /**
     * Generate a random date within a specified range.
     *
     * @param string $startDate The start date in Y-m-d format.
     * @param string $endDate The end date in Y-m-d format.
     *
     * @return string
     */
    public function generateRandomDate($startDate = '1970-01-01', $endDate = '2023-12-31') {
        $timestampStart = strtotime($startDate);
        $timestampEnd = strtotime($endDate);

        return date('Y-m-d', rand($timestampStart, $timestampEnd));
    }

    /**
     * Generate a random email address.
     *
     * @return string
     */
    public function generateRandomEmail() {
        $domain = $this->generateRandomString(8) . '@example.com';
        return $domain;
    }

    /**
     * Generate a random password.
     *
     * @param int $length The length of the password to generate.
     *
     * @return string
     */
    public function generateRandomPassword($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+';
        $charactersLength = strlen($characters);
        $password = '';

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $charactersLength - 1)];
        }

        return $password;
    }

    // Additional methods to generate other types of test data can be added here.

}

// Usage
try {
    $generator = new TestDataGenerator();
    echo "Random String: " . $generator->generateRandomString(15) . "\
";
    echo "Random Integer: " . $generator->generateRandomInteger(1, 100) . "\
";
    echo "Random Boolean: " . ($generator->generateRandomBoolean() ? 'True' : 'False') . "\
";
    echo "Random Float: " . $generator->generateRandomFloat(0.1, 10.0, 2) . "\
";
    echo "Random Date: " . $generator->generateRandomDate('2020-01-01', '2023-01-01') . "\
";
    echo "Random Email: " . $generator->generateRandomEmail() . "\
";
    echo "Random Password: " . $generator->generateRandomPassword(10) . "\
";
} catch (Exception $e) {
    // Handle any exceptions
    echo "Error: " . $e->getMessage();
}
