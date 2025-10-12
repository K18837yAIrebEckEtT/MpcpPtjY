<?php
// 代码生成时间: 2025-10-13 01:32:39
// WealthManagementTool.php
// 这是一个简单的财富管理工具类，使用CAKEPHP框架实现

use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

class WealthManagementTool {

    private $userModel;
    private $transactionModel;

    // 类构造器
    public function __construct() {
        // 初始化模型
        $this->userModel = TableRegistry::getTableLocator()->get('Users');
        $this->transactionModel = TableRegistry::getTableLocator()->get('Transactions');
    }

    // 添加交易
    public function addTransaction($data) {
        // 验证数据
        if (empty($data['amount'])) {
            throw new \u003eInvalidArgumentException('金额不能为空');
        }

        // 检查金额是否为正数
        if ($data['amount'] <= 0) {
            throw new \u003eInvalidArgumentException('金额必须大于0');
        }

        // 创建交易记录
        $transaction = $this->transactionModel->newEntity($data);
        if (!$this->transactionModel->save($transaction)) {
            throw new \u003eRuntimeException('交易保存失败');
        }

        return $transaction;
    }

    // 获取用户交易记录
    public function getUserTransactions($userId) {
        // 验证用户ID
        if (empty($userId)) {
            throw new \u003eInvalidArgumentException('用户ID不能为空');
        }

        // 获取用户的交易记录
        return $this->transactionModel->find()
            ->where(['user_id' => $userId])
            ->all();
    }

    // 计算用户总资产
    public function calculateTotalAssets($userId) {
        // 验证用户ID
        if (empty($userId)) {
            throw new \u003eInvalidArgumentException('用户ID不能为空');
        }

        // 获取用户的交易记录，并计算总资产
        $totalAssets = 0;
        foreach ($this->getUserTransactions($userId) as $transaction) {
            $totalAssets += $transaction->amount;
        }

        return $totalAssets;
    }

    // 检查用户是否存在
    public function checkUserExists($userId) {
        $user = $this->userModel->get($userId);
        return $user !== null;
    }

}
