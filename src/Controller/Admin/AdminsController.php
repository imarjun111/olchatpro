<?php
namespace App\Controller\Admin;

//use App\Controller;
use App\Controller\AppController;

/**
 * Admin/Admins Controller
 *
 *
 * @method \App\Model\Entity\Admin/Admin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdminsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function initialize(){
        parent::initialize();
$connection = 'default';
        $this->viewBuilder()->setLayout('adminLayout');
        $this->loadmodel('Admins');
           $this->Auth->allow(['login','register','logout']);  
    }
    public function index()
    {
     //   echo $this->Auth->user('id');die;
        // $admin/admins = $this->paginate($this->Admin/Admins);

        // $this->set(compact('admin/admins'));
    }
    public function login(){
         $this->viewBuilder()->setLayout('loginLayout');
        if($this->request->is('post')){
            $data = $this->request->getData();
             $user = $this->Auth->identify();
            if($user) {
                $this->Auth->setUser($user);
                $this->Flash->success(__('The admin login successfully.'));

                return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error(__('Check username and password.'));
            }
        }
    }


    public function register(){
       $this->viewBuilder()->setLayout('loginLayout');
        if($this->request->is('post')){
             $new_entity = $this->Admins->newEntity();
            $data = $this->request->getData();
            //pr($data);die;

          $update_data =   $this->Admins->patchEntity($new_entity,$data);
          if($this->Admins->save($update_data)){
               $this->Flash->success(__('The admin has been saved.'));

              return $this->redirect(['action' => 'login']);
          }else{
                 $this->Flash->error(__('The admin could not be saved. Please, try again.'));
          }

        }
    }

    /**
     * View method
     *
     * @param string|null $id Admin/admin id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // $admin/admin = $this->Admin/Admins->get($id, [
        //     'contain' => [],
        // ]);

        // $this->set('admin/admin', $admin/admin);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // $admin/admin = $this->Admin/Admins->newEntity();
        // if ($this->request->is('post')) {
        //     $admin/admin = $this->Admin/Admins->patchEntity($admin/admin, $this->request->getData());
        //     if ($this->Admin/Admins->save($admin/admin)) {
        //         $this->Flash->success(__('The admin/admin has been saved.'));

        //         return $this->redirect(['action' => 'index']);
        //     }
        //     $this->Flash->error(__('The admin/admin could not be saved. Please, try again.'));
        // }
        // $this->set(compact('admin/admin'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin/admin id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // $admin/admin = $this->Admin/Admins->get($id, [
        //     'contain' => [],
        // ]);
        // if ($this->request->is(['patch', 'post', 'put'])) {
        //     $admin/admin = $this->Admin/Admins->patchEntity($admin/admin, $this->request->getData());
        //     if ($this->Admin/Admins->save($admin/admin)) {
        //         $this->Flash->success(__('The admin/admin has been saved.'));

        //         return $this->redirect(['action' => 'index']);
        //     }
        //     $this->Flash->error(__('The admin/admin could not be saved. Please, try again.'));
        // }
        // $this->set(compact('admin/admin'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin/admin id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        // $admin/admin = $this->Admin/Admins->get($id);
        // if ($this->Admin/Admins->delete($admin/admin)) {
        //     $this->Flash->success(__('The admin/admin has been deleted.'));
        // } else {
        //     $this->Flash->error(__('The admin/admin could not be deleted. Please, try again.'));
        // }

        // return $this->redirect(['action' => 'index']);
    }

    public function logout()
        {
          $this->loadmodel('Admins');
                $this->redirect($this->Auth->logout());
                $this->Flash->success(__('You are successfully logged out :)'));
        }
}
