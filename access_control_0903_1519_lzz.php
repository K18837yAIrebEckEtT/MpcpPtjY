<?php
// 代码生成时间: 2025-09-03 15:19:34
// access_control.php

// 使用CakePHP的身份认证组件进行访问权限控制
use Cake\Event\Event;
use Cake\Event\EventDispatcherTrait;
use Cake\Http\Exception\UnauthorizedException;
use Cake\I18n\I18n;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Routing\Router;

class AccessControl {
    // 事件分发器
    use EventDispatcherTrait;

    private $userTable;
    private $rolesTable;

    public function __construct() {
        // 从TableRegistry中加载用户和角色表
        $this->userTable = TableRegistry::getTableLocator()->get('Users');
        $this->rolesTable = TableRegistry::getTableLocator()->get('Roles');
    }

    // 检查用户是否具备特定角色
    public function checkRole($userId, $role) {
        try {
            // 确保用户ID和角色存在
            if (!$userId || !$role) {
                throw new InvalidArgumentException('User ID and role are required.');
            }

            // 获取用户角色
            $userRole = $this->userTable->get($userId)->role;

            // 检查用户角色是否匹配
            if ($userRole->name !== $role) {
                throw new UnauthorizedException('You do not have permission to access this resource.');
            }

            return true;
        } catch (Exception $e) {
            // 错误处理
            $this->dispatchEvent('AccessControl.error', ['exception' => $e]);
            return false;
        }
    }

    // 检查用户是否登录
    public function checkAuthentication($request) {
        // 从Session中获取用户信息
        $session = $request->getAttribute('session');
        if (!$session->read('Auth.User')) {
            throw new UnauthorizedException('You must be logged in to access this resource.');
        }

        return true;
    }

    // 路由过滤器，用于访问权限控制
    public function accessControlFilter(Event $event, $request, $response, $next) {
        try {
            // 检查是否需要登录
            if (!$this->checkAuthentication($request)) {
                $response = $response->withStatus(401)->withStringBody(I18n::translate('You must be logged in to access this resource.'));
                return $response;
            }

            // 检查用户角色
            $userId = $request->getAttribute('session')->read('Auth.User.id');
            $role = $this->getRequiredRole($request);
            if (!$this->checkRole($userId, $role)) {
                $response = $response->withStatus(403)->withStringBody(I18n::translate('You do not have permission to access this resource.'));
                return $response;
            }

            // 继续处理请求
            return $next($request, $response);
        } catch (UnauthorizedException $e) {
            // 未授权访问
            $response = $response->withStatus($e->getCode())->withStringBody($e->getMessage());
            return $response;
        } catch (Exception $e) {
            // 其他错误处理
            $response = $response->withStatus(500)->withStringBody(I18n::translate('An error occurred while processing your request.'));
            return $response;
        }
    }

    // 获取请求所需的角色
    protected function getRequiredRole($request) {
        // 根据路由或请求参数确定所需角色
        // 例如，可以从控制器的名称和动作名称推断
        // 这里只是一个示例，具体实现需要根据实际情况
        $controllerName = $request->getAttribute('controllerName');
        $actionName = $request->getAttribute('actionName');
        
        // 假设'admin'角色需要访问'Users'控制器的'delete'动作
        if ($controllerName === 'Users' && $actionName === 'delete') {
            return 'admin';
        }
        
        // 默认不需要特殊角色
        return 'default';
    }
}
