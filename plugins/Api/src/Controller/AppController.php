<?php
namespace Api\Controller;
use App\Controller\AppController as BaseController;
use Cake\Network\Response;
use Cake\Event\Event;
use Cake\Controller\Component\RequestHandlerComponent;
use App\Model\Table\UsersTable;
use PhpParser\Node\Stmt\Global_;
use Cake\Routing\Router;
use Firebase\JWT\JWT;

use Cake\Utility\Security;

class AppController extends BaseController
{
    public function initialize()
      {

         parent::initialize();
         $this->loadComponent('RequestHandler');


        
      // $this->Auth->allow();

        // try {
             $this->request->allowMethod(['post','get']);
       /*  }catch (\Exception $e) {
             $this->errorMessage('Method not allowed.');
         }*/

      }



    // public function beforeFilter(Event $event) {
    //    // if (in_array($this->request->action, ['actions_you want to disable'])) {
    //         //$this->eventManager()->off($this->Csrf);
    //   //  }
    // }
   public function echoRespnse($response)
	{
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
	}
      public function errorMessage($code,$msg)
    {
        $response["code"] = $code;
        $response["error"] = true;
        $response["message"] = $msg;
        $this->echoRespnse($response);
    }   

   public function checkAuthentication(){
$headerdata = getallheaders();
           if(isset($headerdata['Authorization']) && !empty($headerdata['Authorization']))
            {

                try{  
                  $secretkey = Security::salt(); 
                  $decoded = JWT::decode($headerdata['Authorization'], $secretkey, array('HS256'));
                  $data = json_decode(json_encode($decoded),true);

                  $this->loadModel('Admins');
                  $checkusr = $this->Admins->find()
                  ->select(['id', 'username'])
                  ->where(['id' => $data['id'],'token'=>$headerdata['Authorization']])
                  ->first(); 
                  if($checkusr){
                  	// pr($checkusr);
                  	// echo 'hi';die;
                       
                      //return $checkusr;
                  	 $this->Auth->allow(['getUserData']);

                  }else{
                      
                     $this->errorMessage(401,'Un-Authorized access1'); 

                  }
                }catch (\Exception $e) {

                   $this->errorMessage(401,'Un-Authorized access2');
       
                }
           }
   }

   public function getLoggedInUserId(){
   	$headerdata = getallheaders();
           if(isset($headerdata['Authorization']) && !empty($headerdata['Authorization']))
            {

                try{  
                  $secretkey = Security::salt(); 
                  $decoded = JWT::decode($headerdata['Authorization'], $secretkey, array('HS256'));
                  $data = json_decode(json_encode($decoded),true);

                  $this->loadModel('Admins');
                  $checkusr = $this->Admins->find()
                  ->select(['id', 'username'])
                  ->where(['id' => $data['id'],'token'=>$headerdata['Authorization']])
                  ->first(); 
                  if($checkusr){
                  	// pr($checkusr);
                  	// echo 'hi';die;
                       
                      return $data['id'];
                  	

                  }else{
                      
                     $this->errorMessage(401,'Un-Authorized access1'); 

                  }
                }catch (\Exception $e) {

                   $this->errorMessage(401,'Un-Authorized access2');
       
                }
           }
   }
public function isAuthorized($user=NULL){
	//pr($user);
	// $header = getallheaders();;
	// //pr($header);die;
	//         $secretkey = Security::salt();  
 //            $userdata['token'] = JWT::encode($user, $secretkey);
 //            $userdata1['detoken'] = JWT::decode($userdata['token'],$secretkey, array('HS256'));
 //            //pr($userdata1);
	// if($userdata1['detoken']->id == 5){
	// 	///echo 'hi';die;
	//$this->Auth->allow(['getUser']);
	// }

	 // $headerdata = getallheaders();
           
            
  //          if(isset($headerdata[Authorization]) && !empty($headerdata[Authorization]))
  //           {

  //               try{  
  //                 $secretkey = Security::salt(); 
  //                 $decoded = JWT::decode($headerdata[Authorization], $secretkey, array('HS256'));
  //                 $data = json_decode(json_encode($decoded),true);

  //                 $this->loadModel('Admins');
  //                 $checkusr = $this->Admins->find()
  //                 ->select(['id', 'username'])
  //                 ->where(['id' => $data['id'],'token'=>$headerdata[Authorization]])
  //                 ->first(); 
  //                 if($checkusr){
                       
  //                      return $checkusr;

  //                 }else{
                      
  //                    $this->errorMessage(401,'Un-Authorized access1'); 

  //                 }
  //               }catch (\Exception $e) {

  //                  $this->errorMessage(401,'Un-Authorized access2');
       
  //               }
  //          } 
  //          else
  //          { 
  //               $this->errorMessage(401,'Un-Authorized access3');
  //          }
	 
	
}


      
  
}