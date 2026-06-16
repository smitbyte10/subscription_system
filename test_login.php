<?php

include("config.php");

$result=mysqli_query($conn,"SELECT * FROM users");

while($row=mysqli_fetch_assoc($result))
{
    echo "Email: ".$row['email']."<br>";
    echo "Password: ".$row['password']."<br><br>";
}

?>