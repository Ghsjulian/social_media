<?php
session_start();
include('files.php');
include_once('top.php');

echo '<br><br><br>';

include('config.php');

$session_name   = $_SESSION['user_name'];
$session_id     = $_SESSION['user_id'];
$friends_name   = $_GET['friends_name'];
$friends_id     = $_GET['friends_id'];
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
while ($data = mysqli_fetch_array($get_query)) {
$get_name_1 = $data[$col_1];
$get_name_2 = $data[$col_2];

/*
$sql = "SELECT * FROM $msg_id ";
$query = mysqli_query($conn , $sql);
while($msg=mysqli_fetch_array($query)) {
$user_1 = $msg[$col_2];
$user_2 = $msg[$col_1];
*/
?>
<br><br><br>



<div class="container content">
<div class="row">
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
<div class="card">
<div class="card-body height3">
<ul class="chat-list">
<li class="out">
<div class="chat-img">
<img src="bg4.png">
</div>
<div class="chat-body">
<div class="chat-message">
<p>Tofu master best</p>
</div>
</div>
</li>

<li class="in">
<div class="chat-img">
<img src="bg4.png">
</div>
<div class="chat-body">
<div class="chat-message">
<p>Ghs Julian ! how are you ?</p>
</div>
</div>
</li>




<li class="out">
<div class="chat-img">
<img src="bg4.png">
</div>
<div class="chat-body">
<div class="chat-message">
<p>you are talking about the one in the middle is</p>
</div>
</div>
</li>




<li class="in">
<div class="chat-img">
<img src="bg4.png">
</div>
<div class="chat-body">
<div class="chat-message">
<p>Tofu master bedroom and the truth is I don't 66</p>
</div>
</div>
</li>



<li class="out">
<div class="chat-img">
<img src="bg4.png">
</div>
<div class="chat-body">
<div class="chat-message">
<p>Tofu master Best Western Union I can't say</p>
</div>
</div>
</li>


<li class="in">
<div class="chat-img">
<img src="bg4.png">
</div>
<div class="chat-body">
<div class="chat-message">
<p>Tofu master bedroom and bathroom I can't say I have </p>
</div>
</div>
</li>






</ul>
</div>
</div>
</div>
</div>
</div>




<!---
<div class="chat_room">

<div class="texts">
    <?php echo $get_name_1 ; ?>
</div>
<div class="user1_icon">
<img src="./images/<?php echo $_SESSION['avtar'] ; ?>">
</div>

<div class="partner">
  <?php echo "okay" ; ?>
</div>
<div class="user2_icon">
<img src="./images/<?php echo $friend_avtar ; ?>">
</div>
--->
<?php
      }
   }
?>




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
        alert(data);
$("#myfrm").trigger("reset");
       }
      });
    }    else    {
   alert("please write a message");
    } 
  });
});
</script>
</body></html>
  