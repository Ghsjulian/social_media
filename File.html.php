<!----STARTED USERS LIST--->

<?php
session_start();
include('files.php');

include 'config.php';
$session_user_name = $_SESSION['user_name'];
$session_user_id = $_SESSION['user_id'];

/*=======≠=============================≠
  <--------GET ALL FRIENDS-------->
======================================*/

$sql_1 = "SELECT `id`, `session_user`, `my_friends`, `my_friend_id`, `msg_id` FROM `friends` WHERE `session_user`='$session_user_id' OR `my_friend_id`='$session_user_id'";
$query_1 = mysqli_query($conn , $sql_1);

if ($query_1)  {
while ($get_all_friends = mysqli_fetch_array($query_1)) {
$friends_name =$get_all_friends['my_friends'];
$friends_id = $get_all_friends['my_friend_id'];

/*=======≠=============================≠
  <--------GET PROFILE AVATAR-------->
======================================*/

$sql_2 = "SELECT `profile_photo` FROM `users` WHERE `user_id`='$friends_id'";
$query_2 = mysqli_query($conn , $sql_2);
while($icon=mysqli_fetch_array($query_2)) {
$avtar = $icon['profile_photo'];

?>


<ul class="chat_list">
<a href="chat_room.php?user_id=<?php echo $friends_id ?>">
<li class="">
<img src="./images/<?php echo $avtar ; ?>"><strong><?php echo $friends_name;?></strong>
</li>
</a>
</ul>




<?php      }
       }
   }      else     {
  echo "You Haven't Any Friends !";
}

?>