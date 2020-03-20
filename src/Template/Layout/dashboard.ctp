<?php

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
  

    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
    <?= $this->Html->css('dashboard'); ?>
</head>
<body>

        <?= $this->Flash->render() ?>
   
        <?= $this->fetch('content') ?>

        <script type="text/javascript">
            $(function(){
                $(".heading-compose").click(function() {
                $(".side-two").css({
                    "left": "0"
                });
                });

                $(".newMessage-back").click(function() {
                $(".side-two").css({
                    "left": "-100%"
                });
                });
            });


//fetch user data
$('#message').emojioneArea({
   pickerPosition:"top",
   toneStyle: "bullet"
  });
$(document).ready(function(){

  
     
        // $(document).keypress(function(e){
        //     var message = $('#message').val();
        //   //  if(message != ''){
        //       //  alert(message);
        //         if(e.keyCode == 13 && message != ' '){
        //             $('.reply-send').trigger('click');
        //         }
        //    // }
           
            
            
        // });

    fetch_chat_user_list();
   
    setInterval(() => {
    //    checkKeyUp();
    //   updateuserChatHistory();
    //    fetch_chat_user_list();
}, 1000);

});

function test(){
    var ph = $("#conversation").scrollTop();
    return ph;
}
function getUserId(index){
  
    var userid = $('#userDetail'+index).data('userid');
    var username = $('#userDetail'+index).data('username');
  
    $.ajax({
        url:'<?= $this->Url->build(["controller"=>"Chats","action"=>"getUserChatHistory"])?>',
        method:'post',
        data:{userid:userid,username:username},
        success:function(response){
            var obj = JSON.parse(response);
            $('#userChatHistory').html(obj.htmlData);
            var elem = document.getElementById('conversation');
                elem.scrollTop = elem.scrollHeight;
        }
    });
    
} 
function oldConversationBoxHeight(){
    
    var elem = document.getElementById('conversation');
             return  elem.scrollHeight;   //2761
}

function updateuserChatHistory(){
    var ph2 = test();
  //alert(height());
  var totalcoHeight = '';
  var totalcoHeight = oldConversationBoxHeight();
    var toUser = $('#touser').val();
        var fromUser = $('#fromuser').val();
        var message = $('#message').val();
     //if(ph2 != 0){
        $.ajax({
        url:'<?= $this->Url->build(['controller'=>'Chats','action'=>'getUserChatHistory'])?>',
        method:'post',
        data:{userid:toUser,ph2:ph2},
        success:function(response){
            var obj = JSON.parse(response);
            $('#userChatHistory').html(obj.htmlData);
            var elem = document.getElementById('conversation');
              //  alert(elem.scrollHeight);   //2761

             //   alert(obj.scrollpos); //2252
            if(totalcoHeight < elem.scrollHeight){
                //elem.scrollTop = elem.scrollHeight;
                $('#conversation').scrollTop(elem.scrollHeight);
            }else{
                $('#conversation').scrollTop(obj.scrollpos);
            }
           
            $('#message').val(message);
            $('#message').focus();
          
        }
    });
    //}
     
}


function fetch_chat_user_list(){
    var userlist = 'chatUserList';
    $.ajax({
        url:'<?= $this->Url->build(['controller'=>'Chats','action'=>'dashboard'])?>',
        data:{userlist:userlist},
        method:'post',
        success:function(data){
            //alert(data);
           $('#userChatList').html(data);
        }

    });
}

function sendMessage(){
    //$('.reply-send').click(function(){
        
        var message = $('#message').val();
        var toUser = $('#touser').val();
        var fromUser = $('#fromuser').val();
        if(message != ''){
        
            $.ajax({
                url:'<?= $this->Url->build(['controller'=>'Chats','action'=>'insertChatData'])?>',
                method:'post',
                data:{from_user:fromUser,to_user:toUser,message:message},
                success:function(response){
                 //alert(response);
                   $('#message').val('');
                  
                   var elem = document.getElementById('conversation');
                    elem.scrollTop = elem.scrollHeight;
                    updateuserChatHistory();
           

                }
            });
        }
       
    //});
}

function checkKeyUp(){
    var is_type = 'no';
    $.ajax({
        url:'<?= $this->Url->build(['controller'=>'Chats','action'=>'updateIsTypeStatus'])?>',
        method:'post',
        data:{is_type:is_type},
        success:function(response){
           // alert(response);
        }
    });
}

function checkKeyDown(){
    var is_type = 'yes';
    $.ajax({
        url:'<?= $this->Url->build(['controller'=>'Chats','action'=>'updateIsTypeStatus'])?>',
        method:'post',
        data:{is_type:is_type},
        success:function(response){
            //alert(response);
        }
    });
}


</script>
 
</body>
</html>
