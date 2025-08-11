<?php
// 代码生成时间: 2025-08-11 19:55:12
// 引入 CakePHP 的测试工具类
use Cake\TestSuite\TestCase;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

// 定义集成测试工具类
class IntegrationTestTool extends TestCase
{
    protected $fixtures = [
        // 定义测试所需的所有 fixture
        'app.Users',
        'app.Posts',
    ];

    // 测试用例：测试用户登录功能
    public function testUserLogin()
    {
        // 准备测试数据
        $userTable = TableRegistry::getTableLocator()->get('Users');
        $user = $userTable->newEntity([
            'username' => 'testuser',
            'password' => 'password',
            'created' => Time::now(),
        ]);
        $userTable->save($user);

        // 模拟用户登录请求
        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => 'password',
        ]);

        // 检查响应状态码
        $this->assertEquals(200, $response->getStatusCode());

        // 检查用户是否登录成功
        $session = $this->getSession();
        $this->assertNotEmpty($session->read('Auth.User'));
    }

    // 测试用例：测试文章发布功能
    public function testPostCreation()
    {
        // 准备测试数据
        $postTable = TableRegistry::getTableLocator()->get('Posts');
        $post = $postTable->newEntity([
            'title' => 'Test Post',
            'content' => 'This is a test post.',
            'user_id' => 1,
        ]);
        $postTable->save($post);

        // 模拟文章发布请求
        $response = $this->post('/posts/add', [
            'title' => 'Test Post',
            'content' => 'This is a test post.',
        ]);

        // 检查响应状态码
        $this->assertEquals(302, $response->getStatusCode());

        // 检查文章是否发布成功
        $newPost = $postTable->find()->where(['title' => 'Test Post'])->first();
        $this->assertNotEmpty($newPost);
    }

    // 更多测试用例...
}
