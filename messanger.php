<?php
session_start();
include('config.php');


$session_id = $_SESSION['user_id'];
$session_name = $_SESSION['user_name'];
$message = $_POST['messages'];
$friends_name = $_POST['friends_name'];
$msg_id = $_POST['msg_id'];
$col_1 = str_replace(" " , "" , $friends_name);
$col_2 = str_replace(" " , "" , $session_name);

$sql_1 = "INSERT INTO $msg_id ($col_2) VALUES ('$message')";
$query_1 = mysqli_query($conn , $sql_1);

//$get_msg = "SELECT $col_2 ,`date` FROM $msg_id  ORDER BY ID DESC LIMIT 1";

$get_msg = "SELECT $col_2 , $col_1 FROM $msg_id  ORDER BY ID DESC LIMIT 1";
$msg_query = mysqli_query($conn , $get_msg);
if ($msg_query)  {
$sms_data = mysqli_fetch_array( $msg_query);
$sms_1 = $sms_data[$col_2];
$sms_2 = $sms_data[$col_2];
echo $sms_1 ;
     }

?>