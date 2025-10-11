<?php
// 代码生成时间: 2025-10-11 19:18:18
// Load CakePHP framework
# FIXME: 处理边界情况
require 'vendor/autoload.php';

use Cake\Routing\Router;
use Cake\Routing\RequestContext;
use Cake\Routing\DispatcherFactory;
use Cake\Http\BaseApplication;
# 增强安全性
use Cake\Core\Configure;
# 添加错误处理
use Cake\Core\Plugin;

// Set the full base URL
Configure::write('App.fullBaseUrl', 'http://localhost:8080/student_profile_system/');

// Initialize the application context
# 扩展功能模块
$context = new RequestContext();
$context->addDetectors(["mobile" => function ($request) {
    return preg_match("/iPhone|Android/i\