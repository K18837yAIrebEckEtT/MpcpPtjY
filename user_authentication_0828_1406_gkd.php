<?php
// 代码生成时间: 2025-08-28 14:06:43
// user_authentication.php
// CakePHP 用户身份认证程序
// 遵循最佳实践和最佳架构模式

// 引入 CakePHP 的自动加载器
require 'vendor/autoload.php';

use Cake\ORM\TableRegistry;

class UserAuthentication {

    // 用户登录方法
    public function login($username, $password) {
        // 获取用户表对象
        $users = TableRegistry::getTableLocator()->get('Users');
        
        // 查找用户
        $user = $users->find()->where(['username' => $username])->first();
        
        // 检查用户是否存在
        if (!$user) {
            throw new Exception('用户不存在');
        }
        
        // 验证密码
        if (!password_verify($password, $user->password)) {
            throw new Exception('密码错误');
        }
        
        // 密码验证通过，返回用户数据
        return $user;
    }

    // 用户注册方法
    public function register($username, $password) {
        // 获取用户表对象
        $users = TableRegistry::getTableLocator()->get('Users');
        
        // 检查用户名是否已存在
        $existingUser = $users->find()->where(['username' => $username])->first();
        
        if ($existingUser) {
            throw new Exception('用户名已存在');
        }
        
        // 创建新用户记录
        $newUser = $users->newEntity();
        $newUser->username = $username;
        $newUser->password = password_hash($password, PASSWORD_DEFAULT);
        
        // 保存新用户
        if (!$users->save($newUser)) {
            throw new Exception('注册失败');
        }
        
        // 注册成功，返回新用户数据
        return $newUser;
    }
}
