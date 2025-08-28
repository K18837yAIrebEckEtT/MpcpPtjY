<?php
// 代码生成时间: 2025-08-29 03:17:11
// FormValidator.php
// 这个类是一个表单数据验证器，使用CAKEPHP框架

use Cake\Validation\Validation;
use Cake\Validation\ValidationSet;
use Cake\Validation\Validator\ NotEmptyValidator;
use Cake\Validation\Validator\EmailValidator;
use Cake\Validation\Validator\NumericValidator;

class FormValidator {

    protected $validator = null;

    /**
     * 构造函数，初始化验证器
     *
     * @param array $fields 要验证的字段数组
     */
    public function __construct(array $fields) {
        $this->validator = Validation::build();
        foreach ($fields as $field => $rules) {
            $this->addRules($field, $rules);
        }
    }

    /**
     * 添加字段验证规则
     *
     * @param string $field 字段名
     * @param array $rules 规则定义
     */
    protected function addRules($field, array $rules) {
        $validationSet = $this->validator->provider('default')->add(
            ValidationSet::create($field)
        );

        foreach ($rules as $rule => $ruleOptions) {
            switch ($rule) {
                case 'notEmpty':
                    $validationSet->add(
                        'notEmpty',
                        new NotEmptyValidator($ruleOptions)
                    );
                    break;
                case 'email':
                    $validationSet->add(
                        'email',
                        new EmailValidator($ruleOptions)
                    );
                    break;
                case 'numeric':
                    $validationSet->add(
                        'numeric',
                        new NumericValidator($ruleOptions)
                    );
                    break;
                default:
                    // 可以在这里添加更多的自定义验证器
                    break;
            }
        }
    }

    /**
     * 验证表单数据
     *
     * @param array $data 要验证的数据
     * @return bool 是否验证通过
     */
    public function validate(array $data) {
        return $this->validator->validate($data);
    }

    /**
     * 获取验证错误信息
     *
     * @return array 错误信息数组
     */
    public function getErrors() {
        return $this->validator->getErrors();
    }
}
