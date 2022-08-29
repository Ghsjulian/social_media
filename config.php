<?php
$server = "sql309.epizy.com";
$user = "Jvqp2Y28xI2";
$password ="yP$k+GipU%4SHKC";
$db_name = "epiz_30925471_mydata";
$conn =mysqli_connect("$server","$user","$password","$db_name");

if ($conn==false) {
echo "Database Connected failed";
} 
?>