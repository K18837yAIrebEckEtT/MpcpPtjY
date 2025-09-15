<?php
// 代码生成时间: 2025-09-16 01:22:53
// 引入CakePHP核心文件
require 'vendor/autoload.php';
use Cake\Database\Type;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Routing\RouteBuilder;
use Cake\Controller\Controller;
use Cake\Controller\Exception\NotImplementedException;
use Cake\Controller\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Validation\Validation;
use Cake\Validation\ValidationSet;
use Cake\Auth\AuthComponent;
use Cake\Auth\FormAuthenticate;
use Cake\Auth\AuthenticationDatabaseToken;
use Cake\Auth\AbstractAuthentication;
use Cake\Auth\Auth;
use Cake\I18n\Time;
use Cake\Log\Log;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\Exception\RecordNotFoundException;

// UserAuthController类用于处理用户登录验证
class UserAuthController extends Controller
{
    public function initialize(): void
    {
        // 调用父类initialize方法
        parent::initialize();
        // 加载AuthComponent组件
        $this->loadComponent('Auth');
    }

    public function login(): void
    {
        // 如果用户已经登录，则重定向到首页
        if ($this->Auth->user()) {
            $this->redirect('/');
        }
        
        // 如果是POST请求并且用户提交了表单
        if ($this->request->is('post')) {
            // 使用FormAuthenticate类进行表单认证
            $user = $this->Auth->identify();
            
            // 如果认证成功
            if ($user) {
                // 将认证用户信息保存到会话
                $this->Auth->setUser($user);
                
                // 重定向到登录之前的页面或首页
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                // 认证失败，设置错误信息
                $this->Flash->error(__('Invalid username or password'));
            }
        }
    }

    public function logout(): void
    {
        // 销毁会话并重定向到登录页面
        $this->Auth->logout();
        return $this->redirect($this->Auth->logoutRedirect());
    }
}
