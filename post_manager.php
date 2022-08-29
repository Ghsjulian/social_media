<?php
session_start();
include('config.php');
if($_POST['post_content']) {
$post_content= mysqli_real_escape_string($conn,$_POST['post_content']);
$poster_name  = $_SESSION['user_name'];
$poster_id    = $_SESSION['user_id'];
/*$lover = $_SESSION['user_name'];
$commenter = $_SESSION['user_name'];*/
$sql = "INSERT INTO `post_info`(`post_content`, `poster_id`, `poster_name`) VALUES ('$post_content','$poster_id','$poster_name')";
$query = mysqli_query($conn , $sql);
if ($query) {
  echo 1;
}
}

/*====================================
         <!------LIKE------!>
====================================*/

if($_POST['action']=="Like") {
$post_content= mysqli_real_escape_string($conn,$_POST['post']);
$poster_name = $_POST['poster'];
$post_id = $_POST['postid'];

$liker_id    = $_SESSION['user_id'];

$sql1 = "SELECT `liker_id`,`liked` FROM `post_action` WHERE `liker_id`='$liker_id' AND `liked`='$post_id'";
$query1 = mysqli_query($conn , $sql1);
if (mysqli_num_rows($query1) == 0) {

$sql2 = "UPDATE `post_info` SET `count`= count+1 WHERE post_id = $post_id";
$query2 = mysqli_query($conn , $sql2);
if ($query2) {

$sql3 = "INSERT INTO `post_action`(`liker_id`, `liked`) VALUES ('$liker_id','$post_id')";
$query3 = mysqli_query($conn , $sql3);
if ($query3)  {
//echo "Liked";
$sql4 = "SELECT `count` FROM `post_info` WHERE `post_id`='$post_id'";
$query4 = mysqli_query($conn , $sql4);
$getcount = mysqli_fetch_array($query4);
echo $total = $getcount['count'];
//echo '<img src="./icons/blue-like.png">';
    }
  }
}   else    {
$sql2 = "UPDATE `post_info` SET `count`= count-1 WHERE post_id = $post_id";
$query2 = mysqli_query($conn , $sql2);
if ($query2) {
$sql3 = "DELETE FROM `post_action` WHERE `liker_id`='$liker_id' AND `liked`='$post_id'";
$query3 = mysqli_query($conn , $sql3);
if ($query3)  {
  echo "Unliked";
      }
    }
  }
}


/*====================================
         <!------LOVE------!>
====================================*/
if ($_POST['action'] == "Like")  {
$poster_id   = $_POST['poster_id'];
$post_id     = $_POST['post_id'];
$liker       = $_SESSION['user_id'];
$lover = "";
$commenter = "";
include('database.php');
$insert = new Database ();
$sql = "INSERT INTO `post_info`(`poster_id`, `post_id`, `liker`) VALUES ('$poster_id','$post_id','$liker')";
$insert->insert_info($sql);
if (implode($insert->getResult()) == 1) {
$slct = "SELECT * FROM post_info WHERE poster_id='$poster_id' AND post_id='$post_id'";
$insert->like_count($slct);
echo implode($insert->getResult());
  }
}

/*====================================
      <!------COMMENT------!>
====================================*/

if ($_POST['comment'])  {
//$post_id     = $_POST['post_id'];
$comment       = $_POST['comment'];
echo $comment ;
/*
include('database.php');
$insert = new Database ();
$sql = "INSERT INTO `post_info`(`poster_id`, `post_id`, `liker`) VALUES ('$poster_id','$post_id','$lover')";
$insert->insert_info($sql);
print_r ($insert->getResult());
*/
}
?>