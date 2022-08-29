<?php
session_start();
if ($_SESSION['user_id'])  {
include('config.php');
$sessin_id = $_SESSION['user_id'];
$get_info = "SELECT * FROM users WHERE user_id='$sessin_id'";
$get_query = mysqli_query($conn,$get_info);
if ($get_query) {
$mydata = mysqli_fetch_array($get_query);
$name = $mydata['name'];
$country = $mydata['user_country'];
$profession = $mydata['profession'];
$city = $mydata['user_city'];
$school = $mydata['school'];
$profile_photo = $mydata['profile_photo'];
$_SESSION['avtar'] = $profile_photo;
$birth = $mydata['birthday'];
$gender = $mydata['gender'];
}

include('files.php'); 
include('top.php');
/*========================================
<!-----DISPLAYING ALL DATABASES------>
========================================*/

?>
<br><br><br>
<!---STARTED PROFILE--->
<div align="center" class="profile">
  <img class="profile_user_icon" src="./images/<?php echo $profile_photo; ?>">
 <h4><?php echo $name;?></h4>
 <p>If You Want To Change Your World , So First Change Yourself !</p>
<?php 
if ($_SESSION['user_id'] == $get_id ) {
?>
<button name="request_btn" type="button" class="request_btn" data-user="<?php echo $get_id ?>">
<a href="update_info.php">
Edit
</a>
</button>
<button name="request_btn" type="button" class="request_btn " data-user="<?php echo $get_id ?>">
<a href="message.php?friends_name=<?php echo $friends_name ?>&friends_id=<?php echo $friends_id ?>&user_id=<?php echo $id ?>&msg_id=<?php echo $msg_id ?>&friends_avtar=<?php echo $avtar ; ?>">
Messages
</a>
</button>
<button name="request_btn" type="button" class="request_btn " data-user="<?php echo $get_id ?>">
  <a href="friend_list.php">
Friends
</a>
</button>
<?php
   }        else        {
?>
 <div class="actions">
<?php  
$sql3 = "SELECT * FROM `requests` WHERE
`to_id`='$get_id' AND `from_id`='$sessin_id'";
$query3 = mysqli_query($conn , $sql3);

$sql4 = "SELECT * FROM `friends` WHERE `session_user`='$sessin_id' AND `my_friend_id`='$get_id'"; 
$query4 = mysqli_query($conn , $sql4);
if(mysqli_num_rows($query4))  {
?>
<button name="request_btn" type="button" class="request_btn request_bttn" data-user="<?php echo $get_id ?>">
Friends
</button>
<?php
}
if (mysqli_num_rows($query3) == 1)   {
?>
<button name="request_btn" type="button" class="request_btn" data-user="<?php echo $get_id ?>">
Requested
</button>
<?php
} else  {
?>
<button name="request_btn" type="button" class="request_btn request_bttn" data-user="<?php echo $get_id ?>">
Add Friend
</button>
<?php
  }
?>
<!---<button name="request_btn" type="button" class="request_bttn request_btn" data-user="<?php echo $get_id ?>">
Add Friend
</button>--->
<button name="request_btn" type="button" class="request_btn">
  Message
</button>
<button name="request_btn" type="button" class="request_btn">
  Follow
</button>
</div>
<?php    
       }
?>
</div>

<script src="jquery.min.js"></script>
<script>
 $(document).ready(function() {
 $(".request_bttn").click(function (e){
e.preventDefault();
var today, someday, text;
today = new Date();
someday = new Date();
someday.setFullYear;
var person = $(".request_bttn").data("user");
var action = "send_friend_request";
$.ajax({
         url  : "function.php",
         type : "POST",
         data : "request_to_id="+person+"&action="+action+"&date="+someday,
          success : function (data) {
           $server = data;
         }
       });
  $(".request_bttn").addClass("disable_btn").removeClass("request_bttn").fadeIn("slow"). text("Sending...");
   });
});
</script>


<!----ENDED PROFILE--->
<?php
include('about_information.php');
?>
<body></html>
<?php  
}   else     {
header('location:login_form.php');
}
?>

