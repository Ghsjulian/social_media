
<?php
session_start();
if (empty($_SESSION['user_id'])) {
include('files.php');
include('top.php');
?>
	<div class="limiter">

		<div class="container-login100">

			<div class="wrap-login100">
				<form id="myfrm" class="login100-form validate-form p-l-55 p-r-55 p-t-18">
			<!---		<span class="login100-form-title">
						Sign In
					</span>--->
		<center><img align="center" class="login_avtar" src="./images/user_avtar.png"></center>
<div id="response"> </div>
					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
						<input id="user_name" class="input100" type="text" name="user_name" placeholder="Enter Username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Please enter password">
						<input id="user_password" class="input100" type="password" name="user_password" placeholder="Enter Password">
						<span class="focus-input100"></span>
					</div>

					<div class="text-right p-t-15 p-b-23">
						<span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2">
							Username / Password ?
						</a>
					</div>

					<div class="container-login100-form-btn">
						<button class="login__btn login100-form-btn">
						<b>	Sign in</b>
						</button>
					</div>

					<div class="flex-col-c p-t-50 p-b-40">
						<span class="txt1 p-b-9">
							Don’t have an account ?
						</span>

						<a href="./sign_up.php" class="txt3">
							Sign up now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
<script src="jquery.min.js"></script>
<script>
$(document).ready(function(){
$(".login__btn").click(function(e){
e.preventDefault();
var name = $("#user_name").val();
var password = $("#user_password").val();
var action = "login";

if (name =="") {
 $("#response").fadeIn("slow");
 $("#response").addClass("error").html('<img src="./google_icons/error.png"> Please Enter Username !');
setTimeout(function (){
$("#response").fadeOut("slow");
},3000);
return false;
}

if (password =="") {

 $("#response").fadeIn("slow");

 $("#response").addClass("error").html('<img src="./google_icons/error.png"> Please Enter Password !');
setTimeout(function (){
$("#response").fadeOut("slow");
},3000);
return false;
} else {
   $.ajax({
      url : "function.php",
      type : "POST",
      data : "user_name="+name+"&user_password="+password+"& action="+action,
     beforeSend: function(){
			 $("#response").html('<center><img src="./icons/loading.gif" width="29" height="29"/> <b>  Please Wait...</b></center>');
      },
    success : function(data){
 $("#myfrm").trigger("reset");
    setTimeout(function() {
      if (data == 1) {
window.location.assign('news_feed.php');
}     else     {
$("#response").fadeIn();
 $("#response").addClass("error_msg").html('<img src="./google_icons/error.png">Invalid User Name And Password');
             }
            },1000);
          } 
       });
      }
   });
});
</script>
</body></html>
<?php
}    else    {
header('location:profile.php');
}
?>