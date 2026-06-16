<?php

session_start();
include("config.php");

if(isset($_SESSION['user_id']))
{
    mysqli_query($conn,

    "INSERT INTO activity_log
    (user_id,activity)

    VALUES
    ('".$_SESSION['user_id']."',
    'Logged Out')"

    );
}

session_destroy();

header("Location: login.php");

?>