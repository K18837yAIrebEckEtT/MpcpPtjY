<?php
// 代码生成时间: 2025-09-05 01:16:29
// Load CakePHP's core components
use Cake\Core\App;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;

class AuditLogService {
    // Define the table for audit logs
    private Table $auditLogsTable;

    public function __construct() {
        // Initialize the Audit Logs table
        $this->auditLogsTable = TableRegistry::getTableLocator()->get('AuditLogs');
    }

    /**
     * Logs a security event
     *
     * @param string $eventName The name of the event being logged
     * @param string $description A brief description of the event
     * @param Entity|null $userEntity The user entity associated with the event
     * @return bool True on success, False on failure
     */
    public function logEvent(string $eventName, string $description, ?Entity $userEntity = null): bool {
        try {
            // Create a new log entry
            $logEntry = $this->auditLogsTable->newEntity();
            $logEntry->event_name = $eventName;
            $logEntry->description = $description;
            $logEntry->user_id = $userEntity ? $userEntity->get('id') : null;
            $logEntry->created = new DateTime();
            $logEntry->modified = new DateTime();

            // Save the log entry
            return $this->auditLogsTable->save($logEntry);
        } catch (Exception $e) {
            // Handle any errors during the log process
            Log::error('Error logging event: ' . $e->getMessage());
            return false;
        }
    }
}

// Example usage
$auditLogService = new AuditLogService();
$auditLogService->logEvent('UserLogin', 'User logged in successfully.', $userEntity);
