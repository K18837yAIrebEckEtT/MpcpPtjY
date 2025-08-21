<?php
// 代码生成时间: 2025-08-21 12:22:40
// Load CakePHP's autoloader
require 'vendor/autoload.php';

use Cake\ORM\TableRegistry;
use Cake\Database\Exception\PDOException;

// Define a function to perform a safe database query to prevent SQL injection
function safeQuery() {
    try {
        // Retrieve the 'Users' table instance from the ORM
        $usersTable = TableRegistry::getTableLocator()->get('Users');

        // Simulate user input (this should be sanitized and validated in a real-world scenario)
        $unsafeInput = $_GET['username'] ?? '';

        // Use parameter binding to prevent SQL injection
        $users = $usersTable->find()
            ->where(['username' => $unsafeInput])
            ->all();

        // Output the result
        foreach ($users as $user) {
            echo "User ID: " . $user->id . ", Username: " . $user->username . "
";
        }
    } catch (PDOException $e) {
        // Handle any database related errors
        echo "Database error: " . $e->getMessage();
    } catch (Exception $e) {
        // Handle any other errors
        echo "Error: " . $e->getMessage();
    }
}

// Call the function to execute the safe query
safeQuery();