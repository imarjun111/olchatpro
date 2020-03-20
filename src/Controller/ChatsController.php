<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Error\Debugger;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\Table;
use App\Model\Entity\Role;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\SessionHelper;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Routing\Router;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;
use Cake\I18n\FrozenTime;

// src/Controller/UsersController.php



class ChatsController extends AppController
{

    public function initialize(){
      // $loggedInUser = $this->request->getSession()->read('Auth.User.id');
      // echo $loggedInUser;die;
        parent::initialize();
      
        $this->loadmodel('ChatMessages');
        $this->loadComponent('Auth', [
            'authorize'=> 'Controller',
            'authenticate' => [
                'Form' => [
                    // fields used in login form
                    'fields' => [
                        
                        'username' => 'username',
                        'password' => 'password'
                    ],  
                    'userModel' => 'Users'
                ]
            ],
            
            
            // login Url
            'loginAction' => [
                'controller' => 'Chats',
                'action' => 'login'
            ],
            //login redirect
            'loginRedirect' => array(
    
                    'controller' => 'Chats',
                    'action' => 'index'
                ),
            //logout redirect
                
                 'logoutRedirect' => array(
                    
                            'controller' => 'Users', 
                            'action' => 'login'
                            
                    ),
            // if unauthorized user go to an unallowed action he will be redirected to this url
            'unauthorizedRedirect' => [
                'controller' => 'Chats',
                'action' => 'login'//,
                //'home'
            ],
            'authError' => 'Did you really think you are allowed to see that?',
            ]);
            
            // Allow the display action so our pages controller still works and  user can visit index and view actions.
            $this->Auth->allow(['login','register','home']);  
    }



    public function login(){
        $this->viewBuilder()->setLayout('userLoginLayout');
        if($this->request->is('post')){
            $data = $this->request->getData();
            $user = $this->Auth->identify();
            if($user){
                $userData = $this-> __getUserData($user['id']);
                $userData->login_status = '1';
                $this->Users->save($userData);
                $this->Auth->setUser($userData);
                $this->Flash->success(__('Login successfully'));
                return $this->redirect(['action'=>'dashboard']);
            }else{
                $this->Flash->error(__('Login Failed'));
            }

        }

    }

    public function register(){
        $this->viewBuilder()->setLayout('userLoginLayout');
        if($this->request->is('post')){
            $data = $this->request->getData();
            //pr($data);die;
            $newEntity = $this->Users->newEntity();
            $update = $this->Users->patchEntity($newEntity,$data);
            if($this->Users->save($update)){
                $this->Flash->success(__('Register successfully'));
                return $this->redirect(['controller'=>'Chats','action'=>'login']);
            }else{
                $this->Flash->error(__('Failed to register data'));
            }
        }
    }



    public function dashboard(){
        $this->viewBuilder()->setLayout('dashboard');
        $logged_in = $this->request->getSession()->read('Auth.User.id');
      if($this->request->is('post')){
        $data = $this->request->getData();
        //pr($data);
        if($data['userlist']=='chatUserList'){
            //echo 'hello';
            $userData = $this->Users->find('all')->where(['id IS NOT'=>$logged_in])->toArray();
            // $this->set('users',$userData);
            $output = '';
            foreach($userData as $user){
               // echo $user->id;
             $clr = ($user->login_status == '1')?'green':'red';
           // if($user->id == '4'){
              $unseenMessage = $this->countUnseenMessage($logged_in,$user->id);
          //  }else{
            //  $unseenMessage = '';
           // }
             $output .= ' <a href="javascript:void(0);" data-userid="'.$user->id.'" data-username="'.$user->username.'" id="userDetail'.$user->id.'" onclick="getUserId('.$user->id.')"> 
             <div class="col-sm-3 col-xs-3 sideBar-avatar" style="height:60px">
                           
                            <div class="avatar-icon">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" style="border: 3px solid '.$clr.'">
                            </div>
                            </div>
                            <div class="col-sm-9 col-xs-9 sideBar-main" style="height:60px">
                            <div class="row">
                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                <span class="name-meta">'.$user->username.' '.$unseenMessage.' '.$this->fetchTyping($user->id).'
                                </span>

                                </div>
                            </div>
                          
                            </div>  </a>';
            }
            echo $output;
        }
        exit;
      }
    }


    public function getUserChatHistory(){
     // $this->autoRendor = false;
     //exit;
        $this->loadmodel('ChatMessages');
        $output ='';
        $loggedInUser = $this->request->getSession()->read('Auth.User.id');
        if($this->request->is('post')){
            $data = $this->request->getData();
          // pr($data);
            $toUserId = $data['userid'];
            $getUsername = $this->__getUserData($toUserId);
            $username = $getUsername['username'];
            $conn = ConnectionManager::get('default');
            $stmt = $conn->execute("SELECT * FROM chat_messages 
            WHERE (from_user = '".$loggedInUser."' 
            AND to_user = '".$toUserId."') 
            OR (from_user = '".$toUserId."' 
            AND to_user = '".$loggedInUser."') 
            ORDER BY created ASC
            ");
            $histories = $stmt ->fetchAll('assoc');
          //  $histories = $this->ChatMessages
          //                    ->find('all')
          //                    ->where(['from_user'=>$loggedInUser,'to_user'=>$toUserId])
          //                    ->toArray();
          // pr($history);
        //  sql($histories);
       // debug($histories);
$online = ($getUsername['login_status']=='1')?'online':'offline';
  $typing =  (!empty($this->fetchTyping($toUserId)))? $this->fetchTyping($toUserId):$online;
        
           $output .='<div class="col-sm-8 conversation">
                      <div class="row heading">
                        <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar">
                          <div class="heading-avatar-icon">
                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png">
                          </div>
                        </div>
                        <div class="col-sm-8 col-xs-7 heading-name">
                          <a class="heading-name-meta">'.$username.'
                          </a>
                         
                          <p> '.$typing.'</p>

                        </div>
                        <div class="col-sm-1 col-xs-1  heading-dot pull-right">
                          <i class="fa fa-ellipsis-v fa-2x pull-right" aria-hidden="true"></i>
                        </div>
                      </div>
                <!-- conversation heading-->
                      <div class="row message" id="conversation">
                     ';
$output .= '<div>';
          foreach($histories as $history){
           // if($history['to_user'] == $toUserId){
            $time = new FrozenTime($history['created']);
            if($history['to_user'] == $toUserId){
              $main = 'message-main-sender';
              $sentType = 'sender';
            }else {
             
              $main = 'message-main-receiver';
              $sentType = 'receiver';
            }
           
              $output .= '<div class="row message-body">
                          <div class="col-sm-12 '.$main.'">
                            <div class="'.$sentType.'">
                              <div class="message-text">
                                '.$history['message'].'
                              </div>
                              <span class="message-time pull-right">
                              '.$time->format('H:i A').'
                              </span>
                            </div>
                          </div>
                        </div>';
 
             }
         
          $output .= '<div class="row reply" style="position: absolute;bottom: 0px;">
                      <form method="post" id="chatForm">
                          <div class="col-sm-1 col-xs-1 reply-emojis">
                            <i class="fa fa-smile-o fa-2x"></i>
                          </div>
                          <div class="col-sm-9 col-xs-9 reply-main">
                            <textarea class="form-control" id="message" onkeyup="checkKeyUp()" onkeydown="checkKeyDown()"></textarea>
                            <input type="hidden" id="touser" value="'.$toUserId.'">
                            <input type="hidden" id="fromuser" value="'.$loggedInUser.'">
                          </div>
                          <div class="col-sm-1 col-xs-1 reply-recording">
                            <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
                          </div>
                          <div class="col-sm-1 col-xs-1 reply-send" onclick="sendMessage()">
                            <i class="fa fa-send fa-2x" aria-hidden="true"></i>
                          </div>
                      </form>
           </div>';
           $output .= '</div>';
        //update status
        //$tablename = TableRegistry::get("Model");
        $tablename = $this->ChatMessages;
        $query = $tablename->query();
            $result = $query->update()
                    ->set(['status' => '0'])
                    ->where(['from_user' => $toUserId,'to_user'=>$loggedInUser,'status'=>'1'])
                    ->execute();
        if(isset($data['ph2']) && !empty($data['ph2'])){
           $ph2 = $data['ph2'];
         }else{
          $ph2 = '0';
         }
         $dataArr = array('scrollpos'=>$ph2,'htmlData'=>$output);
         echo json_encode($dataArr);
           exit;
        }
        exit;
    }


    public function insertChatData(){
      $newEntity = $this->ChatMessages->newEntity();
        if($this->request->is('post')){
            $data = $this->request->getData();
         
            $data['status'] = '1';
        // pr($data);
          
          $update = $this->ChatMessages->patchEntity($newEntity,$data);
          $this->ChatMessages->save($update);
            exit;
        }
    }

    public function countUnseenMessage($loggedInUser,$toUserId){
      $output ='';
        $countUnseen = $this->ChatMessages->find()->where(['from_user'=>$toUserId,'to_user'=>$loggedInUser,'status'=>'1'])->count();
        if($countUnseen > 0)
          {
            $output = '<span class="label label-success">'.$countUnseen.'</span>';
          }
          return $output;
    }

    public function updateIsTypeStatus(){
      $loggedInUser = $this->request->getSession()->read('Auth.User.id');
     $userData = $this->Users->get($loggedInUser);
      if($this->request->is('post')){
        $data = $this->request->getData();
       // pr($data);exit;
        $isType = $data['is_type'];
        $userData->is_type = $isType;
        $this->Users->save($userData);
      
      }
      exit;
    }

    public function fetchTyping($userId){
      $output = '';
      $data = $this->Users->find()->where(['id'=>$userId])->first();
      if($data["is_type"] == 'yes')
        {
        $output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
        }
        return $output;
    }

    public function logout(){
        $userId = $this->request->session()->read('Auth.User.id');
                $userData = $this-> __getUserData($userId);
                $userData->login_status = '0';
                $this->Users->save($userData);
        $this->request->Session()->destroy();
        return $this->redirect(['controller'=>'Chats','action'=>'login']);
        $this->Flash->success(__('You are successfully logged out :)'));
    }

}
