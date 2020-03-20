<?php

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
 <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<?= $this->Html->css('style'); ?>
</head>
<body>

    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>


<script>
//     $(function(){
// var textfield = $("input[name=user]");
//             $('button[type="submit"]').click(function(e) {
//              //  e.preventDefault();
//                 //little validation just to check username
//                 if (textfield.val() == "") {
//                     //$("body").scrollTo("#output");
//                     $("#output").addClass("alert alert-success animated fadeInUp").html("Welcome back " + "<span style='text-transform:uppercase'>" + textfield.val() + "</span>");
//                     $("#output").removeClass(' alert-danger');
//                     $("input").css({
//                     "height":"0",
//                     "padding":"0",
//                     "margin":"0",
//                     "opacity":"0"
//                     });
//                     //change button text 
//                     $('button[type="submit"]').html("continue")
//                     .removeClass("btn-info")
//                     .addClass("btn-default").click(function(){
//                     $("input").css({
//                     "height":"auto",
//                     "padding":"10px",
//                     "opacity":"1"
//                     }).val("");
//                     });
                    
//                     //show avatar
//                     $(".avatar").css({
//                         "background-image": "url('http://api.randomuser.me/0.3.2/portraits/women/35.jpg')"
//                     });
//                 } else {
//                     //remove success mesage replaced with error message
//                     $("#output").removeClass(' alert alert-success');
//                     $("#output").addClass("alert alert-danger animated fadeInUp").html("sorry enter a username ");
//                 }
//                 //console.log(textfield.val());

//             });
// });

</script>
 
</body>
</html>
