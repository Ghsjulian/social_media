<?php

	include "./crud-class/database.php";
	$obj = new Database();

	$name      =   $_POST['user_name'];
  $email     =   $_POST['user_email'];
  $password  =   $_POST['user_password'];
  $birth     =   $_POST['user_birth'];
  $gender    =   $_POST['gender'];

	$value = ['name'=>'$name','email'=>'$email','password'=>'$password','birthday'=>'$birth','gender'=>'$gender'];
	echo $value;
/*
	if($obj->insert("users",$value)){
		echo "<h2>Data Inserted Successfully.</h2>";
	}else{
		echo "<h2>Data is Not Inserted Successfully.</h2>";
	}
*/
?>