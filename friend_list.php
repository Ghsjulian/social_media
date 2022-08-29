<?
 session_start();
 if ($_SESSION['user_id']) {
 include('files.php');
 include('top.php');
 echo '<br><br><br>';
include('config.php');
$from_user = $_SESSION['user_id'];
$sql = "SELECT * FROM users";
$query = mysqli_query($conn,$sql);
while ($data = mysqli_fetch_array($query)) {
$user_id = $data['user_id'];
$users_name = $data['name'];


$sql2 = "SELECT * FROM users WHERE user_id='$user_id' AND name='$users_name'";
$query2 = mysqli_query($conn,$sql2);
while ($data2 = mysqli_fetch_array($query2)) {
$avtar = $data2['profile_photo'];

if ($user_id !== $_SESSION['user_id']){
  
$sql_2 = "SELECT * FROM `requests` WHERE from_id='$from_user'AND to_id='$user_id'";
$query_2 = mysqli_query($conn,$sql_2);
$data_user = mysqli_fetch_array($query_2);
$data_from_id   = $data_user['from_id'];
$data_to_id     = $data_user['to_id'];
 if(!empty($data_to_id) && !empty($data_from_id)) {
$sql_3 = "SELECT * FROM users WHERE user_id='$data_to_id'";
$query_3 = mysqli_query($conn,$sql_3);
while ($data_3 = mysqli_fetch_array($query_3)) {
  $sent  =  $data_3['name'];

?>

<div class="users_list">
<div class="person">
<a href="users_profile.php?friends_id=<?php echo $user_id ?>">
<img src="./images/<?php echo $avtar;?>">
<strong>
<?php echo $users_name; ?>
</strong></a>
<button id="request_btn" data-user="<?php echo $data_to_id  ?>" class="disabled_btn ">Request Sent</button>
 </div>
</div>
 <?php  }
 } else {
   ?>

<div class="users_list">
<div class="person">
<a href="users_profile.php?friends_id=<?php echo $user_id ; ?>">
<img src="./images/<?php echo $avtar;?>"><strong ><?php echo $users_name ; ?></strong></a>
<button id="request_btn" data-user="<?php echo $user_id ?>" class="send_request_btn ">Add Friend</button>
 </div>
</div>
<?php
                
              }
            }
        }
     }  
?>
<script src="jquery.min.js"></script>
<script>
 $(document).ready(function() {
 $(".send_request_btn").click(function (e){
e.preventDefault();
var today, someday, text;
today = new Date();
someday = new Date();
someday.setFullYear;
var person = $(this).data("user");
var action = "send_friend_request";
$.ajax({
         url  : "function.php",
         type : "POST",
         data : "request_to_id="+person+"&action="+action+"&date="+someday,
          success : function (data) {
           $server = data;
         }
       });
  $(this).addClass("sent").removeClass("send_request_btn").fadeIn("slow"). text("Sending...");
   });
});
</script>

</body></html>
<?php
}    else   {
header('location:login_form.php');
}
?>
