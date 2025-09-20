<?php
// 代码生成时间: 2025-09-21 01:34:12
class PasswordEncryptDecryptTool 
{
    /**
     * @var \Cake\Utility\Security
     */
    private $security;

    public function __construct() 
    {
        $this->security = new \Cake\Utility\Security();
    }

    /**
     * Encrypts a password using CakePHP's Security component.
     *
     * @param string $password The password to encrypt.
     * @return string|bool The encrypted password or false on failure.
     */
    public function encrypt($password) 
    {
        try {
            return $this->security->hash($password, 'sha256', true);
        } catch (\Exception $e) {
            // Handle encryption error
            error_log('Encryption error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Decrypts an encrypted password using CakePHP's Security component.
     * Note: Due to the nature of hashing, decryption is not possible;
     * instead, this function verifies if a given password matches the hash.
     *
     * @param string $hash The encrypted password hash.
     * @param string $password The password to verify against the hash.
     * @return bool True if the password matches the hash, false otherwise.
     */
    public function decrypt($hash, $password) 
    {
        try {
            return $this->security->check($password, $hash);
        } catch (\Exception $e) {
            // Handle decryption error
            error_log('Decryption error: ' . $e->getMessage());
            return false;
        }
    }
}

// Usage example:
// $tool = new PasswordEncryptDecryptTool();
// $encryptedPassword = $tool->encrypt('myPassword123');
// $isMatch = $tool->decrypt($encryptedPassword, 'myPassword123');
