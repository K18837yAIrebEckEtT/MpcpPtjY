<?php
// 代码生成时间: 2025-08-25 00:19:10
// 用户权限管理系统
// 使用CAKEPHP框架构建
// 文件：UserPermissionManagement.php

use Cake\ORM\TableRegistry;

class UserPermissionManagement {

    private $userRoles;
    private $usersTable;
    private $rolesTable;
    private $permissionsTable;

    public function __construct() {
        // 初始化表对象
        $this->usersTable = TableRegistry::getTableLocator()->get('Users');
        $this->rolesTable = TableRegistry::getTableLocator()->get('Roles');
        $this->permissionsTable = TableRegistry::getTableLocator()->get('Permissions');
    }

    // 添加用户
    public function addUser($username, $password, $role) {
        try {
            $user = $this->usersTable->newEntity([
                'username' => $username,
                'password' => $password,
                'role' => $role,
            ]);

            if ($this->usersTable->save($user)) {
                return 'User added successfully';
            } else {
                return 'Failed to add user';
            }
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // 删除用户
    public function deleteUser($userId) {
        try {
            $user = $this->usersTable->get($userId);
            if ($this->usersTable->delete($user)) {
                return 'User deleted successfully';
            } else {
                return 'Failed to delete user';
            }
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // 添加权限
    public function addPermission($permissionName, $roleId) {
        try {
            $permission = $this->permissionsTable->newEntity([
                'name' => $permissionName,
                'role_id' => $roleId,
            ]);

            if ($this->permissionsTable->save($permission)) {
                return 'Permission added successfully';
            } else {
                return 'Failed to add permission';
            }
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // 删除权限
    public function deletePermission($permissionId) {
        try {
            $permission = $this->permissionsTable->get($permissionId);
            if ($this->permissionsTable->delete($permission)) {
                return 'Permission deleted successfully';
            } else {
                return 'Failed to delete permission';
            }
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // 获取用户列表
    public function getUserList() {
        try {
            $users = $this->usersTable->find()->all();
            return $users;
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // 获取角色列表
    public function getRoleList() {
        try {
            $roles = $this->rolesTable->find()->all();
            return $roles;
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    // 获取权限列表
    public function getPermissionList() {
        try {
            $permissions = $this->permissionsTable->find()->all();
            return $permissions;
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

}
