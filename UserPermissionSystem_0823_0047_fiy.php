<?php
// 代码生成时间: 2025-08-23 00:47:05
// UserPermissionSystem.php
// 用户权限管理系统

use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\I18n\I18n;

class UserPermissionSystem {

    private $users;
    private $roles;
    private $permissions;

    // 构造函数
    public function __construct() {
        $this->users = TableRegistry::getTableLocator()->get('Users');
        $this->roles = TableRegistry::getTableLocator()->get('Roles');
        $this->permissions = TableRegistry::getTableLocator()->get('Permissions');
    }

    // 检查用户是否有特定权限
    public function checkPermission($username, $permission) {
        try {
            $user = $this->users->find()->where(['username' => $username])->firstOrFail();
            $userRoles = $this->roles->find()->where(['user_id' => $user->id])->all();

            foreach ($userRoles as $role) {
                $rolePermissions = $this->permissions->find()->where(['role_id' => $role->id])->all();
                foreach ($rolePermissions as $permissionEntity) {
                    if ($permissionEntity->name === $permission) {
                        return true;
                    }
                }
            }

            return false;
        } catch (\Exception $e) {
            // 错误处理
            return false;
        }
    }

    // 添加用户权限
    public function addPermission($username, $permission) {
        try {
            $user = $this->users->find()->where(['username' => $username])->firstOrFail();
            $role = $this->roles->newEntity(['user_id' => $user->id]);
            $this->roles->save($role);

            $permissionEntity = $this->permissions->newEntity(['role_id' => $role->id, 'name' => $permission]);
            $this->permissions->save($permissionEntity);

            return true;
        } catch (\Exception $e) {
            // 错误处理
            return false;
        }
    }

    // 移除用户权限
    public function removePermission($username, $permission) {
        try {
            $user = $this->users->find()->where(['username' => $username])->firstOrFail();
            $userRoles = $this->roles->find()->where(['user_id' => $user->id])->all();

            foreach ($userRoles as $role) {
                $rolePermissions = $this->permissions->find()->where(['role_id' => $role->id, 'name' => $permission])->all();
                foreach ($rolePermissions as $permissionEntity) {
                    $this->permissions->delete($permissionEntity);
                }
            }

            return true;
        } catch (\Exception $e) {
            // 错误处理
            return false;
        }
    }

}
