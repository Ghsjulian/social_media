<?php
session_start();
if (empty($_SESSION['user_id'])) {
include('files.php'); 
?>
<div class="top_bar fixed-top">
<font color="blue">
  G
</font>
<font color="#ff0101">
  H
</font>
<font color="#fb00ff">
  S
</font><font color="#51b400">
  J
</font><font color="#ff5600">
  U
</font><font color="#00b1dd">
  L
</font><font color="green">
  I
</font><font color="red">
  A
</font>
<font color="orange">
  N
</font>
</div>
<!------top barr------->
<data class="home w3-animate-zoom">
<br>
<div class="home_banar">
<img class="top_banar" src="./images/bg4.png">
<div class="main_content">
<a class="home_btn" href="./sign_up.php">SignUp</a>
<a class="home_btn_login" href="./login_form.php">SignIn</a>
<br><br><br>
<strong style="font-size:24px ; font-family:serif"><font color="#f400e5">Hey , </font></strong>
Welcome ! Nice To Hear That You Have Came In My Site . This Site Has Made Just For Entertainment . You Can Use This Site Like Social Media .<br>
If You Are New In This Site Please Sign Up . And If You Have Already An Account So Please Login . <br>
After Creating Account , You Have To Update Your Profile . So Complete This Method .<br>
<strong style="font-size:24px ; font-family:serif"><font color="#002bf4">After Creating Account What Can You Do ?</font></strong><br>
After Creating An Account , You Can Use My Site Like As Social Media . You Can Add Friend . Follow An User , Accept Request , Post , Like , Comment , Message etc Everything You Can Do !<br>
Yess It's True ! Just Create An Account Now  And See The Magic !!!
<br><br>
</div>
</div>
</data>
<?php
}     else     {
header('location: news_feed.php');
}
?>