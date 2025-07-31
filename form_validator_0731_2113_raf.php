<?php
// 代码生成时间: 2025-07-31 21:13:26
// 文件：form_validator.php
// 功能：CAKEPHP框架下的表单数据验证器

use Cake\Validation\Validator;
use Cake\Validation\Validation;

class CustomValidator extends Validator {
    // 构造函数
    public function __construct(array $config) {
        parent::__construct($config);
        // 设置验证规则
        $this
            ->requirePresence('username', 'create')
            ->notEmptyString('username', '必须填写用户名')
            ->requirePresence('email', 'create')
            ->email('email', '电子邮件格式不正确')
            ->requirePresence('password', 'create')
            ->notEmptyString('password', '必须填写密码')
            ->minLength('password', 8, '密码长度不能少于8位')
            ->requirePresence('confirm_password', 'create')
            ->notEmptyString('confirm_password', '必须填写确认密码')
            ->add('confirm_password', 'confirmPassword', [
                'rule' => ['compareWith', 'password'],
                'message' => '两次输入的密码不一致'
            ]);
    }

    // 自定义验证函数：确认密码与密码一致
    protected function compareWith($value, $context, $compareWithField) {
        if (!isset($context[$compareWithField])) {
            return false;
        }
        return $value === $context[$compareWithField];
    }
}

// 使用示例
// $data 为要验证的数据数组
// $validator 为创建的自定义验证器实例
// $errors 为验证结果中的错误信息数组
// $data = ['username' => 'user', 'email' => 'user@example.com', 'password' => 'password123', 'confirm_password' => 'password123'];
// $validator = new CustomValidator();
// $errors = $validator->validate($data);
// if (!empty($errors)) {
//     // 处理错误信息
//     print_r($errors);
// } else {
//     // 数据验证通过
//     // 执行后续逻辑，如保存数据等
// }
