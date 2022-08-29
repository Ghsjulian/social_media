<?php
/*====================================
<!------LOGIN INFORMATION------------!>
====================================*/
session_start();
include('config.php');
if ($_POST['action']=="login") {
$name = mysqli_real_escape_string ($conn, $_POST['user_name']);
$password = mysqli_real_escape_string($conn , $_POST['user_password']);


$sql = "SELECT * FROM users WHERE name='$name' AND password='$password'";
   
$query = mysqli_query($conn,$sql);
if ($query) {
$data = mysqli_fetch_array($query);
$userid        = $data['user_id'];
$user_name     = $data['name'];
$user_password = $data['password'];
$_SESSION['user_id']=$userid;
$_SESSION['user_name']=$user_name;
if ($user_name == $name || $user_password == $password) {
echo '1';
     } 
  } else {
    echo '2';
  }
}
/*====================================
<!------REGISTRATION INFORMATION------!>
====================================*/

if( $_POST['user_birth']) {
session_start();
include('config.php');
$name = $_POST['user_name'];
$email = $_POST['user_email'];
$password = $_POST['user_password'];
$birth = $_POST['user_birth'];
$gender = $_POST['gender'];

$getname = mysqli_real_escape_string($conn ,$name );
 $getemail = mysqli_real_escape_string($conn ,$email );
 $getpassword = mysqli_real_escape_string($conn , $password);
 $getbirthday = mysqli_real_escape_string($conn , $birth);


/*====================================
<!------SELECTED DATABASES------!>
====================================*/


$sql = "SELECT * FROM users" ;
 $query = mysqli_query($conn,$sql) ;
 $data = mysqli_fetch_array($query) ;
     $db_user_name = $data['name'];
     $db_user_email = $data['email'];
if ($getname==$db_user_name || $getemail==$db_user_email) {
  echo '<div class="error_msg"><img src="./google_icons/error.png">User Already Registered Once !</div>';
 } else {
$insert = "INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `birthday`, `gender`) VALUES (NULL, '$getname', '$getemail', '$getpassword', '$getbirthday', '$gender')";
$result = mysqli_query($conn , $insert);
if ($result) {
$sql3 = "SELECT * FROM users WHERE name = '$getname'" ;
 $query3 = mysqli_query($conn,$sql3) ;
 $data3 = mysqli_fetch_array($query3) ;
 $db_user = $data3['name'];
 $db_user_id = $data3['user_id'];
$_SESSION['user_id'] = $db_user_id ;
$_SESSION['user_name'] = $db_user;

  
echo "<script>window.location.assign('./update_info.php');</script>";

  }       else       {
  echo '<img src="./google_icons/error.png">Registration Failed !';
        }
    }
}

/*====================================
<!------SENDING FRIEND REQUEST------!>
====================================*/
if($_POST['action']=="send_friend_request") {
$request_to_id = $_POST['request_to_id'];
$request_from_id = $_SESSION['user_id'];
$requester_name = $_SESSION['user_name'];
$date = $_POST['date'];
$sql_select = "SELECT * FROM users WHERE user_id='$request_to_id'" ;
$query_select = mysqli_query($conn,$sql_select);
$data_5 = mysqli_fetch_array($query_select);
$to_name = $data_5['name'];

$sql_2 = "SELECT * FROM `requests` WHERE from_id='$request_from_id'AND to_id='$request_to_id'";
$query_2 = mysqli_query($conn,$sql_2);
$data_user = mysqli_fetch_array($query_2);
$data_from_id   = $data_user['from_id'];
$data_to_id     = $data_user['to_id'];
if (empty($data_from_id && $data_to_id)) {
$sql_insert = "INSERT INTO `requests`(`to_id`, `from_id`) VALUES('$request_to_id','$request_from_id')";
$query_insert = mysqli_query($conn,$sql_insert);
$notification_text = $requester_name." "."Sent You A Friend Request ! Do You Want To Accept This Request ?";
$notification = "INSERT INTO `notifications`(`notification`, `notification_sender`, `notification_accepter`, `date`) VALUES ('$notification_text','$requester_name','$request_to_id','$date')";
$insert_notification = mysqli_query($conn,$notification);
if($query_insert){
  echo '1';
} else {
  echo "Errors";
      }
    } else {
      echo "Pending...";
    }
  }
  
/*====================================
<!------ACCEPT FRIEND REQUEST------!>
====================================*/

if ($_POST['action']=="accept_request") {

 $session_user = $_SESSION['user_id'];
 $session_user_name = $_SESSION['user_name'];
 $request_sender_id = $_POST['request_sender_id'];
 $request_sender_name = $_POST['request_sender_name'];
 $request_sender_main_id = $_POST['request_sender_main_id'];
$msg_id = "ghs__".rand();


 
 //FRIENDS INSERTION 
  $sql_friend = "INSERT INTO `friends`(`session_user`, `my_friends`,`session_user_name`,`my_friend_id`,`msg_id`) VALUES ('$session_user','$request_sender_name','$session_user_name','$request_sender_main_id','$msg_id')";
  $query_friend = mysqli_query($conn,$sql_friend);
  
$add_friend = "INSERT INTO `friends`(`session_user`, `my_friends`,`session_user_name`,`my_friend_id`,`msg_id`) VALUES ('$request_sender_main_id','$session_user_name','$request_sender_name','$session_user','$msg_id')";
 
 $queryfriend = mysqli_query($conn,$add_friend);
  
  
  
//SELECT REQUEST ID 
$request_select = "SELECT * FROM requests WHERE to_id='$session_user' AND from_id='$request_sender_main_id'";
 
$request_query_select = mysqli_query($conn,$request_select);
$data_2 = mysqli_fetch_assoc($request_query_select);
$request_id = $data_2['id'];

 //REQUEST DELETION 
$delete_request = "DELETE FROM `requests` WHERE id='$request_id'";
$delete_request_query = mysqli_query($conn,$delete_request);

//NOTIFICATION DELETION 
$notification_delete = "DELETE FROM `notifications` WHERE id='$request_sender_id'";
  $notification_query_delete = mysqli_query($conn,$notification_delete);

$notification_text = "Are You Sure Confirm This Request ?";

$notification = "INSERT INTO `notifications`(`notification`, `notification_sender`, `notification_accepter`) VALUES ('$notification_text','$session_user','$request_sender_name')";
$insert_notification = mysqli_query($conn,$notification);


$col_1 = str_replace(" " , "" , $request_sender_name);
$col_2 = str_replace(" " , "" , $session_user_name);
$create_tbl = "CREATE TABLE $msg_id (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
$col_1 VARCHAR(10000) NOT NULL,
user_1 INT(10),
$col_2 VARCHAR(10000) NOT NULL,
user_2 INT(10),
images VARCHAR(50),
date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$query_3 = mysqli_query($conn , $create_tbl);
if( $query_3) {
  echo 1 ;
   }
 }
/*====================================
<!------USER UPDATE INFORMATION------!>
====================================*/

if ( $_FILES['photo']['name'] || $_POST['country'] || $_POST['city'] || $_POST['profession'] || $_POST['school'] ) {

$session = $_SESSION['user_name'];
$user_avtar = $_FILES['photo']['name'];

$country = mysqli_real_escape_string($conn,$_POST['country']);

$city = mysqli_real_escape_string($conn,$_POST['city']);

$profession = mysqli_real_escape_string($conn,$_POST['profession']);

$school = mysqli_real_escape_string($conn,$_POST['school']);
$extension = pathinfo ($user_avtar ,PATHINFO_EXTENSION);
$valid_extension = array("jpg","png","jpeg");
if (in_array($extension,$valid_extension)) {
$new_name = $session.rand().".".$extension;
$path = "images/".$new_name;
if(move_uploaded_file($_FILES['photo']['tmp_name'],$path)) {
  
$insert_info = "UPDATE `users` SET `profile_photo`='$new_name',`user_country`='$country',`profession`='$profession',`school`='$school',`user_city`='$city' WHERE name='$session'";
$insert_query = mysqli_query($conn,$insert_info);

if ($insert_query) {
echo '1';
           }
         }
     }     else {
 echo 'Please Select An Image';
     }
}

/*====================================
<!--CONFIRMATION FRIEND REQUESTS--!>
====================================*/

if ($_POST['action']=="confirm_request") {

 $session_user = $_SESSION['user_id'];
 $session_user_name = $_SESSION['user_name'];
 $request_sender_id = $_POST['request_sender_id'];
 $request_sender_name = $_POST['request_sender_name'];
 $request_sender_main_id = $_POST['request_sender_main_id'];
$msg_id = "ghs__".rand();


 
 //FRIENDS INSERTION 
  $sql_friend = "INSERT INTO `friends`(`session_user`, `my_friends`,`session_user_name`,`my_friend_id`,`msg_id`) VALUES ('$session_user','$request_sender_name','$session_user_name','$request_sender_main_id','$msg_id')";
  $query_friend = mysqli_query($conn,$sql_friend);
  
}


?>