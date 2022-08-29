<ul>
    <li><img src="./google_icons/user1.png"><a href="./profile.php">Profile</a></li>
  <li><img src="./google_icons/user1.png"><a href="./friend_list.php">Find Peoples</a></li>
<li ><img src="./google_icons/logout.png"><a href="./post_writing.php">Write A Post</a></li>
<li><img src="./google_icons/edit.png"><a href="update_info.php">Edit Profile</a></li>
<?php
if(empty ($_SESSION['user_id'])) {
?>
    <li><img src="./google_icons/login.png"><a href="./login_form.php">Sign In</a></li>
    <li><img src="./google_icons/add-user.png"><a href="./sign_up.php">Sign Up</a></li>
 <?php } ?>
    <li class="logout"><img src="./google_icons/logout.png"><a href="#">Log Out</a></li>
    <li><img src="./google_icons/edit.png"><a href="update_info.php">Edit Profile</a></li>
    <li><img src="./google_icons/information.png"><a href="#">About US</a></li>
    <li><img src="./google_icons/phone.png"><a href="#">Contact US</a></li>
    <li><img src="./google_icons/graph.png"><a href="#">Report US</a></li>
    <li><img src="./google_icons/check-list.png"><a href="#">Privacy & Policy</a></li>
    <li><img src="./google_icons/web-development.png"><a href="#">Terms And Conditions</a></li>
</ul>
<script src="jquery.min.js"></script> 
<script>
$(document).ready(function(){
$(".logout").click(function(){
if (confirm("Are You Sure LogOut This System ?") == true) {
window.location.assign('logout.php');
     }
   });
});
</script>