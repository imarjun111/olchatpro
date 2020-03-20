<?php
// plugins/ContactManager/src/Controller/ContactsController.php
namespace Api\Controller;

use Api\Controller\AppController;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;
use Cake\Core\Exception\Exception;
use Firebase\JWT\JWT;
use admad\JwtAuth\Auth;
use Cake\Utility\Security;

class ApisController extends AppController
{
	public function initialize(){
		parent::initialize();
		 $this->loadComponent('RequestHandler');
		$this->loadComponent('Auth');
		 $allowMethod = array('register','login','getData');
		 $this->Auth->allow($allowMethod);

		 //$headerdata = getallheaders();
		 //pr($headerdata['Authorization']);die;
		  	 // $headerdata = getallheaders();
           
        $this->checkAuthentication();
         // if($checkValidUser){
         // 	 $this->Auth->allow(['getUserData']);
         // }
       // $uid = ''; 
		
		   $this->Auth->config([
		   	'authorized'=> 'Controller',
            'storage' => 'Memory',
            'authenticate' => [
            	  'Form' => [
		               
		                'fields' => [
		                    'username' => 'username',
		                    'password' => 'password',
		                ],
		               'userModel'=>'Admins'
		            ],
                'ADmad/JwtAuth.Jwt' => [
                    'userModel' => 'Admins',
                    'fields' => [
                        'username' => 'id'
                    ],

                    'parameter' => 'token',

                    // Boolean indicating whether the "sub" claim of JWT payload
                    // should be used to query the Users model and get user info.
                    // If set to `false` JWT's payload is directly returned.
                    'queryDatasource' => false,
                ]
            ],

            'unauthorizedRedirect' => false,
            'checkAuthIn' => 'Controller.initialize',

            // If you don't have a login action in your application set
            // 'loginAction' to false to prevent getting a MissingRouteException.
            'loginAction' => true
        ]);
	}

	public function getData(){
		$this->autoRendor = false;
		$this->loadmodel('Admins');
		//echo 'hi';die;
		  $arr = array('id'=>'1','name'=>'test','password'=>'123456');
		  $payload = array(
                "id" => $arr['id'],
                "user"=> $arr,
                "authoruri" => "http://localhost/cakenewtest/",
                "exp" => time()+(3600 * 24 * 365 * 10 ),  //10 years
            );  
		    $secretkey = Security::salt();  
            $userdata['token'] = JWT::encode($payload, $secretkey);
            $user = $this->Admins->find('all')->where(['id'=>1])->first();
            $user->token = $userdata['token'];
            $this->Admins->save($user);
            $res['status'] = 200;
            $res['msg'] = 'jwt token generated';
            $res['data'] = $userdata;
            echo json_encode($res);
	}

	public function login(){
		$this->autoRender = false;
		$this->loadmodel('Admins');
		if($this->request->is('post')){
			//$this->autoRender = false;
			$data = $this->request->getData();
			//pr($data);die;
			$userData = $this->Auth->identify();
			//pr($user);die;
			$this->Auth->setUser($userData);
			$user = $this->Admins->find()->select(['id','username'])->where(['id'=>$userData['id']])->first();
			$payload = array(
                "id" => $user['id'],
                "user"=> $user,
                "authoruri" => "http://localhost",
                "exp" => time()+(3600 * 24 * 365 * 10 ),  //10 years
            );  
		    $secretkey = Security::salt();  
            $userdata['token'] = JWT::encode($payload, $secretkey);
            $token = $userdata['token'];

            $user1 = $this->Admins->find('all')->where(['id'=>$user['id']])->first();
           // pr($user1);die;
           // $user1->token = $token;
            $updateToken = $this->Admins->patchEntity($user1,$userdata);
            $this->Admins->save($updateToken);
			if($user){
				 	$res['status'] = 200;
		            $res['msg'] = 'login successfully';
		            $res['token'] = $userdata;
		            echo json_encode($res);
			}else{
					$res['status'] = 404;
		            $res['msg'] = 'login failed';
		            echo json_encode($res);
			}

		}
	}

	public function getUserData(){
		//$uid = $this->request->session()->read('User.Auth.id');
		  $uid = $this->Auth->user('id');  
		//$uid = $this->getLoggedInUserId();
		//echo $uid;die;
		$this->autoRender = false;
//echo "hi";die;
		
		$this->loadmodel('Admins');
		$data = $this->Admins->find('all')->toArray();
		// echo "<pre>";
		// print_r($data);
		if($data){
			$res['status'] = 200;
			$res['msg'] = 'User data found';
			$res['data'] = $data;

		}else{
			$res['status'] = 404;
			$res['msg'] = 'User data not found';
			$res['data'] = $data;
		}

		echo json_encode($res);
	}


	public function register(){
		if($this->request->is('post')){
			$data = $this->request->getData();
			$new = $this->Admins->newEntity();
			$addData = $this->Admins->patchEntity($new,$data);
			if($this->Admins->save($addData)){
					$res['status'] = 200;
					$res['msg'] = 'Registered successfully';
					$res['data'] = $data;
			}else{
					$res['status'] = 404;
					$res['msg'] = 'Registeration failed';
					$res['data'] = $data;
			}

			echo json_encode($res);
		}
	}

	
}

?>