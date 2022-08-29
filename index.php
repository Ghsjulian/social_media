<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ghs Julian | Web Developer Ghs Julian | Web Designer Ghs Julian | Ghs Julian</title>
<link rel="stylesheet" href="./css/bts.min.css">
<link rel="stylesheet" href="./font/css/all.min.css">
 <link rel="stylesheet" href="./ux_ui.style.css">
 <link rel="stylesheet" href="./font/css/fontawesome.min.css">
 <link rel="stylesheet" href="./font/css/fontawesome.css">
<link rel="stylesheet" href="./css/w3school.css">
<link rel="stylesheet" href="./file.css">
 <link rel="stylesheet" href="./jquery.css">
  <link rel="stylesheet" href="./main.css">
     <link rel="stylesheet" href="./write_post.css">
</head><body>
<script src="jquery.min.js"></script>
<script>
$(document).ready(function (){
var device_width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
var device_height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
if (device_width.length<310 && device_height.length<800) {
$.get("error.php", function(data){
  document.getElementById('body_error').innerHTML=(data);
   });
} else {
//window.location.assign('index2.php');
</script>
<?php include('home.php'); ?>
<script>
   }
});
</script>
<div id="body_error"></div>
</body></html>