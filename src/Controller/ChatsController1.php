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

// src/Controller/UsersController.php



class ChatsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->loadComponent('Auth');
        $this->Auth->allow(['getallmsg']);
       
     /*
       if (in_array($this->request->action, ['getallmsg'])) {
         $this->eventManager()->off($this->Csrf);
     }
     */

    }

    public function getallmsg($verifyid=null) {
     //$this->viewBuilder()->layout('blank');
     if($verifyid!="" && $verifyid=="123456789")
      {

        $chattbl = TableRegistry::get("ChatHistory");
        $chattbldata = $chattbl->find('all',['order'=>['ChatHistory.date_time'=>'DESC']])->limit(50)->toArray();
        $chattbldata = array_reverse($chattbldata);
        if(count($chattbldata) >0) {
          foreach ($chattbldata as $chatkey => $chatvalue) {
              $emoarrayGet = $this->getemoticonsep();
              $chattxt = $this->replaceEmojiChat($emoarrayGet ,$chatvalue['message']);
              $chattime = strtotime($chatvalue['date_time']);
              //$chattxt = $chatvalue['message'];
              $chatauthor = $chatvalue['username'];
              $chatcolor = "black";

              $arr[] = array("time"=>$chattime,"text"=>$chattxt,"author"=>$chatauthor,"color"=>$chatcolor);
          }
           echo json_encode($arr);
        }

      }else {
// echo "hi";
      }
         exit;
    }

      public function getemoticonsep()
  { 
    $currencyData = TableRegistry::get('Emoticons');
    $aProgramSendbacks = $currencyData->find('all');  

    if($aProgramSendbacks)
    {
      foreach ($aProgramSendbacks as $akey => $avalue) {
        $arrEmoji[] = $avalue['name'];
      }
    }
    return $arrEmoji;
  }
 

 function replaceEmojiChat($arremo,$string) {
  //$webrootaddr = $this->request->webroot;
    $servername = $_SERVER['SERVER_NAME'];
  if($servername=="localhost") {
       $webrootaddr = $this->request->webroot;
     }else {
       $webrootaddr ="https://www.thecoderain.blogspot.in/";
    }
   // $webrootaddr = "https://www.dc-ex.com/webroot/";
  foreach ($arremo as $arkey => $arvalue) {
    $keyvcal = ":".$arvalue;
    $my_smilies[$keyvcal]='<img class="emojismile" src="'.$webrootaddr.'emoji/'.$arvalue.'.gif" alt="" />';
  }
 
     return str_replace( array_keys($my_smilies), array_values($my_smilies), $string);
  }

}
