<?php
// 代码生成时间: 2025-10-05 23:44:43
// health_risk_assessment.php
// 使用CAKEPHP框架实现健康风险评估程序

// 引入CAKEPHP框架核心文件
require 'vendor/autoload.php';

use Cake\Core\Configure;
use Cake\Http\BaseApplication;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

// 创建路由
Router::prefix('api', function (RouteBuilder $builder) {
    $builder->scope('/', function (RouteBuilder $builder) {
        $builder->connect('health-risk-assessment', ['controller' => 'HealthRiskAssessments', 'action' => 'index']);
    });
});

// 运行CAKEPHP应用程序
(new BaseApplication(Configure::read('App')))->run();

// HealthRiskAssessmentsController控制器
class HealthRiskAssessmentsController extends 
    AppController {
    public function index() {
        // 获取用户输入的健康数据
        $age = $this->request->getQuery('age');
        $weight = $this->request->getQuery('weight');
        $height = $this->request->getQuery('height');

        // 验证输入数据
        if (empty($age) || empty($weight) || empty($height)) {
            $this->response->statusCode(400);
            return $this->response->withStringBody(json_encode(['error' => 'Missing required parameters']));
        }

        // 调用健康风险评估服务
        $result = $this->HealthRiskAssessment->calculateRisk($age, $weight, $height);

        // 返回评估结果
        $this->response->statusCode(200);
        return $this->response->withStringBody(json_encode($result));
    }
}

// HealthRiskAssessment服务类
class HealthRiskAssessment {
    public function calculateRisk($age, $weight, $height) {
        // 计算BMI
        $bmi = $weight / ($height * $height);

        // 根据BMI评估健康风险
        if ($bmi < 18.5) {
            return ['risk' => 'Underweight'];
        } elseif ($bmi >= 18.5 && $bmi < 25) {
            return ['risk' => 'Normal'];
        } elseif ($bmi >= 25 && $bmi < 30) {
            return ['risk' => 'Overweight'];
        } else {
            return ['risk' => 'Obese'];
        }
    }
}
