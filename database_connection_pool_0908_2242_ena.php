<?php
// 代码生成时间: 2025-09-08 22:42:29
class DatabaseConnectionPool {

    /**
     * @var DatabaseConnectionPool|null The singleton instance of the class.
     */
    private static ?DatabaseConnectionPool $instance = null;

    /**
     * @var PDO[] An array of PDO database connections.
     */
    private array $connections = [];

    /**
     * Private constructor to prevent direct object creation.
     */
    private function __construct() {}

    /**
     * Gets the singleton instance of the class.
     *
     * @return DatabaseConnectionPool The singleton instance.
     */
    public static function getInstance(): DatabaseConnectionPool {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Adds a new connection to the pool.
     *
     * @param PDO $connection The PDO connection to add.
     */
    public function addConnection(PDO $connection): void {
        $this->connections[] = $connection;
    }

    /**
     * Retrieves a connection from the pool.
     *
     * @return PDO|null A PDO connection from the pool, or null if the pool is empty.
     */
    public function getConnection(): ?PDO {
        if (empty($this->connections)) {
            return null;
        }

        $connection = array_shift($this->connections);
        if (!$connection->getPdo()->ping()) {
            // If the connection is closed, remove it and try to get another one.
            $this->removeConnection($connection);
            return $this->getConnection();
        }

        return $connection;
    }

    /**
     * Releases a connection back to the pool.
     *
     * @param PDO $connection The PDO connection to release.
     */
    public function releaseConnection(PDO $connection): void {
        $this->addConnection($connection);
    }

    /**
     * Removes a connection from the pool.
     *
     * @param PDO $connection The PDO connection to remove.
     */
    public function removeConnection(PDO $connection): void {
        $key = array_search($connection, $this->connections, true);
        if ($key !== false) {
            unset($this->connections[$key]);
        }
    }

    /**
     * Closes all connections in the pool.
     */
    public function closeAllConnections(): void {
        foreach ($this->connections as $connection) {
            $connection = $connection->getPdo();
            if ($connection) {
                $connection = null;
            }
        }
        $this->connections = [];
    }
}

// Example usage:
try {
    // Create a new PDO connection.
    $pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');

    // Add the connection to the pool.
    DatabaseConnectionPool::getInstance()->addConnection($pdo);

    // Get a connection from the pool.
    $connection = DatabaseConnectionPool::getInstance()->getConnection();
    if ($connection) {
        // Use the connection.
        // ...

        // Release the connection back to the pool.
        DatabaseConnectionPool::getInstance()->releaseConnection($connection);
    }
} catch (PDOException $e) {
    // Handle any errors.
    echo 'Connection error: ' . $e->getMessage();
}
