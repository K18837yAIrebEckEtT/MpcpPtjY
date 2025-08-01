<?php
// 代码生成时间: 2025-08-02 01:29:51
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;

class UserPermissionManager {
    // Define the TableRegistry for User and Permission models
    private $usersTable;
    private $permissionsTable;

    public function __construct() {
        $this->usersTable = TableRegistry::getTableLocator()->get('Users');
        $this->permissionsTable = TableRegistry::getTableLocator()->get('Permissions');
    }

    /**
     * Create a new permission
     *
     * @param array $data The data to create a new permission
     * @return bool|\Cake\Datasource\EntityInterface True on success, Entity on failure
     */
    public function createPermission(array $data) {
        try {
            $permission = $this->permissionsTable->newEntity($data);
            if ($this->permissionsTable->save($permission)) {
                return true;
            }
            return $permission;
        } catch (\Exception $e) {
            // Handle error
            return false;
        }
    }

    /**
     * Update an existing permission
     *
     * @param int $id The ID of the permission to update
     * @param array $data The data to update the permission
     * @return bool|\Cake\Datasource\EntityInterface True on success, Entity on failure
     */
    public function updatePermission($id, array $data) {
        try {
            $permission = $this->permissionsTable->get($id);
            if ($this->permissionsTable->patchEntity($permission, $data) && $this->permissionsTable->save($permission)) {
                return true;
            }
            return $permission;
        } catch (\Exception $e) {
            // Handle error
            return false;
        }
    }

    /**
     * Delete a permission
     *
     * @param int $id The ID of the permission to delete
     * @return bool True on success, False on failure
     */
    public function deletePermission($id) {
        try {
            $permission = $this->permissionsTable->get($id);
            if ($this->permissionsTable->delete($permission)) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            // Handle error
            return false;
        }
    }

    /**
     * Assign a permission to a user
     *
     * @param int $userId The ID of the user to assign the permission to
     * @param int $permissionId The ID of the permission to assign
     * @return bool True on success, False on failure
     */
    public function assignPermissionToUser($userId, $permissionId) {
        try {
            $user = $this->usersTable->get($userId);
            $permission = $this->permissionsTable->get($permissionId);
            $user->permissions()->attach($permission);
            return true;
        } catch (\Exception $e) {
            // Handle error
            return false;
        }
    }

    /**
     * Remove a permission from a user
     *
     * @param int $userId The ID of the user to remove the permission from
     * @param int $permissionId The ID of the permission to remove
     * @return bool True on success, False on failure
     */
    public function removePermissionFromUser($userId, $permissionId) {
        try {
            $user = $this->usersTable->get($userId);
            $permission = $this->permissionsTable->get($permissionId);
            $user->permissions()->detach($permission);
            return true;
        } catch (\Exception $e) {
            // Handle error
            return false;
        }
    }
}
