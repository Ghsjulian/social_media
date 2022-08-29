<?php 
session_start();
include('files.php');
include('top.php');
?>
<br><br><br>

<center>
<form name="myfrm" id="myfrm">
<strong align="center" class="intro">
Hey ! <font color="#000dd1"><b>
<?php
include('config.php');
echo $_SESSION['user_name'];
 ?></b></font>
 <br>
Please Update Your Informations .
</strong>

<div align="center" class="info_area">
  <div class="profile_avtar">
  <img align="center" class="preview" id="preview" src="./icons/cmr2.png">
<input id="photo" type="file" name="photo" onchange="previewFile(this);" required accept="image/*">
</div>
<span id="imageErr"></span>

<div class="form">
  <input id="country" value="" type="text" name="country" placeholder="Country">
  
  <input id="city" type="text" name="city" placeholder="City / District">
  
    <input id="profession" type="text" name="profession" placeholder="Profession">
  
  <input id="school" type="text" name="school" placeholder="School / College">
</div>
<input type="submit" class="lets_go_btn" value="Continue"/>
</div>
</form>
</center>
 
 
 
 
 
 
 
 
 
 
<script src="jquery.min.js"></script> 
<script>
//  IMAGE VIEWS FOR PROFILE PICTURE 

function previewFile(input){
var file = $("input[type=file]").get(0).files[0];
   if(file){
var reader = new FileReader();
  reader.onload = function(){
$("#preview").attr("src", reader.result);
            }
reader.readAsDataURL(file);
        }
  }
$(document).ready(function(){
$("#myfrm").on("submit",function(e){
e.preventDefault();
var form_data = new FormData(this);

var country = $("#country").val();
var city = $("#city").val();
var profession = $("#profession").val();
var school = $("#school").val();
var file = $("input[type=file]").get(0).files[0];

  if (!file || country == '' || city == '' || profession == '' || school == '') {
 $("#imageErr").fadeIn("slow");
$("#imageErr").addClass("error").html("Please Fill Out This Form");
setTimeout(function (){
$("#imageErr").hide();
  },3000);
 }     else   {
 
$.ajax({
      url : "function.php",
      type : "POST",
      data : form_data,
      contentType : false,
      processData : false,
      success: function (data) {
      $("#myfrm").trigger("reset");
 if (data == '1') {
window.location.assign('profile.php');
         }    else    {
 $("#imageErr").fadeIn("slow");
$("#imageErr").addClass("error").html(data);
            }
          }
         });
       }
   });
});
</script>
</body></html>
