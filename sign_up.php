<?php 
session_start();
if (empty ($_SESSION['user_id'])) {
include('files.php');
include('top.php'); 
?>
	
	<br><br>
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
						<input id="user_name" class="input100" type="text" name="user_name" placeholder="Enter Username" autocomplete="username" accept="username">
						<span class="focus-input100"></span>
					</div>
	<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">

						<input id="user_email" class="input100" type="text" name="user_email" placeholder="Enter Email" autocomplete="email" accept="email"/>

						<span class="focus-input100"></span>
					</div>
					
			
					
	<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">

						<input id="user_birth" class="input100" type="text" name="user_birth" placeholder="Date Of Birth">

						<span class="focus-input100"></span>
					</div>

		<div class="wrap-input100 validate-input" data-validate = "Please enter password">

						<input id="user_password" class="input100" type="password" name="user_password" placeholder="Enter Password">

						<span class="focus-input100"></span>
					</div>		
			<br><center>
<strong>Select Your Gender : </strong>
  <div id="radio_place ">
    <i class="fa fa-male"></i><strong> Male</strong>
  <input id="user_gender" type="radio" name="gender" value="Male"/>

   <i class="fa fa-female"></i><strong>Female</strong>
         <input id="user_gender" type="radio" name="gender" value="Female"/>
   </div>
   				<div class="text-right p-t-15 p-b-23">

						<span class="txt1">

							Valid Birthday : 
						</span>

						<a href="#" class="txt2">
							DD/MM/YY
						</a>
					</div>
					

					<div class="container-login100-form-btn">
						<button class="login__btn login100-form-btn">
						<b>	Registration</b>
						</button>
					</div>

					<div class="flex-col-c p-t-50 p-b-40">
						<span class="txt1 p-b-9">
							Already Have An Account ?
						</span>

						<a href="login_form.php" class="txt3">
							Sign In now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
<script src="jquery.min.js"></script>
<script>
$(document).ready(function(){
$("#myfrm").on("submit",function(e){
e.preventDefault();
var form_data = new FormData(this);
var name = $("#user_name").val();
var email = $("#user_email").val();
var birth = $("#user_birth").val();
var password = $("#user_password").val();
var gender = $("#user_gender").val();


/*====================================
     <!------CONDITIONS------!>
====================================*/
	if (name=="" || email=="" || birth=="" || password=="" || gender=="")  {
 $("#response").fadeIn("slow");
 $("#response").addClass("error").html('<img src="./google_icons/error.png"> Please Fill Out This From !');
setTimeout(function (){
$("#response").fadeOut("slow");
},3000);
	} else {
      $.ajax({
      url : "function.php",
      type : "POST",
      data : form_data,
      contentType : false,
      processData : false,
      beforeSend: function(){
			 $("#response").html('<center><img src="./icons/loading.gif" width="28" height="28"/><b>  Please Wait...</b></center>');
      },
      success : function(data){
     setTimeout(function() {
     $("#myfrm").trigger("reset");
     $("#response").fadeIn();
     $("#response").html(data);
     },1000);
     setTimeout(function() {
     $("#response").fadeOut("slow");
     },3000);
          }
       });
       }
    });
});
</script> 
	
<!--===============================================================================================-->
	<script src="veyndor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min6.js"></script>
<!--===============================================================================================-->
	<script src="vendor/ybootstrap/js/popper.js"></script>
	<script src="vegndor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendgor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.miny.js"></script>
	<script src="vendor/daterangepicker/daterangepickery.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntim6e.js"></script>
<!--===============================================================================================-->
	<script src="js/maint.js"></script>

</body>
</html>
<?php
}    else   {
header('location: home.php');
}
?>