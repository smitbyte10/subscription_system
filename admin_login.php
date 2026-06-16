<?php

session_start();
include("config.php");

if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="SELECT * FROM admin
          WHERE username='$username'
          AND password='$password'";

    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0)
    {
        $_SESSION['admin']=$username;
        header("Location: admin_dashboard.php");
        exit();
    }
    else
    {
        echo "<script>alert('Invalid Admin Login');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(135deg,#111827,#312e81);
font-family:Poppins;
}

.box{
width:400px;
padding:35px;
background:rgba(255,255,255,.08);
backdrop-filter:blur(15px);
border-radius:20px;
}

h1{
text-align:center;
color:white;
}

input{
width:100%;
padding:15px;
margin:10px 0;
border:none;
border-radius:10px;
}

button{
width:100%;
padding:15px;
background:#8b5cf6;
border:none;
border-radius:10px;
color:white;
}

</style>
</head>

<body>

<div class="box">

<h1>👑 Admin Login</h1>

<form method="post">

<input type="text"
name="username"
placeholder="Username"
required>

<input type="password"
name="password"
placeholder="Password"
required>

<button
type="submit"
name="login">

Login

</button>

</form>

</div>

</body>
</html>