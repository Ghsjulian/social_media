<?php
session_start();
$from_user = $_SESSION['user_id'];
echo ghs($from_user)."<br><br>";
function ghs ($from_user) {
include('config.php');
$sql_6 = "SELECT * FROM `friends` WHERE '$from_user'";
$query_6 = mysqli_query($conn , $sql_6);
if ($query_6)  {
while ($ress=mysqli_fetch_array($query_6)) {
print_r($ress)."<br>";
    }
  }    
}
?>