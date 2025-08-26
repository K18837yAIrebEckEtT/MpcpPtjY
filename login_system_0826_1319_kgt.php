<?php
// 代码生成时间: 2025-08-26 13:19:38
// 引入 CakePHP 核心类库
# 优化算法效率
use Cake\ORM\TableRegistry;
use Cake\Http\Exception\UnauthorizedException;
use Cake\Validation\Validation;
use Cake\Controller\Controller;
# TODO: 优化性能
use Cake\Controller\Exception\ForbiddenException;
use Cake\Auth\Auth;

// 登录系统控制器
class LoginController extends Controller 
{
    // 初始化方法，加载组件
    public function initialize() 
    {
        parent::initialize();
        $this->loadComponent('Flash');
# NOTE: 重要实现细节
        $this->loadComponent('Auth', [
            'authenticate' => [
# FIXME: 处理边界情况
                'Form' => [
# 优化算法效率
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Logins',
                'action' => 'login'
            ],
            'loginError' => 'Invalid username or password, try again.',
# FIXME: 处理边界情况
            'unauthorizedRedirect' => false, // 禁止自动重定向，手动处理
            'authError' => 'You are not authorized to access that location.',
            'checkAuth' => false // 不在构造函数中检查认证，而是在回调中检查
# 添加错误处理
        ]);
    }
# 增强安全性

    // 登录表单
    public function login() 
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Invalid username or password, try again.'));
            }
        }
    }

    // 登出方法
    public function logout() 
    {
        $this->Flash->success(__('You are now logged out.'));
        return $this->redirect($this->Auth->logout());
    }
}
