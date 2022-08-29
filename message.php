<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="./css/bts.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" href="./font/css/all.min.css">
<!--===============================================================================================-->

 <link rel="stylesheet" href="./font/css/fontawesome.min.css">
 <!--===============================================================================================-->
 <link rel="stylesheet" href="./font/css/fontawesome.css">
 <!--===============================================================================================-->

<link rel="stylesheet" href="./file.css">
<!--===============================================================================================-->
 <script src="jquery.min.js"></script>
 <!--===============================================================================================-->
 <link rel="stylesheet" href="./notification.css">
 <!--===============================================================================================-->

 	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./message_style.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./message.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./ux_ui.style.css">
  <title>Nothing</title>
<body>

<div class="icon-bar fixed-top">
<ul>
<li id="cmd" data-value=".home" class="active">
<a class="home_icon" href="./profile.php?userId=<?php echo$user_id?>"><img src="./images/<?php echo $_GET['friends_avtar'];  ?>"></a> 
<strong><?php echo  $_GET['friends_name'] ; ?></strong>
</li>
</ul>
</div>

<?php

echo '<br><br><br>';

include('config.php');

$session_name   = $_SESSION['user_name'];
$session_id     = $_SESSION['user_id'];
$friends_name   = $_GET['friends_name'];
$friends_id     = $_GET['friends_id'];
$friends_avtar  = $_GET['friends_avtar'];
$user_id        = $_GET['user_id'];
$msg_id         = $_GET['msg_id'];

$get_icon = "SELECT `profile_photo` FROM `users` WHERE `user_id`='$friends_id'";
$icon_query = mysqli_query($conn , $get_icon);
$icon = mysqli_fetch_array($icon_query);
$friend_avtar = $icon['profile_photo'];


$col_1 = str_replace(" " , "" , $friends_name);
$col_2 = str_replace(" " , "" , $session_name);

$get_colam_id = "SELECT * FROM $msg_id WHERE $session_id ";
$get_query = mysqli_query($conn , $get_colam_id);
if(!$get_query) {
$insert_id = "INSERT INTO $msg_id(user_1,user_2) VALUES ($session_id , $friends_id)";
$insert_query = mysqli_query($conn , $insert_id);
}   else   {

$chat = "SELECT $col_2 , $col_2 FROM $msg_id";
$chat_query = mysqli_query($conn , $get_colam_id);

while ($data = mysqli_fetch_array($chat_query)) {
$get_name_1 = $data[$col_1];
$get_name_2 = $data[$col_2];
$mydata = array('$get_name_1','$get_name_2');
if ($_SESSION['user_id'] && !empty($get_name_2)) {
?>
<ul class="chat-list">
<li class="out">
<div class="chat-img">
<img src="./images/ghs.png">
</div>
<div class="chat-body">
<div class="chat-message">
<p><?php echo $data[$col_2] ; ?></p>
</div>
</div>
</li>
</ul>
<?php
      } 
if (!empty($get_name_1)) {
?>

<ul class="chat-list sms">

</ul>


<?php   }
   }
}
?>
<!---
<ul class="chat-list">
<?php 
if ($_SESSION['user_id']) {
?>
<li class="out">
<div class="chat-img">
<img src="./images/ghs.png">
</div>
<div class="chat-body">
<div class="chat-message">
<p><?php echo $get_name_2 ; ?></p>
</div>
</div>
</li>
<?php
}
?>


<li class="in">
<div class="chat-img">
<img src="./images/ghs.png">
</div>
<div class="chat-body">
<div class="chat-message">
<p><?php echo $get_name_1 ; ?></p>
</div>
</div>
</li>
</ul>
<?php
    
?>
<ul class="chat-list data">

</ul>
--->
	<div align="center" class="icon-bar fixed-bottom">
<div align="center" class="type_area">
  <ul>
    <li>
<form id="myfrm">
<button class="msg_btn">
  <img src="./google_icons/plus.png">
</button>

<input type="text" name="msg_id" value="<?php echo $msg_id ; ?>" hidden="true">
<input type="text" name="friends_name" value="<?php echo $friends_name ; ?>" hidden="true">
<input type="text" rows="50" id="message" class="message" name="messages" placeholder="Write A Message..." />
<button type="submit" class="msg_btn send_btn" id="msg_btn" value="">  <img src="./icons/send-message.png">
</button>
</form>
</li>
</ul>
</div>
</div>

<script src="jquery.min.js"></script>
<script>
$(document). ready (function () {
$("#myfrm"). on("submit",function(e){
e.preventDefault();
var message = $(".message").val();
if (message !== "") {
var msg = new FormData(this);
$.ajax({
        url : "messanger.php",
        type : "POST",
        data : msg,
        contentType : false,
        processData : false,
        success: function (data) {
$(".sms").fadeIn("slow").html(data);
$("#myfrm").trigger("reset");
       }
      });
    }    else    {
   alert("please write a message");
    } 
  });
  
setInterval(function () {
$(".sms").load("messanger.php").fadeIn("slow");
   },1000);
});
</script>
</body>
</html>
