<?php
// 代码生成时间: 2025-09-03 23:12:03
// FormValidator.php
// 表单数据验证器类，用于验证表单提交的数据是否合法

namespace App\Validation;

use Cake\Validation\Validation;
use Cake\Validation\ValidatorInterface;
use Cake\Validation\ValidationSet;

class FormValidator extends Validation implements ValidatorInterface {

    public function add($provider, ValidationSet $fields) {
        // 添加验证规则
        $fields->add('username', function ($provider) {
            return $provider->notEmpty('用户名不能为空')
                       ->add('username', 'length', [
                           'rule' => ['minLength', 5],
                           'message' => '用户名至少需要5个字符'
                       ])
                       ->add('username', 'isUnique', [
                           'rule' => 'validateUnique',
                           'provider' => 'table',
                           'message' => '用户名已存在'
                       ]);
        });

        $fields->add('email', function ($provider) {
            return $provider->notEmpty('邮箱不能为空')
                       ->add('email', 'format', [
                           'rule' => ['email', false],
                           'message' => '无效的邮箱格式'
                       ]);
        });

        $fields->add('password', function ($provider) {
            return $provider->notEmpty('密码不能为空')
                       ->add('password', 'length', [
                           'rule' => ['minLength', 6],
                           'message' => '密码至少需要6个字符'
                       ]);
        });
    }

    // 自定义验证规则，检查用户名是否唯一
    public function validateUnique($check, $context) {
        $table = $this->getTableLocator()->get('Users');
        $existing = $table->find('all', [
            'conditions' => [
                $table->getAlias() . '.username' => $check['username'],
            ],
        ])->count();

        return $existing === 0;
    }

}
