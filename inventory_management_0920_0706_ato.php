<?php
// 代码生成时间: 2025-09-20 07:06:43
// Load CakePHP's Autoloader
require 'vendor/autoload.php';

use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Routing\Router;

// Start the session for storing user data
session_start();

// Define the route for our inventory management
Router::scope('/admin', function ($routes) {
    $routes->connect('inventory', ['controller' => 'Inventory', 'action' => 'index']);
    $routes->connect('inventory/add', ['controller' => 'Inventory', 'action' => 'add']);
    $routes->connect('inventory/edit/:id', ['controller' => 'Inventory', 'action' => 'edit']);
    $routes->connect('inventory/delete/:id', ['controller' => 'Inventory', 'action' => 'delete']);
});

/**
 * InventoryController class
 * Handles HTTP requests for inventory management
 */
class InventoryController extends AppController {

    /**
     * Index method
     * Lists all inventory items.
     */
    public function index() {
        $this->loadModel('Inventory');
        $inventory = $this->Inventory->find('all');
        $this->set(compact('inventory'));
    }

    /**
     * Add method
     * Adds a new inventory item.
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->loadModel('Inventory');
            $inventory = $this->Inventory->newEntity();
            if ($this->Inventory->save($inventory)) {
                $this->Flash->success('Inventory item added successfully.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Failed to add inventory item.');
            }
        }
    }

    /**
     * Edit method
     * Edits an existing inventory item.
     */
    public function edit($id = null) {
        $this->loadModel('Inventory');
        $inventory = $this->Inventory->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->Inventory->save($inventory)) {
                $this->Flash->success('Inventory item updated successfully.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Failed to update inventory item.');
            }
        } else {
            $this->request->data = $inventory;
        }
    }

    /**
     * Delete method
     * Deletes an inventory item.
     */
    public function delete($id = null) {
        $this->loadModel('Inventory');
        $inventory = $this->Inventory->get($id);
        if ($this->Inventory->delete($inventory)) {
            $this->Flash->success('Inventory item deleted successfully.');
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error('Failed to delete inventory item.');
    }
}

/**
 * InventoryTable class
 * Handles database operations for inventory items.
 */
class InventoryTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
    }

    /**
     * Custom validation for inventory items
     */
    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('name', 'Name is required.')
            ->add('quantity', 'valid', ['rule' => 'numeric', 'message' => 'Quantity must be a number.'])
            ->add('price', 'valid', ['rule', 'numeric', 'message' => 'Price must be a number.']);
        return $validator;
    }
}

// Run the application
$app = new \Cake\HttpServer();
$app->run();
