<?php
// 代码生成时间: 2025-08-05 14:02:21
 * maintainability and extensibility.
 */

require_once 'vendor/autoload.php'; // Autoload dependencies

use Cake\ORM\TableRegistry;
use Cake\Http\Exception\UnauthorizedException;
use Cake\Auth\Auth; // For authentication

// Define namespace for the class
namespace App\Controller;

class UsersController extends AppController
{
    // Function to handle login
    public function login()
    {
        if ($this->request->is('post')) { // Check if the request is POST
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']); // Redirect to dashboard
            } else {
                $this->Flash->error(__('Invalid username or password')); // Flash error message
            }
        }
        // Render the login view if not a POST request or authentication failed
        $this->set('_serialize', ['_serialize' => false]); // Disable serialization
    }

    // Function to handle logout
    public function logout()
    {
        $this->Auth->logout(); // Logout the user
        return $this->redirect(['controller' => 'Users', 'action' => 'login']); // Redirect to login page
    }

    // Function to display the login form
    public function displayLogin()
    {
        $this->set('_serialize', ['_serialize' => false]); // Disable serialization
    }
}
