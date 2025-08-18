<?php
// 代码生成时间: 2025-08-18 13:46:21
// 防止SQL注入示例代码
// 使用CakePHP框架进行数据库操作，CakePHP会自动处理SQL注入问题

require 'vendor/autoload.php';

use Cake\Database\Type;
use Cake\Database\Schema\TableSchema;
use Cake\Database\Schema\Collection;
use Cake\Database\Schema\Sql\SqlDialect;
use Cake\Database\Schema\Table;
use Cake\Database\Schema\TableCollection;
use Cake\Database\Type;
use Cake\Database\TypeInterface;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\ORM\Entity;
use Cake\ORM\Table;
use Cake\ORM\Exception\PersistenceFailedException;
use Cake\ORM\ResultSet;
use Cake\ORM\Query;
use Cake\ORM\QueryType;
use Cake\ORM\QueryExpression;
use Cake\ORM\Expression\IdentifierExpression;
use Cake\ORM\Expression\FunctionExpression;
use Cake\ORM\Expression\OrderExpression;
use Cake\ORM\Expression\IdentifierExpression;
use Cake\ORM\Expression\CompositeExpression;
use Cake\ORM\Expression\Comparison;
use Cake\ORM\Expression\CaseStatement;
use Cake\ORM\Expression\TupleComparison;
use Cake\ORM\Expression\ExistsExpression;
use Cake\ORM\Expression\InExpression;
use Cake\ORM\Expression\Like;
use Cake\ORM\Expression\NotExpression;
use Cake\ORM\Expression\NullExpression;
use Cake\ORM\Expression\RegexExpression;
use Cake\ORM\Expression\Size;
use Cake\ORM\Expression\TypeExpression;
use Cake\ORM\Expression\UnaryExpression;
use Cake\ORM\Expression\WithExpression;
use Cake\ORM\Expression\BooleanExpression;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\ORM\Entity;
use Cake\ORM\Exception\PersistenceFailedException;
use Cake\ORM\ResultSet;

// 定义一个User表的实体类
class User extends Entity {
    protected $_accessible = [
        'name' => true,
        'email' => true,
        'password' => true
    ];
}

// 定义一个User表
class UsersTable extends Table {
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->addBehavior('Timestamp');
        $this->belongsToMany('Posts');
    }
}

// 创建一个User表的实例
$users = TableRegistry::get('Users');

// 新增一个用户
try {
    $newUser = $users->newEntity([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password123'
    ], [
        'validate' => true,
        'associated' => true
    ]);

    if ($users->save($newUser)) {
        echo 'User created';
    } else {
        echo 'User not created';
    }
} catch (PersistenceFailedException $e) {
    echo 'Error: ' . $e->getMessage();
}

// 更新一个用户
try {
    $existingUser = $users->get(1);
    $existingUser = $users->patchEntity($existingUser, [
        'name' => 'Jane Doe',
        'email' => 'jane@example.com'
    ], [
        'validate' => true,
        'associated' => true
    ]);

    if ($users->save($existingUser)) {
        echo 'User updated';
    } else {
        echo 'User not updated';
    }
} catch (PersistenceFailedException $e) {
    echo 'Error: ' . $e->getMessage();
}

// 删除一个用户
try {
    if ($users->delete($existingUser)) {
        echo 'User deleted';
    } else {
        echo 'User not deleted';
    }
} catch (PersistenceFailedException $e) {
    echo 'Error: ' . $e->getMessage();
}

// 查询一个用户
$query = $users->find()->where(['name' => 'John Doe']);
foreach ($query as $user) {
    echo 'User found: ' . $user->name;
}

// 防止SQL注入
// CakePHP会自动处理SQL注入问题，不需要手动处理

?>