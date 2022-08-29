<?php 
session_start();
if ($_SESSION['user_id']) {
include('files.php'); 
include('top_bar.php');
include('post_manager.php');
?>

<data class="home w3-animate-zoom">
 <br><br><br><br>
 <!------STARTED NEWS FEED---->
 
<?php
include('config.php');
$session_id = $_SESSION['user_id'];
$sql_1 = "SELECT * FROM `post_info`";
$query_1 = mysqli_query($conn,$sql_1);
while ($result = mysqli_fetch_array($query_1) ) {
$post_id = $result['post_id'];
$poster_name = $result['poster_name'];
$post_content = $result['post_content'];
$count = $result['count'];
//GET PROFILE PHOTO
$sql3 = "SELECT * FROM users WHERE name='$poster_name'"; 
$query3 = mysqli_query($conn , $sql3);
if ($query3) {
$res = mysqli_fetch_array($query3);
$poster_avtar = $res['profile_photo'];
// GET COUNT OFF LIKES
$liker_id    = $_SESSION['user_id'];

$sql1 = "SELECT `liker_id`,`liked` FROM `post_action` WHERE `liker_id`='$liker_id' AND `liked`='$post_id'";
$query1 = mysqli_query($conn , $sql1);
if (mysqli_num_rows($query1) == 1) {
?>

<div class="news-feed">
  <div class="poster">
<img src="./images/<?php echo $poster_avtar;?>"><strong><a href="#"><?php echo $poster_name; ?></a></strong>
</div>
<div align="left" class="post_area">
 <content>
  <!--- Hello , User I'm Julian . I Am A Web Developer And Designer . Welcome To My Site . This Is My Social Media Web Site...--->
<?php echo $post_content; ?>
 </content>
</div>
<div align="center" class="actions"> 
<button name="request_btn" type="button" class="action_btn" id="like" data-post="<?php echo $post_content; ?>" data-poster="<?php echo $poster_name; ?>" data-postid="<?php echo $post_id; ?>"><img class="like_btn" src="./icons/blue-like.png"  data-post="<?php echo $post_content; ?>" data-poster="<?php echo $poster_name; ?>" data-postid="<?php echo $post_id; ?>"><?php echo $count ; ?>
</button>
<button name="request_btn" type="button" class="action_btn" id="love" data-poster_id="3" data-post_id="5">
<img src="./icons/red-heart.png"> 
</button>
<button name="request_btn" type="button" class="action_btn" id="comment" data-poster_id="3" data-post_id="5">
<img  src="./icons/comment.png"> 
</button>
</div>
<div align="center" id="load" class="load_comment">See Comments...</div>
<div class="comment_area">
  <div class="commenter">
<img src="./images/<?php
 session_start();
 echo $_SESSION['avtar'];
 ?>">
<input class="comment_btn value" type="text" name="comment" placeholder="Write A Comment..." data-postid="<?php echo $post_id; ?>">
<button type="submit" class="comment_btn" name="comment_btn"  data-postid="<?php echo $post_id; ?>">
  <img src="./google_icons/btc.png">
</button>
</div>
</div>
</div>

<?php    }    else   {
?>
<div class="news-feed">
  <div class="poster">
<img src="./images/<?php echo $poster_avtar;?>"><strong><a href="#"><?php echo $poster_name; ?></a></strong>
</div>
<div align="left" class="post_area">
 <content>
  <!--- Hello , User I'm Julian . I Am A Web Developer And Designer . Welcome To My Site . This Is My Social Media Web Site...--->
<?php echo $post_content; ?>
 </content>
</div>
<div align="center" class="actions"> 
<button name="request_btn" type="button" class="action_btn like_bttn" id="like" data-post="<?php echo $post_content; ?>" data-poster="<?php echo $poster_name; ?>" data-postid="<?php echo $post_id; ?>"><img class="like_btn" src="./icons/outline-like.png"  data-post="<?php echo $post_content; ?>" data-poster="<?php echo $poster_name; ?>" data-postid="<?php echo $post_id; ?>"><?php echo $count ; ?>
</button>
<button name="request_btn" type="button" class="action_btn" id="love" data-poster_id="3" data-post_id="5">
<img src="./icons/outline-heart.png"> 794
</button>
<button name="request_btn" type="button" class="action_btn" id="comment" data-poster_id="3" data-post_id="5">
<img  src="./icons/comment.png"> 362
</button>
</div>
<!----
<div align="center" id="load" class="load_comment">See Comments</div>
<div class="comment_area">
  <div class="commenter">
<img src="./images/<?php
 session_start();
 echo $_SESSION['avtar'];
 ?>">
<form id="myfrm">
 <input id="cmnt" type="text" name="comment" placeholder="Write A Comment..."/>
<button type="submit" class="comment_btn" name="comment_btn">
<img src="./google_icons/btc.png">
</button>
</form>
</div>---->
</div>

<?php
          }
       }
    }
?>

<script type="text/javascript" src="./jquery.min.js"></script>
<script>
$(document).ready(function ()  {
$(".like_bttn").click(function (e)  {
e.preventDefault();
var post_id = $(this).data("postid");
var post = $(this).data("post");
var poster = $(this).data("poster");
var action = "Like";
$.ajax({
        url:"post_manager.php",
        type:"POST",
        data:"poster="+poster+"& action="+action+"& postid="+post_id+"&post="+post,
       success:function (data) {
//       alert(data);
         }
      });
//$(this).attr("src", "/icons/blue-like.png").html(data);
$(this).html('<img class="like_btn" src="./icons/blue-like.png"><?php echo $likes ; ?>');
   });

// COMMENT SECTION AREA 

$(".load_comment").click(function(e){
e.preventDefault();
$(this).load("comments.php");
   });
});

$(document).ready(function () {
$("form").on('submit', function(e){
e.preventDefault();
var comment = this.cmnt.val();
alert(comment);
  });
});
/*
$.ajax({
        url:"post_manager.php",
        type:"POST",
        data: comment,
        contentType : false,
        processData : false,
       success:function (data) {
       alert(data);
         }
      });
      */
</script>

<script>
  //Love React Option 
$(document).ready(function () {
$("#love").click(function () {
$("#love").html('<img src="./icons/red-heart.png">');
  });
});
</script>
<!----ENDED POST AREA---->

</data>
<data class="search w3-animate-zoom">
  <?php include('profile.php'); ?>
<!----ENDED PROFILE--->
</data>
<data id="container" class="message w3-animate-zoom">
  <?php include('chat_list.php'); ?>
  <!----Include Message File--->
</data>
<data id="container" class="notification w3-animate-zoom">
  <!----Include Notification File--->
  
    <?php include('notification.php'); ?>
</data>

<data id="container" class="w3-animate-zoom menu">
  <?php include('menu.php'); ?>
<!----Include Menu File--->
</data>
<script src="jquery.min.js"></script>
<script>
 $(document).ready(function (){
 $("ul #cmd").click(function (){
 $(this).addClass("active_tab").siblings().removeClass("active_tab");
// $(this).siblings().addClass("active_tab");
   $("li").removeClass("active_tab");
let current = $(this).attr('href');
    $("data").hide("slow");
    $(current).show("slow");
 $($(this).data("value")).fadeIn("slow");

   });
 });
</script>
</body></html 
<?php
} else {
header('location:login_form.php'); 
}
?>

