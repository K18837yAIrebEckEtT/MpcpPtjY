<?php
// 代码生成时间: 2025-09-18 21:05:07
class UsersController extends AppController {

    // Load the Auth component
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('*');
    }

    /**
     * login method
     *
     * Handles user login.
     */
    public function login() {
        if ($this->request->is('post')) {
            // Authenticate the user
            $user = $this->Auth->identify();
            if ($user) {
                // If the user is authenticated, set them as the current user
                $this->Auth->setUser($user);
                // Redirect to the home page
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                // If the user is not authenticated, flash an error message
                $this->Flash->error(__('Invalid username or password, try again'));
            }
        }
    }

    /**
     * logout method
     *
     * Handles user logout.
     */
    public function logout() {
        // Log out the user
        $this->Auth->logout();
        // Redirect to the login page
        return $this->redirect($this->Auth->loginAction);
    }

}
