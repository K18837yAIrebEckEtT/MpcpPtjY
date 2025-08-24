<?php
// 代码生成时间: 2025-08-24 12:04:31
// theme_switcher.php

// 引入 CakePHP 的核心库
use Cake\Core\Configure;
use Cake\Routing\Router;

// 控制器类
class ThemeController extends AppController {
    // 构造函数
    public function initialize(): void {
        parent::initialize();
        // 设置主题
        $this->set('theme', Configure::read('Theme'));
    }

    // 切换主题的动作
    public function switchTheme(): void {
        try {
            // 获取当前主题
            $currentTheme = Configure::read('Theme');
            // 检查主题配置文件是否存在
            $themeConfig = Configure::read('AvailableThemes');
            if (!in_array($currentTheme, $themeConfig)) {
                throw new Exception("Invalid theme configuration");
            }
            // 切换主题
            if ($themeConfig[$currentTheme] === 'dark') {
                Configure::write('Theme', 'light');
            } else {
                Configure::write('Theme', 'dark');
            }
            // 重定向回原始页面，保持GET参数
            $url = $this->request->getUri();
            $this->redirect($url, 303);
        } catch (Exception $e) {
            // 错误处理
            $this->Flash->error($e->getMessage());
            $this->redirect($this->referer());
        }
    }
}

// 路由配置
Router::scope('/', function (RouteBuilder $builder) {
    $builder->connect('/theme/switch', ['controller' => 'Theme', 'action' => 'switchTheme']);
});

// 配置文件示例，放在 config/app.php
// 'Theme' => 'light', // 默认主题
// 'AvailableThemes' => ['light', 'dark'], // 可用主题列表