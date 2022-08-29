<?php
include('config.php');
$user_name = $_SESSION['name'];
$session_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `notifications` WHERE notification_accepter='$session_id'";
$query = mysqli_query($conn,$sql);
while ($data_user = mysqli_fetch_array($query)) {
$notification_sender = $data_user['notification_sender'];
$notification_id = $data_user['id'];
$notification = $data_user['notification'];
$date = $data_user['date'];

$sql_2 = "SELECT * FROM users WHERE name='$notification_sender'";
$query_2 = mysqli_query($conn,$sql_2);
$dat = mysqli_fetch_array($query_2);
$request_sender_id = $dat['user_id'];

?>
  <div class="notification_are">
    <div class="main-content">
     <div class="content-place">
      <img src="./images/ghs.png" alt="User"><strong align="center"><a href="#"><?php echo $notification_sender;?> </a></strong> <button data-name="<?php echo $notification_sender;?>" data-id="<?php echo $notification_id;?>" data-user_id="<?php echo $request_sender_id; ?>" class="accept_btn">Accept</button>
      </div>
<p ><?php echo $notification;?></p>
<p align="left"><?php echo $date;?></p>
    </div>
  </div>
<?php
    } 
?>
<br><br>
<?php
 if ($notification=='') {
 ?>
 <center>
  <img src="./icons/empty_notification.png" alt="Notification" width="150" height="200"><br>
   <strong class="no_msg" align="center">No Any Notification For You !</strong></center>
<?php
 } 
?>
<script src="jquery.min.js"></script>
<script>
 $(document).ready(function() {
 $(".accept_btn").click(function (e){
e.preventDefault();
var request_sender_id = $(this).data("id");
var request_sender_name = $(this).data("name");
var request_sender_main_id = $(this).data("user_id");
var action = "accept_request"; 

$.ajax({
         url  : "function.php",
         type : "POST",
         data : "request_sender_id="+request_sender_id+"&action="+action+"&request_sender_name="+request_sender_name+"&request_sender_main_id="+request_sender_main_id,
          success : function (data) {
           $server = data;
          }
      });
//$(".notification_area").fadeOut("slow").hide("slow");
 $(this).fadeOut("slow").fadeIn("slow").text("Accepted");
   });
});
</script>