<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use ADmad\JwtAuth\Auth;
use Firebase\JWT\JWT;
use Cake\Utility\Security;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
$this->loadmodel('Admins');
$this->loadmodel('Users');
        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
 
    //     $this->Auth->allow(['login','register','logout']);  

if( !empty($this->request->params['prefix']) && $this->request->params['prefix']==='admin' )
  {
      
                //pr($this->request->params['prefix']==='admin');exit();
                $this->loadComponent('Auth', [
                'authorized'=> 'Controller',
                'authenticate' => [
                    
                    'Form' => [
                        // fields used in login form
                        'fields' => [
                            
                            'username' => 'username',
                            'password' => 'password'
                        ],
                           'userModel' => 'Admins'
                    ]
                ],
                
                
                // login Url
                'loginAction' => [
                     'userModel' => 'Admins',
                    'controller' => 'Admins',
                    'action' => 'login',
                    'prefix' => 'admin'
                ],
                
                //login redirect
                'loginRedirect' => array(

                        'controller' => 'Admins',
                        'action' => 'index',
                        'prefix' => 'admin'
                    ),
            //logout redirect
            
             'logoutRedirect' => array(
                
                        'controller' => 'Admins', 
                        'action' => 'login',
                        'prefix' => 'admin'
                ),
                // if unauthorized user go to an unallowed action he will be redirected to this url
                'unauthorizedRedirect' => [
                    'controller' => 'Admins',
                    'action' => 'login',
                    'prefix' => 'admin'
                    
                ],
                'authError' => 'Did you really think you are allowed to see that?',
                ]);
               
                
                
        }
            
        // else if(!isset($this->request->params['prefix']) && $this->request->params['prefix'] =='/')
        // {
        //     echo 'hi';die;
        //     $this->loadComponent('Auth', [
        // 'authorize'=> 'Controller',
        // 'authenticate' => [
        //     'Form' => [
        //         // fields used in login form
        //         'fields' => [
                    
        //             'username' => 'username',
        //             'password' => 'password'
        //         ],  
        //         'userModel' => 'Users'
        //     ]
        // ],
        
        
        // // login Url
        // 'loginAction' => [
        //     'controller' => 'Chats',
        //     'action' => 'login'
        // ],
        // //login redirect
        // 'loginRedirect' => array(

        //         'controller' => 'Chats',
        //         'action' => 'index'
        //     ),
        // //logout redirect
            
        //      'logoutRedirect' => array(
                
        //                 'controller' => 'Users', 
        //                 'action' => 'login'
                        
        //         ),
        // // if unauthorized user go to an unallowed action he will be redirected to this url
        // 'unauthorizedRedirect' => [
        //     'controller' => 'Chats',
        //     'action' => 'login'//,
        //     //'home'
        // ],
        // 'authError' => 'Did you really think you are allowed to see that?',
        // ]);
        
        // // Allow the display action so our pages controller still works and  user can visit index and view actions.
        // $this->Auth->allow(['login','register','home']);  
        // }
    }

    public function isAuthorized($user = null)
    {
        // Any registered user can access public functions
        if (!$this->request->getParam('prefix')) {
            return true;
        }

        // Only admins can access admin functions
        if ($this->request->getParam('prefix') === 'admin') {
            return (bool)($user['role'] === 'admin');
        }

        // Default deny
        return false;
    }

    public function __getUserData($id=null){
        $data = $this->Users->get($id);
        return $data;
    }

    public function beforeFilter(Event $event)
{
    parent::beforeFilter($event);

//     $checkloggedInUser = $this->request->getSession()->check('Auth.User.id');
//    // echo $loggedInUser;die;
// if($checkloggedInUser){
//     $loggedInUser = $this->request->getSession()->read('Auth.User.id');
//     if(!empty($loggedInUser)){
//         $userData = $this-> __getUserData($loggedInUser);
//         $userData->login_status = '1';
//         $this->Users->save($userData);
//     }else{
//         $userData = $this-> __getUserData($loggedInUser);
//         $userData->login_status = '0';
//         $this->Users->save($userData);
//     }
// }
  

}
    // public function isAuthorized(){
    //     $this->Auth->allow(['dashboard']);  
    // }

    //    public function beforeRender(Event $event)
    // {
    //     if (!array_key_exists('_serialize', $this->viewVars) &&
    //         in_array($this->response->type(), ['application/json', 'application/xml'])
    //     ) {
    //         $this->set('_serialize', true);
    //     }
    // }
}
