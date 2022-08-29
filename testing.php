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
$sql5 = "SELECT * FROM `friends` WHERE `session_user`='$from_user' AND `my_friend_id`='$user_id'";
$query5 = mysqli_query($conn , $sql5);
if (mysqli_num_rows($query5) == 0) {

?>

<div class="users_list">
<div class="person">
<a href="./profile.php?userId=<?php echo$user_id?>">
<img src="./images/<?php echo $avtar;?>">
<strong>
<?php echo $users_name ; ?>
</strong></a>
 <button id="request_btn" data-user="<?php echo $data_to_id ?>" class="disabled_btn ">Add Friend</button>
 </div>
</div>


<?php       }  else {
  echo "not found";
}
         }
      }
?>