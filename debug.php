<?php

include("config.php");

$email="smitbhatt052@gmail.com";
$password=md5("Smit0404");

$sql="SELECT * FROM users
WHERE email='$email'
AND password='$password'";

$result=mysqli_query($conn,$sql);

echo "Rows Found: ".mysqli_num_rows($result);

?>