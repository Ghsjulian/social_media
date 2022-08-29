<?php 
session_start();
include('files.php'); 
include('top_bar.php');
if (empty($_SESSION['user_id'])){
  header('location:login_form.php');
} else {
?>
<br><br><br>
 <div align="center" class="post">
<strong> Write A Post On Your Timeline</strong>
<br><br>
 <div id="msg">
 </div>
 <br>
 <form id="myfrm">
 <textarea cols="25" id="post_content" class="post_content" name="post_content" placeholder="Write Something..."></textarea>

<input align="center" class="post_btn" type="submit" value="POST">
</form>
</div>
<script src="jquery.min.js"></script>
<script>
$(document).ready(function () {
 $("#myfrm").on("submit",function(e){
e.preventDefault();
var post = $("#post_content").val();
var postinfo = new FormData(this);
if (post == "") {
$("#msg").fadeIn();
$("#msg").addClass("errmsg").html("Please Write Something...");
     }   else  {
$.ajax({
      url : "post_manager.php",
      type : "POST",
      data : postinfo,
      contentType : false,
      processData : false,
      success: function (data) {
      $("#myfrm").trigger("reset");
if(data == 1) {
 window.location.assign('./news_feed.php');
}
       }
     })
   }
   });
});
</script>

<?php
}
?>