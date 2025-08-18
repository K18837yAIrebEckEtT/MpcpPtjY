<?php
// 代码生成时间: 2025-08-18 20:08:53
// NotificationService.php

use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Core\Configure;
use Cake\Validation\Validation;
use Cake\Mailer\Email;
use Cake\Mailer\TransportFactory;
use Cake\Core\Exception\CakeException;

class NotificationService {
    /**
     * 发送通知消息
     *
     * @param array $data 通知消息的数据
     * @return bool 发送成功返回true，失败返回false
     */
    public function sendNotification(array $data): bool {
        // 检查数据有效性
        $errors = Validation::validate($data, $this->getNotificationValidationRules());
        if (!empty($errors)) {
            Log::error('Notification validation errors: ' . json_encode($errors));
            return false;
        }

        // 加载Email组件
        $email = new Email();
        $transport = (new TransportFactory())->get(Configure::read('Email.transportConfig'));
        $email->setTransport($transport);

        // 设置邮件内容
        $email->setFrom(Configure::read('Email.from'))
            ->setTo($data['to'])
            ->setSubject($data['subject'])
            ->setEmailFormat('html')
            ->setViewVars(['message' => $data['message']]);

        // 加载邮件模板
        $email->setTemplate('notifications/default', ['message' => $data['message']]);

        // 发送邮件
        try {
            $email->send();
            return true;
        } catch (CakeException $e) {
            Log::error('Failed to send notification: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * 获取通知消息的数据验证规则
     *
     * @return >array 验证规则
     */
    private function getNotificationValidationRules(): array {
        return [
            'to' => [
                'rule' => ['email']
            ],
            'subject' => [
                'rule' => ['notEmpty']
            ],
            'message' => [
                'rule' => ['notEmpty']
            ]
        ];
    }
}
