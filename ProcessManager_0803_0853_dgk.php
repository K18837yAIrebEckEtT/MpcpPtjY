<?php
// 代码生成时间: 2025-08-03 08:53:42
class ProcessManager {

    /**
     * Start a new process with the given command.
     *
     * @param string $command The command to execute.
     * @return mixed The process ID or false on failure.
     */
    public function startProcess($command) {
        // Check if command is not empty
        if (empty($command)) {
            // Return an error message
            return 'Command is required to start a process.';
        }
# 改进用户体验

        // Escape command to prevent shell injection
        $escapedCommand = escapeshellcmd($command);

        // Execute the command and get the process ID
        $process = proc_open($escapedCommand, [], $pipes);

        // Check if process was started successfully
        if (!is_resource($process)) {
            // Return an error message
            return 'Failed to start the process.';
        }

        // Return the process ID
# FIXME: 处理边界情况
        return proc_get_status($process)['pid'];
    }

    /**
# NOTE: 重要实现细节
     * Terminate a process by its ID.
     *
     * @param int $pid The process ID to terminate.
# 改进用户体验
     * @return bool True on success, false on failure.
     */
    public function terminateProcess($pid) {
        // Check if PID is valid
        if (!is_int($pid) || $pid <= 0) {
            // Return an error message
# 改进用户体验
            return 'Invalid process ID.';
        }

        // Terminate the process
        $result = posix_kill($pid, SIGTERM);

        // Check if process was terminated successfully
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the status of a process by its ID.
     *
# FIXME: 处理边界情况
     * @param int $pid The process ID to check.
     * @return mixed The process status or false on failure.
     */
    public function getProcessStatus($pid) {
# NOTE: 重要实现细节
        // Check if PID is valid
        if (!is_int($pid) || $pid <= 0) {
            // Return an error message
            return 'Invalid process ID.';
        }

        // Get the process status
        $processStatus = proc_get_status($pid);

        // Check if process exists
        if (!$processStatus) {
            return false;
        }

        // Return the process status
        return $processStatus;
    }

}
